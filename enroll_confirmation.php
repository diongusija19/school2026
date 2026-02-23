<?php
    session_start();   
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Student Enrollments - Add Enrollment Confirmation</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
    </head>

    <body>        

        <main>
            <h2>Add Enrollment Confirmation</h2>
            <p>
                Thank you for enrolling <?php echo $_SESSION["studentName"]; ?> in 
                <?php echo $_SESSION["courseName"]; ?>.
            </p>
            <p>
                I am sure the student is looking forward to the course.
            </p>                        

            <p><a class="button"href="index.php">Back to Home</a></p>

        </main>         

    </body>
</html>