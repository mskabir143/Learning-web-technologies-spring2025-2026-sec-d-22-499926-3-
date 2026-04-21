<?php
$error = "";
$success = "";

if (isset($_POST['submit'])) {
    // Basic file info
    $fileName = $_FILES['pic']['name'];
    $fileSize = $_FILES['pic']['size'];
    
    $isValid = true;

    // Check if a file was actually selected
    if ($fileName == "") {
        $error = "Please select a file.";
        $isValid = false;
    }

    if ($isValid == true) {
        // Validation B: Size check (4MB = 4 * 1024 * 1024 bytes = 4194304)
        if ($fileSize > 4194304) {
            $error = "Picture size should not be more than 4MB.";
            $isValid = false;
        }

        // Validation A: Format check using basic string check
        // We find the extension manually by looking for the last '.'
        $ext = "";
        for ($i = 0; $i < strlen($fileName); $i++) {
            if ($fileName[$i] == ".") {
                // Reset extension every time a dot is found to get the LAST one
                $ext = ""; 
            } else {
                $ext = $ext . $fileName[$i];
            }
        }

        // Convert extension to lowercase manually if needed, but here we check basic ones
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "JPG" && $ext != "PNG") {
            $error = "Format must be jpeg, jpg, or png.";
            $isValid = false;
        }
    }

    if ($isValid == true) {
        $success = "Picture uploaded successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <form method="POST" enctype="multipart/form-data">
        <fieldset style="width: 300px; font-family: sans-serif;">
            <legend>PROFILE PICTURE</legend>
            <img src="https://via.placeholder.com/100" alt="Icon" width="100"><br><br>
            
            <input type="file" name="pic"><br>
            <hr>
            <input type="submit" name="submit" value="Submit">
            
            <?php if($error != "") echo "<p style='color:red;'>$error</p>"; ?>
            <?php if($success != "") echo "<p style='color:green;'>$success</p>"; ?>
        </fieldset>
    </form>
</body>
</html>