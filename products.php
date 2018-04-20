
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Điện Máy Xanh Welcome</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	 <?php
   date_default_timezone_set('Asia/Ho_Chi_Minh');
   $date = date('m/d/Y h:i:s a', time());
   $ti= date(time());
        if(!isset($_POST['action'])){
          $username =  $_POST['username'];
          $pr_ID =  $_POST['pr_ID'];
          $password = $_POST['abc'];
          ?>
          <form  method="post">
            <input type="hidden" name="username" value="<?php echo $username ?>">
            <input type="hidden" name="pr_ID" value="<?php echo $pr_ID ?>">
            <input type="hidden" name="date_buy" value="<?php echo $date ?>">
          </form>
          <?php
            $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, "http://207.148.79.221:8080/DMX/products/Services/Buy/");
 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

            $data = array('username'=>$_POST['username'],'pr_ID'=>$_POST['pr_ID'],'date_buy'=>$date);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            $output = curl_exec($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            if($output =="true"){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://207.148.79.221:8080/DMX/products/Services/bill/");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

                $data = array('username'=>$_POST['username'],'pr_ID'=>$_POST['pr_ID']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

                $json = curl_exec($ch);
                $result = json_decode($json,true);
                $info = curl_getinfo($ch);
                curl_close($ch);
                ?>

			<div class="container" align="center" >
			
                <h2 align="center">BILL DETAIL</h2>
                <table  class="table" >
				 <thead>
                  <tr>
                    <td>Name: </td>
                    <td><?php 
                    echo $result["name"]; ?></td>
                  </tr>
                  <tr>
                    <td>Name Products: </td>
                    <td><?php 
                    echo $result["book_name"]; ?></td>
                  </tr>
                  <tr>
                    <td>Qanity: </td>
                    <td><?php echo $result["qty"]; ?></td>
                  </tr>
                  <tr>
                    <td>Total: </td>
                    <td><?php echo $result["money"]; ?> (vnd)</td>
                  </tr>
                  <tr>
                    <td>Date: </td>
                    <td><?php echo $result["date"]; ?></td>
                  </tr>
				 </thead>               
                </table>
				
			</div>
				<br>
				<br>
              <div align="center">
                      <form method="POST" action="home.php" >
                        <input type="hidden" name="username" value="<?php echo $username?>">
                        <input type="hidden" name="password" value="<?php echo $password ?>">
						<button type="submit" class="btn btn-success">BUY NEXT</button>
                        
                      </form>             
              </div>
			  <br>
			  <br>
			    <div align="center">
                  <form action="home.php"  method="post">
                    
					<button type="submit" class="btn btn-danger">LOG OUT</button>
                  </form>
                </div>
                <?php
				
            }
			
            else{
              ?>
                <script>
                    alert("This Items is not available");
                    history.back();
                </script>
              <?php
            }
        }
    ?>
</body>
</html>