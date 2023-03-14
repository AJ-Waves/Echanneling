<?php
require_once '../dbconnection.php';

if(isset($_GET['center_id'])){
   $center_id = $_GET['center_id'];

            if (empty($center_id)) {
                echo "<p align='center' style='color: red'>Enter Channelling Center Registration Number</p>";
            }

            if ((!empty($center_id)) && ($sql_center_reg = mysqli_query($con, "SELECT * FROM center_admin WHERE center_reg_no = '$center_id'")) && (mysqli_num_rows($sql_center_reg) <= 0)) {
                echo "<p align='center' style='color: red'>Invalid Registration Number</p>";
            }

            if ((!empty($center_id)) && ($sql_center_reg = mysqli_query($con, "SELECT * FROM center_admin WHERE center_reg_no = '$center_id'")) && (mysqli_num_rows($sql_center_reg) > 0)) {
                $sql_center_info = "SELECT * FROM center_admin WHERE center_reg_no = '$center_id'";
                $center_admin_info = mysqli_query($con, $sql_center_info) or die();

                echo "<table width=\"100%\" class=\"table-responsive\">";
                echo "<tr><th>User Name</th><th>Name</th><th>E-mail</th><th>Address</th><th>Phone No</th><th>Action</th></tr>";
                while ($row = mysqli_fetch_array($center_admin_info)) {
                    echo "<tr>
                        <td>{$row['user_name']}</td>
                        <td>{$row['admin_name']} </td>
                        <td>{$row['admin_email']}</td>
                        <td>{$row['admin_address']}</td>
                        <td>{$row['admin_phone']}</td>
                        <td>
                        <p><a href='center_admin.php? un=$row[user_name]& an=$row[admin_name]& ae=$row[admin_email]& add=$row[admin_address]& ap=$row[admin_phone]'><i class='ion-android-create'></i></a>     <a href='center_admin.php? un_delete=$row[user_name]'><i class='ion-android-delete'></i></a>
                        </p></td></tr>";
                }
                echo "</table>";
            }

}
?>