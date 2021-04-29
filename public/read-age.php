<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT d.dogname, d.dogage, d.dogweight, d.did, b.bname, s.sname
    FROM dog d, breed b, received r, shelter s
    WHERE d.did = r.did
    AND r.shid = s.shid
    AND d.bid = b.bid
    AND d.dogstatus = 'adoptable'
    AND dogage LIKE :dogage";

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
<section class="container grey-text">
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h4 class = "center">Results</h4>

    <table class="striped">
      <thead>
      <tr>
        <th>Dog Name</th>
        <th>Dog Age</th>
        <th>Dog Weight</th>
        <th>Breed Name</th>
        <th>Shelter Name</th>
        <th> More Info </th>
      </tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo escape($row["dogname"]); ?></td>
        <td><?php echo escape($row["dogage"]); ?></td>
        <td><?php echo escape($row["dogweight"]); ?></td>
        <td><?php echo escape($row["bname"]); ?></td>
        <td><?php echo escape($row["sname"]); ?></td>
        <td><a href="moreinfo.php?did=<?php echo escape($row["did"]); ?>">More Info</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for an age of <?php echo escape($_POST['dogage']); ?>.
  <?php }
} ?>

<h4 class = "center">Find dog based on age</h4>

    <form class = "white" method="post">
    	<label for="dogage">Give an Age</label>
    	<input type="text" id="dogage" name="dogage">
    	<input type="submit" name="submit" value="View Results">
    </form>

    <div class = "center">
<a href="index.php">Back to home</a>
</div>
</section>
<?php include "templates/footer.php"; ?>