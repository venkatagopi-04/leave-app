<?php
// Database connection parameters
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "leave_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to avoid notices
$rollnumber = $student_name = $teacher_name = $subject = $description = $date = "";
$subject_err = $description_err = $date_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate subject
    if (empty(trim($_POST["subject"]))) {
        $subject_err = "Please enter the subject.";
    } else {
        $subject = trim($_POST["subject"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter the description.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Validate date
    if (empty(trim($_POST["date"]))) {
        $date_err = "Please enter the date.";
    } else {
        $date = trim($_POST["date"]);
    }

    // If no errors, insert data into database
    if (empty($subject_err) && empty($description_err) && empty($date_err)) {
        // Prepare SQL statement to insert leave into database
        $sql = "INSERT INTO leaves (rollnumber, student_name, teacher_name, subject, description, date, status) 
                VALUES (?, ?, ?, ?, ?, ?, 0)";
        
        // Check if the statement can be prepared
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $_GET['student_rollnumber'], $_GET['studentname'], $_GET['teachername'], $subject, $description, $date);
            $student_rollnumber=$_GET['student_rollnumber'];
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to the student dashboard
                $sql = "SELECT email FROM students WHERE roll_number = '$student_rollnumber'";
                        $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $student_mail = $row['email'];
                    // Redirecting to the student dashboard with email parameter
                    header("Location: s_dashboard.php?email=$student_mail");
                    exit();
                } else {
                    echo "Student email not found.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Post Leave</title>
<style>
    /* Your CSS styles here */
    .container {
        max-width: 550px;
        margin-top: 175px;
        margin-left:450px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }
    .form-group input[type="text"],
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .form-group textarea {
        resize: vertical;
    }
    .form-group .error {
        color: #ff0000;
        font-size: 14px;
    }
    .form-group input[type="date"] {
        margin-top: 5px;
    }
    .form-group input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 12px 20px;
        cursor: pointer;
    }
    .form-group input[type="submit"]:hover {
        background-color: #45a049;
    }
    body{
        background-image:url('formbg.png');
            background-size:cover;
    }
</style>
</head>
<body>
<div class="container">
    <h2> Post Leave</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?student_rollnumber=' . urlencode($_GET['student_rollnumber']) . '&studentname=' . urlencode($_GET['studentname']) . '&teachername=' . urlencode($_GET['teachername']); ?>" method="post">
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>">
            <span class="error"><?php echo $subject_err; ?></span>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
            <span class="error"><?php echo $description_err; ?></span>
        </div>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
            <span class="error"><?php echo $date_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Post Leave">
        </div>
    </form>
</div>
</body>
</html>
