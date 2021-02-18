<?php
require_once('header.php');
require('../database.php');

$title = "";
$author = "";
$price = "";
$id = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productID = $_POST['id'];
   

    $stmt = $conn->prepare("SELECT *, authors.author 
                        FROM (products INNER JOIN authors ON products.author = authors.authors_id) 
                        WHERE products.product_id = $productID");
    $stmt->execute();
    $result = $stmt->fetchAll();

    

    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];

    $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

        $stmt = $conn->prepare("INSERT INTO customers (customer_name, email, tel, address)
                      VALUES (:customer_name ,:email, :tel, :address)");

        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':address', $address);

        $stmt->execute();

        $last_id = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO orders (customer, product)
          VALUES (:customer_id,:product_id)");
        $stmt->bindParam(':customer_id', $last_id);
        $stmt->bindParam(':product_id', $productID);
        $stmt->execute();

        $last_id = $conn->lastInsertId();

      
        echo "<br><br><br><img src='../images/blog-10.jpg'  alt='första bild' 
                  style='float:left; padding:20px; width:auto; background:#c7ffff'><br>";
        $confirm = "<br><br><br><br><br><br><br><br><br><br>
                    <div  action='confirmOeder.php'style='padding-top: 60px; text: center'>
                    <h3><hr>Tack, $customer_name, för din beställning!</h3>
                    <br><h4>Boken är på väg till dig.</h4><hr><hr>
                    <b>Översikt på din beställning:</b>
                    <div style='display: flex; justify-content: center; align-items: center'>
                    <table>
                      <tr><td><b>Ordernummer:</b> $last_id</td></tr> 
                      <tr><td><b>Titel:</b> $_POST[book]</td></tr> 
                      <tr><td><b>Författare:</b> $_POST[author]</td></tr>
                      <tr><td><b>Pris:</b> $_POST[price] </td> </tr>
                    </table>
                    </div>
             
                    </div><hr>";

        if (isset($confirm)) {
            echo $confirm;
        } else {
            $epostarror = "<div class='alert alert-danger' role='alert'>
                        <h2>Du har anget ett ogiltigt email!</h2>
                    </div>";
            echo $epostarror;
        }
    }
}
require_once('footer.php');
