<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$job_id = $_GET['job_id'];

if ($_POST) {

    $email = $_SESSION['user'];

    $user = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user_data = $user->fetch_assoc();

    $user_id = $user_data['id'];
    
   $sql = "INSERT INTO applications(user_id, job_id, cv)
        VALUES('$user_id', '$job_id', '$cv_name')";

    if ($conn->query($sql)) {
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
     $cv_name = $_FILES['cv']['name'];
     $tmp_name = $_FILES['cv']['tmp_name'];

     move_uploaded_file($tmp_name, "uploads/" . $cv_name);
}
?>

<h2>Apply for Job</h2>

<form method="POST" enctype="multipart/form-data">
    Upload CV:
    <input type="file" name="cv" required><br><br>

    <button type="submit">Submit Application</button>
</form>