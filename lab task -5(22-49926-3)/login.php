<?php
    $error = "";
    $success = "";

    if (isset($_POST['submit'])) {
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        
        $isValid = true;

        // 1. Check Username Length (Rule B)
        if (strlen($username) < 2) {
            $error = "User Name must be at least 2 characters.";
            $isValid = false;
        }

        // 2. Check Username Characters (Rule A)
        // We loop through the entire string to ensure only allowed characters exist
        for ($i = 0; $i < strlen($username); $i++) {
            $c = $username[$i];
            $isAllowed = false;

            // Manual check for alphanumeric, period, dash, or underscore
            if (($c >= 'a' && $c <= 'z') || ($c >= 'A' && $c <= 'Z') || ($c >= '0' && $c <= '9') || $c == '.' || $c == '-' || $c == '_') {
                $isAllowed = true;
            }

            if ($isAllowed == false) {
                $isValid = false;
                $error = "User Name contains invalid characters.";
            }
        }

        // 3. Check Password Length (Rule C)
        if ($isValid == true && strlen($password) < 8) {
            $error = "Password must be at least 8 characters.";
            $isValid = false;
        }

        // 4. Check Password Special Characters (Rule D)
        if ($isValid == true) {
            $hasSpecial = false;
            for ($j = 0; $j < strlen($password); $j++) {
                $p = $password[$j];
                // Check against specific special characters
                if ($p == '@' || $p == '#' || $p == '$' || $p == '%') {
                    $hasSpecial = true;
                }
            }

            if ($hasSpecial == false) {
                $error = "Password must contain at least one (@, #, $, %).";
                $isValid = false;
            }
        }

        // Final result
        if ($isValid == true) {
            $success = "Login Successful!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Lab Task</title>
</head>
<body>

    <form method="POST" action="login.php">
        <fieldset style="width: 350px; font-family: sans-serif;">
            <legend><b>LOGIN</b></legend>
            
            <table border="0">
                <tr>
                    <td>User Name</td>
                    <td>: <input type="text" name="uname" value="<?php if(isset($username)) echo $username; ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>: <input type="password" name="pass"></td>
                </tr>
            </table>

            <hr>

            <input type="checkbox" name="remember"> Remember Me
            <br><br>

            <input type="submit" name="submit" value="Submit">
            <a href="change_password.php" style="color: blue; text-decoration: underline; margin-left: 10px;">Forgot Password?</a>

            <?php if($error != "") { echo "<p style='color:red;'>$error</p>"; } ?>
            <?php if($success != "") { echo "<p style='color:green;'>$success</p>"; } ?>

        </fieldset>
    </form>

</body>
</html>