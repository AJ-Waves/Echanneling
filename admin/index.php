<?php
require("navbar.php");
require_once '../dbconnection.php';

if($userlevel == "2"){
    $sql_user_center = "SELECT * FROM center_admin WHERE user_name = '$username'";
    $user_center = mysqli_query($con, $sql_user_center) or die();
    $row = mysqli_fetch_array($user_center);

    $center = $row['center_reg_no'];
}

$error = false;
if (isset($_POST['add'])) {
    $center_reg = mysqli_real_escape_string($con, $_POST['center_reg']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
    $upw = mysqli_real_escape_string($con, $_POST['upw']);
    $ucpw = mysqli_real_escape_string($con, $_POST['ucpw']);
    $empname = mysqli_real_escape_string($con, $_POST['empname']);
    $empaddress = mysqli_real_escape_string($con, $_POST['empaddress']);
    $empphone = mysqli_real_escape_string($con, $_POST['empphone']);


    if (empty($uname)) {
        $error = true;
        $uname_error = "Please Enter username";
    }

    if (!empty($uname)) {
        if (!preg_match("/^[a-z0-9]*$/", $uname)) {
            $error = true;
            $uname_error = "username only can contain simple letters and numbers";
        }
        elseif( ($sql_user = mysqli_query($con,"SELECT * FROM login_levels WHERE user_name = '$uname'")) && (mysqli_num_rows($sql_user) > 0)) {
            $error = true;
            $uname_error = "User name already exists";
        }
    }

    if (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $uemail_error = "Please Enter Valid Email";
    }

    if (empty($upw)) {
        $error = true;
        $upw_error = "Please Enter a password";
    }
    if((!empty($upw)) && (strlen($upw) < 6)) {
        $error = true;
        $upw_error = "Password must be minimum of 6 characters";
    }

    if($upw != $ucpw) {
        $error = true;
        $cpw_error = "Password and Confirmed Password doesn't match";
    }

    if (empty($empname)) {
        $error = true;
        $empname_error = "Please Enter User's Name";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$empname)) {
        $error = true;
        $empname_error = "Only letters and white space allowed";
    }

    if (empty($empaddress)) {
        $error = true;
        $empaddress_error = "Please Enter Users' Address";
    }

    if (empty($empphone)) {
        $error = true;
        $empphone_error = "Please Enter Phone Number";
    }

    if (!empty($empphone)) {
        if (!preg_match("/^[0-9]*$/",$empphone)) {
            $error = true;
            $empphone_error = "Please Enter a Valid Phone No";
        } elseif (strlen($empphone) != 10) {
            $empphone_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (!$error) {
        $upw = password_hash($upw, PASSWORD_DEFAULT);
        if ((mysqli_query($con, "INSERT INTO users(center_reg_no,user_name,emp_name,user_email,user_address,user_phone) VALUES('$center_reg','$uname','$empname','$uemail','$empaddress','$empphone')")) && (mysqli_query($con, "INSERT INTO login_levels(user_name,password,user_level) VALUES('$uname','$upw','3')"))) {

            header('Refresh:2; url=index.php');
            echo "Successfully Registered!";
        }
        else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}

if(isset($_POST['edit'])) {

    $u_user_name = mysqli_real_escape_string($con, $_POST['u_user_name']);
    $u_user_email = mysqli_real_escape_string($con, $_POST['u_user_email']);
    $u_users_name = mysqli_real_escape_string($con, $_POST['u_users_name']);
    $u_user_address = mysqli_real_escape_string($con, $_POST['u_user_address']);
    $u_user_phone = mysqli_real_escape_string($con, $_POST['u_user_phone']);


    if (!filter_var($u_user_email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $u_user_email_error = "Please Enter Valid Email";
    }

    if (empty($u_users_name)) {
        $error = true;
        $u_users_name_error = "Please Enter Users' Name";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$u_users_name)) {
        $error = true;
        $u_users_name_error = "Only letters and white space allowed";
    }

    if (empty($u_user_address)) {
        $error = true;
        $u_user_address_error = "Please Enter Address";
    }

    if (!empty($u_user_phone)) {
        if (!preg_match("/^[0-9]*$/",$u_user_phone)) {
            $error = true;
            $u_user_phone_error = "Please Enter a Valid Phone No";
        } elseif (strlen($u_user_phone) != 10) {
            $u_user_phone_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (!$error) {

        $update_center_admin = "UPDATE users SET emp_name='$u_users_name',user_email='$u_user_email',user_address='$u_user_address',user_phone='$u_user_phone' WHERE user_name='$u_user_name'";


        if (mysqli_query($con,$update_center_admin)){

            header('Refresh:2; url=index.php');
            echo "Successfully Updated!";
        }
        else {
            echo "Error in Updating...Please try again later!";
            echo mysqli_error($con);
        }
    }
}



if(isset($_GET['un_delete'])){
    $user = $_GET['un_delete'];


    $sql_users_info = "Delete FROM users WHERE user_name = '$user'";
    $sql_login_info = "Delete FROM login_levels WHERE user_name = '$user'";

    If((mysqli_query($con,$sql_users_info)) && (mysqli_query($con,$sql_login_info))){
        header('Refresh:2; url=index.php');
        echo "Successfully Deleted!";
    }


    else {
        echo "Error in Deleting...Please try again later!";
        echo mysqli_error($con);
    }
}
?>
<div class="col-md-8 col-xs-12 col-md-offset-1 admin-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="col-md-3">
            <label for="chaname">Channeling Center:</label>
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control" name="center_reg" value="<?php if(isset($center)) echo $center;?>" readonly>
        </div>

        <div class="col-md-12 row-margin">
            <h5 class="sch-h5">Update  Channelling Center User Details</h5>
        </div>

        <div class="col-md-12 row-margin">
            <?php
            if((!empty($center)) && ($center_user = mysqli_query($con,"SELECT * FROM users WHERE center_reg_no = '$center'")) && (mysqli_num_rows($center_user) > 0)){
                $sql_center_user_info = "SELECT * FROM users WHERE center_reg_no = '$center '";
                $center_user_info = mysqli_query($con, $sql_center_user_info) or die();

                echo "<table width='100%' class='table-responsive'>";
                echo "<tr><th>User Name</th><th>Name</th><th>E-mail</th><th>Address</th><th>Phone No</th><th>Action</th></tr>";
                while ($row = mysqli_fetch_array($center_user_info)) {
                    echo "<tr>
                        <td>{$row['user_name']}</td>
                        <td>{$row['emp_name']}</td>
                        <td>{$row['user_email']}</td>
                        <td>{$row['user_address']}</td>
                        <td>{$row['user_phone']}</td>
                        <td>
                        <p><a href='index.php? un=$row[user_name]& an=$row[emp_name]& ae=$row[user_email]& add=$row[user_address]& ap=$row[user_phone]'><i class='ion-android-create'></i></a>     <a href='index.php? un_delete=$row[user_name]'><i class='ion-android-delete'></i></a>
                        </p></td></tr>";
                }
                echo "</table>";
            }
            ?>
        </div>

        <div class="col-md-12 col-xs-12 row-margin">

            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_user_name_l">User Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="u_user_name" value="<?php if (isset($_GET['un'])) echo "$_GET[un]" ?>" readonly>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_email">E-mail:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="u_user_email" value="<?php if (isset($_GET['ae'])) echo "$_GET[ae]" ?>">
                <span class="error"><?php if (isset($u_user_email_error)) echo $u_user_email_error; ?></span>
            </div>

            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_name">Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="u_users_name" value="<?php if (isset($_GET['an'])) echo "$_GET[an]" ?>">
                <span class="error"><?php if (isset($u_users_name_error)) echo $u_users_name_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_address">address:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <textarea class="form-control" name="u_user_address" rows="2"><?php if (isset($_GET['add'])) echo "$_GET[add]" ?></textarea>
                <span class="error"><?php if (isset($u_user_address_error)) echo $u_user_address_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_phone">Phone:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="tel" class="form-control" name="u_user_phone" value="<?php if (isset($_GET['ap'])) echo "$_GET[ap]" ?>">
                <span class="error"><?php if (isset($u_user_phone_error)) echo $u_user_phone_error; ?></span>
            </div>

            <div class="col-xs-12 form-row-margin">
                <br>
                <input type="submit" class="btn btn-default" name="edit" value="Edit">
            </div>
        </div>




        <div class="col-md-12 row-margin">
            <br>
            <hr>
        </div>

        <div class="col-md-12 col-xs-12 row-margin">
            <div class="col-md-12 row-margin">
                <h5 class="sch-h5">Assigning New Channelling Center User</h5>
            </div>

            <div class="col-md-3 col-xs-12 row-margin">
                <label for="uname">User Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="uname" value="<?= isset($_POST['uname']) ? $_POST['uname'] : ''; ?>">
                <span class="error"><?php if (isset($uname_error)) echo $uname_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_email">E-mail:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="uemail" value="<?= isset($_POST['uemail']) ? $_POST['uemail'] : ''; ?>">
                <span class="error"><?php if (isset($uemail_error)) echo $uemail_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_pw">Password:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="password" class="form-control" name="upw" value="<?= isset($_POST['upw']) ? $_POST['upw'] : ''; ?>">
                <span class="error"><?php if (isset($upw_error)) echo $upw_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="upw">Confirm Password:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="password" class="form-control" name="ucpw" value="<?= isset($_POST['ucpw']) ? $_POST['ucpw'] : ''; ?>">
                <span class="error"><?php if (isset($ucpw_error)) echo $ucpw_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="name">Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="empname" value="<?= isset($_POST['empname']) ? $_POST['empname'] : ''; ?>">
                <span class="error"><?php if (isset($empname_error)) echo $empname_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="uaddress">address:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <textarea class="form-control" name="empaddress" rows="2"><?= isset($_POST['empaddress']) ? $_POST['empaddress'] : ''; ?></textarea>
                <span class="error"><?php if (isset($empaddress_error)) echo $empaddress_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="uphone">Phone:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="tel" class="form-control" name="empphone" value="<?= isset($_POST['empphone']) ? $_POST['empphone'] : ''; ?>">
                <span class="error"><?php if (isset($empphone_error)) echo $empphone_error; ?></span>
            </div>

            <div class="col-xs-12 form-row-margin">
                <br>
                <input type="submit" class="btn btn-default" name="add" value="Add">
            </div>
        </div>
    </form>
</div>
</div>
</div></div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>