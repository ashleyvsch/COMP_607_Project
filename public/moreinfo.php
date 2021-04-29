<?php

require "../config.php";
require "../common.php";

if (isset($_GET['did'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $did = $_GET['did'];
    $sql = "SELECT * 
            FROM dog d, breed b, shelter s, received r
            WHERE d.did = r.did
            AND r.shid = s.shid
            AND d.bid = b.bid
            AND d.did = :did";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':did', $did);
    $statement->execute();

    $dog = $statement->fetch(PDO::FETCH_ASSOC);

    $sql2 = "SELECT *
             FROM color c, has_color h
             WHERE c.cid = h.cid
             AND h.did = :did";

    $statement2 = $connection->prepare($sql2);
    $statement2->bindValue(':did', $did);
    $statement2->execute();

    $color = $statement2->fetchall(PDO::FETCH_ASSOC);

    $sql3 = "SELECT s.address1, s.postal_code, a.city, a.s_state, a.country
             FROM shelter s, shelter_address a, received r
             WHERE s.postal_code = a.postal_code
             AND r.shid = s.shid
             AND r.did = :did";

    $statement3 = $connection->prepare($sql3);
    $statement3->bindValue(':did', $did);
    $statement3->execute();

    $shelter = $statement3->fetch(PDO::FETCH_ASSOC);

  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>
<section class="container grey-text">

<h4 class = "center">Dog Info</h4>
  <table class="striped">
    <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Age</th>
      <th>Weight</th>
      <th>Color</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <?php $arrlength = count($color) ?>
      <td><?php echo escape($dog["did"]); ?></td>
      <td><?php echo escape($dog["dogname"]); ?></td>
      <td><?php echo escape($dog["dogage"]); ?></td>
      <td><?php echo escape($dog["dogweight"]); ?></td>
      <td><?php echo escape($color[0]["cname"]); ?></td>
      <td><?php if($arrlength == 2) echo escape($color[1]["cname"]); ?></td>
    </tr>
    </tbody>
  </table>
  <h4 class = "center">Breed Info</h4>
  <table class="striped">
    <thead>
    <tr>
      <th>Breed Name</th>
      <th>Typical Breed Weight</th>
      <th>Breed Group</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo escape($dog["bname"]); ?></td>
      <td><?php echo escape($dog["bweight"]); ?></td>
      <td><?php echo escape($dog["bgroup"]); ?></td>
    </tr>
    </tbody>
  </table>
  <h4 class = "center">Shelter Info</h4>
  <table class="striped">
    <thead>
    <tr>
      <th>Shelter Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Website</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo escape($dog["sname"]); ?></td>
      <td><?php echo escape($dog["sphone"]); ?></td>
      <td><?php echo escape($dog["semail"]); ?></td>
      <td><?php echo escape($dog["swebsite"]); ?></td>
    </tr>
    </tbody>
  </table>
  <table class="striped">
    <thead>
    <tr>
      <th>Address</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td><?php echo escape($shelter["address1"]); ?></td>
      <td><?php echo escape($shelter["city"]); ?></td>
      <td><?php echo escape($shelter["s_state"]); ?></td>
      <td><?php echo escape($shelter["postal_code"]); ?></td>
      <td><?php echo escape($shelter["country"]); ?></td>
    </tr>
    </tbody>
  </table>
<h5 class = "center">
<a href="update-single-adopted.php?did=<?php echo escape($dog["did"]); ?>">Adopt this dog!</a>
</h5>
<div class = "center">
<a href="index.php">Back to home</a>
</div>

</section>
<?php include "templates/footer.php"; ?>