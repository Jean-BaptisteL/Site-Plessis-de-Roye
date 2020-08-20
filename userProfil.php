<?php
session_start();
$pagetitle = 'Plessis de Roye - Profil';
include_once 'models/users.php';
include_once 'controllers/userProfilCtrl.php';
include_once 'includes/header.php';
?>
<div id="userProfilContent">
    <div class="text-center mt-4">  
        <h2 id="profilTitle">Mon profil</h2>
    </div>
    <div class="row m-0 d-flex justify-content-center">
        <div id="userInfos" class="col-sm-12 col-md-5 row mt-5 ml-2 mr-2 bg-light">
            <div class="col-sm-12 col-md-6 mt-3">
                <p>Prénom : <span class="userPersonalInfos"><?= $_SESSION['user']['userFirstname'] ?></span></p>
                <p>Nom : <span class="userPersonalInfos"><?= $_SESSION['user']['userLastname'] ?></span></p>
                <p>Adresse mail : <span class="userPersonalInfos"><?= $_SESSION['user']['userEmail'] ?></span></p>
            </div>
            <div class="col-sm-12 col-md-6 mt-2">
                <div class="text-md-right text-sm-center">
                    <button class="btn btn-link btn-sm mt-2 mb-1" data-toggle="collapse" data-target="#updateForm">Modifier mes identifiants</button>
                    <button class="btn btn-link btn-sm mb-1" data-toggle="collapse" data-target="#updateEmail">Modifier mon adresse mail</button>
                    <button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#updatePwForm">Modifier mon mot de passe</button>
                </div>
            </div>
        </div>
    </div>
    <div id="updateForm" class="collapse">
        <p class="text-success"><?= isset($errorMessages['success']) ? $errorMessages['success'] : '' ?></p>
        <form class="row m-0 d-flex justify-content-center mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="col-sm-12 col-md-4 updateUserForm">
                <div class="form-group">
                    <label for="firstnameUpdate">Prénom :</label>
                    <input type="text" name="firstnameUpdate" id="firstnameUpdate" class="form-control <?= isset($_POST['firstnameUpdate']) ? (!isset($errorMessages['firstnameUpdate']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="Michel" value="<?= isset($_POST['firstnameUpdate']) ? $_POST['firstnameUpdate'] : $_SESSION['user']['userFirstname'] ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['firstnameUpdate']) ? $errorMessages['firstnameUpdate'] : '' ?></small>
                </div>
                <div class="form-group">
                    <label for="lastnameUpdate">NOM :</label>
                    <input type="text" name="lastnameUpdate" id="lastnameUpdate" class="form-control <?= isset($_POST['lastnameUpdate']) ? (!isset($errorMessages['lastnameUpdate']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="DUPONT" value="<?= isset($_POST['lastnameUpdate']) ? $_POST['lastnameUpdate'] : $_SESSION['user']['userLastname'] ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['lastnameUpdate']) ? $errorMessages['lastnameUpdate'] : '' ?></small>
                </div>
                <input type="submit" name="userInfosUpdate" id="userInfosUpdate" value="Modifier" class="btn updateBtn" />
            </div>
        </form>
    </div>
    <div id="updateEmail" class="collapse">
        <p class="text-success"><?= isset($errorMessages['success']) ? $errorMessages['success'] : '' ?></p>
        <form class="row m-0 d-flex justify-content-center mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="col-sm-12 col-md-4 updateUserForm">
                <div class="form-group">
                    <label for="emailUpdate">Adresse mail :</label>
                    <input type="email" name="emailUpdate" id="emailUpdate" class="form-control <?= isset($_POST['emailUpdate']) ? (!isset($errorMessages['emailUpdate']) ? 'is-valid' : 'is-invalid') : '' ?>" placeholder="adresse@email.fr" value="<?= isset($_POST['emailUpdate']) ? $_POST['emailUpdate'] : $_SESSION['user']['userEmail'] ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['emailUpdate']) ? $errorMessages['emailUpdate'] : '' ?></small>
                </div>
                <div class="form-group">
                    <label for="emailComfirmation">Confirmez votre adresse mail :</label>
                    <input type="email" name="emailUpdateComfirmation" id="emailUpdateComfirmation" class="form-control <?= isset($_POST['emailUpdateComfirmation']) ? (!isset($errorMessages['emailUpdateComfirmation']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['emailUpdateComfirmation']) ? $_POST['emailUpdateComfirmation'] : '' ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['emailUpdateComfirmation']) ? $errorMessages['emailUpdateComfirmation'] : '' ?></small>
                </div>
                <input type="submit" class="btn updateBtn" name="userEmailUpdate" id="userEmailUpdate" value="Modifier" />
            </div>
        </form>
    </div>
    <div class="collapse" id="updatePwForm">
        <form class="row m-0 d-flex justify-content-center mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="col-sm-12 col-md-4 updateUserForm">
                <div class="form-group">
                    <label for="odlPassword">Ancien mot de passe :</label>
                    <input type="password" name="odlPassword" id="odlPassword" class="form-control <?= isset($_POST['odlPassword']) ? (!isset($errorMessages['odlPassword']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['odlPassword']) ? $_POST['odlPassword'] : '' ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['odlPassword']) ? $errorMessages['odlPassword'] : '' ?></small>
                </div>
                <div class="form-group">
                    <label for="passwordUpdate">Mot de passe :</label>
                    <input type="password" name="passwordUpdate" id="passwordUpdate" class="form-control <?= isset($_POST['passwordUpdate']) ? (!isset($errorMessages['passwordUpdate']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['passwordUpdate']) ? $_POST['passwordUpdate'] : '' ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['passwordUpdate']) ? $errorMessages['passwordUpdate'] : '' ?></small>
                </div>
                <div class="form-group">
                    <label for="passwordUpdateComfirmation">Confirmez votre mot de passe :</label>
                    <input type="password" name="passwordUpdateComfirmation" id="passwordUpdateComfirmation" class="form-control <?= isset($_POST['passwordUpdateComfirmation']) ? (!isset($errorMessages['passwordUpdateComfirmation']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['passwordUpdateComfirmation']) ? $_POST['passwordUpdateComfirmation'] : '' ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['passwordUpdateComfirmation']) ? $errorMessages['passwordUpdateComfirmation'] : '' ?></small>
                </div>
                <input type="submit" name="userPwUpdate" id="userPwUpdate" value="Modifier" class="btn updateBtn" />
            </div>
        </form>
    </div>
    <div id="deleteButtonContainer">
        <div class="row d-flex justify-content-center m-0">
            <div class="col-sm-12 col-md-4 text-center">
                <button class="btn btn-danger" data-toggle="collapse" data-target="#deleteUserForm"><i class="fas fa-exclamation-triangle"></i> Supprimer mon compte</button>
            </div>
        </div>
    </div>
    <div class="collapse" id="deleteUserForm">
        <form class="row m-0 d-flex justify-content-center mt-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="col-sm-12 col-md-4" id="deleteUserFormContainer">
                <p>Vous pouvez supprimer votre compte ici. <br />
                    <span class="text-danger">Attention, cette action est irréversible !</span></p>
                <div class="form-group">
                    <label for="deletePassword">Mot de passe :</label>
                    <input type="password" name="deletePassword" id="deletePassword" class="form-control <?= isset($_POST['deletePassword']) ? (!isset($errorMessages['deletePassword']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['deletePassword']) ? $_POST['deletePassword'] : '' ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['deletePassword']) ? $errorMessages['deletePassword'] : '' ?></small>
                </div>
                <div class="form-group">
                    <p>Veuillez taper la phrase suivante dans le champ ci-dessous sans les guillemets : <br />
                    "Je désire supprimer mon compte."</p>
                    <label for="confirmationSentence">Phrase de confirmation :</label>
                    <input type="text" name="confirmationSentence" id="confirmationSentence" class="form-control <?= isset($_POST['confirmationSentence']) ? (!isset($errorMessages['confirmationSentence']) ? 'is-valid' : 'is-invalid') : '' ?>" value="<?= isset($_POST['confirmationSentence']) ? $_POST['confirmationSentence'] : '' ?>" required />
                    <small class="text-danger"><?= isset($errorMessages['confirmationSentence']) ? $errorMessages['confirmationSentence'] : '' ?></small>
                </div>
                <input type="submit" name="deleteUser" id="deleteUser" value="Supprimer" class="btn btn-danger" />
            </div>
        </form>
    </div>
</div>
<?php
include_once 'includes/footer.php';
