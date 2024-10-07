<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $salaryId = intval($_POST['salaryId']);
    $amount = intval($_POST['amount']);
    $fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
    $toDate = mysqli_real_escape_string($conn, $_POST['toDate']);
    $query = "SELECT empId FROM tbl_emp_salary WHERE salaryId = $salaryId";
    $result = mysqli_query($conn, $query);
    $salary_record = mysqli_fetch_assoc($result);

    if ($salary_record) {
        $empId = $salary_record['empId'];

        $update_query = "
            UPDATE tbl_emp_salary 
            SET amount = $amount, fromDate = '$fromDate', toDate = '$toDate'
            WHERE salaryId = $salaryId";

        if (mysqli_query($conn, $update_query)) {
            header("Location: fetch_salary_details.php?empId=" . $empId); // Redirect to salary details
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Salary record not found.";
    }
} else {
    echo "Invalid request!";
}
?>

<?php $conn->close(); ?>
