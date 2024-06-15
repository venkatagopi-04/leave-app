<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* General styles */
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('bg.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

        /* Sidebar styles */
        .sidebar {
            width: 200px;
           
            padding: 20px;
            float: left;
        }

        .sidebar h2 {
            color: #333;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            
        }

        .sidebar ul li a:hover {
            color: #333;
        }

        /* Content styles */
        .content {
            margin-left: 220px;
            padding: 20px;
        }

        .header h1 {
            color: white;
        }

        /* Assignment styles */
    .assignment {
    border: 4px solid #ccc;
    padding: 10px;
    border-radius: 20px;
    margin-bottom: 20px;
    cursor: pointer;
    transition: box-shadow 0.3s ease;
    background-color: rgba(135, 206, 235, 0.3);
}

.assignment:hover {
    box-shadow: 0 0 50px rgba(88, 89, 166, 0.7); /* Add shadow on hover */
}


        .assignment h3 {
            color: #333;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .assignment p {
    margin: 0;
    color: black; /* Set text color inside <p> tags to black */
    font-weight: bold; /* Make text inside <p> tags bold */
}

        .assignment button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
        }

        /* Submission form styles */
        .submission-form {
            margin-top: 20px;
        }

        .submission-form h4 {
            margin-top: 0;
        }

        .submission-form input[type="file"] {
            margin-bottom: 10px;
        }

        .submission-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }
        /* Shining effect animation */
@keyframes shine {
  0% {
    background-position: -200px;
  }
  100% {
    background-position: calc(100% + 200px);
  }
}

/* Normal state styling */
a.shining {
  display: inline-block;
  padding: 10px 20px;
  background: linear-gradient(90deg, #2196F3, #64B5F6); /* Blue gradient background */
  color: #fff;
  text-decoration: none;
  border-radius: 20px;
  transition: background 0.3s ease;
  background-size: 200% auto;
  animation: shine 4s infinite linear;
}

/* Hover state styling */
a.shining:hover {
  background-position: calc(100% + 200px);
}
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style='color:white;'>Menu</h2>
        <ul>
            
            <?php
              if(isset($_GET['email'])) {
                // Get email from URL parameter
                $user_email = $_GET['email'];

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

                // Prepare SQL statement to fetch student's roll number based on email
                $sql = "SELECT * FROM students WHERE email = '$user_email'";
                $result = $conn->query($sql);

                // If result is found, display roll number
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $student_roll_number = $row['roll_number'];
                    $student_name= $row['name'];
                   
                   
                }
            }
            if (isset($student_roll_number)) {
                echo "<li><a href='s_profile.php?rnum=" . urlencode($student_roll_number) . "' class='shining'>Profile</a></li>";
            }
            echo "<br>";
            if (isset($student_roll_number)) {
                echo "<li><a href='s_leaves.php?rnum=" . urlencode($student_roll_number) . "'  class='shining'>Leavess</a></li>";
            }
            echo "<br><li><a href='login.php' class='shining'>logout</a></li>";
            echo "<br>";
           

                    // Display button to apply leave
                    echo "<a href='leave_apply_form.php?teachername=" . $row["teacher"] . "&student_rollnumber=" . $student_roll_number . "&studentname=" . $student_name . "'  class='shining'>New Leave</a>";


            ?>
            
        </ul>
    </div>
    <div class="content">
        <div class="header">
            
            <?php
            // Check if email is set
            $user_email = $_GET['email'];
            if(isset($user_email)) {
                // Get email from URL parameter
                $user_email = $_GET['email'];

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

                // Prepare SQL statement to fetch student's roll number based on email
                $sql = "SELECT * FROM students WHERE email = '$user_email'";
                $result = $conn->query($sql);

                // If result is found, display roll number
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $student_roll_number = $row['roll_number'];
                    $studentname=$row['name'];
                    echo "<p style='color:white;'>Roll Number: " . $student_roll_number . "</p>";
                } else {
                    echo "Roll number not found.";
                }
                echo "<h1>Welcome .$studentname</h1>";
                
            }else {
                echo "Email not provided.";
            }
            // Close connection
            $conn->close();
            ?>
        </div>
        <div class="leave">
            <h2>your Leaves</h2>
            <?php
            // Check if roll number is set
            if(isset($student_roll_number)) {
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
                $sql = "SELECT roll_number, year, branch FROM students WHERE email = '$user_email'";

                $result = $conn->query($sql);

                // If result is found, display roll number
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $student_roll_number = $row['roll_number'];
                    
                }

                

                // Fetch leave based on student's branch and year
                $sql = "SELECT * FROM leaves WHERE rollnumber = '$student_roll_number'  ORDER BY leave_id DESC";
                $result = $conn->query($sql);

                // Display leave
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='assignment'>";
                        echo "<p>ID: " . $row["leave_id"] . "</p><br>";
                        echo "<h3>" . $row["date"] . "</h3> <br>";
                        echo "<p >SUBJECT: " . $row["subject"] . "</p><br>";
                        echo "<p>DESCRIPTION: " . $row["description"] . "</p><br>";
                        
                        if($row["status"])
                        {
                            echo "<p> APPROVED</p><br>";
                        }
                        else{
                            echo "<p>  NOT APPROVED</p><br>";
                        }

                        
                       
                        echo "</div>";
                    }
                } else {
                    echo "No leave found.";
                }

                // Close connection
                $conn->close();
            } else {
                echo "Roll number not set.";
            }
            ?>
        </div>
    </div>

    
</body>
</html>
