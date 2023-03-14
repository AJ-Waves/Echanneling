<?php
require ("header.php");
?>

<div class="container form-container">
    <div class="row">
        <div class="col-md-12 col-xs-12 title-div">
            <h4>Patient Appointment</h4>
        </div>
    </div>

        <form>
            <div class="row form-row-margin">
                <div class="col-md-2 col-xs-4">
                    <label for="dname">Doctor Name:</label>
                </div>
                <div class="col-md-4 col-xs-8">
                    <input type="text" class="form-control" id="dname">
                </div>
                <div class="col-md-2 col-xs-4">
                    <label for="speciality">Speciality:</label>
                </div>
                <div class="col-md-4 col-xs-8">
                    <input type="text" class="form-control" id="speciality">
                </div>
            </div>

            <div class="row form-row-margin" >
                <div class="col-md-2 col-xs-4">
                    <label for="cdate">Date:</label>
                </div>
                <div class="col-md-4 col-xs-8">
                    <input type="text" class="form-control" id="cdate">
                </div>
                <div class="col-md-2 col-xs-4">
                    <label for="ctime">Time:</label>
                </div>
                <div class="col-md-4 col-xs-8">
                    <input type="text" class="form-control" id="ctime">
                </div>
            </div>

            <div class="row form-row-margin">
                <div class="col-md-2 col-xs-4">
                    <label for="caddress:">Address:</label>
                </div>
                <div class="col-md-4 col-xs-8">
                    <textarea class="form-control" id="caddress" rows="3"></textarea>
                </div>
                <div class="col-md-2 col-xs-4">
                    <label for="phone">Contact:</label>
                </div>
                <div class="col-md-4 col-xs-8">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="phone1">
                        </div>
                    </div>
                    <div class="row form-row-margin">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="phone2">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <br>
    <hr>
    <br>
    <form>
            <div class="row">
                <div class="col-md-12 form-inline">
                    <label for="login">If you already a member:</label>
                    <button type="button" class="btn btn-default" id="user_login">Login</button>
                </div>
            </div>
        <br>
            <div class="row">
                <div class="col-md-12 form-inline">
                    <label for="register">If you like to be a member and enjoy our hospitality:</label>
                    <button type="button" class="btn btn-default" id="user_register">Register</button>
                </div>
            </div>
        <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="appointment">If you just wish to put appointment, Please fill below form:</label>
                </div>
            </div>

        <br>


            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="pname">Patient Name:</label>
                    </div>
                    <div>
                        <div class="col-md-2">
                            <select class="form-control" id="salutation" name="salutation">
                                <option value="">Mr.</option>
                                <option value="a">Mrs.</option>
                                <option value="b">Miss.</option>
                            </select>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="pname" placeholder="Name with Initials">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 form-row-margin">
                        <label for="pemail">E-mail:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="pemail" placeholder="Enter Valid e-mail Address">
                    </div>
                </div>
             </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 form-row-margin">
                        <label for="pid">NIC/ Passport:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="pid" placeholder="Enter patient NIC or Passport No.">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 form-row-margin">
                        <label for="pbirthday">Birthday:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="date" class="form-control" id="pbirthday" placeholder="Enter Patient Birthday">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 form-row-margin">
                        <label for="paddress">Address:</label>
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control" id="paddress" rows="3" placeholder="Patients' Address"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 form-row-margin">
                        <label for="pcontact1">Mobile phone Number:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="pcontact1" placeholder="Mobile Number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12 form-row-margin">
                        <label for="pcontact2">Land Phone Number:</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="pcontact2" placeholder="Land Number">
                    </div>
                </div>
            </div>
        </form>
    <br>
    <hr>
    <br>

        <form>
            <div class="row form-row-margin">
                <div class="col-md-2">
                    <label for="cfee">Channeling Fee (Rs.):</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="cfee">
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="col-md-2">
                    <label for="hfee">Handling Fee (Rs.):</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="hfee">
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="col-md-2">
                    <label for="tfee">Total Fee (Rs.):</label>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="tfee">
                </div>
            </div>
            <div class="row form-row-margin">
                <div class="col-md-8">
                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">I Agree To <a href="#"> Terms and Conditions</a></label>
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
                                <input type="radio" class="payment-img-input" name="payment" id="visa" value="visa"><img src="img/visa.png" class="Payment-img">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" name="payment" id="master" value="master"><img src="img/master.png" class="img-responsive Payment-img">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="radio-inline">
                                <input type="radio" name="payment" id="amex" value="amex"><img src="img/amex.png" class="img-responsive Payment-img">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <button type="button" class="btn btn-default" id="pdatasubmit">Submit</button>
                </div>
            </div>
        </form>
    <br>
</div>
<?php
require ("footer.php");
?>
