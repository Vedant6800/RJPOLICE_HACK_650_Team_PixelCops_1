<?php
// Include database connection code here
include '../php/config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Get user input
$user_id = $_SESSION['userdata']['id']; // Assuming you have a user session
$police_station_id = $_POST['police_station'];

// Check if the user has submitted feedback for the selected police station in the last month
$last_month = date('Y-m-d', strtotime('-1 month'));
$check_query = "SELECT COUNT(*) as count FROM feedback WHERE user_id = $user_id AND police_station_id = $police_station_id AND feedback_date >= '$last_month'";
$check_result = mysqli_query($conn, $check_query);
$row = mysqli_fetch_assoc($check_result);

if ($row['count'] == 0) {
    // User has not submitted feedback for this police station in the last month
    // Insert feedback into the database
    $insert_query = "INSERT INTO feedback (user_id, police_station_id, behavior_rating, speed_rating, response_time_rating, communication_skills_rating, satisfaction_rating, transparency_rating, accessibility_rating, professionalism_rating, problem_resolution_rating, community_engagement_rating, additional_comments) VALUES ($user_id, $police_station_id, {$_POST['Behavior_rating']}, {$_POST['Speed_rating']}, {$_POST['Response_Time_rating']}, {$_POST['Communication_Skills_rating']}, {$_POST['Satisfaction_rating']}, {$_POST['Transparency_rating']}, {$_POST['Accessibility_rating']}, {$_POST['Professionalism_rating']}, {$_POST['Problem_Resolution_rating']}, {$_POST['Community_Engagement_rating']}, '{$_POST['additional_comments']}')";
    mysqli_query($conn, $insert_query);
    echo '<script>alert("Feedback submitted successfully!");</script>';
    echo '<script>window.location.href = "../../index.php";</script>';
} else {
    echo '<script>alert("You have already submitted feedback for this police station in the last month.");</script>';
    echo '<script>window.location.href = "../../index.php";</script>';
}
