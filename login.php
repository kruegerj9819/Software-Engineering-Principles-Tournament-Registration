<?php
// This php form handles the login into the system.

$username = $_POST['username'];
$password = $_POST['password'];

$conn = new PDO('mysql:host=167.99.227.133:3306;dbname=AgileExpG14;charset=utf8', 'admin14', 'bind14truth');
$query = $conn->prepare('SELECT * FROM Participant p WHERE p.username=:user AND p.password=:pw');
$query->execute([':user' => $username, ':pw' => $password]);
$result = $query->fetch(PDO::FETCH_NUM);

// If there is anything in result then the username and password are a match.
if ($result) {
  session_start();
  $_SESSION['id'] = $result[0];
  $_SESSION['loggedIn'] = true;
  header('Location:tournamentlist.php');
  die();
} else {
  header('Location:index.html');
  echo "<script> console.log('Incorrect Username/Password');</scrip>";
  die();
}
?>