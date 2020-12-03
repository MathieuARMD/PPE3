<?php

class PeriodeDAO extends DAO
{
  
  /**
  * Constructeur
  */
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($year)
    {
        $sql = "select * from periode where annee_per= :year";
        try {
            $params = array(":year" => $year);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $periode=null;
        if ($row) {
            $periode = new Periode($row);
        }
        return $periode;
    } // function find()
    
    public function findperiode()
    {
        $sql = "select annee_per from periode";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findperiode()

    public function findDisabled()
    {
        $sql = "select * from periode where statut_per=1";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findDisabled()
 
    public function findAll()
    {
        $sql = "select * from periode";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;        
    } // function findAll()

    public function insert($periode)
    {
        $sql = "INSERT INTO periode(`annee_per`, `forfait_km_per`, `statut_per`) 
        values (:annee, :forfait, :statut)";
        $params = array(
          ":annee" => $periode->get_annee(),
          ":forfait" => $periode->get_forfait(),
          ":statut" => $periode->get_statut()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()

  
    public function update($periode)
    {           
        $sql = "UPDATE  periode SET forfait_km_per=:forfait WHERE annee_per=:annee";
        $params = array(
          ":annee" => $periode->get_annee(),
          ":forfait" => $periode->get_forfait(),
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // update()

    public function disalbedornot($annee)
    {
        $sql = "SELECT statut_per FROM periode WHERE annee_per=:annee";
        try {
            $params = array(":annee" => $annee);
            $sth=$this->executer($sql, $params);
            $rows = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        foreach($rows as $row){
            $val = $row;
        }
        return $val;
    } // function disalbedornot()

    public function Disabled($annee, $val)
    {
        if($val == 1)
        {
            $sql = "UPDATE periode SET statut_per = 0 WHERE annee_per = :annee";
            $params = array(":annee" => $annee);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb+1;// Retourne le nombre de mise à jour
            
        }else{
            $sql = "UPDATE periode SET statut_per = 1 WHERE annee_per = :annee";
            $params = array(":annee" => $annee);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        }
        return $nb;// Retourne le nombre de mise à jour
    } // update()

    public function statutest(){
        $sql="SELECT annee_per,COUNT(statut_per) AS stat FROM periode WHERE statut_per=0";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    }
    
} // Class PeriodeDAO
