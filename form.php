<!-- Php & mysql database tutorials
https://www.tutorialrepublic.com/php-tutorial/php-mysql-create-table.php -->
<!DOCTYPE html>
<html lang="en">
<?php
// include 'db_connection.php';
// $conn = OpenCon("localhost", "root", "", "shoppinglist_dbs");
$link = mysqli_connect("localhost", "root", "", "shoppinglist_db");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$shoppinglist_table =
    "CREATE TABLE IF NOT EXISTS shoppinglist_table(
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    task_data VARCHAR(255) NOT NULL
)";

if (mysqli_query($link, $shoppinglist_table)) {
    echo "<p>Success_table</p>";
} else {
    echo mysqli_error($link);
}

if (isset($_POST['item'])) {
    $shoppinglist_item = 
    "INSERT INTO shoppinglist_table (task_id, task_data) VALUES (2, 'oof')";
    if (mysqli_query($link, $shoppinglist_item)) {
        echo "<p>Success_item</p>";
    } else {
        echo mysqli_error($link);
    }
}

// CloseCon($conn);
mysqli_close($link);

$message = "";
if (isset($_POST['submitButton'])) { //check if form was submitted
    $input = $_POST['item']; //get input text
    $message = "Success! You entered: " . $input;
}
?>

<head>
    <meta charset="UTF-8">
    <title>PHP-Test</title>
</head>

<body>
    <h1>Shop list - Form</h1>
    <form action="" method="POST">
        <?php echo $message; ?>
        <p>
            <label for="inputItem">Text: </label>
            <input type="text" name="item" id="inputItem">
        </p>
        <input type="submit" value="Submit" name="submitButton">
        <input type="reset" value="Reset" name="resetButton">
    </form>
</body>


</html>