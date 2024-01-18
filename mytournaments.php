<!DOCTYPE html>
<html lang="en">

<?php
session_start();

$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT pt.*, tr.tournamentname, tr.sport, tr.startdate, l.street, l.city, l.state, tr.TID
FROM ParticipantTeam pt
JOIN Team t ON pt.teamname = t.teamname
JOIN TournamentTeam tt ON t.teamname = tt.teamname
JOIN Tournament tr ON tt.TournID = tr.TID
JOIN Location l ON tr.tournlocationid = l.LID
WHERE pt.PID = :partID');

$query->execute([':partID' => $_SESSION['id']]);
$participantTeams = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
	<title>My Tournaments</title>
	<link href="tournament.css" type="text/css" rel="stylesheet">
</head>
<body>
	<header>
		<div class="pageheader">
			<table class="head">
				<tr>
			
					<td><a href="tournamentlist.php">Tournament List</a></td>
					<td><a href="profile.php">My Account</a></td>
				</tr>
			</table>
		</div>
	</header>
	<h1>My Tournaments</h1>
	<table class="tournamentlist">
		<tr>
			<th colspan="2">
				Tournament Info
			</th>
		</tr>
		<?php
		if (!$participantTeams) {
		?>
			<tr class="tournament">
				<td colspan="2">You are not registered for any tournaments.</td>
			</tr>
		<?php
		} else {
			foreach ($participantTeams as $participantTeam) {
			?>
			<tr class="tournament">
				<td onclick="location.href='withdrawtournament.php?tid=<?php echo $participantTeam['TID']; ?>'" style="cursor:pointer;">
					<?php echo $participantTeam['tournamentname']; ?><br>
					<?php echo $participantTeam['sport']; ?>
				</td>
				<td onclick="location.href='withdrawtournament.php?tid=<?php echo $participantTeam['TID']; ?>'" style="cursor:pointer;">
					<?php echo $participantTeam['startdate']; ?><br>
					<?php echo $participantTeam['street'] . ', ' . $participantTeam['city'] . ', ' . $participantTeam['state']; ?>
				</td>
			</tr>
			<?php
			}
		}
		?>
	</table>
	<footer>
        <div class="copyright">
            <p>&copy; 2023 Group 1-4 Inc. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>