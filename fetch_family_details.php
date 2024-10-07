<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $empId = intval($_GET['id']);
    $salary_query = "
        SELECT s.*, e.name as employee_name, d.name as department_name, b.name as branch_name, de.name as designation 
        FROM tbl_emp_salary s
        JOIN tbl_employee e ON s.empId = e.empId
        JOIN tbl_department d ON e.departmentId = d.departmentId
        JOIN tbl_branch b ON e.branchId = b.branchId
        JOIN tbl_designation de ON s.designationId = de.designationId
        WHERE s.empId = $empId";
    
    $result = mysqli_query($conn, $salary_query);
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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
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
                <th>Department</th>
                <th>Branch</th>
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
                        <td><?php echo htmlspecialchars($row['department_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['branch_name']); ?></td>
                        <td>
                            <a href="edit_salary.php?id=<?php echo $row['salaryId']; ?>">Edit</a> | 
                            <a href="delete_salary.php?id=<?php echo $row['salaryId']; ?>" onclick="return confirm('Are you sure you want to delete this salary?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="8">No salary details found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php $conn->close(); ?>
