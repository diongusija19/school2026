<?php
require "db.php";

$query = "
SELECT students.name AS student, courses.title AS course
FROM enrollments
JOIN students ON enrollments.student_id = students.student_id
JOIN courses ON enrollments.course_id = courses.course_id
ORDER BY students.name
";

$result = $con->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Enrollments</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<h1>Student Enrollments</h1>

<table>
    <tr>
        <th>Student</th>
        <th>Course</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['student']) ?></td>
        <td><?= htmlspecialchars($row['course']) ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="enroll.php" class="button">Enroll Student</a>

</body>
</html>