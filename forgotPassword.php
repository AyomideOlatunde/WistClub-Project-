<?php
include("dBConnect.php");
session_start();

// If the user submits the form to reset their password
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the submitted security pin is correct
    $security_pin = $_POST["security_pin"];
    $email = $_SESSION["email"];

    $query = "SELECT * FROM members WHERE email='$email' AND security_pin='$security_pin'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Security pin is correct, show the form to reset password
        echo '<form method="post" action="updatePassword.php">';
        echo '<label for="new_password">New Password:</label>';
        echo '<input type="password" id="new_password" name="new_password"><br>';
        echo '<label for="confirm_password">Confirm Password:</label>';
        echo '<input type="password" id="confirm_password" name="confirm_password"><br>';
        echo '<input type="submit" value="Reset Password">';
        echo '</form>';
    } else {
        // Security pin is incorrect, show error message
        echo 'Incorrect security pin, please try again.';
    }

} else {
    // Show the form to enter security pin
    echo '<form method="post" action="">';
    echo '<label for="security_pin">Enter your security pin:</label>';
    echo '<input type="text" id="security_pin" name="security_pin"><br>';
    echo '<input type="submit" value="Submit">';
    echo '</form>';
}
?>