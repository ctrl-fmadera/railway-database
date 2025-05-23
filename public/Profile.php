<?php
session_start();

require __DIR__ . '/../includes/database.php';
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Session checker
if (!isset($_SESSION['user_id']) || 
    !isset($_SESSION['username']) || 
    !isset($_SESSION['logged_in']) || 
    !isset($_SESSION['role']) || 
    $_SESSION['logged_in'] !== true) {
    
    // Destroy invalid session
    session_unset();
    session_destroy();
    
    // Redirect to login and echo error
    header("Location: index.php?error=session_invalid");
    exit();
}

// HEADER NAV
include('Component/nav-head.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JMCYK Profile</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/Dashboard.css">
    <link rel="stylesheet" href="css/TopNav.css">
    <script src="js/Dashboard.js" async defer></script>
    
</head>
        <style>
        #sidebar ul li.activeprofile a {
            color: var(--accent-clr);
            background-color: var(--hover-clr);
        }
        </style>
<body>
    <main>
        <section>
            <div id="Nav-container">
                <h1>JMCYK Client & Receipts Management System</h1>
            </div>
        </section>

        <div class="container">
            <h3>Profile Details:</h3><br>
            <img class="Profileimg" src="img/PROFILE.png" alt="Profile Image">
            <p>First Name: <?php echo htmlspecialchars($_SESSION['first_name']); ?></p>
            <p>User ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
        </div>
        
        <div class="container">
            <h3>Log In History:</h3>
            <br>
            <p class="lastlogin">Last login: <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
    </main>
</body>
</html>
