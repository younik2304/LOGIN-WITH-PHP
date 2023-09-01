<?php
session_start();

echo "<h1>Welcome to the autos database</h1>";
echo '<a href="login.php">Please Log in</a><br>';
echo 'Attempt to go to <a href="autos.php">autos.php</a> without logging in - it should fail with an error message.';
?>
