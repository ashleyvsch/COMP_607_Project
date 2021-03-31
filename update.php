<?php

/**
  * List all users with a link to edit
  */

try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM dog";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

<h2>Update dogs</h2>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Dog Name</th>
      <th>Dog Age</th>
      <th>Status</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["did"]); ?></td>
        <td><?php echo escape($row["dogname"]); ?></td>
        <td><?php echo escape($row["dogage"]); ?></td>
        <td><?php echo escape($row["dogstatus"]); ?></td>
        <td><a href="update-single.php?did=<?php echo escape($row["did"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>