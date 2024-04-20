<?php
session_start();
include('dbconn.php');

if(isset($_POST['submit'])) {
  $datest= $_POST['date'];
  $date= date('Y-m-d',strtotime($datest));
  $purpose= $_POST['purpose'];
  $amount= $_POST['amount'];
  $uid=  $_SESSION['id'];

  $insert= "INSERT INTO `expence`(`user_id`,`purpose`,`amount`,`date`) VALUES('$uid','$purpose','$amount','$date')";
  $result= mysqli_query($conn,$insert);
  if($result) {
    header('location:reports.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expenses Management</title>
  <link rel="stylesheet" type="text/css" href="assets/style.css">
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
      <li><a href="index.php"><i class="fa-solid fa-house"></i>&nbsp&nbspHome</a></li>
      <li><a class="active" href="add_exp.php"><i class="fa-solid fa-cart-plus"></i>&nbsp&nbspAdd Expenses</a></li>  
      <li><a href="reports.php"><i class="fa-sharp fa-solid fa-flag"></i>&nbsp&nbspReports</a></li>
      <li>&nbsp&nbsp</li>
      <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp&nbspLog Out</a></li>
      </ul>
  </div>
  
  <div class="content">
    <h2 style="color:black">Add Expense</h2>
    
        <form method="POST">
            <div>
                <label for="date">Date:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div>
                <label for="purpose">Purpose:</label>
                <input type="text" id="purpose" name="purpose" required>
            </div>
            <div>
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" required>
            </div>
            <button class="btn btn-secondary" type="submit" name="submit">Add Expense</button>
        </form>
    </div>

  <footer>
    <p>&copy; <?php echo date('Y'); ?> Designed By Pritam</p>
  </footer>

  <script src="assets/script.js"></script>
</body>
</html>
