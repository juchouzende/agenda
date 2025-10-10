<?php
  include_once("templates/header.php");
?>
  <div class="container" id="view-contact-container"> 
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title"><?= $contact["name"] ?></h1>
    <p class="bold">Telefone:</p>
    <p class="form-control"><?= $contact["phone"] ?></p>
    <p class="bold">Observações:</p>
    <textarea type="text" class="form-control" id="observations" name="observations" rows="3"><?= $contact['observations'] ?></textarea>
  </div>
<?php
  include_once("templates/footer.php");
?>
