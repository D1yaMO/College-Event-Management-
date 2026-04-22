<?php
session_start();

$conn = new mysqli("localhost","root","","event_management");

$id = $_GET['id'] ?? 0;

if($id){

    $conn->query("UPDATE faculty_requests SET status='rejected' WHERE id='$id'");

    echo "<script>
    alert('❌ Request Rejected');
    window.history.back();
    </script>";

}else{
    echo "Invalid request";
}
?>