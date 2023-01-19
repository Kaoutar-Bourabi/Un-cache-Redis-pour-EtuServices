<?php
include("cnx_BDD.php");
//$connection = $_POST['connection'];

if(isset($connection)){
    $users = $conn -> query('SELECT * FROM `utilisateur`');
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    while($user = $users -> fetch()){
        if($user['email'] == $email && $user['mdp'] == $mdp){
            session_start();
            echo 'Connected !';
            $cmd = `C:\Users\PC\AppData\Local\Microsoft\WindowsApps\python.exe test.py`;
            $path = escapeshellcmd($cmd);
            $output = shell_exec($path);
            $_SESSION["connection"] = $output;
            header("Location: accueil.php"); 
        }
    }
}
?> 


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Email :
        </label>
        <input type=" text" placeholder="Email" name="email" require>

        <label>
            Mot de passe :
        </label>
        <input type="password" placeholder="Mot de passe" name="mdp" require>

        <button type="submit" name="connection">Se connecter</button>
    </form>
</body>

</html>