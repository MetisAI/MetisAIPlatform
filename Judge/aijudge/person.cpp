#include "include/person.h"
person::person(){
	state = 0;
	in = NULL;
	out = NULL;
}
bool person::start(int time, char *o, char *i){
	return communicate(time, o, i);
}

bool person::communicate(int time, char *o, char *i){
	//printf("communicating %s\n", name.c_str());
	if (!(state&1)) return false;
	print(o);
	return get(time, i);
}

void person::print(char *s){
	//printf("  %s\n", s);
	//printf("print\n");
	fprintf(out, "%s\n", s);
	fflush(out);
}

bool person::get(int time, char *s){
	//增加错误控制
	//printf("reading\n");
	fscanf(in, "%[^\n]", s);
	while('\n' != fgetc(in));
	//printf("%s\n", s);
	return true;
	create();
	return false;
}


void person::stop(){
	fclose(in);
	fclose(out);
	kill(pid, SIGKILL);
	state = 0;
	pid = 0;
}

bool person::create(string s){
	name = s;
	return create();
}
bool person::create(){
	if (state&1){
		stop();
	}
	int pipe_fdr[2];
	int pipe_fdw[2];
	//打开管道
	if (pipe(pipe_fdr) == -1)
		return false;
	if (pipe(pipe_fdw) == -1)
		return false;
	pid = fork();
	if (pid == 0){/*子进程操作*/
		//freopen("fuck", "w", stdout);
		
		if (dup2(pipe_fdr[0], 0) == -1)
			return false;
		close(pipe_fdr[0]);
		close(pipe_fdr[1]);
		if (dup2(pipe_fdw[1], 1) == -1)
			return false;
		close(pipe_fdw[0]);
		close(pipe_fdw[1]);
		char buf[4096];
		//printf("fuck\n");
		//cout<<name<<endl;
		scanf("%s", buf);
		//if (name == "ai0/program") scanf("%s", buf);
		//FILE *err;
		//err = fopen("out.txt", "a");
		//fprintf(err, "fuck%s\n", buf);
		//fclose(err);
		//printf("%s\n", buf);
		execl(name.c_str(), "program", buf, NULL);
	}else{/*父进程操作*/ 
		close(pipe_fdr[0]); 
		close(pipe_fdw[1]);
		out = fdopen(pipe_fdr[1], "w"); 
		in = fdopen(pipe_fdw[0], "r");  
		//printf("fuck\n");
		return state = 1;
	}
}
