import subprocess
if __name__ == "__main__":
	print "start"
	p1 = subprocess.Popen("./3.out", stdin = subprocess.PIPE, stdout = subprocess.PIPE, stderr = subprocess.PIPE, shell = False);
	p1.stdin.write("1 2\n");
	p1.stdin.flush();
	s = p1.stdout.readline();
	print s;

