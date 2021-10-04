<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rush</title>
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
            <hr style="border-color:yellow">
            <hr style="border-color:yellow">
            <h1 style="margin-top:0px;padding-top:0px;font-weight:light;font-size:50px;">Rush</h1>
            <p style="font-size:30px;line-height:0px;">Please select a role</p>
            <p>You can switch roles later by logging out then logging back in</p>
            <form style="border: 4px solid #aaaaaa;border-radius:15px;width:50%;margin-left:25%;padding-top:3%;padding-bottom:3%;">
                <div>
                    <input type="radio" name="role" id="customer" value="Customer" selected>
                    <label for="customer">Customer</label><br>
                </div>
                <div>
                    <input type="radio" name="role" id="driver" value="Driver">
                    <label for="driver">Driver</label><br>
                </div>
                <div>
                    <input type="radio" name="role" id="business" value="Business">
                    <label for="business">Business</label><br>
                </div>
            </form>
        </div>
    </body>
</html>
