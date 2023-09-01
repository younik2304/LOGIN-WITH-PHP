<?php
session_start();

echo "<h1>Please Log In</h1>";

require_once("connex.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Validate input
    if (empty($email) || empty($password)) {
        echo "Email and password are required";
    } elseif (!strpos($email, "@")) {
        echo "Email must have an at-sign (@)";
    } else {
        $stmt = $pdo->prepare("SELECT name, password FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            // Email not found in the database
            echo "Email not found";
        } else {
            $hashedPassword = $row["password"];
        
            // Verify the password
            if ($password==$hashedPassword) {
                // Successful login
                $_SESSION["name"] = $row["name"];
                header("Location: autos.php?name=" . urlencode($row["name"]));
                exit();
            } else {
                error_log("Login fail " . $email); // Log the email instead
                echo "Incorrect password";
            }
            }
        }
    }

?>

<form action="login.php" method='post'>
    User email: <input type="email" name='email'><br>
    Password: <input type="password" name='password'><br>
    <input type="submit" value='Log In'>
    <input type="submit" value='Cancel'>
    <p>For a password hint, view source and find a password hint in the HTML comment.</p>
</form>
