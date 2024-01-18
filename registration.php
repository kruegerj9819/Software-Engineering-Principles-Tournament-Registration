<!DOCTYPE html>

<?php
session_start();
$tID= $_GET['tid'];//get TID from URL
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
}else {
    header('Location: ');
    echo "<script> console.log('You have to be logged in to register for a tournament');</scrip>";
    die();// User is not logged in, fails
}

$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT pt.teamname
FROM Participant p
JOIN ParticipantTeam pt
ON p.PID = pt.PID
WHERE pt.PID= :userID');
$query->execute([':userID'=> $_SESSION['id']]);
$result = $query->fetch(PDO::FETCH_ASSOC);//get PID from session, use query to get teamname

$teamName = $result['teamname'];
// Check if a row was returned
if (!$result) {
	echo "<h1>You must be in a team</h1>";
	die();
}

$qInTeam = $conn->prepare('SELECT tt.teamname, tt.tournID FROM TournamentTeam tt 
WHERE tt.teamname = :tName AND tt.tournID = :tid');
$qInTeam->execute([':tName' => $teamName, ':tid' => $tID]);
$rInTeam = $qInTeam->fetch(PDO::FETCH_NUM);

if(!$rInTeam){
	$queryFK0 = $conn->prepare('SET FOREIGN_KEY_CHECKS = 0');
	$queryFK0->execute();

	$query2 = $conn->prepare('INSERT INTO TournamentTeam (tournID, teamname)
	VALUE (:TID,:teamname)');
	$query2->execute([':TID'=> $tID, ':teamname' => $teamName]);

	$queryFK1 = $conn->prepare('SET FOREIGN_KEY_CHECKS = 1');
	$queryFK1->execute();
}
//Insert entry into Team tournament

?>

<html lang="en">
<head>
	<title>Successful Registration</title>
	<link href="tournamentlist.css" type="text/css" rel="stylesheet">
</head>
<body>
	<header>
		<div class="pageheader">
			<table class="head">
				<tr>
					<td><a href="tournamentlist.php">Tournament List</a></td>
					<td><a href="mytournaments.php">My Tournaments</a></td>
					<td><a href="profile.php">My Account</a></td>
				</tr>
			</table>
		</div>
	</header>
	<?php
	if (!$rInTeam) {
		echo "<h1> You Successfully Registered </h1>";
	} else{
		echo "<h1> Your team is already registered </h1>";
	}	
	?>
	<footer class = "footer2">
        <div class="copyright">
            <p>&copy; 2023 Group 1-4 Inc. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>