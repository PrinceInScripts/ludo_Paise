<?php
// Include database connection
include('db.php'); // Adjust as per your file structure

// Current timestamp
$currentTimestamp = time();

try {
    // Fetch rows where the date is older than 2 minutes from the current time
    $query = "SELECT * FROM games WHERE accepted_by is not null AND isJoined = 0 AND status = 'pending'";
    $result = $con->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $fetchedDate = strtotime($row['requested_at']);

            // Check if the current time exceeds 2 minutes from the fetched date
            if ($currentTimestamp - $fetchedDate > 120) { // 120 seconds = 2 minutes
                // Delete the old entry
                $deleteQuery = "UPDATE games SET accepted_by = null, requested_at = null WHERE id = ?";
                $stmt = $con->prepare($deleteQuery);
                $stmt->bind_param('i', $id);
                $stmt->execute();

                echo "Deleted entry with ID: $id\n";
            }
        }
    } else {
        echo "No entries found.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$con->close();
?>
