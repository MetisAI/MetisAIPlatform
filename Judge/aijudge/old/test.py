import subprocess
import signal
import judge
def read(name, p, timeout, data):
	s = "";
	print data,
	try:
		signal.signal(signal.SIGALRM, read);
		signal.setitimer(signal.ITIMER_REAL, 0.055);
		p.stdin.write(data);
		p.stdin.flush();
		s = p.stdout.readline(),
		print "success"
	except:
		print "timeout"
	finally:
		print "final"
		signal.setitimer(signal.ITIMER_REAL, 0);
	return s;
if __name__ == "__main__":
	p1 = subprocess.Popen("./1.out", stdin = subprocess.PIPE, stdout = subprocess.PIPE, stderr = subprocess.PIPE, shell = False);
	p2 = subprocess.Popen("./2.out", stdin = subprocess.PIPE, stdout = subprocess.PIPE, stderr = subprocess.PIPE, shell = False);
	for i in range(2):
		print read("./1.out", p1, 6, str(i) + '\n');
	judge = judge.Judge();

#p1.stdin.write(str(i));
#		p1.stdin.write('\n');
#		p1.stdin.flush();
	
#		s = p.stdout.readline();
#		print p1.stdout.readline(),
#		p2.stdin.write(str(i));
#		p2.stdin.write('\n');
#		p2.stdin.flush();
#		print p2.stdout.readline(),


