<?php 

class LigueDAO extends DAO 
{
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($idl)
    {
        $sql = "select * from ligue where id_ligue= :id_ligue";
        try {
            $params = array(":id_ligue" => $idl);
            $sth=$this->executer($sql, $params);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        foreach($rows AS $row)
            $ret = $row;
        return $ret;
    } // function find()

    public function findid($lib)
    {
        $sql = "select id_ligue from ligue where lib_ligue= :lib_ligue";
        try {
            $params = array(":lib_ligue" => $lib);
            $sth=$this->executer($sql, $params);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        foreach($rows as $row)
            $ligue = $row['id_ligue'];
        return $ligue;
    } // function findid()

    public function findlib()
    {
        $sql = "select lib_ligue from ligue";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findligue()

    public function findperiode()
    {
        $sql = "select id_ligue from ligue";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findperiode()

    public function findmail()
    {
        $sql = "select email_util from utilisateur where id_type_util=2";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findmail()

    public function findAll()
    {
        $sql = "select * from ligue";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;        
    } // function findAll()

    
    public function insert($ligue)
    {
        $sql = "INSERT INTO ligue(`lib_ligue`, `URL_ligue`, `contact_ligue`,`telephone_ligue`,`email_util`) 
        values (:lib,:url_,:contact,:tel,:email)";
        $params = array(
          ":lib" => $ligue->get_lib(),
          ":url_" => $ligue->get_url(),
          ":contact" => $ligue->get_contact(),
          ":tel" => $ligue->get_telephone(),
          ":email" => $ligue->get_email()
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()


    public function update($ligue)
    {           
        $sql = "UPDATE  ligue SET id_ligue=:id_ligue, lib_ligue=:lib, URL_ligue=:url, contact_ligue=:contact, telephone_ligue=:telephone, email_util=:email WHERE id_ligue=:id_ligue";
        $params = array(
            ":id_ligue"=> $ligue->get_id(),
            ":lib" => $ligue->get_lib(),
            ":url" => $ligue->get_url(),
            ":contact" => $ligue->get_contact(),
            ":telephone" => $ligue->get_telephone(),
            ":email" => $ligue ->get_email()
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
        {
            $sql = "DELETE FROM ligue WHERE id_ligue=:id";
            $params = array(":id" => $id);
            try {
                $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
                $nb = $sth->rowcount();
            } catch (PDOException $e) {
                die("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $nb;  // Retourne le nombre de mise à jour
        }


    }

    public function getPeriodesByLigue($idligue)
    {
         $sql = "SELECT DISTINCT annee_per
        FROM ligne_de_frais L, adherent A, club C
        WHERE L.email_util=A.email_util
        AND A.id_club=C.id_club
        AND C.id_ligue = :idligue";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
            ":idligue" => $idligue
        ));
        $rows=$sth->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    }

    public function getLigueActive()
    {
        $sql = "SELECT DISTINCT L.id_ligue, lib_ligue
        FROM ligne_de_frais Ldf, adherent A, club C, ligue L
        WHERE Ldf.email_util=A.email_util
        AND A.id_club=C.id_club
        AND C.id_ligue=L.id_ligue";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
        $rows=$sth->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    }
}
?>