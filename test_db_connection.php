<?php
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    echo "❌ Connection FAILED: " . $conn->connect_error;
} else {
    echo "✅ Connection SUCCESSFUL!";
    
    // Test query
    $result = $conn->query("SELECT COUNT(*) as user_count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<br>✅ Users table found with " . $row['user_count'] . " users";
    } else {
        echo "<br>❌ Error querying users table: " . $conn->error;
    }
}

$conn->close();
?>
