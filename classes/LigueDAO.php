<?php 

class LigueDAO extends DAO {
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($idl)
    {
        $sql = "select * from ligue where id_ligue= :id_ligue";
        try {
            $params = array(":id_ligue" => $id_ligue);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $ligue=null;
        if ($row) {
            $ligue = new Ligue($row);
        }
        return $Ligue;
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

    public function findDisabled()
    {
        $sql = "select * from ligue where id_ligue= :id_ligue";
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
        $sql = "INSERT INTO ligue(`lib_ligue`, `URL_ligue`, `contact_ligue`,`telephone_ligue`) 
        values (:lib, :url, :contact, :tel)";
        $params = array(
          ":lib" => $ligue->get_lib(),
<<<<<<< HEAD
          ":url" => $ligue->get_url(),
          ":contact" => $ligue->get_contact(),
          ":tel" => $ligue->get_telephone()
=======
          ":urll" => $ligue->get_urll(),
          ":contact" => $ligue->get_contact(),
          ":tel" => $ligue->get_tel()
>>>>>>> 1fc7a5215f041cd04d2a286dff3634e94850ab74
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
    $sql = "UPDATE  ligue SET lib_ligue=:lib, URL_ligue=:url, contact_ligue=:contact, telephone_ligue=:tel WHERE annee_per=:annee";
    $params = array(
        ":lib" => $ligue->get_lib(),
<<<<<<< HEAD
        ":url" => $ligue->get_url(),
        ":contact" => $ligue->get_contact(),
        ":tel" => $ligue->get_telephone()
=======
        ":urll" => $ligue->get_urll(),
        ":contact" => $ligue->get_contact(),
        ":tel" => $ligue->get_tel()
>>>>>>> 1fc7a5215f041cd04d2a286dff3634e94850ab74
    );
    try {
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
    } catch (PDOException $e) {
        die("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    return $nb;  // Retourne le nombre de mise à jour
} // update()



}//class

?>