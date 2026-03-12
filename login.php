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
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $role;
            if ($role === 'student') {
                header("Location: student_dashboard.php");
                exit();
            } elseif ($role === 'faculty') {
                header("Location: faculty_dashboard.php");
                exit();
            } elseif ($role === 'club_admin') {
                header("Location: clubhead_dashboard.php");
                exit();
            } else {
                echo "<script>alert('Invalid role.'); window.location.href='login.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Please fill in all fields'); window.location.href='login.html';</script>";
}

$conn->close();
?>
