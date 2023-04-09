<?php
//activate the created session to be used on this page
session_start();
//deactivate session if for some reason there is no session variable
    if(!$_SESSION['email'] || $_SESSION['userRole']!='Admin'){
        header('Location: ../index.php'); //redirect to home page
        die(); //destroy session
    }
include("../api/dBConnect.php");
$sql = "SELECT DISTINCT USER_ROLE FROM Members";
$result = $conn->query($sql); //--SQL query to the database to retrieve data--
$all = "SELECT * FROM Members";
$allResult = $conn->query($all); //--SQL query to the database to retrieve data--
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIST CLUB WEBSITE</title>
</head>
<body>
    <form action="exportMembers.php" method="post">
    <?php					
        echo '<select style="width: 200px;" name="user_type">';
        echo '<option selected value="">Select one...</option>';
        
        //--Results returned at least on entry from the database query--
        if($result -> num_rows > 0)  
        {
            //--Go to all the rows returned from the results of the database query--
            while($row = $result-> fetch_assoc())  
            {  
                $type = $row['USER_ROLE'];
                
                //display each title in a drop down menu
                echo '<option value="'.$type.'">'.$type.'</option>';
            }
        }
        
        echo '</select>';
        
        // Close connection
        mysqli_close($conn);
    ?>
    <button>Download</button>
    </form>
    <?php					
        echo '<table bordered="1">
            <tr>
            <th>Full Name</th>
            <th>Email</th>
            <tr>
        ';
        
        //--Results returned at least on entry from the database query--
        if($allResult -> num_rows > 0)  
        {
            //--Go to all the rows returned from the results of the database query--
            while($row = $allResult-> fetch_assoc())  
            {  
                echo '
                <tr>
                    <td>'.$row["F_NAME"].' '.$row["L_NAME"].'</td>
                    <td>'.$row["EMAIL"].'</td>
       		    <td><a href="edit.php?ADDRESS_ID='.$row["ADDRESS_ID"].'&email='.$row["EMAIL"].'">Edit</a></td>
                    <td><a href="deleteMembers.php?ADDRESS_ID='.$row["ADDRESS_ID"].'">Delete</a></td>
                </tr>
                ';                
            }
        }
    
        echo '</table>';
        
        // Close connection
        mysqli_close($conn);
    ?>
</body>
</html>