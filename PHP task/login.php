<?php
require 'functions/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check user credentials
    $sql = "SELECT * FROM friends WHERE friend_email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION["user_email"] = $email;
        header("Location: friendlist.php");
    } else {
        $error = "Invalid login details!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f0f4f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); max-width: 400px; width: 100%;">
        <h2 style="text-align: center; color: #007BFF; margin-bottom: 30px; font-size: 2em;">Login</h2>
        <form method="POST" action="login.php" style="display: flex; flex-direction: column;">
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                required 
                style="padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ccc; font-size: 1em; box-sizing: border-box;">
            
            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                style="padding: 12px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ccc; font-size: 1em; box-sizing: border-box;">
            
            <button 
                type="submit" 
                style="background-color: #28a745; color: white; padding: 12px; border: none; border-radius: 5px; font-size: 1.1em; cursor: pointer;">
                Login
            </button>
        </form>

        <?php if (isset($error)) { echo "<p style='color: red; text-align: center; margin-top: 20px;'>$error</p>"; } ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="text-decoration: none; color: #007BFF; font-size: 1em;">&larr; Home</a>
        </div>
    </div>
</body>

</html>
