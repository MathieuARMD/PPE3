<?php 

class LdfDAO extends DAO {
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($Ldf)
    {
        $sql = "select * from ligne_de_frais where id_ldf= :id_ldf";
        try {
            $params = array(":id_ldf" => $id_ldf);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $ldf=null;
        if ($row) {
            $ldf = new Ldf($row);
        }
        return $ldf;
    } // function find()

    public function get_id($lib)
    {
        $sql = "select id_ldf from ligne_de_frais where lib_trajet_ldf= :lib_ldf";
        try {
            $params = array(":lib_ldf" => $lib);
            $sth=$this->executer($sql, $params);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        foreach($rows as $row) {
            $Ldf = $row['id_ldf'];
        }
        return $Ldf;
    } // function findid()

    public function get_lib()
    {
        $sql = "select lib_trajet_ldf from ligne_de_frais";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findlib()

    public function findAll()
    {
        $sql = "select * from ligne_de_frais";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;        
    } // function findAll()

    public function insert($Ldf)
    {
        $sql = "INSERT INTO `ligne_de_frais`(`id_ldf`, `date_ldf`, `lib_trajet_ldf`, `cout_peage_ldf`, `cout_repas_ldf`, `cout_hebergement_ldf`, `nb_km_ldf`, `total_km_ldf`, `total_ldf`, `id_mdf`, `annee_per`, `email_util`) 
        values (:id_ldf, :date_ldf, :lib_ldf,:cout_p_ldf,:cout_r_ldf,:cout_h_ldf,:nb_km_ldf,:total_km_ldf,:total_ldf,:id_mdf,:annee_per,:email_util)";
        $params = array(
          ":id_ldf" => $Ldf->get_id(),
          ":date_ldf" => $Ldf->get_date(),
          ":lib_ldf" => $Ldf->get_lib(),
          ":cout_p_ldf" => $Ldf->get_coutp(),
          ":cout_r_ldf" => $Ldf->get_coutr(),
          ":cout_h_ldf" => $Ldf->get_couth(),
          ":nb_km_ldf" => $Ldf->get_nbkm(),
          ":total_km_ldf" => $Ldf->get_tkm(),
          ":total_ldf" => $Ldf->get_tldf(),
          ":id_mdf" => $Ldf->get_idmdf(),
          ":annee_per" => $Ldf->get_anneeper(),
          ":email_util" => $Ldf->get_email(),
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()


public function update($Ldf)
{           
    $sql = "UPDATE `ligne_de_frais` SET `date_ldf`=:date_ldf,`lib_trajet_ldf`=:lib_ldf,`cout_peage_ldf`=:cout_p_ldf,`cout_repas_ldf`=:cout_r_ldf,`cout_hebergement_ldf`=:cout_h_ldf,`nb_km_ldf`=:nb_km_ldf,`total_km_ldf`=:total_km_ldf,`total_ldf`=:total_ldf,`id_mdf`=:id_mdf,`annee_per`=:annee_per,`email_util`=:email_util  WHERE annee_per=:annee_per";
    $params = array(
        ":id_ldf" => $Ldf->get_id(),
        ":date_ldf" => $Ldf->get_date(),
        ":lib_ldf" => $Ldf->get_lib(),
        ":cout_p_ldf" => $Ldf->get_coutp(),
        ":cout_r_ldf" => $Ldf->get_coutr(),
        ":cout_h_ldf" => $Ldf->get_couth(),
        ":nb_km_ldf" => $Ldf->get_nbkm(),
        ":total_km_ldf" => $Ldf->get_tkm(),
        ":total_ldf" => $Ldf->get_tldf(),
        ":id_mdf" => $Ldf->get_idmdf(),
        ":annee_per" => $Ldf->get_anneeper(),
        ":email_util" => $Ldf->get_email(),
    );
    try {
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
    } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    return $nb;  // Retourne le nombre de mise à jour
} // update()

public function delete($id)
    {
        $sql = "DELETE FROM ligne_de_frais WHERE id_ldf=:id_ldf";
        $params = array(":id_ldf" => $id);
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    }

}//class

?>