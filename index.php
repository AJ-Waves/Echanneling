<?php
require ("header.php");
require_once "dbconnection.php";

//****************** start - Doctor Speciality select ***********
$query1 = "SELECT * FROM doctorspecialty";
$specialty_values = mysqli_query($con,$query1);
//****************** end - Doctor Speciality select ***********

//****************** start - hospital name select ***********
$query2 = "SELECT DISTINCT name FROM hospital";
$hospital_name = mysqli_query($con,$query2);
//****************** end - hospital name select ***********
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<section class="main-wrap">
    <div class="container">
        <div class="col-md-8 col-xs-12">
            <div class="row">
                <div class="owl-carousel">
                    <div><img class="img-responsive" src="img/s1.jpg"></div>
                    <div><img class="img-responsive" src="img/s2.jpg"></div>
                    <div><img class="img-responsive" src="img/s3.jpg"></div>
                    <div><img class="img-responsive" src="img/s1.jpg"></div>
                    <div><img class="img-responsive" src="img/s2.jpg"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xs-12 tab-background">


            <ul class="nav nav-tabs tab-font" id="top-tabs" role="tablist">
                <li class="active"><a role="tab" data-toggle="tab" href="#channelling">CHANNELLING</a></li>
                <li><a role="tab" data-toggle="tab" href="#medicalcheckup">MEDICAL CHECKUP</a></li>
                <li><a role="tab" data-toggle="tab" href="#hemodialysis">HEMODIALYSIS</a></li>
            </ul>

            <div class="tab-content">
                <div id="channelling" class="tab-pane fade in active" role="tabpanel">
                    <br>
                    <form>
                        <div class="form-group">
                            <label for="dname">Doctor Name:</label>
                            <input type="text" class="form-control" id="doc_name"  name="doc_name"  placeholder=" First name or Last name of the Doctor">
                        </div>

                        <div class="form-group">
                            <label for="speciality">Speciality: <a href="../spe.php">Description</a></label>
                            <select class="form-control" id="doc_specialty" name="doc_specialty">
                                <option value="">Any</option>
                                <?php while($specialty_row = mysqli_fetch_array($specialty_values)) {

                                    if ($specialty_row['specialty'] == $_POST['select_specialty'])
                                        $selected = "selected=\"selected\"";
                                    else
                                        $selected = "";
                                    echo "<option value=\"" . $specialty_row['specialty'] . "\" $selected>" . $specialty_row['specialty'] . "</option>\n ";

                                }?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hospital">Hospital:</label>
                            <label class="checkbox-inline checkbox-font"><input type="checkbox" id="c_centers" onclick="center_type()" value="channelling_centers">Channelling Centers</label>
                            <label class="checkbox-inline checkbox-font"><input type="checkbox" id="p_hospitals" onclick="center_type()" value="private_Hospitals">Private Hospitals</label>
                            <select class="form-control" id="doc_hospital" name="doc_hospital">
                                <option value="">Any</option>
                                <?php while($hospital_row = mysqli_fetch_array($hospital_name)) {

                                    if ($hospital_row['name'] == $_POST['select_hospital'])
                                        $selected = "selected=\"selected\"";
                                    else
                                        $selected = "";
                                    echo "<option value=\"" . $hospital_row['name'] . "\" $selected>" . $hospital_row['name'] . "</option>\n ";

                                }?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cdate">Date:</label>
                            <input type="date" class="form-control" id="channelling_date" name="channelling_date" placeholder="mm/dd/yy">
                        </div>
                        <div class="tab-btn form-group">
                            <input type="button" id="doc_search" name="doc_search" class="btn btn-default" value="Search"/>
                        </div>

                    </form>
                </div>
                <div id="medicalcheckup" class="tab-pane fade" role="tabpanel">
                    <br>

                        <div class="form-group">
                            <label for="hospital">Checkup Center:</label>
                            <label class="checkbox-inline checkbox-font"><input type="checkbox" id="mc_hospital" value="">Hospitals</label>
                            <label class="checkbox-inline checkbox-font"><input type="checkbox" id="mc_lab" value="">Medical Labs</label>
                            <select class="form-control" id="mc_centers" name="mc_centers">
                                <option value="">Any</option>
                                <option value="a">aaa</option>
                                <option value="b">bbb</option>
                                <option value="c">ccc</option>
                                <option value="d">ddd</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="city">City:</label>
                            <select class="form-control" id="area" name="area">
                                <option value="">Any</option>
                                <option value="a">aaa</option>
                                <option value="b">bbb</option>
                                <option value="c">ccc</option>
                                <option value="d">ddd</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mcdate">Date:</label>
                            <input type="date" class="form-control" id="mcdate" placeholder="mm/dd/yy">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-xs-4 checkbox-font">
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">F.B.C.</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">U.F.R.</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">Liver Profile</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">E.S.R.</label>
                                </div>
                                <div class="col-md-4 col-xs-4 checkbox-font">
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">E.C.G.</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">T.S.H.</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">Chest X-ray</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">Lipid Profile</label>
                                </div>
                                <div class="col-md-4 col-xs-4 checkbox-font">
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">V.D.R.L.</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">S.G.P.T</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">Creatinine</label>
                                    <label class="checkbox checkbox-margin"><input type="checkbox" value="">Serum Cholesterol</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-btn form-group">
                            <button type="button" class="btn btn-default" id="mcbtn">Search</button>
                        </div>

                </div>


                <div id="hemodialysis" class="tab-pane fade" role="tabpanel">
                    <br>

                        <div class="form-group">
                            <label for="hospital">Hospital</label>
                            <select class="form-control" id="hd_centers" name="hd_centers">
                                <option value="">Any</option>
                                <option value="a">aaa</option>
                                <option value="b">bbb</option>
                                <option value="c">ccc</option>
                                <option value="d">ddd</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="city">City:</label>
                            <select class="form-control" id="area" name="area">
                                <option value="">Any</option>
                                <option value="a">aaa</option>
                                <option value="b">bbb</option>
                                <option value="c">ccc</option>
                                <option value="d">ddd</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hddate">Date:</label>
                            <input type="date" class="form-control" id="hddate" placeholder="mm/dd/yy">
                        </div>

                        <div class="tab-btn form-group">
                            <button type="button" class="btn btn-default" id="hbtn">Search</button>
                        </div>



                </div>
            </div>
        </div>
    </div>
    <div id="search_result">
    </div>

</section>
</form>

<?php
require ("footer.php");
?>

