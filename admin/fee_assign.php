<?php
session_start();
require ("navbar.php");

include_once '../dbconnection.php';

$error = false;

//Channelling Fee assigning

if (isset($_POST['submit'])) {

    $centerrefno = mysqli_real_escape_string($con, $_POST['centerrefno']);
    $docrefno = mysqli_real_escape_string($con, $_POST['docrefno']);
    $fee = mysqli_real_escape_string($con, $_POST['fee']);

    if (empty($centerrefno)) {
        $error = true;
        $centerrefno_error = "Please Enter center Ref No";
    }

    if (empty($docrefno)) {
        $error = true;
        $docrefno_error = "Please Enter Doctor Ref No";
    }

    if (empty($fee)) {
        $error = true;
        $fee_error = "Please Enter fee";
    }


    if (!$error) {
        if (mysqli_query($con, "INSERT INTO doctor(fname,lname,speciality,email,phone,address,profile) VALUES('$fname','$lname','$speciality','$email',$phone,'$address','$profile')")) {

            header('Refresh:2; url=center_manage.php');
            echo "Successfully Registered!";
        } else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}
//lab assigning
if (isset($_POST['submit'])) {

    $centerrefno = mysqli_real_escape_string($con, $_POST['centerrefno']);
    $test = mysqli_real_escape_string($con, $_POST['test']);
    $fee = mysqli_real_escape_string($con, $_POST['fee']);

    if (empty($centerrefno)) {
        $error = true;
        $centerrefno_error = "Please Enter center Ref No";
    }
//call adee aiya
    if (empty($test)) {
        $error = true;
        $test_error = "Please Enter test type";
    }

    if (empty($fee)) {
        $error = true;
        $fee_error = "Please Enter Fee";
    }

    if (!$error) {
        if (mysqli_query($con, "INSERT INTO doctor(fname,lname,speciality,email,phone,address,profile) VALUES('$fname','$lname','$speciality','$email',$phone,'$address','$profile')")) {

            header('Refresh:2; url=center_manage.php');
            echo "Successfully Registered!";
        } else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}
//handling assigning fee
if (isset($_POST['submit'])) {

    $memfee = mysqli_real_escape_string($con, $_POST['memdee']);
    $annualfee = mysqli_real_escape_string($con, $_POST['annualfee']);
    $handlingfee = mysqli_real_escape_string($con, $_POST['handlingfee']);

    if (empty($memfee)) {
        $error = true;
        $memfee_error = "Please Enter Membership Fee";
    }

    if (empty($annualfee)) {
        $error = true;
        $annualfee_error = "Please Enter Annual Fee";
    }

    if (empty($handlingfee)) {
        $error = true;
        $handlingfee_error = "Please Enter Handling Fee";
    }


    if (!$error) {
        if (mysqli_query($con, "INSERT INTO doctor(fname,lname,speciality,email,phone,address,profile) VALUES('$fname','$lname','$speciality','$email',$phone,'$address','$profile')")) {

            header('Refresh:2; url=center_manage.php');
            echo "Successfully Registered!";
        } else {
            echo "Error in registering...Please try again later!";
            mysqli_error($con);
        }
    }
}

?>
<div class="col-md-8 col-xs-12 col-md-offset-1 admin-body">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Channeling Fee Assigning</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Center Ref No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="centerrefno"
                       value="<?= isset($_POST['centerrefno']) ? $_POST['centerrefno'] : ''; ?>">
                <span class="error"><?php if (isset($centerrefno_error)) echo $centerrefno_error; ?></span>
            </div>
        </div>

        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Doctor Ref No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="docrefno"
                       value="<?= isset($_POST['docrefno']) ? $_POST['docrefno'] : ''; ?>">
                <span class="error"><?php if (isset($docrefno_error)) echo $docrefno_error; ?></span>
            </div>
        </div>

        <div class="row row-top">
            <div class="col-md-3">
                <label for="centername">Center Name:</label>
            </div>
            <div class="col-md-6">
                <label for="centername"></label>
            </div>
        </div>

        <div class="row row-top">
            <div class="col-md-3">
                <label for="docname">Doctor Name:</label>
            </div>
            <div class="col-md-6">
                <label for="docname"></label>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="speciality">Speciality:</label>
            </div>
            <div class="col-md-6">
                <label for="speciality"></label>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Fee (Rs):</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="fee"
                       value="<?= isset($_POST['fee']) ? $_POST['fee'] : ''; ?>">
                <span class="error"><?php if (isset($fee_error)) echo $fee_error; ?></span>
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <input type="submit" class="btn btn-default" name="submit" value="Submit">
                <button type="button" class="btn btn-default" id="schsearch">Assign</button>
                <button type="button" class="btn btn-default" id="schsearch">Edit</button>
                <button type="button" class="btn btn-default" id="schsearch">Delete</button>
            </div>
        </div>
        <br>
        <hr>
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Lab Facility Fee Assigning</h5>
            </div>
        </div>

        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Center Ref No:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="centerrefno"
                       value="<?= isset($_POST['centerrefno']) ? $_POST['centerrefno'] : ''; ?>">
                <span class="error"><?php if (isset($centerrefno_error)) echo $centerrefno_error; ?></span>
            </div>
        </div>

        <div class="row row-top">
            <div class="col-md-3">
                <label for="centerrefno">Center Name:</label>
            </div>
            <div class="col-md-6">
                <label for="centerrefno"></label>
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
                <label for="">Fee (Rs):</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <button type="button" class="btn btn-default" id="schsearch">Search</button>
                <button type="button" class="btn btn-default" id="schsearch">Assign</button>
                <button type="button" class="btn btn-default" id="schsearch">Edit</button>
                <button type="button" class="btn btn-default" id="schsearch">Delete</button>
            </div>
        </div>
        <br>
        <hr>
        <div class="row row-top">
            <div class="col-md-12 Sch-topic">
                <h5 class="sch-h5">Handling Fee Assigning</h5>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Membership Fee (Rs):</label>
            </div>
            <div class="col-md-6">
                <select name="center" id="" class="form-control">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Annual Fee (Rs):</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Handling Fee:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row row-top btn-align-center">
                <button type="button" class="btn btn-default" id="schsearch">Search</button>
                <button type="button" class="btn btn-default" id="schsearch">Assign</button>
                <button type="button" class="btn btn-default" id="schsearch">Edit</button>
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