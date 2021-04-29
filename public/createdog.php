<?php

/**
  * Use an HTML form to create a new entry in the
  * dogs table.
  *
  */
$big_ok = '';
$big_error = '';
$checkerrors = array('dogname'=>'', 'color1'=>'', 'shelter'=>'', 'breed'=>'');
$statement = '';
if (isset($_POST['submit'])) {

  if(empty($_POST['dogname'])){
    $checkerrors['dogname'] = 'A dog name is required. <br />';
  } 

  if(empty($_POST['color1'])){
    $checkerrors['color1'] = 'At least one color is required. <br />';
  } 

  if(empty($_POST['shelter'])){
    $checkerrors['shelter'] = 'A shelter is required. <br />';
  }

  if(empty($_POST['breed'])){
    $checkerrors['breed'] = 'A breed is required. <br />';
  }
  
  if(empty($_POST['dogname']) || empty($_POST['color1']) || empty($_POST['shelter']) || empty($_POST['breed'])){
    $big_error = 'Error detected. No database entry made.';
  }
  else {
 
    require "../config.php";
    require "../common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      // new dog input
      $new_dog = array(
        "dogname" => $_POST['dogname'],
        "dogage"  => $_POST['dogage'],
        "dogweight" => $_POST['dogweight'],
        "dogstatus" => 'adoptable',
        "bid" => $_POST['breed'],
      );

      $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "dog",
      implode(", ", array_keys($new_dog)),
      ":" . implode(", :", array_keys($new_dog))
          );

      $statement = $connection->prepare($sql);
      $statement->execute($new_dog);

      // color input
      if(empty($_POST['color2'])) {
        $firstcolor =  array(
          'color1' => $_POST['color1'],
        );
        $sql2 =   "INSERT INTO has_color (cid, did) SELECT cid, MAX(did) FROM dog, color WHERE cid = :color1";
        $statement2 = $connection->prepare($sql2);
        $statement2->execute($firstcolor);
      }else {
        $firstcolor =  array(
          'color1' => $_POST['color1'],
        );
        $sql2 =   "INSERT INTO has_color (cid, did) SELECT cid, MAX(did) FROM dog, color WHERE cid = :color1";
        $statement2 = $connection->prepare($sql2);
        $statement2->execute($firstcolor);

        $secondcolor =  array(
          'color2' => $_POST['color2'],
        );
        $sql3 =   "INSERT INTO has_color (cid, did) SELECT cid, MAX(did) FROM dog, color WHERE cid = :color2";
        $statement3 = $connection->prepare($sql3);
        $statement3->execute($secondcolor);
      }
      
      //shelter input
      $shelterid =  array(
        'sheltershid' => $_POST['shelter'],
      );
      $sql4 =   "INSERT INTO received (shid, did) SELECT shid, MAX(did) FROM dog, shelter WHERE shid = :sheltershid";
      $statement4 = $connection->prepare($sql4);
      $statement4->execute($shelterid);

      // //breed input
      // $breedid =  array(
      //   'bid' => $_POST['breed'],
      // );
      // $sql5 =   "INSERT INTO is_breed (bid, did) SELECT bid, MAX(did) FROM dog, breed WHERE bid = :bid";
      // $statement5 = $connection->prepare($sql5);
      // $statement5->execute($breedid);


    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }// end try
  }// end else
}// end if submit

?>

<?php require "templates/header.php"; ?>

<?php $big_ok = ''; ?>
<?php if (isset($_POST['submit']) && $statement) { ?>
    <?php  $big_ok =  $_POST['dogname'] . " successfully added.";?> 
<?php } ?>

<section class="container grey-text">

  <form class = "white" method="post">
  <h4 class = "center" >Add an adoptable dog to the database!</h4>
  <h6 class = "center" >Please complete the form in its entirety.</h6>
  <br>
    <label for="dogname">Dog Name</label>
    <input type="text" name="dogname" id="dogname">
    <div class='red-text'><?php echo $checkerrors['dogname']; ?></div>
    <br>
    <label for="dogage">Dog Age (years)</label>
    <input type="text" name="dogage" id="dogage">
    <br>
    <label for="dogweight">Dog Weight (lbs)</label>
    <input type="text" name="dogweight" id="dogweight">
    <br>
    <label for="color">Dog Color</label>
    <div class="input-field col s12">
      <select id = "color1" name ="color1">
        <option value = "" disabled selected>Select Color 1</option>
        <option value="1">White</option>
        <option value="2">Black</option>
        <option value="3">Brown</option>
        <option value="4">Grey</option>
        <option value="5">Red</option>
        <option value="6">Gold</option>
        <option value="7">Yellow</option>
        <option value="8">Cream</option>
        <option value="9">Blue</option>
      </select>
    </div>
    <div class = 'red-text'><?php echo $checkerrors['color1']; ?></div>
    <div class="input-field col s12">
      <select id = "color2" name ="color2">
        <option value = "" disabled selected>Select Color 2 (optional)</option>
        <option value="1">White</option>
        <option value="2">Black</option>
        <option value="3">Brown</option>
        <option value="4">Grey</option>
        <option value="5">Red</option>
        <option value="6">Gold</option>
        <option value="7">Yellow</option>
        <option value="8">Cream</option>
        <option value="9">Blue</option>
      </select>
    </div>
    <br>
    <label for="breed">Dog Breed</label>
    <div class="input-field col s12">
      <select id = "breed" name ="breed">
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
    <div class = 'red-text'><?php echo $checkerrors['breed']; ?></div>
    <br>
    <label for="shelter">Shelter</label>
    <div class="input-field col s12">
      <select id = "shelter" name ="shelter">
        <option value = "" disabled selected>Select Shelter</option>
        <option value="1">San Diego Dog Rescue</option>
        <option value="2">Baja Mexico Dog Resuce</option>
        <option value="3">Senior Shelter</option>
      </select>
    </div>
    <div class = 'red-text'><?php echo $checkerrors['shelter']; ?></div>
    <br>
    <div class = 'red-text'><?php echo $big_error; ?> </div> 
    <div class = 'red-text'><?php echo $big_ok; ?> </div> 
    <br>
    <div class = "center">
      <input type="submit" name="submit" value="Submit" class = "btn-two green rounded">
    </div> 
  </form>
</section>
<div class = "center">
<a href="index.php" class = "center" >Back to home</a>
</div>  
<?php require "templates/footer.php"; ?>

</html>