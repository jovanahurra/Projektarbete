<!doctype html>
<html lang="sv">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../Projektarbete/WebShop-Bootstrap/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <title>WebShop</title>
  <style>
        img {
            width: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            margin-bottom: auto;
            padding: 20px 0;
        }
    </style>
</head> 

<body class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../Projektarbete/index.php">Bokhandel</a>
            <a class="navbar-brand" href="../Projektarbete/contactForm/index.php" target='_blank'>Kontakt</a>
            <a href="../Projektarbete/contactForm/Admin/index.php" target='_blank' class="btn btn-primary btn-lg" role="button">Admin</a>
        </div>
    </nav>  
      
<?php
require_once ('database.php');
$stmt = $conn->prepare("SELECT *, authors.author 
                        FROM (products INNER JOIN authors ON products.author = authors.authors_id)");
$stmt->execute();
$result = $stmt->fetchAll();

echo "<div class='row'>";

foreach($result as $key => $value){
$id = $value['product_id'];  // Detta är en primärnyckel

$html = "
          <div class='col-lg-4 col-md-6 mb-4'>
            <div class='card h-100'>
              <a href='#'><img class='card-img-top' src='' alt=''></a>
              <div class='card-body'>
              <img src='images/$value[image]'>
                <h4 class='card-title'>
                <h5>$value[title]</h5>
                <h6>$value[author]</h6>
                </h4>
                <h5>$value[price] kr</h5>
                <p class='card-text'>$value[description]</p>
              </div>
              <div class='card-footer'  style='text-align:center'>
              <a href='buy/index.php?product_id=$id' target='_blank' class='btn btn-primary btn-lg' role='button'>Köp</a>
              </div>
            </div>    
    </div>";
    
echo $html;
}
?>


<hr>
<footer class="text-center text-muted">
 Copyright &copy; Olga Domorod & Jovana Hurra <?php echo date('Y'); ?>
</footer>

</body>
</html>

