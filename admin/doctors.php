<?php


require("navbar.php");

include_once '../dbconnection.php';

if(($userlevel == "2")){
    $sql_user_center = "SELECT * FROM center_admin WHERE user_name = '$username'";
    $user_center = mysqli_query($con, $sql_user_center) or die();
    $row = mysqli_fetch_array($user_center);

    $center = $row['center_reg_no'];
}
elseif(($userlevel == "3")){
    $sql_user_center = "SELECT * FROM users WHERE user_name = '$username'";
    $user_center = mysqli_query($con, $sql_user_center) or die();
    $row = mysqli_fetch_array($user_center);

    $center = $row['center_reg_no'];
}

//set validation error flag as false
$error = false;
//check if form is submitted
if (isset($_POST['submit'])) {

    $creg = mysqli_real_escape_string($con, $_POST['creg']);
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $nic = mysqli_real_escape_string($con, $_POST['nic']);
    $specialty = mysqli_real_escape_string($con, $_POST['specialty']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $profile = mysqli_real_escape_string($con, $_POST['profile']);

    if (empty($fname)) {
        $error = true;
        $fname_error = "Please Enter First Name";
    }

    if (!empty($fname)) {
        if (!preg_match("/^[A-Za-z]*$/", $fname)) {
            $error = true;
            $fname_error = "First name can only contain letters";
        }
    }

    if (empty($lname)) {
        $error = true;
        $lname_error = "Please Enter Last Name";
    }

    if (!empty($lname)) {
        if (!preg_match("/^[A-Za-z]*$/", $lname)) {
            $error = true;
            $lname_error = "First name can only contain letters";
        }
    }

    if (empty($nic)) {
        $error = true;
        $lnic_error = "Please Enter NIC";
    }

    if (!empty($nic)) {
        if (!preg_match("/^[0-9vV]*$/", $nic)) {
            $error = true;
            $nic_error = "Please enter valid NIC";
        }
        elseif( ($sql_doc = mysqli_query($con,"SELECT * FROM doctor WHERE nic='$nic'")) && (mysqli_num_rows($sql_doc) > 0)) {
            $error = true;
            $uname_error = "Doctor already exists";
        }
    }

    if ($specialty == 'Select') {
        $error = true;
        $specialty_error = "Please Enter specialty";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email";
    }

    if (empty($phone)) {
        $error = true;
        $phone_error = "Please Enter a Phone No";
    }

    if (!empty($phone)) {
        if (!preg_match("/^[0-9]*$/", $phone)) {
            $error = true;
            $phone_error = "Please Enter a Valid Phone No";
        } elseif (strlen($_POST["phone"]) != 10) {
            $phone_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (empty($_POST["address"])) {
        $error = true;
        $address_error = "Please Enter the Center Address";
    }

    if (empty($profile)) {
        $error = true;
        $profile_error = "Please Enter profile";
    }

    if (!$error) {
        if (mysqli_query($con, "INSERT INTO doctor(hodpitalid, fname,lname,nic,speciality,email,phone,address,profile) VALUES('$creg','$fname','$lname','$nic','$specialty','$email',$phone,'$address','$profile')")) {

            header('Refresh:2; url=doctors.php');
            echo "Successfully Registered!";
        } else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}

if(isset($_POST['doctor_search'])){
    $ucreg = mysqli_real_escape_string($con,$_POST['ucreg']);
    $unic = mysqli_real_escape_string($con,$_POST['unic']);


    if (empty($unic)) {
        $unic_error = "Enter Doctor NIC No";
    }


    if(!empty($unic)){
        $sql_doctor_info = "SELECT * FROM doctor WHERE nic ='$unic' AND hospitalid = '$ucreg'";
        $doctor_info = mysqli_query($con,$sql_doctor_info) or die('');
        $doctor_row = mysqli_fetch_array($doctor_info);
    }
    //hospitalid = '$ucreg' AND

}

if (isset($_POST['doctor_update'])) {
    $ucreg = mysqli_real_escape_string($con,$_POST['ucreg']);
    $unic = mysqli_real_escape_string($con, $_POST['unic']);

    $ufname = mysqli_real_escape_string($con, $_POST['ufname']);
    $ulname = mysqli_real_escape_string($con, $_POST['ulname']);
    //$uspeciality = mysqli_real_escape_string($con, $_POST['uspeciality']);
    $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
    $uphone = mysqli_real_escape_string($con, $_POST['uphone']);
    $uaddress = mysqli_real_escape_string($con, $_POST['uaddress']);
    $uprofile = mysqli_real_escape_string($con, $_POST['uprofile']);

    if (empty($ufname)) {
        $error = true;
        $ufname_error = "Please Enter First Name";
    }

    if (!empty($ufname)) {
        if (!preg_match("/^[A-Za-z]*$/", $ufname)) {
            $error = true;
            $ufname_error = "First name can only contain letters";
        }
    }

    if (empty($ulname)) {
        $error = true;
        $ulname_error = "Please Enter Last Name";
    }

    if (!empty($ulname)) {
        if (!preg_match("/^[A-Za-z]*$/", $ulname)) {
            $error = true;
            $lname_error = "First name can only contain letters";
        }
    }

    if (empty($unic)) {
        $error = true;
        $ulnic_error = "Please Enter NIC";
    }

    if (!empty($unic)) {
        if (!preg_match("/^[0-9vV]*$/", $unic)) {
            $error = true;
            $unic_error = "Please Enter valid NIC NO";
        }
    }

    /*if (empty($uspeciality)) {
        $error = true;
        $uspeciality_error = "Please Enter speciality";
    }*/

    if (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $uemail_error = "Please Enter Valid Email";
    }

    if (empty($uphone)) {
        $error = true;
        $uphone_error = "Please Enter a Phone No";
    }

    if (!empty($uphone)) {
        if (!preg_match("/^[0-9]*$/", $uphone)) {
            $error = true;
            $uphone_error = "Please Enter a Valid Phone No";
        } elseif (strlen($_POST["uphone"]) != 10) {
            $error = true;
            $uphone_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (empty($_POST["uaddress"])) {
        $error = true;
        $uaddress_error = "Please Enter the Doctor Address";
    }

    if (empty($uprofile)) {
        $error = true;
        $uprofile_error = "Please Enter Doctor profile";
    }


    if(!$error) {
        $update_doctor = "UPDATE doctor SET fname='$ufname',lname='$ulname',email='$uemail',phone='$uphone',address='$uaddress',profile='$uprofile' WHERE nic='$unic' AND hospitalid = '$ucreg'";

        if (mysqli_query($con,$update_doctor)){
            header('Refresh:2; url=doctors.php');
            echo "Successfully Updated!";
        }
        else {
            echo "Error in Updating...Please try again later!";
            echo mysqli_error($con);
        }

    }

}

if(isset($_POST['doctor_delete'])){
    $ucreg = mysqli_real_escape_string($con,$_POST['ucreg']);
    $unic = mysqli_real_escape_string($con, $_POST['unic']);

    if(empty($unic)){
        $error=true;
        $unic_error = "Please Enter NIC NO";
    }

    if (!$error && ($sql_select_doctor = mysqli_query($con, "SELECT * FROM doctor WHERE nic='$unic' AND hospitalid = '$ucreg'")) && (mysqli_num_rows($sql_select_doctor) <= 0)) {
        $unic_error = "<p align='center' style='color: red'>Invalid NIC NO, Please Check and Try Again</p>";
    }


    if(!$error && ($sql_select_doctor = mysqli_query($con, "SELECT * FROM doctor WHERE nic='$unic' AND hospitalid = '$ucreg'")) && (mysqli_num_rows($sql_select_doctor) > 0)){

        $sql_delete_doctor = "DELETE FROM doctor WHERE nic='$unic' AND hospitalid = '$ucreg'";

        If(mysqli_query($con,$sql_delete_doctor)){
            header('Refresh:2; url=doctors.php');
            echo "Successfully Deleted!";
        }


        else {
            echo "Error in Deleting...Please try again later!";
            echo mysqli_error($con);
        }

    }

}

//****************** start - Doctor Speciality select ***********
$query = "SELECT * FROM doctorspecialty";
$specialty_values = mysqli_query($con,$query);
//****************** end - Doctor Speciality select ***********

?>

<div class="col-md-8 col-xs-12 col-md-offset-1 admin-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="chaname">Channeling Center Reg:</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" name="ucreg" class="form-control" value="<?php if(isset($center)) echo $center;?>" readonly>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">NIC</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="unic" value="<?php if(isset($doctor_row)){echo $unic;} ?>">
            <span class="error"><?php if (isset($unic_error)) echo $unic_error; ?></span>
        </div>
        <div class="col-md-12 col-xs-12 row-top btn-align-center">
            <input type="submit" class="btn btn-default" name="doctor_search" value="Search">
        </div>

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">First Name</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="ufname" value="<?php if(isset($doctor_row)){echo $doctor_row['fname'];} ?>">
            <span class="error"><?php if (isset($ufname_error)) echo $ufname_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Last Name</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="ulname" value="<?php if(isset($doctor_row)){echo $doctor_row['lname'];} ?>">
            <span class="error"><?php if (isset($ulname_error)) echo $ulname_error; ?></span>
        </div>

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Speciality</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="uspeciality" value="<?php isset($_POST['uspeciality']) ? $_POST['uspeciality'] : ''; ?>">
            <span class="error"><?php if (isset($uspeciality_error)) echo $uspeciality_error; ?></span>
        </div>

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Email</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="email" class="form-control" name="uemail" value="<?php if(isset($doctor_row)){echo $doctor_row['email'];} ?>">
            <span class="error"><?php if (isset($uemail_error)) echo $uemail_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Phone</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="tel" class="form-control" name="uphone" value="<?php if(isset($doctor_row)){echo $doctor_row['phone'];} ?>">
            <span class="error"><?php if (isset($uphone_error)) echo $uphone_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Address</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="uaddress" value="<?php if(isset($doctor_row)){echo $doctor_row['address'];} ?>">
            <span class="error"><?php if (isset($uaddress_error)) echo $uaddress_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Profile</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
                                <textarea class="form-control" name="uprofile" rows="4" ><?php if(isset($doctor_row)){echo $doctor_row['profile'];} ?></textarea>
            <span class="error"><?php if (isset($uprofile_error)) echo $uprofile_error; ?></span>
        </div>
        <div class="col-md-12 col-xs-12 row-top btn-align-center">
            <input type="submit" class="btn btn-default" name="doctor_update" value="Update">
            <input type="submit" class="btn btn-default" name="doctor_delete" value="Delete">
        </div>
        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>

        <!--*********Doctor Register*************-->

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="chaname">Channeling Center Reg:</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" name="creg" class="form-control" value="<?php if(isset($center)) echo $center;?>" readonly>
            <span class="error"><?php if (isset($creg_error)) echo $creg_error; ?></span>
        </div>

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">First Name</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="fname"
                   value="<?php isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">
            <span class="error"><?php if (isset($fname_error)) echo $fname_error; ?></span>
        </div>


        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Last Name</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="lname"
                   value="<?php isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
            <span class="error"><?php if (isset($lname_error)) echo $lname_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">NIC</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="nic"
                   value="<?php isset($_POST['nic']) ? $_POST['nic'] : ''; ?>">
            <span class="error"><?php if (isset($lnic_error)) echo $lnic_error; ?></span>
        </div>

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Speciality</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <select name="specialty" class="form-control">
                <option>Select</option>
                <?php while($specialty_row = mysqli_fetch_array($specialty_values)) {

                    if ($specialty_row['specialty'] == $_POST['select_specialty'])
                        $selected = "selected=\"selected\"";
                    else
                        $selected = "";
                    echo "<option value=\"" . $specialty_row['specialty'] . "\" $selected>" . $specialty_row['specialty'] . "</option>\n ";

                }?>

            </select>
            <span class="error"><?php if (isset($specialty_error)) echo $specialty_error; ?></span>
        </div>

        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Email</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="email" class="form-control" name="email"
                   value="<?php isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <span class="error"><?php if (isset($email_error)) echo $email_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Phone</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="tel" class="form-control" name="phone"
                   value="<?php isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
            <span class="error"><?php if (isset($phone_error)) echo $phone_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Address</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
            <input type="text" class="form-control" name="address"
                   value="<?php isset($_POST['address']) ? $_POST['address'] : ''; ?>">
            <span class="error"><?php if (isset($address_error)) echo $address_error; ?></span>
        </div>
        <div class="col-md-3 col-xs-12 row-margin">
            <label for="">Profile</label>
        </div>
        <div class="col-md-8 col-xs-12 row-margin">
                                <textarea class="form-control" name="profile" rows="4"
                                          value="<?php isset($_POST['profile']) ? $_POST['profile'] : ''; ?>"></textarea>
            <span class="error"><?php if (isset($profile_error)) echo $profile_error; ?></span>
        </div>
        <div class="col-md-12 col-xs-12 row-top btn-align-center">
            <input type="submit" class="btn btn-default" name="submit" value="Submit">
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