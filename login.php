
<?php
include('dbconn.php');
session_start();
if(!empty($_SESSION)) {
  header("location:./index.php");
}

if(isset($_POST['login'])) {
$email= $_POST['email'];
$pwd= $_POST['password'];

  if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $select= "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pwd' ";
    $query= mysqli_query($conn,$select);
    $result= mysqli_num_rows($query);
    $row= mysqli_fetch_assoc($query);
    //print_r($row);die();
      if($result>0) {
        $_SESSION['user_type'] = $row['role'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        
          echo"<script>
            alert('Login Successfull');
            window.location.href='./index.php';
            </script>";
      }else{
        header("location:./login.php?error="."Invalid Credential");
      }
  }else {
    header("location:./login.php?error="."Incorrect Email Address");
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Login Page</title>
    <link rel="stylesheet" href="asset/loginstyle.css">
  </head>
  <body>
    <div class="center">
      <h1 style="color:#fff">Login</h1>
      <?php 
						if(!empty($_GET['error'])) { ?>
							<div class="alert" style="padding: 10px; color: white; background-color: #f44336;">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
								<?php echo $_GET['error']; ?>
							</div>
						<?php } ?>
      <form action= "" method="POST">
        
        <div class="txt_field">
          <input type="text" name="email" id="email" required>
          <label>Username/Email Address</label>
        </div>
        <div class="txt_field">
          <input type="password" name= "password" id="password" required>
          <label>Password</label>
        </div>
        
        <input type="submit" name= "login" value="Login">
        
        <div class="signup_link">
          Not a member? <a href="signup.php"><b>Signup</b></a>
        </div>
      </form>
    </div>

  </body>
</html>
