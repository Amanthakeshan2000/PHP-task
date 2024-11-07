<?php
require 'functions/db.php';

$createFriendsTable = "CREATE TABLE IF NOT EXISTS friends (
    friend_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    friend_email VARCHAR(50) NOT NULL,
    password VARCHAR(20) NOT NULL,
    profile_name VARCHAR(30) NOT NULL,
    date_started DATE NOT NULL,
    num_of_friends INT(10) UNSIGNED
)";

$createMyFriendsTable = "CREATE TABLE IF NOT EXISTS myfriends (
    friend_id1 INT(6) NOT NULL,
    friend_id2 INT(6) NOT NULL,
    PRIMARY KEY(friend_id1, friend_id2)
)";

$conn->query($createFriendsTable);
$conn->query($createMyFriendsTable);

$tablesCreated = ($conn->query($createFriendsTable) && $conn->query($createMyFriendsTable)) ? "Tables created successfully" : "Error creating tables";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Friend System - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f4f8; color: #333; margin: 0; padding: 0;">
    <div style="max-width: 800px; margin: 50px auto; padding: 20px; background-color: #ffffff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 10px;">
        <h1 style="text-align: center; color: #007BFF; font-size: 2.5em; margin-bottom: 20px;">My Friend System</h1>

        <div style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
            <p style="font-size: 1.2em; margin: 0;"><strong>Name:</strong> Masachchige Thisaga Sathnidu Kariyawasam</p>
            <p style="font-size: 1.2em; margin: 0;"><strong>Student ID:</strong> 103841969</p>
            <p style="font-size: 1.2em; margin: 0;"><strong>Email:</strong> <a href="mailto:103841969@student.swin.edu.au" style="color: #007BFF; text-decoration: none;">103841969@student.swin.edu.au</a></p>
        </div>

        <p style="font-size: 1.1em; color: #555;">I declare that this assignment is my individual work and all materials contributed are my own.</p>

        <p style="font-size: 1.2em; color: green; text-align: center;"><?php echo $tablesCreated; ?></p>

        <div style="text-align: center; margin-top: 40px;">
            <a href="signup.php" style="text-decoration: none; background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block;">Sign Up</a>
            <a href="login.php" style="text-decoration: none; background-color: #007BFF; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block;">Log In</a>
            <a href="about.php" style="text-decoration: none; background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block;">About</a>
        </div>
    </div>
</body>

</html>
