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
        <div class="headerLinkDivActive"><p class="headerLinkP">Sign Up</p></div>
        <a href="emailOpt.php"><div class="headerLinkDiv"><p class="headerLinkP">Email Options</p></div></a>
        <a href="StoreLocations.html"><div class="headerLinkDiv"><p class="headerLinkP">Find a Store</p></div></a>
    </div>
    <!-- the end of the bottom portion the header -->
</div>
<!-- end of the header and start of the main home page -->
<div id="main">
    <div id="blank"> <!-- this div left blank on purpose --> </div>
    <div id="createUser">
        <form enctype="multipart/form-data" method="post" style="height: 150px; width: 400px;" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="breakerForm">
                <label class="createUserLB" for="first_name">First Name:</label>
                <input class="createUserIP" type="text" id="first_name" name="first_name" value="<?php if (!empty($first_name)) echo $first_name; ?>" />
            </div>
            <div class="breakerForm">
                <label class="createUserLB" for="last_name">Last Name:</label>
                <input class="createUserIP" type="text" id="last_name" name="last_name" value="<?php if (!empty($last_name)) echo $last_name; ?>" />
            </div>
            <div class="breakerForm">
                <label class="createUserLB" for="email">Email:</label>
                <input class="createUserIP" type="text" id="email" name="email" value="<?php if (!empty($email)) echo $email; ?>" />
            </div>
            <div class="breakerForm">
                <label class="createUserLB" for="location">Location:</label>
                <input class="createUserIP" list="possibleLocations" id="location" name="location" value="<?php if (!empty($location)) echo $location; ?>" />
                <datalist id="possibleLocations">
                    <option value="Phoenix"></option>
                    <option value="Glendale"></option>
                    <option value="Peoria"></option>
                    <option value="Scottsdale"></option>
                    <option value="Chandler"></option>
                    <option value="Surprise"></option>
                </datalist>
            </div>
            <div class="breakerForm">
                <label class="createUserLB" for="password">Password:</label>
                <input class="createUserIP" type="text" id="password" name="password" value="<?php if (!empty($password)) echo $password; ?>" />
            </div>
            <div class="breakerForm">
                <input type="submit" id="submit" name="submit" value="Create Account">
            </div>
        </form>
    </div>
    <?php
    // Fetching the connection predefined variables
    require_once('connectvars.php');

    // The following code will execute when the submit button is clicked
    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $location = $_POST['location'];
        $password = $_POST['password'];

        // Checks to see if all the form inputs are filled out (correctly)
        if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($location) && !empty($password)) {
            if (strlen($password) <= 16 && strlen($password) >= 1) {
                if (strlen($email) <= 48 && strlen($email) >= 1) {
                    if (strlen($first_name) <= 24 && strlen($first_name) >= 1) {
                        if (strlen($last_name) <= 24 && strlen($last_name) >= 1) {

                            // The user has inserted all the correct information into the correct form fields and we are ready to connect to the database
                            // Connect to database
                            $dbh = new PDO(DB_HOSTNAME, DB_USER, DB_PASSWORD);
                            //$dbh = new PDO('mysql:host=localhost;dbname=subscriptionservicedb', 'root', 'root');

                            // Writes the data into the database
                            $query = "INSERT INTO members VALUES (0, :first_name, :last_name, :email, :location, :password, 1, 1)";
                            $stmt = $dbh->prepare($query);
                            $stmt->execute(array(
                                'first_name' => $first_name,
                                'last_name' => $last_name,
                                'email' => $email,
                                'location' => $location,
                                'password' => $password
                            ));

                            if ($stmt){
                                // Confirms success with user
                                echo '<p class="txtMain">Your account has been successfully added!</p>';
                                echo '<p class="txtMain"><strong>First Name:</strong> '. $first_name . '</p>';
                                echo '<p class="txtMain"><strong>Last Name:</strong> ' . $last_name . '</p>';
                                echo '<p class="txtMain"><strong>Email:</strong> ' . $email . '</p>';
                                echo '<p class="txtMain"><strong>Location:</strong> ' . $location . '</p>';
                                echo '<p class="txtMain"><strong>Password:</strong> ' . $password . '</p>';
                                echo '<p class="txtMain">Thanks for registering! Click <a href="SignIn.php" style="color: forestgreen; text-decoration: underline;">HERE</a> to sign in. (Sign in required for security reasons)</p>';
                            }
                            else {
                                echo '<p class="txtError">There was an error creating your account, please try again.</p><br />';
                            }
                            // Clear the variables and form data
                            $first_name = "";
                            $last_name = "";
                            $email_name = "";
                            $location = "";
                            $password = "";

                            // Close the database connection
                            $dbh = null;
                        }
                        else {
                            echo '<p class="txtError">Please enter a valid last name which contains between 1 and 24 characters.</p><br />';
                        }
                    }
                    else {
                        echo '<p class="txtError">Please enter a valid first name which contains between 1 and 24 characters.</p><br />';
                    }
                }
                else {
                    echo '<p class="txtError">Please enter a valid email which contains between 1 and 48 characters.</p><br />';
                }
            }
            else {
                echo '<p class="txtError">Please enter a valid password which contains between 1 and 16 characters.</p><br />';
            }
        }
        else {
            // Tells the user that the form values need to be filled out
            echo '<p class="txtError">Please fill in all the required fields.</p><br />';
        }
    }
    ?>
</div>
</body>
</html>