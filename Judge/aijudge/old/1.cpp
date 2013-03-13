#include<iostream>
using namespace std;
int t = 0;
int main(){
	while (t < 1000) ++t;
	cout<<"init complete"<<endl;
	while (true){
		int n;
		cin>>n;
		usleep(50);

		cout<<n<<"hehe"<<t<<endl;
	}
};
