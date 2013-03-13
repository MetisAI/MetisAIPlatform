import main
class Judge:
	def __init__(self, argv):
		#set the number of player
		self.playnum = 2;
		#winner = -1 means the game hasn't end
		#otherwise it is the index of the winner
		self.winner = -1;
		#nextstep = -2 means the game is starting 
		#nextstep = -1 means the judge want to test the round
		#otherwise means the judge want to send info[i] to the i'th program
		self.nextstep = -2;
		#this is the name of all the programs
		self.name = argv;
		#this is the init time given to every program by the judge
		self.inittime = 0.1;
		#this is the run time given to every program by the judge for every round
		self.runtime = 0.05;
		#this is the info which will be sent to the programs
		self.info = [None] * self.playnum;
		#this is the popen of every program
		self.popen = [];
		for i in range(self.playnum):
			self.popen += [main.open(argv[i], self.inittime)]



	#set the information to the program when game start
	def initinfo(self):
		for i in range(self.playnum):
			self.info[i] = str(i) + "\n";
		self.nextstep = 0;



	#judge the round
	def execute(self):
		self.winner = 0;



	#set the info returned by the program with index 'nextstep'
	#then set what to do of nextstep
	def get(self, a):
		self.info[self.nextstep] = a;
		self.nextstep = self.nextstep + 1;
		if (self.nextstep == self.playnum):
			self.nextstep = -1;

