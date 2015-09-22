<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once(__DIR__ . '/include/functions.php');
include_once(__DIR__ . '/dao/connection/DAO.php');
include_once(__DIR__ . '/dao/connection/Connection.class.php');
include_once(__DIR__ . '/include/config.php');



if (!empty($_GET['page']) && file_exists('api/' . $_GET['page'] . '.php')) {

    include_once(__DIR__ . '/api/' . $_GET['page'] . '.php');
} else {
    echo '<meta http-equiv="refresh" content="0.0001;url=accueil">';
}
