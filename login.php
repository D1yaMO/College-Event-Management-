<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

echo "Login PHP is working"; // TEMP DEBUG
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['email'], $_POST['password'], $_POST['role'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("
        SELECT id, name, email, password, role, department, usn, phone, semester 
        FROM users 
        WHERE email = ?
    ");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            if ($role !== $user['role']) {
                echo "<script>alert('Wrong role selected'); window.location.href='login.html';</script>";
                exit();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['usn'] = $user['usn'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['semester'] = $user['semester'];

            if (
                empty($user['usn']) ||
                empty($user['phone']) ||
                empty($user['semester']) ||
                empty($user['department'])
            ) {
                header("Location: complete_profile.php");
                exit();
            }

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
}

$conn->close();
?>