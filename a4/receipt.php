<?php
  include_once('./tools.php');
  if(empty($_SESSION)){
    header ("Location: index.php");
  } else {
    //create receipt
  }
?>
<!DOCTYPE html>
<header>
  Thank you for your purchase!
</header>
<body>
  <h1>Tax Invoice</h1>

</body>
<?php
  echo "<hr>";
  echo $_SESSION;
  echo "<hr>";
  preShow($_SESSION);
  echo "<hr>";
  printMyCode();
?>
