<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

if ($conn->connect_error) {
    die("DB Connection failed");
}

if (!isset($_SESSION['email'])) {
    echo "Please login first";
    exit();
}

$event_id = $_POST['event_id'];

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$dept = $_SESSION['department'];

/* check duplicate */
$check = $conn->prepare("
SELECT id FROM registrations 
WHERE event_id=? AND student_email=?
");

$check->bind_param("is",$event_id,$email);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    echo "Already registered";
    exit();
}

/* insert */
$stmt = $conn->prepare("
INSERT INTO registrations(event_id,student_name,student_email,department)
VALUES(?,?,?,?)
");

$stmt->bind_param("isss",$event_id,$name,$email,$dept);

if ($stmt->execute()) {
    echo "Registered successfully";
} else {
    echo "Error";
}
?>