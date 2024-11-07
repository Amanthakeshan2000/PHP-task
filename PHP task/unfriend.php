<?php
require 'functions/db.php';
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $friend_id = $_GET['id'];
    $email = $_SESSION["user_email"];

    $sql = "SELECT friend_id FROM friends WHERE friend_email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $currentUserId = $result->fetch_assoc()['friend_id'];

        $deleteSql = "DELETE FROM myfriends WHERE friend_id1 = $currentUserId AND friend_id2 = $friend_id";
        if ($conn->query($deleteSql) === TRUE) {
            header("Location: friendlist.php?message=Friend+removed+successfully");
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    header("Location: friendlist.php?error=No+friend+ID+provided");
}
?>
