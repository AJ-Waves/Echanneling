<?php
require ("header.php");

$error = false;

if(isset($_POST['submit'])) {
    $salutation = $_POST['salutation'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $initials = $_POST['initials'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $cpw = $_POST['cpw'];
    $birthday = $_POST['birthday'];
    $nic = $_POST['nic'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $mobile = $_POST['phone1'];
    $land = $_POST['phone2'];

    if (empty($fname)) {
        $error = true;
        $fname_error = "Please Enter Your First Name";
    }

    if (!empty($fname)) {
        if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
            $error = true;
            $fname_error = "Name Only Can Contain Alphabet Characters";
        }
    }

    if (empty($lname)) {
        $error = true;
        $lname_error = "Please Enter Your Last Name";
    }

    if (!empty($lname)) {
        if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
            $error = true;
            $lname_error = "Name Only Can Contain Alphabet Characters";
        }
    }

    if (empty($initials)) {
        $error = true;
        $initials_error = "Please Enter Your Initials";
    }

    if (!empty($initials)) {
        if (!preg_match("/^[a-zA-Z ]*$/", $initials)) {
            $error = true;
            $initials_error = "Initials Should be Alphabetic Characters";
        }
    }

    if (empty($email)) {
        $error = true;
        $email_error = "Please Enter Your email";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email";
    }
    elseif( ($sql_user = mysqli_query($con,"SELECT * FROM login_levels WHERE user_name = '$email'")) && (mysqli_num_rows($sql_user) > 0)) {
        $error = true;
        $email = "Your email address already exists";
    }


    if (empty($pw)) {
        $error = true;
        $pw_error = "Please Enter a password";
    }

    if(!empty($pw)){
        if(strlen($_POST["pw"]) < 6) {
            $error = true;
            $pw_error = "Password must be minimum of 6 characters";
        }
    }


    if($_POST["pw"] != $_POST["cpw"]) {
        $error = true;
        $cpw_error = "Password and Confirm Password doesn't match";
    }

    if (empty($birthday)) {
        $error = true;
        $birthday_error = "Please Enter Your Birthday";
    }

    if (empty($nic)) {
        $error = true;
        $nic_error = "Please Enter Your NIC";
    }

    if (empty($country)) {
        $error = true;
        $country_error = "Please Select Your Country";
    }

    if (empty($address)) {
        $error = true;
        $address_error = "Please Enter Your Address";

    }

    if(empty($mobile)){
        $error = true;
        $mobile_error="Please Enter your Mobile Number";
    }

    if (!empty($mobile)) {
        if (!preg_match("/^[0-9]*$/", $mobile)) {
            $error = true;
            $mobile_error = "Please Enter a Valid Phone No";
        } elseif (strlen($mobile) != 10) {
            $mobile_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if(!$error){

        $_SESSION['salutation'] = $salutation;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['initials'] = $initials;
        $_SESSION['email'] = $email;
        /*$pw = password_hash($pw, PASSWORD_DEFAULT);*/
        $_SESSION['pw'] = $pw;
        $_SESSION['cpw'] = $cpw;
        $_SESSION['birthday'] = $birthday;
        $_SESSION['nic'] = $nic;
        $_SESSION['country'] = $country;
        $_SESSION['address'] = $address;
        $_SESSION['phone1'] = $mobile;
        $_SESSION['phone2'] = $land;
        header("Location:register_step02.php");
    }

}


?>

    <form method="post" action="">
    <div class="container form-container">
        <div class="row">
            <div class="col-md-12 col-xs-12 title-div">
                <h4>Channelling a Doctor - Step01</h4>
            </div>
        </div>

        <form method="post" action="register_step02.php">
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <label for="mname">Name:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-xs-12">
                            <select class="form-control" id="salutation" name="salutation">
                                <option value="Mr">Mr.</option>
                                <option value="Mrs">Mrs.</option>
                                <option value="Miss">Miss.</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?= isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">
                            <span class="error"><?php if (isset($fname_error)) echo $fname_error; ?></span>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?= isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
                            <span class="error"><?php if (isset($lname_error)) echo $lname_error; ?></span>
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <input type="text" class="form-control" name="initials" placeholder="Initials" value="<?= isset($_POST['initials']) ? $_POST['initials'] : ''; ?>">
                            <span class="error"><?php if (isset($initials_error)) echo $initials_error; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <label for="mememail">E-mail:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <input type="email" class="form-control" name="email" placeholder="Valid e-mail Address" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            <span class="error"><?php if (isset($email_error)) echo $email_error; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label for="mempw">Password:</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label for="mempwcon">Confirm Password:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <input type="password" class="form-control" name="pw" value="<?= isset($_POST['pw']) ? $_POST['pw'] : ''; ?>">
                            <span class="error"><?php if (isset($pw_error)) echo $pw_error; ?></span>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input type="password" class="form-control" name="cpw" value="<?= isset($_POST['cpw']) ? $_POST['cpw'] : ''; ?>">
                            <span class="error"><?php if (isset($cpw_error)) echo $cpw_error; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <label for="membday">Birthday:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <input type="date" class="form-control" name="birthday" value="<?= isset($_POST['birthday']) ? $_POST['birthday'] : ''; ?>">
                            <span class="error"><?php if (isset($birthday_error)) echo $birthday_error; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <label for="memnic">NIC/ Passport No:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <input type="text" class="form-control" name="nic" value="<?= isset($_POST['nic']) ? $_POST['nic'] : ''; ?>">
                            <span class="error"><?php if (isset($nic_error)) echo $nic_error; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <label for="memcountry">Country:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <select class="form-control" name="country" value="<?= isset($_POST['country']) ? $_POST['country'] : ''; ?>">
                                <option value=""></option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="USA">USA</option>
                                <option value="UK">UK</option>
                                <option value="India">India</option>
                            </select>
                            <span class="error"><?php if (isset($country_error)) echo $country_error; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row form-row-margin">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <label for="memaddress">Address:</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label for="memphone">Phone No:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <textarea class="form-control" name="address" rows="4" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>"></textarea>
                            <span class="error"><?php if (isset($address_error)) echo $address_error; ?></span>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="row form-row-margin">
                                <div class="col-md-12 col-xs-12">
                                    <input type="tel" class="form-control" name="phone1" placeholder="Mobile No. (Ex:0700000000)" value="<?= isset($_POST['phone1']) ? $_POST['phone1'] : ''; ?>">
                                    <span class="error"><?php if (isset($mobile_error)) echo $mobile_error; ?></span>
                                </div>
                            </div>
                            <div class="row form-row-margin">
                                <div class="col-md-12 col-xs-12">
                                    <input type="tel" class="form-control" name="phone2" placeholder="Land Phone No. (Ex:0111234567)" value="<?= isset($_POST['phone2']) ? $_POST['phone2'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="col-md-6 col-xs-12 refund-btn-align">
                    <input type="submit" class="btn btn-default" name="submit" value="Submit">
                </div>
            </div>
            <br>
        </form>
    </div>
</form>
<?php
require ("footer.php");
?>