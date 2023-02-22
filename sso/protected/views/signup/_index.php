<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Login / Register - SSO :: SWCS DEMO</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<style type="text/css">
			body {
				padding-top: 50px;
			}
			.panel-login {
				border-color: #ccc;
				-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
				-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
				box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
			}
			.panel-login > .panel-heading {
				color: #00415d;
				background-color: #fff;
				border-color: #fff;
				text-align: center;
			}
			.panel-login > .panel-heading a {
				text-decoration: none;
				color: #666;
				font-weight: bold;
				font-size: 15px;
				-webkit-transition: all 0.1s linear;
				-moz-transition: all 0.1s linear;
				transition: all 0.1s linear;
			}
			.panel-login > .panel-heading a.active {
				background-color: #029f5b;
				color: #fff;
				font-size: 20px;
				padding: 5px;
				-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=3, Direction=135, Color=#333333)";/*IE 8*/
				-moz-box-shadow: 3px 3px 3px #333333;/*FF 3.5+*/
				-webkit-box-shadow: 3px 3px 3px #333333;/*Saf3-4, Chrome, iOS 4.0.2-4.2, Android 2.3+*/
				box-shadow: 3px 3px 3px #333333;/* FF3.5+, Opera 9+, Saf1+, Chrome, IE10 */
				filter: progid:DXImageTransform.Microsoft.Shadow(Strength=3, Direction=135, Color=#333333); /*IE 5.5-7*/
				border: 1px solid #000000;
				-moz-border-radius: 10px;/*Firefox*/
				-webkit-border-radius: 10px;/*Safari, Chrome*/
				border-radius: 10px;
			}
			.panel-login > .panel-heading hr {
				margin-top: 10px;
				margin-bottom: 0px;
				clear: both;
				border: 0;
				height: 1px;
				background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
				background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
				background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
				background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
			}
			.panel-login input[type="text"], .panel-login input[type="email"], .panel-login input[type="password"] {
				height: 45px;
				border: 1px solid #ddd;
				font-size: 16px;
				-webkit-transition: all 0.1s linear;
				-moz-transition: all 0.1s linear;
				transition: all 0.1s linear;
			}
			.panel-login input:hover, .panel-login input:focus {
				outline: none;
				-webkit-box-shadow: none;
				-moz-box-shadow: none;
				box-shadow: none;
				border-color: #ccc;
			}
			.btn-login {
				background-color: #59B2E0;
				outline: none;
				color: #fff;
				font-size: 14px;
				height: auto;
				font-weight: normal;
				padding: 14px 0;
				text-transform: uppercase;
				border-color: #59B2E6;
			}
			.btn-login:hover, .btn-login:focus {
				color: #fff;
				background-color: #53A3CD;
				border-color: #53A3CD;
			}
			.forgot-password {
				text-decoration: underline;
				color: #888;
			}
			.forgot-password:hover, .forgot-password:focus {
				text-decoration: underline;
				color: #666;
			}

			.btn-register {
				background-color: #1CB94E;
				outline: none;
				color: #fff;
				font-size: 14px;
				height: auto;
				font-weight: normal;
				padding: 14px 0;
				text-transform: uppercase;
				border-color: #1CB94A;
			}
			.btn-register:hover, .btn-register:focus {
				color: #fff;
				background-color: #1CA347;
				border-color: #1CA347;
			}
			fieldset legend{
				background: -moz-linear-gradient(270deg, #c7c7c7 0%, #373737 100%);/* FF3.6+ */
				background: -webkit-gradient(linear, 270deg, color-stop(0%, #c7c7c7), color-stop(100%, #373737));/* Chrome,Safari4+ */
				background: -webkit-linear-gradient(270deg, #c7c7c7 0%, #373737 100%);/* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(270deg, #c7c7c7 0%, #373737 100%);/* Opera 11.10+ */
				background: -ms-linear-gradient(270deg, #c7c7c7 0%, #373737 100%);/* IE10+ */
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#c7c7c7', endColorstr='#373737', GradientType='1'); /* for IE */
				background: linear-gradient(180deg, #c7c7c7 0%, #373737 100%);/* W3C */
				color:#fff;
				font-weight:bold;
			}
		</style>
		<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			window.alert = function() {
			};
			var defaultCSS = document.getElementById('bootstrap-css');
			function changeCSS(css) {
				if (css)
					$('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="' + css + '" type="text/css" />');
				else
					$('head > link').filter(':first').replaceWith(defaultCSS);
			}


			$(document).ready(function() {
				var iframe_height = parseInt($('html').height());
				window.parent.postMessage(iframe_height, 'http://bootsnipp.com');
			});
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-login">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-6">
									<a href="#" class="active" id="login-form-link">Login</a>
								</div>
								<div class="col-xs-6">
									<a href="#" id="register-form-link">Register</a>
								</div>
							</div>
							<hr>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form id="login-form" action="<?=$this->createUrl('/signup')?>" method="post" role="form" style="display: block;">

										<input type="hidden" name="CALL_BACK_URL" value="<?=$CALL_BACK_URL ?>" />

										<div class="form-group">
											<label for="exampleInputEmail1">IUID / Email-ID</label>
											<input type="text" required="required" name="username" class="form-control" id="exampleInputEmail1" placeholder="IUID / Email-ID">
										</div>
										<div class="form-group">
											<label for="exampleInputPassword1">Password</label>
											<input type="password" required="required" name="passwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
										</div>

										<center>
											<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-info btn-block" value="Log In">
										</center>
										<input type="hidden" name="CALL_BACK_URL" value="<?=$CALL_BACK_URL ?>" />
									</form>
									<form action="<?=$this->createUrl('/signup')?>" method="post" id="register-form" style="display: none;">
										<input type="hidden" name="CALL_BACK_URL" value="<?=$CALL_BACK_URL ?>" />
										<fieldset>
    										<legend>Entrepreneur Registration</legend>
											<div class="form-group">
												<label for="fname">First Name</label>
												<input type="text" required="required" id="fname" class="form-control" name="First Name" placeholder="First Name">
											</div>
											<div class="form-group">
												<label for="lname">Last Name</label>
												<input type="text" required="required" id="lname" class="form-control" name="Last Name" placeholder="Last Name">
											</div>
	
											<div class="form-group">
												<label for="pan">PAN Card No</label>
												<input type="text" id="pan" required="required" class="form-control" name="PAN" placeholder="PAN Card No">
											</div>
											<div class="form-group">
												<label for="uid">Adhaar No</label>
												<input type="text" id="uid" required="required" class="form-control" name="Adhaar" maxlength="12" placeholder="Adhaar No">
											</div>
										</fieldset>
										
										<fieldset>
    										<legend>Contact Details</legend>
											<div class="form-group">
												<label for="addr">Address</label>
												<textarea name="address" type="text" id="addr" required="required" class="form-control"  placeholder="Address"></textarea>
											</div>
											
											<div class="form-group">
												<label>City Name</label>
												<input type="text" required="required" class="form-control" name="City" placeholder="City Name">
											</div>
											
											<div class="form-group">
												<label>District Name</label>
												<input type="text" required="required" class="form-control" name="District" placeholder="District Name">
											</div>
											
											
											<div class="form-group">
												<label>State Name</label>
												<input type="text" required="required" class="form-control" name="State" placeholder="State Name">
											</div>
											
											<div class="form-group">
												<label>Country Name</label>
												<input type="text" required="required" class="form-control" name="Country" placeholder="Country Name">
											</div>
											
											<div class="form-group">
												<label>PIN Code</label>
												<input type="text" required="required" class="form-control" name="PIN" placeholder="PIN Code">
											</div>
											
											<div class="form-group">
												<label>Mobile</label>
												<input type="text" required="required" class="form-control" name="mobile" placeholder="Mobile Number">
											</div>
											
											<div class="form-group">
												<label>E-mail</label>
												<input type="text" required="required" class="form-control" name="email" placeholder="E-mail Address">
											</div>
										</fieldset>
										
										<fieldset>
    										<legend>Login Details</legend>
											<div class="form-group">
												<label>Password</label>
												<input type="text" required="required" class="form-control" name="password1" placeholder="Password">
											</div>
											<div class="form-group">
												<label>Confirm Password</label>
												<input type="text" required="required" class="form-control" name="password2" placeholder="Confirm Password">
											</div>
											
										</fieldset>
										<p>
											<br />
										</p>
										<center>
											<input type="submit" name="login-submit" id="register-form-link" tabindex="4" class="btn btn-info btn-block" value="Register">
										</center>
									</form>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(function() {

				$('#login-form-link').click(function(e) {
					$("#login-form").delay(100).fadeIn(100);
					$("#register-form").fadeOut(100);
					$('#register-form-link').removeClass('active');
					$(this).addClass('active');
					e.preventDefault();
				});
				$('#register-form-link').click(function(e) {
					$("#register-form").delay(100).fadeIn(100);
					$("#login-form").fadeOut(100);
					$('#login-form-link').removeClass('active');
					$(this).addClass('active');
					e.preventDefault();
				});

			});

		</script>
	</body>
</html>
