<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Subscription Service Project</title>
    <script type="text/javascript" src="titleCenter.js"></script>
</head>
<body style="margin: 0;" id="body" onload="reCenter()" onresize="reCenter()">
<!-- the header div -->
<div id="header">
    <!-- the start of the top portion of the header -->
    <div id="headerTop">
        <div id="headerTopLeft">
            <div id="MTitle">
                <h2 style="text-align: center; margin: 0;">The People's Market</h2>
                <h6 style="text-align: center; margin: 0;">The convenient marketplace for the people!</h6>
            </div>
        </div>
        <div id="headerTopRight">
            <div id="Maintenance">
                <a href=""><p style="text-decoration: none; margin: 0;">Maintenance Page:<br />Admins Only!</p></a>
            </div>
        </div>
    </div>
    <!-- the end of the top portion of the header -->
    <!-- the start of the bottom portion of the header where the links are to the rest of the pages -->
    <div id="headerBottom">
        <a href="index.html"><div class="headerLinkDiv"><p class="headerLinkP">Home</p></div></a>
        <a href="SignUp.php"><div class="headerLinkDiv"><p class="headerLinkP">Sign Up</p></div></a>
        <div class="headerLinkDivActive"><p class="headerLinkP">Email Options</p></div>
        <a href="StoreLocations.html"><div class="headerLinkDiv"><p class="headerLinkP">Find a Store</p></div></a>
    </div>
    <!-- the end of the bottom portion the header -->
</div>
<!-- end of the header and start of the main home page -->
<div id="main">
    <div id="blank"> <!-- this div left blank on purpose --> </div>
    <?php
    // Fetching the connection predefined variables
    require_once('connectvars.php');

    // Making the user sign in to their account
    echo '<form enctype="multipart/form-data" method="post" style="height: 150px; width: 400px;">';
    echo '<div class="breakerForm">';
    echo '<label for="email_input" class="signInUserLB">Username/Email:</label>';
    echo '<input type="text" id="email_input" name="email_input" class="signInUserIP">';
    echo '</div>';
    echo '<div class="breakerForm">';
    echo '<label for="password_input" class="signInUserLB">Password:</label>';
    echo '<input type="text" id="password_input" name="password_input" class="signInUserIP">';
    echo '</div>';
    echo '<div class="breakerForm">';
    echo '<input type="submit" id="submit" name="submit" value="Login">';
    echo '</div>';
    echo '</form>';

    // The following code will execute when the submit button is clicked
    if (isset($_POST['submit'])) {
        // Set the user-inputted variables
        $user_email = $_POST['email_input'];
        $user_password = $_POST['password_input'];

        // Check to see if the user filled in all the fields
        if (!empty($user_email) && !empty($user_password)) {

            // Connect to the database
            $dbh = new PDO(DB_HOSTNAME, DB_USER, DB_PASSWORD);

            // create and execute the query to fetch the email(s) and password(s) from the database
            $query = "SELECT user_id, first_name, email, password FROM members WHERE email = '$user_email' AND password = '$user_password' ORDER BY user_id DESC";
            $stmt = $dbh->prepare($query);
            $stmt->execute(array(
                'email' => $user_email,
                'password' => $user_password
            ));

            if ($stmt) {
                echo '<p class="txtMain">Result 0: ' . $stmt[0] . '</p>';
                echo '<p class="txtMain">Result 1: ' . $stmt[1] . '</p>';
                echo '<p class="txtMain">Result 2: ' . $stmt[2] . '</p>';
                echo '<p class="txtMain">Result 3: ' . $stmt[3] . '</p>';
                echo '<p class="txtMain">Result 4: ' . $stmt[4] . '</p>';
                echo '<p class="txtMain">Result 5: ' . $stmt[5] . '</p>';
                echo '<p class="txtMain">Result 6: ' . $stmt[6] . '</p>';
                echo '<p class="txtMain">Result 7: ' . $stmt[7] . '</p>';
                echo '<p class="txtMain">Result 8: ' . $stmt[8] . '</p>';

                /*
                if ($user_email === $results[0] &&  $user_password === $results[1]) {


                }
                else{
                    echo '<p class="txtError">Please insert a valid username/email and password.</p>';
                    $_POST['email_input'] = "";
                    $_POST['password_input'] = "";
                }
                */

            }
            else {
                echo '<p class="txtError">There was an error accessing the database.<br />Please check your internet connection and try again in a few minutes.<br />We apologize for the inconvenience.</p>';
            }
        }
        else {
            echo '<p class="txtError">Please insert a email AND password.</p>';
        }
    }
    ?>
</div>
</body>
</html>

