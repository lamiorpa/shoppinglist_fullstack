<!-- Php & mysql database tutorials
https://www.tutorialrepublic.com/php-tutorial/php-mysql-create-table.php -->

<!-- 
    Short html, php + sql program which inserts user inputs into sql database through php using html front and displays database contents in the page 
    1. Establish sql database connection using php
    2. Create new table if none is found
    3. Check if user has made any inputs through form in previous page. If inputs found, insert inputs into database. If not, pass
    4. Load table contents from database and display them into html webpage
    5. After the page refresh (form submitted, F5 pressed, new user arrives to page) continue from 1. 
-->
<!DOCTYPE html>
<html lang="en">
<?php
//include 'db_connection.php';

// Initial connection
// --------------------------------------------------

//$link = OpenCon("localhost", "root", "", "shoppinglist_dsb");
$link = mysqli_connect("localhost", "root", "", "shoppinglist_db");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// --------------------------------------------------

$sl_insert_table =
    "CREATE TABLE IF NOT EXISTS shoppinglist_table(
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    task_data VARCHAR(255) NOT NULL
)";

if (!mysqli_query($link, $sl_insert_table)) {
    echo "ERROR: Could not create table: $sl_insert_table." . mysqli_error($link);
}

// Prepeared insert statement for form item text
// Prepared statements: https://www.tutorialrepublic.com/php-tutorial/php-mysql-prepared-statements.php
if (isset($_POST['item'])) {
    if ($_POST['item'] !== "") {
        $sl_insert_item =
            "INSERT INTO shoppinglist_table (task_data) VALUES (?)";

        // Bind parameters: ($stmt, $types, &$var1, &...$_)
        // b — binary (such as image, PDF file, etc.)
        // d — double (floating point number)
        // i — integer (whole number)
        // s — string (text)
        if ($stmt = mysqli_prepare($link, $sl_insert_item)) {

            $task_data = mysqli_real_escape_string($link, $_POST['item']); // escaping not necessary in prepared statement but a good habit against SQL injections
            mysqli_stmt_bind_param($stmt, "s", $task_data,);

            if (mysqli_stmt_execute($stmt)) {
                //echo "Records inserted successfully";
            } else {
                echo "ERROR: Could not execute query: $sl_insert_item. " . mysqli_error($link);
            }
        } else {
            echo "ERROR: Could not prepare query: $sl_insert_item. " . mysqli_error($link);
        }
    }
}

//CloseCon($link);
mysqli_close($link);

$message = "";
if (isset($_POST['submitButton'])) { //check if form was submitted
    if ($_POST['item'] !== "") { //check if form input had something in it
        $input = $_POST['item'];
        $message = "Success! You entered: " . $input;
    } else {
        $message = "Please enter shoppinglist item";
    }
}

/**
 * Helper function for displaying shoppinglist in a table
 */
function show_shoppinglist_items_table($link)
{
    $sl_select_items = "SELECT * FROM shoppinglist_table";
    if ($items = mysqli_query($link, $sl_select_items)) {
        echo "<div class='container_items'>";
        if (mysqli_num_rows($items) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Task</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($items)) {
                echo "<tr>";
                echo "<td>" . $row['task_id'] . "</td>";
                echo "<td>" . $row['task_data'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($items);
        } else {
            echo "No items in the shopping list";
        }
        echo "</div>";
    }
}

/**
 * Helper function for displaying shoppinglist in a list
 */
function show_shoppinglist_items_list($link)
{
    $sl_select_items = "SELECT * FROM shoppinglist_table";
    if ($items = mysqli_query($link, $sl_select_items)) {
        echo "<div class='container_items'>";
        if (mysqli_num_rows($items) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_array($items)) {
                echo "<li>";
                echo $row['task_id'] . " " . $row['task_data'];
                echo "</li>";
            }
            echo "</ul>";
        }
        echo "</div>";
    }
}

?>



<head>
    <meta charset="UTF-8">
    <title>HTML, PHP + Sql-Test</title>
    <meta charset="UTF-8">
    <meta name="description" content="HTML, PHP + SQL -shoppinglist exercise">
    <meta name="keywords" content="HTML, PHP, SQL">
    <meta name="author" content="Lari">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="form.css">
</head>

<body>
    <div class="content">
        <h1>Shopping list - Form</h1>
        <form action="" method="POST">
            <?php echo $message; ?>
            <p>
                <label for="inputItem">Text: </label>
                <input type="text" name="item" id="inputItem" autofocus>
            </p>
            <input type="submit" value="Add to list" name="submitButton">
            <input type="reset" value="Reset text" name="resetButton">
        </form>

        <div class="container">
            <?php
            $link = mysqli_connect("localhost", "root", "", "shoppinglist_db");
            if ($link === false) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            show_shoppinglist_items_table($link);
            show_shoppinglist_items_list($link);
            mysqli_close($link);
            ?>
        </div>
    </div>
</body>


</html>