<!DOCTYPE html>
<html lang="en">

<?php
session_start();

$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT t.sport, t.tournamentname, t.startdate, l.street, l.city, l.state FROM Tournament t JOIN Location l ON t.tournlocationID=l.LID');
$query->execute();
$result = $query->fetchAll(PDO::FETCH_NUM);
?>

<head>
	<title>Tournament List View</title>
	<link href="tournamentlist.css" type="text/css" rel="stylesheet">
</head>

<body>
	<header>
		<div class="pageheader">
			<table class="head">
				<tr>
					<td><a href="mytournaments.php">My Tournaments</a></td>
					<td><a href="profile.php">My Account</a></td>
				</tr>
			</table>
		</div>
	</header>
	<h1>Tournament List View</h1>
	<input type="text" placeholder="Search Tournaments..." class="search" id="search" oninput="filter()">
	<a href="calendar.php" class="calandar">Calendar View</a>
	<table class="tournamentlist">
		<thead>
			<tr>
				<th colspan="2">
					Tournament Info
				</th>
			</tr>
		</thead>
		<tbody id="tlist">
			<?php
			foreach ($result as $index => $info) {
				$rowNum = $index + 1;
				?>
				<tr class="tournament">
					<td onclick=<?php echo "location.href='tournamentregistry.php?tid=$rowNum'"; ?> style="cursor:pointer">
						<?php echo "$info[1]" ?><br>
						<?php echo "$info[0]" ?>
					</td>
					<td onclick=<?php echo "location.href='tournamentregistry.php?tid=$rowNum'"; ?> style="cursor:pointer">
						<?php echo "$info[2]" ?><br>
						<?php echo "$info[3] $info[4], $info[5]" ?>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<br>
	<br>
	<br>
	<br>
	<footer class="footer2">
		<div class="copyright">
			<p>&copy; 2023 Group 1-4 Inc. All Rights Reserved.</p>
		</div>
	</footer>
	<script>
		function filter() {
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById('search');
			filter = input.value.toUpperCase();
			table = document.getElementById('tlist');
			tr = table.getElementsByTagName('tr');

			for (i = 0; i < tr.length; i++) {
				var columns = tr[i].getElementsByTagName('td');
				var matchFound = false;

				for (j = 0; j < columns.length; j++) {
					td = columns[j];
					if (td) {
						txtValue = td.textContent || td.innerText;
						if (txtValue.toUpperCase().indexOf(filter) > -1) {
							matchFound = true;
							break;
						}
					}
				}
				if (matchFound) {
					tr[i].style.display = '';
				} else {
					tr[i].style.display = 'none';
				}
			}
		}
	</script>
</body>

</html>