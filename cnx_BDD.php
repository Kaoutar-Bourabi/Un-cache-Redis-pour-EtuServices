<?php 
    
    try
    
    {
        //connexion a base de donnée local 
        $bdd = new PDO ("mysql:host=localhost;dbname=info834-redis;charset=utf8", "root", "");
        
    }catch(Exception $e)

    {
        
        echo $e->getmessage();

    }

?>











