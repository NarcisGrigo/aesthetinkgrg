<?php
$mode = $mode ?? "insertion";
require "views/errors_form.html.php";
?>

<form method="post">
    <div class="form-group mt-3">
        <label for="type">Category</label>
        <input type="text" name="type" id="type" class="form-control" value="<?= $category->getType() ?>"
            <?= $mode == "suppression" ? "disabled" : "" ?>>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary" name="register">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
        </button>
        <a href="<?= addLink("home") ?>" class="btn btn-danger">Cancel</a>
        <a href="<?= addLink("category", "new") ?>" class="btn btn-danger">Create a new category</a>
    </div>
</form>