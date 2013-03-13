import subprocess
import signal
import judge
import sys

#open a program with the given name
#if the program print "init complete\n" before inittime ended
#the function will return a popen of this program
#otherwise will return null
def open(name, inittime):
	#extend the commond on the condition of the type of the program
	execmd = "";
	if (name[-1] == "y"):
		execmd = "python " + name;
	if (name[-1] == "e"):
		execmd = "./" + name;
	if (name[-1] == 's'):
		execmd = "java " + name;
	#try to init the popen of the program
	try:
		p = subprocess.Popen(execmd, stdin = subprocess.PIPE, stdout = subprocess.PIPE, stderr = subprocess.PIPE, shell = False);
	except:
		print "init can't find program"
		return None;
	#try to run the program if timeout colose the program
	success = True;
	try:
		signal.signal(signal.SIGALRM, open);
		signal.setitimer(signal.ITIMER_REAL, inittime);
		p.stdout.readline(),
		print "init success"
	except:
		success = False;
		print "init timeout"
	finally:
		signal.setitimer(signal.ITIMER_REAL, 0);
	if (success == False):
		p.kill();
		return None;
	else:
		return p;


#this function will try to send the info to the program the judge intend to
#if the program haven't inited successfully this function will return inmidiantly
#if the program haven't return the answer before runtime end, this function will try to restart the program, so be careful
#if there's no problem happend, this function will return an string
#otherwise return None
def read(judge):
	nextstep = judge.nextstep;
	p = judge.popen[nextstep];
	#test if the program is inited succefully
	if (p == None):
		print "read: can't find program reading stop"
		return None;
	if (judge.info[nextstep] == None):
		info = "";
	else:
		info = judge.info[nextstep];
	success = True;
	print info
	#try communicate with the program
	try:
		signal.signal(signal.SIGALRM, read);
		signal.setitimer(signal.ITIMER_REAL, judge.runtime);
		p.stdin.write(info);
		p.stdin.flush();
		s = p.stdout.readline(),
		print "read: success"
	except:
		success = False;
		print "read: timeout try:",
	finally:
		signal.setitimer(signal.ITIMER_REAL, 0);
	#if the program can't return an answer
	#the program will be killed and restarted
	if (success == False):
		p.kill();
		judge.popen[nextstep] = open(judge.name[nextstep], judge.inittime);
		return None;	
	return s;
	


#main
if __name__ == "__main__":
#	print open("1.exe", 0.1);
	print sys.argv
	jg = judge.Judge(sys.argv[1:]);
	while (jg.winner < 0):
		if (jg.nextstep == -2):
			jg.initinfo();
		elif (jg.nextstep == -1):
			jg.execute();
		else: 
			jg.get(read(jg));
