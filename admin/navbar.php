<?php
session_start();
If(!empty($_SESSION["user_name"])) {
    $username = $_SESSION["user_name"];
    $userlevel = $_SESSION["user_level"];
}
?>

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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="adstyle.css" rel="stylesheet">
    <link href="../css/ionicons.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-2 nav-bar">
            <div class="row">
                <section class="login-signup-bar">
                    <ul>
                        <li class="log-a"><?php if(isset($username)){echo $username;} ?></li>
                        <li class="log-li-a"><?php if(isset($username)){echo '<a class="log-a" href="\echanneling\logout.php">Logout</a>';}?></li>
                    </ul>
                </section>
                <ul>
                    <li><a href="index.php">Users</a></li>
                    <li><a href="doctors.php">Doctors</a></li>
                    <li><a href="schedule.php">Schedules</a></li>
                    <li><a href="labappoint.php">Lab Appointments</a></li>
                    <li><a href="center_manage.php">Channeling Centers</a></li>
                    <li><a href="fee_assign.php">Fee Assigning</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li><a href="center_admin.php">Center Admin</a></li>
                    <li><a href="admin.php">Site Admin</a></li>
                </ul>
            </div>
        </div>

