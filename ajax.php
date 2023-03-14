<?php
require_once 'dbconnection.php';

if(isset($_GET['doc_name']) && isset($_GET['doc_specialty']) && isset($_GET['doc_hospital']) && isset($_GET['channelling_date'])){
    $doc_name = $_GET['doc_name'];
    $doc_specialty = $_GET['doc_specialty'];
    $doc_hospital = $_GET['doc_hospital'];
    $channelling_date = $_GET['channelling_date'];

    if (empty($doc_name) && empty($doc_specialty) && empty($doc_hospital) && empty($channelling_date)) {
        echo "<h2 align='center' style='color: red'>Please Enter required date and doctor info to find</h2>";
    }

    elseif (empty($doc_name) && empty($doc_specialty) && empty($doc_hospital) && !empty($channelling_date)) {
        echo "<h2 align='center' style='color: red'>Please Enter doctor info</h2>";
    }

    elseif (empty($doc_name) && empty($doc_specialty) && !empty($doc_hospital) && !empty($channelling_date)) {
        echo "<h2 align='center' style='color: red'>Please Enter doctor info to find</h2>";
    }

    elseif (!empty($doc_specialty) && !empty($channelling_date)) {

        if (empty($doc_name) && empty($doc_hospital) && ($select1=mysqli_query($con,"SELECT * From doctor_appointments WHERE doctor_nic = (SELECT nic FROM doctor WHERE speciality='$doc_specialty') AND date='$channelling_date' AND no_of_appointments > 0")) && (mysqli_num_rows($select1) <= 0)){

            echo "<h2 align='center' style='color: red'>Doctors are not available</h2>";
        }

        if (empty($doc_name) && empty($doc_hospital) && ($select1=mysqli_query($con,"SELECT * From doctor_appointments WHERE doctor_nic = (SELECT nic FROM doctor WHERE speciality='$doc_specialty') AND date='$channelling_date' AND no_of_appointments > 0")) && (mysqli_num_rows($select1) > 0)){

            $query_doc_search1 = "SELECT doctor.fname, doctor.lname, doctor.speciality, doctor_appointments.date, doctor_appointments.start_time, doctor_appointments.end_time, doctor_appointments.no_of_appointments, doctor_appointments.booked_appointments, hospital.name, hospital.Phone1, hospital.address From doctor_appointments INNER JOIN doctor ON doctor_appointments.doctor_nic = doctor.nic INNER JOIN hospital on doctor_appointments.center_reg_no = hospital.hospitalID WHERE doctor_appointments.date>='$channelling_date' AND doctor_appointments.no_of_appointments > doctor_appointments.booked_appointments";

            $search_output1 = mysqli_query($con, $query_doc_search1) or die("Search Can Not find Data");


            echo "<table width=\"100%\" class=\"table-responsive\">";
            echo "<tr><th>Doctor Name</th>
                        <th>Speciality</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Appointment</th>
                        <th>Hospital</th>
                        <th>Phone No</th>
                        <th>Address</th>
                        <th>Action</th></tr>";
            while ($row1 = mysqli_fetch_array($search_output1)) {
                $start_time=date('H:i',strtotime($row1['start_time']));
                $end_time=date('H:i',strtotime($row1['end_time']));
                $appointment_no = $row1['no_of_appointments'] - $row1['booked_appointments'];
                echo "<tr>
                        <td>{$row1['fname']} {$row1['lname']}</td>
                        <td>{$row1['speciality']}</td>
                        <td>{$row1['date']}</td>
                        <td>$start_time - $end_time</td>
                        <td>$appointment_no</td>
                        <td>{$row1['name']}</td>
                        <td>{$row1['Phone1']}</td>
                        <td>{$row1['address']}</td>
                        <td><a href='index.php? doc_fname=$row1[fname]$ doc_lname=$row1[lname]& speciality=$row1[speciality]& c_date=$row1[date]& start_time=$row1[start_time]& end_time=$row1[end_time]& appointment_no=$row1[no_of_appointments]& hos_name=$row1[name]& hos_phone=$row1[Phone1]& hos_address=$row1[address]'><i class='ion-android-create'></i></a></td></tr>";
            }
            echo "</table>";
        }

    }
}
?>