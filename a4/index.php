<?php
  include_once('./tools.php');
  $message='';
  $nameError = '';
  $emailError = '';
  $phoneError = '';
  $cardError = '';
  $expiryError = '';

  $name ='';
  $email='';
  $phone='';
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

  $errorFound = false;
  if(!empty($_POST)) {
    if (preg_match("#^[A-Za-z .\\-']{1,50}#", $_POST['cust[name]']) ) {
      $name = $_POST['cust[name]'];
    } else {
      $nameError = 'Name invalid. Please check again';
    }
    if(empty($_POST['cust[email]'])) {
      $email = $_POST['cust[email]'];
    } else {
      $emailError = 'Email invalid. Please check again'
    }
    if (preg_match("#^(\\(04\\)|04|\\+614)( ?\\d){8}#", $_POST['cust[phone]']) ) {
      $phone = $_POST['cust[phone]'];
    } else {
      $phoneError = 'Phone invalid. Please check again';
    }
    if (preg_match("#^\\d( ?\\d){14,19}#", $_POST['cust[card]']) ) {
      $card = $_POST['cust[card]'];
    } else {
      $cardError = 'Credit card invalid. Please check again';
    }
    if($_POST['cust[expiry]'] != date("Y-m")) {
      $expiry = $_POST['cust[expiry]']
    } else {
      $expiryError = "Expiry cannot be at the same month"
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
    <script src='../a3/script.js'></script>
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
      echo "<hr>";
      preShow($_POST);
      preShow($_SESSION);
      echo "<hr>";
      printMyCode();
    ?>

  </body>
</html>
