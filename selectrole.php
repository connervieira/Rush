<?php
$force_login_redirect = true; include("./dropauth/authentication.php"); // Load the authentication system.


// Save the unsanitized input to $selected_role
$selected_role = $_POST["role"];

if ($selected_role == "c" or $selected_role == "b" or $selected_role = "d") {
    $role = $selected_role; // After verifying that the input is an expected and safe value, save it to $role.
    $account_array = unserialize(file_get_contents('./accountsDatabase.txt')); // Load the account database.
    $account_array[$username]["role"] = $role; // Set the current user's role.
    $account_array[$username]["time"] = time(); // Set the time that the current user set their role so it can expire automatically.
    file_put_contents('./accountsDatabase.txt', serialize($account_array)); // Save the database to disk.
} else {
    echo "<p>Error: Invalid POST data submitted. Request denied.</p>"; // If the POST data isn't an expected value, then reject it entirely for sake of security.
    exit(); // Stop loading the page. This error should only occur if someone is deliberating tampering with POST data, and normal users should never see this, so we don't need to show a properly formatted webpage.
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rush - Select Role</title>
        <link href="./dropauth/stylesheets/styles.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="padding:0px;margin:0px;background-color:#333333;">
        <div style="background-image:linear-gradient(#222222, #333333);width:100%;padding-top:100px;">
            <h1 style="margin-top:0px;padding-top:0px;margin-bottom:15px;font-weight:light;font-size:50px;">Rush</h1>
            <hr style="border-color:white;"><br><br>
            <h1 style="margin-top:0px;padding-top:0px;font-weight:lighter;font-size:40px;margin-bottom:15px;">
                <?php
                    if ($role == "c") {
                        echo "Signed in as a customer";
                    } else if ($role == "d") {
                        echo "Signed in as a driver";
                    } else if ($role == "b") {
                        echo "Signed in as a business";
                    } else {
                        echo "Something serious has gone wrong, and the integrity of Rush may be compromised. You should contact the owner of this Rush instance.";
                    }
                ?>
            </h1>
        </div>
    </body>
</html>
