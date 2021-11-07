<?php $force_login_redirect = true; include("./dropauth/authentication.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rush - Role</title>
        <link href="./dropauth/stylesheets/styles.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="padding:0px;margin:0px;background-color:#333333;">
        <div style="background-color:#89cff0;width:100%;height:200px;">
        </div>
        <div style="background-image:linear-gradient(#89cff0,#33aa33);width:100%;height:50px;">
        </div>
        <div style="background-image:linear-gradient(#33aa33, #222222);width:100%;height:50px;">
        </div>
        <div style="background-image:linear-gradient(#222222, #333333);width:100%;">
            <img src="./assets/logo.svg" style="max-height:100px;margin-top:-50px;">
            <hr style="border-color:yellow;">
            <hr style="border-color:yellow;">
            <h1 style="margin-top:0px;padding-top:0px;margin-bottom:15px;font-weight:light;font-size:50px;">Rush</h1>
            <hr style="border-color:white;"><br><br>
            <h1 style="margin-top:0px;padding-top:0px;font-weight:lighter;font-size:40px;margin-bottom:15px;">Role Selection</h1>
            <p>Please select a role. You can switch roles later by logging out then logging back in.</p>
            <form style="border: 4px solid #aaaaaa;border-radius:15px;width:50%;margin-left:25%;padding-top:3%;padding-bottom:3%;" action="selectrole.php" method="post">
                <div>
                    <input type="radio" name="role" id="c" value="c" selected>
                    <label for="role">Customer</label><br>
                </div>
                <div>
                    <input type="radio" name="role" id="d" value="d">
                    <label for="role">Driver</label><br>
                </div>
                <div>
                    <input type="radio" name="role" id="b" value="b">
                    <label for="role">Business</label><br>
                </div>
                <br>
                <input type="submit" value="Choose">
            </form>
        </div>
    </body>
</html>
