<?php 

class Ldf{  //ligne de frais

   private $id_ldf;
   private $date_ldf;
   private $lib_trajet_ldf;
   private $cout_peage_ldf;
   private $cout_hebergement_ldf;
   private $nb_km_ldf;
   private $total_km_ldf;
   private $total_ldf;
   private $id_mdf; // id motif de frais
   private $annee_per;
   private $email_util;

    
   public function __construct(array $tableau = null)
   {
       if ($tableau != null) {
           $this->fill($tableau);
       }
   }

/////////////getter/////////////////
   function get_id() {
     return $this->id_ligue;
   }

   function get_lib() {
     return $this->lib_ligue;
   }

   function get_url() {
     return $this->URL_ligue;
   }

   function get_contact() {
     return $this->contact_ligue;
   }

   function get_telephone() {
     return $this->telephone_ligue;
   }


/////////////////////setter///////////////
   function set_id($id) {
     $this->id_ligue = $id;
   }

   function set_lib($lib) {
     $this->lib_ligue = $lib;
   }

   function set_url($URL) {
     $this->URL_ligue = $URL;
   }

   function set_contact($contact) {
     $this->contact_ligue = $contact;
   }

   function set_telephone($telephone) {
     $this->telephone_ligue = $telephone;
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