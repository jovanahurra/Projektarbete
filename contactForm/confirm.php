<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

require_once("../database.php");
require_once("header.php");

$name = $_POST['name'];
$email = $_POST['email'];
$info = $_POST['info'];


$name = filter_var($name, FILTER_SANITIZE_STRING);
$info = filter_var($info, FILTER_SANITIZE_STRING);
// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    //echo("$epost is a valid email address");

// Skapa en SQL-sats (förbereda en sats)
$stmt = $conn->prepare("INSERT INTO messages (name, email, info)
                        VALUES (:name , :email, :info)");

// Binda parametrar (binda variabler med platshållare)
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':info', $info);

// Kör SQL-sats
$stmt->execute();

// Hämta sista id som infogats auto-increment
$last_id = $conn->lastInsertId();

//echo "<p>$name har sparats i databasen med id=$last_id</p>";

/*$message = "<div class='alert alert-success' role='alert'>
            <p>$name har sparats i databasen med id=$last_id</p>
            </div>";  */
$confirm = "<div  action='confirm.php'class='alert alert-success' role='alert'>
            <h2>Tack $name!</h2><br>Här kommer en kopia på ditt meddelande: <hr> $info <hr></p>
            </div>";             

    //if(isset($message)) echo $message;
    if(isset($confirm)) echo $confirm; 
    } else {
    $epostarror = "<div class='alert alert-danger' role='alert'>
                    <h2>Du har anget ett ogiltigt email!</h2>
                </div>";

    echo $epostarror;
}
}
 ?>
 
 
 
 