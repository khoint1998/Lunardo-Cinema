<?php
  include_once('./tools.php');
  if(empty($_SESSION)){
    header ("Location: index.php");
  }

  $movieTitle ='';
  $time ='';
  $day = '';
  $GST = number_format((float)(($_SESSION['cart']['total'])/11), 2, '.', '');;
  $STA='';
  $STP='';
  $STC='';
  $FCA='';
  $FCP='';
  $FCC='';
  $subtotal ='';
  $totalDue ='';

  if ($_SESSION['cart']['movie']['id'] == "ACT") {
    $movieTitle ='Avengers: Endgame';
  } else if ($_SESSION['cart']['movie']['id'] == "ANM") {
    $movieTitle ='Dumbo';
  } else if ($_SESSION['cart']['movie']['id'] == "RMC") {
    $movieTitle ='Top End Wedding';
  } else {
    $movieTitle ='The Happy Prince';
  }

  if ($_SESSION['cart']['movie']['day'] == "MON") {
    $day = 'Monday';
  } else if ($_SESSION['cart']['movie']['day'] == "TUE"){
    $day = 'Tuesday';
  } else if ($_SESSION['cart']['movie']['day'] == "WED"){
    $day = 'Wednesday';
  } else if ($_SESSION['cart']['movie']['day'] == "THU"){
    $day = 'Thursday';
  } else if ($_SESSION['cart']['movie']['day'] == "FRI"){
    $day = 'Friday';
  } else if ($_SESSION['cart']['movie']['day'] == "SAT"){
    $day = 'Saturday';
  } else {
    $day = 'Sunday';
  }

  if ($_SESSION['cart']['movie']['hour'] == "T12") {
    $time = '12pm';
  } else if ($_SESSION['cart']['movie']['hour'] == "T15") {
    $time = '3pm';
  } else if ($_SESSION['cart']['movie']['hour'] == "T18") {
    $time = '6pm';
  } else {
    $time = '9pm';
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Thank you for your purchase! - Lunardo Cinema</title>
    <link id='stylecss' type="text/css" rel="stylesheet" href="receipt.css">
  </head>
  <body>
    <div class="invoice">
      <h1>Invoice</h1>
      <div class="booking-details">
        <div class="receipt-title">
          <span> <?php echo $movieTitle; ?></span> - <span><?php echo $day; ?></span> - <span><?php echo $time; ?></span>
        </div>
        <div class="company-detail">
          <div id="leftbox" class="company" style="
            float: left;
            width: 50%;
          ">
            <span>Lunardo Cinema</span>
            <span>lunardo.com.au</span>
            <span>customercare@lunardo.com</span>
            <span>ABN: 00 123 456 789</span>
          </div>
          <div id="rightbox" class="receipt-detail" style="
            float: right;
            width: 50%;
            text-align: right;
          ">
            <span>Receipt details</span>
            <span>Receipt no: #000</span>
            <span>Date of issue: <?php echo date("d/m/Y"); ?></span>
            <span>Address: 1 Luna St., Melbourne, VIC</span>
          </div>
        </div>
      </div>
    </div>

    <div class="bill-to">
      <div class="bill-to-title">Bill To: <?php echo $_SESSION['cart']['cust']['name']; ?></div>
      <div>Mobile: <?php echo $_SESSION['cart']['cust']['mobile']; ?></div>
      <div>Email: <?php echo $_SESSION['cart']['cust']['email']; ?></div>
    </div>

    <div class="table">
      <table id="price">
        <tr>
          <th>Description</th>
          <th>QTY</th>
          <th>Unit Price ($)</th>
          <th>Total ($)</th>
        </tr>
        <tr>
          <td>Standard Adult</td>
          <td><?php echo $_SESSION['cart']['seats']['STA']; ?></td>
          <td>19.80</td>
          <td>19.80</td>
        </tr>
        <tr>
          <td>Standard Concession</td>
          <td><?php echo $_SESSION['cart']['seats']['STP']; ?></td>
          <td>17.50</td>
          <td>19.80</td>
        </tr>
        <tr>
          <td>Standard Child</td>
          <td><?php echo $_SESSION['cart']['seats']['STC']; ?></td>
          <td>15.30</td>
          <td>19.80</td>
        </tr>
        <tr>
          <td>First Class Adult</td>
          <td><?php echo $_SESSION['cart']['seats']['FCA']; ?></td>
          <td>30.00</td>
          <td>19.80</td>
        </tr>
        <tr>
          <td>First Class Concession</td>
          <td><?php echo $_SESSION['cart']['seats']['FCP']; ?></td>
          <td>27.00</td>
          <td>19.80</td>
        </tr>
        <tr>
          <td>First Class Child</td>
          <td><?php echo $_SESSION['cart']['seats']['FCC']; ?></td>
          <td>24.00</td>
          <td>19.80</td>
        </tr>
      </table>
    </div>
    <div class="sub-table">
      <span>Subtotal: <?php echo $subtotal; ?></span>
      <span>GST included: <?php echo $GST; ?></span>
      <span>Total Due: <?php echo $totalDue; ?></span>
    </div>

    <footer>
      <script>
        document.write(new Date().getFullYear());
      </script> Khoi Nguyen s3678755. Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
    </footer>

  </body>
</html>
<?php
  echo "<hr>";
  preShow($_SESSION);
  echo "<hr>";
  printMyCode();
?>
