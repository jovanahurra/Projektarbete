<?php

/****************************************
 * 
 *                Admin sida
 * Läs tabellen messages från databasen
 * Presentera resultatet i en HTML-tabell
 * 
 ***************************************/

 // Hämta $conn (en instans av PDO)
 require_once ("header.php");
 require_once ("../database.php");

 // Förbered en SQL-sats
 $stmt = $conn->prepare("SELECT * FROM messages");

 // Kör SQL-satsen
 $stmt->execute();

 // Hämta alla rader som finns i messages
 // fetchAll()
 // Returns an array containing all of the result set rows
 $result = $stmt->fetchAll();

 $table = "
    <table class='table table-hover'>
    <tr>
        <th>Namn</th>
        <th>E-post</th>
        <th>Meddelande</th>
        <th>Admin</th>
    </tr>
    ";

 foreach($result as $key => $value){


    $id = $value['message_id'];  // Detta är en primärnyckel

    $table .= "
        <tr>
            <td>$value[name]</td>
            <td>$value[email]</td>
            <td>$value[info]</td>
            <td>
                <a href='delete.php?message_id=$value[message_id]'>Ta bort</a>
            </td>
        </tr>
    ";

 }

 $table .= "</table>";


     $deleteall=" 
              <div class='bottom'>
              <a href='deleteall.php' class='btn btn-large btn-info' target='_blank'>
              Ta bort allt</a>
              </div>";

 echo $table;
 echo $deleteall;
