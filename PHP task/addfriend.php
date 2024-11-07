<?php 
require 'functions/db.php'; 
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit();
}

$currentUserEmail = $_SESSION["user_email"];
$friendIdToAdd = isset($_GET['id']) ? $_GET['id'] : null;

if ($friendIdToAdd) {
    $sql = "SELECT friend_id FROM friends WHERE friend_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currentUserEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $currentUserId = $result->fetch_assoc()['friend_id'];

        $insertSql = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)";
        $stmtInsert = $conn->prepare($insertSql);
        $stmtInsert->bind_param("ii", $currentUserId, $friendIdToAdd);

        if ($stmtInsert->execute()) {
            $updateCountSql = "UPDATE friends 
                               SET num_of_friends = num_of_friends + 1 
                               WHERE friend_id = ? OR friend_id = ?";
            $stmtUpdate = $conn->prepare($updateCountSql);
            $stmtUpdate->bind_param("ii", $currentUserId, $friendIdToAdd);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            header("Location: friendadd.php?success=Friend added successfully");
            exit();
        } else {
            echo "Error adding friend: " . $conn->error;
        }

        $stmtInsert->close();
    }
    $stmt->close();
} else {
    echo "No friend ID provided!";
}

$conn->close();
?>
