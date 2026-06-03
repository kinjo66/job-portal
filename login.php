<?php
session_start();
include 'db.php';

if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];

   $result = $conn->query("SELECT * FROM users WHERE email='$email'");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $email;
        header("Location: jobs.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
} else {
    $error = "Invalid email or password!";
}

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $email;
        header("Location: jobs.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto p-4 shadow" style="max-width: 450px;">
        <h2 class="text-center mb-4">Login</h2>

        <?php if(isset($error)) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
            
        </form>

        <div class="text-center mt-3">
            <a href="register.php">Create an account</a>
        </div>
    </div>
</div>

</body>
</html>