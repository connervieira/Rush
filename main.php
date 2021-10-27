<?php
$force_login_redirect = true; include("./dropauth/authentication.php"); // Load the authentication system.


$account_array = unserialize(file_get_contents('./accountsDatabase.txt')); // Load the account database.
$role = $account_array[$username]["role"];
$role_time = $account_array[$username]["time"];

if ($role == "c" or $role == "d" or $role == "b") {
    // The user's role was correctly set and identified.
} else {
    // Something went wrong, and the user's role was either incorrectly configured or not set at all.
    echo "<p>Error: Your role isn't correctly set. Please navigate to the <a href='./role.php'>Role Select</a> page and try again. If the issue persists, there maybe be a server side configuration issue with Rush. In this case, contact the owner of this Rush instance for assistance.</p>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rush - Main</title>
        <link href="./dropauth/stylesheets/styles.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="padding:0px;margin:0px;background-color:#777777;width:100%;">
        <div style="background-image:linear-gradient(#222222, #777777);width:100%;padding-top:100px;width:100%;">
            <div style="text-align:left;"><a class="button" href="./role.php" style="margin-left:50px;">Reset Role</a></div>
            <h1 style="margin-top:0px;padding-top:0px;margin-bottom:15px;font-weight:light;font-size:50px;">Rush</h1>
            <hr style="border-color:white;"><br><br>
            <h1 style="margin-top:0px;padding-top:0px;font-weight:lighter;font-size:30px;margin-bottom:15px;">
                <?php
                    echo "You are currently signed in as a ";
                    if ($role == "c") {
                        echo "customer";
                    } else if ($role == "d") {
                        echo "driver";
                    } else if ($role == "b") {
                        echo "business";
                    }
                ?>
            </h1>
                <?php
                    if ($role == "c") {
                        echo '<br><br><a class="button" href="./customer/order.php">Order</a><br>';
                        
                    } else if ($role == "d") {
                        echo '<br><br><a class="button" href="./driver/payment.php">Configure Payment</a><br>';
                        echo '<br><br><a class="button" href="./driver/location.php">Configure Location</a><br>';
                        echo '<br><br><a class="button" href="./driver/price.php">Configure Pricing</a><br>';
                        echo '<br><br><a class="button" href="./driver/restrictions.php">Configure Restrictions</a><br>';

                    } else if ($role == "b") {
                        echo '<br><br><a class="button" href="./business/payment.php">Configure Payment</a><br>';
                        echo '<br><br><a class="button" href="./business/location.php">Configure Location</a><br>';
                        echo '<br><br><a class="button" href="./business/restrictions.php">Configure Restrictions</a><br>';

                    }

                ?>
        </div>
    </body>
</html>
