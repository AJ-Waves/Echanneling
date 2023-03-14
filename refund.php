<?php
require ("header.php");
?>

<div class="container form-container">
    <div class="row">
        <div class="col-md-12 col-xs-12 title-div">
            <h4>Claim Re-Fund</h4>
        </div>
    </div>
    <div class="refund-h4-style">
        <h4>Make Refund Request</h4>
    </div>

    <form>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                <label for="dname">Appointment Reference Number:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                <input type="text" class="form-control" id="appreff">
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                    <label for="dname">Reason For Refund Request:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                <textarea class="form-control" id="refundrequest" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                    <label for="accholder">Account Holder Name:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" id="accholder">
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                    <label for="bankname">Bank Name:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <select class="form-control" id="bankname" name="bankname">
                        <option value="hnb">HNB Bank</option>
                        <option value="comb">Commercial Bank</option>
                        <option value="pb">Peoples' Bank</option>
                        <option value="boc">BOC Bank</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                    <label for="bankbr">Bank Branch:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" id="bankbr">
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                    <label for="bankbrcode">Bank Branch Code:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" id="bankbrcode">
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="form-group">
                <div class="col-md-12 col-xs-12">
                    <label for="accno">Account Number:</label>
                </div>
                <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" id="accno">
                </div>
            </div>
        </div>
        <div class="row form-row-margin">
            <div class="col-md-6 col-xs-12 refund-btn-align">
                <button type="button" class="btn btn-default" id="requsesubmit">Send Details</button>
            </div>
        </div>
        <br>
    </form>
</div>
<?php
require ("footer.php");
?>
