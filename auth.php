<?php
session_start();
require_once "db_connection.php";

// Initialize error and success messages
$errors = [];
$success = "";

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 if (isset($_POST["login"])) {
  // Login logic
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  if (empty($email) || empty($password)) {
   $errors[] = "Please fill in all fields";
  } else {
   try {
    $conn = getDbConnection();
    $stmt = $conn->prepare(
     "SELECT * FROM users WHERE email = ? AND status = 1",
    );
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
     $_SESSION["user_id"] = $user["user_id"];
     $_SESSION["email"] = $user["email"];
     $_SESSION["role"] = $user["role"];

     // Redirect based on role
     if ($user["role"] === "admin") {
      header("Location: dashboard.php");
     } else {
      header("Location: index.php");
     }
     exit();
    } else {
     $errors[] = "Invalid email or password";
    }
   } catch (PDOException $e) {
    $errors[] = "Database error: " . $e->getMessage();
   }
  }
 } elseif (isset($_POST["register"])) {
  // Registration logic (only for clients)
  $firstname = trim($_POST["firstname"]);
  $lastname = trim($_POST["lastname"]);
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $confirm_password = trim($_POST["confirm_password"]);

  // Validate inputs
  if (
   empty($firstname) ||
   empty($lastname) ||
   empty($email) ||
   empty($password) ||
   empty($confirm_password)
  ) {
   $errors[] = "All fields are required";
  } elseif ($password !== $confirm_password) {
   $errors[] = "Passwords do not match";
  } elseif (strlen($password) < 8) {
   $errors[] = "Password must be at least 8 characters";
  } else {
   try {
    $conn = getDbConnection();

    // Check if email exists
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
     $errors[] = "Email already exists";
    } else {
     // Hash password
     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

     // Insert new client
     $stmt = $conn->prepare(
      "INSERT INTO users (firstname, lastname, email, password, role, status) VALUES (?, ?, ?, ?, 'client', 1)",
     );
     $stmt->execute([$firstname, $lastname, $email, $hashed_password]);

     $success = "Registration successful! You can now login.";
     // Switch to login view after successful registration
     echo "<script>document.addEventListener('DOMContentLoaded', function() { toggleForms('login'); });</script>";
    }
   } catch (PDOException $e) {
    $errors[] = "Database error: " . $e->getMessage();
   }
  }
 }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Furfect Match - Authentication</title>
    <!-- Font Awesome for burger icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Rammetto+One&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/index.css" />
    <link rel="stylesheet" href="assets/css/auth.css" />
</head>
<body>
    <main>
        <?php include "views/components/header.php"; ?>
        <div class="container">


            
            <!-- Login Form -->
            <div class="content-wrapper active" id="login-form">
                <div class="image-container">
                    <img src="assets/images/login.png" alt="Login" />
                </div>
                <div class="text-content">
                    <h2>Login</h2>
                    <p>Please enter your login credentials</p>
                                <?php if (!empty($errors)): ?>
                <div class="alert error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert success">
                    <p><?php echo htmlspecialchars($success); ?></p>
                </div>
            <?php endif; ?>
                    <form action="auth.php" method="post">
                        <label for="login-email">Email</label>
                        <input type="email" name="email" id="login-email" required />
                        
                        <label for="login-password">Password</label>
                        <input type="password" name="password" id="login-password" required />
                        
                        <input type="submit" name="login" class="btn-primary" value="Login" />
                    </form>
                    <p class="toggle-form">Don't have an account? <a href="#" onclick="toggleForms('register')">Sign up</a></p>
                </div>
            </div>
            
            <!-- Register Form -->
            <div class="content-wrapper" id="register-form">
                <div class="image-container">
                    <img src="assets/images/register.png" alt="Register" />
                </div>
<div class="text-content">
    <h2>Register</h2>
    <p>Create your account</p>
                                    <?php if (!empty($errors)): ?>
                <div class="alert error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert success">
                    <p><?php echo htmlspecialchars($success); ?></p>
                </div>
            <?php endif; ?>
    <form action="auth.php" method="post">
        <div class="name-fields">
            <div>
                <label for="reg-firstname">First Name</label>
                <input type="text" name="firstname" id="reg-firstname" required />
            </div>
            <div>
                <label for="reg-lastname">Last Name</label>
                <input type="text" name="lastname" id="reg-lastname" required />
            </div>
        </div>
        
        <div>
            <label for="reg-email">Email</label>
            <input type="email" name="email" id="reg-email" required />
        </div>
        
        <div class="password-fields">
            <div>
                <label for="reg-password">Password</label>
                <input type="password" name="password" id="reg-password" required minlength="8" />
            </div>
            <div>
                <label for="reg-confirm-password">Confirm Password</label>
                <input type="password" name="confirm_password" id="reg-confirm-password" required minlength="8" />
            </div>
        </div>
        
        <input type="submit" name="register" class="btn-primary" value="Register" />
    </form>
    <p class="toggle-form">Already have an account? <a href="#" onclick="toggleForms('login')">Sign in</a></p>
</div>
            </div>

        </div>   

    </main>

                    <?php include "views/components/footer.php"; ?>
    <script>
        function toggleForms(formToShow) {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            
            if (formToShow === 'login') {
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
            } else {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
            }
        }
    </script>
</body>
</html>