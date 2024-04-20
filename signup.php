<?php
session_start();
include("./dbconn.php");
if(!empty($_SESSION)) {
    header("location:./index.php");
}
    if(isset($_POST['login'])) {
        $name= $_POST['name'];
        $email= $_POST['email'];
        $pwd= $_POST['password'];
        $c_pwd= $_POST['cpass'];
            if((!empty($name)) && (!empty($email)) && (!empty($pwd)) && (!empty($c_pwd))) {
                if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    if($pwd===$c_pwd) {
                        $select= "SELECT * FROM users WHERE email='$email'";
                        $query= mysqli_query($conn,$select);
                        $result= mysqli_num_rows($query);
                        if($result>0) {
                            header("location:./signup.php?error="."Email Already Exists");
                        }else{
                            $insert= "INSERT INTO users(name,email,password,role) VALUES ('$name','$email', '$pwd',2)";
                            $insertquery= mysqli_query($conn,$insert);
                            if($insertquery){
                                echo "<script>
                                alert('Registration Successfull');
                                window.location.href='./login.php';
                                </script>";
                            }else{
                                header("location:./signup.php?error="."Somethig Went Wrong");   
                            }
                        }
                    }else {
                        header("location:./signup.php?error="."Password Mismatch");   
                    }
                }else {
                    header("location:./signup.php?error="."Input Valid Email Address");
                }
            }else {
                header("location:./signup.php?error="."Input All The Fields");
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
    <title>Registration Page</title>
    <link rel="stylesheet" href="asset/style.css">
  </head>
  <body>
    <div class="center">
      <h1 style="color:#fff">Registration</h1>
      <?php 
						if(!empty($_GET['error'])) { ?>
							<div class="alert" style="padding: 10px; color: white; background-color: #f44336;">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
								<?php echo $_GET['error']; ?>
							</div>
						<?php } ?>
      <form action= "" method="POST">

        <div class="txt_field">
          <input type="text" name="name" id="email" required>
          <label>Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="email" id="email" required>
          <label>Email Address</label>
        </div>
        <div class="txt_field">
          <input type="password" name= "password" id="password" required>
          <label>Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name= "cpass" id="cpass" required>
          <label>Confirm Password</label>
        </div>
        
        <input type="submit" name= "login" value="Register">
        
        <div class="signup_link">
          Already member? <a href="login.php"><b>Login</a></b>
        </div>
      </form>
    </div>

  </body>
</html>