CC = g++
CFLAGS = -static -I ./include
OBJS = person.o \
	arena.o
program: $(OBJS)
	$(CC) $(CFLAGS) -o arena $(OBJS) 
	make -C judge clean
	make -C judge program
	make -C ai0 clean
	make -C ai0 program
	make -C ai1 clean
	make -C ai1 program
	make clean
-include *.d
clean: 
	rm -f $(OBJS)
cleanall:
	make clean
	rm -f arena

