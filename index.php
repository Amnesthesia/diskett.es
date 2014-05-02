<!doctype html>
<!-- This whole file is a dummy to give an example of the front-end and allow for testing. -->
<!-- During the front-end project, the front-end will reach it's final form -->

<?php require_once("lib/configurationClass.php");?>
<?php session_start(); ob_start(); ?>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EpisodeGuide</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700" />
    <link rel="stylesheet" href="assets/css/foundation.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/animate-custom.css" />
    
    <script data-main="assets/js/config" src="assets/js/lib/requirejs/require.js"></script>

    <?php require_once(PATH.'lib/includeClass.php');?>
    <?php require_once(PATH.'lib/userClass.php'); ?>

    <!-- Replace with EmberJS log-in later -->
    <script type="text/javascript">
      <?php echo (User::isLoggedIn() == true) ? 'var loggedin = true;' : 'var loggedin = false;'; ?>
    </script>
  </head>
  <body>
  <div class="overlay"></div>

  <!-- Navigation goes here -->
  <section id="navigation"></section>

  <div id="content">
    <script type="text/x-handlebars">
    {{outlet}}
    <!-- Grid should go here --> 
    </script>

    <!-- Login / Sign up goes here -->
    <section id="signuplogin"></section>
  </div>


  <!-- Templates go here (we'll add some AJAX loading for them later) -->
  <script id="shows-template" type="text/x-handlebars" data-template-name="shows">
  <div class="row">
     {{#each controller itemController="show"}} 
      <div class="small-3 columns browse-list browse-item overlay-trigger" id="{{unbound id}}">
      <a href="?page=details&amp;id={{unbound id}}" title="{{unbound name}}">
        <img src="media/posters/{{unbound poster}}" alt="media/posters/{{unbound poster}}" />
      </a>
      <a href="#" title="{{unbound name}}">
        <h5>{{name}}</h5>
      </a>
      <div class="grid-list-overlay">
        <fieldset class="list-item-summary">
          <label class="title">{{name}}></label>
          <div class="star" style="width: {{unbound ratingLength}}px;">&nbsp;</div>
          <label>{{summary}}</label>
          

        </fieldset>
      </div>
    </div>
    {{/each}}
  </div> 
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
