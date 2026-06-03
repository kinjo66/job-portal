<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM jobs");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Job Portal</span>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto p-4 shadow" style="max-width: 450px;">
        <h2 class="text-center mb-4">Available jobs</h2>
    </div>
<a href="logout.php">Logout</a>
<hr>
<div class="container mt-4">
    <h2 class="mb-4">Available Jobs</h2>

    <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h4><?php echo $row['title']; ?></h4>
                <h6><?php echo $row['company']; ?></h6>
                <p><?php echo $row['description']; ?></p>

                <a href="apply.php?job_id=<?php echo $row['id']; ?>"
                   class="btn btn-primary">
                   Apply Now
                </a>
            </div>
        </div>
    <?php } ?>
</div>


    <hr>
<?php } ?>

</div>
</body>
</html>
