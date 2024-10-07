<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    
    $query = "SELECT * FROM tbl_emp_family WHERE familyId = $id";
    $result = mysqli_query($conn, $query);
    $family_member = mysqli_fetch_assoc($result);
    
    if (!$family_member) {
        echo "Family member not found.";
        exit;
    }
} else {
    echo "No family member ID provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Member</title>
</head>
<body>
    <h1>Edit Family Member</h1>
    <form action="update_family.php" method="post">
        <input type="hidden" name="familyId" value="<?php echo $family_member['familyId']; ?>">
        <input type="hidden" name="empId" value="<?php echo $family_member['empId']; ?>">
        <label>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($family_member['name']); ?>" required></label>
        <label>Relation: <input type="text" name="relation" value="<?php echo htmlspecialchars($family_member['relation']); ?>" required></label>
        <label>Occupation: <input type="text" name="occupation" value="<?php echo htmlspecialchars($family_member['occupation']); ?>"></label>
        <label>Contact: <input type="text" name="contact" value="<?php echo htmlspecialchars($family_member['contact']); ?>" required></label>
        <input type="submit" value="Update Family Member">
    </form>
</body>
</html>

<?php $conn->close(); ?>
