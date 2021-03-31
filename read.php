<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM dog
    WHERE dogage LIKE :dogage";

    $dogage = $_POST['dogage'];
    $dogage .= "%";

    $statement = $connection->prepare($sql);
    $statement->bindParam(':dogage', $dogage, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

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
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["did"]); ?></td>
<td><?php echo escape($row["dogname"]); ?></td>
<td><?php echo escape($row["dogage"]); ?></td>
<td><?php echo escape($row["dogstatus"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for an age of <?php echo escape($_POST['dogage']); ?>.
  <?php }
} ?>

    <h2>Find dog based on age</h2>

    <form method="post">
    	<label for="dogage">Dog Age</label>
    	<input type="text" id="dogage" name="dogage">
    	<input type="submit" name="submit" value="View Results">
    </form>

    <a href="index.php">Back to home</a>

    <?php include "templates/footer.php"; ?>