<?php
require ("header.php");

$salutation = $_SESSION['salutation'];
$fname =  $_SESSION['fname'];
$lname =  $_SESSION['lname'];
$initials = $_SESSION['initials'];
$email = $_SESSION['email'];
$password = $_SESSION['pw'];
$cpassword = $_SESSION['cpw'];
$birthday = $_SESSION['birthday'];
$nic = $_SESSION['nic'];
$country = $_SESSION['country'];
$address = $_SESSION['address'];
$mobil = $_SESSION['phone1'];
$land = $_SESSION['phone2'];

$jfee = 200.00;
$hfee = 100.00;
$afee = 200.00;

$tfee = $jfee + $hfee + $afee;



if(isset($_POST['submit'])) {

    $payment = "";
    if (isset($_POST['payment']) == null) {
        $payment_error = "Please Select Payment Type";
    }
    else{
        $payment = $_POST['payment'];
    }



    If (!empty($payment)) {

        $_SESSION['payment'] = $payment;
        $_SESSION['tfee'] = $tfee;
        header("Location:payment.php");
    }

}




?>
    <div class="container form-container">
        <div class="row">
            <div class="col-md-12 col-xs-12 title-div">
                <h4>Member Registration - Step02</h4>
            </div>
        </div>
        <form method="post" action="">
            <div class="container reg-child-container">
                <div class="row form-row-margin">
                    <h5 class="reg-h5-stp2">Member Profile</h5>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memname">Name:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memnamefield"><?php echo $salutation." ".$fname." ".$lname?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memmail">E-mail:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memmailfield"><?php echo $email?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memnic">NIC/ Passport No:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memnicfield"><?php echo $nic?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="membirth">Birthday:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="membirthfield"><?php echo $birthday?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memcountry">Country:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memcountryfield"><?php echo $country?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memaddress">Address:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memaddressfield"><?php echo $address?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memmobil">Mobil Phone No:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memmobilfield"><?php echo $mobil?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-3 col-xs-12">
                        <label for="memland">Land Phone No:</label>
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <label for="memlandfield"><?php echo $land?></label>
                    </div>
                </div>
                <br>
            </div>
            <div class="container reg-child-container">
                <br>
                <div class="row form-row-margin">
                    <h5 class="reg-h5-stp2">Membership Payment</h5>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-2">
                        <label for="memjfee">Joining Fee (Rs.):</label>
                    </div>
                    <div class="col-md-4">
                        <label for="jfee"><?php echo $jfee; ?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-2">
                        <label for="memhfee">Handling Fee (Rs.):</label>
                    </div>
                    <div class="col-md-4">
                        <label for="hfee"><?php echo $hfee; ?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-2">
                        <label for="memafee">Annual Fee (Rs.):</label>
                    </div>
                    <div class="col-md-4">
                        <label for="afee"><?php echo $afee; ?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-2">
                        <label for="memtfee">Amount to be Pay (Rs.):</label>
                    </div>
                    <div class="col-md-4">
                        <label for="tfee"><?php echo $tfee; ?></label>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-8">
                        <label class="checkbox checkbox-margin"><input type="checkbox" name="terms" value="">I Agree To <a href="#"> Terms and Conditions</a></label>
                        <span class="error"><?php if (isset($terms_error)) echo $terms_error; ?></span>
                    </div>
                </div>
                <div class="row form-row-margin">
                    <div class="col-md-2">
                        <label for="paymenttype">Payment Method:</label>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" class="payment-img-input" name="payment" value="visa"><img src="img/visa.png" class="Payment-img">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" name="payment" value="master"><img src="img/master.png" class="img-responsive Payment-img">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" name="payment" value="amex"><img src="img/amex.png" class="img-responsive Payment-img">
                                </label>
                            </div>
                            <div class="col-md-12">
                            <span class="error"><?php if (isset($payment_error)) echo $payment_error; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-default" name="submit" value="Submit">
                    </div>
                </div>
                <br>
            </div>
        </form>
    </div>
<?php
require ("footer.php");
?>