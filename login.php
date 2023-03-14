<?php
require ("header.php");

include_once 'dbconnection.php';

$error = false;

if(isset($_POST['submit'])) {
//Get values from login.php
    $username = $_POST['uname'];
    $password = $_POST['upw'];

    if (empty($username)) {
        $error = true;
        $username_error = "Please Enter Your e-mail";
    }

    if (empty($password)) {
        $error = true;
        $password_error = "Please Enter Your Password";
    }

    if (!$error) {
//To prevent SQL Injection
        $username = stripcslashes($username);
        $password = stripcslashes($password);

        $username = mysqli_real_escape_string($con, $username);
        $password = mysqli_real_escape_string($con, $password);
       /* $password = password_hash($password, PASSWORD_DEFAULT);*/

//query the database for user
        $result = mysqli_query($con, "SELECT * FROM login_levels WHERE user_name='$username'");
        $row = mysqli_fetch_array($result);

        if(!empty($row)){
            $db_password = $row['password'];

            if ($row['user_name'] == $username && password_verify($password, $db_password) && $row['user_level'] == 4) {

                header("Location:index.php");
                $_SESSION["user_name"] = $username;
            }

            if ($row['user_name'] == $username && password_verify($password, $db_password) && $row['user_level'] == 3) {

                header("Location:admin/index.php");
                $_SESSION["user_name"] = $username;
                $_SESSION["user_level"] = "3";
            }

            if ($row['user_name'] == $username && password_verify($password, $db_password) && $row['user_level'] == 2) {

                header("Location:admin/index.php");
                $_SESSION["user_name"] = $username;
                $_SESSION["user_level"] = "2";
            }

            if ($row['user_name'] == $username && password_verify($password, $db_password) && $row['user_level'] == 1) {

                header("Location:admin/index.php");
                $_SESSION["user_name"] = $username;
                $_SESSION["user_level"] = "1";
            }
        }
        else{
            $details_error = "Username or Password is Wrong";
        }

    }

}
?>

<div class="container">
        <div class="col-md-8 col-xs-12 col-md-offset-2 log-container">
            <div class="col-md-6 col-xs-12">

                <br>
                <h4>Login to ABC Medical </h4>
                    <ul>
                        <li>Take offers using credit cards during 10-04-2018 to 30-05-2018</li>
                        <li>Get discount amount by selecting Lab facilities</li>
                        <li>View and manage your accounts at your convenience.</li>
                        <li>Get more advantages by acquiring body checkup services more. </li>
                    </ul>

            </div>
            <div class="col-md-6 col-xs-12">

                <form action=""  method="post">

                    <div class="col-md-12 form-row-margin">
                        <label for="uname">User Name:</label>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="uname" placeholder="email" value="<?= isset($_POST['uname']) ? $_POST['uname'] : ''; ?>">
                        <span class="error"><?php if (isset($username_error)) echo $username_error; ?></span>
                    </div>
                    <div class="col-md-12 form-row-margin">
                        <label for="upw">Password:</label>
                    </div>
                    <div class="col-md-12">
                        <input type="password" class="form-control" name="upw" value="<?= isset($_POST['upw']) ? $_POST['upw'] : ''; ?>">
                        <span class="error"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>
                    <div class="col-md-12 form-row-margin btn-align">
                            <input type="submit" class="btn btn-default" name="submit" value="Login">
                    </div>
                    <div class="col-md-12 form-row-margin btn-align">
                        <span class="error"><?php if (isset($details_error)) echo $details_error; ?></span>
                    </div>
                    <div class="col-md-12 form-row-margin">
                        <h5 class="log-h5-style">or</h5>
                    </div>
                    <div class="col-md-12 form-row-margin btn-align">
                        <p>If You still not a member:</p>
                        <button type="button" class="btn btn-default" id="log"><a href="register_step01.php">Register</a></button>
                    </div>
                </form>
            </div>
        </div>
</div>


<?php
require ("footer.php")
?>
