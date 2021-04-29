<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */
require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  try {

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT d.dogname, d.dogage, d.dogweight, d.did, b.bname, s.sname
    FROM dog d, breed b, received r, shelter s
    WHERE d.did = r.did
    AND r.shid = s.shid
    AND d.bid = b.bid
    AND d.dogstatus = 'adoptable'
    AND d.bid = :bid";

    $breed = $_POST['bid'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':bid', $breed, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();

    $sql2 = "SELECT * 
             FROM breed
             WHERE bid = :bid";

    $statement2 = $connection->prepare($sql2);
    $statement2->bindParam(':bid', $breed, PDO::PARAM_STR);
    $statement2->execute();

    $result2 = $statement2->fetchAll();

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
    > No results found for breed '<?php echo $result2[0]['bname']; ?>'.
  <?php }
} ?>

<h4 class = "center">Find dog based on breed</h4>

    <form class = "white" method="post">
    <label for="bid">Choose a Breed</label>
    <div class="input-field col s12">
      <select id = "bid" name ="bid">
        <option value = "" disabled selected>Select Breed</option>
        <option value="1">Mixed</option>
        <option value="2">Other</option>
        <option value="3">Alaskan Malamute</option>
        <option value="4">American Pit Bull Terrier</option>
        <option value="5">American Staffordshire Terrier</option>
        <option value="6">Australian Shepherd</option>
        <option value="7">Bernese Mountain Dog</option>
        <option value="8">Border Collie</option>
        <option value="9">Boston Terrier</option>
        <option value="10">Bulldog</option>
        <option value="11">Chihuahua</option>
        <option value="12">Dashshund</option>
        <option value="13">Dobermann</option>
        <option value="14">French Bulldog</option>
        <option value="15">German Shepherd</option>
        <option value="16">Golden Retriever</option>
        <option value="17">Great Dane</option>
        <option value="18">Greyhound</option>
        <option value="19">Labrador Retriever</option>
        <option value="20">Maltese</option>
        <option value="21">Pembroke Welsh Corgi</option>
        <option value="22">Pomeranian</option>
        <option value="23">Poodle</option>
        <option value="24">Rottweiler</option>
        <option value="25">Siberian Husky</option>
      </select>
    </div>
    	<input type="submit" name="submit" value="View Results">
    </form>

    <div class = "center">
<a href="index.php">Back to home</a>
</div>
</section>
<?php include "templates/footer.php"; ?>