<?php
session_start();
// Include the database connection file
include('../includes/connect.php');
include_once('../functions/common_function.php');

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch the current spin count
    $fetch_spin_count_query = "SELECT spins_remaining FROM dummy_record WHERE username = '$username'";
    $fetch_spin_count_result = mysqli_query($con, $fetch_spin_count_query);

    if ($fetch_spin_count_result) {
        if (mysqli_num_rows($fetch_spin_count_result) > 0) {
            $spin_count_row = mysqli_fetch_assoc($fetch_spin_count_result);
            $spin_count = $spin_count_row['spins_remaining'];

            // Check if the spin count is greater than 0
            if ($spin_count > 0) {
                // Decrement the spin count by 1
                $new_spin_count = $spin_count - 1;

                // Update the spin count in the database
                $update_spin_count_query = "UPDATE dummy_record SET spins_remaining = $new_spin_count WHERE username = '$username'";
                $update_spin_count_result = mysqli_query($con, $update_spin_count_query);

                if (!$update_spin_count_result) {
                    // Handle database update error
                    echo "Error updating spin count: " . mysqli_error($con);
                    exit;
                }
            } else {
                // Handle case where spin count is already 0
                echo "<script>alert('Sorry you have spins left')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
                exit;
            }
        } else {
            // Handle case where spins_remaining is not found for the user
            echo "Error: Spin count not found for user.";
            exit;
        }
    } else {
        // Handle case where spin count query fails
        echo "Error fetching spin count: " . mysqli_error($con);
        exit;
    }
} else {
    // Handle case where user is not logged in
    echo "Please log in to spin.";
    exit;
}

// Generate unique code for claiming the prize
$unique_code = generateUniqueCode();

// Insert the generated code into the discount_codes table
$insert_code_query = "INSERT INTO discount_codes (username, code) VALUES ('$username', '$unique_code')";
$insert_code_result = mysqli_query($con, $insert_code_query);

if (!$insert_code_result) {
    // Handle database insert error
    echo "Error inserting code: " . mysqli_error($con);
    exit;
}

// Redirect or display a success message to the user
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spin to Win Wheel</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
</head>
<body>
<header>
        <div class="header-container">
            <div class="home-btn">
                <a href="../index.php"><img src="../pictures/home-icon.png" alt="Home"></a>
            </div>
            <div class="spin-count">
    <span>Spin Count: <span id="spinCount"><?php echo $spin_count; ?></span></span>
</div>
        </div>
    </header>
    <div id="mainbox" class="mainbox">
        <div id="result" class="result-container result-bottom"></div>
        <div id="box" class="box">
            <div class="box1">
                <span class="span1"><b>Segment1</b></span>
                <span class="span2"><b>Segment2</b></span>
                <span class="span3"><b>Segment3</b></span>
                <span class="span4"><b>Segment4</b></span>
            </div>
            <div class="box2">
                <span class="span1"><b>Segment5</b></span>
                <span class="span2"><b>Segment6</b></span>
                <span class="span3"><b>Segment7</b></span>
                <span class="span4"><b>Segment8</b></span>
            </div>
        </div>
        <button id="claimButton" class="claim-button" style="display: none;" onclick="claimFreeShipping()">Claim Prize</button>
        <button class="spin" onclick="spinWheel()">SPIN</button>
    </div>

    <script>
        function spinWheel() {
            const spinBtn = document.querySelector('.mainbox .spin');
            spinBtn.style.pointerEvents = 'none';
            var wheel = document.getElementById('box');
            var deg = Math.floor(5000 + Math.random() * 5000);
            wheel.style.transition = 'all 3s ease-out';
            wheel.style.transform = `rotate(${deg}deg)`;
            wheel.classList.add('blur');
        }

        const wheel = document.querySelector('.mainbox .box');
        const claimBtn = document.getElementById('claimButton');
        let deg = 0;

        wheel.addEventListener('transitionend', () => {
            wheel.classList.remove('blur');
            const winningSegment = Math.floor((deg % 360) / 45) + 1;

            // Generate a random number between 1 and 10
            const randomNum = Math.floor(Math.random() * 10) + 1;

            // Adjust the winning chance
            if (randomNum <= 3) { // 30% chance of winning
                if (winningSegment === 1 || winningSegment === 8) {
                    claimBtn.style.display = 'block';
                    alert('Congratulations! You won 10PHP Discount. Click "Claim Prize" to get your reward!');
                    return; // Stop further execution to prevent page reload
                } else {
                    claimBtn.style.display = 'none';
                    alert('Better luck next time!');
                }
            } else { // 70% chance of losing
                claimBtn.style.display = 'none';
                alert('Better luck next time!');
            }

            // Refresh the page after 3 seconds
            setTimeout(() => {
                location.reload();
            }, 1000);
        });

        function claimFreeShipping() {
    const uniqueCode = generateUniqueCode();
    // Send the unique code to PHP via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_code.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Show congratulatory message with the unique code
            alert(`Congratulations! You win a discount. Here is your voucher code: ${uniqueCode}`);
            // Reload the page or perform any other actions
            location.reload();
        } else {
            alert('Error saving unique code');
        }
    };
    xhr.send('unique_code=' + encodeURIComponent(uniqueCode));
}

    function generateUniqueCode() {
        return Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
    }

    </script>
</body>
</html>
