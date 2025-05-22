<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed);
        $stmt->fetch();
        if (password_verify($password, $hashed)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if (!empty($_GET['registered'])) echo "<p class='success'>Registration successful. Please log in.</p>";
        if (!empty($error)) echo "<p class='error'>$error</p>";
        ?>
        <form method="post" onsubmit="return validateLoginForm()">
            <input type="text" name="username" id="login_username" placeholder="Username" required>
            <input type="password" name="password" id="login_password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>No account? <a href="register.php">Register here</a>.</p>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>
