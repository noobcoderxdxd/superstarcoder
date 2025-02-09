<?php
// Database connection parameters
$hostname = "localhost";
$dbname = "chief store";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    // Set PDO attributes here if needed
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error reporting
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Terminate script if connection fails
}

// Check if the connection is successful
if ($pdo) {
    // Function to generate a unique code
    function generateUniqueCodeForGame($length = 8) {
        global $pdo; // Access the $pdo variable from the global scope

        // Characters to be used in the code
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        // Generate a random code
        $code = '';
        $maxAttempts = 10; // Maximum attempts to generate a unique code
        $attempt = 0;
        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
            // Check if the generated code already exists in the database
            $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM generated_codes WHERE code = ?");
            $stmt->execute([$code]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $codeExists = $row['count'] > 0;
            $attempt++;
        } while ($codeExists && $attempt < $maxAttempts);

        // If maximum attempts reached, return false
        if ($attempt >= $maxAttempts) {
            return false;
        }

        return $code;
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Code generation logic
        $generatedCode = generateUniqueCodeForGame();
        if ($generatedCode !== false) {
            $expirationDate = date('Y-m-d H:i:s', strtotime('+1 day'));

            // Insert the code and expiration date into the database
            $stmt = $pdo->prepare("INSERT INTO generated_codes (code, expiration_date) VALUES (?, ?)");
            $stmt->execute([$generatedCode, $expirationDate]);

            // Display the generated code
            $displayCode = $generatedCode;

            // Notification message
            $notification = "Code inserted successfully!";
        } else {
            // Failed to generate a unique code
            $notification = "Failed to generate a unique code. Please try again.";
        }
    } else {
        // Initialize the display code and notification variables
        $displayCode = "";
        $notification = "";
    }

    // Display the notification message
    if (!empty($notification)) {
        echo "<p>$notification</p>";
    }

    // Form to generate code
    ?>
    <!-- Display the generated code -->
    <input type="text" value="<?php echo $displayCode; ?>" readonly>

    <!-- Generate Code button -->
    <form method="post">
        <button type="submit">Generate Code</button>
    </form>
    <?php
} else {
    echo "Failed to connect to the database.";
}
?>
