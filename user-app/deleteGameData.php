<?php
// Database connection
$host = 'localhost';  // Change if needed
$dbname = 'ludopaisa';  // Replace with your database name
$username = 'root';  // Replace with your DB username
$password = '';  // Replace with your DB password

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define an array of tables you want to truncate
    $tablesToTruncate = [
        'aadhaar_data',
        'admin_earnings',
        'bankdetails',
        'bonus',
        'games',
        'game_record',
        'notifications',
        'paymenthistory',
        'penalties',
        'users',
        'withdrawrecord',


        // Add more table names as needed
    ];

    // Disable foreign key checks before truncating tables
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

    // Loop through each specified table and truncate it
    foreach ($tablesToTruncate as $table) {
        $pdo->exec("TRUNCATE TABLE `$table`");
        echo "Table $table has been truncated.<br>";
    }

    // Re-enable foreign key checks after truncating tables
    $pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

    echo "Selected tables truncated successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
