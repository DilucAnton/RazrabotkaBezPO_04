<?php
if (isset($_GET['Submit'])) {
    // Get input
    $id = $_GET['id'];

    try {
        // Establish database connection using PDO
        $pdo = new PDO('mysql:host=localhost;dbname=security_db', 'user', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute statement
        $stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_id = 
:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch results
        if ($stmt->rowCount() > 0) {
            echo '<pre>User ID exists in the database.</pre>';
        } else {
            http_response_code(404);
            echo '<pre>User ID is MISSING from the database.</pre>';
        }
    } catch (PDOException $e) {
        echo 'Database error: ' . htmlspecialchars($e->getMessage());
    }
}
?>

