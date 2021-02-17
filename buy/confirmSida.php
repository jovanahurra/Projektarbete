
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
    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate e-mail
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

            $confirm = "<div  action='confirmSida.php' style='padding-top: 60px; text-align: center'>
          <h2><hr>Tack, $customer_name, för din beställning!</h2>
          <br><hr><h4>Boken är på väg till dig.<br>
          Översikt på din beställning:
          <div style='display: flex; justify-content: center; align-items: center'>
          <table ><tr style:>
          <td>Titel: $_POST[bok]</td></tr> 
          <tr><td>Författare: $_POST[Författare]</td></tr>
          <tr><td>Pris: $_POST[Pris] kr</td> </tr>
            </table>
            </div>
            </h4>          
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

    
