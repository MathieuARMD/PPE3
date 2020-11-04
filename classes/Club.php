<?php 

class Club{

   private $id_club;
   private $lib_club;
   private $adr1_club;
   private $adr2_club;
   private $adr3_club;

    
   public function __construct(array $tableau = null)
   {
       if ($tableau != null) {
           $this->fill($tableau);
       }
   }

/////////////getter/////////////////
   function get_idc() {
     return $this->id_club;
   }

   function get_libc() {
     return $this->lib_club;
   }

   function get_adr1() {
     return $this->adr1_club;
   }

   function get_adr2() {
     return $this->adr2_club;
   }

   function get_adr3() {
     return $this->adr3_club;
   }


/////////////////////setter///////////////
   function set_id($id) {
     $this->id_club = $id;
   }

   function set_lib($lib) {
     $this->lib_club = $lib;
   }

   function set_adr1($adr1) {
     $this->adr1_club = $adr1;
   }

   function set_adr2($adr2) {
     $this->adr2_club = $adr2;
   }

   function set_adr2($adr3) {
     $this->adr3_club = $adr3;
   }

////////////////Hydrateur///////////////////////
   public function fill(array $tableau)
   {
       foreach ($tableau as $cle => $valeur) {
           $methode = 'set_' . $cle;
           if (method_exists($this, $methode)) {
               $this->$methode($valeur);
           }
       }
   }


   public function dump()
   {
       return get_object_vars($this);
   }


   public function afficher()
   {
       $tableau = $this->dump();
       $html = '<ul>';
       foreach ($tableau as $cle=>$valeur) {
           $html .= '<li>' . $cle . ' = '.$valeur. '</li>';
       }
       $html .= '</ul>';
       return $html;
   }
}

?>