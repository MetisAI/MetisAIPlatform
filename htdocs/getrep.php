<?php
	$s="start
START 0
START 1
MOVE 1 2 4
MOVE 2 2 3
MOVE 1 1 2
MOVE 2 1 3
MOVE 1 0 2
MOVE 2 0 1
MOVE 1 0 0
MOVE 2 0 3
MOVE 1 0 4
MOVE 2 1 5
MOVE 1 1 4
MOVE 2 0 5
MOVE 1 0 6
MOVE 2 1 6
MOVE 1 2 1
MOVE 2 1 1
MOVE 1 2 0
MOVE 2 1 0
MOVE 1 2 2
MOVE 2 2 5
MOVE 1 1 7
MOVE 2 0 7
MOVE 1 2 6
MOVE 2 2 7
MOVE 1 3 5
MOVE 2 3 0
MOVE 1 4 0
MOVE 2 4 5
MOVE 1 5 2
MOVE 2 4 2
MOVE 1 3 2
MOVE 2 4 1
MOVE 1 4 6
MOVE 2 5 3
MOVE 1 3 6
MOVE 2 3 1
MOVE 1 5 1
MOVE 2 3 7
MOVE 1 4 7
MOVE 2 5 0
MOVE 1 5 4
MOVE 2 5 5
MOVE 1 5 6
MOVE 2 5 7
MOVE 1 6 0
MOVE 2 6 1
MOVE 1 6 2
MOVE 2 6 3
MOVE 1 6 4
MOVE 2 6 5
MOVE 1 6 6
MOVE 2 7 0
MOVE 1 7 1
MOVE 2 7 2
MOVE 1 7 3
MOVE 2 7 4
MOVE 1 6 7
MOVE 2 7 5
MOVE 1 7 6
MOVE 2 7 7
REPORT 40 24
WINNERR 0
EXIT
";
echo json_encode($s);
?>