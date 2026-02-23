<?php
    require "db.php";

    $sql = "
    SELECT studentID, firstName, lastName
    FROM students
    ORDER BY lastName, firstName
    ";    

    $stmt = $pdo->prepare($sql);
    $stmt->execute();    
    
    $students = $stmt->fetchAll();
    
    $stmt->closeCursor();

    $sql = "
    SELECT courseID, title, code
    FROM courses
    ORDER BY code, title
    ";    

    $stmt = $pdo->prepare($sql);
    $stmt->execute();    
    
    $courses = $stmt->fetchAll();
    
    $stmt->closeCursor();

    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Enrollments - Enroll Student in Course</title>
        <link rel="stylesheet" href="styles/styles.css" />
    </head>
    <body>
        <h1>Enroll Student In Course</h1>

        <form action="enroll.php" method="post" id="enroll_form" enctype="multipart/form-data">

            <label>Student</label>
            <select name="studentID" required>
                <?php foreach ($students as $student): ?>
                    <option value="<?php echo $student['studentID'];?>">
                        <?php echo htmlspecialchars($student['firstName'] . " " . $student['lastName']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label>Course</label>
            <select name="courseID" required>
                <?php foreach ($courses as $course): ?>
                    <option value="<?php echo $course['courseID'];?>">
                        <?php echo htmlspecialchars($course['code'] . " - " . $course['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Enroll</button>

        </form>

        <a class="button" href="index.php">Back to Enrollment List</a>

    </body>
</html>