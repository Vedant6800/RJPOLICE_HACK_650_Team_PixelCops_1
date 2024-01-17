<div class="container mt-4">
    <!-- Feedback Form -->
    <form action="assets/pages/process_feedback.php" method="post" class="bg-white p-4 rounded shadow">
        <div class="form-group">
            <label for="police_station">Select Police Station:</label>
            <select class="form-control" name="police_station" id="police_station">
                <!-- Populate dropdown with available police stations from database -->
                <!-- Use PHP code to fetch and display police stations -->
                <?php
                include '../php/config.php';

                $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $query = "SELECT id, station_name FROM police_station";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['station_name']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Input fields for each parameter -->
        <!-- Use PHP code to dynamically generate input fields based on parameters -->
        <?php
        $parameters = ['Behavior', 'Speed', 'Response Time', 'Communication Skills', 'Satisfaction', 'Transparency', 'Accessibility', 'Professionalism', 'Problem Resolution', 'Community Engagement'];

        foreach ($parameters as $parameter) {
            echo "<div class='form-group'>";
            echo "<label for='{$parameter}'>{$parameter} Rating:</label>";
            echo "<input type='number' class='form-control' name='{$parameter}_rating' min='1' max='10' required>";
            echo "</div>";
        }
        ?>

        <!-- Additional comments -->
        <div class="form-group">
            <label for="additional_comments">Additional Comments:</label>
            <textarea class="form-control" name="additional_comments" rows="4" cols="50"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>