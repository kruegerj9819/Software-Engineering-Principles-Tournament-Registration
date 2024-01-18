<!-- Created by Brian Wahl 12/2/23 revised 12/13 -->

<?php
session_start();
//check to see if participant is logged in
$tID= $_GET['tid'];//get TID from URL
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {//check to see if participant is logged in
}else {
    header('Location: ');
    echo "<script> console.log('You have to be logged in to drop from a tournament');</scrip>";
    die();// User is not logged in, fails
}

$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth'); //connect to the sever

$query = $conn->prepare('SELECT pt.teamname
FROM Participant p
JOIN ParticipantTeam pt
ON p.PID = pt.PID
WHERE pt.PID= :userID');
$query->execute([':userID'=> $_SESSION['id']]);
$result = $query->fetch(PDO::FETCH_ASSOC);
$teamName = $result['teamname'];

if (!$result) {
	echo "<h1>You must be in a team</h1>";
	die();
}

$qInTeam = $conn->prepare('SELECT tt.teamname, tt.tournID FROM TournamentTeam tt 
WHERE tt.teamname = :tName AND tt.tournID = :tid');
$qInTeam->execute([':tName' => $teamName, ':tid' => $tID]);
$rInTeam = $qInTeam->fetch(PDO::FETCH_NUM);

if($rInTeam){
	$queryFK0 = $conn->prepare('SET FOREIGN_KEY_CHECKS = 0');
	$queryFK0->execute();

	$query2 = $conn->prepare('DELETE 
  FROM TournmentTeam pt
  WHERE pt.teamname = :teamname and pt.PID = :participantID;');
	$query2->execute([':TID'=> $tID, ':teamname' => $teamName]);

	$queryFK1 = $conn->prepare('SET FOREIGN_KEY_CHECKS = 1');
	$queryFK1->execute();

	echo "<h1> You droped from the tournament </h1>";
	echo "<h3> $teamName </h3>";
} else{
	echo "<h1> Your team isn't registered </h1>";
}
$query2 = $conn->prepare('DELETE 
FROM TournmentTeam pt
WHERE pt.teamname = :teamname and pt.PID = :participantID;');



?>