<?php include_once('header.php');
session_start();
 ?>
<div class="container-login100">
<div class="wrap-login100">
	<div class="login100-pic js-tilt" data-tilt>
		<h2><span class="label label-primary">
			VENDOR INQUIRY TOOL
		</span> </h2>
		<img src="images/img-01.png" alt="IMG">
	</div>

	<form class="login100-form validate-form" method="POST">
		<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
			<input class="input100" type="text" name="email" id="inputEmail" placeholder="Email">
			<span class="focus-input100"></span>
			<span class="symbol-input100">
				<i class="fa fa-envelope" aria-hidden="true"></i>
			</span>
		</div>

		<div class="wrap-input100 validate-input" data-validate = "Password is required">
			<input class="input100" type="password" name="pass" id="inputPassword" placeholder="Password">
			<span class="focus-input100"></span>
			<span class="symbol-input100">
				<i class="fa fa-lock" aria-hidden="true"></i>
			</span>
		</div>

		<div class="container-login100-form-btn">
			<button class="btn btn-primary btn-lg btn-block" id="login_button">
				Login
			</button>
		</div>

		<div class="text-center p-t-12">
		</div>

		<div class="text-center p-t-126">
				<b><a href="credits.php" target="_blank" style="color:blue;">&copy; Credits</a></b>
		</div>
	</form>
</div>
</div>
</div>
<?php include_once('footer.php'); ?>