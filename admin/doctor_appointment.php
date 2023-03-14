<?php
require ("navbar.php");
require_once '../dbconnection.php';

$error = false;

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

if(isset($_POST['m_app_add'])){

    $center_reg = mysqli_real_escape_string($con,$_POST['center_reg']);
    $m_doctor_nic = mysqli_real_escape_string($con,$_POST['m_doctor_nic']);
    $m_app_date = mysqli_real_escape_string($con,$_POST['m_app_date']);
    $m_start_time = mysqli_real_escape_string($con,$_POST['m_start_time']);
    $m_end_time = mysqli_real_escape_string($con,$_POST['m_end_time']);
    $m_app_amount = mysqli_real_escape_string($con,$_POST['m_app_amount']);

    if (empty($m_doctor_nic)) {
        $error = true;
        $m_doctor_nic_error = "Please Enter a Doctor NIC";

    }
    elseif(($sql_select = mysqli_query($con, "SELECT * FROM doctor WHERE nic='$m_doctor_nic' AND hospitalid = '$center_reg'")) && (mysqli_num_rows($sql_select) <= 0)) {
        $error = true;
        $m_doctor_nic_error = "Invalid NIC NO, Please Check and Try Again";
    }

    if (empty($m_app_date)) {
        $error = true;
        $m_app_date_error = "Please Enter the date";

    }

    if (empty($m_start_time)) {
        $error = true;
        $m_start_time_error = "Please Enter the starting time";

    }
    if (!empty($m_start_time)) {
        if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $m_start_time)) {
            $error = true;
            $m_start_time_error = "Time format should be HH:MM";
        }
    }

    if (empty($m_end_time)) {
        $error = true;
        $m_end_time_error = "Please Enter the ending time";

    }
    if (!empty($m_end_time)) {
        if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $m_end_time)) {
            $error = true;
            $m_end_time_error = "Time format should be HH:MM";
        }
    }

    if (empty($m_app_amount)) {
        $error = true;
        $m_app_amount_error = "Please Enter Number of Appointments";

    }
    if (!empty($m_app_amount)) {
        if (!preg_match("/^[0-9]*$/", $m_app_amount)) {
            $error = true;
            $m_app_amount_error = "Only Integer numbers are allowed";
        }
    }

    if (!$error) {
        $m_app_amount = intval($m_app_amount);
        if (mysqli_query($con, "INSERT INTO doctor_appointments(center_reg_no, doctor_nic,date,start_time,end_time,no_of_appointments) VALUES('$center_reg','$m_doctor_nic','$m_app_date','$m_start_time','$m_end_time','$m_app_amount')")) {

            header('Refresh:2; url=doctor_appointment.php');
            echo "Successfully Registered!";
        } else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}


if(isset($_POST['u_app_search'])){
    $center_reg = mysqli_real_escape_string($con,$_POST['center_reg']);
    $u_doctor_nic = mysqli_real_escape_string($con,$_POST['u_doctor_nic']);
    $u_app_date = mysqli_real_escape_string($con,$_POST['u_app_date']);


    if (empty($u_doctor_nic)) {
        $error=true;
        $u_doctor_nic_error = "Enter Doctor NIC No";
    }
    elseif(($sql_select_nic = mysqli_query($con, "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg'")) && (mysqli_num_rows($sql_select_nic) <= 0)) {
        $error = true;
        $u_doctor_nic_error = "Invalid NIC NO, Please Check and Try Again";
    }

    if (empty($u_app_date)) {
        $error=true;
        $u_app_date_error = "Enter the Date";
    }

    elseif(($sql_select_nic = mysqli_query($con, "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg' AND date='$u_app_date'")) && (mysqli_num_rows($sql_select_nic) <= 0)) {
        $error = true;
        $u_app_date_error = "Invalid Date, Please Check and Try Again";
    }


    if(!$error){
        $sql_appointment_info = "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg' AND date='$u_app_date'";
        $appointment_info = mysqli_query($con,$sql_appointment_info) or die('');
        $appointment_row = mysqli_fetch_array($appointment_info);
        $u_start_time = $appointment_row['start_time'];
    }

}

if(isset($_POST['u_app_update'])){

    $center_reg = mysqli_real_escape_string($con,$_POST['center_reg']);
    $u_doctor_nic = mysqli_real_escape_string($con,$_POST['u_doctor_nic']);
    $u_app_date = mysqli_real_escape_string($con,$_POST['u_app_date']);
    $u_start_time = mysqli_real_escape_string($con,$_POST['u_start_time']);
    $u_end_time = mysqli_real_escape_string($con,$_POST['u_end_time']);
    $u_app_amount = mysqli_real_escape_string($con,$_POST['u_app_amount']);

    if (empty($u_doctor_nic)) {
        $error = true;
        $u_doctor_nic_error = "Please Enter a Doctor NIC";

    }
    elseif(($sql_select_nic = mysqli_query($con, "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg'")) && (mysqli_num_rows($sql_select_nic) <= 0)) {
        $error = true;
        $u_doctor_nic_error = "Invalid NIC NO, Please Check and Try Again";
    }

    if (empty($u_app_date)) {
        $error = true;
        $u_app_date_error = "Please Enter the date";

    }

    if (empty($u_start_time)) {
        $error = true;
        $u_start_time_error = "Please Enter the starting time";

    }
    if (!empty($u_start_time)) {
        if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $u_start_time)) {
            $error = true;
            $u_start_time_error = "Time format should be HH:MM";
        }
    }

    if (empty($u_end_time)) {
        $error = true;
        $u_end_time_error = "Please Enter the ending time";

    }
    if (!empty($u_end_time)) {
        if (!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $u_end_time)) {
            $error = true;
            $u_end_time_error = "Time format should be HH:MM";
        }
    }

    if (empty($u_app_amount)) {
        $error = true;
        $u_app_amount_error = "Please Enter Number of Appointments";

    }
    if (!empty($u_app_amount)) {
        if (!preg_match("/^[0-9]*$/", $u_app_amount)) {
            $error = true;
            $u_app_amount_error = "Only Integer numbers are allowed";
        }
    }

    if (!$error) {
        $u_app_amount = intval($u_app_amount);
        if (mysqli_query($con, "UPDATE doctor_appointments SET start_time='$u_start_time',end_time='$u_end_time',no_of_appointments='$u_app_amount' WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg' AND date='$u_app_date'")) {

            header('Refresh:2; url=doctor_appointment.php');
            echo "Successfully Updated!";
        } else {
            echo "Error in updating...Please try again later!";
            mysqli_error($con);
        }
    }
}

if(isset($_POST['u_app_delete'])){
    $center_reg = mysqli_real_escape_string($con,$_POST['center_reg']);
    $u_doctor_nic = mysqli_real_escape_string($con,$_POST['u_doctor_nic']);
    $u_app_date = mysqli_real_escape_string($con,$_POST['u_app_date']);

    if (empty($u_doctor_nic)) {
        $error=true;
        $u_doctor_nic_error = "Enter Doctor NIC No";
    }
    elseif(($sql_select_nic = mysqli_query($con, "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg'")) && (mysqli_num_rows($sql_select_nic) <= 0)) {
        $error = true;
        $u_doctor_nic_error = "Invalid NIC NO, Please Check and Try Again";
    }

    if (empty($u_app_date)) {
        $error=true;
        $u_app_date_error = "Enter the Date";
    }

    elseif(($sql_select_nic = mysqli_query($con, "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg' AND date='$u_app_date'")) && (mysqli_num_rows($sql_select_nic) <= 0)) {
        $error = true;
        $u_app_date_error = "Invalid Date, Please Check and Try Again";
    }


    if(!$error && ($sql_select_appointments = mysqli_query($con, "SELECT * FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg' AND date='$u_app_date'")) && (mysqli_num_rows($sql_select_appointments) > 0)){

        $sql_delete_appointments = "DELETE FROM doctor_appointments WHERE doctor_nic='$u_doctor_nic' AND center_reg_no = '$center_reg' AND date='$u_app_date'";

        If(mysqli_query($con,$sql_delete_appointments)){
            header('Refresh:2; url=doctor_appointment.php');
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
        <div class="row row-top">
            <div class="col-md-3">
                <label for="center">Center ID:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="center_reg" value="<?php if(isset($center)) echo $center;?>" readonly>
            </div>
        </div>
        <br>
        <hr>
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Lab Appointments</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Test/ Hemodialysis:</label>
            </div>
            <div class="col-md-6">
                <select name="test" id="" class="form-control">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Date:</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="">
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <button type="button" class="btn btn-default" id="schsearch">Search</button>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-12 row-margin">
                <table width="100%" class="table-responsive">
                    <tr>
                        <th>No</th>
                        <th>Reference No</th>
                        <th>Time</th>
                        <th>Availability</th>
                        <th>Patient Name</th>
                        <th>Patient Phone 01</th>
                        <th>Patient Phone 02</th>
                        <th>Patient Address</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-12 print-icon">
            <i class="icon ion-printer print-icon"></i>
        </div>
        <br>
        <hr>
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Make Doctor Appointments</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="m_doctor">Doctor NIC:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="m_doctor_nic" value="<?= isset($_POST['m_doctor_nic']) ? $_POST['m_doctor_nic'] : ''; ?>">
                <span class="error"><?php if (isset($m_doctor_nic_error)) {echo $m_doctor_nic_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="m_app_date">Date:</label>
            </div>
            <div class="col-md-6">
                <input type="Date" class="form-control" name="m_app_date" value="<?= isset($_POST['m_app_date']) ? $_POST['m_app_date'] : ''; ?>">
                <span class="error"><?php if (isset($m_app_date_error)) {echo $m_app_date_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="m_app_time">Time:</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="m_start_time" value="<?= isset($_POST['m_start_time']) ? $_POST['m_start_time'] : ''; ?>" placeholder="Starting-hh:mm(24hr Clock)">
                <span class="error"><?php if (isset($m_start_time_error)) {echo $m_start_time_error;} ?></span>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="m_end_time" value="<?= isset($_POST['m_end_time']) ? $_POST['m_end_time'] : ''; ?>" placeholder="End-hh:mm(24hr Clock)">
                <span class="error"><?php if (isset($m_end_time_error)) {echo $m_end_time_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="m_app_amount">Number of Appointments:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="m_app_amount" value="<?= isset($_POST['m_app_amount']) ? $_POST['m_app_amount'] : ''; ?>" placeholder="In number (Ex: 20)">
                <span class="error"><?php if (isset($m_app_amount_error)) {echo $m_app_amount_error;} ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row btn-align-center">
                <input type="submit" class="btn btn-default" name="m_app_add" value="Add"/>
            </div>
        </div>
        <br>
        <hr>


        <!-- Manage Doctor Appointments-->
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Manage Doctor Appointments</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="u_doctor">Doctor NIC:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="u_doctor_nic" value="<?= isset($_POST['u_doctor_nic']) ? $_POST['u_doctor_nic'] : ''; ?>">
                <span class="error"><?php if (isset($u_doctor_nic_error)) {echo $u_doctor_nic_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="u_app_date">Date:</label>
            </div>
            <div class="col-md-6">
                <input type="Date" class="form-control" name="u_app_date" value="<?= isset($_POST['u_app_date']) ? $_POST['u_app_date'] : ''; ?>">
                <span class="error"><?php if (isset($u_app_date_error)) {echo $u_app_date_error;} ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <input type="submit" class="btn btn-default" name="u_app_search" value="Search"/>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="u_app_time">Time:</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="u_start_time" value="<?php if(isset($appointment_row)){echo date('H:i',strtotime(($appointment_row['start_time'])));} ?>" placeholder="Starting-hh:mm(24hr Clock)">
                <span class="error"><?php if (isset($u_start_time_error)) {echo $u_start_time_error;} ?></span>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="u_end_time" value="<?php if(isset($appointment_row)){echo date('H:i',strtotime(($appointment_row['end_time'])));} ?>" placeholder="End-hh:mm(24hr Clock)">
                <span class="error"><?php if (isset($u_end_time_error)) {echo $u_end_time_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="u_app_amount">Available Appointments:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="u_app_amount" value="<?php if(isset($appointment_row)){echo $appointment_row['no_of_appointments'];} ?>" placeholder="In number (Ex: 20)">
                <span class="error"><?php if (isset($u_app_amount_error)) {echo $u_app_amount_error;} ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row btn-align-center">
                <input type="submit" class="btn btn-default" name="u_app_update" value="Update"/>
                <input type="submit" class="btn btn-default" name="u_app_delete" value="Delete"/>
            </div>
        </div>
        <br>
        <hr>
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Manage Number of Appointments within a Day</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Test/ Hemodialysis:</label>
            </div>
            <div class="col-md-6">
                <select name="test" id="" class="form-control">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Date:</label>
            </div>
            <div class="col-md-6">
                <input type="Date" class="form-control" id="schdate">
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <button type="button" class="btn btn-default" id="schsearch">Search</button>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-12 row-margin">
                <table width="100%" class="table-responsive">
                    <tr>
                        <th>No</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Availability</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><label class="checkbox"><input type="checkbox" value="">Available</label></td>
                    </tr>
                </table>
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