<?php
session_start();

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // ✅ FIXED QUERY (only email)
    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // ✅ CHECK PASSWORD
        if (password_verify($password, $user['password'])) {

            // ✅ CHECK ROLE MATCH
            if ($role !== $user['role']) {
                echo "<script>alert('Wrong role selected'); window.location.href='login.html';</script>";
                exit();
            }

            // ✅ SET SESSION
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // ✅ REDIRECT BASED ON ROLE
            if ($user['role'] === 'student') {
                header("Location: student_dashboard.php");
            } elseif ($user['role'] === 'faculty') {
                header("Location: faculty_dashboard.php");
            } elseif ($user['role'] === 'club_admin') {
                header("Location: clubhead_dashboard.php");
            }

            exit();

        } else {
            echo "<script>alert('Invalid password'); window.location.href='login.html';</script>";
        }

    } else {
        echo "<script>alert('User not found'); window.location.href='login.html';</script>";
    }

    $stmt->close();

} else {
    echo "<script>alert('Please fill all fields'); window.location.href='login.html';</script>";
}

$conn->close();
?>