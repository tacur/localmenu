<?php
require 'db.php';
/* Log out process, unsets and destroys session variables */
session_start();
$user_email = $_SESSION['email'];
if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $client_ip = $_SERVER['REMOTE_ADDR'];
}
else {
    $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
$Time = time() + (2*60*60);
$loggingtime = date('Y-m-d H:i:s', $Time);
$sql2 = "INSERT INTO protokoll (Protokoll_TYP, Protokoll_TEXT, Protokoll_ZEIT, Protokoll_USER, Protokoll_IP) " 
        . "VALUES ('Logging','User ausgeloggt','$loggingtime', '$user_email', '$client_ip')";
$result_logging = $mysqli->query($sql2);
session_unset();
session_destroy(); 
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <title>Auf Wiedersehen!</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/myapp.js"></script>

  </head>
  <body>
<style>
.image3 {
  padding: 3px;
  max-height: 50px;
}
</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <center><div class="navbar-header">
      <img class="image3" src="img/logo.png">
    </div>
    </center>
</div>
</nav>
<div class="well">
  <center><h1>Danke für deinen Besuch!</h1>
          <p><?php echo 'Du bist jetzt ausgeloggt!'; ?></p> <br>
    </div>
  </center>
          <form action="login.php" method="post" autocomplete="off">
               <center> <button class="btn btn-success" name="startseite"/>Zur Anmeldeseite</button></center><br>
          </form>  
</body>
</html>
