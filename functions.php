<?php

function enregistrerFichierEnvoye(array $infoFichier): string
{
    // récupérer en chaine de caractère la valeur de l'intant t en en seconde, et prend référence à l'heure Uniw
    $timestamp = strval(time());
    //récupérer les information à propos du fichier, par exemple fichier.html
    $extension = pathinfo(basename($infoFichier["name"]), PATHINFO_EXTENSION);
    // déclarer une variable sous forme produit_tempsEnSecondeHeureUnix.nomDuFichier.php
    $nomDuFichier = 'produit_' . $timestamp . '.' . $extension;
    //Variable qui indique le répertoire du dossier uploads
    $dossierStockage = __DIR__ . '/uploads/';

    if (file_exists($dossierStockage) === false)//Vérifie si le répertoire du dossier uploads est inexistant
    {
        mkdir($dossierStockage);// S'il n'existe pas, il crée ce dossier uploads
    }

    move_uploaded_file($infoFichier["tmp_name"], $dossierStockage . $nomDuFichier);///On effectue un déplacement du fichier $infoFichier['tmp_name'] vers la destinatination finale
    return '/uploads/' . $nomDuFichier; // On retourne la destination finale
}

function onVaRediriger(string $path)
{
    header('LOCATION: /produit-crud/router.php' . $path);//Nous redirige vers le fichier router.php
    die();//Fait arrêter le script
}