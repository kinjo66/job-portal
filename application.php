<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin@email.com') {
    header("Location: login.php");
    exit();
}

// optional: restrict to admin only
$result = $conn->query("
    SELECT applications.*, users.email, jobs.title
    FROM applications
    JOIN users ON applications.user_id = users.id
    JOIN jobs ON applications.job_id = jobs.id
    ORDER BY applications.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Job Applications</h2>

    <table class="table table-bordered table-striped">
       <thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Email</th>
    <th>Job</th>
    <th>Status</th>
    <th>Actions</th> <!-- NEW COLUMN -->
</tr>
</thead>

        <tbody>
            <?php while($row = $result->fetch_assoc()) { ?>
               <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td>
<?php
if ($row['status'] == "Approved") {
    echo "<span class='badge bg-success'>Approved</span>";
} elseif ($row['status'] == "Rejected") {
    echo "<span class='badge bg-danger'>Rejected</span>";
} else {
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
?>
</td>

    <!-- ✅ ADMIN BUTTONS GO HERE -->
    <td>
        <?php if (!empty($row['cv'])) { ?>
    <a href="uploads/<?php echo $row['cv']; ?>" target="_blank" class="btn btn-info btn-sm">
        View CV
    </a>
<?php } else { ?>
    <span class="text-muted">No CV</span>
<?php } ?>

        <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Approved"
           class="btn btn-success btn-sm">
           Approve
        </a>

        <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Rejected"
           class="btn btn-danger btn-sm">
           Reject
        </a>
    </td>
</tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>