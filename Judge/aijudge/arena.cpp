#include "include/arena.h"
using namespace std;
person judge, player[MAXPER];
int pl_num = MAXPER;
int judge_time = DEFUTE_TIME;
int player_time = DEFUTE_TIME;
char buf[MAXN];
FILE *f;
void my_exit(bool error){
	judge.stop();
	for (int i = 0; i < pl_num; ++i)
		player[i].stop();
	if (error)
		printf("judge_error");
	fclose(f);
}
int main(int argc, char *argv[]){
	f = fopen("debug.txt", "w");
	printf("start\n");
	//初始化参数
	for (int i = 0; i < argc; ++i){
		if (strncmp(argv[i], "player_num=", 11) == 0)
			sscanf(argv[i] + 11, "%d", &pl_num);
		if (strncmp(argv[i], "judge_time=", 11) == 0)
			sscanf(argv[i] + 11, "%d", &judge_time);
		if (strncmp(argv[i], "player_time=", 12) == 0)
			sscanf(argv[i] + 12, "%d", &player_time);
	}
	//创建所有用于评测的进程
	fprintf(f, "will create\n");
	judge.create("judge/program");
	for (int i = 0; i < pl_num; ++i){
		strcpy(buf, "ai0/program");
		buf[2] = i + '0';
		fprintf(f, "%d\n", player[i].create(buf));
		fprintf(f, "%d\n", player[i].state);
	}
	fprintf(f, "ok\n");
	//如果judge无法初始化，错误退出
	fprintf(f, "starting\n");
	strcpy(buf, "null");
	if (!judge.start(judge_time, buf, buf)){
		my_exit(true);
		return 0;
	}
	fprintf(f, "chu shi wanchen\n");
	//return 0;
	//循环向judge询问操作
	int i = 0;
	while(true){
		//如果无法从judge得到回复，错误退出
		fprintf(f, "get\n");
		if (!judge.get(judge_time, buf)){
			my_exit(true);
			return 0;
		}
		++i;
		fprintf(f, "%d %s\n", i, buf);
		//sleep(1);
		if (strncmp(buf, "DEBU", 4) == 0){
			printf("%s\n", buf + 5);
		}
		if (strncmp(buf, "EXIT", 4) == 0){
			my_exit(false);
			sleep(1);
			return 0;
		}
		if (strncmp(buf, "STOP", 4) == 0){
			int i;
			sscanf(buf + 5, "%d", &i);
			player[i].create();
		}
		if (strncmp(buf, "STAR", 4) == 0){
			fprintf(f, "_______________find STAR\n");
			int i = buf[5] - '0';
			bool OK = player[i].start(player_time, buf + 7, buf);
			fprintf(f, "%d\n", OK);
			if (OK) strcpy(buf, "SUCC");
			else strcpy(buf, "ERRO");
			judge.print(buf);
		}
		if (strncmp(buf, "COMM", 4) == 0){
			int i = buf[5] - '0';
			bool OK = player[i].communicate(player_time, buf + 7, buf + 5);
			if (OK) strncpy(buf, "SUCC", 4);
			else strcpy(buf, "ERRO");
			judge.print(buf);
		}
	}
}
