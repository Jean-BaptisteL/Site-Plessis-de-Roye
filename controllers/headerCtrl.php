<?php
if (isset($_POST['userLogin'])) {
    $users = new users();
    $errorMessagesForLogin = array();
    if (!empty($_POST['userEmail'])) {
        $users->email = htmlspecialchars($_POST['userEmail']);
        $checkUserNameExists = $users->checkIfUserExists();
        if ($checkUserNameExists->userExists == 1) {
            if (!empty($_POST['userPassword'])) {
                $usersPassword = htmlspecialchars($_POST['userPassword']);
            } else {
                $errorMessagesForLogin['userPassword'] = 'Veuillez entrer votre mot de passe.';
            }
        } else {
            $errorMessagesForLogin['errorLogin'] = 'Adresse mail ou mot de passe incorrectes !';
        }
    } else {
        $errorMessagesForLogin['userEmail'] = 'Veuillez entrer votre adresse mail.';
    }
    if (count($errorMessagesForLogin) == 0) {
        $userInfosForLogin = $users->getUserInfos();
        if (password_verify($usersPassword, $userInfosForLogin->password)) {
            $_SESSION['user']['userId'] = $userInfosForLogin->id;
            $_SESSION['user']['userFirstname'] = $userInfosForLogin->firstname;
            $_SESSION['user']['userLastname'] = $userInfosForLogin->lastname;
            $_SESSION['user']['userType'] = $userInfosForLogin->type;
            $_SESSION['user']['userEmail'] = $userInfosForLogin->email;
            $_SESSION['user']['userPassword'] = $userInfosForLogin->password;
        } else {
            $errorMessagesForLogin['errorLogin'] = 'Adresse mail ou mot de passe incorrectes !';
        }
    }
}
//Déconnexion
if (isset($_GET['signOut'])) {
    if ($_GET['signOut'] == 'true') {
        unset($_SESSION['user']);
        header('location: index.php');
        exit();
    }
}

