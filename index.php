
<!DOCTYPE html>
<html>
<link rel="stlyesheet" href="css.css" />
<link rel="stylesheet" href="mobile-angular-ui-base.min.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
<script src="mobile-angular-ui.min.js"></script>
<style>
  .back {background:url("images/back.png");
  background-size:cover;
  background-repeat:no-repeat;

}
.control-label {
  color:white;
  font-size:1.25em;

}

.center {
margin:5%;
}
.that {
  color:white;
}

</style>
<body class="back">
  <?php # Script 16.5 - index.php
  // This is the main page for the site.

  // Include the configuration file:
  require_once ('includes/config.inc.php');

  // Set the page title and include the HTML header:
  $page_title = 'Welcome to this Site!';
  include ('includes/header.php');

  // Welcome the user (by name if they are logged in):
  echo '<h1>Welcome';
  if (isset($_SESSION['first_name'])) {
  	echo ", {$_SESSION['first_name']}!";
  }
  echo '</h1>';
  ?>
  <div class="container-fluid">
    <div class="page-header">
      <!-- Usage as a class -->

      <img src="Logo1.png" alt="Is It Worth It" class="img-circle center-block">

    <h1><p class="center-block container that">Is It Worth It?</p>
      <!-- <small>Subtext for header</small> -->
    </h1>
  </div>


<br>
<div class="contianer">
  <div class="row section-primary">
    <div class="col center">
<form class="form-horizontal" action="login.php" method="post">
  <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-8">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" name="email" size="20" maxlength="40" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
</div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-8">
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="pass" size="20" maxlength="20" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
</div>
</div>

  <div class="row pull-left">
    <div class="col-xs-6 col-sm-4">
       <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" name="submit" value="Login">Log In</button>
          	<input type="hidden" name="submitted" value="TRUE" />
        </div>
      </div>
    </div>
  </div>
<div class="row pull-right">
    <div class="col-xs-6 col-sm-4">
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a type="submit" class="btn btn-default" href="register.php">Register</a>
      </div>
    </div>
  </div>
</div>
    <!-- Optional: clear the XS cols if their content doesn't match in height -->
    <div class="clearfix visible-xs-block"></div>

  </div>

</form>
</div>
</div>
</div>
<div class="container-fluid ">
<div class="row center-block">

      <div class="col-sm-offset-2 col-sm-10">
Is It Worth It? &copy 2017
</div>
</div>
</div>



  </div><!--closes fluid container-->

</body>
</html>
