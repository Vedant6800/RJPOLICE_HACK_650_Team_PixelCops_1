<?php

function countUsers() {
    global $conn; // Assuming $conn is your database connection object

    $query = "SELECT COUNT(*) FROM users";
    $stmt = $conn->prepare($query);

    if ($stmt->execute()) {
        $stmt->bind_result($userCount);
        $stmt->fetch();
        $stmt->close();

        return $userCount;
    } else {
        // Handle the error or return an appropriate value
        return -1; // Indicates an error
    }
}

function countPoliceStations() {
    global $conn; // Assuming $conn is your database connection object

    $query = "SELECT COUNT(*) FROM police_station";
    $stmt = $conn->prepare($query);

    if ($stmt->execute()) {
        $stmt->bind_result($policeStationCount);
        $stmt->fetch();
        $stmt->close();

        return $policeStationCount;
    } else {
        // Handle the error or return an appropriate value
        return -1; // Indicates an error
    }
}

function countPosts() {
    global $conn; // Assuming $conn is your database connection object

    $query = "SELECT COUNT(*) FROM posts";
    $stmt = $conn->prepare($query);

    if ($stmt->execute()) {
        $stmt->bind_result($postCount);
        $stmt->fetch();
        $stmt->close();

        return $postCount;
    } else {
        // Handle the error or return an appropriate value
        return -1; // Indicates an error
    }
}

function countBlockedUsers() {
    global $conn; // Assuming $conn is your database connection object

    $query = "SELECT COUNT(*) FROM users WHERE ac_status = 2";
    $stmt = $conn->prepare($query);

    if ($stmt->execute()) {
        $stmt->bind_result($blockedUserCount);
        $stmt->fetch();
        $stmt->close();

        return $blockedUserCount;
    } else {
        // Handle the error or return an appropriate value
        return -1; // Indicates an error
    }
}
?>