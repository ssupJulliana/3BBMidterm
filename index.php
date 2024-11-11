<?php
// Start the session
session_start();

// Include the functions file that contains user data and the validation function
include('functions.php');

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Redirect to the dashboard page if already logged in
    header('Location: dashboard.php');
    exit();
}

// Initialize error message variables
$errorMessages = [];

// Initialize email and password variables (ensure they're always defined)
$email = '';
$password = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? ''; // Get email input
    $password = $_POST['password'] ?? ''; // Get password input

    // Check if the email and password fields are empty
    if (empty($email)) {
        $errorMessages[] = 'Email is Required';
    }
    if (empty($password)) {
        $errorMessages[] = 'Password is Required';
    }

    // If both fields are filled, check the credentials
    if (empty($errorMessages)) {
        $userValidationResult = checkUserCredentials($email, $password);
        
        if (is_array($userValidationResult)) {
            // If valid user found, store user in session and redirect to dashboard
            $_SESSION['user'] = $userValidationResult['name'];
            $_SESSION['userEmail'] = $userValidationResult['email']; // Store email in session
            header('Location: dashboard.php'); // Redirect to a protected dashboard page
            exit();
        } else {
            // If validation fails, add error message to the array
            $errorMessages[] = $userValidationResult;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* General Styles for the Page */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login Box Container */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* The Login Box */
        .login-box {
            background-color: #fff;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            position: relative;
            height: auto;
            padding-top: 70px;
        }

        /* Header Style for the Login title */
        .login-box header {
            font-size: 24px;
            color: #000;
            text-align: left;
            margin: 0;
            padding: 10px 20px;
            background-color: #DDDEDF;
            border-radius: 8px 8px 0 0;
            width: 100%;
        }

        /* Form Elements */
        label {
            font-size: 14px;
            color: #000;
            display: block;
            margin-bottom: 5px;
            text-align: left;
            padding-left: 20px;
        }

        /* Textboxes (Email & Password) */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 15px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
            padding-left: 20px;
        }

        /* Login Button */
        button {
            width: 100%;
            padding: 14px;
            border-radius: 4px;
            border: none;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            box-sizing: border-box;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-bottom: 20px;
            width: 100%;
            max-width: 450px;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        /* Responsive Design */
        @media (max-width: 500px) {
            .login-box {
                padding: 30px;
                padding-top: 60px;
            }
            .login-box header {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <?php if (!empty($errorMessages)): ?>
            <div class="alert alert-danger" role="alert">
                <strong>System Errors</strong><br>
                <ul>
                    <?php foreach ($errorMessages as $message): ?>
                        <li><?php echo $message; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="login-box">
            <header>Login</header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="email">Email Address</label> 
                <input type="email" id="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>
</html>