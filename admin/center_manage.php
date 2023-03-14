<?php

require("navbar.php");
include_once '../dbconnection.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $reg = mysqli_real_escape_string($con, $_POST['reg']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone1 = mysqli_real_escape_string($con, $_POST['phone1']);
    $phone2 = mysqli_real_escape_string($con, $_POST['phone2']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    //$lab = "";
    //if (!empty($_POST['lab'])) {
    //    $lab = implode('|', $_POST['lab']);
   // }

    $fbc = "";
    if (isset($_POST['fbc'])) {
        $fbc = $_POST['fbc'];
    }
    $ufr = "";
    if (isset($_POST['ufr'])) {
        $ufr  = $_POST['ufr'];
    }
    $liverProfile = "";
    if (isset($_POST['liverProfile'])) {
        $liverProfile = $_POST['liverProfile'];
    }
    $esr = "";
    if (isset($_POST['esr'])) {
        $esr = $_POST['esr'];
    }
    $ecg = "";
    if (isset($_POST['ecg'])) {
        $ecg = $_POST['ecg'];
    }
    $tsh = "";
    if (isset($_POST['tsh'])) {
        $tsh = $_POST['tsh'];
    }
    $chestXray = "";
    if (isset($_POST['chestXray'])) {
        $chestXray = $_POST['chestXray'];
    }
    $lipidProfile = "";
    if (isset($_POST['lipidProfile'])) {
        $lipidProfile = $_POST['lipidProfile'];
    }
    $vdrl = "";
    if (isset($_POST['vdrl'])) {
        $vdrl = $_POST['vdrl'];
    }
    $sgpt = "";
    if (isset($_POST['sgpt'])) {
        $sgpt = $_POST['sgpt'];
    }
    $creatinine = "";
    if (isset($_POST['creatinine'])) {
        $creatinine = $_POST['creatinine'];
    }
    $serumCholesterol = "";
    if (isset($_POST['serumCholesterol'])) {
        $serumCholesterol = $_POST['serumCholesterol'];
    }
    $hemodialysis = "";
    if (isset($_POST['hemodialysis'])) {
        $hemodialysis = $_POST['hemodialysis'];
    }

    $ctype = "";
    if (isset($_POST['ctype']) == null) {
        $error = true;
        $ctype_error = "Please Select Center Type";
    }
    else{
        $ctype = $_POST['ctype'];
    }

    if (empty($name)) {
        $error = true;
        $name_error = "Please Enter Center Name";
    }

    if (empty($reg)) {
        $error = true;
        $reg_error = "Please Enter Registration No";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email";
    }

    if (empty($phone1)) {
        $error = true;
        $phone1_error = "Please Enter a Phone No";

    }

    if (!empty($phone1)) {
        if (!preg_match("/^[0-9]*$/", $phone1)) {
            $error = true;
            $phone1_error = "Please Enter a Valid Phone No";
        } elseif (strlen($_POST["phone1"]) != 10) {
            $phone1_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (empty($phone2)) {
        $error = true;
        $phone2_error = "Please Enter a Phone No";
    }

    if (!empty($phone2)) {
        if (!preg_match("/^[0-9]*$/", $phone2)) {
            $error = true;
            $phone2_error = "Please Enter a Valid Phone No";
        } elseif (strlen($_POST["phone2"]) != 10) {
            $phone2_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (empty($_POST["address"])) {
        $error = true;
        $address_error = "Please Enter the Center Address";
    }


    if (!$error) {
        if ((mysqli_query($con, "INSERT INTO hospital(hospitalID,type,name,address,Phone1,Phone2,email) VALUES('$reg','$ctype','$name','$address','$phone1','$phone2', '$email')")) && (mysqli_query($con, "INSERT INTO labfacility(regNo,fbc,ufr,liverProfile,esr,ecg,tsh,chestXray,lipidProfile,vdrl,sgpt,creatinine,serumCholesterol,hemodialysis) VALUES('$reg','$fbc','$ufr','$liverProfile','$esr','$ecg', '$tsh','$chestXray','$lipidProfile','$vdrl','$sgpt','$creatinine','$serumCholesterol','$hemodialysis')"))) {

            header('Refresh:2; url=center_manage.php');
            echo "Successfully Registered!";
        }
        else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}

if(isset($_POST['search'])){
    $creg = $_POST['creg'];

    if (empty($creg)) {
        $creg_error = "Enter the Channelling Center Registration Number";
    }

    if(!empty($creg)){

        $sql_center_info = "SELECT * FROM hospital WHERE hospitalID = '$creg'";
        $sql_lab_info = "SELECT * FROM labfacility WHERE regNo = '$creg'";

        $center_info = mysqli_query($con,$sql_center_info) or die();
        $lab_info = mysqli_query($con,$sql_lab_info ) or die();

        $center_row = mysqli_fetch_array($center_info);
        $lab_row = mysqli_fetch_array($lab_info);
    }

}

    $uerror = false;

if(isset($_POST['update'])){

    $creg = $_POST['creg'];

    if (empty($creg)) {
        $creg_error = "Enter the Channelling Center Registration Number";
    }

    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $uemail = mysqli_real_escape_string($con, $_POST['uemail']);
    $uphone1 = mysqli_real_escape_string($con, $_POST['uphone1']);
    $uphone2 = mysqli_real_escape_string($con, $_POST['uphone2']);
    $uaddress = mysqli_real_escape_string($con, $_POST['uaddress']);

    //$lab = "";
    //if (!empty($_POST['lab'])) {
    //    $lab = implode('|', $_POST['lab']);
    // }

    $ufbc = "";
    if (isset($_POST['ufbc'])) {
        $ufbc = $_POST['ufbc'];
    }
    $uufr = "";
    if (isset($_POST['uufr'])) {
        $uufr  = $_POST['uufr'];
    }
    $uliverProfile = "";
    if (isset($_POST['uliverProfile'])) {
        $uliverProfile = $_POST['uliverProfile'];
    }
    $uesr = "";
    if (isset($_POST['uesr'])) {
        $uesr = $_POST['uesr'];
    }
    $uecg = "";
    if (isset($_POST['uecg'])) {
        $uecg = $_POST['uecg'];
    }
    $utsh = "";
    if (isset($_POST['utsh'])) {
        $utsh = $_POST['utsh'];
    }
    $uchestXray = "";
    if (isset($_POST['uchestXray'])) {
        $uchestXray = $_POST['uchestXray'];
    }
    $ulipidProfile = "";
    if (isset($_POST['ulipidProfile'])) {
        $ulipidProfile = $_POST['ulipidProfile'];
    }
    $uvdrl = "";
    if (isset($_POST['uvdrl'])) {
        $uvdrl = $_POST['uvdrl'];
    }
    $usgpt = "";
    if (isset($_POST['usgpt'])) {
        $usgpt = $_POST['usgpt'];
    }
    $ucreatinine = "";
    if (isset($_POST['ucreatinine'])) {
        $ucreatinine = $_POST['ucreatinine'];
    }
    $userumCholesterol = "";
    if (isset($_POST['userumCholesterol'])) {
        $userumCholesterol = $_POST['userumCholesterol'];
    }
    $uhemodialysis = "";
    if (isset($_POST['uhemodialysis'])) {
        $uhemodialysis = $_POST['uhemodialysis'];
    }

    $uctype = "";
    if (isset($_POST['uctype']) == null) {
        $error = true;
        $uctype_error = "Please Select Center Type";
    }
    else{
        $uctype = $_POST['uctype'];
    }

    if (empty($uname)) {
        $error = true;
        $uname_error = "Please Enter Center Name";
    }

    if (empty($ureg)) {
        $error = true;
        $ureg_error = "Please Enter Registration No";
    }

    if (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $uemail_error = "Please Enter Valid Email";
    }

    if (empty($uphone1)) {
        $error = true;
        $uphone1_error = "Please Enter a Phone No";

    }

    if (!empty($uphone1)) {
        if (!preg_match("/^[0-9]*$/", $uphone1)) {
            $uerror = true;
            $uphone1_error = "Please Enter a Valid Phone No";
        } elseif (strlen($_POST["uphone1"]) != 10) {
            $uphone1_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (empty($uphone2)) {
        $uerror = true;
        $uphone2_error = "Please Enter a Phone No";
    }

    if (!empty($uphone2)) {
        if (!preg_match("/^[0-9]*$/", $uphone2)) {
            $uerror = true;
            $uphone2_error = "Please Enter a Valid Phone No";
        } elseif (strlen($_POST["uphone2"]) != 10) {
            $uphone2_error = "Phone Number Must Contain 10 Digits";
        }
    }

    if (empty($_POST["uaddress"])) {
        $uerror = true;
        $uaddress_error = "Please Enter the Center Address";
    }


    if (!$uerror) {

        $update_hospital = "UPDATE hospital SET Type='$uctype',name='$uname',address='$uaddress',Phone1='$uphone1',Phone2='$uphone2',email='$uemail' WHERE hospitalID='$creg'";

        $update_labfacility = "UPDATE labfacility SET fbc='$ufbc',ufr='$uufr',liverProfile='$uliverProfile',esr='$uesr',ecg='$uecg',tsh='$utsh',chestXray='$uchestXray',lipidProfile='$ulipidProfile',vdrl='$uvdrl',sgpt='$usgpt',creatinine='$ucreatinine',serumCholesterol='$userumCholesterol',hemodialysis='$uhemodialysis' WHERE regNo='$creg'";

        if ((mysqli_query($con,$update_hospital)) && (mysqli_query($con,$update_labfacility))){
            header('Refresh:2; url=center_manage.php');
            echo "Successfully Updated!";
        }
        else {
            echo "Error in Updating...Please try again later!";
            echo mysqli_error($con);
        }
    }
}

if(isset($_POST['delete'])){
    $creg = $_POST['creg'];

    if (empty($creg)) {
        $creg_error = "Enter the Channelling Center Registration Number";
    }

    if(!empty($creg)){

        $sql_center_info = "Delete FROM hospital WHERE hospitalID = '$creg'";
        $sql_lab_info = "Delete FROM labfacility WHERE regNo = '$creg'";

        If((mysqli_query($con,$sql_center_info)) && (mysqli_query($con,$sql_lab_info))){
            header('Refresh:2; url=center_manage.php');
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
            <h5 class="sch-h5">Update Channeling Center</h5>
        </div>
        <div class="col-md-3 col-xs-12">
            <label for="chaname" class="btn-label-padding">Channeling Center:</label>
        </div>

            <div class="col-md-7">
                <input type="text" name="creg" class="form-control" value="<?= isset($_POST['creg']) ? $_POST['creg'] : ''; ?>" placeholder="Enter Channeling Center Registration Number and press Search">
                <span class="error"><?php if (isset($creg_error)) echo $creg_error; ?></span>
            </div>
            <div class="col-md-2 col-xs-12">
                    <button type="submit" name="search" class="btn btn-default btn-label-padding"><i class="ion-ios-search"></i></button>
            </div>
        <div class="col-md-12 row-margin">
            <br>
            <br>
            <div class="col-md-6 col-xs-12">
                <div class="row row-top">
                    <div class="col-md-4">
                        <label for="">Center Type:</label>
                    </div>
                    <div class="col-md-8">
                        <label class="radio checkbox-margin"><input type="radio" name="uctype" <?php if ((isset($center_row))&&("$center_row[Type]"=="Hospital")) {?> <?php echo "checked";?> <?php }?> value="Hospital">Hospital</label>
                        <label class="radio checkbox-margin"><input type="radio" name="uctype" <?php if ((isset($center_row))&&("$center_row[Type]"=="Channeling")) {?> <?php echo "checked";?> <?php }?> value="Channeling">Channeling</label>
                        <label class="radio checkbox-margin"><input type="radio" name="uctype" <?php if ((isset($center_row))&&("$center_row[Type]"=="Lab")) {?> <?php echo "checked";?> <?php }?> value="Lab">Lab</label>
                        <span class="error"><?php if (isset($uctype_error)) echo $uctype_error; ?></span>
                    </div>
                </div>
                <div class="row row-top">
                    <div class="col-md-4">
                        <label for="">Name:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="uname" value="<?php if (isset($center_row)) echo "$center_row[name]" ?>">
                        <span class="error"><?php if (isset($uname_error)) echo $uname_error; ?></span>
                    </div>
                </div>
                <div class="row row-top">
                    <div class="col-md-4">
                        <label for="">Email</label>
                    </div>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="uemail" value="<?php if (isset($center_row)) echo "$center_row[email]" ?>">
                        <span class="error"><?php if (isset($uemail_error)) echo $uemail_error; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="row row-top">
                    <div class="col-md-4">
                        <label for="">Phone-01:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="tel" class="form-control" name="uphone1" value="<?php if (isset($center_row)) echo "$center_row[Phone1]" ?>">
                        <span class="error"><?php if (isset($uphone1_error)) echo $uphone1_error; ?></span>
                    </div>
                </div>
                <div class="row row-top">
                    <div class="col-md-4">
                        <label for="">Phone-02:</label>
                    </div>
                    <div class="col-md-8">
                        <input type="tel" class="form-control" name="uphone2" value="<?php if (isset($center_row)) echo "$center_row[Phone2]" ?>">
                        <span class="error"><?php if (isset($uphone2_error)) echo $uphone2_error; ?></span>
                    </div>
                </div>
                <div class="row row-top">
                    <div class="col-md-4">
                        <label for="">Address:</label>
                    </div>
                    <div class="col-md-8">
                            <textarea name="uaddress" class="form-control" rows="4" value=""><?php if (isset($center_row)) echo "$center_row[address]" ?></textarea>
                        <span class="error"><?php if (isset($uaddress_error)) echo $uaddress_error; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 row-top">
            <div class="col-md-12 col-xs-12">
                <label for="">Lab Facilities:</label>
            </div>
            <div class="col-md-4 col-xs-12">
                <label class="checkbox checkbox-margin"><input type="checkbox" name="ufbc" <?php if ((isset($lab_row))&&("$lab_row[fbc]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">F.B.C.</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uufr" <?php if ((isset($lab_row))&&("$lab_row[ufr]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">U.F.R.</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uliverProfile" <?php if ((isset($lab_row))&&("$lab_row[liverProfile]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">Liver Profile</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uesr" <?php if ((isset($lab_row))&&("$lab_row[esr]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">E.S.R.</label>
            </div>
            <div class="col-md-4 col-xs-12">
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uecg" <?php if ((isset($lab_row))&&("$lab_row[ecg]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">E.C.G.</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="utsh" <?php if ((isset($lab_row))&&("$lab_row[tsh]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">T.S.H.</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uchestXray" <?php if ((isset($lab_row))&&("$lab_row[chestXray]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">Chest X-ray</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="ulipidProfile" <?php if ((isset($lab_row))&&("$lab_row[lipidProfile]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">Lipid Profile</label>
            </div>
            <div class="col-md-4 col-xs-12">
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uvdrl" <?php if ((isset($lab_row))&&("$lab_row[vdrl]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">V.D.R.L.</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="usgpt" <?php if ((isset($lab_row))&&("$lab_row[sgpt]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">S.G.P.T</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="ucreatinine" <?php if ((isset($lab_row))&&("$lab_row[creatinine]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">Creatinine</label>
                <label class="checkbox checkbox-margin"><input type="checkbox" name="userumCholesterol" <?php if ((isset($lab_row))&&("$lab_row[serumCholesterol]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">Serum Cholesterol</label>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 row-top">
            <div class="col-md-12 col-xs-12">
                <label for="">Hemodialysis Facility:</label>
            </div>
            <div class="col-md-12 col-xs-12">
                <label class="checkbox checkbox-margin"><input type="checkbox" name="uhemodialysis" <?php if ((isset($lab_row))&&("$lab_row[hemodialysis]"=="yes")) {?> <?php echo "checked";?> <?php }?> value="yes">Hemodialysis</label>
            </div>
        </div>
        <div class="col-xs-12 col-xs-12">
            <div class="row row-top btn-align-center">
           <input type="submit" class="btn btn-default" name="update" value="Update">
            <input type="submit" class="btn btn-default" name="delete" value="Delete">
            </div>
        </div>

        <div class="col-md-12 row-margin">
        <br>
        <hr>
        </div>
        <div class="col-md-12 row-margin">
            <h5 class="sch-h5">Assign Channeling Center</h5>
        </div>
        <div class="col-md-12 row-margin">
            <div class="col-md-6 col-xs-12">
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Center Type:</label>
                        </div>
                        <div class="col-md-8">
                            <label class="radio checkbox-margin"><input type="radio" name="ctype" value="Hospital">Hospital</label>
                            <label class="radio checkbox-margin"><input type="radio" name="ctype" value="Channeling">Channeling</label>
                            <label class="radio checkbox-margin"><input type="radio" name="ctype"
                                                                        value="Lab">Lab</label>
                            <span class="error"><?php if (isset($ctype_error)) echo $ctype_error; ?></span>
                        </div>
                    </div>
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Name:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name"
                                   value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                            <span class="error"><?php if (isset($name_error)) echo $name_error; ?></span>
                        </div>
                    </div>
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Reg No:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="reg"
                                   value="<?= isset($_POST['reg']) ? $_POST['reg'] : ''; ?>">
                            <span class="error"><?php if (isset($reg_error)) echo $reg_error; ?></span>
                        </div>
                    </div>
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email"
                                   value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                            <span class="error"><?php if (isset($email_error)) echo $email_error; ?></span>
                        </div>
                    </div>
            </div>
            <div class="col-md-6 col-xs-12">
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Phone-01:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="tel" class="form-control" name="phone1"
                                   value="<?= isset($_POST['phone1']) ? $_POST['phone1'] : ''; ?>">
                            <span class="error"><?php if (isset($phone1_error)) echo $phone1_error; ?></span>
                        </div>
                    </div>
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Phone-02:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="tel" class="form-control" name="phone2"
                                   value="<?= isset($_POST['phone2']) ? $_POST['phone2'] : ''; ?>">
                            <span class="error"><?php if (isset($phone2_error)) echo $phone2_error; ?></span>
                        </div>
                    </div>
                    <div class="row row-top">
                        <div class="col-md-4">
                            <label for="">Address:</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="address" class="form-control" rows="5"
                                      value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>"></textarea>
                            <span class="error"><?php if (isset($address_error)) echo $address_error; ?></span>
                        </div>
                    </div>
            </div>
        </div>
            <div class="col-md-12 col-xs-12 row-top">
                <div class="col-md-12 col-xs-12">
                    <label for="">Lab Facilities:</label>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="fbc"
                                                                   value="yes">F.B.C.</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="ufr"
                                                                   value="yes">U.F.R.</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="liverProfile" value="yes">Liver
                        Profile</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="esr"
                                                                   value="yes">E.S.R.</label>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="ecg"
                                                                   value="yes">E.C.G.</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="tsh"
                                                                   value="yes">T.S.H.</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="chestXray" value="yes">Chest
                        X-ray</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="lipidProfile" value="yes">Lipid
                        Profile</label>
                </div>
                <div class="col-md-4 col-xs-12">
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="vdrl" value="yes">V.D.R.L.</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="sgpt" value="yes">S.G.P.T</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="creatinine" value="yes">Creatinine</label>
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="serumCholesterol"
                                                                   value="yes">Serum Cholesterol</label>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 row-top">
                <div class="col-md-12 col-xs-12">
                    <label for="">Hemodialysis Facility:</label>
                </div>
                <div class="col-md-12 col-xs-12">
                    <label class="checkbox checkbox-margin"><input type="checkbox" name="hemodialysis"
                                                                   value="yes">Hemodialysis</label>
                </div>
            </div>

            <div class="col-xs-12 col-xs-12">
                <div class="row row-top btn-align-center">
                    <input type="submit" class="btn btn-default" name="submit" value="Submit">
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