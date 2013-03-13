#ifndef __PERSON_H__
#define __PERSON_H__
#include "arena.h"
class person{
	int pid;
	FILE *in, *out;
	string name;
	public:
	int state;
	person();
	void stop();
	bool start(int time, char *o, char *i);
	bool create(string s);
	bool create();
	bool communicate(int time, char *o, char *i);
	bool get(int time, char *s);
	void print(char *s);
};
#endif
