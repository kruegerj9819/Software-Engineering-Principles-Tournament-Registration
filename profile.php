<!DOCTYPE html>
<html lang="en">

<?php
session_start();
//accessing the database for user info
$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT * FROM Participant p WHERE p.PID=:partID');
$query->execute([ ':partID' => $_SESSION['id']]);
$usersInfo = $query->fetch(PDO::FETCH_NUM);

//Users Info
$firstName = $usersInfo[1];
$lastName = $usersInfo[2];
$userName = $usersInfo[3];
$userLocationID = $usersInfo[5];
$_SESSION['locationID'] = $userLocationID;

//accessing the database for location info
$query = $conn->prepare('SELECT * FROM Location L WHERE L.LID=:locID');
$query->execute([':locID' => $userLocationID]);
$locationInfo = $query->fetch(PDO::FETCH_NUM);

//Location Info
$street = $locationInfo[1];
$city = $locationInfo[2];
$state = $locationInfo[3];
$zip = $locationInfo[4];

//accessing users team info
$query = $conn->prepare('SELECT * From ParticipantTeam pt WHERE pt.PID = :partID');
$query->execute([ ':partID' => $_SESSION['id']]);
$teams = $query->fetchAll(PDO::FETCH_NUM);
?>
<html>

<head>
    <title>Account Information</title>
    <link href="profile.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <div class="pageheader">
            <table class="head">
                <tr>
                    <td><a href="tournamentlist.php">Tournament List</a></td>
					<td><a href="mytournaments.php">My Tournaments</a></td>
                </tr>
            </table>
        </div>
    </header>
    <form action="updateprofile.php" method = "post">
        <div class = "Info">
            <h1>Account Information</h1><br>
            <!--This is for displaying all the basic user info-->
            <div class = BasicInfo>
                <p class = "Personal">First Name: <?php echo $firstName; ?> </p><textarea class = "Prompt" id = "FirstName" name = "FirstName" placeholder="first name" cols=40><?php echo $firstName; ?></textarea>
                <p class = "Personal">Last Name: <?php echo $lastName; ?> </p><textarea class = "Prompt" id = "LastName" name = "LastName" placeholder="last name" cols=40><?php echo $lastName; ?></textarea>
                <p class = "Personal">UserName: <?php echo $userName; ?> </p><textarea type="text" class = "Prompt" id = "UserName" name = "UserName" placeholder="username" cols=40><?php echo $userName; ?></textarea>
            </div>
            <!--This is for deisplaying the location info-->
            <div class = LocationInfo>
                <p class = "Personal">Street: <?php echo $street; ?> </p><textarea class = "Prompt" id = "Street" name = "Street" placeholder="street" cols=40><?php echo $street; ?></textarea>
                <p class = "Personal">City: <?php echo $city; ?> </p><textarea class = "Prompt" id = "City" name = "City" placeholder="city" cols=40><?php echo $city; ?></textarea>
                <p class = "Personal">State: <?php echo $state; ?> </p><textarea class = "Prompt" id = "State" name = "State" placeholder="state" cols=40><?php echo $state; ?></textarea>
                <p class = "Personal">Zip: <?php echo $zip; ?> </p><textarea class = "Prompt" id = "ZipCode" name = "ZipCode" placeholder="zip code" cols=40><?php echo $zip; ?></textarea>
            </div>
            <!--This is for deisplaying the team info-->
            <div class = TeamInfo>
                <p>Teams:</p>
                <!--Looping through each team -->
                <?php foreach ($teams as $teamsInfo => $team): ?>
                    <p> <?php echo $team[1]; ?> </p>
                    <?php endforeach;?>
            </div>
            <button type = "button" onclick = "editMode()" class = "Personal">Edit</button>
            <button type = "submit" class = "Prompt">Update</button>
        </div>
    </form>
    <footer class="footer2">
		<p class="copyright">&copy; 2023 Group 1-4 Inc. All Rights Reserved.</p>
	</footer>
    <script>
        //This changes all the text into textboxes for the user to edit
        function editMode(){
            var TextBoxes = document.getElementsByClassName("Prompt");
            var UserInfo = document.getElementsByClassName("Personal");
            for(let textBox = 0; textBox < TextBoxes.length; textBox++){
                TextBoxes[textBox].style.display = "block";
                UserInfo[textBox].style.display = "none";
            }
        }
    </script>
</body>

</html>
