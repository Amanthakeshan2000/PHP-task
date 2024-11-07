<?php
require 'functions/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $profile_name = $_POST["profile_name"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $sql = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
                VALUES ('$email', '$password', '$profile_name', CURDATE(), 0)";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["user_email"] = $email;
            header("Location: friendadd.php");
        } else {
            $error = "Error: " . $conn->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f0f4f8; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%;">
        <h2 style="text-align: center; color: #007BFF; font-size: 2.5em; margin-bottom: 30px;">Sign Up</h2>

        <form method="POST" action="signup.php" style="display: flex; flex-direction: column;">
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                required 
                style="padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; font-size: 1em; box-sizing: border-box;">
            
            <input 
                type="text" 
                name="profile_name" 
                placeholder="Profile Name" 
                required 
                style="padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; font-size: 1em; box-sizing: border-box;">
            
            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                style="padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc; font-size: 1em; box-sizing: border-box;">
            
            <input 
                type="password" 
                name="confirm_password" 
                placeholder="Confirm Password" 
                required 
                style="padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ccc; font-size: 1em; box-sizing: border-box;">
            
            <button 
                type="submit" 
                style="background-color: #28a745; color: white; padding: 12px; border: none; border-radius: 5px; font-size: 1.1em; cursor: pointer;">
                Register
            </button>
        </form>

        <?php if (isset($error)) { echo "<p style='color: red; text-align: center; margin-top: 20px;'>$error</p>"; } ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="text-decoration: none; color: #007BFF; font-size: 1em;">&larr; Home</a>
        </div>
    </div>
</body>

</html>
