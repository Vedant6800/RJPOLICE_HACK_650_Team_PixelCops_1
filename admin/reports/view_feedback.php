<?php
// Include database connection code here
include '../conn.php';

if (isset($_GET['police_station_id']) && isset($_GET['month_year'])) {
    $police_station_id = $_GET['police_station_id'];
    $selectedMonthYear = $_GET['month_year'];

    // Convert to first day and last day of the selected month
    $firstDayOfMonth = date('Y-m-01', strtotime($selectedMonthYear));
    $lastDayOfMonth = date('Y-m-t', strtotime($selectedMonthYear));

    // Use prepared statement to avoid SQL injection
    $sql = "SELECT * FROM feedback 
            WHERE police_station_id = ? 
            AND feedback_date BETWEEN ? AND ? 
            ORDER BY feedback_date DESC";

    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "iss", $police_station_id, $firstDayOfMonth, $lastDayOfMonth);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-4">
        <div class="card" style="width: 80%; margin: 0 auto; background-color: #ffffff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 20px;">
            <h5 class="card-title text-center mb-4">Feedback Details</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Behavior</th>
                            <th>Speed</th>
                            <th>Response Time</th>
                            <th>Communication Skills</th>
                            <th>Satisfaction</th>
                            <th>Transparency</th>
                            <th>Accessibility</th>
                            <th>Professionalism</th>
                            <th>Problem Resolution</th>
                            <th>Community Engagement</th>
                            <th>Additional Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['feedback_date']}</td>";
                            echo "<td>{$row['behavior_rating']}</td>";
                            echo "<td>{$row['speed_rating']}</td>";
                            echo "<td>{$row['response_time_rating']}</td>";
                            echo "<td>{$row['communication_skills_rating']}</td>";
                            echo "<td>{$row['satisfaction_rating']}</td>";
                            echo "<td>{$row['transparency_rating']}</td>";
                            echo "<td>{$row['accessibility_rating']}</td>";
                            echo "<td>{$row['professionalism_rating']}</td>";
                            echo "<td>{$row['problem_resolution_rating']}</td>";
                            echo "<td>{$row['community_engagement_rating']}</td>";
                            echo "<td>{$row['additional_comments']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid police station ID or month.";
}
?>
