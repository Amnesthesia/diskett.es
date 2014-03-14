<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700" />
    <link rel="stylesheet" href="/bugfree-shame/assets/css/foundation.css" />
    <link rel="stylesheet" href="/bugfree-shame/assets/css/custom.css" />
    <script src="/bugfree-shame/assets/js/vendor/modernizr.js"></script>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="/bugfree-shame/assets/js/jquery.leanModal.min.js"></script>
    <?php require_once('lib/includeClass.php');?>
  </head>
  <body>
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
      <a href="#signup" id="register" rel="leanModal" class="small button">Create Account</a>
    </li>
  </ul>
  </section>
    </div>
  </nav>
  <div id="content">
    <?php IncludePage::view(@$_GET['page']); ?>
  </div>
  </nav>
    <script src="/bugfree-shame/assets/js/vendor/jquery.js"></script>
    <script src="/bugfree-shame/assets/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>