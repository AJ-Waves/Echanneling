<?php
require("navbar.php");
require_once '../dbconnection.php';

$error = false;
if (isset($_POST['add'])) {
    $admin_user_name = mysqli_real_escape_string($con, $_POST['admin_user_name']);
    $admin_email = mysqli_real_escape_string($con, $_POST['admin_email']);
    $admin_pw = mysqli_real_escape_string($con, $_POST['admin_pw']);
    $admin_cpw = mysqli_real_escape_string($con, $_POST['admin_cpw']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    $admin_address = mysqli_real_escape_string($con, $_POST['admin_address']);
    $admin_phone = mysqli_real_escape_string($con, $_POST['admin_phone']);

    if (empty($admin_user_name)) {
        $error = true;
        $admin_user_name_error = "Please Enter username";
    }

    if (!empty($admin_user_name)) {
        if (!preg_match("/^[a-z0-9]*$/", $admin_user_name)) {
            $error = true;
            $admin_user_name_error = "username only can contain simple letters and numbers";
        }
        elseif( ($sql_user = mysqli_query($con,"SELECT * FROM login_levels WHERE user_name = '$admin_user_name'")) && (mysqli_num_rows($sql_user) > 0)) {
            $error = true;
            $admin_user_name_error = "User name already exists";
        }
    }

    if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $admin_email_error = "Please Enter Valid Email";
    }

    if (empty($admin_pw)) {
        $error = true;
        $admin_pw_error = "Please Enter a password";
    }
    if(strlen($admin_pw) < 6) {
        $error = true;
        $admin_pw_error = "Password must be minimum of 6 characters";
    }

    if($admin_pw != $admin_cpw) {
        $error = true;
        $admin_cpw_error = "Password and Confirmed Password doesn't match";
    }

    if (empty($admin_name)) {
        $error = true;
        $admin_name_error = "Please Enter Users' Name";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$admin_name)) {
        $error = true;
        $admin_name_error = "Only letters and white space allowed";
    }

    if (empty($admin_address)) {
        $error = true;
        $admin_address_error = "Please Enter Address";
    }

    if (!empty($admin_phone)) {
        if (!preg_match("/^[0-9]*$/",$admin_phone)) {
            $error = true;
            $admin_phone_error = "Please Enter a Valid Phone No";
        } elseif (strlen($admin_phone) != 10) {
            $admin_phone_error = "Phone Number Must Contain 10 Digits";
        }
    }


    if (!$error) {
        $admin_pw = password_hash($admin_pw, PASSWORD_DEFAULT);

        if ((mysqli_query($con, "INSERT INTO site_admin(user_name,admin_name,admin_email,admin_address,admin_phone) VALUES('$admin_user_name','$admin_name','$admin_email','$admin_address','$admin_phone')")) && (mysqli_query($con, "INSERT INTO login_levels(user_name,password,user_level) VALUES('$admin_user_name','$admin_pw','1')"))) {

            header('Refresh:2; url=admin.php');
            echo "Successfully Registered!";
        }
        else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}

if(isset($_POST['search'])){
    $user_name = $_POST['user_name'];

    if (empty($user_name)) {
        $user_name_error = "Enter the Admins' User Name";
    }

    if(!empty($user_name)){
        $sql_center_info = "SELECT * FROM site_admin WHERE user_name = '$user_name'";
        $admin_info = mysqli_query($con,$sql_center_info) or die();
        $admin_row = mysqli_fetch_array($admin_info);
    }

}

if(isset($_POST['edit'])) {

    $user_name = $_POST['user_name'];

    if (empty($user_name)) {
        $user_name_error = "Enter the Admins' User Name";
    }
    $u_user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $u_admin_email = mysqli_real_escape_string($con, $_POST['u_admin_email']);
    $u_admin_name = mysqli_real_escape_string($con, $_POST['u_admin_name']);
    $u_admin_address = mysqli_real_escape_string($con, $_POST['u_admin_address']);
    $u_admin_phone = mysqli_real_escape_string($con, $_POST['u_admin_phone']);


   if (!filter_var($u_admin_email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $u_admin_email_error = "Please Enter Valid Email";
    }

    if (empty($u_admin_name)) {
        $error = true;
        $u_admin_name_error = "Please Enter Users' Name";
    }
    if (!preg_match("/^[a-zA-Z ]*$/",$u_admin_name)) {
        $error = true;
        $u_admin_name_error = "Only letters and white space allowed";
    }

    if (empty($u_admin_address)) {
        $error = true;
        $u_admin_address_error = "Please Enter Address";
    }

    if (!empty($u_admin_phone)) {
        if (!preg_match("/^[0-9]*$/",$u_admin_phone)) {
            $error = true;
            $u_admin_phone_error = "Please Enter a Valid Phone No";
        } elseif (strlen($u_admin_phone) != 10) {
            $u_admin_phone_error = "Phone Number Must Contain 10 Digits";
        }
    }

   if (!$error) {

        $update_site_admin = "UPDATE site_admin SET admin_name='$u_admin_name',admin_email='$u_admin_email',admin_address='$u_admin_address',admin_phone='$u_admin_phone' WHERE user_name='$user_name'";


        if (mysqli_query($con,$update_site_admin)){

            header('Refresh:2; url=admin.php');
            echo "Successfully Updated!";
        }
        else {
            echo "Error in Updating...Please try again later!";
            echo mysqli_error($con);
        }
    }
}

if(isset($_POST['delete'])){
    $user_name = $_POST['user_name'];

    if (empty($user_name)) {
        $user_name_error = "Enter the Channelling Center Registration Number";
    }

    if(!empty($user_name)){

        $sql_center_info = "Delete FROM site_admin WHERE user_name = '$user_name'";
        $sql_lab_info = "Delete FROM login_levels WHERE user_name = '$user_name'";

        If((mysqli_query($con,$sql_center_info)) && (mysqli_query($con,$sql_lab_info))){
            header('Refresh:2; url=admin.php');
            echo "Successfully Deleted!";
        }
        else {
            echo "Error in Deleting...Please try again later!";
            echo mysqli_error($con);
        }
    }
}

?>
<div class="col-md-8 col-xs-12 col-md-offset-1 admin-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <div class="col-md-12 row-margin">
            <h5 class="sch-h5">Update Site Admin</h5>
        </div>

        <div class="col-md-3 col-xs-12">
            <label for="up_admin_user_name" class="btn-label-padding">User Name:</label>
        </div>

        <div class="col-md-7">
            <input type="text" name="user_name" class="form-control" value="<?= isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" placeholder="Enter Admins' user name and press Search">
            <span class="error"><?php if (isset($user_name_error)) echo $user_name_error; ?></span>

        </div>
        <div class="col-md-2 col-xs-12">
            <button type="submit" name="search" class="btn btn-default btn-label-padding"><i class="ion-ios-search"></i></button>
        </div>

        <div class="col-md-12 col-xs-12 row-margin">

            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_email">E-mail:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="u_admin_email" value="<?php if (isset($admin_row)) echo "$admin_row[admin_email]" ?>">
                <span class="error"><?php if (isset($u_admin_email_error)) echo $u_admin_email_error; ?></span>
            </div>

            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_name">Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="u_admin_name" value="<?php if (isset($admin_row)) echo "$admin_row[admin_name]" ?>">
                <span class="error"><?php if (isset($u_admin_name_error)) echo $u_admin_name_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_address">address:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <textarea class="form-control" name="u_admin_address" rows="2"><?php if (isset($admin_row)) echo "$admin_row[admin_address]" ?></textarea>
                <span class="error"><?php if (isset($u_admin_address_error)) echo $u_admin_address_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="u_admin_phone">Phone:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="tel" class="form-control" name="u_admin_phone" value="<?php if (isset($admin_row)) echo "$admin_row[admin_phone]" ?>">
                <span class="error"><?php if (isset($u_admin_phone_error)) echo $u_admin_phone_error; ?></span>
            </div>

            <div class="col-xs-12 form-row-margin">
                <br>
                <input type="submit" class="btn btn-default" name="edit" value="Edit">
                <input type="submit" class="btn btn-default" name="delete" value="Delete">
            </div>
        </div>



        <div class="col-md-12 row-margin">
            <br>
            <hr>
        </div>
        <div class="col-md-12 row-margin">
            <h5 class="sch-h5">Assigning New Admin</h5>
        </div>

        <div class="col-md-12 col-xs-12 row-margin">

            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_user_name">User Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="admin_user_name" value="<?= isset($_POST['admin_user_name']) ? $_POST['admin_user_name'] : ''; ?>">
                <span class="error"><?php if (isset($admin_user_name_error)) echo $admin_user_name_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_email">E-mail:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="admin_email" value="<?= isset($_POST['admin_email']) ? $_POST['admin_email'] : ''; ?>">
                <span class="error"><?php if (isset($admin_email_error)) echo $admin_email_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_pw">Password:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="password" class="form-control" name="admin_pw" value="<?= isset($_POST['admin_pw']) ? $_POST['admin_pw'] : ''; ?>">
                <span class="error"><?php if (isset($admin_pw_error)) echo $admin_pw_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_cpw">Confirm Password:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="password" class="form-control" name="admin_cpw" value="<?= isset($_POST['admin_cpw']) ? $_POST['admin_cpw'] : ''; ?>">
                <span class="error"><?php if (isset($admin_cpw_error)) echo $admin_cpw_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_name">Name:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="text" class="form-control" name="admin_name" value="<?= isset($_POST['admin_name']) ? $_POST['admin_name'] : ''; ?>">
                <span class="error"><?php if (isset($admin_name_error)) echo $admin_name_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_address">address:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <textarea class="form-control" name="admin_address" rows="2"><?= isset($_POST['admin_address']) ? $_POST['admin_address'] : ''; ?></textarea>
                <span class="error"><?php if (isset($admin_address_error)) echo $admin_address_error; ?></span>
            </div>
            <div class="col-md-3 col-xs-12 row-margin">
                <label for="admin_phone">Phone:</label>
            </div>
            <div class="col-md-7 col-xs-12 row-margin">
                <input type="tel" class="form-control" name="admin_phone" value="<?= isset($_POST['admin_phone']) ? $_POST['admin_phone'] : ''; ?>">
                <span class="error"><?php if (isset($admin_phone_error)) echo $admin_phone_error; ?></span>
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
