<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST['usrnam_name'], $_POST['mail_name'], $_POST['contct_name'], $_POST['pass_name'], $_POST['cpass_name'])) {
        // Retrieve form data
        $name = $_POST['usrnam_name'];
        $email = $_POST['mail_name'];
        $number = $_POST['contct_name'];
        $pswrd = $_POST['pass_name'];
        $cpswrd = $_POST['cpass_name'];

        // Establish connection to database
        $db = mysqli_connect('localhost', 'root', '', 'online_bus');

        // Check if connection is successful
        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if passwords match
        if ($pswrd != $cpswrd) {
            die("Passwords do not match");
        }

        // Hash the password before storing
        $hashed_password = password_hash($pswrd, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query
        $query = "INSERT INTO user_details (name, email, password, cont_num) VALUES ('$name', '$email', '$hashed_password', '$number')";
        $result = mysqli_query($db, $query);

        // Check if query was successful
        if ($result) {
            // Redirect to login page upon successful registration
            header('Location: login_page.html');
            exit(); // Stop further execution
        } else {
            // Display error message if query failed
            echo "Error: " . mysqli_error($db);
        }

        // Close database connection
        mysqli_close($db);
    } else {
        // Handle missing form fields
        die("All form fields are required");
    }
} else {
    // Handle form not submitted
    die("Form not submitted");
}
?>
