<?php
include('db.php');
include('includes/sessions.php');

// Fetch the user ID from the session
$session_user_id = $_SESSION['id'];

// Get the number of days from the GET request (default to 7 days if not provided)
$days = isset($_GET['days']) ? intval($_GET['days']) : 7;

// Initialize the response array
$teamData = [];
$rank = 1;

// SQL query to get the leaderboard data filtered by date range
$sql = "SELECT user_id, SUM(ProfitAmount) as total 
        FROM game_record 
        WHERE status='won' 
        AND DATE(created_at) >= DATE_SUB(CURDATE(), INTERVAL $days DAY)
        GROUP BY user_id 
        ORDER BY total DESC";
$sql_run = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($sql_run)) {
    $user_id = $row['user_id'];
    $total = $row['total'];

    // Fetch user details
    $user_sql = "SELECT * FROM users WHERE id='$user_id'";
    $user_result = mysqli_query($con, $user_sql);
    $user_data = mysqli_fetch_assoc($user_result);

    // Fetch profile picture
    $img_id = $user_data['profile_pic'];
    $img_sql = "SELECT * FROM profile_pic WHERE id='$img_id'";
    $img_result = mysqli_query($con, $img_sql);
    $img_data = mysqli_fetch_assoc($img_result);

    // Push the user data into the teamData array
    $teamData[] = [
        'rank' => $rank++,
        'name' => $user_data['username'],
        'handle' => $user_data['mobile'],
        'img' => $img_data['profile'],
        'kudos' => $total,
        'sent' => rand(1, 50) // Random value for "sent" (you can replace this with real data if available)
    ];
}

// Return the leaderboard data as JSON
header('Content-Type: application/json');
echo json_encode($teamData);
?>
