<?php
session_start();
If(!empty($_SESSION["user_name"])) {
    $username = $_SESSION["user_name"];
}
?>

<!DOCTYPE html>
<body lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Page Description">
    <meta name="author" content="Chamara">
    <title>Page Title</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/mystyle.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<header>
    <div class="container">
        <div class="col-md-2 col-sm-3 col-xs-9">
            <a href="index.php">
                <img class="logo img-responsive" src="img/logo.png"></img>
            </a>
        </div>

        <div class="col-md-6 col-sm-5 navigation">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">Channelling</a></li>
                        <li><a href="index.php">Medical Checkup</a></li>
                        <li><a href="index.php">Hemodialysis</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </nav>

        </div>

        <div class="col-md-4 channel-menu">
            <ul class="ul-ch">
                <li class="li-ch li-a-ch"><a class="li-a-ch" href="channeling_history_search.php">Channel History</a></li>
                <li class="li-ch li-a-ch"><a class="li-a-ch" href="refund.php">Claim Re-fund</a></li>
            </ul>
        </div>
    </div>
</header>
<section class="login-signup-bar">
    <div class="container">
        <div class="col-xs-12">

             <ul class="ul-lr">
                 <li class="log-p"><?php if(isset($username)){echo $username;} else{echo '<a class="li-a-lr" href="login.php">Login</a>';} ?></li>
                <li class="log-p"><?php if(isset($username)){echo '<a class="li-a-lr" href="logout.php">Logout</a>';} else{echo '<a class="li-a-lr" href="register_step01.php">Register</a>';} ?></li>
            </ul>

        </div>
    </div>
</section>



