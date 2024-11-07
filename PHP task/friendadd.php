<?php
require 'functions/db.php';
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION["user_email"];
$sql = "SELECT * FROM friends WHERE friend_email != '$email' AND friend_id NOT IN 
       (SELECT friend_id2 FROM myfriends WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email='$email'))";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Friends</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="font-family: 'Arial', sans-serif; background-color: #f0f4f8; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%;">
        <h2 style="text-align: center; color: #007BFF; font-size: 2.5em; margin-bottom: 30px;">Add Friends</h2>

        <ul style="list-style-type: none; padding-left: 0; font-size: 1.2em;">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li style="background-color: #e9f5ff; padding: 15px; margin-bottom: 10px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo $row['profile_name']; ?></span>
                    <a href="addfriend.php?id=<?php echo $row['friend_id']; ?>" 
                       style="background-color: #28a745; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px; font-size: 0.9em;">
                       Add as Friend
                    </a>
                </li>
            <?php } ?>
        </ul>

        <div style="text-align: center; margin-top: 30px;">
            <a href="friendlist.php" style="text-decoration: none; background-color: #007BFF; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block;">Friend List</a>
            <a href="logout.php" style="text-decoration: none; background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block;">Log Out</a>
        </div>
    </div>
</body>

</html>
