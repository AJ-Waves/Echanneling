<?php
require("navbar.php");
require_once "../dbconnection.php";

//Doctor Speciality Manage----------------
$error=false;
if (isset($_POST['add_speciality'])) {

    $specialty = mysqli_real_escape_string($con, $_POST['specialty']);
    $spc_description = mysqli_real_escape_string($con, $_POST['spc_description']);

    if (empty($specialty)) {
        $error = true;
        $specialty_error = "Please Enter a specialty which you want to add";

    }

    if (!empty($specialty)) {
        if (!preg_match("/^[a-zA-Z() ]*$/", $specialty)) {
            $error = true;
            $specialty_error = "Field only can contain letters spaces and brackets";
        }
    }

    if (empty($spc_description)) {
        $error = true;
        $spc_description_error = "Please add Description";
    }


    if (!$error) {
        if (mysqli_query($con, "INSERT INTO doctorspecialty(specialty,description) VALUES('$specialty','$spc_description')")) {

            header('Refresh:2; url=settings.php');
            echo "Successfully Added to list!";
        }
        else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}

//****************** start - Doctor Speciality select ***********
$query = "SELECT * FROM doctorspecialty";
$specialty_values = mysqli_query($con,$query);
//****************** end - Doctor Speciality select ***********

if(isset($_POST['description_search'])) {
    $select_specialty = mysqli_real_escape_string($con, $_POST['select_specialty']);

    $description_value = mysqli_query($con, "SELECT * FROM doctorspecialty WHERE specialty = '$select_specialty'");
    $description_row = mysqli_fetch_array($description_value);

}

//****************** start - Doctor Speciality edit ***********
if(isset($_POST['doctorspecialty_edit'])){
    $select_specialty = mysqli_real_escape_string($con, $_POST['select_specialty']);
    $u_description = mysqli_real_escape_string($con, $_POST['u_description']);

    if (empty($u_description)){
        $error = true;
        $u_description_error = "Please enter description";
    }
    if (!$error) {

        $update_doctorspecilty = "UPDATE doctorspecialty SET description='$u_description' WHERE specialty = '$select_specialty'";


        if (mysqli_query($con,$update_doctorspecilty)){

            header('Refresh:2; url=settings.php');
            echo "Successfully Updated!";
        }
        else {
            echo "Error in Updating...Please try again later!";
            echo mysqli_error($con);
        }
    }
}

//****************** start - Doctor Speciality delete ***********
if(isset($_GET['doctorspecialty_delete'])){
    $select_specialty = mysqli_real_escape_string($con, $_POST['select_specialty']);


    $sql_delete_specialty = "DELETE FROM doctorspecialty WHERE specialty = '$select_specialty'";

    If(mysqli_query($con,$sql_delete_specialty)){
        header('Refresh:2; url=settings.php');
        echo "Successfully Deleted!";
    }


    else {
        echo "Error in Deleting...Please try again later!";
        echo mysqli_error($con);
    }
}

//*******Site Payment edit******************

$handling_fee_info = mysqli_query($con, "SELECT * FROM handling_payment WHERE pay_id ='1'") or die('');
$handling_fee=mysqli_fetch_array($handling_fee_info);
if(isset($handling_fee)){
    $u_gust_pay = $handling_fee['gust_patient_pay'];
    $u_member_bonus = $handling_fee['member_bonus'];
}

if(isset($_POST['handling_charges_edit'])){
    $u_gust_pay = mysqli_real_escape_string($con, $_POST['u_gust_pay']);
    $u_member_bonus = mysqli_real_escape_string($con, $_POST['u_member_bonus']);

    if (empty($u_gust_pay)){
        $error = true;
        $u_gust_pay_error = "Please Enter Amount";
    }

    if (empty($u_member_bonus)){
        $error = true;
        $u_member_bonus_error = "Please Enter Bonus";
    }

    if (!$error) {
        $update_handling_fee = "UPDATE handling_payment SET gust_patient_pay='$u_gust_pay',member_bonus='$u_member_bonus' WHERE pay_id ='1'";

        if (mysqli_query($con,$update_handling_fee)){
            header('Refresh:2; url=settings.php');
            echo "Successfully Updated!";
        }
        else {
            echo "Error in Updating...Please try again later!";
            echo mysqli_error($con);
        }
    }

}

// ***********************Adding center fee*******************************
if(isset($_POST['center_fee_add'])){
    $center_reg = mysqli_real_escape_string($con, $_POST['center_reg']);
    $center_fee = mysqli_real_escape_string($con, $_POST['center_fee']);

    if (empty($center_reg)){
        $error = true;
        $center_reg_error = "Please Enter Center Reg Number";
    }
    elseif(($sql_select_reg = mysqli_query($con, "SELECT * FROM hospital WHERE hospitalID='$center_reg'")) && (mysqli_num_rows($sql_select_reg) <= 0)) {
        $error = true;
        $center_reg_error = "Invalid Registration number, Please Check and Try Again";
    }



    if (empty($center_fee)){
        $error = true;
        $center_fee_error = "Please Enter Center Fee";
    }

    if (!$error) {
        $center_fee = intval($center_fee);
        if (mysqli_query($con, "INSERT INTO center_charges(center_reg_no,center_fee) VALUES('$center_reg','$center_fee')")) {

            header('Refresh:2; url=settings.php');
            echo "Successfully Added to list!";
        }
        else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }

}

// ***********************Adding center fee*******************************
if(isset($_POST['doc_fee_add'])){
    $doc_center_reg = mysqli_real_escape_string($con, $_POST['doc_center_reg']);
    $doc_nic = mysqli_real_escape_string($con, $_POST['doc_nic']);
    $doc_fee = mysqli_real_escape_string($con, $_POST['doc_fee']);

    if (empty($doc_center_reg)){
        $error = true;
        $doc_center_reg_error = "Please Enter Center Reg Number";
    }
    elseif(($sql_select_doc_reg = mysqli_query($con, "SELECT * FROM doctor WHERE hospitalid='$doc_center_reg'")) && (mysqli_num_rows($sql_select_doc_reg) <= 0)) {
        $error = true;
        $center_reg_error = "Invalid Registration number, Please Check and Try Again";
    }

    if (empty($doc_nic)){
        $error = true;
        $doc_nic_error = "Please Enter Doctor NIC";
    }

    elseif(($sql_select_doc_nic = mysqli_query($con, "SELECT * FROM doctor WHERE hospitalid='$doc_center_reg' AND nic='$doc_nic'")) && (mysqli_num_rows($sql_select_doc_nic) <= 0)) {
        $error = true;
        $doc_nic_error = "Invalid NIC Number, Check and try again";
    }

    if (empty($doc_fee)){
        $error = true;
        $doc_fee_error = "Please Enter doctor Fee";
    }

    if (!$error) {
        $doc_fee = intval($doc_fee);
        if (mysqli_query($con, "INSERT INTO doctor_charges(center_reg_no,doctor_nic,doctor_fee) VALUES('$doc_center_reg','$doc_nic','$doc_fee')")) {

            header('Refresh:2; url=settings.php');
            echo "Successfully Added to list!";
        }
        else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }

}


?>
<div class="col-md-8 col-xs-12 col-md-offset-1 admin-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row row-top">
            <div class="col-md-3">
                <label for="mem">Number of Members:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="mem">
            </div>
        </div>
        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>
        <div class="row row-top">
            <div class="col-md-12">
                <h5 class="sch-h5">Manage Members</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="mem">Membership Expiry Date:</label>
            </div>
            <div class="col-md-6">
                <input type="date" class="form-control" id="mem">
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="mem">Number oF Members:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="mem">
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <button type="button" class="btn btn-default" id="schsearch">Search</button>
                <button type="button" class="btn btn-default" id="">Send Remind</button>
                <button type="button" class="btn btn-default" id="schsearch">Cancel Membership</button>
            </div>
        </div>
        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>
        <div class="row row-top">
            <div class="col-md-12">
                <h5 class="sch-h5">Manage Users</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="mem">Center Name:</label>
            </div>
            <div class="col-md-6">
                <select name="Center" id="" class="form-control">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <button type="button" class="btn btn-default" id="schsearch">Search</button>
            </div>
        </div>
        <div class="col-md-12 row-margin">
            <table width="100%" class="table-responsive">
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Address</th>
                    <th>Phone-01</th>
                    <th>Phone-02</th>
                    <th>User Privileges</th>
                    <th>Edit Admin</th>
                </tr>
                <tr>
                    <td>01</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><select name="Center" id="" class="form-control">
                            <option value=""></option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-default" id="uselect">Edit</button>
                    </td>
                </tr>
            </table>
        </div>

        <div class="row row-top">
            <div class="col-md-12 col-xs-12">
                <br>
                <hr>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-12">
                <h5 class="sch-h5">Doctor Speciality Manage</h5>
                <br>
            </div>
            <div class="col-md-3">
                <label for="">Doctor Speciality:</label>
            </div>
            <div class="col-md-6">
                <select name="select_specialty" class="form-control">
                    <option>Select</option>
                    <?php while($specialty_row = mysqli_fetch_array($specialty_values)) {

                            if ($specialty_row['specialty'] == $_POST['select_specialty'])
                                $selected = "selected=\"selected\"";
                            else
                                $selected = "";
                            echo "<option value=\"" . $specialty_row['specialty'] . "\" $selected>" . $specialty_row['specialty'] . "</option>\n ";

                    }?>

                </select>
            </div>

            <div class="col-xs-12 row-top">
                <div class="row row-top btn-align-center">
                    <input type="submit" class="btn btn-default" name="description_search" value="Search">
                </div>
            </div>
        </div>
            <div class="row row-top">
                <div class="col-md-3 row-top">
                    <label for="">Description:</label>
                </div>
                <div class="col-md-6 row-top">
                    <textarea name="u_description" class="form-control" cols="30" rows="3"><?php if(isset($description_row)){echo $description_row['description'];} ?></textarea>
                    <span class="error"><?php if (isset($u_description_error)) {echo $u_description_error;} ?></span>
                </div>

            </div>
            <div class="col-xs-12 row-top">
                <div class="row row-top btn-align-center">
                    <input type="submit" class="btn btn-default" name="doctorspecialty_edit" value="Edit">
                    <input type="submit" class="btn btn-default" name="doctorspecialty_delete" value="Delete">
                </div>
            </div>
        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">New Specialty:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="specialty" value="<?= isset($_POST['specialty']) ? $_POST['specialty'] : ''; ?>">
                <span class="error"><?php if (isset($specialty_error)) echo $specialty_error; ?></span>
            </div>
        </div>
            <div class="row row-top">
                <div class="col-md-3 row-top">
                    <label for="">Description:</label>
                </div>
                <div class="col-md-6 row-top">
                    <textarea name="spc_description" class="form-control" cols="30" rows="3"><?= isset($_POST['specialty']) ? $_POST['specialty'] : ''; ?></textarea>
                    <span class="error"><?php if (isset($spc_description_error)) echo $spc_description_error; ?></span>
                </div>
            </div>
            <div class="col-xs-12 row-top">
                <div class="row row-top btn-align-center">
                    <input type="submit" class="btn btn-default" name="add_speciality" value="Add">
                </div>
            </div>

        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>

        <!--*******Site Payment edit******************-->
        <div class="row row-top">
            <div class="col-md-12">
                <h5 class="sch-h5">Handling Charges</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="mem">Gust Charge:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="u_gust_pay" value="<?php if(isset($u_gust_pay)){echo $u_gust_pay;} ?>">
                <span class="error"><?php if (isset($u_gust_pay_error)) {echo $u_gust_pay_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="mem">Membership Bonus%:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="u_member_bonus" value="<?php if(isset($u_member_bonus)){echo $u_member_bonus;} ?>">
                <span class="error"><?php if (isset($u_member_bonus_error)) {echo $u_member_bonus_error;} ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <input type="submit" class="btn btn-default" name="handling_charges_edit" value="Edit"/>
            </div>
        </div>

        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>

        <!--*******center Payment add******************-->
        <div class="row row-top">
            <div class="col-md-12">
                <h5 class="sch-h5">Adding Center Charges</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="center">Center Reg No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="center_reg" value="<?php isset($_POST['center_reg']) ? $_POST['center_reg'] : ''; ?>">
                <span class="error"><?php if (isset($center_reg_error)) {echo $center_reg_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="center_fee">Center Fee:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="center_fee" value="<?php isset($_POST['center_fee']) ? $_POST['center_fee'] : ''; ?>">
                <span class="error"><?php if (isset($center_fee_error)) {echo $center_fee_error;} ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <input type="submit" class="btn btn-default" name="center_fee_add" value="Add"/>
            </div>
        </div>
        <div class="col-md-12 col-xs-12">
            <br>
            <hr>
        </div>

        <!--*******Doctor Payment add******************-->
        <div class="row row-top">
            <div class="col-md-12">
                <h5 class="sch-h5">Adding Doctor Charges</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="center">Center Reg No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="doc_center_reg" value="<?php isset($_POST['doc_center_reg']) ? $_POST['doc_center_reg'] : ''; ?>">
                <span class="error"><?php if (isset($doc_center_reg_error)) {echo $doc_center_reg_error;} ?></span>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="doc_nic">Doctor NIC:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="doc_nic" value="<?php isset($_POST['doc_nic']) ? $_POST['doc_nic'] : ''; ?>">
                <span class="error"><?php if (isset($doc_nic_error)) {echo $doc_nic_error;} ?></span>
            </div>
        </div>

        <div class="row row-top">
            <div class="col-md-3">
                <label for="doc_fee">Doctor Fee:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="doc_fee" value="<?php isset($_POST['doc_fee']) ? $_POST['doc_fee'] : ''; ?>">
                <span class="error"><?php if (isset($doc_fee_error)) {echo $doc_fee_error;} ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <input type="submit" class="btn btn-default" name="doc_fee_add" value="Add"/>
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