<?php
require_once('connex.php');
session_start();

// Check if the user is logged in
if (empty($_GET["name"])) {
    die("Name parameter missing");
}else if (isset($_POST["logout"])) {
    // Logout button was pressed
    $_SESSION["name"]='';
    session_destroy();
    // End the user's session
    header('Location: index.php');
    exit();
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input validation
    if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
        echo "Mileage and year must be numeric";
    } elseif (empty($_POST['make'])) {
        echo "Make is required";
    } else {
        // If data passes validation, insert it into the database
        $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :mi)');
        $stmt->execute(array(':mk' => $_POST['make'], ':yr' => $_POST['year'], ':mi' => $_POST['mileage']));

        echo "Record inserted";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Auto Management</title>
</head>
<body>
    <h1>Auto Management</h1>
    
    <!-- Add Automobile Form -->
    <form method="POST">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" required>
        <br><br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required>
        <br><br>
        <label for="mileage">Mileage:</label>
        <input type="number" id="mileage" name="mileage" required>
        <br><br>
        <input type="submit" value="Add">
    </form>

    <!-- Logout Button -->
    <form method="POST" action="index.php">
        <input type="submit" value="Logout">
    </form>

    <!-- Display Existing Automobiles (if any) -->
    <?php
    $stmt = $pdo->query('SELECT * FROM autos');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($rows) {
        echo "<h2>Existing Automobiles:</h2>";
        echo "<ul>";
        foreach ($rows as $row) {
            echo "<li>{$row['year']} {$row['make']} (Mileage: {$row['mileage']})</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No automobiles in the database.</p>";
    }
    ?>
</body>
</html>
