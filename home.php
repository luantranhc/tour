
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
  ?>

	<head>
	<title>Điện Máy Xanh</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>

<body>

 </div>

 	<div id="h1log"  class="container-login100" style="background-image: url('images/bg-01.jpg');">
		<div  id = "signInForm" class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form  method="post" class="login100-form validate-form">
				<span  class="login100-form-title p-b-37">
					Sign In
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
					<input class="input100" type="text" name="username" placeholder="username or email">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="password" placeholder="password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">
						Sign In
					</button>
				</div>

				<div class="text-center p-t-57 p-b-20">
					<span class="txt1">
						Or login with
					</span>
				</div>

				<div class="flex-c p-b-112">
					<a href="#" class="login100-social-item">
						<i class="fa fa-facebook-f"></i>
					</a>

					<a href="#" class="login100-social-item">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
					</a>
				</div>

				<div class="text-center">
					<a href="#" class="txt2 hov1">
						Sign Up
					</a>
				</div>
			</form>

			
		</div>
	</div>
	<!--

 <div id="divlog"><h1 id="h1log" align="center">Book Store :: LogIn</h1></div>

  <div id="InputForm" align="center">
    <form id="signInForm" method="post" autocomplete="false">
      <p>
        Username : <input type="text" name="username" required />
      </p>

      <p>
        Password : <input type="password" name="password" required />
      </p>

      <button id="submitBtn" type="submit" class="button">LOGIN</button>
    </form>
  </div>
	
-->
	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


	<!-- Bottom scripts (common) -->
	<script src="assets/js/gsap/TweenMax.min.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="assets/js/neon-custom.js"></script>


	<!-- Demo Settings -->
	<script src="assets/js/neon-demo.js"></script>
  
  
  <!----login -->
  
  <?php
    if (isset($_POST['username']) && isset($_POST['password']) || isset($_POST['action']))
    {
		
      // Send username/password to Tomcat server for authenticatings
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://207.148.79.221:8080/DMX/products/Services/Login/");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

      $data = array('username'=>$_POST['username'],'password'=>$_POST['password']);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

      $output = curl_exec($ch);
      $info = curl_getinfo($ch);
      curl_close($ch);
echo "check mail";
      //If the server returns TRUE, then print something
		if($output == "true")
		{ 
			$_SESSION['username'] = isset($_POST['username']) ;
			// Send username to Tomcat server to send login email confirmation
			echo "check mail";
				$url = "http://207.148.79.221:8080/DMX/products/Services/Sendmail/" . $_POST['username'];
				$ch_username = curl_init();
				curl_setopt($ch_username, CURLOPT_URL, $url);
				curl_setopt($ch_username, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch_username, CURLOPT_FOLLOWLOCATION, true);
				curl_exec($ch_username);
				curl_close($ch_username);
				
		?>
			<script>
			  var child = document.getElementById("signInForm");
			  child.parentNode.remove(child);
			  var child1 = document.getElementById("h1log");
			  child1.parentNode.remove(child1);
			</script>
			
			<div
				align="center"><h1 style="border:2px solid DodgerBlue;" style = "color:Tomato;">Điện Máy Xanh Welcome</h1>
			</div>
			
			<?php
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "http://207.148.79.221:8080/DMX/products/Services/Listbooks/");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

				$data = array();
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

				$jsonString = curl_exec($ch);
				$arr = json_decode($jsonString,true);
				$info = curl_getinfo($ch);
				curl_close($ch);
			?>

		   <h2  align ="center" style="color:Tomato;">LIST PRODUCTS</h2>
		  <div id="BUYFORM">
			<form id="buy" method="POST" action="products.php">
				<div class="container">
					<p>Mua đi đừng ngại</p>            
					<table class="table">
					<thead>
					  <tr>
						<td>Id</td>
						<td>Name</td>
						<td>Qty</td>
						<td>Price</td>
					  </tr>
					  
					<?php
						foreach ($arr as $test) {
							?>
								<tr>
									<td>
									  <?php
										echo $test["id"] ;
										?>
									</td>
									<td>
									  <?php
										echo $test["name"] ;
										?>
									</td>
									<td>
									  <?php
										echo $test["qty"] ;
										?>
									</td>
									<td>
									  <?php
										echo $test["price"] ;
										?>
									</td>
									<td>
										<input type="radio" name="pr_ID" required value="<?php echo $test["id"] ?>" >
									</td>
								</tr>
							<?php
						}
					?>
					</thead>
				</table>
				  
					<input type="hidden" name="abc" required value="<?php echo $_POST['password'] ?>" >
					<div align="center" >
						<button type="submit" class="btn btn-success" name="username" value="<?php echo $_POST['username'] ?>"> BUY</button>
					</div>
					<br>
		</form>
			</div>
			
			<!-- Example split danger button -->
			<div align="center">
				  <form method="post" action="home.php">
					<button type="submit" class="btn btn-danger">LOG OUT</button>
				  </form>
			</div>

	<?php
		}
	
      else
      {
        echo "Username or Password is invalid";
      }
	}
  ?>
</body>
</html>