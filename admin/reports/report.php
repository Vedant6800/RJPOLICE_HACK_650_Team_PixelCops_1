<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Reports</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS styles -->
    <style>
        /* Add your custom styles here */
        body {
            background-color: #f8f9fa; /* Set background color */
        }
    </style>
</head>
<body>

<?php
include '../conn.php';

// Fetch feedback rankings for each police station
$sql = "SELECT police_station_id, AVG((behavior_rating + speed_rating + response_time_rating + communication_skills_rating + satisfaction_rating + transparency_rating + accessibility_rating + professionalism_rating + problem_resolution_rating + community_engagement_rating) / 10) AS average_rating
        FROM feedback
        GROUP BY police_station_id
        ORDER BY average_rating DESC";

$result = mysqli_query($conn, $sql);
?>

<div class="container">
    <form method='post' action='' class='mx-auto mt-4 p-4 bg-light rounded shadow'>
        <div class='form-group'>
            <label for='month_year'>Select Month and Year: </label>
            <select class='form-control' name='month_year'>
                <?php
                // Generate options for the last 12 months
                for ($i = 0; $i < 12; $i++) {
                    $timestamp = strtotime("-$i months");
                    $monthYear = date("F Y", $timestamp);
                    echo "<option value='" . date("Y-m", $timestamp) . "'>$monthYear</option>";
                }
                ?>
            </select>
        </div>
        <input type='submit' class='btn btn-primary' value='Show Reports'>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get selected month and year
        $selectedMonthYear = $_POST['month_year'];

        // Convert to the first day and last day of the selected month
        $firstDayOfMonth = date('Y-m-01', strtotime($selectedMonthYear));
        $lastDayOfMonth = date('Y-m-t', strtotime($selectedMonthYear));

        // Display feedback rankings for the selected month
        $sql = "SELECT ps.id, ps.station_name, AVG((f.behavior_rating + f.speed_rating + f.response_time_rating + f.communication_skills_rating + f.satisfaction_rating + f.transparency_rating + f.accessibility_rating + f.professionalism_rating + f.problem_resolution_rating + f.community_engagement_rating) / 10) AS average_rating
                FROM feedback AS f
                JOIN police_station AS ps ON f.police_station_id = ps.id
                WHERE f.feedback_date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'
                GROUP BY f.police_station_id
                ORDER BY average_rating DESC";

        $result = mysqli_query($conn, $sql);
        ?>

        <div class='card mx-auto mt-4' style='width: 80%;'>
            <div class='card-body'>
                <h5 class='card-title'>Feedback Rankings</h5>

                <div class='table-responsive'>
                    <table class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th>Police Station</th>
                                <th>Average Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $police_station_id = $row['id'];
                                $police_station_name = $row['station_name'];
                                $average_rating = $row['average_rating'];

                                // Fetch police station name based on $police_station_id from the database

                                echo "<tr><td><a href='view_feedback.php?police_station_id=$police_station_id&month_year=$selectedMonthYear'>$police_station_name</a></td><td>$average_rating</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
}
?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
