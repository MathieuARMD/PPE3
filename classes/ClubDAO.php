<?php 

class clubDAO extends DAO {
    
    public function __construct()
    {
        parent::__construct();
    }
  
    public function find($idc)
    {
        $sql = "select * from club where id_club= :id_club";
        try {
            $params = array(":id_club" => $id_club);
            $sth=$this->executer($sql, $params);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $club=null;
        if ($row) {
            $club = new club($row);
        }
        return $club;
    } // function find()

    public function findclub()
    {
        $sql = "select id_club from club";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;
    } // function findclub()

    public function findDisabled()
    {
        $sql = "select * from club where id_club= :id_club";
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
        $sql = "select * from club";
        try {
            $sth=$this->executer($sql);
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $rows;        
    } // function findAll()

    
    public function insert($club)
    {
        $sql = "INSERT INTO club(`lib_club`, `adr1_club`, `adr2_club`,`adr3_club`) 
        values (:libc, :adr1, :adr2, :adr3)";
        $params = array(
          ":libc" => $club->get_libc(),
          ":adr1" => $club->get_adr1(),
          ":adr2" => $club->get_adr2(),
          ":adr3" => $club->get_adr3(),
        );
        try {
            $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
            $nb = $sth->rowcount();
        } catch (PDOException $e) {
            die("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        return $nb;  // Retourne le nombre de mise à jour
    } // insert()


public function update($club)
{           
    $sql = "UPDATE  club SET lib_club=:libc, adr1_club=:adr1, adr2_club=:adr2, adr3_club=:adr3 WHERE id_club=:idc";
    $params = array(
        ":idc" => $club->get_idc(),
        ":lib" => $club->get_libc(),
        ":urll" => $club->get_urll(),
        ":contact" => $club->get_contact(),
        ":tel" => $club->get_tel(),
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