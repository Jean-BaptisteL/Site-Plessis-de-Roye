<?php

$errorMessages = array();
//Verification du formulaire d'inscription
if (isset($_POST['userRegistration'])) {
    $users = new users();
    if (!empty($_POST['firstnameRegistration'])) {
        $users->firstname = htmlspecialchars($_POST['firstnameRegistration']);
    } else {
        $errorMessages['firstnameRegistration'] = 'Veuillez renseigner un prénom.';
    }
    if (!empty($_POST['lastnameRegistration'])) {
        $users->lastname = htmlspecialchars($_POST['lastnameRegistration']);
    } else {
        $errorMessages['lastnameRegistration'] = 'Veuillez renseigner un nom.';
    }
    if (!empty($_POST['emailRegistration']) && !empty($_POST['emailComfirmation'])) {
        if (filter_var($_POST['emailRegistration'], FILTER_VALIDATE_EMAIL)) {
            if ($_POST['emailRegistration'] == $_POST['emailComfirmation']) {
                $users->email = htmlspecialchars($_POST['emailRegistration']);
            } else {
                $errorMessages['emailComfirmation'] = 'Les deux adresses mail doivent être identiques.';
            }
        } else {
            $errorMessages['emailRegistration'] = 'Veuillez entrer une adresse mail correcte.';
        }
    } else {
        $errorMessages['emailRegistration'] = 'Veuillez entrer une adresse mail et la confirmer.';
    }
    if (!empty($_POST['passwordRegistration']) && !empty($_POST['passwordComfirmation'])) {
        if ($_POST['passwordRegistration'] == $_POST['passwordComfirmation']) {
            $users->password = password_hash(htmlspecialchars($_POST['passwordRegistration']), PASSWORD_BCRYPT);
        } else {
            $errorMessages['passwordComfirmation'] = 'Les deux mots de passe ne sont pas identiques.';
        }
    } else {
        $errorMessages['passwordRegistration'] = 'Veuillez entrer un mot de passe et le confirmer.';
    }
    if (count($errorMessages) == 0) {
        $user = $users->checkIfUserExists();
        if ($user->userExists == 0) {
            //Création du hash
            $letter = 'a';
            $lettersMin = array();
            for ($i = 1; $i <= 26; $i++) {
                $lettersMin[] = $letter;
                $letter++;
            }
            $lettersMax = array_map('strtoupper', $lettersMin);
            $specialCharacters = array('$', 'ù', '%', '£', 'µ', '#', 'é', '&', 'è', 'ç', 'à', '<', '>', '§');
            $numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
            $charactersArray = array_merge($lettersMin, $lettersMax, $specialCharacters, $numbers);
            $hash = '';
            for ($i = 1; $i <= 50; $i++) {
                shuffle($charactersArray);
                $randomNumber = random_int(0, rand(0, count($charactersArray) - 1));
                $hash .= $charactersArray[$randomNumber];
            }
            $users->hash = htmlspecialchars($hash);
            $users->type = 'utilisateurClassique';
            $users->addNewUser();
            $errorMessages['success'] = 'Inscription réussie !';
        } else {
            $errorMessages['firstnameRegistration'] = $errorMessages['lastnameRegistration'] = $errorMessages['emailRegistration'] = 'Cet utilisateur ou cette adresse mail existe déjà.';
        }
    }
}

