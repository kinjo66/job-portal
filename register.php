<?php
include 'db.php';

if ($_POST) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(fullname, email, password)
            VALUES('$fullname', '$email', '$hashed_password')";

    if ($conn->query($sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto p-4 shadow" style="max-width: 450px;">
        <!-- Registration form here -->
    

<form method="POST">
    Full Name:<br>
    <input type="text" name="fullname" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>



    <button type="submit">Register</button>
</form>

 <div class="text-center mt-3">
<a href="login.php">Already have an account? Login</a>
 </div>
   </div>
</div>
</body>
</html>