<?php
/*
 * Use an HTML form to create a new entry in the
 * users table
 */

if (isset($_POST['submit'])) {
    require '../config.php';

    try {
        // create connection
        $connection = new PDO($dsn, $username, $password, $options);

        // insert new user
        $new_user = array(
            "firstname" => $_POST['txtFirstName'],
            "lastname" => $_POST['txtLastName'],
            "email" => $_POST['txtEmail'],
            "age" => $_POST['txtAge'],
            "location" => $_POST['txtLocation']
        );

        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user)));

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote><?php echo $_POST['txtFirstName']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add a user</h2>

<form method="post">
    <label for="txtFirstName">First Name</label>
    <input type="text" name="txtFirstName" id="txtFirstName">
    <label for="txtLastName">Last Name</label>
    <input type="text" name="txtLastName" id="txtLastName">
    <label for="txtEmail">Email</label>
    <input type="email" name="txtEmail" id="txtEmail">
    <label for="txtAge">Age</label>
    <input type="number" name="txtAge" id="txtAge">
    <label for="txtLocation">Location</label>
    <input type="text" name="txtLocation" id="txtLocation">
    <br/>
    <br/>
    <input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
    <br/>
    <br/>
    <a href="index.php">Back to home</a>
</form>

<?php include "templates/footer.php"; ?>
