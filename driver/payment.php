<?php
$force_login_redirect = true; include("../dropauth/authentication.php"); // Load the authentication system.


$account_array = unserialize(file_get_contents('../accountsDatabase.txt')); // Load the account database.
$role = $account_array[$username]["role"];
$role_time = $account_array[$username]["time"];

if ($role == "c" or $role == "d" or $role == "b") {
    // The user's role was correctly set and identified.
} else {
    // Something went wrong, and the user's role was either incorrectly configured or not set at all.
    echo "<p>Error: Your role isn't correctly set. Please navigate to the <a href='../role.php'>Role Select</a> page and try again. If the issue persists, there maybe be a server side configuration issue with Rush. In this case, contact the owner of this Rush instance for assistance.</p>";
    exit();
}


// Get the user's current Monero address, provided it exists in the account database.
$xmr_address = $account_array[$username]["xmr_address"];

// If the loaded Monero address is null, set it to an empty string to make it easier to work with later.
if ($xmr_address == null) {
    $xmr_address = "";
}



$submitted_xmr_address = $_POST["xmr_address"];


if ($submitted_xmr_address !== null and $submitted_xmr_address !== "") { // Check to see if a Monero address has been submitted through the form.
    $submitted_xmr_address = preg_replace("/[^A-Za-z0-9 ]/", '', $submitted_xmr_address); // Sanitize the submitted Monero address by removing any unexpected characters. All characters in a Monero address should be alphanumeric.
    if (strlen($submitted_xmr_address) == 95 or strlen($submitted_xmr_address) == 106) { // Make sure the Monero address submitted is an expected length.
        $account_array[$username]["xmr_address"] = $submitted_xmr_address; // Set the Monero address submitted by the user to the account database.
        file_put_contents('../accountsDatabase.txt', serialize($account_array)); // Save the account database to disk.
        $xmr_address = $submitted_xmr_address; // Set the current XMR address as the one just submitted so that it will show in the form.
    } else {
        // The Monero address entered by the user (after sanitization) isn't the correct length.
        echo "<p>Error: The Monero addres you've entered isn't an expected length. You may be missing part of your Monero address, or have accidentally entered extra characters.</p>";
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rush - Main</title>
        <link href="../dropauth/stylesheets/styles.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="padding:0px;margin:0px;background-color:#777777;width:100%;">
        <div style="background-image:linear-gradient(#222222, #777777);width:100%;padding-top:100px;width:100%;">
            <div style="text-align:left;"><a class="button" href="../main.php" style="margin-left:50px;">Back</a></div>
            <h1 style="margin-top:0px;padding-top:0px;margin-bottom:15px;font-weight:light;font-size:50px;">Driver</h1>
            <hr style="border-color:white;"><br><br>
            <h1 style="margin-top:0px;padding-top:0px;font-weight:lighter;font-size:30px;margin-bottom:15px;">
                <?php
                    if ($role == "d") {
                        // User is signed in as the correct role.
                        echo "<p>Payment Configuration</p>";

                    } else { 
                        // User is signed in as the wrong role to access this page.

                        exit(); // Stop loading the page.
                        echo "<p>You are signed in as the wrong role to access this page!</p>"; // Notify the user why the page stopped loading.
                    }
                ?>
            </h1>
            <form method="POST">
                <label for="xmr_address">Monero Address: </label><input type="text" placeholder="Monero Address" id="xmr_address" name="xmr_address" minlength="95" maxlength="106" value="<?php echo $xmr_address; ?>"></input><br><br>
                <input type="submit">
            </form>
        </div>
    </body>
</html>
