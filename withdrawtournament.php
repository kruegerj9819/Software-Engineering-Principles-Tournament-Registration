<!DOCTYPE html>
<html lang="en">

<?php 
$tid = $_GET['tid'];
$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT t.sport, t.tournamentname, t.regdeadline, t.startdate, t.starttime, l.street, l.city, l.state, l.zip, t.regdeadline
FROM Tournament t
JOIN Location l
ON t.tournlocationID = l.LID
WHERE t.TID = :tid');

$query->execute([':tid' => $tid]);
$result = $query->fetch(PDO::FETCH_NUM);
?>

<head>
	<title>Withdraw</title>
	<link href="tournament.css" type="text/css" rel="stylesheet">
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
	<table class="tinfo">
		<tr>
			<th>Tournament Information:</th>
			<th>Tournament Location:</th>
			<th>Tournament Deadline:</th>
		</tr>
		<tr>
			<td>Tournament Name <?php echo"$result[1]" ?></td>
			<td>Street: <?php echo"$result[5]" ?></td>
			<td>Start Date: <?php echo"$result[3]";?>, Start Time: <?php echo"$result[3]";?> <td>
		</tr>
		<tr>	
			<td>Sport: <?php echo"$result[0]";?></td>
			<td>City: <?php echo"$result[6]";?>, State: <?php echo"$result[7]";?>, Zip: <?php echo"$result[8]";?> </td>
			<td>Registration Deadline <?php echo"$result[9]";?></td>
		</tr>
	</table>
	<button type="button" class="reg" onclick=<?php echo"location.href='dropFromTourn.php?tid=$tid'";?>>Withdraw</button>
	<footer>
        <div class="copyright">
            <p>&copy; 2023 Group 1-4 Inc. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>