
<?php
/* User login process, checks if user exists and password is correct */
require 'db.php';
session_start();
// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
// $result1 = $mysqli->query("SELECT * FROM aufgaben");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "Benutzer mit dieser E-Mail-Adresse existiert nicht!";
    header("location: error.php");
}
else { // User exists
    // if ($result->fetch_assoc()) {
        $user = mysqli_fetch_assoc($result);
        // $passHash = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
           if ( password_verify($_POST['password'], $user['password']) ) {
           //if ( password_verify($_POST['password'], $hash) ) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['active'] = $user['active'];
                $_SESSION['admin'] = $user['admin'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['telefonnummer'] = $user['telefonnummer'];
                $_SESSION['profilbild'] = $user['profilbild'];
                $_SESSION['kunde_id'] = $user['id'];
                $_SESSION['logged_in'] = 1;
                
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
                        . "VALUES ('Logging','User eingeloggt','$loggingtime', '$user_email', '$client_ip')";
                $result_logging = $mysqli->query($sql2);
                header("location: profile.php");
            }
            else {
                $_SESSION['message'] = 'Das Passwort ist falsch! Versuchen Sie es nochmal!';
                header("location: error.php");
            }
   /* } 
    else {
        $_SESSION['message'] = "fetch_assoc hat wohl nicht geklappt!";
        header("location: error.php");
    }
    */
}

