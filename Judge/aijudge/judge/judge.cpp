#include "judge.h"
judge::judge(){
	o.init();
}
void judge::init(const char *s){
}
void judge::run(){
	int turn = 0;
	while (true){
		//FILE *err;
		//err = fopen("out.txt", "a");
		//fprintf(err, "hehe\n");
		//fclose(err);
		for (int i = 0; i < 2; ++i)
			if ((!state[i])&&(!player_init(i))){
				judge_debug("INITERR %d\n", i);
				judge_exit(-1);
				return;
			}else state[i] = true;
		//string s = o.tostring();
		//judge_debug("%s\n", s.c_str());

		if (o.canmove(turn + 1)) judge_com(turn);
		else if (!o.canmove(2 - turn)){
			int x = o.count(1);
			int y = o.count(2);
			judge_debug("REPORT %d %d\n", x, y);
			judge_exit((x >= y)?0:1);
		}
		turn = 1 - turn;
	}
}

void judge::judge_debug(const char *format, ...){
	printf("DEBU ");
	va_list ap;
	va_start(ap, format);
	vprintf(format, ap);
	va_end(ap);
	fflush(stdout);
}

bool judge::player_init(int id){
	string s = o.tostring();
	printf("STAR %d %d%s\n", id, id + 1, s.c_str());
	fflush(stdout);
	judge_debug("START %d\n", id); 
	scanf("%[^\n]", buf);
	while ('\n' != getchar());
	FILE *f;
	f = fopen("out.txt", "a");
	fprintf(f, "%s\n", buf);
	fclose(f);
	if (strncmp(buf, "SUCC", 4) == 0) return true;
	else return false;
}

void judge::judge_com(int turn){
	FILE *f;
	f = fopen("out.txt", "a");
	fprintf(f, "WHY\n");
	fclose(f);
	printf("COMM %d GET\n", turn);
	fflush(stdout);
	scanf("%s", buf);
	if (strncmp(buf, "SUCC", 4) == 0){
		int x, y;
		scanf("%d %d", &x, &y);
		while ('\n' != getchar());
		o.play(turn + 1, x, y);
		judge_debug("MOVE %d %d %d\n", turn + 1, x, y);
		fflush(stdout);
		for (int i = 0; i < 2; ++i){
			printf("COMM %d MOVE %d %d %d\n", i, 1 + turn, x, y);
			fflush(stdout);
			scanf("%s", buf);
			if (!(state[i] = (strncmp(buf, "SUCC", 4) == 0))){
				while ('\n' != getchar());
				judge_debug("RUNNTIMEERR %d\n", i);
			}else{
				scanf("%s", buf);
				while('\n' != getchar());
			}
		}
	}else{
		while('\n' != getchar());
		judge_debug("RUNNTIMEERROR %d\n", turn);
		int x, y;
		o.play(turn, x, y);
		judge_debug("MOVE %d %d %d\n", turn, x, y);
		fflush(stdout);
		printf("COMM %d MOVE %d %d %d\n", 1 - turn, 1 + turn, x, y);
		fflush(stdout);
		scanf("%s", buf);
		if (!(state[1 - turn] = (strncmp(buf, "SUCC", 4) == 0))){
			while ('\n' != getchar());
			judge_debug("RUNNTIMEERR %d\n", 1 - turn);
		}else{
			scanf("%s", buf);
			while('\n' != getchar());
		}
	}
}

void judge::judge_exit(int id){
	judge_debug("WINNERR %d\n", id);
	judge_debug("EXIT\n");
	printf("EXIT\n");
	fflush(stdout);
}
