<?php
session_start();

require_once "db_connection.php";

// Check if user is logged in and is admin
if (!isset($_SESSION["user_id"])) {
 // Added the missing closing parenthesis here
 header("Location: auth.php");
 exit();
}

if ($_SESSION["role"] !== "client") {
 header("Location: index.php");
 exit();
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Furfect Match</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .welcome-message {
            font-size: 1.5rem;
            color: #333;
        }
        
        .logout-btn {
            background: #ff6b6b;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .stat-card h3 {
            margin-top: 0;
            color: #666;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #ff6b6b;
        }
    </style>
</head>
<body>
    <main>
        <?php include "views/components/header.php"; ?>
        
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1 class="welcome-message">Welcome, Admin!</h1>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
            
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <?php
                    $conn = getDbConnection();
                    $stmt = $conn->query("SELECT COUNT(*) FROM users");
                    $totalUsers = $stmt->fetchColumn();
                    ?>
                    <div class="stat-value"><?php echo $totalUsers; ?></div>
                </div>
                
                <div class="stat-card">
                    <h3>Active Users</h3>
                    <?php
                    $stmt = $conn->query(
                     "SELECT COUNT(*) FROM users WHERE status = 1",
                    );
                    $activeUsers = $stmt->fetchColumn();
                    ?>
                    <div class="stat-value"><?php echo $activeUsers; ?></div>
                </div>
                
                <div class="stat-card">
                    <h3>Admins</h3>
                    <?php
                    $stmt = $conn->query(
                     "SELECT COUNT(*) FROM users WHERE role = 'admin'",
                    );
                    $admins = $stmt->fetchColumn();
                    ?>
                    <div class="stat-value"><?php echo $admins; ?></div>
                </div>
                
                <div class="stat-card">
                    <h3>Clients</h3>
                    <?php
                    $stmt = $conn->query(
                     "SELECT COUNT(*) FROM users WHERE role = 'client'",
                    );
                    $clients = $stmt->fetchColumn();
                    ?>
                    <div class="stat-value"><?php echo $clients; ?></div>
                </div>
            </div>
            
            <!-- You can add more dashboard content here -->
        </div>
    </main>
    
    <?php include "views/components/footer.php"; ?>
</body>
</html>