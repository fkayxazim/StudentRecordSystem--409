<?php
// Start session
session_start();

// Array to store validation errors
$errmsg_arr = array();

// Validation error flag
$errflag = false;

// Connect to mysql server
$link = new mysqli('localhost', 'root', '', 'model');
if ($link->connect_error) {
    die('Failed to connect to server: ' . $link->connect_error);
}

// Function to sanitize values received from the form. Prevents SQL injection
function clean($str, $link)
{
    $str = trim($str);
    return $link->real_escape_string($str);
}

// Check if username and password are set
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize the POST values
    $login = clean($_POST['username'], $link);
    $password = clean($_POST['password'], $link);

    // Input Validations
    if ($login == '') {
        $errmsg_arr[] = 'Username missing';
        $errflag = true;
    }
    if ($password == '') {
        $errmsg_arr[] = 'Password missing';
        $errflag = true;
    }

    // If there are input validations, redirect back to the login form
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: index.php");
        exit();
    }

    // Create query
    $qry = "SELECT * FROM user WHERE username='$login' AND password='$password'";
    $result = $link->query($qry);

    // Check whether the query was successful or not
    if ($result) {
        if ($result->num_rows > 0) {
            // Login Successful
            session_regenerate_id();
            $member = $result->fetch_assoc();
            $_SESSION['SESS_MEMBER_ID'] = $member['id'];
            $_SESSION['SESS_FIRST_NAME'] = $member['name'];
            $_SESSION['SESS_LAST_NAME'] = $member['position'];
            session_write_close();
            header("location: main/index.php");
            exit();
        } else {
            // Login failed
            header("location: index.php");
            exit();
        }
    } else {
        die("Query failed: " . $link->error);
    }
} else {
    // Redirect to login form if username or password not set
    header("location: index.php");
    exit();
}
?>
