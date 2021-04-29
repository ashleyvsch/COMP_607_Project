<?php
/**
  * Use an HTML form to edit an entry in the
  * dog table.
  *
  */
require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    //insert the adopter
    $adopter =[
      "afname"         => $_POST['afname'],
      "alname"     => $_POST['alname'],
      "aphone"      => $_POST['aphone'],
      "aemail"      => $_POST['aemail'],
    ];

    $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "adopter",
        implode(", ", array_keys($adopter)),
        ":" . implode(", :", array_keys($adopter))
            );

  $statement = $connection->prepare($sql);
  $statement->execute($adopter);

  //change the dog to adopted
  $dog =[
    "did"         => $_POST['did'],
    "dogstatus"     => 'adopted',
  ];

  $sql2 = "UPDATE dog
          SET 
            dogstatus = :dogstatus
          WHERE did = :did";

    $statement2 = $connection->prepare($sql2);
    $statement2->execute($dog);

    //add to adopted table

    $dogid=  array(
    'did' => $_POST['did'],
    );
    $sql4 =   "INSERT INTO adopted (aid, did) SELECT MAX(aid), did FROM adopter, dog WHERE did = :did";
    $statement4 = $connection->prepare($sql4);
    $statement4->execute($dogid);

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

    $sql2 = "SELECT * FROM received WHERE did = :did";
    $statement2 = $connection->prepare($sql2);
    $statement2->bindValue(':did', $did);
    $statement2->execute();

    $shelter = $statement2->fetch(PDO::FETCH_ASSOC);

    $sql3 = "SELECT * FROM has_color WHERE did = :did";
    $statement3= $connection->prepare($sql3);
    $statement3->bindValue(':did', $did);
    $statement3->execute();

    $color = $statement3->fetchall(PDO::FETCH_ASSOC);

  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<style>
    input:focus, textarea:focus, select:focus{
        outline: none;
    }
</style>

<?php $big_ok = ''; ?>
<?php $big_ok2 = ''; ?>
<?php if (isset($_POST['submit']) && $statement) { ?>
    <?php  $big_ok =  $_POST['dogname'] . " successfully updated to adopted.";?> 
    <?php  $big_ok2 =  "Congrats on your new furry friend!";?> 
<?php } ?>

<!-- <?php print_r($color); ?>
<?php echo $_POST['did']; ?>
<?php if(empty($_POST['color2'])) echo 'yes';?> -->

<section class="container grey-text">

<form class = "white" method="post">
  <h4 class = "center">Add an Adoption Entry!</h4>
  <h5 class = "center">--------------------------------------------------</h5>
  <h5 class = "center">Dog's Info (read only)</h5>
    <label for="did">Dog ID</label>
    <input type = "text" name = "did" id = "did" value = "<?php echo $dog['did']; ?>" readonly>
    <label for="dogname">Dog Name</label>
    <input value = "<?php echo $dog['dogname']; ?>" type="text" name="dogname" id="dogname"readonly>
    <br>
    <label for="shelter">Shelter</label>
    <input value = "<?php if($shelter['shid']==1) echo "San Diego Dog Rescue";?><?php if($shelter['shid']==2) echo "Baja Mexico Dog Rescue"; ?><?php if($shelter['shid']==3) echo "Senior Shelter"; ?>" type="text" name="shelter" id="shelter" readonly>
    <br>
    <h5 class = "center">Adopter's Info</h5>
    <br>
    <label for="afname">First Name</label>
    <input type="text" name="afname" id="afname">
    <br>
    <label for="alname">Last Name</label>
    <input type="text" name="alname" id="alname">
    <br>
    <label for="aphone">Phone Number</label>
    <input type="text" name="aphone" id="aphone">
    <br>
    <label for="aemail">Email</label>
    <input type="text" name="aemail" id="aemail">
    <br>
    <div class = 'red-text'><?php echo $big_ok; ?> </div> 
    <div class = 'red-text'><?php echo $big_ok2; ?> </div> 
    <!-- <div class = 'red-text'><?php echo $big_error; ?> </div>  -->
    <br>
    <div class = "center">
      <input type="submit" name="submit" value="Submit" class = "btn-two green rounded">
    </div> 
</form> 
</section>
<div class = "center">
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?> 