<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_dog = array(
      "dogname" => $_POST['dogname'],
      "dogage"  => $_POST['dogage'],
      "dogstatus" => $_POST['dogstatus'],
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"dog",
implode(", ", array_keys($new_dog)),
":" . implode(", :", array_keys($new_dog))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_dog);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['dogname']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
  <label for="dogname">Dog Name</label>
  <input type="text" name="dogname" id="dogname">
  <label for="dogage">Dog Age</label>
  <input type="text" name="dogage" id="dogage">
  <label for="dogstatus">Dog Status</label>
  <input type="text" name="dogstatus" id="dogstatus">
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>