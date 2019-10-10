<?php
  include_once('./tools.php');
  if(empty($_SESSION)){
    header ("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thank you for your purchase!</title>
  </head>
  <body>
    <h1>Tax Invoice</h1>
  </body>
</html>
<?php
  echo "<hr>";
  preShow($_SESSION);
  echo "<hr>";
  printMyCode();
?>
