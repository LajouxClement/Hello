<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($class_name) {
    try {
        if (file_exists(__DIR__ . '/../model/' . $class_name . '.class.php')) {
            include(__DIR__ . '/../model/' . $class_name . '.class.php');
        }
        if (file_exists(__DIR__ . '/../dao/objects/' . $class_name . '.php')) {
            include(__DIR__ . '/../dao/objects/' . $class_name . '.php');
        }
    } catch (Exception $ex) {
        echo "Erreur lors du chargement de la page " . $ex->getMessage();
    }
}

function secure($text) {
    $secure = htmlspecialchars(trim($text));
    return $secure;
}

$n = (isset($_GET['n']) && !empty($_GET['n'])) ? (int) $_GET['n'] : 1;

function active($page) { //utilisé dans le menu
    return ($_GET['page'] == $page ? 'class="active"' : '');
}

function title() {
    $title = "";
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'login':
                $title = "Connexion";
                break;
            case 'accueil':
                $title = "Accueil";
                break;
            case 'gestion_client':
                $title = "Clients";
                break;
            case 'gestion_facture':
                $title = "Factures";
                break;
            case 'gestion_devis':
                $title = "Devis";
                break;
            case '404':
                $title = "Not found";
                break;
            case 'logout':
                $title = "Déconnexion";
                break;
            case 'gestion_ville':
                $title = "Ville";
                break;
            case 'gestion_prestation':
                $title = "Prestation";
                break;
            case 'search':
                $title = "Rechercher";
                break;
        }
    }
    return $title;
}

function chrono() { //test vitesse des pages [mode debug only]
    $temps = explode(' ', microtime());

    return $temps[0] + $temps[1];
}

$debut = chrono();

function checkMail($text) {
    return preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $text);
}

function intToHour($int){
    return (!empty(explode('.', $int)[1])) ? str_replace('.5', ' H 30',$int) : $int.' H 00';
}
