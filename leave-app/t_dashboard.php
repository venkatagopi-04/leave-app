<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teacher Dashboard</title>
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
            color: #333;
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

#approve{
    color:blue;
    display: inline-block;
  padding: 10px 20px;
  background: linear-gradient(90deg, #2196F3, #64B5F6); /* Blue gradient background */
  color: #fff;
  text-decoration: none;
  border-radius: 15px;
  transition: background 0.3s ease;
  background-size: 200% auto;
  animation: shine 4s infinite linear;
}
#approve:hover {
  background-position: calc(100% + 200px);
}


#decline{
    color:blue;
    display: inline-block;
  padding: 10px 20px;
  background: linear-gradient(90deg, #FF6347, #FF4500); /* Blue gradient background */
  color: #fff;
  text-decoration: none;
  border-radius: 15px;
  transition: background 0.3s ease;
  background-size: 200% auto;
  animation: shine 4s infinite linear;
}
#decline:hover {
  background-position: calc(100% + 200px);
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
        }

        .assignment button {
          
           
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
                $sql = "SELECT name FROM teachers WHERE email = '$user_email'";
                $result = $conn->query($sql);

                // If result is found, display roll number
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $tname = $row['name'];
                    
                   
                }
            }
           
           
                echo "<li><a href='t_profile.php?email=" . urlencode($user_email) . "' class='shining'>Profile</a></li>";

            
            
            echo "<br>";

            
                echo "<li><a href='t_leaves.php?tech=" . urlencode($tname) . "'  class='shining'>Student Leaves</a></li>";
            
            echo "<br><li><a href='login.php' class='shining'>logout</a></li>";
            

            ?>
            
        </ul>
    </div>
    <div class="content">
        <div class="header">
            
            <?php
            // Check if email is set
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

                $sql = "SELECT name FROM teachers WHERE email = '$user_email'";
                $result = $conn->query($sql);

                // If result is found, display roll number
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                   
                    $teacher_name= $row['name'];
                    
                   
                }
                echo "<h1 style='color:white;'>WELCOME $teacher_name</h1>";
       

                // Close connection
                $conn->close();
            } else {
                echo "Email not provided.";
            }
            ?>
        </div>
        <div class="leave">
            <h2> All Requests</h2>
            <?php
            // Check if roll number is set
            if(isset($_GET['email'])) {
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
               

                $sql = "SELECT name FROM teachers WHERE email = '$user_email'";
                $result = $conn->query($sql);

                // If result is found, display roll number
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                   
                    $teacher_name= $row['name'];
                    
                   
                }

                // Fetch leave based on student's branch and year
                $sql = "SELECT * FROM leaves WHERE teacher_name = '$teacher_name'  ORDER BY leave_id DESC";
                $result = $conn->query($sql);

                // Display leave
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='assignment'>";
                        echo "<h3>" . $row["student_name"] . "</h3>";
                        echo "<p>Roll Number: " . $row["rollnumber"] . "</p>";
                        echo "<p>Subject: " . $row["subject"] . "</p>";
                        echo "<p>Description: " . $row["description"] . "</p>";
                        echo "<p>Date: " . $row["date"] . "</p>";
                        // Adding approve and decline buttons
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='leave_id' value='" . $row["leave_id"] . "'>";
                        echo "<button type='submit'  id='approve' name='approve'>Approve</button>";
                        echo "<button type='submit' id='decline' name='decline'>Decline</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "No leaves found.";
                }

                if (isset($_POST['approve'])) {
                    $leave_id = $_POST['leave_id'];
                    // Update status to 1 (approved)
                    $sql = "UPDATE leaves SET status = 1 WHERE leave_id = $leave_id";
                    if ($conn->query($sql) === TRUE) {
                        echo "Leave request approved successfully.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } elseif (isset($_POST['decline'])) {
                    // No action needed for decline
                    echo "Leave request declined.";
                }
                

                // Close connection
                $conn->close();
            } else {
                echo "email not set.";
            }
            ?>
        </div>
    </div>

    
</body>
</html>
