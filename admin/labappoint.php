<?php
require ("navbar.php")
?>
<div class="col-md-8 col-xs-12 col-md-offset-1 admin-body">
    <form>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Center Name:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="chaname">
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
                <h5 class="sch-h5">Manage Lab Appointments</h5>
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
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Time:</label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="schst" placeholder="Starting-hh:mm(24hr Clock)">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="schst" placeholder="End-hh:mm(24hr Clock)">
            </div>
        </div>
        <div class="row row-top">
            <div class="col-md-3">
                <label for="">Number of Appointments:</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="appno" placeholder="In number (Ex: 20)">
            </div>
        </div>
        <div class="col-xs-12 row-top">
            <div class="row btn-align-center">
                <button type="button" class="btn btn-default" id="dsub">Add</button>
                <button type="button" class="btn btn-default" id="dedit">Edit</button>
                <button type="button" class="btn btn-default" id="ddelete">Delete</button>
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