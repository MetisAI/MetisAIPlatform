
/*
   sandbox program=PROGRAM_NAME time=TIME_LIMIT memory=MEMORY_LIMIT
   the program is under "./tmp/"
*/
#include <unistd.h>
#include <sys/ptrace.h>
#include <sys/wait.h>
#include <sys/types.h>
#include <sys/time.h>
#include <sys/wait.h>
#include <sys/syscall.h>

#include <sys/reg.h>
#include <signal.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

#include "syscalls.h"

int time_limit = 1000, memory_limit = 32768;
char *tle_tip = "Time Limit Exceeded";
char *mle_tip = "Memory Limit Exceeded";
char *rte_tip = "Runtime Error";
char *res_tip = "Ristricted Functions";

int calls[256];
pid_t pid;
long orig_eax;
int status, sig, time_used;
int i;
int vm_peak, time_used;
int restricted_calls = 0;
struct rusage usage;
struct itimerval start_timer, finish_timer;
char *result = "RUNNING";
char *judge_result;
char buf[1024];
struct timeval start, end;
int java = 0;

void terminate_process() {
	kill(pid, SIGKILL);
}
void tle_terminate_process() {
	result = tle_tip;
	kill(pid, SIGKILL);
}

void init_sigaction() {
	struct sigaction act;
	act.sa_handler = tle_terminate_process;
	act.sa_flags = 0;
	sigemptyset(&act.sa_mask);
	sigaction(SIGALRM, &act, NULL);
	sigaction(SIGPROF, &act, NULL);
}

void init_timer() {
	time_limit += time_limit >> 1;
	start_timer.it_interval.tv_sec = 0;
	start_timer.it_interval.tv_usec = 0;
	start_timer.it_value.tv_sec = time_limit / 1000;
	start_timer.it_value.tv_usec = time_limit % 1000 * 1000;
	setitimer(ITIMER_REAL, &start_timer, &finish_timer);
}

void refresh_memory_use() {
	char *ret;

	sprintf(buf, "/proc/%d/status", pid);
	FILE *fp = fopen(buf, "r");
	if (fp == NULL) return;
	while (!feof(fp)) {
		ret = fgets(buf, 100, fp);
		if (strncmp(buf, "VmPeak:", 7) == 0) {
			break;
		}
	}
	sscanf(buf + 7, "%d", &vm_peak);
	fclose(fp);
}

char *start_listen() {
	while (1) {

		wait4(pid, &status, WUNTRACED, &usage);
		time_used = usage.ru_utime.tv_sec * 1000 + usage.ru_utime.tv_usec / 1000;

		if (WIFSIGNALED(status)) {
			refresh_memory_use();
			return result;
		}
		if (!WIFSTOPPED(status)) {
			refresh_memory_use();
			return "OK";
		}

		sig = WSTOPSIG(status);
	
		if (sig != SIGTRAP) {
			refresh_memory_use();
			switch(sig) {
				case SIGFPE: return rte_tip;
				case SIGSEGV: return rte_tip;
				case SIGXFSZ: return rte_tip;
				case SIGILL: 
				case SIGKILL: return rte_tip;
				case SIGALRM: 
				case SIGPROF: return rte_tip;
			}

			ptrace(PTRACE_SYSCALL, pid, NULL, sig);
			continue;
		}

		orig_eax = ptrace(PTRACE_PEEKUSER, pid, ORIG_EAX * sizeof(long), NULL);
		printf("%d\n", (int)orig_eax);
		if (!java && disabled_syscall[orig_eax]) {
			refresh_memory_use();
			restricted_calls ++;
			if (restricted_calls > 1) {
				return res_tip;
			}
		}

		if (orig_eax == 192 || orig_eax == 90 || orig_eax == 45) {
			refresh_memory_use();
			if (vm_peak > memory_limit) {
				return mle_tip;
			}
		}

		calls[orig_eax] ++;
		ptrace(PTRACE_SYSCALL, pid, NULL, NULL);
	}
}

char *program_name = NULL;

int main(int argc, char *argv[]) {
	int i;

	for (i = 1; i < argc; i ++) {
		if (strncmp(argv[i], "program=", 8) == 0) {
			program_name = argv[i] + 8;
		}
		if (strncmp(argv[i], "time=", 5) == 0) {
			sscanf(argv[i] + 5, "%d", &time_limit);
		}
		if (strncmp(argv[i], "memory=", 7) == 0) {
			sscanf(argv[i] + 7, "%d", &memory_limit);
		}
		if (strncmp(argv[i], "java", 4) == 0) {
			java = 1;
		}
	}

	pid = fork();

	if (pid != 0) {
		gettimeofday(&start, NULL);
		init_sigaction();
		init_timer();
		judge_result = start_listen();
		terminate_process();
		gettimeofday(&end, NULL);
		time_used = (1000000 * ( end.tv_sec - start.tv_sec ) + end.tv_usec - start.tv_usec) / 1000; 
		// judge_result 

		if (vm_peak > memory_limit) {
			judge_result = mle_tip;
		}
		if (time_used > time_limit) {
			judge_result = tle_tip;
		}
		if (strncmp(judge_result, "OK", 2) == 0)
			printf("%d %d %s *\n", time_used, vm_peak, judge_result);
		else
			printf("%d %d %s x\n", time_used, vm_peak, judge_result);
	} else {
		int ret;

		ret = chdir("tmp/");
		if (!java) {
			ret = chroot("tmp/");
		}
		//ret = (int)freopen("in.txt", "r", stdin);
		//ret = (int)freopen("out.txt", "w", stdout);
		ptrace(PTRACE_TRACEME, 0, NULL, NULL);
		execl(program_name, "program", NULL);
	}
	return 0;
}

