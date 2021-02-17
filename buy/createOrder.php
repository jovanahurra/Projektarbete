<?php

require_once('../database.php');

$title = "";
$author = "";
$price = "";
$id = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $productID = $_GET['product_id'];
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

    foreach ($result as $key => $value) {

        $id = $value['product_id'];  // Detta är en primärnyckel
        $table .= "
      <tr>
          <td><img src='../images/$value[image]' style='width: 50%'></td>
          <td>$value[title]</td>
          <td>$value[author]</td>
          <td>$value[price]</td> 
     </tr>
  ";
        $title = $value['title'];
        $author = $value['author'];
        $price = $value['price'];
    }
    $table .= "</table>";

    echo $table;
}

?>

<h4>Skriv dina uppgifter för att beställa boken:</h4>
<form action="confirmSida.php" class="row" method="post">

    <input type="hidden" name="id" value="<?php echo $id ?>">

    <div class="col-md-12 my-2">
        <label for="bok">Bok</label>
        <input type="text" id="bok" class="form-control" name="bok" value="<?php echo $title ?>" readonly>
    </div>

    <div class="col-md-6 my-2">
        <label for="author">Förtfattare</label>
        <input type="text" id="author" class="form-control" name="Författare" value="<?php echo $author ?>" readonly>
    </div>

    <div class="col-md-6 my-2">
        <label for="price">Pris</label>
        <input type="text" id="price" class="form-control" name="Pris" value="<?php echo $price ?>" readonly>
    </div>



    <div class="col-md-6 my-2">
        <label for="name">Namn</label>
        <input type="text" id="name" class="form-control" name="customer_name" placeholder="Ditt namn.." required>
    </div>

    <div class="col-md-6 my-2">
        <label for="epost">E-mail</label>
        <input type="email" id="epost" class="form-control" name="email" placeholder="Ditt mail.." required>
    </div>

    <div class="col-md-6 my-2">
        <label for="tel">Telefon</label>
        <input type="text" id="tel" class="form-control" name="tel" placeholder="Ditt telefonnummer.." required>
    </div>

    <div class="col-md-12 my-2">
        <label for="adress">Adress</label>
        <textarea type="text" id="adress" name="address" placeholder="Skriv din adress" required></textarea>
    </div>

    <div class="col-md-4 my-2">
        <input type="submit" value="Beställa" class="form-control btn btn-outline-dark">
    </div>
</form>