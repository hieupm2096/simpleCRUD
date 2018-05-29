<?php
/**
 * Created by PhpStorm.
 * User: oswal
 * Date: 5/28/2018
 * Time: 10:21 PM
 */

if (isset($_POST['submit'])) {
    try {
        require '../config.php';

        // create connection
        $connection = new PDO($dsn, $username, $password, $options);

        // fetch data
        $sql = "SELECT * FROM users WHERE location = :location";
        $location = $_POST['txtLocation'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>

<?php include "templates/header.php"; ?>

<h2>Find user based on location</h2>

<form method="post">
    <label for="txtLocation">Location</label>
    <input type="text" name="txtLocation" id="txtLocation">
    <br/>
    <br/>
    <input type="submit" name="submit" value="View Results">
    <input type="reset" value="Reset">
    <br/>
    <br/>
    <a href="index.php">Back to home</a>
    <br/>
    <br/>
</form>

<?php
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        ?>
        <h2>Results</h2>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $row) { ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['firstname'] ?></td>
                    <td><?php echo $row['lastname'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['age'] ?></td>
                    <td><?php echo $row['location'] ?></td>
                    <td><?php echo $row['date'] ?></td>
                    <td><?php echo $row['status'] ? 'Available' : 'N/A' ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    <?php } else { ?>
        <blockquote>No result found for <?php echo $_POST['txtLocation']; ?>.</blockquote>
    <?php }
} ?>

<?php include "templates/footer.php"; ?>
