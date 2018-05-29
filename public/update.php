<?php
try {
    require '../config.php';

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();


} catch (PDOException $error) {
    echo $sql . "<br/>" . $error->getMessage();
}

?>
<?php include 'templates/header.php'; ?>

    <h2>Update users</h2>

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
            <th></th>
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
                <td><?php echo $row['status'] ? "Available" : "N/A" ?></td>
                <td><a href="update-single.php?id=<?php echo $row['id']; ?>">Edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <br/>
    <br/>
    <a href="index.php">Back to home</a>

<?php include 'templates/footer.php'; ?>