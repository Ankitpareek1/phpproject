<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT e.*, d.name as department, b.name as branch, de.name as designation 
              FROM tbl_employee e
              JOIN tbl_department d ON e.departmentId = d.departmentId
              JOIN tbl_branch b ON e.branchId = b.branchId
              JOIN tbl_designation de ON e.designationId = de.designationId
              WHERE empId = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $employee = mysqli_fetch_assoc($result);
    } else {
        echo "Employee not found.";
        exit;
    }

    $family_query = "SELECT * FROM tbl_emp_family WHERE empId = $id";
    $family_result = mysqli_query($conn, $family_query);
    $salary_query = "SELECT s.*, de.name as designation 
                     FROM tbl_emp_salary s
                     JOIN tbl_designation de ON s.designationId = de.designationId
                     WHERE s.empId = $id";
    $salary_result = mysqli_query($conn, $salary_query);
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
    <title>Employee Details</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function addSalary(event) {
            event.preventDefault();
            const form = document.getElementById('salaryForm');
            const formData = new FormData(form);

            fetch('add_salary.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
               
                loadSalaryDetails();
                form.reset();
            });
        }

        function loadSalaryDetails() {
            const empId = <?php echo $id; ?>;
            fetch(`fetch_salary_details.php?empId=${empId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('salaryDetails').innerHTML = data;
                });
        }

        window.onload = loadSalaryDetails;
    </script>
</head>
<body>

<h1>Employee Details</h1>
<p>Name: <?php echo htmlspecialchars($employee['name']); ?></p>
<p>Contact: <?php echo htmlspecialchars($employee['contact']); ?></p>
<p>Email: <?php echo htmlspecialchars($employee['emailId']); ?></p>
<p>Gender: <?php echo htmlspecialchars($employee['gender']); ?></p>
<p>Designation: <?php echo htmlspecialchars($employee['designation']); ?></p>
<p>Department: <?php echo htmlspecialchars($employee['department']); ?></p>
<p>Branch: <?php echo htmlspecialchars($employee['branch']); ?></p>

<h3>Add Family Member</h3>
<form action="add_family.php" method="post">
    <input type="hidden" name="empId" value="<?php echo $id; ?>">
    <label>Name: <input type="text" name="name" required></label>
    <label>Relation: <input type="text" name="relation" required></label>
    <label>Occupation: <input type="text" name="occupation"></label>
    <label>Contact: <input type="text" name="contact"></label>
    <input type="submit" value="Add Family Member">
</form>

<h2>Family Details</h2>
<table>
    <tr>
        <th>Family Member</th>
        <th>Relation</th>
        <th>Occupation</th>
        <th>Contact</th>
        <th>Action</th>
    </tr>
    <?php if (mysqli_num_rows($family_result) > 0): ?>
        <?php while ($family = mysqli_fetch_assoc($family_result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($family['name']); ?></td>
                <td><?php echo htmlspecialchars($family['relation']); ?></td>
                <td><?php echo htmlspecialchars($family['occupation']); ?></td>
                <td><?php echo htmlspecialchars($family['contact']); ?></td>
                <td>
                    <a href="edit_family.php?id=<?php echo $family['familyId']; ?>">Edit</a>
                    <a href="delete_family.php?id=<?php echo $family['familyId']; ?>" onclick="return confirm('Are you sure you want to delete this family member?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No family details found.</td></tr>
    <?php endif; ?>
</table>

<h3>Add Salary Details</h3>
<form id="salaryForm" onsubmit="addSalary(event)">
    <input type="hidden" name="empId" value="<?php echo $id; ?>">
    <label>Salary: <input type="number" name="amount" required></label>
    <label>From Date: <input type="date" name="fromDate" required></label>
    <label>To Date: <input type="date" name="toDate" required></label>
    <label>Designation: 
        <select name="designationId" required>
            <?php
           
            $designation_query = "SELECT * FROM tbl_designation";
            $designation_result = mysqli_query($conn, $designation_query);
            while ($designation = mysqli_fetch_assoc($designation_result)) {
                echo "<option value=\"{$designation['designationId']}\">{$designation['name']}</option>";
            }
            ?>
        </select>
    </label>
    <input type="submit" value="Add Salary">
</form>

<h2>Salary Details</h2>
<div id="salaryDetails">
  
</div>

</body>
</html>

<?php $conn->close(); ?>
