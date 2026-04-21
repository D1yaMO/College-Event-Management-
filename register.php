<?php
$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm_password'];
$role = $_POST['role'];

// 🟢 NEW: department (add in your form too)
$department = $_POST['department'];

if ($password != $confirm) {
    echo "<script>alert('Passwords do not match'); window.location.href='login.html';</script>";
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// check duplicate email
$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo "<script>alert('Email already registered'); window.location.href='login.html';</script>";
} else {

$stmt = $conn->prepare("
    INSERT INTO users(name,email,password,role,department)
    VALUES(?,?,?,?,?)
");

$stmt->bind_param("sssss",$name,$email,$hashed_password,$role,$department);

if($stmt->execute()){
    echo "<script>alert('Registration successful'); window.location.href='login.html';</script>";
} else {
    echo "Error: ".$stmt->error;
}

}

$conn->close();
?>
