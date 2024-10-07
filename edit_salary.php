<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $salaryId = intval($_GET['id']);

    $query = "
        SELECT s.*, e.name as employee_name 
        FROM tbl_emp_salary s
        JOIN tbl_employee e ON s.empId = e.empId
        WHERE s.salaryId = $salaryId";

    $result = mysqli_query($conn, $query);
    $salary = mysqli_fetch_assoc($result);

    if (!$salary) {
        echo "Salary record not found.";
        exit;
    }
} else {
    echo "No salary ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Salary</title>
</head>
<body>
    <h1>Edit Salary for <?php echo htmlspecialchars($salary['employee_name']); ?></h1>
    <form action="update_salary.php" method="post">
        <input type="hidden" name="salaryId" value="<?php echo $salary['salaryId']; ?>">
        <label>Amount: <input type="text" name="amount" value="<?php echo htmlspecialchars($salary['amount']); ?>" required></label>
        <label>From Date: <input type="date" name="fromDate" value="<?php echo $salary['fromDate']; ?>" required></label>
        <label>To Date: <input type="date" name="toDate" value="<?php echo $salary['toDate']; ?>" required></label>
        <input type="submit" value="Update Salary">
    </form>
</body>
</html>

<?php $conn->close(); ?>
