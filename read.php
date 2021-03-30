<?php include "templates/header.php"; ?>

    <h2>Find dog based on breed</h2>

    <form method="post">
    	<label for="dogbreed">Dog Breed</label>
    	<input type="text" id="dogbreed" name="dogbreed">
    	<input type="submit" name="submit" value="View Results">
    </form>

    <a href="index.php">Back to home</a>

    <?php include "templates/footer.php"; ?>