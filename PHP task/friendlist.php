<?php
require 'functions/db.php';
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION["user_email"];

$sql = "SELECT friend_id FROM friends WHERE friend_email='$email'";
$result = $conn->query($sql);
$currentUserId = $result->fetch_assoc()['friend_id'];

$sql = "SELECT friends.friend_id, friends.profile_name 
        FROM friends 
        JOIN myfriends ON friends.friend_id = myfriends.friend_id2 
        WHERE myfriends.friend_id1 = $currentUserId";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Friend List</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f9fc; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%;">
        <h2 style="text-align: center; color: #007BFF; font-size: 2.5em; margin-bottom: 20px;">Your Friends</h2>

        <ul style="list-style-type: none; padding: 0; margin: 0; font-size: 1.2em;">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <li style="background-color: #eef7ff; padding: 15px; margin-bottom: 10px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <span><?php echo $row['profile_name']; ?></span>
                    <a href="unfriend.php?id=<?php echo $row['friend_id']; ?>" 
                       style="background-color: #dc3545; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px; font-size: 0.9em; transition: background-color 0.3s ease;">
                       Unfriend
                    </a>
                </li>
            <?php } ?>
        </ul>

        <div style="text-align: center; margin-top: 30px;">
            <a href="friendadd.php" style="text-decoration: none; background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block; transition: background-color 0.3s ease;">Add Friends</a>
            <a href="logout.php" style="text-decoration: none; background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 5px; margin: 5px; display: inline-block; transition: background-color 0.3s ease;">Log Out</a>
        </div>
    </div>
</body>
</html>
