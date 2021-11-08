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


// Save any values submitted through the form to variables, should they exist.
$submitted_sms = $_POST["sms"];
$submitted_phone = $_POST["phone"];
$submitted_matrix = $_POST["matrix"];
$submitted_contact_notes = $_POST["contact_notes"];

// Define the function that will be used to process and save the values submitted in the form.
function process_submitted_value($submitted_value, $save_name, $user) {
    if ($submitted_value !== null and $submitted_value !== "") { // Check to see if this value had a value submitted.
        
        // Sanitize the input by removing characters that could be interpreted as code.
        $submitted_value = str_replace("<", "", $submitted_value);
        $submitted_value = str_replace(">", "", $submitted_value);
        $submitted_value = str_replace(";", "", $submitted_value);
        $submitted_value = str_replace("?", "", $submitted_value);
        $submitted_value = str_replace("!", "", $submitted_value);
        $submitted_value = str_replace("/", "", $submitted_value);
        $submitted_value = str_replace("\\", "", $submitted_value);

        echo $submitted_value;

        // Truncate the submitted value to something reasonable. This isn't meant to ensure the entered value is correct, and is instead in place to prevent a user from submitted an unreasonable large amount of data to the accounts database.
        $submitted_value = substr($submitted_value, 0, 100);

        $account_array = unserialize(file_get_contents('../accountsDatabase.txt')); // Load the account database.
        $account_array[$user]["contact"][$save_name] = $submitted_value; // Set the Monero address submitted by the user to the account database.
        file_put_contents('../accountsDatabase.txt', serialize($account_array)); // Save the account database to disk.
        return $submitted_value;
    }
}


process_submitted_value($submitted_sms, "sms", $username);
process_submitted_value($submitted_phone, "phone", $username);
process_submitted_value($submitted_matrix, "matrix", $username);
process_submitted_value($submitted_contact_notes, "contact_notes", $username);


// Load the user's current contact information from the account database, assuming it exists.
$sms = $account_array[$username]["contact"]["sms"];
$phone = $account_array[$username]["contact"]["phone"];
$matrix = $account_array[$username]["contact"]["matrix"];
$contact_notes = $account_array[$username]["contact"]["contact_notes"];

if ($submitted_sms !== null and $submitted_sms !== "") {
    $sms = $submitted_sms;
}
if ($submitted_phone !== null and $submitted_phone !== "") {
    $phone = $submitted_phone;
}
if ($submitted_matrix !== null and $submitted_matrix !== "") {
    $matrix = $submitted_matrix;
}
if ($submitted_contact_notes !== null and $submitted_contact_notes !== "") {
    $contact_notes = $submitted_contact_notes;
}


// If any of the contact information is null, set it to an empty string to make it easier to work with later.
if ($sms == null) {
    $sms = "";
}
if ($phone == null) {
    $phone = "";
}
if ($matrix == null) {
    $matrix = "";
}
if ($contact_notes == null) {
    $contact_notes = "";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rush - Driver Contact Information</title>
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
                        echo "<p>Contact Configuration</p>";

                    } else { 
                        // User is signed in as the wrong role to access this page.

                        echo "<p>You are signed in as the wrong role to access this page!</p>"; // Notify the user why the page stopped loading.
                        exit(); // Stop loading the page.
                    }
                ?>
            </h1>
            <form method="POST">
                <label for="sms">SMS (Texting): </label><input type="telephone" placeholder="+0 123-456-7890" id="sms" name="sms" value="<?php echo $sms; ?>"></input><br><br>
                <label for="phone">Phone (Calling): </label><input type="telephone" placeholder="+0 123-456-7890" id="phone" name="phone" value="<?php echo $phone; ?>"></input><br><br>
                <label for="matrix">Matrix: </label><input type="text" placeholder="@username:server.com" id="matrix" name="matrix" value="<?php echo $matrix; ?>"></input><br><br>
                <label for="contact_notes">Notes: </label><input type="text" placeholder="Notes about contact information" id="contact_notes" name="contact_notes" value="<?php echo $contact_notes; ?>"></input><br><br>
                <input type="submit">
            </form>
        </div>
    </body>
</html>
