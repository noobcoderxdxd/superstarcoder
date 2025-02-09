<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Submit Code</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #959EC9, #E8EAE7); /* Gradient from purple to red */
    backdrop-filter: blur(100px); /* Apply blur effect */
    overflow-x: hidden;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.code-entry-section {
    background-color: rgba(255, 255, 255, 0.8); /* Light purple with opacity */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    max-width: 400px;
    width: 100%;
}

h4 {
    margin-bottom: 20px;
    color: #2a1546; /* Dark purple text color */
}

#codeInput {
    width: calc(100% - 40px);
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#submitBtn {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#submitBtn:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <!-- Add a section for entering the code -->
    <div class="code-entry-section">
        <h4>Enter Your Code</h4>
        <form id="codeForm" method="post">
            <input type="text" id="codeInput" name="user_code" placeholder="Enter your unique code" autocomplete="off">
            <button type="submit" id="submitBtn" name="submit_code">Submit</button>
        </form>
    </div>
</body>
</html>
<?php
// Include the database connection file
include('../includes/connect.php');
include_once('../functions/common_function.php');


if (isset($_POST['submit_code'])) {
    if (isset($_SESSION['username'])) {
        $user_code = mysqli_real_escape_string($con, $_POST['user_code']);
        $username = $_SESSION['username'];

        $validation_result = validateCode($user_code, $username);

        if ($validation_result === true) {
            // Redirect to the game page
            $game_id = $_GET['game_id'];
            header("Location: ../game_area/spintowin.php?game_id=$game_id&code=" . urlencode($user_code));
            exit();
        } else {
            echo "<script>alert('$validation_result')</script>";
        }
    } else {
        echo "<script>alert('Please log in to submit a code.')</script>";
    }
}
?>

<!-- Your HTML for the code entry form goes here -->



