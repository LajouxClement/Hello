<?php

//include(__DIR__.'/../connection/DAO.php');
//include(__DIR__.'/../connection/DAOConnection.class.php');
class FactureDAO extends DAO {

    private $connexion;

    public function __construct() {
        $co = new Connection();
        $this->connexion = $co->getConnection();
    }

    public function create($obj) {

        $query = $this->connexion->prepare("INSERT INTO factures(id_fa,num_fac,date_creation_facture,mode_reglement,tva,prix_unitaire,nb_heure,acompte,date_paiement) VALUES(?,?,?,?,?,?,?,?,?)");
        $query->bindValue(1, NULL, PDO::PARAM_INT);
        $query->bindValue(2, $obj->getNumFacture(), PDO::PARAM_STR);
        $query->bindValue(3, time(), PDO::PARAM_STR);
        $query->bindValue(4, $obj->getModeReglement(), PDO::PARAM_STR);
        $query->bindValue(5, $obj->getTva(), PDO::PARAM_STR);
        $query->bindValue(6, $obj->getPrixUnitaire(), PDO::PARAM_STR);
        $query->bindValue(7, $obj->getNbHeure(), PDO::PARAM_STR);
        $query->bindValue(8, $obj->getAcompte(), PDO::PARAM_STR);
        $query->bindValue(9, $obj->getDatePaiement(), PDO::PARAM_STR);
        $query->execute();
        return $this->connexion->lastInsertId();
    }

    public function delete($obj) {
        
    }

    public function request() {

        $query = $this->connexion->query("SELECT * FROM factures");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($obj) {

        $query = $this->connexion->prepare("UPDATE factures SET mode_reglement = ?, tva = ?, id_date_rea = ?, date_paiement = ?,nb_heure = ?, acompte = ? WHERE id_fa = ?");
        $query->bindValue(1, $obj->getModeReglement(), PDO::PARAM_STR);
        $query->bindValue(2, $obj->getTva(), PDO::PARAM_STR);
        $query->bindValue(3, $obj->getIdDateRealisation(), PDO::PARAM_INT);
        $query->bindValue(4, $obj->getDatePaiement(), PDO::PARAM_INT);
        $query->bindValue(5, $obj->getNbHeure(), PDO::PARAM_STR);
        $query->bindValue(6, $obj->getAcompte(), PDO::PARAM_STR);
        $query->bindValue(7, $obj->getId(), PDO::PARAM_INT);

        $query->execute();
    }

    public function getById($id) {

        $query = $this->connexion->prepare("SELECT * FROM factures F, facture_client FC, client C 
                                                WHERE F.id_fa = ?
                                                AND FC.id_client = C.id_cl
                                                AND FC.id_facture = F.id_fa");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getByIdAllData($id) {

        $query = $this->connexion->prepare("SELECT * FROM factures F, facture_client FC, client C, ville V, date_realisation DR
                                                WHERE F.id_fa = ?
                                                AND FC.id_facture = F.id_fa
                                                AND FC.id_client = C.id_cl
                                                AND C.id_ville = V.id_vi");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getInfoFactureClient($id) {
        $query = $this->connexion->prepare("SELECT * FROM facture_client FC JOIN factures ON factures.id_fa = FC.id_facture WHERE FC.id_client = ?");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLastId() {

        $query = $this->connexion->query("SELECT num_fac FROM factures ORDER BY id_fa DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);

        return $query;
    }

    /** utilisé pour la pagination * */
    public function getAllFacture($min, $max) {
        $query = $this->connexion->query("SELECT * FROM factures F, facture_client FC, client C WHERE "
                        . "FC.id_client = C.id_cl AND "
                        . "FC.id_facture = F.id_fa "
                        . "ORDER BY F.id_fa DESC LIMIT $min,$max")->fetchAll(PDO::FETCH_OBJ);

        return $query;
    }

    public function count() {
        return $this->connexion->query("SELECT * FROM factures")->rowCount();
    }

    public function search($name, $tel) {

        if (!empty($name)) {
            $query = $this->connexion->prepare("SELECT * FROM factures F, facture_client FC, client C WHERE "
                    . "FC.id_client = C.id_cl AND "
                    . "FC.id_facture = F.id_fa "
                    . "AND c.nom LIKE ?");
            $query->bindValue(1, "%$name%", PDO::PARAM_STR);
            $query->execute();
        } elseif (!empty($tel)) {
            $isMobile = (substr($tel, 0, 2) === '06' || substr($tel, 0, 2) === '07' ) ? TRUE : FALSE;
            $str1 = 'SELECT * FROM factures F, facture_client FC, client C WHERE FC.id_client = C.id_cl AND FC.id_facture = F.id_fa AND c.tel_mobile LIKE ?';
            $str2 = 'SELECT * FROM factures F, facture_client FC, client C WHERE FC.id_client = C.id_cl AND FC.id_facture = F.id_fa AND c.tel_fixe LIKE ?';
            $str = ($isMobile) ? $str1 : $str2;
            $query = $this->connexion->prepare($str);
            $query->bindValue(1, "%$tel%", PDO::PARAM_STR);
            $query->execute();
        }
        return (isset($query) && !empty($query)) ? $query->fetchAll(PDO::FETCH_OBJ) : FALSE;
    }

    public function sumHT() { //sum of all bill
        return $this->connexion->query("SELECT SUM( `nb_heure` * `prix_unitaire` ) AS sumHT FROM factures")->fetch(PDO::FETCH_OBJ);
    }

    public function sumTTC() {
        return $this->connexion->query('SELECT SUM((`nb_heure` * `prix_unitaire`) + (`tva` * (`nb_heure` * `prix_unitaire`) / 100)) AS sumTTC FROM factures')->fetch(PDO::FETCH_OBJ);
    }

    public function infoFacture($year) {

        $query = $this->connexion->prepare('SELECT * FROM factures WHERE date_creation_facture BETWEEN ? AND ?');
        $query->bindValue(1, mktime(0, 0, 0, 1, 1, $year), PDO::PARAM_INT);
        $query->bindValue(2, mktime(0, 0, 0, 12, 31, $year), PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function sumHTPerYear($year) { //sum of all bill
        $query = $this->connexion->prepare("SELECT nb_heure,prix_unitaire,date_creation_facture, tva FROM factures WHERE date_creation_facture BETWEEN ? AND ?");
        $query->bindValue(1, mktime(0, 0, 0, 1, 1, $year), PDO::PARAM_INT);
        $query->bindValue(2, mktime(0, 0, 0, 12, 31, $year), PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function BillsForChart($year) {
        $query = $this->connexion->prepare('SELECT COUNT(*) AS total FROM factures WHERE date_creation_facture BETWEEN ? AND ?');
        $query->bindValue(1, mktime(0, 0, 0, 1, 1, $year), PDO::PARAM_INT);
        $query->bindValue(2, mktime(0, 0, 0, 12, 31, $year), PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }

    
    public function sumHTForCharts($year) {
        $query = $this->connexion->prepare('SELECT SUM(`nb_heure` * `prix_unitaire`) AS sumHT FROM factures WHERE date_creation_facture BETWEEN ? AND ?');
        $query->bindValue(1, mktime(0, 0, 0, 1, 1, $year), PDO::PARAM_INT);
        $query->bindValue(2, mktime(0, 0, 0, 12, 31, $year), PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
        
    }

    public function sumTTCForCharts($year) {
        $query = $this->connexion->prepare('SELECT SUM((`nb_heure` * `prix_unitaire`) + (`tva` * (`nb_heure` * `prix_unitaire`) / 100)) AS sumTTC FROM factures WHERE date_creation_facture BETWEEN ? AND ?');
        $query->bindValue(1, mktime(0, 0, 0, 1, 1, $year), PDO::PARAM_INT);
        $query->bindValue(2, mktime(0, 0, 0, 12, 31, $year), PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
     public function getTenLastBills() {
        return $this->connexion->query("SELECT * FROM factures F, facture_client FC, client C WHERE "
                        . "FC.id_client = C.id_cl AND "
                        . "FC.id_facture = F.id_fa "
                        . "ORDER BY F.id_fa DESC LIMIT 0,10")->fetchAll(PDO::FETCH_OBJ);

    }

}
