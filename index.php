<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700" />
    <link rel="stylesheet" href="/bugfree-shame/assets/css/foundation.css" />
    <link rel="stylesheet" href="/bugfree-shame/assets/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="/bugfree-shame/assets/css/animate-custom.css" />
    <script src="/bugfree-shame/assets/js/vendor/modernizr.js"></script>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <?php require_once('lib/includeClass.php');?>
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
      <a href="#" id="reg" class="small button">Create Account</a>
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
            <form  action="mysuperscript.php" autocomplete="on"> 
              <h1>Log in</h1> 
              <p> 
              <label for="username" class="uname" data-icon="u" > Your email or username </label>
              <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
              </p>
              <p> 
              <label for="password" class="youpasswd" data-icon="p"> Your password </label>
              <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
              </p>
              <p class="keeplogin"> 
              <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
              <label for="loginkeeping">Keep me logged in</label>
              </p>
              <a href="#" class="button expand">LOGIN</a>
              <p class="change_link">
              Not a member yet ?
              <a href="#toregister" class="to_register">Join us</a>
              </p>
            </form>
          </div>

        <div id="register" class="animate form">
          <form  action="mysuperscript.php" autocomplete="on"> 
            <h1> Sign up </h1> 
            <p> 
            <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
            <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
            </p>
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
            <a href="#" class="button expand">REGISTER</a>
            <p class="change_link">  
            Already a member ?
            <a href="#tologin" class="to_register"> Go and log in </a>
            </p>
          </form>
        </div>
    </div>
    </div>
    </div>
    <script src="/bugfree-shame/assets/js/vendor/jquery.js"></script>
    <script src="/bugfree-shame/assets/js/foundation.min.js"></script>
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
          if ( e.keyCode === 27 ) { // ESC
            $('.overlay').hide();
            $('#wrapper').hide();
      } });
    </script>
  </body>
</html>