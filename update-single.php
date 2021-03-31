<?php
/**
  * Use an HTML form to edit an entry in the
  * dog table.
  *
  */
require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $dog =[
      "did"         => $_POST['did'],
      "dogname"     => $_POST['dogname'],
      "dogage"      => $_POST['dogage'],
      "dogstatus"   => $_POST['dogstatus'],
    ];

    $sql = "UPDATE dog
            SET 
              dogname = :dogname,
              dogage = :dogage,
              dogstatus = :dogstatus
            WHERE did = :did";

  $statement = $connection->prepare($sql);
  $statement->execute($dog);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['did'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $did = $_GET['did'];
    $sql = "SELECT * FROM dog WHERE did = :did";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':did', $did);
    $statement->execute();

    $dog = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['dogname']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a dog</h2>

<form method="post">
    <?php foreach ($dog as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" did="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'did' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form> 

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?> 