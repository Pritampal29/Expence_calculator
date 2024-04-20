<?php
include('dbconn.php');
session_start();
$uid = $_SESSION['id'];

$today= date('Y-m-d');
$yesterday= date('Y-m-d',strtotime('yesterday'));
//echo $yesterday;die();

$firstDateOfMonth = date('Y-m-01');
$lastDateOfMonth = date('Y-m-t');

$firstDateOfYear = date('Y-01-01');
$lastDateOfYear = date('Y-12-31');
//echo $lastDateOfYear;die();

if(!empty($_GET['id'])) {
  $id= $_GET['id'];
  $delete= "DELETE FROM expence WHERE id='$id' ";
  $query= mysqli_query($conn,$delete);
  if($query) {
    header('location:reports.php');
  }
}
$date="";
if(isset($_GET['date'])){
  $date=$_GET['date'];
  //echo $date;die();
}

// PHP for Search Box
//$user_date="";
if(isset($_GET['search'])) {
  $from_date=$_GET['from_date'];
  $to_date=$_GET['to_date'];
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
            <li><i class="fa-solid fa-user fa-shake" style="color: #ff0000;"></i>&nbsp&nbsp<b
                    style="color:red"><?php echo $_SESSION['name'];?></b></li>
            <li>&nbsp&nbsp</li>
            <li>&nbsp&nbsp</li>
            <li><a href="index.php"><i class="fa-solid fa-house"></i>&nbsp&nbspHome</a></li>
            <li><a href="add_exp.php"><i class="fa-solid fa-cart-plus"></i>&nbsp&nbspAdd Expenses</a></li>
            <li><a class="active" href="reports.php"><i class="fa-sharp fa-solid fa-flag"></i>&nbsp&nbspReports</a></li>
            <li>&nbsp&nbsp</li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbsp&nbspLog Out</a></li>
        </ul>
    </div>

    <div class="container">
        <b style="color:yellow">&nbsp&nbsp&nbspCheck Report By Date Range: </b>
        <form method="GET">
            <div class="row">
                <div class="col">
                    <input type="date" name="from_date" />
                </div>
                <div class="col">
                    <input type="date" name="to_date" />
                </div>
                <div class="col">
                    <input class="btn btn-warning" type="submit" name="search" value="Search" /> <br>&nbsp
                </div>
            </div>
        </form>
    </div>

    <div class="content">
        <h2 style="color:black">Reports</h2>

        <table border=2 cellspecing="10px" cellpadding="10px" width=90% align="center">
            <tr>
                <th width=15%>SL No</th>
                <th width=35%>Purpose</th>
                <th width=15%>Amount</th>
                <th width=20%>Date</th>
                <th width=25%>Action</th>
            </tr>
        </table>
        <table border=2 cellspecing="10px" cellpadding="10px" width=90% align="center">
            <tr>
                <?php 
              if(isset($_GET['search'])){
                $from_date=$_GET['from_date'];
                $to_date=$_GET['to_date'];
                $select = "SELECT * FROM `expence` WHERE user_id='$uid' AND `date` BETWEEN '$from_date' AND '$to_date' "; 
              }elseif($date==$yesterday){
                  $select = "SELECT * FROM `expence` WHERE user_id='$uid' AND `date`='$yesterday'";
                }elseif($date==$today){
                  $select = "SELECT * FROM `expence` WHERE user_id='$uid' AND `date`='$today'";
                }else{
                  $select = "SELECT * FROM `expence` WHERE user_id='$uid' ORDER BY `id` DESC";
                }
                  $result = mysqli_query($conn,$select);
                
                  $i= 1;
                  while($row= mysqli_fetch_assoc($result)){ ?>
                <td style="color:black" width=15%><?php echo $i;?></td>
                <td style="color:black" width=35%><?php echo $row['purpose'];?></td>
                <td style="color:black" width=15%><?php echo $row['amount'];?></td>
                <td style="color:black" width=20%><?php echo $row['date'];?></td>
                <td style="color:black" width=25%><button type="delete" name="delete" class="btn btn-danger">
                        <a href="reports.php?id=<?php echo $row['id'];?>"><span style="color:white">Delete</a></button>
                </td>
            </tr>
            <?php $i++; } ?>
        </table>
        <hr>
        <table border=2 cellspecing="10px" cellpadding="10px" width=30% align="center">
            <tr>
                <th width=50%>Total</th>
                <th width=10%>
                    <?php 
                  if(isset($_GET['search'])){
                    $from_date=$_GET['from_date'];
                    $to_date=$_GET['to_date'];
                    $select = "SELECT SUM(amount) FROM `expence` WHERE user_id='$uid' AND `date` BETWEEN '$from_date' AND '$to_date' "; 
                  }elseif($date==$yesterday){
                    $select = "SELECT SUM(amount) FROM `expence` WHERE user_id='$uid' AND `date`='$yesterday'";
                  }elseif($date==$today){
                    $select = "SELECT SUM(amount) FROM `expence` WHERE user_id='$uid' AND `date`='$today'";
                  }else{
                    $select = "SELECT SUM(amount) FROM `expence` WHERE user_id='$uid'";
                  }
                    $query= mysqli_query($conn,$select);

                    while($row=mysqli_fetch_assoc($query)) { 
                      echo $row['SUM(amount)'];
                    }
                  ?>
                </th>
            </tr>
        </table>
        <hr>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Designed By Pritam</p>
    </footer>

    <script src="assets/script.js"></script>
</body>

</html>