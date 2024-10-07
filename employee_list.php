<?php
include('db_connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <h1>Employee Management System</h1>

    <table border="1">
        <thead>
            <tr>
                <th>SR NO</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email ID</th>
                <th>Gender</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
         
            $sql = "SELECT e.empId, e.name, e.contact, e.emailId, e.gender, 
                           d.name AS designation, 
                           dep.name AS department, 
                           b.name AS branch 
                    FROM tbl_employee e 
                    JOIN tbl_designation d ON e.designationId = d.designationId 
                    JOIN tbl_department dep ON e.departmentId = dep.departmentId 
                    JOIN tbl_branch b ON e.branchId = b.branchId";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $email = isset($row['emailId']) ? $row['emailId'] : 'N/A';
                    $designation = isset($row['designation']) ? $row['designation'] : 'N/A';
                    $department = isset($row['department']) ? $row['department'] : 'N/A';
                    $branch = isset($row['branch']) ? $row['branch'] : 'N/A';
                    $id = isset($row['empId']) ? $row['empId'] : 'N/A';

                    echo "<tr>
                            <td>$id</td>
                            <td>{$row['name']}</td>
                            <td>{$row['contact']}</td>
                            <td>$email</td>
                            <td>{$row['gender']}</td>
                            <td>$designation</td>
                            <td>$department</td>
                            <td>$branch</td>
                            <td><a href='employee_details.php?id=$id'>View</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No employees found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
