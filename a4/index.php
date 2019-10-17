<?php
  include_once('./tools.php');
  $message='';
  $nameError = '';
  $emailError = '';
  $mobileError = '';
  $cardError = '';
  $expiryError = '';
  $state = '';

  $seatError = '';
  $name ='';
  $email='';
  $mobile='';
  $card='';
  $expiry='';

  $moviesObject = [
    'ACT' => [
      'title' => 'Avengers: Endgame',
      'rating' => 'G',
      'description' => '<p>With the help of remaining allies. Whatever it takes. Watch the brand-new trailer from Marvel Studios’ Avengers: Endgame.</p>',
      'screenings' => [
        'SUN' => 'T18',
        'SAT' => 'T18',
        'FRI' => 'T21',
        'THU' => 'T21',
        'WED' => 'T21',
      ]
    ],
    'RMC' => [
      'title' => 'Top End Wedding',
      'rating' => 'G',
      'description' => '<p>From the makers of The Sapphires, TOP END WEDDING is a celebration of love, family and belonging, set against the spectacular natural beauty of the Northern Territory.</p>',
      'screenings' => [
        'SUN' => 'T15',
        'SAT' => 'T15',
        'TUE' => 'T18',
        'MON' => 'T18'
      ]
    ],
    'ANM' => [
      'title' => 'Dumbo',
      'rating' => 'G',
      'description' => '<p>Circus owner Max Medici enlists former star Holt Farrier and his children Milly and Joe to care for a newborn elephant whose oversized ears make him a laughingstock in an already struggling circus. But when they discover that Dumbo can fly.</p>',
      'screenings' => [
        'SUN' => 'T12',
        'SAT' => 'T12',
        'FRI' => 'T18',
        'THU' => 'T18',
        'WED' => 'T18',
        'TUE' => 'T12',
        'MON' => 'T12'
      ]
    ],
    'AHF' => [
      'title' => 'The Happy Prince',
      'rating' => 'G',
      'description' => '<p>The untold story of the last days in the tragic times of Oscar Wilde, a person who observes his own failure with ironic distance and regards the difficulties that beset his life with detachment and humor.</p>',
      'screenings' => [
        'SUN' => 'T21',
        'SAT' => 'T21',
        'FRI' => 'T12',
        'THU' => 'T12',
        'WED' => 'T12'
      ]
    ],
  ];

  $errorsFound = false;
  if(!empty($_POST)) {
    if ($_POST['seats']['STA'] != 0 || $_POST['seats']['STP'] != 0 || $_POST['seats']['STC'] != 0
    || $_POST['seats']['FCA'] != 0 || $_POST['seats']['FCP'] != 0 || $_POST['seats']['FCC'] != 0){

    } else {
      $seatError = '<div style="color:red">Please choose at least 1 seat to continue</div>';
      $errorsFound = true;
    }
    if (preg_match("#^[A-Za-z .\\-']{1,50}#", $_POST['cust']['name'])) {
      $name = $_POST['cust']['name'];
    } else {
      $nameError = '<div style="color:red">Name invalid. Please check again</div>';
      $errorsFound = true;
    }
    if(!empty($_POST['cust']['email'])) {
      $email = $_POST['cust']['email'];
    } else {
      $emailError = '<div style="color:red">Email invalid. Please check again</div>';
      $errorsFound = true;
    }
    if (preg_match("#^(\\(04\\)|04|\\+614)( ?\\d){8}#", $_POST['cust']['mobile'])) {
      $mobile = $_POST['cust']['mobile'];
    } else {
      $mobileError = '<div style="color:red">Mobile invalid. Please check again</div>';
      $errorsFound = true;
    }
    if (preg_match("#^\\d( ?\\d){14,19}#", $_POST['cust']['card'])) {
      $card = $_POST['cust']['card'];
    } else {
      $cardError = '<div style="color:red">Card invalid. Please check again</div>';
      $errorsFound = true;
    }
    if($_POST['cust']['expiry'] != date("Y-m")) {
      $expiry = $_POST['cust']['expiry'];
    } else {
      $expiryError = '<div style="color:red">Expiry cannot be at the same month this year</div>';
      $errorsFound = true;
    }

    $state = $_POST['state'];

    // $storage = '
    // <script>
    //   document.getElementById("now-showing");
    // </script>';
    //
    // $_SESSION['storage'] = $storage;

    if(!$errorsFound){
      $_SESSION['cart'] = $_POST;

      $filename = "./bookings.txt";
      $book_str = [
        'Date' => date("Y-m-d"),
        'Name' => $_SESSION['cart']['cust']['name'],
        'Email' => $_SESSION['cart']['cust']['email'],
        'Mobile' => $_SESSION['cart']['cust']['mobile'],
        'MovieID' => $_SESSION['cart']['movie']['id'],
        'Day' => $_SESSION['cart']['movie']['day'],
        'Hour' => $_SESSION['cart']['movie']['hour'],
        'STA' => $_SESSION['cart']['seats']['STA'],
        'STP' => $_SESSION['cart']['seats']['STP'],
        'STC' => $_SESSION['cart']['seats']['STC'],
        'FCA' => $_SESSION['cart']['seats']['FCA'],
        'FCP' => $_SESSION['cart']['seats']['FCP'],
        'FCC' => $_SESSION['cart']['seats']['FCC'],
        'Total' => $_SESSION['cart']['total']
      ];
      $fp = fopen($filename,"a");
      flock($fp, LOCK_EX);
      fputcsv($fp,$book_str,"\t");
      flock($fp, LOCK_UN);
      fclose($fp);

      header("Location: receipt.php");
    }
  }
?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 2</title>

    <!-- Keep wireframe.css for debugging, add your css to style.css -->
    <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">
    <script src='../wireframe.js'></script>
  </head>

  <body class="parallax">
    <div class="head">
      <header id="top"><span><img class="logo" src="../../media/logo.png" alt="logo"></span>Lunardo Cinema&copy;</header>
      <h1>Welcome to Lunardo Grand Cinema</h1>
    </div>

    <div class="nav">
      <hr>
      <nav>
        <a href="#about">ABOUT</a>
        <a href="#seat-prices">PRICES</a>
        <a href="#movie">NOW SHOWING</a>
        <a href="#top">HOME</a>
      </nav>
      <hr>
    </div>

    <main>
      <hr>
      <section id="about">
        <div class="section">ABOUT THE NEW LUNARDO:</div>
        <ul>
          <li>
            <div class="about">
              Various Extensive Improvements:
              <img class="cinema1" src="https://i.pinimg.com/originals/4f/2e/f9/4f2ef9f1fb1e827e4804da9148208400.jpg" alt="cinema1">
            </div>
            <p>
              To beter serve our customer, we have upgraded cinema facilities and extensive inovation,
              delivering the best experience while enjoy blockbuster
              movies.
              <div>
                Grand Opening on 30/08/2019. Take a tour at Lunardo!
              </div>
            </p>
          </li>
          <li>
            <div class="about">
              Standard and Reclinable seats upgraded:
            </div>
            <p>
              <div class="about">
                Standard Seats:
              </div>
              <img class="stdseat" src="http://www.profurn.com.au/wp-content/uploads/2016/09/538.jpg" alt="stdseat">
              Best seat in town, with a distinctive headrest and a contoured backrest, the 538 seat from Profurn delivers outstanding comfort and value.
              <div class="Features">
                Features:
              </div>
              <ul>
                <li>Leather headrest for extended durability</li>
                <li>Multi-angled positioned backrest</li>
                <li>No finger traps</li>
              </ul>
              <div class="about">
                New Reclinable Seats:
              </div>
              <img class="stdseat" src="http://www.profurn.com.au/wp-content/uploads/2016/07/Verona-Twin.png" alt="business-seats">
              The Verona is a fully reclining luxurious cinema seat.
              Available in a single seat, a twin seat or linked seat with shared armrests.
              <div class="Features">
                Features:
              </div>
              <ul>
                <li>Luxurious aesthetic</li>
                <li>Two individual motors</li>
                <li>Easy lift system</li>
                <li>Underseat lighting</li>
                <li>Fully reclining seat</li>
              </ul>
            </p>
          </li>
          <li>
            <div class="about">
              3D Dolby Vision and Dolby Atmos equipped
            </div>
            <p>
              <p>
                Dolby Atmos transports you into the story
                with moving audio that flows all around you
                 with breathtaking realism. Lunardo offer you endless
                 experiences throughout your movies. Enjoy!
              </p>
              <iframe src="https://www.youtube.com/embed/3TOlN9dLpi8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </video>
            </p>
          </li>
        </ul>
      </section>
      <hr>
      <section id="seat-prices">
        <div class="section">SEAT PRICES</div>
        <ul>
          <li>
            <div class="about">
              Get your friends and enjoy a luxury evening together!
            </div>
            <p>The Cinema offers discounted pricing weekday afternoons and all day on Mondays to Wednesdays</p>
          </li>
          <li>
            <div class="about">
              Price Section:
            </div>
            <table id="price">
              <tr>
                <th>Seat Type</th>
                <th>
                  <div>All day (Mon and Wed)</div>
                  <div> and 12PM on Weekdays</div></th>
                <th>All other times</th>
              </tr>
              <tr>
                <td>Standard Adult</td>
                <td>14.00</td>
                <td>19.80</td>
              </tr>
              <tr>
                <td>Standard Concession</td>
                <td>12.50</td>
                <td>17.50</td>
              </tr>
              <tr>
                <td>Standard Child</td>
                <td>11.00</td>
                <td>15.30</td>
              </tr>
              <tr>
                <td>First Class Adult</td>
                <td>24.00</td>
                <td>30.00</td>
              </tr>
              <tr>
                <td>First Class Concession</td>
                <td>22.50</td>
                <td>27.00</td>
              </tr>
              <tr>
                <td>First Class Child</td>
                <td>21.00</td>
                <td>24.00</td>
              </tr>
            </table>
          </li>
        </ul>
      </section>
      <hr>
      <section id="movie">
        <div class="section">NOW SHOWING</div>
        <div class="row">
          <div class="col">
            <div class="movie-section">
              <img class="movie" src="https://m.media-amazon.com/images/M/MV5BMjU0NDk0N2EtNTliZS00MjNmLTk0M2MtYTMzOTUxMGQwZWI3XkEyXkFqcGdeQXVyMzE0MTQ2NzQ@._V1_.jpg" alt="top-end-wedding">
              <div class="info">
                Top End Wedding <span>G</span>
              </div>
              <div id="topEndWeddingTime" class="time">
                <li>Mon - 6pm</li>
                <li>Tue - 6pm</li>
                <li>Sat - 3pm</li>
                <li>Sun - 3pm</li>
                <button class="button" type="button" name="choose" onclick="showSynopsis(1)"> SELECT</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="movie-section">
              <img class="movie" src="https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_.jpg" alt="av-edgame">
              <div class="info">
                Avenger: Endgame<span>G</span>
              </div>
              <div id="avenger4Time" class="time">
                <li>Wed - 9pm</li>
                <li>Thu - 9pm</li>
                <li>Fri - 9pm</li>
                <li>Sat - 6pm</li>
                <li>Sun - 6pm</li>
                <button class="button" type="button" name="choose" onclick="showSynopsis(2)"> SELECT</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="movie-section">
              <img class="movie" src="http://cdn.collider.com/wp-content/uploads/2019/01/dumbo-poster.jpg" alt="dumbo">
              <div class="info">
                Dumbo <span>G</span>
              </div>
              <div id="dumboTime" class="time">
                <li>Mon - 12pm</li>
                <li>Tue - 12pm</li>
                <li>Wed - 6pm</li>
                <li>Thu - 6pm</li>
                <li>Fri - 6pm</li>
                <li>Sat - 12pm</li>
                <li>Sun - 12pm</li>
                <button class="button" type="button" name="choose" onclick="showSynopsis(3)"> SELECT</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="movie-section">
              <img class="movie" src="https://m.media-amazon.com/images/M/MV5BODVjZThlMzMtZjQwNy00YjRlLWE5ZTMtMWVlMWUwM2U1NjRkXkEyXkFqcGdeQXVyODcyODY1Mzg@._V1_.jpg" alt="happy-prince">
              <div class="info">
                The Happy Prince <span>G</span>
              </div>
              <div id="happyPrinceTime" class="time">
                <li>Wed - 12pm</li>
                <li>Thu - 12pm</li>
                <li>Fri - 12pm</li>
                <li>Sat - 9pm</li>
                <li>Sun - 9pm</li>
                <button class="button" type="button" name="choose" onclick="showSynopsis(4)"> SELECT</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <hr>
      <section id="now-showing"></section>
    </main>

    <footer>
      <div class="footer">
        <div>&copy;Khoi Nguyen</div>
        <div>Phone: (+61)123456789</div>
        <div>Email: khoi.nt1998@gmail.com</div>
      </div>
      <script>
        document.write(new Date().getFullYear());
      </script> Khoi Nguyen s3678755. Last modified <?= date ("Y F d  H:i", filemtime($_SERVER['SCRIPT_FILENAME'])); ?>.</div>
      <div>Disclaimer: This website is not a real website and is being developed as part of a School of Science Web Programming course at RMIT University in Melbourne, Australia.</div>
      <div><button id='toggleWireframeCSS' onclick='toggleWireframe()'>Toggle Wireframe CSS</button></div>
    </footer>

    <?php
    // echo $nameError;
    // echo $emailError;
    // echo $cardError;
    // echo $expiryError;

      if(!empty($_POST['movie']['id'])) {
        $glueCode = ['RMC' => 1, 'ACT' => 2, 'ANM' => 3, 'AHF' => 4];
        echo "
        <script>
          showSynopsis(" + $glueCode[$_POST['movie']['id']] + ");
          bookingForm2("+$_POST['movie']['id']+","+$_POST['movie']['day']+","+$_POST['movie']['hour']+");
        </script>
        ";
      }
    ?>

    <?php
      echo "<hr>";
      preShow($_POST);
      echo "<hr>";
      preShow($_SESSION);
      echo "<hr>";
      printMyCode();
    ?>
  </body>

  <script>
  var price = {
    sta: {d: 14.00, n: 19.80},
    stp: {d: 12.50, n: 17.50},
    stc: {d: 11.00, n: 15.30},
    fca: {d: 24.00, n: 30.00},
    fcp: {d: 22.50, n: 27.00},
    fcc: {d: 21.00, n: 24.00}
  };

  var date = new Date();
  var state = document.getElementById('now-showing').innerHTML;

  function showSynopsis(sw){
    removeContentById('now-showing');
    if (sw == 1){
      document.querySelector('#now-showing').insertAdjacentHTML('afterbegin',
      `
        <div class="section">Movie Details:</div>
        <div class="details">
          <div class="info"> <span id="movie-id">TOP END WEDDING</span> <span>G</span></div>
          <iframe class="trailer" src="https://www.youtube.com/embed/uoDBvGF9pPU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p>
            <div class="plot-title">PLOT DESCRIPTION:</div>
            <div class="plot">
              From the makers of The Sapphires, TOP END WEDDING is a celebration of love, family and belonging, set against the spectacular natural beauty of the Northern Territory.
            </div>
            <div class="plot-title">In theaters May 2.</div>
            <div class="plot-title">Make a Booking:</div>
            <div id="chooseDateTopEndWedding"></div>
            <div id="booking-form"></div>
          </p>
        </div>
      `)
      liCounter("topEndWeddingTime","chooseDateTopEndWedding");
    } else if (sw == 2){
      document.querySelector('#now-showing').insertAdjacentHTML('afterbegin',
      `
        <div class="section">Movie Details:</div>
        <div class="details">
          <div class="info"> <span id="movie-id">AVENGER: ENDGAME</span> <span>G</span></div>
          <iframe class="trailer" src="https://www.youtube.com/embed/TcMBFSGVi1c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p>
            <div class="plot-title">PLOT DESCRIPTION:</div>
            <div class="plot">
              Whatever it takes. Watch the brand-new trailer from Marvel Studios’ Avengers: Endgame.
            </div>
            <div class="plot-title">In theaters April 26.</div>
            <div class="plot-title">Make a Booking:</div>
            <div id="chooseDateAvenger4"></div>
            <div id="booking-form"></div>
          </p>
        </div>
      `)
      liCounter("avenger4Time","chooseDateAvenger4");
    } else if (sw == 3){
      document.querySelector('#now-showing').insertAdjacentHTML('afterbegin',
      `
        <div class="section">Movie Details:</div>
        <div class="details">
          <div class="info"> <span id="movie-id">DUMBO</span> <span>G</span></div>
          <iframe class="trailer" src="https://www.youtube.com/embed/7NiYVoqBt-8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p>
            <div class="plot-title">PLOT DESCRIPTION:</div>
            <div class="plot">
            Circus owner Max Medici enlists former star Holt Farrier and his children Milly and Joe to care for a newborn elephant whose oversized ears make him a laughingstock in an already struggling circus. But when they discover that Dumbo can fly.
            </div>
            <div class="plot-title">In theaters March 29.</div>
            <div class="plot-title">Make a Booking:</div>
            <div id="chooseDateDumbo"></div>
            <div id="booking-form"></div>
          </p>
        </div>
      `)
      liCounter("dumboTime","chooseDateDumbo");
    } else if (sw == 4){
      document.querySelector('#now-showing').insertAdjacentHTML('afterbegin',
      `
        <div class="section">Movie Details:</div>
        <div class="details">
          <div class="info"> <span id="movie-id">THE HAPPY PRINCE</span> <span>G</span></div>
          <iframe class="trailer" src="https://www.youtube.com/embed/tXANCJQkUIE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <p>
            <div class="plot-title">PLOT DESCRIPTION:</div>
            <div class="plot">
            The untold story of the last days in the tragic times of Oscar Wilde, a person who observes his own failure with ironic distance and regards the difficulties that beset his life with detachment and humor.
            </div>
            <div class="plot-title">In theaters October 5.</div>
            <div class="plot-title">Make a Booking:</div>
            <div id="chooseDateHappyPrince"></div>
            <div id="booking-form"></div>
          </p>
        </div>
      `)
      liCounter("happyPrinceTime","chooseDateHappyPrince");
    }
  }

  function removeContentById(id){
      document.getElementById(id).innerHTML = "";
  }

  function bookingButton(string,movieName,id){
    document.querySelector("#" + movieName ).insertAdjacentHTML('afterbegin',
    `
      <button class="hours" id="`+ id +`" type="button" name="choose" onclick="bookingForm(`+id+`)">` + string + `</button>
    `)
  }

  function liCounter(movieTimeId, chooseDateButton){
    for (var i = 0; i < document.querySelectorAll("#" + movieTimeId + " li").length; i++) {
      bookingButton(document.querySelectorAll("#" + movieTimeId + " li")[i].innerHTML,chooseDateButton,i);
    }
  }

  function bookingForm2(id,day,hour){
    document.querySelector("#booking-form").insertAdjacentHTML('afterbegin',
    `
    <form id="form" method='post' action='index.php' onsubmit="">
      <div class="form-title">
        <span id="form-movie-id">Movie Title</span> - <span id="form-movie-day">Date</span> - <span id="form-movie-hour">Time</span>
      </div>
      <div class="form-section">
        <fieldset>
          <legend>Standard</legend>
          <div class="form-std">
            <label for="std-adults">Adults: </label>
            <select name="seats[STA]" id="seats-STA" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-concession">Concession: </label>
            <select name="seats[STP]" id="seats-STP" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-children">Children: </label>
            <select name="seats[STC]" id="seats-STC" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </fieldset>
        <fieldset>
          <legend>First Class</legend>
          <div class="form-std">
            <label for="std-adults">Adults: </label>
            <select name="seats[FCA]" id="seats-FCA" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-concession">Concession: </label>
            <select name="seats[FCP]" id="seats-FCP" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-children">Children: </label>
            <select name="seats[FCC]" id="seats-FCC" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </fieldset>
      </div>
      <input type="hidden" name="movie[id]" id="input-movie-id" value="`+id+`">
      <input type="hidden" name="movie[day]" id="input-movie-day" value="`+day+`">
      <input type="hidden" name="movie[hour]" id="input-movie-hour" value="`+hour+`">
      <div class="form-section">
        <div class="form-std">
          <label for="name">Name: </label>
          <input type="text"  placeholder="eg.John" name="cust[name]" value="<?php $_POST['cust']['name']; ?>" id="cust-name" required>
        </div>
        <div class="form-std">
          <label for="email">Email: </label>
          <input type="email" placeholder="example@eg.com" name="cust[email]" value="<?php $_POST['cust']['email']; ?>" id="cust-email" required>
        </div>
        <div class="form-std">
          <label for="mobile">Mobile: </label>
          <input type="tel" placeholder="eg.0412345678" name="cust[mobile]" value="<?php $_POST['cust']['mobile']; ?>" id="cust-mobile" required>
        </div>
        <div class="form-std">
          <label for="credit-card">Credit Card: </label>
          <input type="text" placeholder="XXXX XXXX XXXX XXXX" name="cust[card]" value="<?php $_POST['cust']['card']; ?>" id="cust-card" required>
        </div>
        <div class="form-std">
          <label for="expiry">Expiry: </label>
          <input type="month" placeholder="MM/YYYY" name="cust[expiry]" min="" max="" value="<?php $_POST['cust']['expiry']; ?>" id="cust-expiry" required>
        </div>
        <div id="total-price" class="form-std">
          <label for="total">TOTAL: $</label>
          <input type="text" name="total" value="0" id="total" readonly>
        </div>
      </div>
      <div class="order-button">
        <p id="server-message"></p>
        <p id="discount-message"></p>
        <button type="submit" name="order" value="order">ORDER</button>
      </div>
    </form>
    `)
    dateCheck();
  }

  function bookingForm(id){
    removeContentById('booking-form');
    document.querySelector("#booking-form").insertAdjacentHTML('afterbegin',
    `
    <form id="form" method='post' action='index.php' onsubmit="">
      <div class="form-title">
        <span id="form-movie-id">Movie Title</span> - <span id="form-movie-day">Date</span> - <span id="form-movie-hour">Time</span>
      </div>
      <div class="form-section">
        <fieldset>
          <legend>Standard</legend>
          <div class="form-std">
            <label for="std-adults">Adults: </label>
            <select name="seats[STA]" id="seats-STA" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-concession">Concession: </label>
            <select name="seats[STP]" id="seats-STP" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-children">Children: </label>
            <select name="seats[STC]" id="seats-STC" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </fieldset>
        <fieldset>
          <legend>First Class</legend>
          <div class="form-std">
            <label for="std-adults">Adults: </label>
            <select name="seats[FCA]" id="seats-FCA" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-concession">Concession: </label>
            <select name="seats[FCP]" id="seats-FCP" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="form-std">
            <label for="std-children">Children: </label>
            <select name="seats[FCC]" id="seats-FCC" onchange="calcPrice()">
              <option value="0">Please Select</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
        </fieldset>
      </div>
      <input type="hidden" name="movie[id]" id="input-movie-id" value="">
      <input type="hidden" name="movie[day]" id="input-movie-day" value="">
      <input type="hidden" name="movie[hour]" id="input-movie-hour" value="">
      <div class="form-section">
        <div class="form-std">
          <label for="name">Name: </label>
          <input type="text"  placeholder="eg.John" name="cust[name]" value="<?php $name; ?>" id="cust-name" required>
        </div>
        <div class="form-std">
          <label for="email">Email: </label>
          <input type="email" placeholder="example@eg.com" name="cust[email]" value="<?php $email; ?>" id="cust-email" required>
        </div>
        <div class="form-std">
          <label for="mobile">Mobile: </label>
          <input type="tel" placeholder="eg.0412345678" name="cust[mobile]" value="<?php $mobile; ?>" id="cust-mobile" required>
        </div>
        <div class="form-std">
          <label for="credit-card">Credit Card: </label>
          <input type="text" placeholder="XXXX XXXX XXXX XXXX" name="cust[card]" value="<?php $card; ?>" id="cust-card" required>
        </div>
        <div class="form-std">
          <label for="expiry">Expiry: </label>
          <input type="month" placeholder="MM/YYYY" name="cust[expiry]" min="" max="" value="<?php $expiry; ?>" id="cust-expiry" required>
        </div>
        <div id="total-price" class="form-std">
          <label for="total">TOTAL: $</label>
          <input type="text" name="total" value="0" id="total" readonly>
        </div>
      </div>
      <div class="order-button">
        <p id="server-message"></p>
        <p id="discount-message"></p>
        <button type="submit" name="order" value="order">ORDER</button>
      </div>
    </form>
    `)
    dateCheck();
    movieAndDateChosenUpdate(id);
  }

  window.onscroll = function() {
    var articles = document.getElementsByTagName('main')[0].getElementsByTagName('section');
    var navlinks = document.getElementsByTagName('nav')[0].getElementsByTagName('a');
    var n = -1;
    while (n < articles.length -1 && articles[n+1].offsetTop <= window.scrollY + 80){
      n++;
    }
    for (var a = 0; a < navlinks.length; a++){
      navlinks[a].classList.remove('active');
    }
    if (n >= 0){
      navlinks[n].classList.add('active');
    }
  }

  function movieAndDateChosenUpdate(id){
    document.getElementById('form-movie-id').innerHTML = document.getElementById('movie-id').innerHTML;
    var chooseDate = document.getElementById(id).textContent;
    var dateAndTime = chooseDate.split(" - ");
    document.getElementById('form-movie-day').innerHTML = dateAndTime[0];
    document.getElementById('form-movie-hour').innerHTML = dateAndTime[1];

    if (document.getElementById('form-movie-id').innerHTML === "THE HAPPY PRINCE") {
      document.getElementById('input-movie-id').value = "AHF";
    } else if (document.getElementById('form-movie-id').innerHTML === "DUMBO"){
      document.getElementById('input-movie-id').value = "ANM";
    } else if (document.getElementById('form-movie-id').innerHTML === "AVENGER: ENDGAME"){
      document.getElementById('input-movie-id').value = "ACT";
    } else if (document.getElementById('form-movie-id').innerHTML === "TOP END WEDDING") {
      document.getElementById('input-movie-id').value = "RMC";
    }

    if(document.getElementById('form-movie-day').innerHTML === "Mon"){
      document.getElementById('input-movie-day').value = "MON";
    } else if (document.getElementById('form-movie-day').innerHTML === "Tue") {
      document.getElementById('input-movie-day').value = "TUE";
    } else if (document.getElementById('form-movie-day').innerHTML === "Wed") {
      document.getElementById('input-movie-day').value = "WED";
    } else if (document.getElementById('form-movie-day').innerHTML === "Thu") {
      document.getElementById('input-movie-day').value = "THU";
    } else if (document.getElementById('form-movie-day').innerHTML === "Fri") {
      document.getElementById('input-movie-day').value = "FRI";
    } else if (document.getElementById('form-movie-day').innerHTML === "Sat") {
      document.getElementById('input-movie-day').value = "SAT";
    } else if (document.getElementById('form-movie-day').innerHTML === "Sun") {
      document.getElementById('input-movie-day').value = "SUN";
    }

    if(document.getElementById('form-movie-hour').innerHTML === "12pm") {
      document.getElementById('input-movie-hour').value = "T12";
    } else if (document.getElementById('form-movie-hour').innerHTML === "3pm") {
      document.getElementById('input-movie-hour').value = "T15";
    } else if (document.getElementById('form-movie-hour').innerHTML === "6pm") {
      document.getElementById('input-movie-hour').value = "T18";
    } else if (document.getElementById('form-movie-hour').innerHTML === "9pm") {
      document.getElementById('input-movie-hour').value = "T21";
    }

    // Calculate Total Price
    calcPrice();
  }

  function calcPrice(){
    var day = document.getElementById('input-movie-day').value;
    var time = document.getElementById('input-movie-hour').value;
    let totalAmt;
    if((time === "T12" && (day === "TUE" || day === "THU" || day === "FRI")) || (day === "MON" || day === "WED")){
        document.getElementById('discount-message').innerHTML = "Congratulations! You got discounts for this time slot !!!";
        totalAmt= document.getElementById('seats-STA').value * price.sta.d +
                  document.getElementById('seats-STP').value * price.stp.d +
                  document.getElementById('seats-STC').value * price.stc.d +
                  document.getElementById('seats-FCA').value * price.fca.d +
                  document.getElementById('seats-FCP').value * price.fcp.d +
                  document.getElementById('seats-FCC').value * price.fcc.d;
        document.getElementById('total').value = parseFloat(totalAmt).toFixed(2);
    } else {
      totalAmt= document.getElementById('seats-STA').value * price.sta.n +
                document.getElementById('seats-STP').value * price.stp.n +
                document.getElementById('seats-STC').value * price.stc.n +
                document.getElementById('seats-FCA').value * price.fca.n +
                document.getElementById('seats-FCP').value * price.fcp.n +
                document.getElementById('seats-FCC').value * price.fcc.n;
      document.getElementById('total').value = parseFloat(totalAmt).toFixed(2);
    }
  }

  function dateCheck() {
    var today = new Date();
    var mm = today.getMonth()+1; //January is 0
    var yyyy = today.getFullYear();
        if(mm<10){
            mm='0'+mm
        }
    today = yyyy+'-'+mm;
    todayNext5year = (yyyy+5)+'-'+mm;
    document.getElementById("cust-expiry").setAttribute("min", today);
    document.getElementById("cust-expiry").setAttribute("max", todayNext5year);
  }
  </script>

</html>
