#include<iostream>
using namespace std;
const int MAXN = 100000;
void deal(int a){
	cout<<a<<endl;
	deal(a + 1);
}
int main(){
	deal(0);
}
