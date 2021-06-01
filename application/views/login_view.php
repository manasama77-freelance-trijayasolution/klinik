<?php
// --------- HAPUS CACHE DISINI --------- 
// versi pertama...
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// versi kedua..
// header("Cache-Control: no-cache, must-revalidate");
// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// header("Content-Type: application/xml; charset=utf-8");

// --------- BATAS CACHE DISINI --------- 

$url             = $this->uri->segment(1);
$session_data   = $this->session->userdata('logged_in');
$jobs           = $session_data['jobs'];
$userlevel      = $session_data['userlevel'];
$id              = $session_data['id'];

include './design/koneksi/file.php';
$logic     = "update mst_user set online=0 where id='$id' ";
if ($hasil   = mysqli_query($con, $logic)) {
}
session_destroy();
session_start();
//echo $_SESSION['pc'];

if ($url != "login" && $url != "verifylogin") {

  header("Location: " . base_url() . "login");
  //die();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Klinik drg. Magista Lutfia | Login</title>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600,700,300'>
  <style>
    html,
    body {
      width: 100%;
      height: 100%;
    }

    body {
      margin: 0 auto;
      display: table;
      text-align: center;
      font-family: 'Open Sans', sans-serif;
      background: #81b5d6;
      max-width: 30em;
    }

    .wrap {
      margin-top: 50px;
    }

    .flip-container {
      perspective: 1000;
      border-radius: 50%;
      margin: 0 auto 10px auto;
    }

    .logged-in {
      transform: rotateY(180deg);
    }

    .flip-container,
    .front,
    .back,
    .back-logo {
      width: 130px;
      height: 130px;
    }

    .flipper {
      transition-duration: 0.6s;
      transform-style: preserve-3d;
    }

    .front,
    .back {
      backface-visibility: hidden;
      top: 0;
      left: 0;
      background-size: cover;
    }

    .front {
      background: url('<?php echo base_url(); ?>design/images/login.png') 0 0 no-repeat;
    }

    .back {
      transform: rotateY(180deg);
      background: url(http://s8.postimg.org/u04do1mmp/Flip_Img2.png) 0 0 no-repeat;
    }

    h1 {
      font-size: 22px;
      color: #FFF;
    }

    h1 span {
      font-weight: 300;
    }

    select {
      color: #FFF;
      background: #68add8;
      /* Old browsers */
      background: linear-gradient(45deg, #68add8 0%, #8cbede 100%);
      /* W3C */
      width: 267px;
      height: 40px;
      margin: 0 auto 10px auto;
      font-size: 14px;
      padding-left: 15px;
      border: none;
      box-shadow: -3px 3px #679acb;
      -webkit-appearance: none;
      border-radius: 0;
      border-top: 1px solid #92c5e2;
      border-right: 1px solid #92c5e2;
      color: #FFF;
      outline: none;
      color: #fff;
      background-color: #3f88b8;
      font-size: 14px;
      height: 40px;
      border: none;
      margin: 10 10 10 17px;
      padding: 0 20px 0 20px;
      border-radius: 0;
      cursor: pointer;
      background-color: #3f7ba2;
    }

    input[type=text],
    input[type=password] {
      color: #FFF;
      background: #68add8;
      /* Old browsers */
      background: linear-gradient(45deg, #68add8 0%, #8cbede 100%);
      /* W3C */
      width: 250px;
      height: 40px;
      margin: 0 auto 10px auto;
      font-size: 14px;
      padding-left: 15px;
      border: none;
      box-shadow: -3px 3px #679acb;
      -webkit-appearance: none;
      border-radius: 0;
      border-top: 1px solid #92c5e2;
      border-right: 1px solid #92c5e2;
    }

    input::-webkit-input-placeholder {
      color: #FFF;
    }

    input:focus {
      outline: none;
    }

    input[type=submit] {
      color: #fff;
      background-color: #3f88b8;
      font-size: 14px;
      height: 40px;
      border: none;
      margin: 0 auto 0 17px;
      padding: 0 20px 0 20px;
      -webkit-appearance: none;
      border-radius: 0;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #3f7ba2;
    }

    a {
      color: #1c70a7;
      font-weight: 600;
      font-size: 12px;
      text-decoration: none;
    }

    a:hover {
      color: #3f7ba2;
    }

    .hint {
      width: 250px;
      display: block;
      margin: 80px auto 0 auto;
      text-align: left;
    }

    .hint p {
      padding: 5px 0 5px 0;
      color: #FFF;
      font-weight: 600;
      font-size: 20px;
    }

    .hint p span {
      font-weight: 300;
      font-size: 16px;
    }

    .isa_info,
    .isa_success,
    .isa_warning,
    .isa_error {
      margin: 10px 0px;
      padding: 12px;
      border-radius: .5em;
      border: 1px solid;
    }

    .isa_info {
      color: #00529B;
      background-color: #BDE5F8;
    }

    .isa_success {
      color: #4F8A10;
      background-color: #DFF2BF;
    }

    .isa_warning {
      color: #9F6000;
      background-color: #FEEFB3;
    }

    .isa_error {
      color: #D8000C;
      background-color: #FFBABA;
    }

    .isa_info i,
    .isa_success i,
    .isa_warning i,
    .isa_error i {
      margin: 10px 22px;
      font-size: 2em;
      vertical-align: middle;
    }


    /* Links */

    a:hover {
      color: #555
    }

    .uibutton {
      display: inline-block;
      padding: 5px 10px;
      border-top: 1px solid #96d1f8;
      border-radius: 8px;
      text-decoration: none;
      background: #65a9d7;
      background-repeat: no-repeat;
      background-image: -webkit-linear-gradient(top left,
          rgba(255, 255, 255, 0.2) 0%,
          rgba(255, 255, 255, 0.2) 37%,
          rgba(255, 255, 255, 0.8) 45%,
          rgba(255, 255, 255, 0.0) 50%),
        -webkit-linear-gradient(#3e779d, #65a9d7);
      background-image: -moz-linear-gradient(0 0,
          rgba(255, 255, 255, 0.2) 0%,
          rgba(255, 255, 255, 0.2) 37%,
          rgba(255, 255, 255, 0.8) 45%,
          rgba(255, 255, 255, 0.0) 50%),
        -moz-linear-gradient(#3e779d, #65a9d7);
      background-image: -o-linear-gradient(0 0,
          rgba(255, 255, 255, 0.2) 0%,
          rgba(255, 255, 255, 0.2) 37%,
          rgba(255, 255, 255, 0.8) 45%,
          rgba(255, 255, 255, 0.0) 50%),
        -o-linear-gradient(#3e779d, #65a9d7);
      background-image: linear-gradient(0 0,
          rgba(255, 255, 255, 0.2) 0%,
          rgba(255, 255, 255, 0.2) 40%,
          rgba(255, 255, 255, 0.8) 45%,
          rgba(255, 255, 255, 0.0) 50%),
        linear-gradient(#3e779d, #65a9d7);
      background-position: -100px -100px, 0 0;
      -moz-background-size: 250% 250%, 100% 100%;
      background-size: 250% 250%, 100% 100%;
      -webkit-transition: background-position 0s ease;
      -moz-transition: background-position 0s ease;
      -o-transition: background-position 0s ease;
      transition: background-position 0s ease;
    }

    .uibutton:hover,
    .uibutton:focus {
      background-position: 0 0, 0 0;
      -webkit-transition-duration: 0.5s;
      -moz-transition-duration: 0.5s;
      transition-duration: 0.5s;
    }

    .uibutton:active {
      top: 1px;
    }
  </style>
</head>

<body>
  <script>
    var IDLE_TIMEOUT = 60; //seconds
    var _idleSecondsCounter = 0;
    document.onclick = function() {
      _idleSecondsCounter = 0;
    };
    document.onmousemove = function() {
      _idleSecondsCounter = 0;
    };
    document.onkeypress = function() {
      _idleSecondsCounter = 0;
    };
    window.setInterval(CheckIdleTime, 1000);

    function CheckIdleTime() {
      _idleSecondsCounter++;
      var oPanel = document.getElementById("SecondsUntilExpire");
      if (oPanel)
        oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
      if (_idleSecondsCounter >= IDLE_TIMEOUT) {
        //alert("Time expired!");
        window.close();
      }
    }
  </script>
  <?php
  //if(isset($login_info))
  //{  // hanya untuk menampilkan informasi saja
  echo "<span style='color: #F00;'>";
  //echo $login_info;
  //}else{
  echo validation_errors();
  echo "</span>";
  //}
  ?>
  <div class="wrap">
    <div class="flip-container" id='flippr'>
      <div class="flipper">
        <img style="width: 130px; height: 130px;" src="<?php echo base_url(); ?>design/images/login.png"></img>
      </div>
    </div>
    <h1 class="text" id="welcome">Welcome. <span>please login.</span></h1>
    <?php echo form_open('verifylogin') ?>
    <input type="text" id="username" name="username" placeholder="username" autofocus="on" autocomplete="off" style="border-radius: 10px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;" required>
    <input type="password" id="password" name="userpass" placeholder="password" style="border-radius: 10px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;" required>
    <!--
	<select name="location" id="location" required>
		  <option value="">- Choose Location -</option>
		  <option value="1">Jakarta Kyoai Medical</option>
		  <option value="2">Ejip Kyoai Medical</option>
		  <option value="3">Bali Kyoai Medical</option>
		  <option value="5">Karawang Kyoai Medical</option>
		  <option value="6">Karawang Barat Kyoai Medical</option>
	</select>
	-->
    <div class="login">
      <input name="Login" type="submit" id="Login" value="Login." class="uibutton" style="font-weight: bold; border-radius: 10px; border: 2px solid #679ACB; font-family: 'Arial';" />
    </div>
    </br>
    <a href="#"></a>
    <!-- /login -->
    </form>
  </div><!-- /wrap -->
  <div class='hint'>
    <p><br>
      <span><br>
      </span>
    </p>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <div id="SecondsUntilExpire" style="font-size: 12px;"></div>
</body>

</html>