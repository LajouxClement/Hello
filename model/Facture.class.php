<?php

/*
 * The MIT License
 *
 * Copyright 2015 Ludovic Sanctorum <ludovic.sanctorum@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of Facture
 *
 * @author Ludo
 */
class Facture {

    //put your code here

    private $id;
    private $numFacture;
    private $dateCreationFacture;
    private $modeReglement;
    private $tva; //taux de TVA
    private $nbHeure;
    private $prixUnitaire;
    private $acompte;
    private $datePaiement;

    function __construct($id, $numFacture, $dateCreationFacture, $modeReglement, $tva, $nbHeure, $prixUnitaire, $acompte, $datePaiement) {
        $this->id = $id;
        $this->numFacture = $numFacture;
        $this->dateCreationFacture = $dateCreationFacture;
        $this->modeReglement = $modeReglement;
        $this->tva = $tva;
        $this->nbHeure = $nbHeure;
        $this->prixUnitaire = $prixUnitaire;
        $this->acompte = $acompte;
        $this->datePaiement = $datePaiement;
    }

        function getId() {
        return $this->id;
    }

    function getNumFacture() {
        return $this->numFacture;
    }

    function getDateCreationFacture() {
        return $this->dateCreationFacture;
    }

    function getModeReglement() {
        return $this->modeReglement;
    }

    function getTva() {
        return $this->tva.'%';
    }

    function getNbHeure() {
        return $this->nbHeure;
    }

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getAcompte() {
        return $this->acompte;
    }

    function getDatePaiement() {
        return $this->datePaiement;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumFacture($numFacture) {
        $this->numFacture = $numFacture;
    }

    function setDateCreationFacture($dateCreation) {
        $this->dateCreationFacture = $dateCreation;
    }

    function setModeReglement($modeReglement) {
        $this->modeReglement = $modeReglement;
    }

    function setTva($tva) {
        $this->tva = $tva;
    }

    function setNbHeure($nbHeure) {
        $this->nbHeure = $nbHeure;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setAcompte($acompte) {
        $this->acompte = $acompte;
    }

    function setDatePaiement($datePaiement) {
        $this->datePaiement = $datePaiement;
    }

    function montantHT() { //montant TOTAL HT
        $calcul = $this->nbHeure * $this->prixUnitaire;
        //return round($this->nbHeure * $this->prixUnitaire, 2).'€';
        //return number_format($calcul, 2, ',', ' ') . '€';
        return $calcul;
    }

    function prixTVA() { //prix de la TVA par exemple 5.5% de 50€ = 2.75
        //return round($this->montantHT()*($this->tva /100),2).'€';
        $calcul = $this->montantHT() * ($this->tva / 100);
        //return number_format($calcul, 2, ',', ' ') . '€';
        return $calcul;
    }

    function montantTTC() {
        //return round($this->montantHT() + ($this->tva * $this->montantHT() / 100), 2).'€';
        $calcul = $this->montantHT() + ($this->tva * $this->montantHT() / 100);
        //return number_format($calcul, 2, ',', ' ') . '€';
        return $calcul;
    }

    function netAPayer() {
        $calcul = $this->montantTTC() - $this->acompte;
        //return round($this->montantTTC() - $this->acompte,2).'€';
        //return number_format($calcul, 2, ',', ' ') . '€';
        return $calcul;
    }

}
