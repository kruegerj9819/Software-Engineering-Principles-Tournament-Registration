<!DOCTYPE html>
<html lang="en">

<?php
session_start();

//Query the database for tournament info
$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT t.sport, t.tournamentname, t.startdate, t.TID FROM Tournament t ORDER BY t.startdate asc');
$query->execute();
$result = $query->fetchAll(PDO::FETCH_NUM);
?>

<script>
	//Checks to see if there are any tournaments in the month
	//	Returns true if there are, false if there's none
	function isMonthPresent(begMonth, endMonth) {
		<?php
		foreach ($result as $info) {
			?>
			var temp = <?php echo "'$info[2]'"; ?>;
			if (temp >= begMonth && temp <= endMonth) {
				return true;
			}
			<?php
		}
		?>
		return false;
	}

	//Iterates through the month table so every date of the month is checked for
	//	a scheduled tournament. The HTML is edited with the tournament added if
	// there is one.
	function iterateThroughMonth(ref, month, year) {
		var table = document.getElementById(ref);
		var numRows = table.rows.length;
		//Month formatted correctly
		var correctMonth = year+"-"+month+"-";
		//Temp var to add to correctMonth each day
		var dayComp;
		//Loop through rows
		for (var i = 2; i < numRows; i++) {
			//Pulling the cells from the selected row
			var cells = table.rows.item(i).cells;

			//Number of cells in the row
			var numCells = cells.length;

			//Loops through each cell
			for (var j = 0; j < numCells; j++) {
				//We don't want the dates outside of the month
				if (!(cells.item(j).className == "notMonth")) {
					var tempDay = String(cells.item(j).innerHTML).padStart(2,'0');
					dayComp = correctMonth + tempDay;
					<?php
					foreach ($result as $data) {
					?>
						//If a tournament is found, add to the calendar
						if(<?php echo "'$data[2]'" ?> == dayComp) {
							cells.item(j).innerHTML += "<br/>";
							cells.item(j).innerHTML += <?php echo "'$data[1]'" ?>;
							cells.item(j).innerHTML += " - ";
							cells.item(j).innerHTML += <?php echo "'$data[0]'" ?>;
							//Making it clickable and directs to proper page
							cells.item(j).setAttribute("onclick","<?php echo "location.href='tournamentregistry.php?tid=$data[3]'"; ?>");
							cells.item(j).style="cursor:pointer";
						}
					<?php
					}
					?>
				}
			}
		}
	}
</script>

	<head>
		<link rel="stylesheet" href="calendar.css">
	</head>
	<body>
		<header>
		<div class="pageheader">
			<table class="head" style="height:auto;">
				<tr>
					<td><a href="mytournaments.php">My Tournaments</a></td>
					<td><a href="profile.php">My Account</a></td>
				</tr>
			</table>
		</div>
	</header>
	<h1 style="text-align:center; display:block; font-weight: bold;">Tournament Calendar View</h1>
	<a href="tournamentlist.php" class="listview">List View</a>
	
		<table border: 1px solid black id="November23">

			<script>
				begMonth = "2023-11-01";
				endMonth = "2023-11-30";
			</script>

			<tr class="tablehead">
				<th><a href="#November24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>November 2023</h1></th>
				<th><a href="#December23"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">25</td>
				<td class="notMonth">26</td>
				<td class="notMonth">27</td>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td>1</td>
			</tr>
			<tr>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
			</tr>
			<tr>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
			</tr>
			<tr>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
			</tr>
			<tr>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
			</tr>
			<tr>
				<td>30</td>
				<td class="notMonth">31</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
				<td class="notMonth">4</td>
				<td class="notMonth">5</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2023-11-01", "2023-11-30")) {
			iterateThroughMonth("November23", "11", "2023");
		}
		</script>
		
		<table border: 1px solid black id="December23">

			<tr class="tablehead">
				<th><a href="#November23"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>December 2023</h1></th>
				<th><a href="#January24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">26</td>
				<td class="notMonth">27</td>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td>1</td>
				<td>2</td>
			</tr>
			<tr>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
			</tr>
			<tr>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
			</tr>
			<tr>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
			</tr>
			<tr>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
			</tr>
			<tr>
				<td>31</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
				<td class="notMonth">4</td>
				<td class="notMonth">5</td>
				<td class="notMonth">6</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2023-12-01", "2023-12-31")) {
			iterateThroughMonth("December23", "12", "2023");
		}
		</script>
		
		<table border: 1px solid black id="January24">

			<tr class="tablehead">
				<th><a href="#December23"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>January 2024</h1></th>
				<th><a href="#February24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			<tr>
				<td class="notMonth">31</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
			</tr>
			<tr>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
			</tr>
			<tr>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
			</tr>
			<tr>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
			</tr>
			<tr>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td>31</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-01-01", "2024-01-31")) {
			iterateThroughMonth("January24", "01", "2024");
		}
		</script>
		
		<table border: 1px solid black id="February24">

			<tr class="tablehead">
				<th><a href="#January24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>February 2024</h1></th>
				<th><a href="#March24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td class="notMonth">31</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
			</tr>
			<tr>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
			</tr>
			<tr>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
			</tr>
			<tr>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
			</tr>
			<tr>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-02-01", "2024-02-29")) {
			iterateThroughMonth("February24", "02", "2024");
		}
		</script>
		
		<table border: 1px solid black id="March24">

			<tr class="tablehead">
				<th><a href="#February24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>March 2024</h1></th>
				<th><a href="#April24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">25</td>
				<td class="notMonth">26</td>
				<td class="notMonth">27</td>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td>1</td>
				<td>2</td>
			</tr>
			<tr>

				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
			</tr>
			<tr>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
			</tr>
			<tr>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
			</tr>
			<tr>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
			</tr>
			<tr>
				<td>31</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
				<td class="notMonth">4</td>
				<td class="notMonth">5</td>
				<td class="notMonth">6</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-03-01", "2024-03-31")) {
			iterateThroughMonth("March24", "03", "2024");
		}
		</script>
		
		<table border: 1px solid black id="April24">

			<tr class="tablehead">
				<th><a href="#March24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>April 2024</h1></th>
				<th><a href="#May24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">31</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
			</tr>
			<tr>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>

			</tr>
			<tr>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
			</tr>
			<tr>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
			</tr>
			<tr>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
				<td class="notMonth">4</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-04-01", "2024-04-30")) {
			iterateThroughMonth("April24", "04", "2024");
		}
		</script>
		
		<table border: 1px solid black id="May24">

			<tr class="tablehead">
				<th><a href="#April24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>May 2024</h1></th>
				<th><a href="#June24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
			</tr>
			<tr>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
			</tr>
			<tr>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
			</tr>
			<tr>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
			</tr>
			<tr>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td>31</td>
				<td class="notMonth">1</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-05-01", "2024-05-31")) {
			iterateThroughMonth("May24", "05", "2024");
		}
		</script>
		
		<table border: 1px solid black id="June24">

			<tr class="tablehead">
				<th><a href="#May24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>June 2024</h1></th>
				<th><a href="#July24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">26</td>
				<td class="notMonth">27</td>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td class="notMonth">31</td>
				<td>1</td>
			</tr>
			<tr>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
			</tr>
			<tr>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
			</tr>
			<tr>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
			</tr>
			<tr>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
			</tr>
			<tr>
				<td>30</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
				<td class="notMonth">4</td>
				<td class="notMonth">5</td>
				<td class="notMonth">6</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-06-01", "2024-06-30")) {
			iterateThroughMonth("June24", "06", "2024");
		}
		</script>
		
		<table border: 1px solid black id="July24">

			<tr class="tablehead">
				<th><a href="#June24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>July 2024</h1></th>
				<th><a href="#August24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">30</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
			</tr>
			<tr>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
			</tr>
			<tr>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
			</tr>
			<tr>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
			</tr>
			<tr>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td>31</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-07-01", "2024-07-31")) {
			iterateThroughMonth("July24", "07", "2024");
		}
		</script>
		
		<table border: 1px solid black id="August24">

			<tr class="tablehead">
				<th><a href="#July24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>August 2024</h1></th>
				<th><a href="#September24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td class="notMonth">31</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
			</tr>
			<tr>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
			</tr>
			<tr>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
			</tr>
			<tr>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
			</tr>
			<tr>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td>31</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-08-01", "2024-08-31")) {
			iterateThroughMonth("August24", "08", "2024");
		}
		</script>
		
		<table border: 1px solid black id="September24">

			<tr class="tablehead">
				<th><a href="#August24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>September 2024</h1></th>
				<th><a href="#October24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
			</tr>
			<tr>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>

			</tr>
			<tr>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
			</tr>
			<tr>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
			</tr>
			<tr>
				<td>29</td>
				<td>30</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
				<td class="notMonth">3</td>
				<td class="notMonth">4</td>
				<td class="notMonth">5</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-09-01", "2024-09-30")) {
			iterateThroughMonth("September24", "09", "2024");
		}
		</script>
		
		<table border: 1px solid black id="October24">

			<tr class="tablehead">
				<th><a href="#September24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>October 2024</h1></th>
				<th><a href="#November24"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
			</tr>
			<tr>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
				<td>10</td>
				<td>11</td>
				<td>12</td>
			</tr>
			<tr>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
				<td>18</td>
				<td>19</td>
			</tr>
			<tr>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
				<td>24</td>
				<td>25</td>
				<td>26</td>
			</tr>
			<tr>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td>31</td>
				<td class="notMonth">1</td>
				<td class="notMonth">2</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-10-01", "2024-10-31")) {
			iterateThroughMonth("October24", "10", "2024");
		}
		</script>
		
		<table border: 1px solid black id="November24">

			<tr class="tablehead">
				<th><a href="#October24"> <button type= "button"><h3>Previous</h3></button> </a></th>
				<th colspan="5"><h1>November 2024</h1></th>
				<th><a href="#November23"> <button type= "button"><h3>Next</h3></button> </a></th>
			</tr>
			<tr>
				<th>Sunday</th><br>
				<th>Monday</th><br>
				<th>Tuesday</th><br>
				<th>Wednesday</th><br>
				<th>Thursday</th><br>
				<th>Friday</th><br>
				<th>Saturday</th><br>
			</tr>
			
			<tr>
				<td class="notMonth">27</td>
				<td class="notMonth">28</td>
				<td class="notMonth">29</td>
				<td class="notMonth">30</td>
				<td class="notMonth">31</td>
				<td>1</td>
				<td>2</td>
			</tr>
			<tr>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				<td>8</td>
				<td>9</td>
			</tr>
			<tr>
				<td>10</td>
				<td>11</td>
				<td>12</td>
				<td>13</td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
			</tr>
			<tr>
				<td>17</td>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td>21</td>
				<td>22</td>
				<td>23</td>
			</tr>
			<tr>
				<td>24</td>
				<td>25</td>
				<td>26</td>
				<td>27</td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
			</tr>
		</table>

		<script>
		//Add tournaments that start in this month if there are any
		if(isMonthPresent("2024-11-01", "2024-11-30")) {
			iterateThroughMonth("November24", "11", "2024");
		}
		</script>

		<br>
		<footer>
			<div class="copyright">
				<p>&copy; 2023 Group 1-4 Inc. All Rights Reserved.</p>
			</div>
		</footer>
	</body>
	
</html>
