<?php
include('db_connection.php');

if (isset($_GET['empId'])) {
    $empId = intval($_GET['empId']);

    $query = "
        SELECT s.*, e.name as employee_name 
        FROM tbl_emp_salary s
        JOIN tbl_employee e ON s.empId = e.empId
        WHERE s.empId = $empId";

    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "No salary details found for this employee.";
        exit;
    }
} else {
    echo "No employee ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       
    </style>
</head>
<body>
    <h1>Salary Details</h1>
    <table>
        <thead>
            <tr>
                <th>SR NO</th>
                <th>Employee Name</th>
                <th>Amount</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php $sr_no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $sr_no++; ?></td>
                        <td><?php echo htmlspecialchars($row['employee_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['amount']); ?></td>
                        <td><?php echo htmlspecialchars($row['fromDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['toDate']); ?></td>
                        <td>
                            <a href="edit_salary.php?id=<?php echo $row['salaryId']; ?>">Edit</a> | 
                            <a href="delete_salary.php?id=<?php echo $row['salaryId']; ?>" onclick="return confirm('Are you sure you want to delete this salary?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">No salary details found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
