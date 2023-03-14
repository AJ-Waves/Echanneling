<?php
    require ("header.php");
?>
<div class="container channelinghis-container">

    <div class="col-md-6 col-xs-12">
        <p>jsbdvjhbdfk bdvkjbdskv kdnnkjjnds----------------------------------------------------------------
        .....................................................................................................
        .....................................................................................................<p>
    </div>
    <div class="col-md-6 col-xs-12 tab-background">
        <div class="h4-channelinghis">
            <h4>Channeling history - Search Appointment</h4>
        </div>
        <ul class="nav nav-tabs tab-font" id="top-tabs" role="tablist">
            <li class="active"><a role="tab" data-toggle="tab" href="#onetimeusertab">ONE TIME USER</a></li>
            <li><a role="tab" data-toggle="tab" href="#Membertab">MEMBER</a></li>
        </ul>

        <div class="tab-content">
            <div id="onetimeusertab" class="tab-pane fade in active" role="tabpanel">
                <br>
                <form>
                    <div class="form-group">
                        <label for="usernic">NIC/ Passport No:</label>
                        <input type="text" class="form-control" id="usernic" placeholder="Enter NIC or Passport Number">
                    </div>
                    <div class="form-group">
                        <label for="userphone">NIC/ Passport No:</label>
                        <input type="text" class="form-control" id="userphone" placeholder="Enter One Phone Number">
                    </div>
                    <br>
                        <div class="p-chhistory">
                            <p><b>Please Note: </b>You only can recover channeling details within 24 hours(one day)</p>
                        </div>
                    <br>
                    <div class="tab-btn">
                        <button type="button" class="btn btn-default" id="cbtn">Search</button>
                    </div>
                </form>
            </div>
            <div id="Membertab" class="tab-pane fade" role="tabpanel">
                <br>
                <from>
                    <div class="form-group">
                        <label for="membernic">NIC/ Passport No:</label>
                        <input type="text" class="form-control" id="membernic" placeholder="Enter NIC or Passport Number">
                    </div>
                    <div class="form-group">
                        <label for="appointmentdate">Appointment Date:</label>
                        <input type="date" class="form-control" id="appointmentdate">
                    </div>
                    <div class="form-group">
                        <label for="paymentdate">Payment Date:</label>
                        <input type="date" class="form-control" id="paymentdate">
                    </div>
                    <br>
                    <div class="tab-btn">
                        <button type="button" class="btn btn-default" id="mcbtn">Search</button>
                    </div>
                </from>
            </div>
        </div>
    </div>
</div>

<?php
require ("footer.php");
?>
