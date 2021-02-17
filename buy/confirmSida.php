
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

    echo "Din bestälning: <br>";
    $table = "<div class='container'><div class='row' style='padding:60px'>
  <table class='table table-primary'>
  <tr><h3>Varukorg</h3></tr>
  <tr>
      <th></th>
      <th>Namn</th>
      <th>Förtfattare</th>
      <th>Pris</th>
  </tr>
  ";

    //require_once("header.php");

    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];

    $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        //echo("$epost is a valid email address");

        // Skapa en SQL-sats (förbereda en sats)

        $stmt = $conn->prepare("INSERT INTO customers (customer_name, email, tel, address)
                      VALUES (:customer_name ,:email, :tel, :address)");

        // Binda parametrar (binda variabler med platshållare)
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':address', $address);

        // Kör SQL-sats
        $stmt->execute();

        $last_id = $conn->lastInsertId();


            $stmt = $conn->prepare("INSERT INTO orders (customer, product)
          VALUES (:customer_id,:product_id)");
            $stmt->bindParam(':customer_id', $last_id);
            $stmt->bindParam(':product_id', $productID);

            $stmt->execute();

            $last_id = $conn->lastInsertId();

            $confirm = "<div  action='confirmSida.php'class='alert alert-success' role='alert'>
          <h2><hr><hr>Tack, $customer_name, för din beställning!</h2><br><hr><h4>Boken är på väg till dig. <hr></h4></p>
          </div>";
        

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

?>

    
