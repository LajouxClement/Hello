<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$factureDAO = new FactureDAO();

if (isset($_POST['getStatsBills']) && $_POST['getStatsBills'] === "true") {
    $arr = array();
    foreach($factureDAO->request() as $data){
        $facture = new Facture($data->id_fa, $data->num_fac, date('d/m/Y', $data->date_creation_facture), '', $data->tva, '', '', '', '');
        array_push($arr, array("id" => $facture->getId(), "numFac" => $facture->getNumFacture(), 'date' => $facture->getDateCreationFacture(), "tva" => $facture->getTva()));
        
    }
    exit(json_encode($arr));
    
}