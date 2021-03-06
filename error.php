
<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <title>Willkommen <?= $first_name.' '.$last_name ?></title>
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
    <img src="img/logo.png" style="max-width: 50%; max-height: 200px;margin: auto;display: block;">
    </div>
    </center>
</div>
</nav>
<div class="well">
<div class="container">
<div class="error" style="text-align:center;">
    <h1>Fehler!</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];
        session_start();
        session_unset();
        session_destroy();

    else:
        header( "location: login.php" );
    endif;
    ?>
    </p>
    <form action="login.php" method="post" autocomplete="off">
             <center> <button class="btn btn-success" name="startseite"/>Startseite</button></center>
    </form><br>     
</div>
</div>
  </div>
</body>
</html>
