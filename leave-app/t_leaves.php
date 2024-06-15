<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
           
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image:url('bg.png');
            background-size:cover;
            color:black;
            font-weight:bold;
            font-size:25px
            
        }

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid blue;
            margin-top: 20px;
            background-color: rgba(244, 244, 244, 0.5);
        }

        th, td {
            border: 1px solid blue;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: lightblue;
        }
        h1{
            text-align:center;
            background-color: rgba(244, 244, 244, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
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

// Check if roll number is provided in the URL
if(isset($_GET['tech'])) {
    // Get roll number from the URL parameter
    $teacher_name = $_GET['tech'];
   
    // Fetch marks from the marks table for the given roll number
    $sql = "SELECT * FROM leaves WHERE teacher_name= '$teacher_name'";
   $result = $conn->query($sql);
        // Bind parameters
        

                echo "<h1> All Student Leaves</h1>";
            // Check if there are any marks
            if ($result->num_rows > 0) {
                // Start table with CSS styling
                echo "<table style='border-collapse: collapse; border: 2px solid blue;'>";
                echo "<tr style='background-color: lightblue;'><th>LEAVE ID</th><th>SUBJECT</th><th>DATE</th><th>STATUS</th></tr>";
                
                // Loop through the result set and output data in table rows
                while ($row = $result->fetch_assoc()) {
                    // Fetch assignment name based on assignment ID
                    $leaveid = $row["leave_id"];
                    $subject = $row["subject"];
                    $date = $row["date"];
                    $status = $row["status"];
                    
                    
                    
                    
                    echo "<tr>";
                    echo "<td style='border: 1px solid blue;'>" . $leaveid . "</td>";
                    echo "<td style='border: 1px solid blue;'>" . $subject . "</td>";
                    echo "<td style='border: 1px solid blue;'>" . $date . "</td>";
                    if ($status == 0) {
                        echo "<td style='border: 1px solid blue;'>DECLINED</td>";  
                    } else {
                        echo "<td style='border: 1px solid blue;'>APPROVED</td>";
                    }
                    echo "</tr>";
                }
                // End table
                echo "</table>";
            } else {
                echo "No leaves found ";
            }
        

        // Close statement
       $conn->close();
        }
       
else {
    echo "Roll number not provided.";
}

// Close connection

?>
        <!-- Your PHP code for displaying the table goes here -->
    </div>
</body>
</html>
