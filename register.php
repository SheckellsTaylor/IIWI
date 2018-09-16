<?php # Script 16.6 - register.php
// This is the registration page for the site.

require_once ('includes/config.inc.php');
$page_title = 'Register';


if (isset($_POST['submitted'])) { // Handle the form.

	require_once (MYSQL);

	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$fn = $ln = $e = $p = FALSE;

	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}

	// Check for an email address:
	if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}

	if ($fn && $ln && $e && $p) { // If everything's OK...

		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_num_rows($r) == 0) { // Available.

			// Create the activation code:
			$a = md5(uniqid(rand(), true));

			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Send the email:
				$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@sitename.com');


				include ('registerThanks.php');

				exit();

			} else {
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}

		} else {
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}

	} else {
		echo '<p class="error">Please re-enter your passwords and try again.</p>';
	}

	mysqli_close($dbc);

}
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="swiper.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="mobile-angular-ui-base.min.css" />
<link rel="stlyesheet" href="css.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
<script src="mobile-angular-ui.min.js"></script>
<style>
  .back {background:url("background.jpg");
  background-size:cover;
  background-repeat:no-repeat;

}
.control-label {
  color:white;
  font-size:1.25em;
}
.contain {
  height:9em;
  width:auto;
background-color: rgba(0, 0, 255, 0.6);
  border-radius:1em;
  font-size:2em;
  text-align:center;
  color:white;

}
.space {
  padding:.5em;
  width:75%;
  color:black;
}
.wrap {
  height:9em;
}

.big {
  font-size:5em;
}
.swiper-container {
      width: 500px;
      height: 300px;
      margin: 20px auto;
  }

  .swiper-slide {
      text-align: center;
      font-size: 18px;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
  }
  .caption {
font-size:.7em;
float:right;
padding-right:1em;
padding-top:1em;
color:gray;
  }
	.seetext {
		color:black;
	}
</style>
<body class="back">
  <div class="container-fluid">
    <div class="page-header">
      <!-- Usage as a class -->

      <img src="Logo1.png" alt="Is It Worth It" class="img-circle center-block">

    <h1><p class="center-block container">Is It Worth It?</p>
      <!-- <small>Subtext for header</small> -->
    </h1>
  </div>


<br>



<h1>Register</h1>
<div class="swiper-container">

	 <div class="swiper-wrapper">

 <div class="swiper-slide"><div class="contain"><br>
	 <form action="register.php" method="post">
	 	<fieldset>
	<p><b>First Name:</b> <input class="seetext" type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
<p class="caption"><i>Swipe to the left...</i></p>
</div></div>
 <div class="swiper-slide"><div class="contain"><br>
	<p><b>Last Name:</b> <input class="seetext" type="text" name="last_name" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
<p class="caption"><i>Swipe to the left...</i></p>
</div></div>
 <div class="swiper-slide"><div class="contain"><br>
	<p><b>Email Address:</b> <input class="seetext" type="text" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /> </p>
<p class="caption"><i>Swipe to the left...</i></p>
</div></div>
 <div class="swiper-slide"><div class="contain"><br>
	<p><b>Password:</b> <input class="seetext" type="password" name="password1" size="20" maxlength="20" /> <small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></p>
<p class="caption"><i>Swipe to the left...</i></p>
</div></div>
 <div class="swiper-slide"><div class="contain"><br>
	<p><b>Confirm Password:</b> <input class="seetext" type="password" name="password2" size="20" maxlength="20" /></p>

	</fieldset>

	<div align="center"><input type="submit" name="submit" value="Register" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
</div></div>
</form>
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
<script src="swiper.min.js"></script>
<script>

	  var swiper = new Swiper('.swiper-container');
 	</script>
</body>
</html>
