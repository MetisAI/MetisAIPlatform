#include<iostream>
#include<cstdio>
using namespace std;
const int MAXN = 100000;
int f[MAXN];
void dfs(int i){
	int a[1000];
	cout<<i<<endl;
	dfs(++i);
}
int main(){
	//dfs(0);
	freopen("in.txt", "r", stdin);
	freopen("out.txt", "w", stdout);
	FILE *f1 = fopen("a.in", "r");
	FILE *f2 = fopen("b.in", "r");
	FILE *f3 = fopen("c.in", "r");
	FILE *f4 = fopen("d.in", "r");
	cerr<<"hehe"<<endl;
}
