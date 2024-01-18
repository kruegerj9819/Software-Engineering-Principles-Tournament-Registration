<?php
session_start();

$newFirstName = htmlspecialchars($_POST['FirstName']);
$newLastName = htmlspecialchars($_POST['LastName']);
$newUserName = htmlspecialchars($_POST['UserName']);
$newStreet = htmlspecialchars($_POST['Street']);
$newCity = htmlspecialchars($_POST['City']);
$newState = htmlspecialchars($_POST['State']);
$newZip = htmlspecialchars($_POST['ZipCode']);

//Updating user profile
$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('UPDATE Participant p SET p.firstname = :newFirstName, p.lastname = :newLastName, p.username = :newUserName WHERE p.PID = :partID');
$query->execute([':newFirstName'=> $newFirstName,':newLastName'=>$newLastName,':newUserName'=>$newUserName, ':partID'=>$_SESSION['id']]);

//Updating Location ID - Will change for everyone with this location ID
$query = $conn->prepare('UPDATE Location L SET L.street = :newStreet, L.city = :newCity, L.state=:newState, L.zip=:newZip where L.LID=:locationID');
$query->execute([':newStreet'=>$newStreet, ':newCity'=> $newCity, ':newState'=>$newState,':newZip'=>$newZip, ':locationID'=>$_SESSION['locationID']]);

header('Location:profile.php');
die();
?>
