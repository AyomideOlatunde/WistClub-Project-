<?php
//activate the created session to be used on this page
session_start();
//deactivate session if for some reason there is no session variable
    if(!$_SESSION['email'] || $_SESSION['userRole']!='Admin'){
        header('Location : ../index.php'); //redirect to home page
        die(); //destroy session
    }

include("../api/dBConnect.php");
 if(isset($_POST["user_type"])){
    $sql="SELECT Members.F_NAME,Members.L_NAME,Members.EMAIL,Members.PHONE_NO,Members.USER_ROLE,Address.STREET, Address.CITY,Address.STATE,Address.ZIPCODE
    FROM Members
    NATURAL JOIN Address";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $output .='
            <table class="table" bordered="1">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>User Role</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zipcode</th>
                </tr>
        ';
        while($row=mysqli_fetch_assoc($result)){
            $output .='
                <tr>
                    <td>'.$row["F_NAME"].'</td>
                    <td>'.$row["L_NAME"].'</td>
                    <td>'.$row["EMAIL"].'</td>
                    <td>'.$row["PHONE_NO"].'</td>
                    <td>'.$row["USER_ROLE"].'</td>
                    <td>'.$row["STREET"].'</td>
                    <td>'.$row["CITY"].'</td>
                    <td>'.$row["STATE"].'</td>
                    <td>'.$row["ZIPCODE"].'</td>
                </tr>
            ';
        }
        $output .='</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=WISTMembers.xls");
        echo $output;
    }
 }else{
    header('Location : usersInfo.php');
 }
?>