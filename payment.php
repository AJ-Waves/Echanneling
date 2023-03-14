<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Page Description">
    <meta name="author" content="Chamara">
    <title>Page Title</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyle.css" rel="stylesheet">
    <link href="css/ionicons.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="payment-wrap">
    <?php
    session_start();
    include_once 'dbconnection.php';

    $salutation = $_SESSION['salutation'];
    $fname =  $_SESSION['fname'];
    $lname =  $_SESSION['lname'];
    $initials = $_SESSION['initials'];
    $email = $_SESSION['email'];
    $password = $_SESSION['pw'];
    $cpassword = $_SESSION['cpw'];
    $birthday = $_SESSION['birthday'];
    $nic = $_SESSION['nic'];
    $country = $_SESSION['country'];
    $address = $_SESSION['address'];
    $mobil = $_SESSION['phone1'];
    $land = $_SESSION['phone2'];
    $tfee = $_SESSION['tfee'];

    $error = false;

    if(isset($_POST['submit'])) {

        $name = $_POST['name'];
        $number = $_POST['number'];
        $cvv = $_POST['cvv'];
        $cex = $_POST['cex'];

        if (empty($name)) {
            $error = true;
            $name_error = "Please Enter Your Name";
        }
        if (empty($number)) {
            $error = true;
            $number_error = "Please Enter Card Number";
        }
        if (empty($cvv)) {
            $error = true;
            $cvv_error = "Please Enter CVV Number";
        }
        if (empty($cex)) {
            $error = true;
            $cex_error = "Please Enter EX Date";
        }

        //(mysqli_query($con, "INSERT INTO member(salutation,fname,lname,initials,emails,birthday,nic,country,address,mobile,land,fee) VALUES('$salutation','$fname','$lname','$initials','$email','$birthday', '$nic','$country', '$address', '$mobil', '$land', '$tfee')")) &&

        if(!$error){
            $password = password_hash($password, PASSWORD_DEFAULT);

            if ((mysqli_query($con, "INSERT INTO member(salutation,fname,lname,initials,emails,birthday,nic,country,address,mobile,land,fee) VALUES('$salutation','$fname','$lname','$initials','$email','$birthday', '$nic','$country', '$address', '$mobil', '$land', '$tfee')"))  && (mysqli_query($con, "INSERT INTO login_levels(user_name,password,user_level) VALUES('$email','$password',4)"))) {

                header('Refresh:2; url=index.php');
                echo "Successfully Registered!";
            }
            else {
                echo "Error in registering...Please try again later!";
                mysqli_error($con);
            }
        }
    }
    ?>

<div class="container">
    <div class="col-md-6 col-xs-12 col-md-offset-3 pay-container">
        <form method="post" action="">
            <div class="col-xs-12 form-row-margin">
                <div class="col-md-4">
                    <label for="">Name on Card:</label>
                </div>
                <div class="col-md-8"><input type="text" class="form-control" name="name">
                    <span class="error"><?php if (isset($name_error)) echo $name_error; ?></span></div>
            </div>

            <div class="col-xs-12 form-row-margin">
                <div class="col-md-4">
                    <label for="">Card Number:</label>
                </div>
                <div class="col-md-8"><input type="text" class="form-control" name="number">
                    <span class="error"><?php if (isset($number_error)) echo $number_error; ?></span></div>
            </div>

            <div class="col-xs-12 form-row-margin">
                <div class="col-md-4">
                    <label for="">CVV:</label>
                </div>
                <div class="col-md-8"><input type="text" class="form-control" name="cvv">
                    <span class="error"><?php if (isset($cvv_error)) echo $cvv_error; ?></span></div>
            </div>

            <div class="col-xs-12 form-row-margin">
                <div class="col-md-4">
                    <label for="">Card Expiry:</label>
                </div>
                <div class="col-md-8"><input type="text" class="form-control" name="cex">
                    <span class="error"><?php if (isset($cex_error)) echo $cex_error; ?></span></div>
            </div>

            <div class="col-xs-12 form-row-margin">
                <div class="col-md-4">
                    <label for="">Amount Rs.</label>
                </div>
                <div class="col-md-8"><input type="text" class="form-control" name="tfee" value="<?php if(isset($tfee)){echo $tfee;} ?>"></div>
            </div>
            <div class="row">
                <div class="col-md-12 form-row-margin">
                    <div class="col-md-4">
                        <input type="submit" class="btn btn-default" name="submit" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>