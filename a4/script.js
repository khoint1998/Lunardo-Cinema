var price = {
  sta: {d: 14.00, n: 19.80},
  stp: {d: 12.50, n: 17.50},
  stc: {d: 11.00, n: 15.30},
  fca: {d: 24.00, n: 30.00},
  fcp: {d: 22.50, n: 27.00},
  fcc: {d: 21.00, n: 24.00}
};

var date = new Date();

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

function bookingForm(id){
  removeContentById('booking-form');
  document.querySelector("#booking-form").insertAdjacentHTML('afterbegin',
  `
  <form id="form" method='post' target='_blank'
  action='index.php'
  onsubmit="">
    <div class="form-title">
      <span id="form-movie-id">Movie Title</span> - <span id="form-movie-day">Date</span> - <span id="form-movie-hour">Time</span>
    </div>
    <div class="form-section">
      <fieldset>
        <legend>Standard</legend>
        <div class="form-std">
          <label for="std-adults">Adults: </label>
          <select name="seats[STA]" id="seats-STA" onchange="calcPrice()">
            <option value="">Please Select</option>
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
            <option value="">Please Select</option>
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
            <option value="">Please Select</option>
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
            <option value="">Please Select</option>
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
            <option value="">Please Select</option>
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
            <option value="">Please Select</option>
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
        <input type="text"  placeholder="eg.John" name="cust[name]" value="" id="cust-name" pattern="^[A-Za-z .\\-']{1,50}" title="Name cannot exceeds 50 characters, no number input" required>
      </div>
      <div class="form-std">
        <label for="email">Email: </label>
        <input type="email" placeholder="example@eg.com" name="cust[email]" value="" id="cust-email" required>
      </div>
      <div class="form-std">
        <label for="mobile">Mobile: </label>
        <input type="tel" placeholder="eg.0412345678" name="cust[mobile]" value="" id="cust-mobile" pattern="^(\\(04\\)|04|\\+614)( ?\\d){8}" title="Australia phone number required" required>
      </div>
      <div class="form-std">
        <label for="credit-card">Credit Card: </label>
        <input type="text" placeholder="XXXX XXXX XXXX XXXX" name="cust[card]" value="" id="cust-card" pattern="^[0-9 ]{14,19}" title="Input must between 14-16 characters, and all must be numbers" required>
      </div>
      <div class="form-std">
        <label for="expiry">Expiry: </label>
        <input type="month" placeholder="MM/YYYY" name="cust[expiry]" min="" max="2020-09" value="" id="cust-expiry" required>
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
  document.getElementById("cust-expiry").setAttribute("min", today);
}
