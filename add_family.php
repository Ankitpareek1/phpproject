<?php
include('db_connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empId = intval($_POST['empId']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $relation = mysqli_real_escape_string($conn, $_POST['relation']);
    $occupation = mysqli_real_escape_string($conn, $_POST['occupation']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    
    $query = "INSERT INTO tbl_emp_family (empId, name, relation, occupation, contact) 
              VALUES ('$empId', '$name', '$relation', '$occupation', '$contact')";
    
    if (mysqli_query($conn, $query)) {
        echo "Family member added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Family Member</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
  
</body>
</html>

<?php $conn->close(); ?>
