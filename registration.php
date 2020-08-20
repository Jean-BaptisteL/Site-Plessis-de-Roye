<?php
session_start();
$pagetitle = 'Plessis de Roye - Inscription';
include_once 'models/users.php';
include_once 'controllers/registrationCtrl.php';
include_once 'includes/header.php';
?>
<h2 class="text-center mt-4" id="registrationTitle">Formulaire d'inscription :</h2>
<p class="text-success"><?= isset($errorMessages['success']) ? $errorMessages['success'] : '' ?></p>
<form class="row m-0 d-flex justify-content-center mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <div class="col-sm-12 col-md-4"  id="registrationForm">
        <div class="form-group">
            <label for="firstnameRegistration">Prénom :</label>
            <input type="text" name="firstnameRegistration" id="firstnameRegistration" class="form-control <?= isset($_POST['firstnameRegistration']) ? (!isset($errorMessages['firstnameRegistration']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="Michel" value="<?= isset($_POST['firstnameRegistration']) ? $_POST['firstnameRegistration'] : '' ?>" required />
            <small class="text-danger"><?= isset($errorMessages['firstnameRegistration']) ? $errorMessages['firstnameRegistration'] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="lastnameRegistration">NOM :</label>
            <input type="text" name="lastnameRegistration" id="lastnameRegistration" class="form-control <?= isset($_POST['lastnameRegistration']) ? (!isset($errorMessages['lastnameRegistration']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="DUPONT" value="<?= isset($_POST['lastnameRegistration']) ? $_POST['lastnameRegistration'] : '' ?>" required />
            <small class="text-danger"><?= isset($errorMessages['lastnameRegistration']) ? $errorMessages['lastnameRegistration'] : '' ?></small>
        </div>
        <div class="form-group mt-5">
            <label for="emailRegistration">Adresse mail :</label>
            <input type="email" name="emailRegistration" id="emailRegistration" class="form-control <?= isset($_POST['emailRegistration']) ? (!isset($errorMessages['emailRegistration']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="adresse@email.fr" value="<?= isset($_POST['emailRegistration']) ? $_POST['emailRegistration'] : '' ?>" required />
            <small class="text-danger"><?= isset($errorMessages['emailRegistration']) ? $errorMessages['emailRegistration'] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="emailComfirmation">Confirmez votre adresse mail :</label>
            <input type="email" name="emailComfirmation" id="emailComfirmation" class="form-control <?= isset($_POST['emailComfirmation']) ? (!isset($errorMessages['']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['emailComfirmation']) ? $_POST['emailComfirmation'] : '' ?>" required />
            <small class="text-danger"><?= isset($errorMessages['emailComfirmation']) ? $errorMessages['emailComfirmation'] : '' ?></small>
        </div>
        <div class="form-group mt-5">
            <label for="passwordRegistration">Mot de passe :</label>
            <input type="password" name="passwordRegistration" id="passwordRegistration" class="form-control <?= isset($_POST['passwordRegistration']) ? (!isset($errorMessages['passwordRegistration']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['passwordRegistration']) ? $_POST['passwordRegistration'] : '' ?>" required />
            <small class="text-danger"><?= isset($errorMessages['passwordRegistration']) ? $errorMessages['passwordRegistration'] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="passwordComfirmation">Confirmez votre mot de passe :</label>
            <input type="password" name="passwordComfirmation" id="passwordComfirmation" class="form-control <?= isset($_POST['passwordComfirmation']) ? (!isset($errorMessages['passwordComfirmation']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['passwordComfirmation']) ? $_POST['passwordComfirmation'] : '' ?>" required />
            <small class="text-danger"><?= isset($errorMessages['passwordComfirmation']) ? $errorMessages['passwordComfirmation'] : '' ?></small>
        </div>
        <input type="submit" name="userRegistration" id="userRegistration" value="S'inscrire !" class="btn" />
    </div>
</form>
<?php
include_once 'includes/footer.php';
