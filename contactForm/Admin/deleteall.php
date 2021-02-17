<?php
    
/***************************************
 * 
 *            DELETE ALL
 *          Ta bort allt
 * 
 ***************************************/

require_once ("header.php");
require_once ("../database.php");

//$id = $_GET['id'];


$sql = "DELETE FROM messages";
$stmt = $conn->prepare($sql);
//$stmt->bindParam(':id', $id);
$stmt->execute();
$rowCount = $stmt->rowCount();

require_once("admin.php");

$message = "<div class='alert alert-danger' role='alert'>
                <p>$rowCount rad har raderats!</p>
            </div>";  

echo $message;