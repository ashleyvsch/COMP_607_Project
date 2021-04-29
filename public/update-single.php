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

    $dog =[
      "did"         => $_POST['did'],
      "dogname"     => $_POST['dogname'],
      "dogage"      => $_POST['dogage'],
      "dogweight"      => $_POST['dogweight'],
      "bid" => $_POST['breed'],
    ];

    $sql = "UPDATE dog
            SET 
              dogname = :dogname,
              dogage = :dogage,
              dogweight = :dogweight,
              bid = :bid
            WHERE did = :did";

  $statement = $connection->prepare($sql);
  $statement->execute($dog);

  //color input
  if(empty($_POST['color2'])) {
    $firstcolor =  [
      "color1" => $_POST['color1'],
      "did" => $_POST['did'],
    ];
    $sql2 = "UPDATE has_color
             SET 
              cid = :color1
             WHERE did = :did";
    $statement2 = $connection->prepare($sql2);
    $statement2->execute($firstcolor);


  }else {
    $firstcolor =  array(
      "color1" => $_POST['color1'],
      "did" => $_POST['did'],
    );
    $sql2 =   "UPDATE has_color
               SET 
                cid = :color1
               WHERE did = :did";
    $statement2 = $connection->prepare($sql2);
    $statement2->execute($firstcolor);

    $secondcolor =  array(
      "color2" => $_POST['color2'],
      "did" => $_POST['did'],
    );
    $sql3 =   "UPDATE has_color
               SET 
                cid = :color2
               WHERE did = :did";
    $statement3 = $connection->prepare($sql3);
    $statement3->execute($secondcolor);
  }
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
<?php if (isset($_POST['submit']) && $statement) { ?>
    <?php  $big_ok =  $_POST['dogname'] . " successfully updated.";?> 
<?php } ?>

<!-- <?php print_r($color); ?>
<?php echo $_POST['did']; ?>
<?php if(empty($_POST['color2'])) echo 'yes';?> -->

<section class="container grey-text">

<form class = "white" method="post">
  <h4 class = "center">Edit a dog</h4>
  <h6 class = "center">all of the dog's current info is listed below</h6>
  <h6 class = "center">please make changes to any attribute </h6>
  <br>
    <label for="did">Dog ID (read only) </label>
    <input type = "text" name = "did" id = "did" value = "<?php echo $dog['did']; ?>" readonly>
    <label for="dogname">Dog Name</label>
    <input value = "<?php echo $dog['dogname']; ?>" type="text" name="dogname" id="dogname">
    <br>
    <!-- <div class='red-text'><?php echo $checkerrors['dogname']; ?></div> -->
    <label for="dogage">Dog Age</label>
    <input type="text" name="dogage" id="dogage" value = "<?php echo $dog['dogage']; ?>">
    <br>
    <label for="dogweight">Dog Weight (lbs)</label>
    <input type="text" name="dogweight" id="dogweight" value = "<?php echo $dog['dogweight']; ?>">
    <br>
    <label for="color">Dog Color</label>
    <div class="input-field col s12">
      <select id = "color1" name ="color1">
        <option value="1" <?php if($color[0]['cid']==1) echo "selected" ?> >White</option>
        <option value="2" <?php if($color[0]['cid']==2) echo "selected" ?>>Black</option>
        <option value="3" <?php if($color[0]['cid']==3) echo "selected" ?>>Brown</option>
        <option value="4" <?php if($color[0]['cid']==4) echo "selected" ?>>Grey</option>
        <option value="5" <?php if($color[0]['cid']==5) echo "selected" ?>>Red</option>
        <option value="6" <?php if($color[0]['cid']==6) echo "selected" ?>>Gold</option>
        <option value="7" <?php if($color[0]['cid']==7) echo "selected" ?>>Yellow</option>
        <option value="8" <?php if($color[0]['cid']==8) echo "selected" ?>>Cream</option>
        <option value="9" <?php if($color[0]['cid']==9) echo "selected" ?>>Blue</option>
      </select>
    </div>
    <div class="input-field col s12">
      <select id = "color2" name ="color2">
        <?php $arrlength = count($color) ?>
        <option value = "" <?php if($arrlength == 1) echo "selected" ?>>Select Color 2 (optional)</option>
        <option value="1" <?php if( $arrlength == 2 && $color[1]['cid']==1 ) echo "selected" ?> >White</option>
        <option value="2" <?php if( $arrlength == 2 && $color[1]['cid']==2) echo "selected" ?>>Black</option>
        <option value="3" <?php if($arrlength == 2 && $color[1]['cid']==3) echo "selected" ?>>Brown</option>
        <option value="4" <?php if($arrlength == 2 && $color[1]['cid']==4) echo "selected" ?>>Grey</option>
        <option value="5" <?php if($arrlength == 2 && $color[1]['cid']==5) echo "selected" ?>>Red</option>
        <option value="6" <?php if($arrlength == 2 && $color[1]['cid']==6) echo "selected" ?>>Gold</option>
        <option value="7" <?php if($arrlength == 2 && $color[1]['cid']==7) echo "selected" ?>>Yellow</option>
        <option value="8" <?php if($arrlength == 2 && $color[1]['cid']==8) echo "selected" ?>>Cream</option>
        <option value="9" <?php if($arrlength == 2 && $color[1]['cid']==9) echo "selected" ?>>Blue</option>
      </select>
    </div>
    <br>
    <label for="breed">Dog Breed</label>
    <div class="input-field col s12">
      <select id = "breed" name ="breed">
        <option value="1" <?php if($dog['bid']==1) echo "selected" ?>>Mixed</option>
        <option value="2" <?php if($dog['bid']==2) echo "selected" ?>>Other</option>
        <option value="3" <?php if($dog['bid']==3) echo "selected" ?>>Alaskan Malamute</option>
        <option value="4" <?php if($dog['bid']==4) echo "selected" ?>>American Pit Bull Terrier</option>
        <option value="5" <?php if($dog['bid']==5) echo "selected" ?>>American Staffordshire Terrier</option>
        <option value="6" <?php if($dog['bid']==6) echo "selected" ?>>Australian Shepherd</option>
        <option value="7" <?php if($dog['bid']==7) echo "selected" ?>>Bernese Mountain Dog</option>
        <option value="8" <?php if($dog['bid']==8) echo "selected" ?>>Border Collie</option>
        <option value="9" <?php if($dog['bid']==9) echo "selected" ?>>Boston Terrier</option>
        <option value="10" <?php if($dog['bid']==10) echo "selected" ?>>Bulldog</option>
        <option value="11" <?php if($dog['bid']==11) echo "selected" ?>>Chihuahua</option>
        <option value="12" <?php if($dog['bid']==12) echo "selected" ?>>Dashshund</option>
        <option value="13" <?php if($dog['bid']==13) echo "selected" ?>>Dobermann</option>
        <option value="14" <?php if($dog['bid']==14) echo "selected" ?>>French Bulldog</option>
        <option value="15" <?php if($dog['bid']==15) echo "selected" ?>>German Shepherd</option>
        <option value="16" <?php if($dog['bid']==16) echo "selected" ?>>Golden Retriever</option>
        <option value="17" <?php if($dog['bid']==17) echo "selected" ?>>Great Dane</option>
        <option value="18" <?php if($dog['bid']==18) echo "selected" ?>>Greyhound</option>
        <option value="19" <?php if($dog['bid']==19) echo "selected" ?>>Labrador Retriever</option>
        <option value="20" <?php if($dog['bid']==20) echo "selected" ?>>Maltese</option>
        <option value="21" <?php if($dog['bid']==21) echo "selected" ?>>Pembroke Welsh Corgi</option>
        <option value="22" <?php if($dog['bid']==22) echo "selected" ?>>Pomeranian</option>
        <option value="23" <?php if($dog['bid']==23) echo "selected" ?>>Poodle</option>
        <option value="24" <?php if($dog['bid']==24) echo "selected" ?>>Rottweiler</option>
        <option value="25" <?php if($dog['bid']==25) echo "selected" ?>>Siberian Husky</option>
      </select>
    </div>
    <label for="shelter">Shelter</label>
    <div class="input-field col s12">
      <select id = "shelter" name ="shelter" value = "<?php echo $shelter['shid']; ?>">
        <option value="1" <?php if($shelter['shid']==1) echo "selected" ?>>San Diego Dog Rescue</option>
        <option value="2"<?php if($shelter['shid'] == 2) echo "selected"; ?>>Baja Mexico Dog Resuce</option>
        <option value="3" <?php if($shelter['shid'] == 3) echo "selected"; ?>>Senior Shelter</option>
      </select>
    </div>
    <br>
        <!-- <div class = 'red-text'><?php echo $big_error; ?> </div>  -->
        <div class = 'red-text'><?php echo $big_ok; ?> </div> 
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