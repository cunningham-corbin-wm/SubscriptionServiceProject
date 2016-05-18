<?php
    $dbh = new PDO ('mysql:host=localhost;dbname=subscriptionservicedb', 'root', 'root');

    $query = "SELECT user_id, email FROM members WHERE email = '$user_email' AND password = '$user_password'";
    $stmt = $dbh->prepare($query);
    $results = $stmt->execute(array(
        'email' => $user_email,
        'password' => $user_password
    ));

    if ($results) {
        $row = $results[0];
        $user_id = $row['user_id'];
        $email = $row['email'];
    }
    else {
        exit('<p>Please enter a valid username and password.<br /> If you don\'t have an account, please <a href="SignUp.php">create</a> one.</p>');
    }

