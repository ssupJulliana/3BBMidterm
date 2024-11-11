<?php
// Define users as an associative array with unique passwords
$users = [
    ['name' => 'Julliana Castaneda', 'email' => 'julliana@gmail.com', 'password' => 'juli@123'],
    ['name' => 'Alejandro Faustino', 'email' => 'alejandro@gmail.com', 'password' => 'alejandro@123'],
    ['name' => 'Robbie Lenon', 'email' => 'robbie@gmail.com', 'password' => 'robbie@123'],
    ['name' => 'Reagan Pinpin', 'email' => 'reagan@gmail.com', 'password' => 'reagan@123'],
    ['name' => 'Harlanz Lallari', 'email' => 'harlanz@gmail.com', 'password' => 'harlanz@123']
];

// Function to validate user credentials
function checkUserCredentials($email, $password) {
    global $users;  // Access the $users array from the global scope
    
    // Loop through users to find a match for email and password
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            if ($user['password'] === $password) {
                return $user;  // Return the user data if credentials match
            } else {
                return 'Invalid password';  // Return error message for incorrect password
            }
        }
    }
    
    return 'Invalid email';  // Return error message if email is not found
}
?>
