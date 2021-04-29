<?php

/**
  * List all the dogs with a link to edit
  */

try {
  require "../config.php";
  require "../common.php";

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

<section class="container grey-text">
<h4 class = "center">Update a dog</h4>
<div class = "center">
Choose a dog to update.
</div>
<table class="striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Dog Name</th>
      <th>Dog Age</th>
      <th>Dog Weight</th>
      <th>Status</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["did"]); ?></td>
        <td><?php echo escape($row["dogname"]); ?></td>
        <td><?php echo escape($row["dogage"]); ?></td>
        <td><?php echo escape($row["dogweight"]); ?></td>
        <td><?php echo escape($row["dogstatus"]); ?></td>
        <td><a href="update-single.php?did=<?php echo escape($row["did"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</section>
<div class = "center">
  <a href="index.php">Back to home</a>
</div>  
<?php require "templates/footer.php"; ?>