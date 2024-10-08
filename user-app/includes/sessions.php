<?php 

// Check if the user is logged in
// Check if user is logged in
if (!isset($_SESSION['isLogin'])) {
    // Check if a cookie exists
    if (isset($_COOKIE['login_token'])) {
        $token = $_COOKIE['login_token'];

        // Fetch user from the database by token
        $query = "SELECT id, login_token FROM users WHERE login_token = '$token' LIMIT 1";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Re-create the session
            $_SESSION['isLogin'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['session_token'] = $user['login_token'];
        } else {
            // Invalid token, redirect to login
            header('location:login.php');
            exit();
        }
    } else {
        // No session or cookie, redirect to login
        header('location:login.php');
        exit();
    }
} else {
    // If session is set, validate session token
    $userid = $_SESSION['id'];
    $session_token = $_SESSION['session_token'];

    // Check if the session token in the database matches the current session
    $query = "SELECT login_token FROM users WHERE id = $userid LIMIT 1";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user['login_token'] !== $session_token) {
        // Token mismatch, invalidate session and force login
        session_destroy();
        header('location:login.php');
        exit();
    }
}

?>