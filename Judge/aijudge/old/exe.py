import subprocess  
  
p = subprocess.Popen("./app2.exe", stdin = subprocess.PIPE, stdout = subprocess.PIPE, stderr = subprocess.PIPE, shell = False)  
  
p.stdin.write('3/n')  
p.stdin.write('4/n')  
print p.stdout.read()  
