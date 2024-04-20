<?php 
session_start(); 

if(empty($_SESSION)) {
  header("location:./login.php");
}
include('dbconn.php');
$uid=  $_SESSION['id'];

$today= date('Y-m-d');
//echo $today;die();
$yesterday= date('Y-m-d',strtotime('yesterday'));

$firstDateOfMonth = date('Y-m-01');
$lastDateOfMonth = date('Y-m-t');

$firstDateOfYear = date('Y-01-01');
$lastDateOfYear = date('Y-12-31');
//echo $lastDateOfYear;die();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expenses Management</title>
  <link rel="stylesheet" type="text/css" href="assets/style.css">
  <link rel="stylesheet" type="text/css" href="assets/theme.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  
  <script src="https://kit.fontawesome.com/816bfae410.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <h1>Expense Management</h1>
  </header>
  <div class="sidebar">
    <ul>
      <li><i class="fa-solid fa-user fa-shake" style="color: #ff0000;"></i>&nbsp&nbsp<b style="color:red"><?php echo $_SESSION['name'];?></b></li>
      <li>&nbsp&nbsp</li>
      <li>&nbsp&nbsp</li>
      <li><a class="active" href="index.php"><i class="fa-solid fa-house"></i>&nbsp&nbspHome</a></li>
      <li><a href="add_exp.php"><i class="fa-solid fa-cart-plus"></i>&nbsp&nbspAdd Expenses</a></li>  
      <li><a href="reports.php"><i class="fa-sharp fa-solid fa-flag"></i>&nbsp&nbspReports</a></li>
      <li>&nbsp&nbsp</li>
      <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp&nbspLog Out</a></li>
      <li>&nbsp&nbsp</li>
      <?php if($_SESSION['user_type'] == 1) {?>
      <li>&nbsp&nbsp</li>
      <li><i class="fa-solid fa-user-plus fa-bounce" style="color: green;"></i><b>&nbsp&nbspTotal User (<?php 
           $select="SELECT COUNT(id) FROM users";
           $query= mysqli_query($conn,$select);

           while($row=mysqli_fetch_assoc($query)) {
            echo $row['COUNT(id)'];
          }
          ?>)</a></b></li>
      <?php } ?>
    </ul>
  </div>
 
  <div class="content">
  
    <h2>Welcome <?php echo $_SESSION['name'];?></h2>

    <div class="row row-cols-1 row-cols-md-2 g-2">
  <div class="col">
  <div class="card text-bg-light mb-3" style="max-width: 13rem;"> 
      <div class="card-body">
        <h6 class="card-title">Today Expenses</h6>
        <h4 class="card-text">Rs.-
          <?php 
            $select= "SELECT SUM(amount) FROM expence WHERE user_id='$uid' AND `date`='$today' ";
            $query= mysqli_query($conn,$select);

            while($row=mysqli_fetch_assoc($query)) { 
              echo $row['SUM(amount)'];
            }
          ?>
          </h4>
          
          <h6><a href="./reports.php?date=<?php echo $today; ?>">Details</a></h6>

      </div>
    </div>
  </div>
  <div class="col">
  <div class="card text-bg-light mb-3" style="max-width: 13rem;"> 
      <div class="card-body">
        <h6 class="card-title">Yesterday</h6>
        <h4 class="card-text">Rs.-
        <?php 

            $select= "SELECT SUM(amount) FROM expence WHERE user_id='$uid' AND `date`='$yesterday' ";
            $query= mysqli_query($conn,$select);

            while($row=mysqli_fetch_assoc($query)) {
              echo $row['SUM(amount)'];
            }
          ?>
        </h4>
        <h6><a href="./reports.php?date=<?php echo $yesterday ;?>">Details</a></h6>
      </div>
    </div>
  </div>
  <div class="col">
  <div class="card text-bg-warning mb-3" style="max-width: 13rem;">
      <div class="card-body">
        <h6 class="card-title">This Month</h6>
        <h4 class="card-text">Rs.-
        <?php 
            $select= "SELECT SUM(amount) FROM `expence` WHERE `user_id`='$uid' AND `date` BETWEEN '$firstDateOfMonth' AND '$lastDateOfMonth' ";
            $query= mysqli_query($conn,$select);

            while($row=mysqli_fetch_assoc($query)) {
              echo $row['SUM(amount)'];
            }
          ?>
        </h4>
      </div>
    </div>
  </div>
  <div class="col">
  <div class="card text-bg-danger mb-3" style="max-width: 13rem;">
      <div class="card-body">
        <h6 class="card-title">This Year</h6>
        <h4 class="card-text">Rs.-
        <?php 
            $select= "SELECT SUM(amount) FROM `expence` WHERE `user_id`='$uid' AND `date` BETWEEN '$firstDateOfYear' AND '$lastDateOfYear' ";
            $query= mysqli_query($conn,$select);

            while($row=mysqli_fetch_assoc($query)) {
              echo $row['SUM(amount)'];
            }
          ?>
        </h4>
      </div>
    </div>
  </div>
</div>
</div>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Designed By Pritam</p>
  </footer>

  <script src="assets/script.js"></script>
</body>
</html>
