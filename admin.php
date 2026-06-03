<?php
include 'db.php';

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Admin Dashboard</span>
    </div>
</nav>
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $conn->query("UPDATE applications SET status='Approved' WHERE id='$id'");
}

if (isset($_GET['reject'])) {
    $id = $_GET['reject'];
    $conn->query("UPDATE applications SET status='Rejected' WHERE id='$id'");
}
$sql = "
SELECT
    applications.id,
    users.fullname,
    users.email,
    jobs.title,
    applications.status,
    applications.cv
FROM applications
JOIN users ON applications.user_id = users.id
JOIN jobs ON applications.job_id = jobs.id
";

$result = $conn->query($sql);
?>

<h2>Applications
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></h2>

<div class="container mt-4">
    <h2 class="mb-4">Applications</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Job</th>
                <th>Status</th>
                <th>CV</th>
            </tr>
        </thead>
        <tbody>

        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td>
    <?php echo $row['status']; ?>
    <br><br>

    <a href="admin.php?approve=<?php echo $row['id']; ?>"
       class="btn btn-success btn-sm">
       Approve
    </a>

    <a href="admin.php?reject=<?php echo $row['id']; ?>"
       class="btn btn-danger btn-sm">
       Reject
    </a>
</td>
                <td>
                    <a href="uploads/<?php echo $row['cv']; ?>" class="btn btn-sm btn-primary">
                        View CV
                    </a>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>

</body>
</html>