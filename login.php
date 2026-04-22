<?php
session_set_cookie_params(0, "/");
session_start();

/* DB CONNECTION */
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* LOGIN */
if (isset($_POST['email'], $_POST['password'], $_POST['role'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    /* 🔥 SAFE QUERY (REMOVED MISSING COLUMNS) */
    $stmt = $conn->prepare("
        SELECT id, name, email, password, role 
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

            /* SESSION */
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            /* REDIRECT */
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