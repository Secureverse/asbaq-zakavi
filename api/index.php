<?php
ob_start();
session_start();
?>
<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjuman e Zakavi - Rajkot</title>
    <link rel="stylesheet" href="styles.css">
</head>
<div id="menuContainer"></div>
<!-- <script src="menu.js"></script> -->
<body>
    <div class="container">
        <h1>Anjuman e Zakavi - Rajkot</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="userId">Enter your ITS ID:</label>
            <input type="number" id="userId" name="userId" required> <br>
            <button type="submit" name="submit">Submit</button>
            
            <!-- Error message container -->
            <div id="errorMessage"></div>
        </form>
    </div>
    
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        include('db_connection.php');
        // Get user ID from the form
        $userId = $_POST['userId'];

        // SQL query to check if the user ID exists in the database
        $sql = "SELECT * FROM users WHERE user_id = '$userId'";
        $result = $conn->query($sql);

        // If the user ID is valid, set the session variable and redirect to the next page
        if ($result->num_rows > 0) {
            $_SESSION['userId'] = $userId;
            header("Location: next_page.php");
            exit();
        } 
        else {
            // If the user ID is not valid, display the error message
            echo "<script>
                    var errorMessage = document.getElementById('errorMessage');
                    errorMessage.innerHTML = 'Invalid ITS ID. Please enter registered ITS ID.';
                    errorMessage.style.display = 'block';
                </script>";
        }

        $conn->close();
    }
}
?>
