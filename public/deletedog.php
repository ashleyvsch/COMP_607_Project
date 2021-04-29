<?php

/**
  * Delete a user
  */

require "../config.php";
require "../common.php";
$success = '';
if (isset($_GET["did"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $did = $_GET["did"];

    $sql = "DELETE FROM dog WHERE did = :did";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':did', $did);
    $statement->execute();

    $success = "> Dog successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT d.did, d.dogname, s.sname, d.dogstatus 
  FROM dog d, shelter s, received r
  WHERE d.did = r.did
  AND r.shid = s.shid";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
<!-- 
<?php if ($success) echo $success; ?> -->

<?php $big_ok = ''; ?>
<?php if ($success) { ?>
    <?php  $big_ok =  "dog successfully deleted.";?> 
<?php } ?>

<section class="container grey-text">
<h4 class = "center">Delete a dog</h4>
<div class = "center">
Choose a dog to delete!
</div>
<br>
<div class = 'red-text'><?php echo $big_ok; ?> </div> 
<br>
<table class="striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Dog Name</th>
      <th>Shelter Name</th>
      <th>Status</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["did"]); ?></td>
        <td><?php echo escape($row["dogname"]); ?></td>
        <td><?php echo escape($row["sname"]); ?></td>
        <td><?php echo escape($row["dogstatus"]); ?></td>
        <td><a href="deletedog.php?did=<?php echo escape($row["did"]); ?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</section>
<div class = "center">
  <a href="index.php">Back to home</a>
</div>  
<?php require "templates/footer.php"; ?>