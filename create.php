<?php include "templates/header.php"; ?><h2>Add a user</h2>

    <form method="post">
    	<label for="dogname">Dog Name</label>
    	<input type="text" name="dogname" id="dogname">
    	<label for="ldogbreed">Dog Breed</label>
    	<input type="text" name="dogbreed" id="dogbreed">
<!--     	<label for="email">Email Address</label>
    	<input type="text" name="email" id="email">
    	<label for="age">Age</label>
    	<input type="text" name="age" id="age">
    	<label for="location">Location</label>
    	<input type="text" name="location" id="location">*/ -->
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php include "templates/footer.php"; ?>