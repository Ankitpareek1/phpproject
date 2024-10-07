<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empId = intval($_POST['empId']);
    $amount = intval($_POST['amount']);
    $fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
    $toDate = mysqli_real_escape_string($conn, $_POST['toDate']);
    $designationId = intval($_POST['designationId']);

   
    $query = "INSERT INTO tbl_emp_salary (empId, amount, fromDate, toDate, designationId) 
              VALUES ($empId, $amount, '$fromDate', '$toDate', $designationId)";
    mysqli_query($conn, $query);

    header("Location: employee_details.php?id=$empId");
} else {
    echo "Invalid request!";
}
?>




