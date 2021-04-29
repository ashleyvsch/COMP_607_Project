<?php include "templates/header.php"; ?>


<div class="row">
    <div class="col s12 m6">
    <div class="card-panel hoverable">
      <div class="card grey lighten-4">
        <div class="card-content gret-text text-darken-2">
          <span class="card-title"><strong>Search for an Adoptable Dog</strong></span>
          <p>Search the database for an adoptable dog. You can search based on age or based on breed</p>
        </div>
        <div class="card-action">
        <a href="read-age.php"><strong>age search</strong></a>
        <a href="read-breed.php"><strong>breed search</strong></a>
        </div>
      </div>
      </div>
      </div>
    <div class="col s12 m6">
    <div class="card-panel hoverable">
      <div class="card grey lighten-4">
        <div class="card-content gret-text text-darken-2">
          <span class="card-title"><strong>Add an Adoptable Dog</strong></span>
          <p>This action allows you to add an adoptable dog to the database.</p>
        </div>
        <div class="card-action">
        <a href="createdog.php"><strong>link</strong></a>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m6">
    <div class="card-panel hoverable">
      <div class="card grey lighten-4">
        <div class="card-content gret-text text-darken-2">
          <span class="card-title"><strong>Add an Adoption Entry</strong></span>
          <p>Update a dog to adopted and enter the adopter's infomation.</p>
        </div>
        <div class="card-action">
        <a href="updateadopted.php"><strong>Link</strong></a>
        </div>
      </div>
    </div>
    </div>
    <div class="col s12 m6">
    <div class="card-panel hoverable">
      <div class="card grey lighten-4">
        <div class="card-content gret-text text-darken-2">
          <span class="card-title"><strong>Update a dog's info</strong></span>
          <p>This action allows you to update a dog in the database. An example of an acceptable update is weight change.</p>
        </div>
        <div class="card-action">
        <a href="updatedog.php"><strong>link</strong></a>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m6">
    <div class="card-panel hoverable">
      <div class="card grey lighten-4">
        <div class="card-content gret-text text-darken-2">
          <span class="card-title"><strong>Delete a dog</strong></span>
          <p>Delete a dog from the database.</p>
        </div>
        <div class="card-action">
        <a href="deletedog.php"><strong>Link</strong></a>
        </div>
      </div>
    </div>
    </div>
  </div>


<?php include "templates/footer.php"; ?>