<?php
    session_start();
    
    $student_id = filter_input(INPUT_POST, 'studentID', FILTER_VALIDATE_INT);
    $course_id = filter_input(INPUT_POST, 'courseID', FILTER_VALIDATE_INT);

    require_once('db.php');
    
    // Add Enrollment

    $query = 'INSERT INTO enrollments (studentID, courseID) 
        VALUES (:studentID, :courseID)';

    $statement = $pdo->prepare($query);
    $statement->bindValue(':studentID', $student_id);
    $statement->bindValue(':courseID', $course_id);
    $statement->execute();
    $statement->closeCursor();

    $sql = "
    SELECT studentID, firstName, lastName
    FROM students
    WHERE studentID = :studentID
    ";    

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':studentID', $student_id);
    $stmt->execute();    
    
    $student = $stmt->fetch();
    
    $stmt->closeCursor();

    $sql = "
    SELECT courseID, title, code
    FROM courses
    WHERE courseID = :courseID
    ";    

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':courseID', $course_id);
    $stmt->execute();    
    
    $course = $stmt->fetch();
    
    $stmt->closeCursor();

    $_SESSION["studentName"] = $student['firstName'] . " " . $student['lastName'];
    $_SESSION["courseName"] = $course['code'] . " - " . $course['title'];
    $url = "enroll_confirmation.php";
    header("Location: " . $url);
    die();

?>