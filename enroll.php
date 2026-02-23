<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];

    $stmt = $con->prepare(
        "INSERT IGNORE INTO enrollments (student_id, course_id) VALUES (?, ?)"
    );
    $stmt->bind_param("ii", $student_id, $course_id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$students = $con->query("SELECT * FROM students");
$courses = $con->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll Student</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<h1>Enroll Student in Course</h1>

<form method="post">
    <label>Student:</label>
    <select name="student_id">
        <?php while ($s = $students->fetch_assoc()): ?>
            <option value="<?= $s['student_id'] ?>">
                <?= htmlspecialchars($s['name']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Course:</label>
    <select name="course_id">
        <?php while ($c = $courses->fetch_assoc()): ?>
            <option value="<?= $c['course_id'] ?>">
                <?= htmlspecialchars($c['title']) ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Enroll</button>
</form>

<a href="index.php">Back</a>

</body>
</html>