<?php
    $error = "";
    $success = "";

    if (isset($_POST['submit'])) {
        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $userName = $_POST['uname'];
        $pass     = $_POST['pass'];
        $cPass    = $_POST['cpass'];
        
        // Check if Gender is set (to avoid undefined index error)
        $gender = "";
        if (isset($_POST['gender'])) {
            $gender = $_POST['gender'];
        }

        $dd   = $_POST['dd'];
        $mm   = $_POST['mm'];
        $yyyy = $_POST['yyyy'];

        $isValid = true;

        // 1. Check if any field is empty
        if ($name == "" || $email == "" || $userName == "" || $pass == "" || $cPass == "" || $gender == "" || $dd == "" || $mm == "" || $yyyy == "") {
            $error = "All fields must be filled.";
            $isValid = false;
        }

        // 2. Validate Name (Manual Loop: Only letters, period, or dash allowed)
        if ($isValid == true) {
            for ($i = 0; $i < strlen($name); $i++) {
                $c = $name[$i];
                if (!(($c >= 'a' && $c <= 'z') || ($c >= 'A' && $c <= 'Z') || $c == '.' || $c == '-' || $c == ' ')) {
                    $error = "Name can only contain letters, periods, or dashes.";
                    $isValid = false;
                }
            }
        }

        // 3. Validate Email (Manual Loop: Must have '@' and '.')
        if ($isValid == true) {
            $atFound = false;
            $dotFound = false;
            for ($j = 0; $j < strlen($email); $j++) {
                if ($email[$j] == "@") { $atFound = true; }
                if ($email[$j] == ".") { $dotFound = true; }
            }
            if ($atFound == false || $dotFound == false) {
                $error = "Invalid Email format (must contain @ and .)";
                $isValid = false;
            }
        }

        // 4. Validate Password Match
        if ($isValid == true) {
            if ($pass != $cPass) {
                $error = "Passwords do not match.";
                $isValid = false;
            }
        }

        // 5. Validate Date of Birth (Basic numeric check)
        if ($isValid == true) {
            // Check if dd, mm, yyyy are numbers
            for($k=0; $k < strlen($dd); $k++) { if(!($dd[$k] >= '0' && $dd[$k] <= '9')) { $isValid = false; } }
            for($k=0; $k < strlen($mm); $k++) { if(!($mm[$k] >= '0' && $mm[$k] <= '9')) { $isValid = false; } }
            for($k=0; $k < strlen($yyyy); $k++) { if(!($yyyy[$k] >= '0' && $yyyy[$k] <= '9')) { $isValid = false; } }
            
            if($isValid == false) {
                $error = "Date of Birth must be numbers.";
            }
        }

        if ($isValid == true) {
            $success = "Registration Successful!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration - Task 4</title>
</head>
<body>

    <form method="POST" action="registration.php">
        <fieldset style="width: 500px; font-family: sans-serif;">
            <legend><b>REGISTRATION</b></legend>
            
            <table width="100%">
                <tr>
                    <td>Name</td>
                    <td>: <input type="text" name="name"></td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>

                <tr>
                    <td>Email</td>
                    <td>: <input type="text" name="email"> <b>i</b></td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>

                <tr>
                    <td>User Name</td>
                    <td>: <input type="text" name="uname"></td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>

                <tr>
                    <td>Password</td>
                    <td>: <input type="password" name="pass"></td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>: <input type="password" name="cpass"></td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>

                <tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Gender</legend>
                            <input type="radio" name="gender" value="Male"> Male
                            <input type="radio" name="gender" value="Female"> Female
                            <input type="radio" name="gender" value="Other"> Other
                        </fieldset>
                    </td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>

                <tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Date of Birth</legend>
                            <input type="text" name="dd" size="2"> /
                            <input type="text" name="mm" size="2"> /
                            <input type="text" name="yyyy" size="4"> <i>(dd/mm/yyyy)</i>
                        </fieldset>
                    </td>
                </tr>
                <tr><td colspan="2"><hr></td></tr>
            </table>

            <input type="submit" name="submit" value="Submit">
            <input type="reset" value="Reset">

            <?php if($error != "") { echo "<p style='color:red;'>$error</p>"; } ?>
            <?php if($success != "") { echo "<p style='color:green;'>$success</p>"; } ?>

        </fieldset>
    </form>

</body>
</html>