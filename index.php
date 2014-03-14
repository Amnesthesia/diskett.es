<!doctype html>
<!-- This whole file is a dummy to give an example of the front-end and allow for testing. -->
<!-- During the front-end project, the front-end will reach it's final form -->

<?php require_once("lib/configurationClass.php");?>
<?php session_start(); ob_start(); ?>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700" />
    <link rel="stylesheet" href="assets/css/foundation.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate-custom.css" />
    <script src="assets/js/vendor/modernizr.js"></script>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <?php require_once(PATH.'lib/includeClass.php');?>
    <?php require_once(PATH.'lib/userClass.php'); ?>
  </head>
  <body>
<div class="overlay"></div>
  <nav class="top-bar hide-for-small" data-topbar=""> 
    <ul class="title-area"> 
      <li class="name"> 
        <h1><a href="?">EpisodeGuide</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> 
    </ul>
  <section class="top-bar-section"> 
  <!-- Right Nav Section --> 
  <ul class="right"> 
<li class="has-form"> 
<div class="row collapse"> 
<div class="large-8 small-9 columns">
<form method="get" action="">
<input type="hidden" name="page" value="search" /> 
<input type="text" name="searchquery" placeholder="Search shows"> 
</div> 
<div class="large-4 small-3 columns">
<input type="submit" value="Search" class="alert button expand">
</form>
</div>
</div>
</li>
    <li class="divider"></li>
    <li class="has-dropdown not-click">
      <a class="" href="#">Test</a>
      <ul class="dropdown">
        <li class="title back js-generated"></li>
        <li><a href="#">Dropdown 1</a></li>
        <li><a href="#">Dropdown 2</a></li>
      </ul>
    </li>
    <li class="divider"></li>
        <li class="has-dropdown not-click">
          <a class="" href="#">Test</a>
          <ul class="dropdown">
            <li class="title back js-generated"></li>
            <li><a href="#">Dropdown 1</a></li>
            <li><a href="#">Dropdown 2</a></li>
          </ul>
      </li>
    <li class="divider"></li>
        <li class="has-dropdown not-click">
          <a class="" href="#">Test</a>
          <ul class="dropdown">
            <li class="title back js-generated"></li>
            <li><a href="#">Dropdown 1</a></li>
            <li><a href="#">Dropdown 2</a></li>
          </ul>
      </li>
    <li class="divider"></li>
    <li class="has-form">
      <?php echo (User::isLoggedIn() == true) ? '<a href="#" id="reg" class="small button">Account</a>' : '<a href="#" id="reg" class="small button">Login</a>'; ?>
    </li>
  </ul>
  </section>
  </nav>
  <div id="content">
    <?php IncludePage::view(@$_GET['page']); ?>
    <div id="container">
    <!-- hidden anchor to stop jump  -->
      <a class="hiddenanchor" id="toregister"></a>
      <a class="hiddenanchor" id="tologin"></a>
        <div id="wrapper">
          <div id="login" class="animate form">
            <form action="#" method="post" autocomplete="on"> 
              <h1>Log in</h1> 
              <p> 
              <label for="email" class="uname" data-icon="u" > Your email address </label>
              <input id="email" name="email" required="required" type="email" placeholder="mymail@mail.com"/>
              </p>
              <p> 
              <label for="password" class="youpasswd" data-icon="p"> Your password </label>
              <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
              </p>
              <p class="keeplogin"> 
              <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
              <label for="loginkeeping">Keep me logged in</label>
              </p>
              <input type="submit" name="login" value="Login">
              <p class="change_link">
              Not a member yet ?
              <a href="#toregister" class="to_register">Join us</a>
              </p>
            </form>
          </div>

        <div id="register" class="animate form">
          <form action="#" method="post" autocomplete="on"> 
            <h1> Sign up </h1> 
            <p> 
            <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
            <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
            </p>
            <p> 
            <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
            <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
            </p>
            <p> 
            <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
            <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
            </p>
            <input type="submit" name="register" value="Register account">
            <p class="change_link">  
            Already a member ?
            <a href="#tologin" class="to_register"> Go and log in </a>
            </p>
          </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="assets/js/vendor/jquery.js"></script>
    <script src="assets/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    <script>
      $(document).ready(function(){
        $('#reg').click(function(e) {
        $('.overlay').show();
        $('#wrapper').show();
        $('html, body').animate({ scrollTop: $('#wrapper').offset().top }, 'slow');
      }); });
    </script>
    <script>
      $(document).on('keydown', function (e) {
          if (e.keyCode == 27) { // ESC
            $('.overlay').hide();
            $('#wrapper').hide();
      } });
    </script>
  </body>
</html>

<?php

if (isset($_POST['login']) || isset($_POST['register']))
{
  if (isset($_POST['login'])) // Login for existing users
  {
    $user = DatabaseHandler::getInstance()->readToClass('SELECT * FROM user WHERE email=?', $_POST['email'], 'User');
    $user[0]->login($_POST['password']);

    // TODO: Make sure a user is logged in before redirect
    header('Location: ?');
  }
  else // Register new user - TODO: Check if user already exist and catch exception
  {
    $user = new User($_POST['emailsignup'], $_POST['passwordsignup'], 0, 'en'); // Do we need the user to specify a country?
    $user->register();
  }
}
ob_end_flush();
?>
