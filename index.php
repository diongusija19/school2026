<?php
    require "db.php";

    $sql = "
    SELECT s.firstName, s.lastName, c.title, c.code
    FROM enrollments e
    JOIN students s ON e.studentID = s.studentID
    JOIN courses c ON e.courseID = c.courseID
    ORDER BY s.lastName, s.firstName
    ";    

    $stmt = $pdo->prepare($sql);
    $stmt->execute();    
    
    $enrollments = $stmt->fetchAll();
    
    $stmt->closeCursor();

    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Enrollments - Home</title>
        <link rel="stylesheet" href="styles/styles.css" />
    </head>
    <body>
        <h1>Student Enrollments</h1>

        <table>
            <tr>
                <th>Student</th>
                <th>Course</th>
                <th>Code</th>
            </tr>

            <?php foreach ($enrollments as $enrollment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($enrollment['firstName'] . " " . $enrollment['lastName']) ?>
                    <td><?php echo htmlspecialchars($enrollment['title']) ?>
                    <td><?php echo htmlspecialchars($enrollment['code']) ?>
                </tr>
            <?php endforeach; ?>

        </table>

        <a class="button" href="enroll_form.php">Enroll a Student</a>

    </body>
</html>