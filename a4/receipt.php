<?php
  if(empty($_SESSION)){
    header ('Location: index.php');
  } else {
    //create receipt
  }
  include_once('./tools.php');
  echo "Success";
  preShow($_SESSION);
  echo "<hr>";
  printMyCode();
?>
