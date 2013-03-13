#include<iostream>
#include<sys/time.h>
#include<cstring>
#include<sys/resource.h>
#include<unistd.h>
using namespace std;
int limit_file(int i){
	rlimit r;
	r.rlim_cur = i;
	r.rlim_max = i;
	return setrlimit(RLIMIT_NOFILE, &r);
}
int limit_as(int i){
	rlimit r;
	r.rlim_cur = i;
	r.rlim_max = i;
	return setrlimit(RLIMIT_AS, &r);
}
int main(){
	limit_file(4);
	sleep(1);
	execl("4.exe", "4.exe", NULL);
}
	
