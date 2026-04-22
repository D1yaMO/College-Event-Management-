<?php
session_start();

$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// -----------------------------
// 1. GET FORM DATA (SAFE)
// -----------------------------
$event_name = $_POST['event_name'] ?? '';
$faculty_name = $_POST['faculty_name'] ?? '';
$message = $_POST['message'] ?? '';
$uploaded_by = $_SESSION['email'] ?? 'club_admin';

// -----------------------------
// 2. INSERT FACULTY REQUEST (SAFE PREPARED STATEMENT)
// -----------------------------
$stmt = $conn->prepare("
    INSERT INTO faculty_requests (event_name, faculty_name, message)
    VALUES (?, ?, ?)
");

$stmt->bind_param("sss", $event_name, $faculty_name, $message);
$stmt->execute();

$request_id = $conn->insert_id;
$stmt->close();

// -----------------------------
// 3. CHECK CSV FILE
// -----------------------------
if (!isset($_FILES['file']) || $_FILES['file']['error'] != 0) {
    die("CSV upload failed");
}

$file = $_FILES['file']['tmp_name'];

if (($handle = fopen($file, "r")) !== FALSE) {

    // Skip header row
    fgetcsv($handle);

    // -----------------------------
    // 4. INSERT STUDENTS SAFELY
    // -----------------------------
    $stmt2 = $conn->prepare("
        INSERT INTO attendance_students 
        (request_id, name, usn, dept, sem, phone)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    while (($data = fgetcsv($handle)) !== FALSE) {

        $name  = $data[0] ?? '';
        $usn   = $data[1] ?? '';
        $dept  = $data[2] ?? '';
        $sem   = $data[3] ?? '';
        $phone = $data[4] ?? '';

        $stmt2->bind_param("isssis", $request_id, $name, $usn, $dept, $sem, $phone);
        $stmt2->execute();
    }

    fclose($handle);
    $stmt2->close();
}

// -----------------------------
// 5. SUCCESS RESPONSE
// -----------------------------
echo "<script>
alert('Request sent successfully with student data!');
window.location.href='club_admin_dashboard.php';
</script>";
?>