<?php
    $error = "";
    $success = "";

    // Check if the form was submitted
    if (isset($_POST['submit'])) {
        $curr = $_POST['curr'];
        $newp = $_POST['newp'];
        $retp = $_POST['retp'];

        // Basic validation flag
        $isValid = true;

        // Rule: Check if fields are empty
        if ($curr == "" || $newp == "" || $retp == "") {
            $error = "All fields are required.";
            $isValid = false;
        }

        // Rule A: New Password should not be same as Current Password
        if ($isValid == true) {
            if ($curr == $newp) {
                $error = "New Password cannot be the same as Current Password.";
                $isValid = false;
            }
        }

        // Rule B: New Password must match with the Retyped Password
        if ($isValid == true) {
            if ($newp != $retp) {
                $error = "New Password must match with the Retyped Password.";
                $isValid = false;
            }
        }

        // Success result
        if ($isValid == true) {
            $success = "Password Changed Successfully!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password - Task 2</title>
</head>
<body>

    <form method="POST" action="change_password.php">
        <fieldset style="width: 450px; font-family: sans-serif;">
            <legend><b>CHANGE PASSWORD</b></legend>
            
            <table border="0">
                <tr>
                    <td>Current Password</td>
                    <td>: <input type="password" name="curr"></td>
                </tr>
                <tr>
                    <td style="color: green;">New Password</td>
                    <td>: <input type="password" name="newp"></td>
                </tr>
                <tr>
                    <td style="color: red;">Retype New Password</td>
                    <td>: <input type="password" name="retp"></td>
                </tr>
            </table>

            <hr>

            <input type="submit" name="submit" value="Submit">
            
            <a href="login.php" style="margin-left:10px;">Back to Login</a>

            <?php if($error != "") { echo "<p style='color:red;'>$error</p>"; } ?>
            <?php if($success != "") { echo "<p style='color:green;'>$success</p>"; } ?>

        </fieldset>
    </form>

</body>
</html>