<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $familyId = intval($_GET['id']);

    $query = "DELETE FROM tbl_emp_family WHERE familyId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $familyId);

    if ($stmt->execute()) {
        echo "Family member deleted successfully.";
    } else {
        echo "Error deleting family member: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No family member ID provided!";
}

$conn->close();


header("Location: employee_details.php?id=" . intval($_GET['empId']));
exit;
?>
