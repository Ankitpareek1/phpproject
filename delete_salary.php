<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $salaryId = intval($_GET['id']);
    $query = "DELETE FROM tbl_emp_salary WHERE salaryId = $salaryId";
    mysqli_query($conn, $query);

    
    header("Location: employee_details.php?id={$_GET['empId']}");
} else {
    echo "No salary ID provided!";
}
?>
