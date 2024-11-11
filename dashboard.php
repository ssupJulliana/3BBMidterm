<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user']) || !isset($_SESSION['userEmail'])) {
    // If the user is not logged in, redirect them to the login page
    header('Location: index.php');
    exit();
}

// Get the user's email from the session
$userEmail = $_SESSION['userEmail'];

// Handle logout action
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy session
    header('Location: index.php'); // Redirect to the login page after logging out
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* General Dashboard Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 50px;
        }

        /* Header Section Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin-bottom: 30px; /* Add margin to create space between header and containers */
        }

        .welcome {
            font-size: 20px;
            font-weight: bold; /* Ensure the text is bold */
        }

        .logout-btn {
            background-color: #dc3545; /* Red background color */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none; /* Remove underline */
        }

        .logout-btn:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        .section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        /* Box for each section (like login box) */
        .container-box {
            background-color: #fff; /* White background for the content */
            width: 100%;
            max-width: 570px; /* Wider container for a more rectangular look */
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Stronger shadow for emphasis */
            border-radius: 15px; /* More rounded corners */
            text-align: center;
            position: relative;
            margin-bottom: 30px; /* Space between the boxes */
            padding-top: 60px; /* Add space from the header */
        }

        /* Header Style for the section */
        .section-header {
            font-size: 24px;
            color: #000;
            text-align: left;
            margin: 0;
            padding: 10px 20px;
            background-color: #DDDEDF; /* Light gray background */
            border-radius: 15px 15px 0 0; /* More rounded corners for the header */
            width: 100%;
            box-sizing: border-box;
            position: absolute;
            top: 0;
            left: 0;
        }

        .container-box h3 {
            margin-bottom: 15px;
            color: #007bff;
        }

        /* Justify the paragraph text */
        .container-box p {
            font-size: 16px;
            color: #555;
            margin-top: 30px; /* Add space between the paragraph and the button */
            text-align: justify; /* Justify the text */
        }

        /* Button Styling */
        .button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Make button take up the full width of its container */
            min-width: 200px; /* Ensure buttons are at least this wide */
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Adjust container width for responsiveness */
        @media (max-width: 768px) {
            .section {
                flex-direction: column;
            }
            .container-box {
                width: 100%;
            }
        }

        /* Additional space for containers */
        .section {
            margin-top: 50px; /* Add space between header and containers */
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <!-- Welcome Message -->
            <div class="welcome">
                Welcome to the system: <?php echo htmlspecialchars($userEmail); ?>
            </div>
            <!-- Logout Button -->
            <div>
                <a href="?logout=true" class="logout-btn">Logout</a>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="section">
            <!-- Add a Subject Section -->
            <div class="container-box">
                <!-- Section Header -->
                <div class="section-header">Add a Subject</div>
                <!-- Content inside the gray box -->
                <div class="content">
                    <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                    <button class="button" onclick="window.location.href='add_subject.php'">Add Subject</button>
                </div>
            </div>

            <!-- Register a Student Section -->
            <div class="container-box">
                <!-- Section Header -->
                <div class="section-header">Register a Student</div>
                <!-- Content inside the gray box -->
                <div class="content">
                    <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                    <button class="button" onclick="window.location.href='register_student.php'">Register Student</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/jquery-migrate-3.5.0.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>