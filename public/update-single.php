<?php
require "../config.php";
if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $user = [
            "id" => $_POST['id'],
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "age" => $_POST['age'],
            "location" => $_POST['location'],
            "date" => $_POST['date'],
            "status" => $_POST['status']
        ];

        $sql = "UPDATE users 
            SET id = :id, 
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              age = :age, 
              location = :location, 
              date = :date,
              status = :status
            WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($user);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php
if (isset($_GET['id'])) {
    try {

        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>

<?php include 'templates/header.php' ?>

    <h2>Edit a user</h2>

    <form method="post">
        <?php foreach ($user as $key => $value) { ?>
            <label for="<?php echo $key; ?>">
                <?php echo ucfirst($key); ?>
            </label>
            <input
                    type="text"
                    name="<?php echo $key; ?>"
                    id="<?php echo $key; ?>"
                    value="<?php echo $value; ?>"
                <?php echo($key === 'id' ? 'readonly' : null) ?>
            >
        <?php } ?>
        <br/>
        <br/>
        <input type="submit" name="submit" value="Update">
    </form>

    <br/>
    <br/>
    <a href="index.php">Back to home</a>

<?php include 'templates/footer.php' ?>