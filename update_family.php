<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $familyId = intval($_POST['familyId']);
    $empId = intval($_POST['empId']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $relation = mysqli_real_escape_string($conn, $_POST['relation']);
    $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);


    $query = "UPDATE tbl_emp_family SET name = '$name', relation = '$relation', occupation = '$occupation', contact = '$contact' WHERE familyId = $familyId";

    if (mysqli_query($conn, $query)) {
       
        header("Location: employee_details.php?id=$empId&update=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>