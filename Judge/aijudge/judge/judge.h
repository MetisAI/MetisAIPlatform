#ifndef __JUDGE_H__
#define __JUDGE_H__
#include "include/othello.h"
#include <cstdio>
#include <cstdarg>
#include <iostream>
#include <cstdlib>
using namespace std;
class judge{
	othello o;
	char buf[1024];
	public:
	judge();
	int state[2];
	bool player_init(int id);
	void judge_com(int id);
	void judge_debug(const char *format, ...);
	void judge_exit(int id);
	void run();
	void init(const char *s);
};
#endif
