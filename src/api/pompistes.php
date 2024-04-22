<?php

 session_start();

  $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';

  class sql2
  {
         private $connexion_sql2;
         
         function __construct()
         {   // initialiser la connexion PDO
 
             
            $this->connexion_bdd2 = new PDO("sqlsrv:Server=192.168.1.10;Database=CBLESSING_SQLOK", "blessing", "blessing", array(
             //PDO::ATTR_PERSISTENT => true,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         ));
           //  $this->connexion_bdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
         }
 
         public function requete2($requete, $code_station){
 
             $prepare = $this->connexion_bdd2->prepare($requete);
             $prepare->bindValue(1, $code_station); 
 
             return $prepare;
 
             
         }
 
         
  }

  class sql3
  {
         private $connexion_sql3;
         
         function __construct()
         {   // initialiser la connexion PDO
 
             
            $this->connexion_bdd3 = new PDO("sqlsrv:Server=192.168.1.10;Database=GBLESSING_SQLOK", "blessing", "blessing", array(
             //PDO::ATTR_PERSISTENT => true,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         ));
           //  $this->connexion_bdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
         }
 
         public function requete3($requete){
 
             $prepare = $this->connexion_bdd3->prepare($requete);
 
             return $prepare;
 
             
         }
 
         
  }

  class sql4
  {
         private $connexion_sql4 ;
         
         function __construct()
         {   // initialiser la connexion PDO
 
             
            $this->connexion_bdd4 = new PDO("sqlsrv:Server=192.168.1.10;Database=GBLESSING_SQLOK", "blessing", "blessing", array(
             //PDO::ATTR_PERSISTENT => true,
             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         ));
           //  $this->connexion_bdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
         }
 
         public function requete4($requete, $date_initiale){
 
             $prepare = $this->connexion_bdd4->prepare($requete);

             $prepare->bindValue(1, $date_initiale); 
 
             return $prepare;
 
             
         }
 
         
  }
   

$conn=mysqli_connect($host_name, $user_name, $password, $database);

 $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];
 $userEmail = $_SESSION['userEmail'];

 /**  Switch Case to Get Action from controller  **/

switch($_GET['action'])  {

    case 'get_pompistes' :
          get_pompistes();
          break;

     case 'addRgt_cli' :
          addRgt_cli();
          break;

     case 'getRgt_cli' :
          getRgt_cli();
          break;

     case 'get_cloture':
          get_cloture();
          break;

     case 'Etats_Decouvert' :
          Etats_Decouvert();
          break;

     case 'get_cloture_decouvert':

          get_cloture_decouvert();
          break;

     case 'Etats_Releve_echeance' :
          Etats_Releve_echeance();
          break;

     case 'Nettoyer_Reglement' :
          Nettoyer_Reglement();
          break;

     case 'Restaurer_Reglement' :
          Restaurer_Reglement();
          break;

     case 'Nettoyer_Depense' :
          Nettoyer_Depense();
          break;

     case 'Nettoyer_Coulage' :
          Nettoyer_Coulage();
          break;

     case 'Restaurer_Depense' :
          Restaurer_Depense();
          break;
     
     case 'Restaurer_Coulage' :
          Restaurer_Coulage();
          break;

     case 'Cloturer_Decouvert' :
          Cloturer_Decouvert();
          break;

     case 'Cloturer_Decouvert_Coulage' :
          Cloturer_Decouvert_Coulage();
          break;

     case 'Nettoyer_Livraison' :
          Nettoyer_Livraison();
          break;

     case 'Restaurer_Livraison' :
          Restaurer_Livraison();
          break;

     case 'get_client_gescom' :
          get_client_gescom();
          break;

     case 'get_client_all_gescom' :
          get_client_all_gescom();
          break;

     case 'add_pompiste' :
          add_pompiste();
          break;
     
     case 'get_controle_versement' :
          get_controle_versement();
          break;

     case 'edit_pompiste' :
     
          edit_pompiste();
          break;

     case 'edit_prix_produit' :

          edit_prix_produit();
          break;

     case 'get_pompistes_all' :
     
          get_pompistes_all();
          break;

    case 'get_ventes' :
            get_ventes();
            break;

     case 'get_versement' :
            get_versement();
            break;

     case 'get_versement_station' :
            get_versement_station();
            break;

    case 'get_stock' :
            get_stock();
            break;

    case 'get_stock_station' :
            get_stock_station();
            break;

     case 'get_livraison' :
            get_livraison();
            break;

      case 'get_livraison_station' :
            get_livraison_station();
            break;

    case 'get_ventes_station' :
            get_ventes_station();
            break;

    case 'get_heure' :
          get_heure();
          break;

     case 'get_heure_suppression' :
           get_heure_suppression();
           break;

     case 'supprimer_quart' :
           supprimer_quart();
           break;

    case 'get_cuves' :
            get_cuves();
            break;

     case 'get_pistolets' :
            get_pistolets();
            break;

    case 'get_produits' :
            get_produits();
            break;
       
     case 'get_produit_lubrifiant' :
            get_produit_lubrifiant();
            break;

     case 'get_produit_lubrifiant_all' :
          get_produit_lubrifiant_all();
          break;

    case 'get_produit_carburant' :
            get_produit_carburant();
            break;

     case 'Etats_Manquants' :
          Etats_Manquants();
          break;

     case 'Suivi_Manquants' :
          Suivi_Manquants();
          break;

     case 'Manquants_exceptionel' :
          Manquants_exceptionel();
          break;
     
     case 'Manquants_retenue' :
          Manquants_retenue();
          break;

     case 'Cloture_Manquants' :
          Cloture_Manquants();
          break;

     case 'Etats_Manquants_pompiste' :
          Etats_Manquants_pompiste();
          break;

     case 'Etats_Ventes_Lub' :
          Etats_Ventes_Lub() ;
          break;

     case 'Etats_Ventes_Gaz' :
               Etats_Ventes_Gaz() ;
               break;

     case 'Etats_Versements' :
          Etats_Versements();
          break;

     case 'Etats_Versements_ME' :
          Etats_Versements_ME();
          break;

     case 'Etats_Stock_Lubrifiant' :
          Etats_Stock_Lubrifiant();
          break;

     case 'Etats_Stock_Gaz' :
               Etats_Stock_Gaz();
               break;

     case 'get_produit_gaz' :
            get_produit_gaz();
            break;

     case 'get_produit_gaz_rechange' :
               get_produit_gaz_rechange();
               break;

    case 'get_transporteur' :
            get_transporteur();
            break;

     case 'get_client' :
            get_client();
            break;

     case 'get_client_all' :
          get_client_all();
          break;

     case 'get_station' :
            get_station();
            break;

     case 'get_index' :
            get_index();
            break;

    case 'addVte_carb' :
            addVte_carb();
            break;

     case 'addVte_lubri' :
            addVte_lubri();
            break;


      case 'Envoyer' :
            Envoyer();
            break;

       case 'Envoyer_Station' :
            Envoyer_Station();
            break;

       case 'Envoyer_Produit' :
            Envoyer_Produit();
            break;

       case 'Envoyer_Client' :
            Envoyer_Client();
            break;

       case 'Envoyer_Transporteur' :
            Envoyer_Transporteur();
            break;

     case 'livraison_carb_quart' :
          livraison_carb_quart();
          break;

     case 'livraison_lub_quart' :
          livraison_lub_quart();
          break;

     case 'Etats_Ventes' :
          Etats_Ventes();
          break;

     case 'Get_dates' :
          Get_dates();
          break;

     case 'Etats_Creances' :
          Etats_Creances();
          break;

     case 'Etats_Creances_Station' :
          Etats_Creances_Station();
          break;

     case 'Etats_Coulages' :
          Etats_Coulages();
          break;

     case 'Etats_Coulages_Station' :
          Etats_Coulages_Station();
          break;

     case 'Etats_Coulages_Reseau' :
          Etats_Coulages_Reseau();
          break;

     case 'Etats_Coulages_Station_Mensuel' :
          Etats_Coulages_Station_Mensuel();
          break;
     
     case 'Etats_Coulages_Lub_Station_Mensuel' :
          Etats_Coulages_Lub_Station_Mensuel();
          break;

     case 'Etats_Coulages_Reseau_Mensuel' :
          Etats_Coulages_Reseau_Mensuel();
          break;
     
     case 'Etats_Ventes_Station' :
          Etats_Ventes_Station();
          break;

     case 'Etats_Ventes_Reseau' :
          Etats_Ventes_Reseau();
          break;

     case 'Etats_Ventes_Station_Mensuel' :
          Etats_Ventes_Station_Mensuel();
          break;

     case 'Etats_Ventes_Reseau_Mensuel' :
          Etats_Ventes_Reseau_Mensuel();
          break;

     case 'Etats_Ventes_Reseau_Conso' :
          Etats_Ventes_Reseau_Conso();
          break;

     case 'Etats_Coulages_Conso' :
          Etats_Coulages_Conso();
          break;
     
    
     
}


function get_pompistes() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $res=mysqli_query($conn, "
       
       Select
       station.pompiste.id_pompiste,
       station.pompiste.matricule,
       station.pompiste.nom_pompiste,
       station.pompiste.prenom_pompiste,
       station.pompiste.date_naissance,
       station.pompiste.sexe,
       station.pompiste.date_embauche,
       station.pompiste.poste_occupe,
       station.nom_station
        From
        pompiste Inner Join
        station On station.pompiste.id_station = station.id_station
                  And station.pompiste.id_region = station.id_region
        Where
        station.pompiste.id_station = ".$id_station
       
       );
   
       $data = array();
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                  "id_pompiste"  => $rows['id_pompiste'],
                  "matricule"  => $rows['matricule'],
                   "nom_pompiste"  => $rows['nom_pompiste'],
                   "prenom"  => $rows['prenom_pompiste'],
                   "date_naissance"  => $rows['date_naissance'],
                   "sexe"  => $rows['sexe'],
                   "date_embauche"  => $rows['date_embauche'],
                   "poste_occupe"  => $rows['poste_occupe'],
                   "nom_station"  => $rows['nom_station']
                           
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}

function get_client_gescom() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
     $code_station = $_SESSION['code_station'];

     $data = json_decode(file_get_contents("php://input"));

       // $code_client  = $data->code_client ;

     

     $query = "

     Select
     F_COMPTET.CT_Num AS code_client,
     F_COMPTET.CT_Intitule AS nom_client
 From
     F_COMPTET
 Where
     F_COMPTET.CT_Num = :code_client
     
     " ;



          $sql = new sql2();
          $req = $sql->requete2( $query, $code_station);
          $req ->execute();
          $data  = $req->fetchAll(PDO::FETCH_OBJ) ;
     
          // var_dump($data) ;
   
        print_r(json_encode($data));
        return json_encode($data);  
      
       
      
   
}

function get_cloture() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $res=mysqli_query($conn, "

     Select
          DATE(cloture_manquant.date_ouverture) AS date_ouverture,
          DATE(cloture_manquant.date_fermerture) AS date_fermerture,
          cloture_manquant.commentaire
     From
          cloture_manquant

          ORDER BY cloture_manquant.date_fermerture DESC
     LIMIT 1;

       
      "
       
       );
   
       $data = array();
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                  "date_ouverture"  => $rows['date_ouverture'],
                  "date_fermerture"  => $rows['date_fermerture'],
                   "commentaire"  => $rows['commentaire'],
                           
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}

function get_cloture_decouvert() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
   
    $conn=mysqli_connect($host_name, $user_name, $password, $database);

    $data = json_decode(file_get_contents("php://input")) ;
   
    $requete = $data->decouvert ;

    $code_station = $requete->client->code_client ;
   
       $res=mysqli_query($conn, "

     Select
          DATE(cloture_decouvert.date_ouverture) AS date_ouverture,
          DATE(cloture_decouvert.date_fermerture) AS date_fermerture,
          cloture_decouvert.commentaire,
          cloture_decouvert.solde

     From
          cloture_decouvert
     
     WHERE cloture_decouvert.code_station = '$code_station'

          ORDER BY cloture_decouvert.date_fermerture DESC

     LIMIT 1;

       
      "
       
       );
   
       $data = array();
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                  "date_fermerture"  => $rows['date_fermerture'],

                  "date_ouverture" => date_format(date_add (date_create($rows['date_fermerture']), date_interval_create_from_date_string('1 days')) , 'Y-m-d')   ,

                  "commentaire"  => $rows['commentaire'] ,

                  "solde"  => $rows['solde']
                           
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}
   
function get_pompistes_all() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
     
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
     
     $res=mysqli_query($conn, "
     
     Select
     station.pompiste.id_pompiste,
     station.pompiste.matricule,
     station.pompiste.nom_pompiste,
     station.pompiste.prenom_pompiste,
     station.pompiste.date_naissance,
     station.pompiste.sexe,
     station.pompiste.date_embauche,
     station.pompiste.poste_occupe,
     station.nom_station
          From
          pompiste Inner Join
          station On station.pompiste.id_station = station.id_station
                    And station.pompiste.id_region = station.id_region
          "
     
     );
     
     $data = array();
     
          if (is_object($res)) {
     
          while($rows = mysqli_fetch_array($res))
     
          {
          $data[] = array(
     
                    "id_pompiste"  => $rows['id_pompiste'],
                    "matricule"  => $rows['matricule'],
                    "nom_pompiste"  => $rows['nom_pompiste'],
                    "prenom"  => $rows['prenom_pompiste'],
                    "date_naissance"  => $rows['date_naissance'],
                    "sexe"  => $rows['sexe'],
                    "date_embauche"  => $rows['date_embauche'],
                    "poste_occupe"  => $rows['poste_occupe'],
                    "station"  => $rows['nom_station']
                         
                    ) ;
          }
          print_r(json_encode($data));
          return json_encode($data);  
     }
     else {
          $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
          $jsn = json_encode($arr);
          print_r($jsn);
          return json_encode($jsn);  
     
          
     }
     
     
}

function add_pompiste() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    //  $id_station = $_SESSION['id_station'];
    $id_region = $_SESSION['id_region'];
    $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
      $data = json_decode(file_get_contents("php://input"));
    //   print_r($data)   ;
      
       $pompiste       = $data->pompiste;
   
   
      //  var_dump($pompiste) ;
   
       $matricule = $pompiste->matricule;
       $nom = $pompiste->nom;
       $prenom = $pompiste->prenom;
       $sexe = $pompiste->sexe;
       $poste_occupe = $pompiste->poste_occupe ;
       $station = $pompiste->station ;
       $date_naissance = $pompiste->date_naissance ;
       $date_embauche = $pompiste->date_embauche ;
       
       $date_naissance = date('Y-m-d', strtotime($date_naissance));
       $date_embauche = date('Y-m-d', strtotime($date_embauche));
   
       
              
              $res=mysqli_query($conn, "CALL add_pompiste($matricule, '$nom','$prenom', '$sexe', '$poste_occupe', '$date_naissance', '$date_embauche', '$station')");
                 if ($res == false) {
   
                   $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                      $jsn = json_encode($arr);
                      print_r($jsn);
                      return json_encode($jsn);  
                   
                 }
        
    
   
      $arr = array('msg' => '' , 'error' => 'Error In inserting record');
      $jsn = json_encode($arr);
      print_r($jsn);
      return json_encode($jsn);  
   
       
}

function get_controle_versement() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    //  $id_station = $_SESSION['id_station'];
    $id_region = $_SESSION['id_region'];
    $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
      $data = json_decode(file_get_contents("php://input"));
    //   print_r($data)   ;
      
       $versement       = $data->versement ;
   
      //  var_dump($versement) ;
       
       $date_debut = date('Y-m-d', strtotime($versement->date_debut));
       $date_fin = date('Y-m-d', strtotime($versement->date_fin));
   
       
              
              $res=mysqli_query($conn, "CALL add_pompiste($matricule, '$nom','$prenom', '$sexe', '$poste_occupe', '$date_naissance', '$date_embauche', '$station')");
                 if ($res == false) {
   
                   $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                      $jsn = json_encode($arr);
                      print_r($jsn);
                      return json_encode($jsn);  
                   
                 }
        
    
   
      $arr = array('msg' => '' , 'error' => 'Error In inserting record');
      $jsn = json_encode($arr);
      print_r($jsn);
      return json_encode($jsn);  
   
       
}
   
function edit_pompiste() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';

     //  $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];

     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);

     $data = json_decode(file_get_contents("php://input"));
     //   print_r($data)   ;
     
     $pompiste       = $data->pompiste;

     $id_pompiste = $pompiste->id_pompiste;
     $matricule = $pompiste->matricule;
     $nom = $pompiste->nom_pompiste;
     $prenom = $pompiste->prenom;
     $sexe = $pompiste->sexe;
     $poste_occupe = $pompiste->poste_occupe ;
     $station = $pompiste->station ;
     $date_naissance = $pompiste->date_naissance ;
     $date_embauche = $pompiste->date_embauche ;
     
     $date_naissance = date('Y-m-d', strtotime($date_naissance));
     $date_embauche = date('Y-m-d', strtotime($date_embauche));


     
          $res=mysqli_query($conn, "CALL edit_pompiste($id_pompiste, $matricule, '$nom','$prenom', '$sexe', '$poste_occupe', '$date_naissance', '$date_embauche', '$station')");
               if ($res == false) {

               $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                    $jsn = json_encode($arr);
                    print_r($jsn);
                    return json_encode($jsn);  
               
               }
     


     $arr = array('msg' => '' , 'error' => 'Error In inserting record');
     $jsn = json_encode($arr);
     print_r($jsn);
     return json_encode($jsn);  

     
}

function edit_prix_produit() {
   
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];

     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);

     $data = json_decode(file_get_contents("php://input"));
     //   print_r($data)   ;
     
    $produit       = $data->produit;

    $code_produit = $produit->code_produit;
    $prix_produit = floatval($produit->prix_produit);
    
    


   
           $res=mysqli_query($conn, "CALL edit_prix_produit('$code_produit', $prix_produit, $id_station, $id_region)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
  

     $arr = array('msg' => '' , 'error' => 'Error In inserting record');
     $jsn = json_encode($arr);
     print_r($jsn);
     return json_encode($jsn);  

    
}

function get_heure() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

     // connect DB
     $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL get_heure('$id_station', '$id_region' , '$userId' )");

     $data1 = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       
      {
          $date_ouverture = $rows['date_ouverture'] ;
          $quart = $rows['quart'] ;

         $data1[] = array(

                  "date_ouverture"  => $date_ouverture,
                  "quart"  => $quart
                
                          
                     ) ;  
     }

     print_r(json_encode($data1));
     return json_encode($data1);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_heure_suppression() {

    $id_station = $_SESSION['id_station'];
    $id_region = $_SESSION['id_region'];
    $userId = $_SESSION['id_user'];
   
        // connect DB
        $conn=mysqli_connect("localhost","station","station","station");
   
      $res=mysqli_query($conn, "CALL get_heure_suppression('$id_station', '$id_region' )");
   
        $data1 = array();
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
          
         {
             $date_ouverture = $rows['date_ouverture'] ;
             $quart = $rows['quart'] ;
   
            $data1[] = array(
   
                     "date_ouverture"  => $date_ouverture,
                     "quart"  => $quart
                   
                             
                        ) ;  
        }
   
        print_r(json_encode($data1));
        return json_encode($data1);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}

function supprimer_quart() {

     
    $id_station = $_SESSION['id_station'];
    $id_region = $_SESSION['id_region'];
    $userId = $_SESSION['id_user'];

    $host_name = 'localhost';
    $database = 'station';
    $user_name = 'station';
    $password = 'station';
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
      $data = json_decode(file_get_contents("php://input"));
    //   print_r($data)   ;
      
       $quart       = $data->quart;
   
       $date_ouverture = $quart->date_ouverture;
       $quart = $quart->quart;
       
              
              $res=mysqli_query($conn, "CALL supprimer_quart('$date_ouverture','$quart', $id_station, $id_region)");
                 if ($res == false) {
   
                   $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                      $jsn = json_encode($arr);
                      print_r($jsn);
                      return json_encode($jsn);  
                   
                 }
        
    
   
      $arr = array('msg' => '' , 'error' => 'Error In inserting record');
      $jsn = json_encode($arr);
      print_r($jsn);
      return json_encode($jsn);  
            
    
}

function get_ventes() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL ventes($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "station"  => $rows['nom_station'],
                  "produit"  => $rows['nom_produit'],
                  "quantite"  => $rows['quantite']
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_versement() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
     $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL versement($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "station"  => $rows['nom_station'],
                  "versement"  => $rows['montant_versement']
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_versement_station() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
  $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL versement_station($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "station"  => $rows['nom_station'],
                  "versement"  => $rows['montant_versement']
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_client_all_gescom() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
     $code_station = $_SESSION['code_station'];

     

   
     $query = "

     Select
     F_COMPTET.CT_Num AS code_client,
     F_COMPTET.CT_Intitule AS nom_client
 From
     F_COMPTET
 Where
     F_COMPTET.CT_Num LIKE :code_station 
     
     " ;

     $sql = new sql2();
     $req = $sql->requete2( $query, 'CLR%');
     $req ->execute();
     $data  = $req->fetchAll(PDO::FETCH_OBJ) ;

         
   
        print_r(json_encode($data));
        return json_encode($data);  
      
       
      
   
}

function Etats_Releve_echeance() { 


     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->creances;
   
       $date_debut = $date_fin = $client =  '' ;
       
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;

        $client = $requete->client->code_client ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
       
        $dates = [] ;
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);

     //   $dates [] = date_format($date_debut, 'Y-m-d') ;

        $date_initiale = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
        $date_initiale = date_format($date_initiale, 'Y-m-d');
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
       

     /********************************************************************************************************************* */
        
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
    $res=mysqli_query($conn, "

     Select
          cloture_decouvert.solde
     From
          cloture_decouvert

     where cloture_decouvert.code_station = '$client'

          ORDER BY cloture_decouvert.date_fermerture DESC
     LIMIT 1;
     
     "
     );

    $data_solde = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

      {
         $data_solde[] = array(

               "solde"  => $rows['solde']
                        
                   ) ;
      }
     }
     /********************************************************************************************************************** */

     
    
     /********************************************************************************************************************* */


        $query_client_terme = "
   
        Select
        F_DOCLIGNE.CT_Num As client,
        Convert(DATE,F_DOCLIGNE.DO_Date) As date,
        Floor(F_DOCLIGNE.DL_MontantTTC) As montant,
        Floor(F_DOCLIGNE.DL_Qte) As quantite,
        F_ARTICLE.AR_Design As produit,
        F_DOCENTETE.DO_Ref As facture
    From
        F_DOCLIGNE Inner Join
        F_ARTICLE On F_DOCLIGNE.AR_Ref = F_ARTICLE.AR_Ref Inner Join
        F_DOCENTETE On F_DOCLIGNE.DO_Piece = F_DOCENTETE.DO_Piece
    Where
        (F_DOCENTETE.DO_Type = 3 Or
          F_DOCENTETE.DO_Type = 6 Or
            F_DOCENTETE.DO_Type = 7) And
        F_DOCENTETE.DO_Domaine = 0 And
        F_DOCENTETE.DO_Piece Not Like 'APF%' And
        F_DOCENTETE.DO_Piece Not Like 'PF%' And
        F_DOCENTETE.CT_NumPayeur = '$client' AND

        (CONVERT(DATE, F_DOCENTETE.DO_Date) between '$date_debut2' AND '$date_fin2' ) 
    
       
    order by 
          F_DOCENTETE.DO_Date
        
             
             " ;

    
     /****************************************************************************************************************** */

     $sql3 = new sql3();
     $req3 = $sql3->requete3( $query_client_terme);
     $req3 ->execute();
     $data_client  = $req3->fetchAll(PDO::FETCH_OBJ) ;
    
    
    
     /******************************************************************************************************* */   
    
      
        $query_reglement = "
        
        Select
        F_CREGLEMENT.CT_NumPayeur As client,
        Convert(DATE, F_CREGLEMENT.RG_Date) As date,
        F_CREGLEMENT.RG_Reference As facture,
        F_CREGLEMENT.RG_Libelle As produit,
        F_CREGLEMENT.RG_Montant As montant
    From
        F_CREGLEMENT
    Where
        (F_CREGLEMENT.RG_Impute = 0 Or F_CREGLEMENT.RG_Impute = 1) And
        F_CREGLEMENT.RG_Type = 0 And
        F_CREGLEMENT.RG_TypeReg = 0 And
        F_CREGLEMENT.CT_NumPayeur = '$client' and
        Convert(DATE,F_CREGLEMENT.RG_Date) Between '$date_debut2' And '$date_fin2' And
        Convert(DATE,F_CREGLEMENT.RG_Date) Between '$date_debut2' And '$date_fin2'
     
     ORDER BY

     F_CREGLEMENT.RG_Date

        
        ";  

        
        /********************************************************************************************************************* */
   
        $sql = new sql3();
        $req = $sql->requete3( $query_reglement);
        $req ->execute();
        $data_reglement = $req->fetchAll(PDO::FETCH_OBJ) ;
       
      
   
   
        $datas = array() ;

        $data = new stdClass();
        
        $solde_initial = $data_solde[0]['solde'];

        $data->solde = $solde_initial ;

        $datas[] = $data ;
   
   
             foreach ($data_client as $key5 => $value5) {

   
               $data = new stdClass();

               $data->date = $value5->date ;
               $data->client = $client ;

               $data->quantite = $value5->quantite ;
               $data->montant = $value5->montant ;
               $data->facture = $value5->facture ;
               $data->produit = $value5->produit ;

               $data->reglement = 0 ;
               
               $cle = count($datas) ;
               $data->solde = $datas[$cle - 1]->solde + $data->montant - $data->reglement ;
                  
   
               $datas[] = $data ;

               
             }
   
            
             foreach ($data_reglement as $key8 => $value8) {

   
               $data = new stdClass();

               $data->date = $value8->date ;
               $data->client = $client ;

               $data->facture = $value8->facture ;

               $data->quantite = 0 ;
               $data->montant = 0 ;
               
               $data->reglement = $value8->montant ;

               $data->produit = $value8->produit ;

               $cle = count($datas) ;
               $data->solde = $datas[$cle - 1]->solde + $data->montant - $data->reglement ;
               
               $datas[] = $data ;
   

             }


            

             
            
        


   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      
       
}

function Etats_Decouvert() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
       $date_debut = $date_fin = $station = '' ;
      
       $requete = $data->decouvert ;

       $date_debut = $requete->date_debut ;
       $date_fin = $requete->date_fin ;
       $station = $requete->client->code_client ;
       
       $date_debut2 = new dateTime($date_debut) ;
       $date_debut2 = $date_debut2->modify("-1 days") ;
       $date_debut2 = $date_debut2->format('Y-m-d') ;

        
    // $date_debut2 = date('Y-m-d', strtotime($date_debut));
     $date_fin2 = date('Y-m-d', strtotime($date_fin));
     
     $dates = [] ;
     
     $date_debut = date_create($date_debut);
     $date_fin = date_create($date_fin);

     $dates [] = date_format($date_debut, 'Y-m-d') ;

     while ($date_debut < $date_fin) {
          
          
          $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
          $dates [] = date_format($date_debut, 'Y-m-d') ;

     }

     /****************************************************************************************************************************** */

     $res=mysqli_query($conn, "

     Select
          DATE(cloture_decouvert.date_ouverture) AS date_ouverture,
          DATE(cloture_decouvert.date_fermerture) AS date_fermerture,
          cloture_decouvert.commentaire,
          cloture_decouvert.solde,

     From
          cloture_decouvert

          ORDER BY cloture_decouvert.date_fermerture DESC
     LIMIT 1;

       
      "
       
       );
   
       
        if (is_object($res)) {
   
          while($rows = mysqli_fetch_array($res))
     
          {
               $date_debut = $rows['date_fermerture'] ;
               $solde = $rows['solde'] ;
          }

        }
   

     /********************************************************************************************************************************* */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise))* produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.code_station As station
     
     From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And pompiste_pistolet.id_cuve = pistolet.id_cuve
               And pompiste_pistolet.id_station = pistolet.id_station
               And pompiste_pistolet.id_region = pistolet.id_region
               And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
               And produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region

     WHERE 
     
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.code_station
     
     
     ";  
     /********************************************************************************************************************* */

     $query_vte_lub = "

     SELECT
     DATE(station.quart.date_ouverture)AS date,
     SUM(produit_quart.qte_vendu) AS quantite,
     SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
     produit.nom_produit AS produit,
     station.code_station AS station
     FROM
     produit_quart
     INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
     WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     GROUP BY
     
     DATE(station.quart.date_ouverture),
     produit.nom_produit,
     station.code_station

    
    " ;

 /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     produit.nom_produit As produit,
     station.code_station AS station,
     livraison.id_livraison,
     livraison.num_bon,

     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant
     
     
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.code_station,
     livraison.id_livraison,
     livraison.num_bon
     
     

     " ;


     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.code_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.code_station
     
    

     " ;

     $query_livraison = "

          
     Select
     Date(station.quart.date_ouverture) As date,
     livraison.num_bon,
     produit.nom_produit As produit,

     livraison_carburant.qte_recu As quantite,
     livraison_carburant.qte_recu * produit_station.prix_produit As montant,

     station.code_station As station,
     livraison.id_livraison,
     livraison_carburant.statut_decouvert,
     livraison_carburant.cloture_decouvert,

     livraison_carburant.id_station,
     livraison_carburant.id_region,
     livraison_carburant.id_produit,
     livraison_carburant.id_cuve



     From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
          And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
          And produit_station.id_region = station.id_region
          And produit_station.id_produit = produit.id_produit

          WHERE 

          (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
          (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     UNION


     Select
     Date(station.quart.date_ouverture) As date,
     livraison.num_bon,
     produit.nom_produit As produit,
     
     livraison_lubrifiant_gaz.qte_recu As quantite,
     livraison_lubrifiant_gaz.qte_recu*produit_station.prix_produit As montant,

     station.code_station As station,
     livraison.id_livraison,
     livraison_lubrifiant_gaz.statut_decouvert,
     livraison_lubrifiant_gaz.cloture_decouvert,

     livraison_lubrifiant_gaz.id_station,
     livraison_lubrifiant_gaz.id_region,
     livraison_lubrifiant_gaz.id_produit,
     0 As id_cuve


     From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
          And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
          And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
          And livraison_lubrifiant_gaz.id_station = station.id_station
          And livraison_lubrifiant_gaz.id_region = station.id_region
          And livraison_lubrifiant_gaz.id_produit = produit.id_produit

          WHERE 

          (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
          (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )




     ORDER BY 1  " ;
     
    

     $query_stock_ouverture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.code_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '07:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.code_station
    

     " ;


     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.code_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.code_station,
     DATE(station.quart.date_ouverture)

     " ;

     $query_stock_fermerture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.code_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '17:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.code_station
    

     " ;


     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.code_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
    
     (DATE( station.quart.date_fermerture ) = '$date_fin2' )

 Group By
     produit.nom_produit,
     station.code_station,
     DATE(station.quart.date_ouverture)

     " ;

     $query_coulage_anterieur = " 

     Select
     
     coulage_decouvert.id_coulage,
     coulage_decouvert.libelle_coulage,
     coulage_decouvert.periode_coulage,
     coulage_decouvert.statut_decouvert,
     coulage_decouvert.cloture_decouvert,
     coulage_decouvert.quantite,
     coulage_decouvert.montant,
     coulage_decouvert.code_station As station
 From
     coulage_decouvert 
     
     " ;


     
 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {
          if ($rows['station'] == $station) {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;
                    $obj->montant = intval($rows['montant']) ;

                    $data_vte_carb[] = $obj ;

          }
       
      }
    }

 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;
               }
          
          }


    }

 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass() ;

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $obj->num_bon = $rows['num_bon'] ;
                    $obj->id_livraison = $rows['id_livraison'] ;
               /*     
                    $obj->id_produit = $rows['id_produit'] ;
                    $obj->id_cuve = $rows['id_cuve'] ;
                    $obj->id_station = $rows['id_station'] ;
                    $obj->id_region = $rows['id_region'] ;
               */
                    $data_livr_carb[] = $obj ;

                    
               }
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    
               }
          
          }


    }

     /******************************************************************************************************* */ 
     
    $res_livr = mysqli_query($conn, $query_livraison );

    $data_livr = array();

    if (is_object($res_livr)) {


          while($rows = mysqli_fetch_array($res_livr))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass() ;

                    $obj->status = intval($rows['statut_decouvert']) ;
                    $obj->status_cloture = intval($rows['cloture_decouvert']) ;

                    if ($obj->status == 1 ) {

                         $obj->montant = 0 ;

                    } else {
                         
                         $obj->montant = intval($rows['montant']) ;
                    }

                    if ($obj->status_cloture AND $obj->status ) {
                         $obj->status_affichage = 0 ;
                    } else {
                         $obj->status_affichage = 1 ;
                    }
                    
                    

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant_initial = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $obj->num_bon = $rows['num_bon'] ;
                    $obj->id_livraison = $rows['id_livraison'] ;
               /*     
                    $obj->id_produit = $rows['id_produit'] ;
                    $obj->id_cuve = $rows['id_cuve'] ;
                    $obj->id_station = $rows['id_station'] ;
                    $obj->id_region = $rows['id_region'] ;
               */
                    $data_livr[] = $obj ;

                    
               }
          
          }


    }

    /********************************************************************************************************** */

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;
 
                     
                }
           
           }
 
     }

     /******************************************************************************************************* */  
     
    

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /******************************************************************************************************** */

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;
 
                     
                }
           
           }
 
 
     }

    /********************************************************************************************* */
    $res_coulage_anterieur = mysqli_query($conn, $query_coulage_anterieur);

    $data_coulage_anterieur = array();

    if (is_object($res_coulage_anterieur)) {


          while($rows = mysqli_fetch_array($res_coulage_anterieur))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass() ;

                    $obj->status = intval($rows['statut_decouvert']) ;
                    $obj->status_cloture = intval($rows['cloture_decouvert']) ;

                    if ($obj->status == 1 ) {

                         $obj->montant = 0 ;

                    } else {
                         
                         $obj->montant = intval($rows['montant']) ;
                    }

                    if ($obj->status_cloture AND $obj->status ) {
                         $obj->status_affichage = 0 ;
                    } else {
                         $obj->status_affichage = 1 ;
                    }
                    
                    

                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant_initial = intval($rows['montant']) ;
                    $obj->produit = $rows['libelle_coulage'].' '.$rows['periode_coulage'] ;
                    $obj->station = $rows['station'] ;

                    $obj->id_coulage = $rows['id_coulage'] ;
              
                    $data_coulage_anterieur[] = $obj ;

                    
               }
          
          }


    }

   /************************************************VERSEMENT BANQUE***************************************************************** */

   $query_versement = " 
        
   SELECT
     DATE (quart.date_ouverture) AS date,
     station.code_station AS station,
     versement_banque.nom_banque AS libelle,
     versement_banque.statut_decouvert,
     versement_banque.cloture_decouvert,
     SUM(versement_banque.montant_versement) AS montant
     FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region

     WHERE 

     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     GROUP BY

     DATE (quart.date_ouverture),
     station.code_station,
     versement_banque.nom_banque,
     versement_banque.statut_decouvert,
     versement_banque.cloture_decouvert

     
     " ;

  $res_versement = mysqli_query($conn, $query_versement );

  $data_versement = array();

  if (is_object($res_versement)) {


        while($rows = mysqli_fetch_array($res_versement))

        {

          $obj = new stdClass();

          $obj->status = intval($rows['statut_decouvert']) ;
          $obj->status_cloture = intval($rows['cloture_decouvert']) ;

          if ($obj->status == 1) {
            $obj->montant = 0 ;
          } else {
            $obj->montant = floatval($rows['montant']) ;
          }

          if ($obj->status_cloture AND $obj->status) {
               $obj->status_affichage = 0 ;
          } else {
               $obj->status_affichage = 1 ;
          }
          
          
          $obj->montant_initial = floatval($rows['montant']) ;
          
          $obj->date = $rows['date'] ;
          $obj->station = $rows['station'] ;
          $obj->libelle = $rows['libelle'] ;

          // $obj->quantite = $rows['bordereau'] ;


          $data_versement[] = $obj ;
        
        }

  }

  /*************************************************INIT*************************************************************** */
  $datas_stock_carburant = array();
  $datas_stock_lubrifiant = array();

  $livraison_total = 0 ;
  $versement_total = 0 ;

  $datas_coulages_carburant = array() ;
  $datas_coulages = 0 ;


  /************************************************COULAGES********************************************************** */
   
  $data_total = new stdClass();

  $data_total->date = 'TOTAL' ;

  $data_total->cou_gasoil_l = 0 ;
  $data_total->cou_super_l = 0 ;
  $data_total->cou_petrole_l = 0 ;
  $data_total->cou_lubrifiant_l = 0 ;
  
  $data_total->cou_gasoil_m = 0 ;
  $data_total->cou_super_m = 0 ;
  $data_total->cou_petrole_m = 0 ;
  $data_total->cou_lubrifiant_m = 0 ;


    $datas_coulages_station = array() ;

    foreach ($dates as $key => $value) {


         $data = new stdClass();
         $date = $value ;

         $data->date = $value ;

         $data->si_gasoil_l = 0 ;
         $data->si_super_l = 0 ;
         $data->si_petrole_l = 0 ;
         $data->si_lubrifiant_l = 0 ;

         $data->si_gasoil_m = 0 ;
         $data->si_super_m = 0 ;
         $data->si_petrole_m = 0 ;
         $data->si_lubrifiant_m = 0 ;

         $data->liv_gasoil_l = 0 ;
         $data->liv_super_l = 0 ;
         $data->liv_petrole_l = 0 ;
         $data->liv_lubrifiant_l = 0 ;
         
         $data->liv_gasoil_m = 0 ;
         $data->liv_super_m = 0 ;
         $data->liv_petrole_m = 0 ;
         $data->liv_lubrifiant_m = 0 ;

         $data->vte_gasoil_l = 0 ;
         $data->vte_super_l = 0 ;
         $data->vte_petrole_l = 0 ;
         $data->vte_lubrifiant_l = 0 ;
         
         $data->vte_gasoil_m = 0 ;
         $data->vte_super_m = 0 ;
         $data->vte_petrole_m = 0 ;
         $data->vte_lubrifiant_m = 0 ;

         $data->st_gasoil_l = 0 ;
         $data->st_super_l = 0 ;
         $data->st_petrole_l = 0 ;
         $data->st_lubrifiant_l = 0 ;
         
         $data->st_gasoil_m = 0 ;
         $data->st_super_m = 0 ;
         $data->st_petrole_m = 0 ;
         $data->st_lubrifiant_m = 0 ;

         $data->sf_gasoil_l = 0 ;
         $data->sf_super_l = 0 ;
         $data->sf_petrole_l = 0 ;
         $data->sf_lubrifiant_l = 0 ;
         
         $data->sf_gasoil_m = 0 ;
         $data->sf_super_m = 0 ;
         $data->sf_petrole_m = 0 ;
         $data->sf_lubrifiant_m = 0 ;

         $data->cou_gasoil_l = 0 ;
         $data->cou_super_l = 0 ;
         $data->cou_petrole_l = 0 ;
         $data->cou_lubrifiant_l = 0 ;
         
         $data->cou_gasoil_m = 0 ;
         $data->cou_super_m = 0 ;
         $data->cou_petrole_m = 0 ;
         $data->cou_lubrifiant_m = 0 ;
         

         
         foreach ($data_stock_ouverture_carb as $key1 => $value1) {

              if ($value1->date == $date && $value1->station == $station) {

                   if ($value1->produit == 'SUPER') {

                        
                        $data->si_super_l = $value1->quantite ;
                        $data->si_super_m = $value1->montant ;

                   
                   } elseif ($value1->produit == 'GASOIL') {

                        $data->si_gasoil_l = $value1->quantite ;
                        $data->si_gasoil_m = $value1->montant ;

                   } else {

                        $data->si_petrole_l = $value1->quantite ;
                        $data->si_petrole_m = $value1->montant ;


                   }
              
                   
              }
         }

         foreach ($data_stock_ouverture_lub as $key2 => $value2) {

               if ($value2->date == $date && $value2->station == $station) {

                    $data->si_lubrifiant_l += $value2->quantite ;
                    $data->si_lubrifiant_m += $value2->montant ;

               }
         }

         foreach ($data_livr_carb as $key3 => $value3) {

               if ($value3->date == $date && $value3->station == $station) {

                         if ($value3->produit == 'SUPER') {

                         
                              $data->liv_super_l += $value3->quantite ;
                              $data->liv_super_m += $value3->montant ;

                         
                         } elseif ($value3->produit == 'GASOIL') {

                              $data->liv_gasoil_l += $value3->quantite ;
                              $data->liv_gasoil_m += $value3->montant ;

                         } else {

                              $data->liv_petrole_l += $value3->quantite ;
                              $data->liv_petrole_m += $value3->montant ;


                         }
                    
                    
               }
         }

         foreach ($data_livr_lub as $key4 => $value4) {

               if ($value4->date == $date && $value4->station == $station) {

                    $data->liv_lubrifiant_l += $value4->quantite ;
                    $data->liv_lubrifiant_m += $value4->montant ;

               }
         }

         foreach ($data_vte_carb as $key5 => $value5) {

               if ($value5->date == $date && $value5->station == $station) {

                         if ($value5->produit == 'SUPER') {

                         
                              $data->vte_super_l = $value5->quantite ;
                              $data->vte_super_m = $value5->montant ;

                         
                         } elseif ($value5->produit == 'GASOIL') {

                              $data->vte_gasoil_l = $value5->quantite ;
                              $data->vte_gasoil_m = $value5->montant ;

                         } else {

                              $data->vte_petrole_l = $value5->quantite ;
                              $data->vte_petrole_m = $value5->montant ;


                         }
                    
                    
               }
         }  

         foreach ($data_vte_lub as $key6 => $value6) {

               if ($value6->date == $date && $value6->station == $station) {

                    $data->vte_lubrifiant_l += $value6->quantite ;
                    $data->vte_lubrifiant_m += $value6->montant ;

               }
         }

         foreach ($data_stock_fermerture_carb as $key7 => $value7) {

               if ($value7->date == $date && $value7->station == $station) {

                         if ($value7->produit == 'SUPER') {

                         
                              $data->sf_super_l = $value7->quantite ;
                              $data->sf_super_m = $value7->montant ;

                         
                         } elseif ($value7->produit == 'GASOIL') {

                              $data->sf_gasoil_l = $value7->quantite ;
                              $data->sf_gasoil_m = $value7->montant ;

                         } else {

                              $data->sf_petrole_l = $value7->quantite ;
                              $data->sf_petrole_m = $value7->montant ;


                         }
                    
                    
               }
         }

         foreach ($data_stock_fermerture_lub as $key8 => $value8) {

               if ($value8->date == $date && $value8->station == $station) {

                    $data->sf_lubrifiant_l += $value8->quantite ;
                    $data->sf_lubrifiant_m += $value8->montant ;

               }
         }


         $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
         $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
         $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
         $data->st_lubrifiant_l = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;
         
         $data->st_gasoil_m = $data->si_gasoil_m + $data->liv_gasoil_m - $data->vte_gasoil_m ;
         $data->st_super_m = $data->si_super_m + $data->liv_super_m - $data->vte_super_m ;
         $data->st_petrole_m = $data->si_petrole_m + $data->liv_petrole_m - $data->vte_petrole_m ;
         $data->st_lubrifiant_m = $data->si_lubrifiant_m + $data->liv_lubrifiant_m - $data->vte_lubrifiant_m ;

         $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
         $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
         $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
         $data->cou_lubrifiant_l = $data->sf_lubrifiant_l - $data->st_lubrifiant_l ;
         
         $data->cou_gasoil_m = $data->sf_gasoil_m - $data->st_gasoil_m ;
         $data->cou_super_m = $data->sf_super_m - $data->st_super_m ;
         $data->cou_petrole_m = $data->sf_petrole_m - $data->st_petrole_m ;
         $data->cou_lubrifiant_m = $data->sf_lubrifiant_m - $data->st_lubrifiant_m ;

         /********************************************TOTAL COULAGES********************************************************* */

         $data_total->cou_gasoil_l += ($data->sf_gasoil_l - $data->st_gasoil_l);
         $data_total->cou_super_l += ($data->sf_super_l - $data->st_super_l) ;
         $data_total->cou_petrole_l += ($data->sf_petrole_l - $data->st_petrole_l) ;
         $data_total->cou_lubrifiant_l += ($data->sf_lubrifiant_l - $data->st_lubrifiant_l) ;
         
         $data_total->cou_gasoil_m += ($data->sf_gasoil_m - $data->st_gasoil_m) ;
         $data_total->cou_super_m += ($data->sf_super_m - $data->st_super_m );
         $data_total->cou_petrole_m += ($data->sf_petrole_m - $data->st_petrole_m );
         $data_total->cou_lubrifiant_m += ($data->sf_lubrifiant_m - $data->st_lubrifiant_m) ;
         

         $datas_coulages_station[] = $data ;
         
    }


     /******************************************DEBUT TRAITEMENT VERSEMENT*********************************************************************** */
     $datas_versement = array() ;

     foreach ($data_versement as $key9 => $value9) {
          
          if ($value9->station == $station) {

               $datas_versement[] = $value9 ;

               $versement_total += $value9->montant ;

          }

         
     }

      /******************************************DEBUT TRAITEMENT LIVRAISONS*********************************************************************** */


      foreach ($data_livr as $key9 => $value9) {
          
          if ($value9->station == $station) {

               $livraison_total += $value9->montant ;
          }

         
     }


     /*********************************** DEBUT TRAITEMENT COULAGES CARBURANT******************************/

        $obj_super = new stdClass();


        $obj_super->produit = 'COULAGE SUPER' ;
        $obj_super->quantite = $data_total->cou_super_l ;
        $obj_super->montant = $data_total->cou_super_m  ;
        $obj_super->prix_unitaire = 0 ;
        $obj_super->status = 0 ;


        $obj_gasoil = new stdClass();


        $obj_gasoil->produit = 'COULAGE GASOIL' ;
        $obj_gasoil->quantite = $data_total->cou_gasoil_l ;
        $obj_gasoil->montant = $data_total->cou_gasoil_m  ;
        $obj_gasoil->prix_unitaire = 0 ;
        $obj_gasoil->status = 0 ;



        $obj_petrole = new stdClass();

     
        $obj_petrole->produit = 'COULAGE PETROLE' ;
        $obj_petrole->quantite = $data_total->cou_petrole_l ;
        $obj_petrole->montant = $data_total->cou_petrole_m  ;
        $obj_petrole->prix_unitaire = 0 ;
        $obj_petrole->status = 0 ;



        $datas_coulages = $obj_super->montant + $obj_gasoil->montant + $obj_petrole->montant ;

        $datas_coulages_carburant[] = $obj_super ;
        $datas_coulages_carburant[] = $obj_gasoil ;
        $datas_coulages_carburant[] = $obj_petrole ;


        /*******************************DEBUT TRAITEMENT COULAGES LUBRIFIANT****************************************** */

        $obj_lub = new stdClass();

        $obj_lub->produit = 'ECART LUBRIFIANT' ;
        $obj_lub->quantite =  $data_total->cou_lubrifiant_l ;
        $obj_lub->prix_unitaire = '' ;
        $obj_lub->montant =   $data_total->cou_lubrifiant_m ;

        $datas_coulages_lubrifiant[] = $obj_lub ;

       // $datas_coulages += $obj_lub->montant ;

       
        /*******************************DEBUT TRAITEMENT STOCK CARBURANT | LUBRIFIANT****************************************** */

        $key = count($datas_coulages_station) ;

        $stock_gasoil_carb = new stdClass();
        $stock_super_carb = new stdClass();
        $stock_petrole_carb = new stdClass();

        $stock_lub = new stdClass();

          $stock_lub->produit = 'LUBRIFIANT' ;
          $stock_lub->quantite =  0 ;
          $stock_lub->prix_unitaire = '' ;
          $stock_lub->montant =  0 ;

        foreach ($data_stock_fermerture_carb as $key7 => $value7) {


          if ($value7->produit == 'SUPER') {

               $stock_super_carb->produit = 'SUPER' ;
               $stock_super_carb->quantite =  $value7->quantite ; 
               $stock_super_carb->prix_unitaire = '' ;
               $stock_super_carb->montant = $value7->montant ;

          
          } elseif ($value7->produit == 'GASOIL') {

               $stock_gasoil_carb->produit = 'GASOIL' ;
               $stock_gasoil_carb->quantite =  $value7->quantite ;
               $stock_gasoil_carb->prix_unitaire = '' ;
               $stock_gasoil_carb->montant = $value7->montant ;
       

          } else {

               $stock_petrole_carb->produit = 'PETROLE' ;
               $stock_petrole_carb->quantite =  $value7->quantite ;
               $stock_petrole_carb->prix_unitaire = '' ;
               $stock_petrole_carb->montant = $value7->montant ;


          }
          
        }

        foreach ($data_stock_fermerture_lub as $key7 => $value7) {


          if ($value7->date == $date_fin2) {

              
               $stock_lub->produit = 'LUBRIFIANT' ;
               $stock_lub->quantite +=  $value7->quantite ;
               $stock_lub->prix_unitaire = '' ;
               $stock_lub->montant +=  $value7->montant ;

          }
          
        }

       
     
        $datas_stock_carburant[] = $stock_gasoil_carb ;
        $datas_stock_carburant[] = $stock_super_carb ;
        $datas_stock_carburant[] = $stock_petrole_carb ;

        $datas_stock_lubrifiant[] = $stock_lub ;
     
        /****************************************** DEBUT TRAITEMENT RECAP ********************************************************************** */

        $resultat = new stdClass();

        $resultat->date = $date_debut2 ;
        $resultat->recap_coulage = $datas_coulages ;

        $resultat->recap_coulage_carb = $datas_coulages_carburant ;

        foreach ($data_coulage_anterieur as $key => $value) {
             
          $resultat->recap_coulage_carb[] = $value ;
          $resultat->recap_coulage += $value->montant ;

        }
       // $resultat->recap_coulage_lub = $datas_coulages_lubrifiant ;
        
        

        $resultat->recap_versement = $datas_versement ;
        $resultat->recap_versement_total = $versement_total ;

        $resultat->recap_depenses = [] ;
        $resultat->recap_depenses_total = 0 ;

        $resultat->recap_livraison = $data_livr ;
        $resultat->recap_livraison_total = $livraison_total ;

        $resultat->recap_stock_carb = $datas_stock_carburant ;
        $resultat->recap_stock_lub = $datas_stock_lubrifiant ;
        $resultat->recap_stock = $stock_gasoil_carb->montant + $stock_super_carb->montant + $stock_petrole_carb->montant + $stock_lub->montant ;

        $resultat->solde_gescom = 0 ;


     /******************************************MANQUANTS POMPISTES********************************************** */

     $query = "
       
     Select
     Date(station.quart.date_ouverture) As date,
     station.pompiste.nom_pompiste,
     Sum(((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
     produit_station.prix_produit) As montant,
     station.code_station AS station
 From
     pompiste_pistolet Inner Join
     pompiste On pompiste_pistolet.id_pompiste = pompiste.id_pompiste Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     cuves On cuves.id_produit = produit.id_produit Inner Join
     pistolet On pistolet.id_cuve = cuves.id_cuve
             And pistolet.id_station = cuves.id_station
             And pistolet.id_region = cuves.id_region
             And station.pompiste_pistolet.id_pistolet = pistolet.id_pistolet
             And station.pompiste_pistolet.id_cuve = pistolet.id_cuve
             And station.pompiste_pistolet.id_station = pistolet.id_station
             And station.pompiste_pistolet.id_region = pistolet.id_region
             And station.pompiste_pistolet.id_pompe = pistolet.id_pompe
             
 WHERE 
      
      (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
      (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
      
 Group By
     Date(station.quart.date_ouverture),
     station.pompiste.nom_pompiste,
     station.code_station
     
     ";  
  /********************************************************************************************************************* */
 
     $query_client = "

     Select
     Date(station.quart.date_ouverture) As date,
     station.pompiste.nom_pompiste,
     station.client.nom_client,
     Sum(station.pompiste_has_client.montant) As montant,
     station.code_station As station
 From
     pompiste_has_client Inner Join
     quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
     client On pompiste_has_client.client_id_client = client.id_client Inner Join
     produit On pompiste_has_client.produit_id_produit = produit.id_produit Inner Join
     pompiste On pompiste_has_client.pompiste_id_pompiste = pompiste.id_pompiste Inner Join
     client_produit On client_produit.id_client = client.id_client
             And client_produit.id_produit = produit.id_produit Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region

   WHERE 

   (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
   (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
 Group By
     Date(station.quart.date_ouverture),
     station.pompiste.nom_pompiste,
     station.code_station
     
     " ;
 
  /************************************************************************************************************************ */
 
      $query_vers = " 

        Select
        Date(station.quart.date_ouverture) As date,
        station.pompiste.nom_pompiste,
        station.code_station As station,
        Sum(station.versement_pompiste.montant_versement) As montant
   From
   versement_pompiste Inner Join
   quart On versement_pompiste.id_quart = quart.id_quart Inner Join
   pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
   station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region
             And station.pompiste.id_station = station.id_station
             And station.pompiste.id_region = station.id_region
   WHERE 
        
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

   Group By
        Date(station.quart.date_ouverture),
        station.pompiste.nom_pompiste,
        station.code_station
        
        
 
   " ;

   $clients = array();

   /***********************************************DEBUT DEPENSES**************************************************** */

   $query_depenses = "

     Select
     station.depense_station.id_depense,
     station.depense_station.nature_depense,
     station.depense_station.statut_decouvert,
     station.depense_station.cloture_decouvert,
     station.depense_station.montant_depense AS montant,
     DATE(station.quart.date_ouverture) AS date,
     station.code_station AS station
     From
     depense_station Inner Join
     quart On depense_station.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region

     WHERE 

          (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
          (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
  
   
   " ;

   $res_depense_decouvert = mysqli_query($conn, $query_depenses);
 
   $data_depense_decouvert = array();

   if (is_object($res_depense_decouvert)) {


         while($rows = mysqli_fetch_array($res_depense_decouvert))

         {
              if ($rows['station'] == $station ) {

                   $obj = new stdClass();


                   $obj->status = intval($rows['statut_decouvert'] );
                   $obj->status_cloture = intval($rows['cloture_decouvert'] );

                   if ($obj->status == 0) {
                    $obj->montant = floatval($rows['montant']) ;
                   } else {
                    $obj->montant = 0 ;
                   }

                   if ( $obj->status_cloture AND $obj->status) {
                    $obj->status_affichage = 0 ;
                   } else {
                    $obj->status_affichage = 1 ;
                        
                   }
                   
                   

                   $obj->date = $rows['date'] ;
                   $obj->nature_depense = $rows['nature_depense'] ;
                   $obj->montant_initial = floatval($rows['montant']) ;
                   $obj->station = $rows['station'] ;

                   $resultat->recap_depenses[] = $obj ;
                   $resultat->recap_depenses_total += floatval($rows['montant']) ;

              }
         
         }


   }

   
   /***********************************DEBUT CREANCES CLIENTS************************************************ */
   
   
  /* $station = $requete->station->nom_client ;

   $date_init = new DateTime($requete->date_debut);
   $date_init2 = $date_init->modify('-1 day');
   $date_initiale = $date_init2->format("Y-m-d");


  $clients = array() ;

  $res_clients=mysqli_query($conn, "

          Select
          client.nom_client,
          client.code_client,
          client.solde_initial,
          client.solde_client,
          station.nom_station
     From
          client Inner Join
          station On client.id_station = station.id_station
                    And client.id_region = station.id_region
     Group By
          client.code_client,
          station.nom_station
     
          " ) ;


  
   if (is_object($res_clients)) {

      while($rows = mysqli_fetch_array($res_clients))

     {
       $clients[] = array(

        "nom_client"  =>   $rows['nom_client'],
        "code_client"  =>   $rows['code_client'],
        "solde_initial"  =>   $rows['solde_initial'],
        "solde_client"  =>   $rows['solde_client'],
        "nom_station"  =>   $rows['nom_station']
            
                 ) ;
     }
   }
  
 ********************************************************************************************************************* *

   $query_client_terme = "

   Select
  Date(station.quart.date_ouverture) As date,
  client.nom_client AS client,
  station.nom_station AS station,
  Sum(station.pompiste_has_client.quantite) As quantite,
  Sum(station.pompiste_has_client.montant) As montant

   From
   pompiste_has_client Inner Join
   quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
   station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
   client On client.id_station = station.id_station
             And client.id_region = station.id_region
             And station.pompiste_has_client.client_id_client = client.id_client

             WHERE 
   
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

            

   Group By
   Date(station.quart.date_ouverture),
   client.nom_client,
   station.nom_station
  
        
        " ;


        $query_client_init = "

        Select
       Date(station.quart.date_ouverture) As date,
       client.nom_client AS client,
      
       station.nom_station AS station,
       Sum(station.pompiste_has_client.quantite) As quantite,
       Sum(station.pompiste_has_client.montant) As montant
     
        From
        pompiste_has_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        client On client.id_station = station.id_station
                  And client.id_region = station.id_region
                  And station.pompiste_has_client.client_id_client = client.id_client

                  WHERE 
        
                  (DATE( station.quart.date_fermerture ) <= '$date_initiale' )
   
                 
   
        Group By
        Date(station.quart.date_ouverture),
        client.nom_client,
        station.nom_station
       
             
             " ;


/****************************************************************************************************************** *

   $res_client_terme = mysqli_query($conn, $query_client_terme );

   $data_client = array();

   if (is_object($res_client_terme)) {


         while($rows = mysqli_fetch_array($res_client_terme))

         {
              if ($rows['station'] == $station  ) {

                   $obj = new stdClass();

                   $obj->date = $rows['date'] ;
                   $obj->client = $rows['client'] ;
                   $obj->quantite = intval($rows['quantite']) ;
                   $obj->montant = intval($rows['montant']) ;
                   $obj->station = $rows['station'] ;

                   $data_client[] = $obj ;
              }
         
         }


   }


   $res_client_init = mysqli_query($conn, $query_client_init );

   $data_client_init = array();

   if (is_object($res_client_init)) {


         while($rows = mysqli_fetch_array($res_client_init))

         {
              if ($rows['station'] == $station ) {

                   $obj = new stdClass();

                   $obj->date = $rows['date'] ;
                   $obj->client = $rows['client'] ;
                   $obj->quantite = intval($rows['quantite']) ;

                   $obj->montant = intval($rows['montant']) ;
                   $obj->station = $rows['station'] ;

                   $data_client_init[] = $obj ;
              }
         
         }


   }

/******************************************************************************************************* *  

 
   $query_reglement = "
   
   Select

   DATE(station.reglement.date_reglement) AS date,
   station.client.nom_client AS client, 
   station.nom_station As station,
   Sum(station.reglement.montant_reglement) As montant
   
From
   reglement Inner Join
   client On reglement.id_client = client.id_client Inner Join
   station On station.reglement.id_station = station.id_station
           And station.reglement.id_region = station.id_region
          
           And station.client.id_station = station.id_station
           And station.client.id_region = station.id_region
           WHERE 
   
           (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' ) AND
           (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' )
Group By
   Date(station.reglement.date_reglement),
   station.client.nom_client,
   station.nom_station
   
          
   
   ";  

   $query_reglement_init = "
     
   Select

   DATE(station.reglement.date_reglement) AS date,
   station.client.nom_client AS client, 
   station.nom_station As station,
   Sum(station.reglement.montant_reglement) As montant
   
From
   reglement Inner Join
   client On reglement.id_client = client.id_client Inner Join
   station On station.reglement.id_station = station.id_station
           And station.reglement.id_region = station.id_region
          
           And station.client.id_station = station.id_station
           And station.client.id_region = station.id_region

           WHERE 
        
           (DATE( station.reglement.date_reglement) <= '$date_initiale' )
Group By
   Date(station.reglement.date_reglement),
   station.client.nom_client,
   station.nom_station
   
     

";  
   /********************************************************************************************************************* *


  $res_reglement_init = mysqli_query($conn, $query_reglement_init );

  $data_reglement_init = array();

  if (is_object($res_reglement_init)) {

     while($rows = mysqli_fetch_array($res_reglement_init))

    {
        if ($rows['station'] == $station) {

             $obj = new stdClass();

                  $obj->date = $rows['date'] ;
                  $obj->client = $rows['client'] ;
                  $obj->station = $rows['station'] ;
                  $obj->montant = intval($rows['montant']) ;

                  $data_reglement_init[] = $obj ;

         }
     
     }

  }

  $res_reglement = mysqli_query($conn, $query_reglement );

  $data_reglement = array();

  if (is_object($res_reglement)) {

     while($rows = mysqli_fetch_array($res_reglement))

    {
        if ($rows['station'] == $station) {

             $obj = new stdClass();

                  $obj->date = $rows['date'] ;
                  $obj->client = $rows['client'] ;
                  $obj->station = $rows['station'] ;
                  $obj->montant = intval($rows['montant']) ;

                  $data_reglement[] = $obj ;

        }
     
    }
  }

/*
   $datas_creances = array() ;


   foreach ($clients as $key => $value) {

     if ($value['nom_station'] == $station) {
          

          $data = new stdClass();

        $client =  $value['nom_client'] ;

        $montant = 0 ;
        $reglement = 0 ;

        $solde_initial = $value['solde_initial'] ;
        
        $data->code_client = $value['code_client'] ;
        $data->client = $value['nom_client'] ;
        $data->solde_anterieur = 0 ;
        $data->conso = 0 ;
        $data->montant = 0 ;
        $data->reglement = 0 ;
        $data->station = '' ;
        $data->solde = 0 ;

       
        foreach ($data_client as $key5 => $value5) {

             
             if ($value5->station == $station && $value5->client == $client) {

               $data->conso += $value5->quantite ;
               $data->montant += $value5->montant ;
               $data->station = $value5->station ;
                 
             }
        }

        foreach ($data_client_init as $key6 => $value6) {
             
          if ($value6->station == $station && $value6->client == $client) {

            $montant += $value6->montant ;
              
          }
        }

        foreach ($data_reglement as $key8 => $value8) {

             
             if ($value8->station == $station && $value8->client == $client) {

                  $data->reglement += $value8->montant ;
                  $data->station = $value8->station ;

             }
        }

        foreach ($data_reglement_init as $key9 => $value9) {

          if ($value9->station == $station && $value9->client == $client) {

               $reglement += $value9->montant ;

          }
        }

        $data->solde_anterieur = $solde_initial + $montant - $reglement ;
        $data->solde =  $data->solde_anterieur + $data->montant - $data->reglement ;

        if (! ($data->montant == 0 && $data->reglement == 0)) {
             
            $datas_creances[] = $data ;
        }

        


     }

   }


*/
     
  /*********************************************DEBUT MANQUANT POMPISTES ************************************************* */
 
     $res_carb = mysqli_query($conn, $query );
 
     $data_carb = array();
 
     if (is_object($res_carb)) {
 
        while($rows = mysqli_fetch_array($res_carb))
 
      {
           if ($rows['station'] == $station) {
 
                $obj = new stdClass() ;
 
                     $obj->date = $rows['date'] ;
                     $obj->nom_pompiste = $rows['nom_pompiste'] ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->station = $rows['station'] ;
 
                     $data_carb[] = $obj ;
 
           }
        
      }

     }
 
  /****************************************************************************************************************** */
 
     $res_client = mysqli_query($conn, $query_client );
 
     $data_client = array();
 
     if (is_object($res_client)) {
 
 
           while($rows = mysqli_fetch_array($res_client))
 
           {
                if ($rows['station'] == $station ) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->nom_pompiste = $rows['nom_pompiste'] ;
                     $obj->nom_client = $rows['nom_client'] ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->station = $rows['station'] ;
 
                     $data_client[] = $obj ;

                     $clients[] = $rows['nom_client'] ;
                }
           
           }
 
 
     }
 
  /******************************************************************************************************* */   
 
     $res_vers = mysqli_query($conn, $query_vers );
 
     $data_vers = array();
 
     if (is_object($res_vers)) {
 
 
           while($rows = mysqli_fetch_array($res_vers))
 
           {
                if ($rows['station'] == $station ) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->nom_pompiste = $rows['nom_pompiste'] ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->station = $rows['station'] ;
 
                     $data_vers[] = $obj ;
 
                     
                }
           
           }
 
 
     }
 
  /******************************************************************************************************* */  

     $pompistes = array() ;

     foreach ($data_carb as $key => $value) {
          
          $pompistes[] = $value->nom_pompiste ;
     }

     foreach ($data_client as $key => $value) {
          
          $pompistes[] = $value->nom_pompiste ;
     }

     foreach ($data_vers as $key => $value) {
          
          $pompistes[] = $value->nom_pompiste ;

     }


     $pompistes_unique = array_unique($pompistes);
     $clients_unique = array_unique($clients);

     $datas_Manquant = array() ;

     $data_total = new stdClass();
               
     $data_total->date = 'TOTAL' ;
     $data_total->pompiste = '' ;
     $data_total->ventes = 0 ;
     $data_total->ventes_client = 0 ;
     $data_total->versement = 0 ;
     $data_total->manquant = 0 ;
 
      foreach ($dates as $key => $value) {
 
           foreach ($pompistes_unique as $key2 => $value2) {
                
             $data = new stdClass();
           
             $data->date = $value ;
             $data->pompiste = $value2 ;
             $data->ventes = 0 ;
             $data->ventes_client = 0 ;
             $data->versement = 0 ;
             $data->manquant = 0 ;

            

             foreach ($data_carb as $key3 => $value3) {

                  if ($value == $value3->date && $value2 == $value3->nom_pompiste) {
                       
                       $data->ventes = $value3->montant ;
                       $data_total->ventes += $value3->montant ;

                  }
                
             }

             foreach ($data_client as $key4 => $value4) {
                
                  if ($value == $value4->date && $value2 == $value4->nom_pompiste) {
                       
                       $data->ventes_client += $value4->montant ;
                       $data_total->ventes_client += $value4->montant ;
                       
                  }
             }

             foreach ($data_vers as $key5 => $value5) {
                
                  if ($value == $value5->date && $value2 == $value5->nom_pompiste) {
                       
                       $data->versement = $value5->montant ;
                       $data_total->versement += $value5->montant ;
                       
                  }
             }

             $data->manquant = $data->ventes - $data->ventes_client - $data->versement ;

             $data_total->manquant = $data_total->ventes - $data_total->ventes_client - $data_total->versement ;

             
                     

                             $datas[] = $data ;
                      
           }
          
      }
 
      $datas_Manquant[] = $data_total ;  

      $obj = new stdClass ;
      $data_recap_manquant = array() ;

      $obj->nom = 'MANQUANT POMPISTES' ;
      $obj->montant = $datas_Manquant[0]->manquant ;

      $data_recap_manquant[]= $obj ;


      $resultat->recap_manquant = $data_recap_manquant ;
      $resultat->recap_manquant_total = $datas_Manquant[0]->manquant ;

     /**************************************************FIN MANQUANTS POMPISTES *********************************** */

     /********************************************DEBUT TRAITEMENT CREANCES CLIENTS *********************************** */

     //$resultat->recap_creances = $datas_creances ;

     $resultat->recap_creances = Etats_Creances_Station2 ($requete->date_debut, $requete->date_fin, $requete->client->code_client) ;

     $resultat->recap_creances_total = 0 ;

     foreach ($resultat->recap_creances as $key => $value) {
          
          $resultat->recap_creances_total += $value->solde ;
     }

     /*******************************************FIN CREANCES CLIENTS********************************************************* */

       print_r(json_encode($resultat));
       return json_encode($resultat);  


       
}



function Etats_Ventes_Reseau_Conso() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->ventes;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $quart = $requete->quart ;
        
        //$station = $requete->station ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));


        $stations = [] ;
   
        /********************************************MANQUANTS******************************************************************* */
   
        $query_depenses = "
        
             Select
             Sum(station.depense_station.montant_depense) As montant,
             Date(station.quart.date_ouverture) As date,
             station.nom_station As station
        From
             depense_station Inner Join
             quart On depense_station.id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region
   
                  WHERE 
           
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        Group By
             
             Date(station.quart.date_ouverture),
             station.nom_station
        
        " ;
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "

        Select
        Date(station.quart.date_ouverture) As date,
        client.nom_client AS client,
        station.nom_station AS station,
        Sum(station.pompiste_has_client.montant) As montant,
        client.id_client
         From
         pompiste_has_client Inner Join
         quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
         station On station.quart.id_station = station.id_station
                   And station.quart.id_region = station.id_region Inner Join
         client On client.id_station = station.id_station
                   And client.id_region = station.id_region
                   And station.pompiste_has_client.client_id_client = client.id_client
    
                   WHERE 
           
                   (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                   (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )   
    
         Group By
         Date(station.quart.date_ouverture),
         client.nom_client,
         station.nom_station,
         client.id_client
             
             " ;
    
     /************************************************************************************************************************ */
    
         $query_vers_pompiste = " 
   
           Select
           Date(station.quart.date_ouverture) As date,
           station.nom_station As station,
           Sum(station.versement_pompiste.montant_versement) As montant
      From
      versement_pompiste Inner Join
      quart On versement_pompiste.id_quart = quart.id_quart Inner Join
      pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
      station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
                And station.pompiste.id_station = station.id_station
                And station.pompiste.id_region = station.id_region
      WHERE 
           
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
      Group By
           Date(station.quart.date_ouverture),
           station.nom_station
           
           
    
      " ;
   
   
        /******************** REQUETES MANQUANTS POMPISTES********************************************************************* */  
      
        $res_depenses = mysqli_query($conn, $query_depenses );
    
        $data_depenses = array();
    
        if (is_object($res_depenses)) {
    
    
              while($rows = mysqli_fetch_array($res_depenses))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_depenses[] = $obj ;
              
              }
    
    
        }
      
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->id_client = $rows['id_client'] ;
                        $obj->client = $rows['client'] ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
     $res_vers_pompiste = mysqli_query($conn, $query_vers_pompiste );
    
        $data_vers_pompiste = array();
    
        if (is_object($res_vers_pompiste)) {
    
    
              while($rows = mysqli_fetch_array($res_vers_pompiste))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_vers_pompiste[] = $obj ;
    
              
              }
    
    
        }
    
     /******************************************************************************************************* */  
   
      
        $query = "
        
        Select
    Date(station.quart.date_ouverture) As date,
    Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
    (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise + 0.0)) As quantite,
    Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
    (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise + 0.0)) *
    produit_station.prix_produit As montant,
    station.produit.nom_produit As produit,
    station.nom_station As station,
    region.nom_region AS region
 From
    pompiste_pistolet Inner Join
    pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
            And pompiste_pistolet.id_cuve = pistolet.id_cuve
            And pompiste_pistolet.id_station = pistolet.id_station
            And pompiste_pistolet.id_region = pistolet.id_region
            And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
    cuves On pistolet.id_cuve = cuves.id_cuve
            And pistolet.id_station = cuves.id_station
            And pistolet.id_region = cuves.id_region Inner Join
    produit On cuves.id_produit = produit.id_produit Inner Join
    quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
    station On station.quart.id_station = station.id_station
            And station.quart.id_region = station.id_region Inner Join
    produit_station On produit_station.id_produit = station.produit.id_produit
            And produit_station.id_station = station.id_station
            And produit_station.id_region = station.id_region Inner Join
    region On station.id_region = region.id_region

    WHERE 
        
    (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
    (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
    Date(station.quart.date_ouverture),
    station.produit.nom_produit,
    station.nom_station,
    region.nom_region
        
        
        ";  
        /********************************************************************************************************************* */
   
        $query_Lub = "
   
        SELECT
        DATE(station.quart.date_ouverture)AS date,
        SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
        station.nom_station AS station
        FROM
        produit_quart
        INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
        INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
        INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
        WHERE 
        
        (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
        (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        GROUP BY
        
        DATE(station.quart.date_ouverture),
        station.nom_station
   
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
   
     " ;
       
    /************************************************************************************************** */
    $query_vers_client = " 
     
    Select
       station.client.nom_client As client,
       station.nom_station As station,
       Sum(station.reglement.montant_reglement) As montant,
       DATE(station.quart.date_ouverture) As date
    From
       reglement Inner Join
       client On reglement.id_client = client.id_client Inner Join
       station On station.reglement.id_station = station.id_station
               And station.reglement.id_region = station.id_region
               And station.client.id_station = station.id_station
               And station.client.id_region = station.id_region Inner Join
       quart On station.quart.id_station = station.station.id_station
               And station.quart.id_region = station.station.id_region
               And station.reglement.id_quart = station.quart.id_quart
    WHERE 
   
    (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) AND
    (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) 
   
        Group By
        DATE(station.quart.date_ouverture),
        station.client.nom_client,
        station.station.nom_station " ;
   
    /******************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->quantite = intval($rows['quantite']) ;
                       $obj->produit = $rows['produit'] ;
                       $obj->station = $rows['station'] ;
                       $obj->region = $rows['region'] ;
                       $obj->montant = $rows['montant'] ;
   
                       $data_carb[] = $obj ;

                       $stations[] = $rows['station'] ;
        }
   
          
       }
   
    /****************************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query_Lub );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
   
             while($rows = mysqli_fetch_array($res_lub))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
             
             }
   
   
       }

       /******************************************************************************************************* */ 
    
    $res_vers_client = mysqli_query($conn, $query_vers_client );

    $data_vers_client = array(); 

     if (is_object($res_vers_client)) {

          while($rows = mysqli_fetch_array($res_vers_client))

          {
                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->client = $rows['client'] ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vers_client[] = $obj ;
          
          }

     }

 

 /*************************************************************************** */
   
    /******************************************************************************************************* */  
   
        $datas = array() ;
   
        $stations_unique = array_unique($stations) ;

        $data_total = new stdClass();
   
        $data_total->station = 'TOTAL' ;
        $data_total->super = 0 ;
        $data_total->gasoil = 0 ;
        $data_total->petrole = 0 ;
        $data_total->tpc = 0 ;
        $data_total->total_carb = 0 ;
        $data_total->total_lub = 0 ;
        $data_total->total_attendu = 0 ;
        $data_total->versement = 0 ;
        $data_total->ventes_client = 0 ;
        $data_total->versement_pompistes = 0 ;
        $data_total->manquant_pompiste = 0 ;
        $data_total->depense = 0 ;
        $data_total->ecart = 0 ;
        $data_total->ecart_gerant = 0 ;
        $data_total->vte_client = 0 ;
        $data_total->total_clients = 0 ;
        $data_total->total_vers_clients = 0 ;
   
   
        foreach ($stations_unique as $key => $value) {
   
             $data = new stdClass();
             $station = $value ;
   
             $data->station = $value ;
             $data->region = '' ;
             $data->super = 0 ;
             $data->gasoil = 0 ;
             $data->petrole = 0 ;
             $data->tpc = 0 ;
             $data->total_carb = 0 ;
             $data->total_lub = 0 ;
             $data->total_attendu = 0 ;
             $data->versement = 0 ;
             $data->ventes_client = 0 ;
             $data->versement_pompistes = 0 ;
             $data->manquant_pompiste = 0 ;
             $data->depense = 0 ;
             $data->ecart = 0 ;
             $data->ecart_gerant = 0 ;
             $data->vte_client = 0 ;
             $data->total_clients = 0 ;
             $data->total_vers_clients = 0 ;
   
   
   
             foreach ($data_carb as $key2 => $value2) {
                  
                       
               if ($value2->station == $station) {

                    $data->region = $value2->region ;
                    
                    if ($value2->produit == 'SUPER') {
   
                         $data->super += $value2->quantite ;
                         $data_total->super += $value2->quantite ;
   
                       } elseif ($value2->produit == 'GASOIL') {
   
                         $data->gasoil += $value2->quantite ;
                         $data_total->gasoil += $value2->quantite ;
   
                       } elseif ($value2->produit == 'PETROLE'){
                            
                         $data->petrole += $value2->quantite ;
                         $data_total->petrole += $value2->quantite ;
                       }
   
                       $data->tpc += $value2->quantite ;
                       $data->total_carb += $value2->montant ;

                       $data_total->tpc += $value2->quantite ;
                       $data_total->total_carb += $value2->montant ;
               }   
                       
             
             }
   
             foreach ($data_lub as $key3 => $value3) {
                  
                       
               if ($value3->station == $station) {

                    $data->total_lub += $value3->montant ;
                    $data_total->total_lub += $value3->montant ;
               }
                       
             }
   
             foreach ($data_vers as $key4 => $value4) {
                       
              if ($value4->station == $station) {
                   
                    $data->versement += $value4->montant ;
                    $data_total->versement += $value4->montant ;
              }
                  
             }
   
             foreach ($data_client as $key5 => $value5) {

   
               if ($value5->station == $station) {

                    $data->ventes_client += $value5->montant ;
                    
                    $data->vte_client += $value5->montant ;
                    $data_total->vte_client += $value5->montant ;
               }
                  
             }
   
             foreach ($data_vers_pompiste as $key6 => $value6) {
   
               if ($value6->station == $station) {
                    
                    $data->versement_pompistes += $value6->montant ;
                    $data_total->versement_pompistes += $value6->montant ;
               }
                 
             }
   
             foreach ($data_depenses as $key7 => $value7) {
                  
               if ($value7->station == $station) {
                    
                    $data->depense += $value7->montant ;
                    $data_total->depense += $value7->montant ;        
               }
                  
             }

             foreach ($data_vers_client as $key13 => $value13) {
   
               if ($value13->station == $station) {
               
                    $data->total_vers_clients += $value13->montant ;
                    $data_total->total_vers_clients += $value13->montant ;
               } 
               
             }
   
   
             $data->total_attendu = $data->total_carb + $data->total_lub + $data->total_vers_clients;
             $data->ecart = $data->total_attendu - $data->versement ;
             $data->manquant_pompiste = $data->total_carb - $data->ventes_client - $data->versement_pompistes ;

             $data_total->total_attendu += ($data->total_carb + $data->total_lub + $data->total_vers_clients) ;
             $data_total->ecart += ($data->total_attendu - $data->versement) ;
             $data_total->manquant_pompiste += ($data->total_carb - $data->ventes_client - $data->versement_pompistes) ;
   
             $data->ecart_gerant =  $data->ecart - $data->manquant_pompiste - $data->depense ;

             $data_total->ecart_gerant +=  ($data->ecart - $data->manquant_pompiste - $data->depense) ;
   
             foreach ($data_client as $key8 => $value8) {
   
              if ($value8->station == $station) {
                   
                    $data->ecart_gerant -= $value8->montant ;
                    $data_total->ecart_gerant -= $value8->montant ;
              }
   
             }
             
             $datas[] = $data ;
        }

        $datas[] = $data_total ;
   
   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
       
}

function Etats_Coulages_Conso() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
      // connect DB
      $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));


    
   
      
       $requete = $data->coulages;
   
       $date_debut = $date_fin =  '' ;
       
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;

       // $station = $requete->station ;
        $stations = [] ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
       
        $dates = [] ;
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);

        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }

     /****************************************************************************************************************************** */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise +0.0)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise +0.0))* produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.nom_station As station
     
     From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And pompiste_pistolet.id_cuve = pistolet.id_cuve
               And pompiste_pistolet.id_station = pistolet.id_station
               And pompiste_pistolet.id_region = pistolet.id_region
               And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
               And produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region

     WHERE 
     
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.nom_station
     
     
     ";  
     /********************************************************************************************************************* */

     $query_vte_lub = "

     SELECT
     DATE(station.quart.date_ouverture)AS date,
     SUM(produit_quart.qte_vendu) AS quantite,
     SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
     produit.nom_produit AS produit,
     station.nom_station AS station
     FROM
     produit_quart
     INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
     WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     GROUP BY
     
     DATE(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station

    
    " ;

 /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station AS station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
     

     " ;


     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    

     $query_stock_ouverture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '07:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     $query_stock_fermerture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '17:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     
 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;
                    $obj->montant = intval($rows['montant']) ;

                    $data_vte_carb[] = $obj ;
                    $stations[] = $rows['station'] ;

       
      }
    }

 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;
                    $stations[] = $rows['station'] ;
          
          }


    }

 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_carb[] = $obj ;
                    $stations[] = $rows['station'] ;

                    
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;
                    $stations[] = $rows['station'] ;

                    
          
          }


    }

     /******************************************************************************************************* */  

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
                     $stations[] = $rows['station'] ;
 
                     
           
           }
 
 
     }
       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;
                     $stations[] = $rows['station'] ;
 
                     
           
           }
 
     }

     /******************************************************************************************************* */   

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
                     $stations[] = $rows['station'] ;
                     
           
           }
 
 
     }
       
     /******************************************************************************************************** */

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;
                     $stations[] = $rows['station'] ;
 
                     
           }
 
 
     }
   /******************************************************************************************************************** */

   $stations_unique = array_unique($stations) ;

   $data_total = new stdClass();

   $data_total->station = 'TOTAL' ;

   $data_total->cou_gasoil_l = 0 ;
   $data_total->cou_super_l = 0 ;
   $data_total->cou_petrole_l = 0 ;
   $data_total->cou_lubrifiant_l = 0 ;
   $data_total->cou_total_l = 0 ;
   
   $data_total->cou_gasoil_m = 0 ;
   $data_total->cou_super_m = 0 ;
   $data_total->cou_petrole_m = 0 ;
   $data_total->cou_lubrifiant_m = 0 ;
   $data_total->cou_total_m = 0 ;


        $datas = array() ;

        foreach ($stations_unique as $key => $value) {

   
             $data = new stdClass();

             $station = $value ;
   
           // $data->date = $value ;
              $data->station = $value ;

             $data->si_gasoil_l = 0 ;
             $data->si_super_l = 0 ;
             $data->si_petrole_l = 0 ;
             $data->si_lubrifiant_l = 0 ;

             $data->si_gasoil_m = 0 ;
             $data->si_super_m = 0 ;
             $data->si_petrole_m = 0 ;
             $data->si_lubrifiant_m = 0 ;

             $data->liv_gasoil_l = 0 ;
             $data->liv_super_l = 0 ;
             $data->liv_petrole_l = 0 ;
             $data->liv_lubrifiant_l = 0 ;
             
             $data->liv_gasoil_m = 0 ;
             $data->liv_super_m = 0 ;
             $data->liv_petrole_m = 0 ;
             $data->liv_lubrifiant_m = 0 ;

             $data->vte_gasoil_l = 0 ;
             $data->vte_super_l = 0 ;
             $data->vte_petrole_l = 0 ;
             $data->vte_lubrifiant_l = 0 ;
             
             $data->vte_gasoil_m = 0 ;
             $data->vte_super_m = 0 ;
             $data->vte_petrole_m = 0 ;
             $data->vte_lubrifiant_m = 0 ;

             $data->st_gasoil_l = 0 ;
             $data->st_super_l = 0 ;
             $data->st_petrole_l = 0 ;
             $data->st_lubrifiant_l = 0 ;
             
             $data->st_gasoil_m = 0 ;
             $data->st_super_m = 0 ;
             $data->st_petrole_m = 0 ;
             $data->st_lubrifiant_m = 0 ;

             $data->sf_gasoil_l = 0 ;
             $data->sf_super_l = 0 ;
             $data->sf_petrole_l = 0 ;
             $data->sf_lubrifiant_l = 0 ;
             
             $data->sf_gasoil_m = 0 ;
             $data->sf_super_m = 0 ;
             $data->sf_petrole_m = 0 ;
             $data->sf_lubrifiant_m = 0 ;

             $data->cou_gasoil_l = 0 ;
             $data->cou_super_l = 0 ;
             $data->cou_petrole_l = 0 ;
             $data->cou_lubrifiant_l = 0 ;
             
             $data->cou_gasoil_m = 0 ;
             $data->cou_super_m = 0 ;
             $data->cou_petrole_m = 0 ;
             $data->cou_lubrifiant_m = 0 ;

             $data->cou_total_l = 0 ;
             $data->cou_total_m = 0 ;
             

            
             foreach ($data_stock_ouverture_carb as $key1 => $value1) {
   
                  if ($value1->date == $date_debut2 && $value1->station == $station) {
   
                         if ($value1->produit == 'SUPER') {

                            
                              $data->si_super_l = $value1->quantite ;
                              $data->si_super_m = $value1->montant ;

                         
                         } elseif ($value1->produit == 'GASOIL') {

                              $data->si_gasoil_l = $value1->quantite ;
                              $data->si_gasoil_m = $value1->montant ;

                         } else {

                              $data->si_petrole_l = $value1->quantite ;
                              $data->si_petrole_m = $value1->montant ;


                         }
                    
                      
                  }
             }

             foreach ($data_stock_ouverture_lub as $key2 => $value2) {
   
               if ($value2->date == $date_debut2 && $value2->station == $station) {

                    $data->si_lubrifiant_l += $value2->quantite ;
                    $data->si_lubrifiant_m += $value2->montant ;

               }
             }

             foreach ($data_livr_carb as $key3 => $value3) {
   
               if ($value3->station == $station) {

                      if ($value3->produit == 'SUPER') {

                         
                           $data->liv_super_l += $value3->quantite ;
                           $data->liv_super_m += $value3->montant ;

                      
                      } elseif ($value3->produit == 'GASOIL') {

                           $data->liv_gasoil_l += $value3->quantite ;
                           $data->liv_gasoil_m += $value3->montant ;

                      } else {

                           $data->liv_petrole_l += $value3->quantite ;
                           $data->liv_petrole_m += $value3->montant ;


                      }
                 
                   
               }
             }

             foreach ($data_livr_lub as $key4 => $value4) {
   
               if ( $value4->station == $station) {

                    $data->liv_lubrifiant_l += $value4->quantite ;
                    $data->liv_lubrifiant_m += $value4->montant ;

               }
             }

             foreach ($data_vte_carb as $key5 => $value5) {
   
               if ( $value5->station == $station ) {

                      if ($value5->produit == 'SUPER') {

                         
                           $data->vte_super_l += $value5->quantite ;
                           $data->vte_super_m += $value5->montant ;

                      
                      } elseif ($value5->produit == 'GASOIL') {

                           $data->vte_gasoil_l += $value5->quantite ;
                           $data->vte_gasoil_m += $value5->montant ;

                      } else {

                           $data->vte_petrole_l += $value5->quantite ;
                           $data->vte_petrole_m += $value5->montant ;


                      }
                   
               }
             }  

             foreach ($data_vte_lub as $key6 => $value6) {
   
               if ($value6->station == $station ) {

                    $data->vte_lubrifiant_l += $value6->quantite ;
                    $data->vte_lubrifiant_m += $value6->montant ;

               }
             }

             foreach ($data_stock_fermerture_carb as $key7 => $value7) {
   
               if ($value7->date == $date_fin2 && $value7->station == $station) {

                      if ($value7->produit == 'SUPER') {

                         
                           $data->sf_super_l = $value7->quantite ;
                           $data->sf_super_m = $value7->montant ;

                      
                      } elseif ($value7->produit == 'GASOIL') {

                           $data->sf_gasoil_l = $value7->quantite ;
                           $data->sf_gasoil_m = $value7->montant ;

                      } else {

                           $data->sf_petrole_l = $value7->quantite ;
                           $data->sf_petrole_m = $value7->montant ;


                      }
                 
                   
               }
             }

             foreach ($data_stock_fermerture_lub as $key8 => $value8) {
   
               if ($value8->date == $date_fin2 && $value8->station == $station) {

                    $data->sf_lubrifiant_l = $value8->quantite ;
                    $data->sf_lubrifiant_m = $value8->montant ;

               }
             }


             $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
             $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
             $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
             $data->st_lubrifiant_l = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;
             
             $data->st_gasoil_m = $data->si_gasoil_m + $data->liv_gasoil_m - $data->vte_gasoil_m ;
             $data->st_super_m = $data->si_super_m + $data->liv_super_m - $data->vte_super_m ;
             $data->st_petrole_m = $data->si_petrole_m + $data->liv_petrole_m - $data->vte_petrole_m ;
             $data->st_lubrifiant_m = $data->si_lubrifiant_m + $data->liv_lubrifiant_m - $data->vte_lubrifiant_m ;

             $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
             $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
             $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
             $data->cou_lubrifiant_l = $data->sf_lubrifiant_l - $data->st_lubrifiant_l ;
             
             $data->cou_gasoil_m = $data->sf_gasoil_m - $data->st_gasoil_m ;
             $data->cou_super_m = $data->sf_super_m - $data->st_super_m ;
             $data->cou_petrole_m = $data->sf_petrole_m - $data->st_petrole_m ;
             $data->cou_lubrifiant_m = $data->sf_lubrifiant_m - $data->st_lubrifiant_m ;

             $data->cou_total_l = $data->cou_gasoil_l + $data->cou_super_l + $data->cou_petrole_l ;
             $data->cou_total_m = $data->cou_gasoil_m + $data->cou_super_m + $data->cou_petrole_m;

             /********************************************TOTAL COULAGES********************************************************* */
   
             $data_total->cou_gasoil_l += ($data->sf_gasoil_l - $data->st_gasoil_l);
             $data_total->cou_super_l += ($data->sf_super_l - $data->st_super_l) ;
             $data_total->cou_petrole_l += ($data->sf_petrole_l - $data->st_petrole_l) ;
             $data_total->cou_lubrifiant_l += ($data->sf_lubrifiant_l - $data->st_lubrifiant_l) ;
             
             $data_total->cou_gasoil_m += ($data->sf_gasoil_m - $data->st_gasoil_m) ;
             $data_total->cou_super_m += ($data->sf_super_m - $data->st_super_m );
             $data_total->cou_petrole_m += ($data->sf_petrole_m - $data->st_petrole_m );
             $data_total->cou_lubrifiant_m += ($data->sf_lubrifiant_m - $data->st_lubrifiant_m) ;
             

             $data_total->cou_total_l += ($data->cou_gasoil_l + $data->cou_super_l + $data->cou_petrole_l) ;
             $data_total->cou_total_m += ($data->cou_gasoil_m + $data->cou_super_m + $data->cou_petrole_m);

             
             $datas[] = $data ;
            
        }

          $datas[] = $data_total ;

   
       print_r(json_encode($datas));
       return json_encode($datas);  


       
}

function get_stock() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL stock($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "nom_station"  => $rows['nom_station'],
                  "nom_produit"  => $rows['nom_produit'],
                  "date_ouverture"  => $rows['date_ouverture'],
                  "date_fermerture"  => $rows['date_fermerture'],
                  "jauge_depart"  => $rows['Jauge_depart'],
                  "jauge_fin"  => $rows['jauge_fin'],
                  
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function Nettoyer_Reglement() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      // print_r($data)   ;
       
        $date_versement       = $data->nettoyer;
       
               $res=mysqli_query($conn, "
    
               CALL nettoyer_versement('$date_versement', $id_station) ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Restaurer_Reglement() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      // print_r($data)   ;
       
        $date_versement       = $data->restaurer;
       
               $res=mysqli_query($conn, "
    
               CALL restaurer_versement('$date_versement', $id_station) ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Nettoyer_Depense() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      // print_r($data)   ;
       
        $date_depense       = $data->nettoyer;
       
               $res=mysqli_query($conn, "
    
               CALL nettoyer_depense('$date_depense', $id_station) ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Nettoyer_Coulage() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      // print_r($data)   ;
       
        $id_coulage       = $data->id_coulage ;
       
               $res=mysqli_query($conn, "
    
               UPDATE `coulage_decouvert` SET `statut_decouvert` = '1' WHERE `coulage_decouvert`.`id_coulage` = $id_coulage ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Cloturer_Decouvert_Coulage() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      print_r($data)   ;

      $quantite       = $data->quantite ;
      $montant       = $data->montant2 ;
      $station       = $data->station ;
      $libelle_coulage       = $data->libelle_coulage ;
      $periode_coulage       = $data->periode_coulage ;
      
       
               $res=mysqli_query($conn, "
    
               INSERT INTO `coulage_decouvert` (`libelle_coulage`, `periode_coulage`, `quantite`, `montant`, `code_station`) 
               VALUES ('$libelle_coulage', '$periode_coulage', '$quantite', '$montant', '$station');
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Restaurer_Depense() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      // print_r($data)   ;
       
        $date_depense       = $data->restaurer;
       
               $res=mysqli_query($conn, "
    
               CALL restaurer_depense('$date_depense', $id_station) ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Restaurer_Coulage() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
     
      // print_r($data)   ;
       
        $id_coulage      = $data->restaurer->id_coulage;
       
               $res=mysqli_query($conn, "
    
               UPDATE `coulage_decouvert` SET `statut_decouvert` = '0' WHERE `coulage_decouvert`.`id_coulage` = $id_coulage ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Cloturer_Decouvert() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input")) ;
     
      // print_r($data)   ;
       

     // var_dump($data) ;

     // $date_fin = '' ;

      $date_fin  = $data->date_fin ;
      $montant  = $data->montant ;

     
     // var_dump($date_fin) ;

      $date_fin = new DateTime($date_fin); 
      $date_fin = $date_fin->format('Y-m-d') ;
     
     // var_dump($date_fin) ;

               $res=mysqli_query($conn, "
    
               CALL cloturer_decouvert('$date_fin', $montant, $id_station) ;
               
               " ) ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Nettoyer_Livraison() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
       
        $data = $data->nettoyer;
       // print_r($data)   ;
        
        $date_livraison = $data->date ;
        $numero_bon = $data->num_bon ;
        $produit = $data->produit ;
        $id_livraison = $data->id_livraison ;
       
               $res=mysqli_query($conn, "
               
              CALL nettoyer_livraison('$date_livraison', '$numero_bon', '$produit', $id_station, $id_region, $id_livraison) ;
    
              ") ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
              }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function Restaurer_Livraison() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
    
     
     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
    
       $data = json_decode(file_get_contents("php://input"));
       
        $data = $data->restaurer;
       // print_r($data)   ;
        
        $date_livraison = $data->date ;
        $numero_bon = $data->num_bon ;
        $produit = $data->produit ;
        $id_livraison = $data->id_livraison ;
       
               $res=mysqli_query($conn, "
               
              CALL restaurer_livraison('$date_livraison', '$numero_bon', '$produit', $id_station, $id_region, $id_livraison) ;
    
              ") ;
                  
               if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
              }
    
       $arr = array('msg' => '' , 'error' => 'Error In inserting record');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);  
    
        
}

function get_stock_station() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL stock_station($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "nom_station"  => $rows['nom_station'],
                  "nom_produit"  => $rows['nom_produit'],
                  "date_ouverture"  => $rows['date_ouverture'],
                  "date_fermerture"  => $rows['date_fermerture'],
                  "jauge_depart"  => $rows['Jauge_depart'],
                  "jauge_fin"  => $rows['jauge_fin'],
                  
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_livraison() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL livraison($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "nom_station"  => $rows['nom_station'],
                  "nom_produit"  => $rows['nom_produit'],
                  "date_ouverture"  => $rows['date_ouverture'],
                  "date_fermerture"  => $rows['date_fermerture'],
                  "qte_recu"  => $rows['qte_recu']
                  
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function Etats_Manquants_pompiste() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
        $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->manquant;
   
       $date_debut = $date_fin = $quart = $station = $pompiste = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $quart = $requete->quart ;
      //  $station = $requete->station ;
        $station = $id_station ;
        $pompiste = $requete->pompiste ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
       $query = "
       
       Select
       Date(station.quart.date_ouverture) As date,
       station.pompiste.nom_pompiste,
       Sum(((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
       (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
       produit_station.prix_produit) As montant,
       station.id_station AS station
   From
       pompiste_pistolet Inner Join
       pompiste On pompiste_pistolet.id_pompiste = pompiste.id_pompiste Inner Join
       quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region Inner Join
       produit On produit_station.id_produit = produit.id_produit Inner Join
       cuves On cuves.id_produit = produit.id_produit Inner Join
       pistolet On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region
               And station.pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And station.pompiste_pistolet.id_cuve = pistolet.id_cuve
               And station.pompiste_pistolet.id_station = pistolet.id_station
               And station.pompiste_pistolet.id_region = pistolet.id_region
               And station.pompiste_pistolet.id_pompe = pistolet.id_pompe
               
   WHERE 
        
        (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
        (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
   Group By
       Date(station.quart.date_ouverture),
       station.pompiste.nom_pompiste,
       station.id_station
       
       ";  
    /********************************************************************************************************************* */
   
       $query_client = "

       Select
       Date(station.quart.date_ouverture) As date,
       station.pompiste.nom_pompiste,
       Sum(station.pompiste_has_client.montant) As montant,
       station.id_station As station
   From
       pompiste_has_client Inner Join
       quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
       client On pompiste_has_client.client_id_client = client.id_client Inner Join
       produit On pompiste_has_client.produit_id_produit = produit.id_produit Inner Join
       pompiste On pompiste_has_client.pompiste_id_pompiste = pompiste.id_pompiste Inner Join
       client_produit On client_produit.id_client = client.id_client
               And client_produit.id_produit = produit.id_produit Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region

     WHERE 

     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
   Group By
       Date(station.quart.date_ouverture),
       station.pompiste.nom_pompiste,
       station.id_station
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 

          Select
          Date(station.quart.date_ouverture) As date,
          station.pompiste.nom_pompiste,
          station.id_station As station,
          Sum(station.versement_pompiste.montant_versement) As montant
     From
     versement_pompiste Inner Join
     quart On versement_pompiste.id_quart = quart.id_quart Inner Join
     pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region
               And station.pompiste.id_station = station.id_station
               And station.pompiste.id_region = station.id_region
     WHERE 
          
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
          Date(station.quart.date_ouverture),
          station.pompiste.nom_pompiste,
          station.id_station
          
          
   
     " ;
       
    /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
             if ($rows['station'] == $station && $rows['nom_pompiste'] == $pompiste) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_carb[] = $obj ;
   
             }
          
       }
   
    /****************************************************************************************************************** */
   
       $res_client = mysqli_query($conn, $query_client );
   
       $data_client = array();
   
       if (is_object($res_client)) {
   
   
             while($rows = mysqli_fetch_array($res_client))
   
             {
                  if ($rows['station'] == $station && $rows['nom_pompiste'] == $pompiste ) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_client[] = $obj ;
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
                  if ($rows['station'] == $station && $rows['nom_pompiste'] == $pompiste ) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
                       
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */  

    $pompistes = array() ;

    foreach ($data_carb as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;
    }

    foreach ($data_client as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;
    }

    foreach ($data_vers as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;

    }


    $pompistes_unique = array_unique($pompistes);


   
    $datas = array() ;

    $data_total = new stdClass();
             
    $data_total->date = 'TOTAL' ;
    $data_total->pompiste = '' ;
    $data_total->ventes = 0 ;
    $data_total->ventes_client = 0 ;
    $data_total->versement = 0 ;
    $data_total->manquant = 0 ;
   
        foreach ($dates as $key => $value) {
   
             foreach ($pompistes_unique as $key2 => $value2) {
                  
               $data = new stdClass();
             
               $data->date = $value ;
               $data->pompiste = $value2 ;
               $data->ventes = 0 ;
               $data->ventes_client = 0 ;
               $data->versement = 0 ;
               $data->manquant = 0 ;

              

               foreach ($data_carb as $key3 => $value3) {

                    if ($value == $value3->date && $value2 == $value3->nom_pompiste) {
                         
                         $data->ventes = $value3->montant ;
                         $data_total->ventes += $value3->montant ;

                    }
                  
               }

               foreach ($data_client as $key4 => $value4) {
                  
                    if ($value == $value4->date && $value2 == $value4->nom_pompiste) {
                         
                         $data->ventes_client = $value4->montant ;
                         $data_total->ventes_client += $value4->montant ;
                         
                    }
               }

               foreach ($data_vers as $key5 => $value5) {
                  
                    if ($value == $value5->date && $value2 == $value5->nom_pompiste) {
                         
                         $data->versement = $value5->montant ;
                         $data_total->versement += $value5->montant ;
                         
                    }
               }

               $data->manquant = $data->ventes - $data->ventes_client - $data->versement ;

               $data_total->manquant = $data_total->ventes - $data_total->ventes_client - $data_total->versement ;

               
                       

                               $datas[] = $data ;
                        

             
             }
            
        }
   
        $datas[] = $data_total ;  
   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      }
       
}

function Etats_Manquants() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->manquant;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $quart = $requete->quart ;
        $station = $requete->station ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
   
   
   
      
   
       $query = "
       
       Select
       Date(station.quart.date_ouverture) As date,
       station.pompiste.nom_pompiste,
       Sum(((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
       (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
       produit_station.prix_produit) As montant,
       station.nom_station AS station
   From
       pompiste_pistolet Inner Join
       pompiste On pompiste_pistolet.id_pompiste = pompiste.id_pompiste Inner Join
       quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region Inner Join
       produit On produit_station.id_produit = produit.id_produit Inner Join
       cuves On cuves.id_produit = produit.id_produit Inner Join
       pistolet On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region
               And station.pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And station.pompiste_pistolet.id_cuve = pistolet.id_cuve
               And station.pompiste_pistolet.id_station = pistolet.id_station
               And station.pompiste_pistolet.id_region = pistolet.id_region
               And station.pompiste_pistolet.id_pompe = pistolet.id_pompe
               
   WHERE 
        
        (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
        (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
   Group By
       Date(station.quart.date_ouverture),
       station.pompiste.nom_pompiste,
       station.nom_station
       
       ";  
    /********************************************************************************************************************* */
   
       $query_client = "

       Select
       Date(station.quart.date_ouverture) As date,
       station.pompiste.nom_pompiste,
       Sum(station.pompiste_has_client.montant) As montant,
       station.nom_station As station
   From
       pompiste_has_client Inner Join
       quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
       client On pompiste_has_client.client_id_client = client.id_client Inner Join
       produit On pompiste_has_client.produit_id_produit = produit.id_produit Inner Join
       pompiste On pompiste_has_client.pompiste_id_pompiste = pompiste.id_pompiste Inner Join
       client_produit On client_produit.id_client = client.id_client
               And client_produit.id_produit = produit.id_produit Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region

     WHERE 

     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
   Group By
       Date(station.quart.date_ouverture),
       station.pompiste.nom_pompiste,
       station.nom_station
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 

          Select
          Date(station.quart.date_ouverture) As date,
          station.pompiste.nom_pompiste,
          station.nom_station As station,
          Sum(station.versement_pompiste.montant_versement) As montant
     From
     versement_pompiste Inner Join
     quart On versement_pompiste.id_quart = quart.id_quart Inner Join
     pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region
               And station.pompiste.id_station = station.id_station
               And station.pompiste.id_region = station.id_region
     WHERE 
          
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
          Date(station.quart.date_ouverture),
          station.pompiste.nom_pompiste,
          station.nom_station
          
          
   
     " ;
       
    /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_carb[] = $obj ;
   
             }
          
       }
   
    /****************************************************************************************************************** */
   
       $res_client = mysqli_query($conn, $query_client );
   
       $data_client = array();
   
       if (is_object($res_client)) {
   
   
             while($rows = mysqli_fetch_array($res_client))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_client[] = $obj ;
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
                       
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */  

    $pompistes = array() ;

    foreach ($data_carb as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;
    }

    foreach ($data_client as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;
    }

    foreach ($data_vers as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;

    }


    $pompistes_unique = array_unique($pompistes);

     // Creation des variables dynamiques 

     foreach ($dates as $key => $value) {

          ${'data_'.$value} = 0 ;

      }

      

   
      $datas = array() ;
      $datas2 = array() ;

     $data_total = new stdClass();

     $data_total->pompiste = 'TOTAL' ;
     $data_total->manquant = [] ;
     $data_total->total = 0 ;

     // GESTION EN-TETE

          $data3 = array() ;
          $data3[] = 'POMPISTE' ;
     
          foreach ($dates as $key20 => $value20) {

               $data3[] = 'MANQUANT'.$key20 ;
          }

          $datas2[] = $data3 ;
     

     // GESTION LIGNES
   
        foreach ($pompistes_unique as $key => $value) {

          $data2 = new stdClass();

          $data3 = array() ;
          $data3[] = ''.$value ;

          $data2->pompiste = $value ;
          $data2->manquant = [] ;
          $data2->total = 0 ;

   
             foreach ($dates as $key2 => $value2) {
                  
               $data = new stdClass();
             
               $data->date = $value2 ;
               $data->pompiste = $value ;
               $data->ventes = 0 ;
               $data->ventes_client = 0 ;
               $data->versement = 0 ;
               $data->manquant = 0 ;


               foreach ($data_carb as $key3 => $value3) {

                    if ($value2 == $value3->date && $value == $value3->nom_pompiste) {
                         
                         $data->ventes += $value3->montant ;

                    }
                  
               }

               foreach ($data_client as $key4 => $value4) {
                  
                    if ($value2 == $value4->date && $value == $value4->nom_pompiste) {
                         
                         $data->ventes_client += $value4->montant ;
                         
                    }
               }

               foreach ($data_vers as $key5 => $value5) {
                  
                    if ($value2 == $value5->date && $value == $value5->nom_pompiste) {
                         
                         $data->versement += $value5->montant ;
                         
                    }
               }

                    $data->manquant = $data->ventes - $data->ventes_client - $data->versement ;


                    $data2->manquant[] = $data->manquant ;
                    $data3[] = $data->manquant ;
                      
                    $data2->total += $data->manquant ;       // Total pompistes

                    $data_total->total += $data->manquant ;  // Total pompistes + dates

                    ${'data_'.$value2} += $data->manquant ;  // Total dates

             
             }

          

             $datas[] = $data2 ;
             $datas2[] = $data3 ;

         
        }
   
      // Insertion des variables dynamiques dans le tableau

       foreach ($dates as $key => $value) {

            $data_total->manquant[] =  ${'data_'.$value} ;
       }


       $datas[] = $data_total ;

       /*******************************EXPORT MANQUANT POMPISTES****************** */
   
       

       print_r(json_encode($datas));
       return json_encode($datas);  
       
      }
       
}

function Etats_Ventes_Lub() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     /*   $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
     */
    
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->ventes ;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $station = $requete->station ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
   
   
       $query = "
       
       Select
       Date(station.quart.date_ouverture) As date,
       station.nom_station As station,
       produit.nom_produit AS produit,
       produit.conditionnement AS conditionnement,
       SUM(station.produit_quart.qte_vendu) AS quantite,
       produit_station.prix_produit AS prix_unitaire,
       Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
   From
       produit_quart Inner Join
       quart On produit_quart.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit On station.produit_quart.id_produit = produit.id_produit Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit

               WHERE 

               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   Group By

       Date(station.quart.date_ouverture),
       station.nom_station,
       produit.nom_produit,
       produit.conditionnement,
       produit_station.prix_produit
       
       
       ";  
    /********************************************************************************************************************* */
    $produits = array() ;
    /************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
          while($rows = mysqli_fetch_array($res_lub))
   
         {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->produit = $rows['produit'] ;
                       $obj->prix_unitaire = floatval($rows['prix_unitaire']) ;
                       $obj->conditionnement = $rows['conditionnement'] ;
                       $obj->quantite = $rows['quantite'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;

                       $produits[] =  $rows['produit'] ;
   
             }
          
         }

      }
   
    /****************************************************************************************************************** */
 
     
   
    /******************************************************************************************************* */  

    $produits_unique = array_unique($produits);

     // Creation des variables dynamiques 

     foreach ($dates as $key => $value) {

          ${'data_'.$value} = 0 ;

      }

   
    $datas = array() ;

    $data_total = new stdClass();
             
    $data_total->produit = 'TOTAL' ;
    $data_total->conditionnement = '' ;
    $data_total->ventes = [] ;
    $data_total->total = 0 ;
    $data_total->prix_unitaire = 0 ;
    $data_total->montant = 0 ;


    foreach ($produits_unique as $key => $value) {

     $data2 = new stdClass();

     $data2->produit = $value ;
     $data2->conditionnement = '' ;
     $data2->ventes = [] ;
     $data2->total = 0 ;
     $data2->montant = 0 ;
     $data2->prix_unitaire = 0 ;

        foreach ($dates as $key2 => $value2) {
             
          $data = new stdClass();
        
          $data->date = $value2 ;
          $data->produit = '' ;
          $data->quantite = 0 ;
          $data->conditionnement = '' ;
          $data->prix_unitaire = 0 ;
          $data->montant = 0 ;


          foreach ($data_lub as $key3 => $value3) {

               if ($value2 == $value3->date && $value == $value3->produit) {
                    
                    $data->quantite += $value3->quantite ;
                    $data->montant += $value3->montant ;
                    $data->prix_unitaire = $value3->prix_unitaire ;

                    $data2->prix_unitaire = $value3->prix_unitaire ;

               }

          }


               $data2->ventes[] = $data->quantite ;
                 
               $data2->total += $data->quantite ;      
               $data2->montant += $data->montant ;       

               $data_total->total += $data->quantite ;  
               $data_total->montant += $data->montant ; 

               $data_total->prix_unitaire = $data->prix_unitaire; 

               ${'data_'.$value2} += $data->quantite ;  

        
        }


        if (!($data2->total == 0)) {

          $datas[] = $data2 ;
          
        }

    
    }

 // Insertion des variables dynamiques dans le tableau

  foreach ($dates as $key => $value) {

     $data_total->ventes[] =  ${'data_'.$value} ;
  }


  $datas[] = $data_total ;

   
       
       print_r(json_encode($datas)) ;
       return json_encode($datas) ;  
       
      
       
}


/**************************************gazzzzzzzzzzzzzzzzzzzzzzz */





function Etats_Ventes_Gaz() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     /*   $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
     */
    
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->ventes ;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $station = $requete->station ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
   
   
       $query_gaz = "
       
       Select
       Date(station.quart.date_ouverture) As date,
       station.nom_station As station,
       produit.nom_produit AS produit,
       produit.conditionnement AS conditionnement,
       SUM(station.produit_quart.qte_vendu) AS quantite,
       produit_station.prix_produit AS prix_unitaire,
       Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
   From
       produit_quart Inner Join
       quart On produit_quart.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit On station.produit_quart.id_produit = produit.id_produit Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit

               WHERE 

               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
               produit.type_produit='BTLE_GAZ12.5GK' || produit.type_produit='GAZ12.5GK'
   Group By

       Date(station.quart.date_ouverture),
       station.nom_station,
       produit.nom_produit,
       produit.conditionnement,
       produit_station.prix_produit
       
       
       ";  
    /********************************************************************************************************************* */
    $produits = array() ;
    /************************************************************************************************** */
   
       $res_gaz = mysqli_query($conn, $query_gaz );
   
       $data_gaz = array();
   
       if (is_object($res_gaz)) {
   
          while($rows = mysqli_fetch_array($res_gaz))
   
         {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->produit = $rows['produit'] ;
                       $obj->prix_unitaire = floatval($rows['prix_unitaire']) ;
                       $obj->conditionnement = $rows['conditionnement'] ;
                       $obj->quantite = $rows['quantite'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_gaz[] = $obj ;

                       $produits[] =  $rows['produit'] ;
   
             }
          
         }

      }
   
    /****************************************************************************************************************** */
 
     
   
    /******************************************************************************************************* */  

    $produits_unique = array_unique($produits);

     // Creation des variables dynamiques 

     foreach ($dates as $key => $value) {

          ${'data_'.$value} = 0 ;

      }

   
    $datas = array() ;

    $data_total = new stdClass();
             
    $data_total->produit = 'TOTAL' ;
    $data_total->conditionnement = '' ;
    $data_total->ventes = [] ;
    $data_total->total = 0 ;
    $data_total->prix_unitaire = 0 ;
    $data_total->montant = 0 ;


    foreach ($produits_unique as $key => $value) {

     $data2 = new stdClass();

     $data2->produit = $value ;
     $data2->conditionnement = '' ;
     $data2->ventes = [] ;
     $data2->total = 0 ;
     $data2->montant = 0 ;
     $data2->prix_unitaire = 0 ;

        foreach ($dates as $key2 => $value2) {
             
          $data = new stdClass();
        
          $data->date = $value2 ;
          $data->produit = '' ;
          $data->quantite = 0 ;
          $data->conditionnement = '' ;
          $data->prix_unitaire = 0 ;
          $data->montant = 0 ;


          foreach ($data_gaz as $key3 => $value3) {

               if ($value2 == $value3->date && $value == $value3->produit) {
                    
                    $data->quantite += $value3->quantite ;
                    $data->montant += $value3->montant ;
                    $data->prix_unitaire = $value3->prix_unitaire ;

                    $data2->prix_unitaire = $value3->prix_unitaire ;

               }

          }


               $data2->ventes[] = $data->quantite ;
                 
               $data2->total += $data->quantite ;      
               $data2->montant += $data->montant ;       

               $data_total->total += $data->quantite ;  
               $data_total->montant += $data->montant ; 

               $data_total->prix_unitaire = $data->prix_unitaire; 

               ${'data_'.$value2} += $data->quantite ;  

        
        }


        if (!($data2->total == 0)) {

          $datas[] = $data2 ;
          
        }

    
    }

 // Insertion des variables dynamiques dans le tableau

  foreach ($dates as $key => $value) {

     $data_total->ventes[] =  ${'data_'.$value} ;
  }


  $datas[] = $data_total ;

   
       
       print_r(json_encode($datas)) ;
       return json_encode($datas) ;  
       
      
       
}



function Suivi_Manquants() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
        // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->manquant;
   
       $date_debut = $date_fin = $quart = $station = $pompiste = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;

      // $quart = $requete->quart ;
      //  $station = $requete->station ;
      //  $station = $id_station ;
      //  $pompiste = $requete->pompiste ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   /************************************************************************************************************ */
   
   $res_pompiste =mysqli_query($conn, "
       
   Select
   station.pompiste.id_pompiste,
   station.pompiste.matricule,
   station.pompiste.nom_pompiste,
   station.pompiste.prenom_pompiste,
   station.pompiste.date_naissance,
   station.pompiste.sexe,
   station.pompiste.date_embauche,
   station.pompiste.poste_occupe,
   station.nom_station
    From
    pompiste Inner Join
    station On station.pompiste.id_station = station.id_station
              And station.pompiste.id_region = station.id_region
    "
   
   );

    $data_pompiste = array();
   
    if (is_object($res_pompiste)) {

          while($rows = mysqli_fetch_array($res_pompiste))

          {
               $obj = new stdClass();
   
               $obj->id_pompiste = $rows['id_pompiste'] ;
               $obj->nom_pompiste = $rows['nom_pompiste'] ;
               $obj->prenom_pompiste = $rows['prenom_pompiste'] ;
               $obj->matricule = $rows['matricule'] ;
               $obj->solde_manquant = 0 ;
               $obj->montant = 0 ;
               $obj->station = $rows['nom_station'] ;

               $data_pompiste[] = $obj ;
          }
    }
      
   /************************************************************************************************************ */
       $query = "
       
       Select
       
       station.pompiste.id_pompiste,
       station.pompiste.nom_pompiste,
       station.pompiste.matricule,
       station.pompiste.prenom_pompiste,
       station.pompiste.solde_manquant,
       Sum(((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
       (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
       produit_station.prix_produit) As montant,
       station.id_station,
       station.nom_station AS station
   From
       pompiste_pistolet Inner Join
       pompiste On pompiste_pistolet.id_pompiste = pompiste.id_pompiste Inner Join
       quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region Inner Join
       produit On produit_station.id_produit = produit.id_produit Inner Join
       cuves On cuves.id_produit = produit.id_produit Inner Join
       pistolet On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region
               And station.pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And station.pompiste_pistolet.id_cuve = pistolet.id_cuve
               And station.pompiste_pistolet.id_station = pistolet.id_station
               And station.pompiste_pistolet.id_region = pistolet.id_region
               And station.pompiste_pistolet.id_pompe = pistolet.id_pompe
               
   WHERE 
        
        (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
        (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
   Group By
      
       station.pompiste.nom_pompiste,
       station.pompiste.prenom_pompiste,
       station.pompiste.matricule,
       station.id_station
       
       ";  

    /********************************************************************************************************************* */
   
       $query_client = "

       Select
       
       station.pompiste.id_pompiste,
       station.pompiste.nom_pompiste,
       station.pompiste.matricule,
       station.pompiste.prenom_pompiste,
       station.pompiste.solde_manquant,
       Sum(station.pompiste_has_client.montant) As montant,
       station.id_station,
       station.nom_station As station
   From
       pompiste_has_client Inner Join
       quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
       client On pompiste_has_client.client_id_client = client.id_client Inner Join
       produit On pompiste_has_client.produit_id_produit = produit.id_produit Inner Join
       pompiste On pompiste_has_client.pompiste_id_pompiste = pompiste.id_pompiste Inner Join
       client_produit On client_produit.id_client = client.id_client
               And client_produit.id_produit = produit.id_produit Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region

     WHERE 

     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
   Group By
      
       station.pompiste.nom_pompiste,
       station.pompiste.prenom_pompiste,
       station.pompiste.matricule,
       station.id_station
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 

          Select
          
          station.pompiste.id_pompiste,
          station.pompiste.nom_pompiste,
          station.pompiste.matricule,
          station.pompiste.prenom_pompiste,
          station.pompiste.solde_manquant,
          station.id_station,
          station.nom_station As station,
          Sum(station.versement_pompiste.montant_versement) As montant
     From
     versement_pompiste Inner Join
     quart On versement_pompiste.id_quart = quart.id_quart Inner Join
     pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region
               And station.pompiste.id_station = station.id_station
               And station.pompiste.id_region = station.id_region
     WHERE 
          
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
         
          station.pompiste.nom_pompiste,
          station.pompiste.prenom_pompiste,
          station.pompiste.matricule,
          station.id_station
          
          
   
     " ;
       
    /************************************************************************************************** */


     /********************************************************************************************************************* */
   
     $query_manquant = "

          Select
     
     station.pompiste.id_pompiste,
     station.pompiste.nom_pompiste,
     station.pompiste.prenom_pompiste,
     station.pompiste.matricule,
     station.nom_station,
     Sum(station.manquant_exceptionel.montant) As manquant_exceptionel
     
     From
     manquant_exceptionel Inner Join
     pompiste On manquant_exceptionel.pompiste_id_pompiste = pompiste.id_pompiste Inner Join
     station On station.pompiste.id_station = station.id_station
               And station.pompiste.id_region = station.id_region
     Where
     station.manquant_exceptionel.date_manquant Between '$date_debut2' And '$date_fin2'
     Group By
     station.pompiste.nom_pompiste,
     station.pompiste.prenom_pompiste,
     station.pompiste.matricule,
     station.id_station
     
          
          " ;
 
     
  /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
                  $obj = new stdClass();
   
                       $obj->id_pompiste = $rows['id_pompiste'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->prenom_pompiste = $rows['prenom_pompiste'] ;
                       $obj->matricule = $rows['matricule'] ;
                       $obj->solde_manquant = intval($rows['solde_manquant']) ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_carb[] = $obj ;
          
       }
   
    /****************************************************************************************************************** */
   
       $res_client = mysqli_query($conn, $query_client );
   
       $data_client = array();
   
       if (is_object($res_client)) {
   
   
             while($rows = mysqli_fetch_array($res_client))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->id_pompiste = $rows['id_pompiste'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->prenom_pompiste = $rows['prenom_pompiste'] ;
                       $obj->matricule = $rows['matricule'] ;
                       $obj->solde_manquant = intval($rows['solde_manquant']) ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_client[] = $obj ;
             
             }
   
   
       }
   
    /******************************************************************************************************* */  

    $res_vers = mysqli_query($conn, $query_vers );
   
    $data_vers = array();

    if (is_object($res_vers)) {


          while($rows = mysqli_fetch_array($res_vers))

          {
                    $obj = new stdClass();

                    $obj->id_pompiste = $rows['id_pompiste'] ;
                    $obj->nom_pompiste = $rows['nom_pompiste'] ;
                    $obj->prenom_pompiste = $rows['prenom_pompiste'] ;
                    $obj->matricule = $rows['matricule'] ;
                    $obj->solde_manquant = intval($rows['solde_manquant']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vers[] = $obj ;

          
          }


    }

    /********************************************************************************************* */
    
    $res_manquant = mysqli_query($conn, $query_manquant );
   
       $data_manquant = array();
   
       if (is_object($res_manquant)) {
   
   
             while($rows = mysqli_fetch_array($res_manquant))
   
             {
   
                       $obj = new stdClass();
   
                       
                       $obj->id_pompiste = $rows['id_pompiste'] ;
                       $obj->nom_pompiste = $rows['nom_pompiste'] ;
                       $obj->prenom_pompiste = $rows['prenom_pompiste'] ;
                       $obj->matricule = $rows['matricule'] ;
                       $obj->manquant_exceptionel = intval($rows['manquant_exceptionel']) ;
                       $obj->station = $rows['nom_station'] ;
   
                       $data_manquant[] = $obj ;
             
             }
   
   
       }
   
    /******************************************************************************************************* */  


    



    $pompistes = array() ;

    foreach ($data_carb as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;
    }

    foreach ($data_client as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;
    }

    foreach ($data_vers as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;

    }

    foreach ($data_pompiste as $key => $value) {
        
          $pompistes[] = $value->nom_pompiste ;

    }


    $pompistes_unique = array_unique($pompistes);


   
    $datas = array() ;

    $data_total = new stdClass();
             
    $data_total->date = '' ;

    $data_total->nom= '' ;
    $data_total->prenom = '' ;
    $data_total->matricule = 'TOTAL' ;
    $data_total->ancien_solde = 0 ;
    $data_total->manquant_exceptionel = 0 ;
    $data_total->total_manquant = 0 ;
    $data_total->retenue = 0 ;
    $data_total->nouveau_solde = 0 ;
    $data_total->station = '' ;

    $data_total->ventes = 0 ;
    $data_total->ventes_client = 0 ;
    $data_total->versement = 0 ;
    $data_total->manquant = 0 ;
   
       
   
             foreach ($pompistes_unique as $key2 => $value2) {
                  
               $data = new stdClass();
             
               $data->id_pompiste = 0 ;
               
               $data->nom = $value2 ;
               $data->prenom = '' ;
               $data->matricule = '' ;
               $data->ancien_solde = 0 ;
               $data->manquant_exceptionel = 0 ;
               $data->total_manquant = 0 ;
               $data->retenue = 0 ;
               $data->nouveau_solde = 0 ;
               $data->station = '' ;

               $data->ventes = 0 ;
               $data->ventes_client = 0 ;
               $data->versement = 0 ;
               $data->manquant = 0 ;

              

               foreach ($data_carb as $key3 => $value3) {

                    if ($value2 == $value3->nom_pompiste) {
                         
                         $data->station = $value3->station ;
                         $data->id_pompiste = $value3->id_pompiste ;
                         $data->prenom = $value3->prenom_pompiste ;
                         $data->matricule = $value3->matricule ;
                         $data->ancien_solde = $value3->solde_manquant ;

                         $data->ventes = $value3->montant ;

                         $data_total->ventes += $value3->montant ;

                    }
                  
               }

               foreach ($data_client as $key4 => $value4) {
                  
                    if ($value2 == $value4->nom_pompiste) {
                         
                         $data->station = $value4->station;
                         $data->id_pompiste = $value4->id_pompiste ;
                         $data->prenom = $value4->prenom_pompiste ;
                         $data->matricule = $value4->matricule ;
                         $data->ancien_solde = $value4->solde_manquant ;
                         
                         $data->ventes_client = $value4->montant ;

                         $data_total->ventes_client += $value4->montant ;
                         
                    }
               }

               foreach ($data_vers as $key5 => $value5) {
                  
                    if ($value2 == $value5->nom_pompiste) {
                         
                         $data->station = $value5->station ;
                         $data->id_pompiste = $value5->id_pompiste ;
                         $data->prenom = $value5->prenom_pompiste ;
                         $data->matricule = $value5->matricule ;
                         $data->ancien_solde = $value5->solde_manquant ;
                         
                         $data->versement = $value5->montant ;

                         $data_total->versement += $value5->montant ;
                         
                    }
               }

               foreach ($data_pompiste as $key6 => $value6) {
                  
                    if ($value2 == $value6->nom_pompiste) {
                         
                         $data->station = $value6->station ;
                         $data->matricule = $value6->matricule ;
                         
                         
                    }
               }
              

               $data->manquant = $data->ventes - $data->ventes_client - $data->versement ;

               // $data->total_manquant =  $data->manquant + $data->manquant_exceptionel ;
               // $data->nouveau_solde = $data->ancien_solde + $data->retenue ;

               $data_total->manquant = $data_total->ventes - $data_total->ventes_client - $data_total->versement ;


                               $datas[] = $data ;
                        
             
             }
            
        
   
     //   $datas[] = $data_total ;  


     foreach ($datas as $key => $value) {

          foreach ($data_manquant as $key2 => $value2) {
               
               if ($value->matricule == $value2->matricule) {
                    
                    $value->manquant_exceptionel = $value2->manquant_exceptionel ;
               }

          }


          $value->total_manquant = $value->ancien_solde + $value->manquant + $value->manquant_exceptionel ;
          $value->retenue =  $value->total_manquant;
          $value->nouveau_solde =   $value->total_manquant -  $value->retenue ;

     }



   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      }
       
}

function Cloture_Manquants() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
        // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));

       $requete = $data->manquant;
       $requete2 = $data->dates;

       $date_debut = $requete2->date_debut ;
       $date_fin = $requete2->date_fin ;

       $date_debut2 = date('Y-m-d', strtotime($date_debut));
       $date_fin2 = date('Y-m-d', strtotime($date_fin));

       $id_pompiste = 0 ;
       $retenue = 0 ;
       $nouveau_solde = 0 ;


       try {

          // First of all, let's begin a transaction
          mysqli_begin_transaction($conn, MYSQLI_TRANS_START_WITH_CONSISTENT_SNAPSHOT);
      
          // A set of queries; if one fails, an exception should be thrown
          foreach ($requete as $value) {

               foreach ($value as $key => $value2) {
                    
     
                 if ($key=='id_pompiste') {
                      $id_pompiste=$value2;
                 }if ($key=='retenue') {
                      $retenue=$value2;
                 }if ($key=='nouveau_solde') {
                      $nouveau_solde=$value2;
                 }if ($key=='manquant_exceptionel') {
                    $manquant_exceptionel=$value2;
               }
     
                    
               }  // ENd For each
              
              $res=mysqli_query($conn, "CALL cloture($id_pompiste, $retenue, $manquant_exceptionel, $nouveau_solde, '$date_fin2', $userId )");
                

                 mysqli_commit($conn);

                 if ($res == false) {
     
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
        
          }  // End for each
     
                //  TRANSFERT
          
           $res=mysqli_query($conn, "CALL transfert( '$date_debut2', '$date_fin2') ");

           if ($res == false) {
     
             $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                $jsn = json_encode($arr);
                print_r($jsn);
                return json_encode($jsn);  
             
           }    
            
          
          
               // If we arrive here, it means that no exception was thrown
               // i.e. no query has failed, and we can commit the transaction
          
      } catch (Exception $e) {
          // An exception has been thrown
          // We must rollback the transaction
          mysqli_rollback($conn);
      }

        


          $data = array();

          if (is_object($res)) {

          while($rows = mysqli_fetch_array($res))

          {
          $data[] = array(

          "Transfert_Reussie"  =>   $rows['Transfert_Reussie']
          
               ) ;
          }

          print_r(json_encode($data));
          return json_encode($data);  
     }
   
       
}

function Manquants_exceptionel() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
      $data = json_decode(file_get_contents("php://input"));
   
        $manquant = $data->manquant ;

        $date = date('Y-m-d', strtotime($manquant->date));
       
   
       $res=mysqli_query($conn, "CALL add_manquant($manquant->pompiste, '$date', $manquant->montant, $userId, '$manquant->commentaire')");
       
        if (is_object($res)) {
   
       }
       else {
   
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
       }   
   
        return json_encode($jsn);  
       
}

function Manquants_retenue() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
      $data = json_decode(file_get_contents("php://input"));
   
        $retenue = $data->retenue ;
   
        $date = date('Y-m-d', strtotime($retenue->date));
   
       $res=mysqli_query($conn, "CALL add_retenue($retenue->pompiste, '$date', $retenue->montant, $userId)");
       
        if (is_object($res)) {
   
       }
       else {
   
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
       }   
   
        return json_encode($jsn);  
           
       
}

function Get_dates() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
        $requete = $data->date;
   
        $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
       
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut) ;
        $date_fin = date_create($date_fin) ;
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
       print_r(json_encode($dates)) ;
       return json_encode($dates) ;  
       
}

function get_livraison_station() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL livraison_station($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "nom_station"  => $rows['nom_station'],
                  "nom_produit"  => $rows['nom_produit'],
                  "date_ouverture"  => $rows['date_ouverture'],
                  "date_fermerture"  => $rows['date_fermerture'],
                  "qte_recu"  => $rows['qte_recu']
                  
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_ventes_station() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 $date_ouverture = '2018-04-01 00:00:00 ';
 $date_fermerture = '2018-04-30 00:00:00';

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $res=mysqli_query($conn, "CALL ventes_station($id_station, '$date_ouverture', '$date_fermerture')");

   

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data[] = array(

                  "station"  => $rows['nom_station'],
                  "produit"  => $rows['nom_produit'],
                  "quantite"  => $rows['quantite']
                          
                     ) ;  
     }

     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_cuves() {

 $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

     // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

    $res=mysqli_query($conn, "

     SELECT
     station.produit.nom_produit,
     station.produit.code_produit,
     station.nom_station,
     station.nom_gerant,
     station.cuves.id_cuve,
     station.cuves.nom_cuve,
     station.cuves.mat_cuve,
     station.cuves.stock_initial,
     station.cuves.capacite_cuve,
     station.cuves.stock_initial,
     produit_station.prix_produit
     From
     produit Inner Join
     cuves On cuves.id_produit = produit.id_produit Inner Join
     station On station.cuves.id_station = station.id_station And
     station.cuves.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = produit.id_produit And
     produit_station.id_station = station.id_station And
     produit_station.id_region = station.id_region
     Where
     station.cuves.id_station = $id_station
          ");

    
    $data = array();

     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

        {
           $data[] = array(

               "id_cuve"  => $rows['id_cuve'],
               "nom_cuve"  => $rows['nom_cuve'],
               "capacite_cuve"  => $rows['capacite_cuve'],
               "volume_debut"  => intval($rows['stock_initial']),
               "volume_fin"  => intval($rows['stock_initial']),
               "nom_produit"  => $rows['nom_produit'],
               "mat_cuve"  => $rows['mat_cuve'],
               "code_produit"  => $rows['code_produit'],
               "nom_station"  => $rows['nom_station'],
               "nom_gerant"  => $rows['nom_gerant'],
               "prix_unitaire"  => floatval($rows['prix_produit'])
                          
                     ) ;
       }
       
       print_r(json_encode($data));
       return json_encode($data);  
    }
    else {

        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
    
}

function get_pistolets() {

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 // connect DB
     $conn=mysqli_connect("localhost","station","station","station");

     $res=mysqli_query($conn, "
     SELECT
     pistolet.nom_pistolet,
     produit.nom_produit
     From
     pistolet Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve And pistolet.id_station =
     cuves.id_station And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit
     WHERE pistolet.id_station = $id_station
     ");

     $data = array();
    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

      {
         $data[] = array(

                  "nom_pistolet"  => $rows['nom_pistolet'],
                  "nom_produit"  => $rows['nom_produit']
                //  "mat_pistolet"  => $rows['mat_pistolet']
                          
                     ) ;
     }
     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_produits() {

  $id_station = $_SESSION['id_station'];
  $id_region = $_SESSION['id_region'];
  $userId = $_SESSION['id_user'];

 // connect DB
     $conn=mysqli_connect("localhost","station","station","station");

     $res=mysqli_query($conn, " SELECT station.produit.nom_produit From station.produit ");

     $data = array();

     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

      {
         $data[] = array(

                "nom_produit"  => $rows['nom_produit']

                   ) ;
     }
     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_produit_carburant() {

 $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

     // connect DB
     $conn=mysqli_connect("localhost","station","station","station");

     $res=mysqli_query($conn, "
     SELECT
     produit_station.prix_produit,
     produit.id_produit,
     produit.type_produit,
     produit.nom_produit,
     produit.code_produit,
     produit.conditionnement
     From
     produit Inner Join
     produit_station On produit_station.id_produit = produit.id_produit And
     produit_station.id_station = $id_station
     Where
     produit.type_produit = 'CARBURANT' ");

     $data = array();

    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

      {
         $data[] = array(

                "id_produit"  => $rows['id_produit'],
                "nom_produit"  => $rows['nom_produit'],
                "code_produit"  => $rows['code_produit'],
                "type_produit"  => $rows['type_produit'],
                "conditionnement"  => $rows['conditionnement'],
                "prix_unitaire"  => $rows['prix_produit']
                
                   ) ;
     }
     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_produit_lubrifiant() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $res=mysqli_query($conn, "
        SELECT
        produit_station.prix_produit,
        produit_station.stock_initial,
        produit.id_produit,
        produit.type_produit,
        produit.nom_produit,
        produit.code_produit,
        produit.conditionnement
        From
        produit Inner Join
        produit_station On produit_station.id_produit = produit.id_produit And
        produit_station.id_station = $id_station
        Where
        
        produit.type_produit = 'LUBRIFIANT' 
   
        ");
   
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                   "id_produit"  => $rows['id_produit'],
                   "nom_produit"  => $rows['nom_produit'],
                   "code_produit"  => $rows['code_produit'],
                   "type_produit"  => $rows['type_produit'],
                   "conditionnement"  => $rows['conditionnement'],
                   "stock_ouverture"  => floatval($rows['stock_initial']),
                   "stock_fermerture"  => floatval($rows['stock_initial']),
                   "prix_produit"  => floatval($rows['prix_produit']),
                   "qte_vendu"  => 0 ,
                   "livraison"  => 0 ,
                   
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
       }
      
   
}

function get_produit_lubrifiant_all() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $res=mysqli_query($conn, "
        SELECT
        produit_station.prix_produit,
        produit_station.stock_initial,
        produit.id_produit,
        produit.type_produit,
        produit.nom_produit,
        produit.code_produit,
        produit.conditionnement
        From
        produit Inner Join
        produit_station On produit_station.id_produit = produit.id_produit And
        produit_station.id_station = $id_station
        Where
        produit.type_produit = 'LUBRIFIANT' 
   
        ");
   
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                   "id_produit"  => $rows['id_produit'],
                   "nom_produit"  => $rows['nom_produit'],
                   "code_produit"  => $rows['code_produit'],
                   "type_produit"  => $rows['type_produit'],
                   "conditionnement"  => $rows['conditionnement'],
                   "stock_ouverture"  => floatval($rows['stock_initial']),
                   "stock_fermerture"  => floatval($rows['stock_initial']),
                   "prix_produit"  => $rows['prix_produit'],
                   "qte_vendu"  => 0
                   
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}


function get_produit_gaz() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $res=mysqli_query($conn, "
        SELECT
        produit_station.prix_produit,
        produit_station.stock_initial,
        produit.id_produit,
        produit.type_produit,
        produit.nom_produit,
        produit.code_produit,
        produit.conditionnement
        From
        produit Inner Join
        produit_station On produit_station.id_produit = produit.id_produit And
        produit_station.id_station = $id_station
        Where
        
        produit.type_produit = 'BTLE_GAZ12.5GK' 
   
        ");
   
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                   "id_produit"  => $rows['id_produit'],
                   "nom_produit"  => $rows['nom_produit'],
                   "code_produit"  => $rows['code_produit'],
                   "type_produit"  => $rows['type_produit'],
                   "conditionnement"  => $rows['conditionnement'],
                   "stock_ouverture"  => floatval($rows['stock_initial']),
                   "stock_fermerture"  => floatval($rows['stock_initial']),
                   "prix_produit"  => floatval($rows['prix_produit']),
                   "qte_vendu"  => 0 ,
                   "livraison"  => 0 ,
                   
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
       }
      
   
 }



 function get_produit_gaz_rechange() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $res=mysqli_query($conn, "
        SELECT
        produit_station.prix_produit,
        produit_station.stock_initial,
        produit.id_produit,
        produit.type_produit,
        produit.nom_produit,
        produit.code_produit,
        produit.conditionnement
        From
        produit Inner Join
        produit_station On produit_station.id_produit = produit.id_produit And
        produit_station.id_station = $id_station
        Where
        
        produit.type_produit = 'GAZ12.5GK' 
   
        ");
   
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
                   "id_produit"  => $rows['id_produit'],
                   "nom_produit"  => $rows['nom_produit'],
                   "code_produit"  => $rows['code_produit'],
                   "type_produit"  => $rows['type_produit'],
                   "conditionnement"  => $rows['conditionnement'],
                   "stock_ouverture"  => floatval($rows['stock_initial']),
                   "stock_fermerture"  => floatval($rows['stock_initial']),
                   "prix_produit"  => floatval($rows['prix_produit']),
                   "qte_vendu"  => 0 ,
                   "livraison"  => 0 ,
                   
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
       }
      
   
 }


function get_transporteur() {

 $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];
 // connect DB
     $conn=mysqli_connect("localhost","station","station","station");

     $res=mysqli_query($conn, "
     SELECT
     transporteur.nom_transporteur
     From
     transporteur 
     Where
     transporteur.id_station = $id_station ");

     $data = array();

    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

      {
         $data[] = array(

              "nom_transporteur"  =>   $rows['nom_transporteur']
              
                   ) ;
     }
     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function get_client() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $res=mysqli_query($conn, "
        SELECT
             client.id_client,
             client.nom_client,
             client.code_client
        From
        client 
        Where
        client.id_station = $id_station ");
   
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
             "id_client"  =>   $rows['id_client'],
             "nom_client"  =>   $rows['nom_client'],
             "code_client"  =>   $rows['code_client']
                 
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}

function get_client_all() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
    // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $res=mysqli_query($conn, "
   
             Select
             client.nom_client,
             client.code_client,
             client.solde_initial,
             client.solde_client
         From
             client
         Group By
             
             client.code_client
   
         " ) ;
   
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
             "nom_client"  =>   $rows['nom_client'],
             "code_client"  =>   $rows['code_client'],
             "solde_initial"  =>   $rows['solde_initial'],
             "solde_client"  =>   $rows['solde_client']
                 
                      ) ;
         }
   
        print_r(json_encode($data));
        return json_encode($data);  
   
       }
       else {
   
            $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
   
        return json_encode($jsn);  
   
           
       }
      
   
}

function get_station() {

     $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';

 

 // connect DB
 $conn=mysqli_connect($host_name, $user_name, $password, $database);

     $res=mysqli_query($conn, "
     SELECT
          station.id_station,
          station.nom_station,
          station.email_station,

          station.nom_gerant,
          station.telephone_gerant,
          station.objectif_carburant,
          station.objectif_lubrifiant,
          station.objectif_coulage,
          station.email_regional,
          station.telephone_regional
     From
     station  ");

     $data = array();

    
     if (is_object($res)) {

        while($rows = mysqli_fetch_array($res))

      {
         $data[] = array(

          "nom_station"  =>   $rows['nom_station'],
          "id_station"  =>   $rows['id_station'],
          "email_station"  =>   $rows['email_station'],

          "nom_gerant"  =>   $rows['nom_gerant'],
          "telephone_gerant"  =>   $rows['telephone_gerant'],
          "objectif_carburant"  =>   $rows['objectif_carburant'],
          "objectif_lubrifiant"  =>   $rows['objectif_lubrifiant'],
          "objectif_coulage"  =>   $rows['objectif_coulage'],
          "email_regional"  =>   $rows['email_regional'],
          "telephone_regional"  =>   $rows['telephone_regional']

              
                   ) ;
     }
     print_r(json_encode($data));
     return json_encode($data);  

    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
   

}

function addVte_carb() {

     $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';

  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

     // connect DB
     $conn=mysqli_connect($host_name, $user_name, $password, $database);

     $data = json_decode(file_get_contents("php://input"));
     // print_r($data)   ;
    $produit       = intval($data->produit) ;
    $client     = intval($data->client) ; 

    $res=mysqli_query($conn, "CALL addVte_carb($id_station, '$produit', '$client', @p_prix_client)");

    $res1=mysqli_query($conn, "SELECT @p_prix_client");

     $data1 = array();
    
     if (is_object($res1)) {

        while($rows = mysqli_fetch_array($res1))
       // var_dump($rows);
       //mysqli_free_result($res);
      {

         $data1[] = array(

                  "prix_client"  => $rows['@p_prix_client']
                          
                     ) ;  
     }

     print_r(json_encode($data1));
     return json_encode($data1);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    }
}

function addVte_lubri() {

    $id_station = $_SESSION['id_station'];
    $id_region = $_SESSION['id_region'];
    $userId = $_SESSION['id_user'];
   
        // connect DB
        $conn=mysqli_connect("localhost","station","station","station");
   
        $data = json_decode(file_get_contents("php://input"));
        // print_r($data)   ;
       $produit       = $data->produit;
       $client     = $data->client; 
   
       $res=mysqli_query($conn, "CALL addVte_lubri($id_station, '$produit', '$client', @p_prix_client)");
   
       $res1=mysqli_query($conn, "SELECT @p_prix_client");
   
        $data1 = array();
       
        if (is_object($res1)) {
   
           while($rows = mysqli_fetch_array($res1))
          // var_dump($rows);
          //mysqli_free_result($res);
         {
   
            $data1[] = array(
   
                     "prix_client"  => $rows['@p_prix_client'],
                             
                        ) ;  
        }
   
        print_r(json_encode($data1));
        return json_encode($data1);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
}

function Envoyer() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];

     $nom_station = $_SESSION['nomStation'];
     
     $email_station = $_SESSION['userEmail'];
     $email_regional = $_SESSION['email_regional'];


 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $data = json_decode(file_get_contents("php://input"));

   // var_dump($data)   ;

   foreach ($data as $key => $value) {
     
      if ($key == 'recap_livraison_carb') {

    $recap_livraison_carb       = $data->recap_livraison_carb;
        
      }

      if ($key == 'recap_livraison_lub') {

    $recap_livraison_lub       = $data->recap_livraison_lub;
        
      }

      if ($key == 'app_quart_personnel') {

    $app_quart_personnel       = $data->app_quart_personnel;
        
      }

       if ($key == 'app_quart_cuves') {

    $app_quart_cuves       = $data->app_quart_cuves;
        
      }

     if ($key == 'app_quart_magasin') {

    $app_quart_magasin       = $data->app_quart_magasin;
        
      }

      if ($key == 'app_quart_gaz') {

          $app_quart_gaz       = $data->app_quart_gaz;
              
            }

            if ($key == 'app_quart_gaz_recharge') {

               $app_quart_gaz_recharge       = $data->app_quart_gaz_recharge;
                   
                 }

     if ($key == 'app_quart_vte_carburant') {

    $app_quart_vte_carburant       = $data->app_quart_vte_carburant;
        
      }

    if ($key == 'app_quart_vte_lubrifiant') {

    $app_quart_vte_lubrifiant       = $data->app_quart_vte_lubrifiant;
        
      }

    if ($key == 'app_quart_rgt_carburant') {

    $app_quart_rgt_carburant       = $data->app_quart_rgt_carburant;
        
      }

    if ($key == 'app_quart_rgt_client') {

    $app_quart_rgt_client       = $data->app_quart_rgt_client;
        
      }

    if ($key == 'app_quart_depense') {

    $app_quart_depense       = $data->app_quart_depense;
        
      }

    if ($key == 'app_quart_versement') {

    $app_quart_versement       = $data->app_quart_versement;
        
      }

     if ($key == 'app_quart_commentaire') {

     $app_quart_commentaire       = $data->app_quart_commentaire;
          
     }

    if ($key == 'app_quart_om') {

    $app_quart_om       = $data->app_quart_om;
        
      }

     if ($key == 'app_quart_appro') {

    $app_quart_appro       = $data->app_quart_appro;
        
      }

     if ($key == 'app_quart_boutique') {

    $app_quart_boutique       = $data->app_quart_boutique;
        
      }

    if ($key == 'app_quart_laverie') {

    $app_quart_laverie       = $data->app_quart_laverie;
        
      }

     if ($key == 'app_quart_date') {

     $app_quart_date       = $data->app_quart_date;
          
          }


  }

  

    $qte_commande=$qte_recu=$id_cuve=$volume_debut=$volume_fin=$qte_vendu=$id_produit=$stock_ouverture=$stock_fermerture=$montant=0;
    $mat_camion=$nom_chauffeur=$num_bon=$num_scdp=$produit=$transporteur=$cuve=$client=$pompiste=$pistolet=$produit=$station=$type_reglement=$nature=$recette=$responsable=$num_banque=$num_bordereau=$num_compte='';

    $nom_pistolet=$nom_pompiste=$nom_produit=$motif=$responsable=$commentaire_ventes=$commentaire_pannes='';
    $index_depart=$index_fin=$index_depart_remise=$index_fin_remise=$ancien_solde=$nouveau_solde=$quantite=0;

    $date_ouverture_quart = $numero_quart = $lien_banque = $date_banque = $lien_stock = $date_stock = '' ;

  //  $date_banque = '2020-08-01' ;

 //   mysqli_query($conn, "LOCK TABLES tablename READ;");

   if (isset($recap_livraison_lub)) {

        foreach ($recap_livraison_lub as $value) {

            foreach ($value as $key => $value2) {
                 $type_livraison='Lub';

              if ($key=='qte_commande') {
                   $qte_commande=$value2;
              }if ($key=='qte_recu') {
                   $qte_recu=$value2;
              }if ($key=='mat_camion') {
                   $mat_camion=$value2;
              }if ($key=='nom_chauffeur') {
                   $nom_chauffeur=$value2;
              }if ($key=='num_bon') {
                   $num_bon=$value2;
              }if ($key=='produit') {
                   $produit=$value2->nom_produit;
              }if ($key=='transporteur') {
                   $transporteur=$value2;
              }

                 
            }  // ENd For each
           
           $res=mysqli_query($conn, "CALL recap_livraison_lub($qte_commande, $qte_recu, '$mat_camion', '$nom_chauffeur', '$num_bon', '$produit', '$transporteur','$type_livraison', $id_station, $id_region)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
        }  // End for each

   }
  
   if (isset($recap_livraison_carb)) {

      foreach ($recap_livraison_carb as $value) {

        foreach ($value as $key => $value2) {

            $type_livraison='Carb';

            if ($key=='qte_commande') {
                 $qte_commande=$value2;
            }if ($key=='qte_recu') {
                 $qte_recu=$value2;
            }if ($key=='mat_camion') {
                 $mat_camion=$value2;
            }if ($key=='nom_chauffeur') {
                 $nom_chauffeur=$value2;
            }if ($key=='num_bon') {
                 $num_bon=$value2;
            }if ($key=='num_scdp') {
                 $num_scdp=$value2;
            }if ($key=='produit') {
                 $produit=$value2;
            }if ($key=='transporteur') {
                 $transporteur=$value2;
            }if ($key=='cuve') {
                 $cuve=$value2;
            }
        }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_livraison_carb($qte_commande, $qte_recu, '$mat_camion', '$nom_chauffeur', '$num_bon', '$num_scdp', '$produit', '$transporteur', '$cuve','$type_livraison', $id_station, $id_region)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
      }  // End for each 

   }

   if (isset($app_quart_personnel)) {

     foreach ($app_quart_personnel as $value) {

        foreach ($value as $key => $value2) {
          
            $motif='';
            $responsable='' ;

            if ($key=='nom_pistolet') {
                 $nom_pistolet=$value2;
            }if ($key=='nom_pompiste') {
                 $nom_pompiste=$value2;
            }if ($key=='nom_produit') {
                 $nom_produit=$value2;
            }if ($key=='index_depart') {
                 $index_depart=$value2;
            }if ($key=='index_fin') {
                 $index_fin=$value2;
            }if ($key=='index_depart_remise') {
                 $index_depart_remise=$value2;
            }if ($key=='index_fin_remise') {
                 $index_fin_remise=$value2;
            }if ($key=='motif') {
                 $motif=$value2;
            }if ($key=='responsable') {
                 $responsable=$value2;
            }
        }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_vte_pompiste('$nom_pistolet', '$nom_pompiste', '$nom_produit', $index_depart, $index_fin, $index_depart_remise, $index_fin_remise, '$motif', '$responsable', $userId, $id_station, $id_region)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
     }  // End for each

   }

   if (isset($app_quart_cuves)) {

      foreach ($app_quart_cuves as $value) {

        foreach ($value as $key => $value2) {
          

            if ($key=='id_cuve') {
                 $id_cuve=$value2;
            }if ($key=='volume_debut') {
                 $volume_debut=$value2;
            }if ($key=='volume_fin') {
                 $volume_fin=$value2;
            }
        }  // ENd For each
             
             $res=mysqli_query($conn, "CALL Recap_stock_carb($id_cuve, $volume_debut, $volume_fin)");

                if ($res == false) {

                  $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                     $jsn = json_encode($arr);
                     print_r($jsn);
                     return json_encode($jsn);  
                  
                }
       
     }  // End for each
     
   }

   if (isset($app_quart_magasin)) {
     
      foreach ($app_quart_magasin as $key => $value) {

          if(!isset($value->qte_vendu))
          {
               $value->qte_vendu=0;
          }


          $quantite_vendu = floatval($value->qte_vendu) ;

        //  if ( !($value->stock_ouverture == 0 && $value->stock_fermerture == 0) ) {

               $res=mysqli_query($conn, "CALL Recap_stock_lub($value->id_produit, $value->stock_ouverture, $value->stock_fermerture, $quantite_vendu)");
           
               if ($res == false) {
     
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                    $jsn = json_encode($arr);
                    print_r($jsn);
                    return json_encode($jsn);  
                    
               }
               
        //  }
          
     
      }  // End for each
   }



   
if (isset($app_quart_gaz)) {
     foreach ($app_quart_gaz as $key => $value) {
          if(!isset($value->qv_ab))
          {
               $value->qv_ab=0;
          }

         $quantite_vendu = floatval($value->qv_ab) ;
        

       //  if ( !($value->stock_ouverture == 0 && $value->stock_fermerture == 0) ) {

              $res=mysqli_query($conn, "CALL Recap_stock_gaz($value->id_produit, $value->stock_ouverture, $value->stock_fermerture, $quantite_vendu)");
          
              if ($res == false) {
    
                   $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                   
              }
              
      //   }
         
    
     }  // End for each


}


//debut recharge

if (isset($app_quart_gaz_recharge)) {
     foreach ($app_quart_gaz_recharge as $key => $value) {
          if(!isset($value->qv_sb))
          {
               $value->qv_sb=0;
          }

         $quantite_vendu = floatval($value->qv_sb) ;

       //  if ( !($value->stock_ouverture == 0 && $value->stock_fermerture == 0) ) {

              $res=mysqli_query($conn, "CALL Recap_stock_gaz($value->id_produit, $value->stock_ouverture, $value->stock_fermerture, $quantite_vendu)");
          
              if ($res == false) {
    
                   $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                   
              }
              
        // }
         
    
     }  // End for each


}
   

   if (isset($app_quart_vte_carburant)) {

     foreach ($app_quart_vte_carburant as $value) {
 
       foreach ($value as $key => $value2) {
         
            if ($key=='id_client') {
                $id_client= intval($value2) ;
           }if ($key=='id_pompiste') {
                $id_pompiste= intval($value2);
           }if ($key=='id_produit') {
                $id_produit= intval($value2);
           }if ($key=='montant') {
                $montant= intval($value2);
           }if ($key=='qte') {
               $quantite= intval($value2);
          }
       }  // ENd For each
            
            $res=mysqli_query($conn, "CALL Recap_vte_carb($id_client, $id_pompiste, $id_produit, $montant, $quantite)");
               if ($res == false) {
 
                 $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                    $jsn = json_encode($arr);
                    print_r($jsn);
                    return json_encode($jsn);  
                 
               }
      
     }  // End for each
     
   }

  
  if (isset($app_quart_vte_lubrifiant)) {

     foreach ($app_quart_vte_lubrifiant as $value) {

          foreach ($value as $key => $value2) {
            
              if ($key=='id_client') {
                   $id_client= intval($value2) ;
              }if ($key=='id_pompiste') {
                   $id_pompiste= intval($value2);
              }if ($key=='id_produit') {
                   $id_produit= intval($value2);
              }if ($key=='montant') {
                   $montant= intval($value2);
              }if ($key=='qte') {
                  $quantite= intval($value2);
             }
          }  // ENd For each
               
               $res=mysqli_query($conn, "CALL Recap_vte_lub($id_client, $id_pompiste, $id_produit, $montant, $quantite)");
                  if ($res == false) {
    
                    $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                       $jsn = json_encode($arr);
                       print_r($jsn);
                       return json_encode($jsn);  
                    
                  }
         
        }  // End for each
    
  }

  if (isset($app_quart_rgt_carburant)) {

     foreach ($app_quart_rgt_carburant as $value) {

        foreach ($value as $key => $value2) {
          
             if ($key=='nom_pompiste') {
                 $nom_pompiste=$value2;
            }if ($key=='montant') {
                 $montant=$value2;
            }
        }  // ENd For each
         
         $res=mysqli_query($conn, "CALL Recap_rgt_carb('$nom_pompiste', $montant)");
            if ($res == false) {

              $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                 $jsn = json_encode($arr);
                 print_r($jsn);
                 return json_encode($jsn);  
              
            }
   
     }  // End for each
    
  }

  if (isset($app_quart_rgt_client)) {

    foreach ($app_quart_rgt_client as $value) {

      foreach ($value as $key => $value2) {
        
           if ($key=='client') {
               $client=$value2->nom_client;
          }if ($key=='station') {
               $station=$value2;
          }if ($key=='montant') {
               $montant=$value2;
          }if ($key=='type_reglement') {
               $type_reglement=$value2;
          }
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_rgt_client('$client', '$station', $montant,'$type_reglement' )");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
    }  // End for each
    
  }


  if (isset($app_quart_depense)) {

    foreach ($app_quart_depense as $value) {

      foreach ($value as $key => $value2) {
        
           if ($key=='nature') {
               $nature=$value2;
          }if ($key=='recette') {
               $recette=$value2;
          }if ($key=='montant') {
               $montant=$value2;
          }if ($key=='responsable') {
               $responsable=$value2;
          }
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_depense('$nature', '$recette', $montant,'$responsable' )");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
    }  // End for each
    
  }

   
   if (isset($app_quart_versement)) {

      foreach ($app_quart_versement as $key => $value2) {

         if ($key=='num_banque') {
             $num_banque=$value2;
        }if ($key=='num_bordereau') {
             $num_bordereau=$value2;
        }if ($key=='montant') {
             $montant=$value2;
        }if ($key=='num_compte') {
             $num_compte=$value2;
        }

      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_versement('$num_banque', '$num_bordereau', $montant,'$num_compte')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     # code...
   } 

   if (isset($app_quart_commentaire)) {

     foreach ($app_quart_commentaire as $key => $value2) {

        if ($key=='ventes') {
            $commentaire_ventes =$value2;
       }if ($key=='pannes') {
            $commentaire_pannes =$value2;
       }

     }  // ENd For each
          
          $res=mysqli_query($conn, "CALL Recap_commentaire('$commentaire_ventes', '$commentaire_pannes' )");
             if ($res == false) {

               $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                  $jsn = json_encode($arr);
                  print_r($jsn);
                  return json_encode($jsn);  
               
             }
    # code...
   } 

    
   if (isset($app_quart_om)) {

        foreach ($app_quart_om as $key => $value2) {

         if ($key=='ancien_solde') {
             $ancien_solde=$value2;
        }if ($key=='nouveau_solde') {
             $nouveau_solde=$value2;
        }

        }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_om($ancien_solde, $nouveau_solde)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }
  
     
   if (isset($app_quart_appro)) {

        foreach ($app_quart_appro as $key => $value2) {

           if ($key=='ancien_solde') {
               $ancien_solde=$value2;
          }

        }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_appro($ancien_solde)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }


   if (isset($app_quart_boutique)) {

        foreach ($app_quart_boutique as $key => $value2) {

           if ($key=='ancien_solde') {
               $ancien_solde=$value2;
          }if ($key=='montant') {
               $montant=$value2;
          }

        }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_boutique($ancien_solde, $montant)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }

   if (isset($app_quart_laverie)) {


      foreach ($app_quart_laverie as $key => $value2) {

         if ($key=='montant') {
             $montant=$value2;
        }

      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Recap_laverie($montant)");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }


   if (isset($app_quart_date)) {

    // var_dump($app_quart_date) ;

     foreach ($app_quart_date as $key => $value2) {

        if ($key=='date_ouverture') {

          $date_quart = new DateTime($value2); 
          $date_quart = $date_quart->format('Y-m-d') ;
          $date_ouverture_quart = $date_quart ; 
       }

       if ($key=='date_banque') {

          $date_banque = new DateTime($value2); 
          $date_banque = $date_banque->format('Y-m-d') ;

         // var_dump($date_banque) ;
     
       }

       if ($key=='date_stock') {

          $date_stock = new DateTime($value2); 
          $date_stock = $date_stock->format('Y-m-d') ;
     
       }

       if ($key=='quart') {

          $numero_quart = $value2;
       }

       if ($key=='lien_banque') {

          $lien_banque = str_replace(" ",  "-", $value2) ;
       }

       if ($key=='lien_stock') {

          $lien_stock = str_replace(" ",  "-", $value2) ;
       }


     }  // ENd For each
          
    
  }
  
  
    
  $res=mysqli_query($conn, "CALL Recap_transfert( $id_station, $id_region, $userId, '$date_ouverture_quart', '$numero_quart', '$date_banque', '$lien_banque', '$date_stock', '$lien_stock')");
 // $res=mysqli_query($conn, "CALL Recap_versement( $id_station, $id_region, $userId, '$date_ouverture_quart', '$numero_quart', '$date_banque', '$lien_banque', '$date_stock', '$lien_stock')");
     

     if ($res == false) {

     $arr = array('msge' =>  mysqli_error($conn) , 'error' => substr(mysqli_error($conn),0,9));
          $jsn = json_encode($arr);
         print_r($jsn);
          return json_encode($jsn); 
     
     }    

     $data = array() ;

     if (is_object($res)) {


        while($rows = mysqli_fetch_array($res))

      {
         $data_final[] = array(

              "Transfert_Reussie"  =>   $rows['Transfert_Reussie']
             
                   ) ;
       }

      // include 'rappel3.php' ;

        try {
                    
               if( $numero_quart == 'quart 2' ) {

              // sendEmail($email_station, $email_regional, 'BLESSING '.$nom_station, $date_quart, $html.$html2.$html5.$html3.$html6.$html4) ;
     
               }

        } catch (Exception $e) {
            // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }


       print_r(json_encode($data_final));
       return json_encode($data_final);  
     
     }

  
    
}


function Envoyer_Station() {

//  $id_station = $_SESSION['id_station'];
// $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 // connect DB
$conn=mysqli_connect("localhost","station","station","station");

   $data = json_decode(file_get_contents("php://input"));
//   print_r($data)   ;
   
    $cuves       = $data->cuves;
    $pompes    = $data->pompes;   
    $pistolets    = $data->pistolets;   
    $personnels    = $data->personnels;   
    $comptes    = $data->comptes;   
    $station    = $data->station;   

    $capacite_cuve=0;
    $nom_cuve=$produit=$nom_pompe=$type_pompe=$date_pompe=$nom_pistolet=$date_pistolet=$pompe=$cuve=$nom_personnel=$nom_utilisateur=$role=$password=$email_utilisateur="";

    
  // verifier les produits GASOIL/SUPER/PETROLE 
    foreach ($cuves as $value) {

      foreach ($value as $key => $value2) {
           
        if ($key=='nom_cuve') {
             $nom_cuve= strtoupper($value2)  ;
        }if ($key=='capacite_cuve') {
             $capacite_cuve= strtoupper($value2) ;
        }if ($key=='produit') {
             $produit=strtoupper($value2) ;
        }
           
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_cuve('$nom_cuve', $capacite_cuve,'$produit')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each

   foreach ($pompes as $value) {

      foreach ($value as $key => $value2) {

          if ($key=='nom_pompe') {
               $nom_pompe= strtoupper($value2) ;
          }if ($key=='type_pompe') {
               $type_pompe= strtoupper($value2) ;
          }if ($key=='date_pompe') {
               $date_pompe= strtoupper($value2) ;
          }
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_pompe('$nom_pompe', '$type_pompe', '$date_pompe')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each 

   foreach ($personnels as $value) {

      foreach ($value as $key => $value2) {
        

          if ($key=='nom_personnel') {
               $nom_personnel= strtoupper($value2) ;
          }
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_personnel('$nom_personnel')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each

   foreach ($comptes as $value) {

      foreach ($value as $key => $value2) {
        

          if ($key=='nom_utilisateur') {
               $nom_utilisateur=$value2;
          }if ($key=='role') {
               $role=$value2;
          }if ($key=='password') {
               $password=$value2;
          }if ($key=='email_utilisateur') {
               $email_utilisateur=$value2;
          }
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_compte('$nom_utilisateur', '$role', '$password', '$email_utilisateur')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each


  foreach ($station as $key => $value2) {
    

      if ($key=='nom_station') {
           $nom_station=strtoupper($value2);
      }if ($key=='region') {
           $region=strtoupper($value2) ;
      }if ($key=='email_station') {
           $email_station=$value2;
      }if ($key=='telephone_gerant') {
           $telephone_gerant=$value2;
      }if ($key=='nom_gerant') {
           $nom_gerant=strtoupper($value2) ;
      }
  }  // ENd For each
       
  $res=mysqli_query($conn, "CALL Init_station('$nom_station', '$region', '$email_station', $telephone_gerant, '$nom_gerant')");

    if ($res == false) {

      $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
         return json_encode($jsn);  
      
    }

  // Send query PISTOLET

    foreach ($pistolets as $value) {

      foreach ($value as $key => $value2) {
        

          if ($key=='nom_pistolet') {
               $nom_pistolet=strtoupper($value2);
          }if ($key=='date_pistolet') {
               $date_pistolet=$value2;
          }if ($key=='pompe') {
               $pompe=strtoupper($value2);
          }if ($key=='cuve') {
               $cuve=strtoupper($value2);
          }
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_pistolet('$nom_pistolet', '$date_pistolet', '$pompe', '$cuve')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each

   $arr = array('msg' => '' , 'error' => 'Error In inserting record');
   $jsn = json_encode($arr);
   print_r($jsn);
   return json_encode($jsn);  

       

        
    
}

function Envoyer_Produit() {

 // $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 // connect DB
$conn=mysqli_connect("localhost","station","station","station");

   $data = json_decode(file_get_contents("php://input"));
//   print_r($data)   ;
   
    $produits       = $data->produits;

    $prix_produit=0;
    $nom_produit=$code_produit=$type_produit=$conditionnement=$station="";

    foreach ($produits as $value) {

      foreach ($value as $key => $value2) {
           
        if ($key=='nom_produit') {
             $nom_produit= strtoupper($value2) ;
        }if ($key=='code_produit') {
             $code_produit= strtoupper($value2) ;
        }if ($key=='type_produit') {
             $type_produit= strtoupper($value2) ;
        }if ($key=='prix_produit') {
             $prix_produit= strtoupper($value2) ;
        }if ($key=='conditionnement') {
             $conditionnement= strtoupper($value2) ;
        }if ($key=='station') {
             $station=$value2;
        }
           
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_produit('$nom_produit', '$code_produit','$type_produit', $prix_produit, '$conditionnement', '$station')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each

   $arr = array('msg' => '' , 'error' => 'Error In inserting record');
   $jsn = json_encode($arr);
   print_r($jsn);
   return json_encode($jsn);  

    
}

function get_index() {

 // $id_station = $_SESSION['id_station'];
// $id_region = $_SESSION['id_region'];
 //$userId = $_SESSION['id_user'];

 // connect DB
$conn=mysqli_connect("localhost","station","station","station");

   $data = json_decode(file_get_contents("php://input"));
//   print_r($data)   ;
   
    $personnel       = $data->personnel;

    $index_depart=$index_depart_remise=$index_fin=$index_fin_remise=0;
    $motif=$nom_pistolet=$nom_pompiste=$nom_produit=$responsable="";

    foreach ($personnel as $value) {

      foreach ($value as $key => $value2) {
           
        if ($key=='index_depart') {
             $index_depart= $value2 ;
        }if ($key=='index_depart_remise') {
             $index_depart_remise= $value2 ;
        }if ($key=='index_fin') {
             $index_fin= $value2 ;
        }if ($key=='index_fin_remise') {
             $index_fin_remise= $value2 ;
        }if ($key=='motif') {
             $motif= $value2 ;
        }if ($key=='nom_pistolet') {
             $nom_pistolet=$value2;
        }if ($key=='nom_pompiste') {
             $nom_pompiste=$value2;
        }if ($key=='nom_produit') {
             $nom_produit=$value2;
        }if ($key=='responsable') {
             $responsable=$value2;
        }
           
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL get_index($index_depart,$index_depart_remise,$index_fin, $index_fin_remise, '$motif', '$responsable', '$nom_pompiste','$nom_pistolet', '$nom_produit')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each



   $res1=mysqli_query($conn, " SELECT * From T_Index");

     $data = array();
     
     if (is_object($res1)) {

        while($rows = mysqli_fetch_array($res1))

      {
         $data[] = array(

          "index_depart"  => intval($rows['index_depart']),
          "index_depart_remise"  => intval($rows['index_depart_remise']),
          "index_fin"  => intval($rows['index_fin']),
          "index_fin_remise"  => intval($rows['index_fin_remise']),
          "motif"  => $rows['motif'],
          "nom_pistolet"  => $rows['nom_pistolet'],
          "nom_pompiste"  => $rows['nom_pompiste'],
          "nom_produit"  => $rows['nom_produit'],
          "responsable"  => $rows['responsable'],
          "nom_cuve"  => $rows['nom_cuve'],
          "check"  => $rows['check']

                   ) ;
     }
     print_r(json_encode($data));
     return json_encode($data);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  

        
    } 

    
}

function Envoyer_Client() {

//  $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 // connect DB
$conn=mysqli_connect("localhost","station","station","station");

   $data = json_decode(file_get_contents("php://input"));
//   print_r($data)   ;
   
    $clients       = $data->clients;

    $prix_client=0;
    $nom_client=$code_client=$type_client=$produit=$station="";

    foreach ($clients as $value) {

      foreach ($value as $key => $value2) {
           
        if ($key=='nom_client') {
             $nom_client=strtoupper($value2);
        }if ($key=='code_client') {
             $code_client=strtoupper($value2);
        }if ($key=='type_client') {
             $type_client=strtoupper($value2);
        }if ($key=='prix_client') {
             $prix_client=$value2;
        }if ($key=='produit') {
             $produit=strtoupper($value2);
        }if ($key=='station') {
             $station=strtoupper($value2);
        }
           
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_client('$nom_client', '$code_client','$type_client', $prix_client, '$produit', '$station')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each

   $arr = array('msg' => '' , 'error' => 'Error In inserting record');
   $jsn = json_encode($arr);
   print_r($jsn);
   return json_encode($jsn);  

    
}


function Envoyer_Transporteur() {

 // $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

 // connect DB
 $conn=mysqli_connect("localhost","station","station","station");

   $data = json_decode(file_get_contents("php://input"));
 //   print_r($data)   ;
   
    $transporteurs       = $data->transporteurs;

    $prix_transporteur=0;
    $nom_transporteur=$code_transporteur=$type_transporteur=$produit=$station="";

    foreach ($transporteurs as $value) {

      foreach ($value as $key => $value2) {
           
        if ($key=='nom_transporteur') {
             $nom_transporteur=strtoupper($value2);
        }if ($key=='code_transporteur') {
             $code_transporteur=strtoupper($value2);
        }if ($key=='type_transporteur') {
             $type_transporteur=strtoupper($value2);
        }if ($key=='prix_transporteur') {
             $prix_transporteur=$value2;
        }if ($key=='produit') {
             $produit=strtoupper($value2);
        }if ($key=='station') {
             $station=strtoupper($value2);
        }
           
      }  // ENd For each
           
           $res=mysqli_query($conn, "CALL Init_transporteur('$nom_transporteur', '$code_transporteur','$type_transporteur', $prix_transporteur, '$produit', '$station')");
              if ($res == false) {

                $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
                   $jsn = json_encode($arr);
                   print_r($jsn);
                   return json_encode($jsn);  
                
              }
     
   }  // End for each

   $arr = array('msg' => '' , 'error' => 'Error In inserting record');
   $jsn = json_encode($arr);
   print_r($jsn);
   return json_encode($jsn);  

    
}


function livraison_carb_quart() {

    $id_station = $_SESSION['id_station'];
    $id_region = $_SESSION['id_region'];
    $userId = $_SESSION['id_user'];
   
    // connect DB
   $conn=mysqli_connect("localhost","station","station","station");
   
   $res=mysqli_query($conn, "CALL livraison_carb_quart('$id_station', '$id_region', '$userId') "     
     );
     
        $data = array();
   
       
        if (is_object($res)) {
   
           while($rows = mysqli_fetch_array($res))
   
         {
            $data[] = array(
   
               "date_fermerture"  =>   $rows['date_fermerture'],
               "quantite_commande"  =>   $rows['quantite_commande'],
               "quantite_recu"  =>   $rows['quantite_recu'],
               "manquant"  =>   $rows['manquant'],
               "id_quart"  =>   $rows['id_quart'],
               "produit"  =>   $rows['produit']
                 
                      ) ;
        }
        print_r(json_encode($data));
        return json_encode($data);  
       }
       else {
           $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
            $jsn = json_encode($arr);
            print_r($jsn);
        return json_encode($jsn);  
   
           
       }
      
   
}

function livraison_lub_quart() {

     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
    
     // connect DB
    $conn=mysqli_connect("localhost","station","station","station");
    
    $res=mysqli_query($conn, "CALL livraison_lub_quart('$id_station', '$id_region', '$userId') "     
      );
      
         $data = array();
    
        
         if (is_object($res)) {
    
            while($rows = mysqli_fetch_array($res))
    
          {
             $data[] = array(
    
                "date_fermerture"  =>   $rows['date_fermerture'],
                "quantite_commande"  =>   $rows['quantite_commande'],
                "quantite_recu"  =>   $rows['quantite_recu'],
                "manquant"  =>   $rows['manquant'],
                "id_quart"  =>   $rows['id_quart'],
                "produit"  =>   $rows['produit']
                  
                       ) ;
         }
         print_r(json_encode($data));
         return json_encode($data);  
        }
        else {
            $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
             $jsn = json_encode($arr);
             print_r($jsn);
         return json_encode($jsn);  
    
            
        }
       
    
}

function Etats_Ventes() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->ventes;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $quart = $requete->quart ;
        $station = $requete->station ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
        /********************************************MANQUANTS******************************************************************* */
   
        $query_depenses = "
        
             Select
             Sum(station.depense_station.montant_depense) As montant,
             Date(station.quart.date_ouverture) As date,
             station.nom_station As station
        From
             depense_station Inner Join
             quart On depense_station.id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region
   
                  WHERE 
           
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        Group By
             
             Date(station.quart.date_ouverture),
             station.nom_station
        
        " ;
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "
   
        Select
       Date(station.quart.date_ouverture) As date,
       client.nom_client AS client,
       station.nom_station AS station,
       Sum(station.pompiste_has_client.montant) As montant,
       client.id_client
        From
        pompiste_has_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        client On client.id_station = station.id_station
                  And client.id_region = station.id_region
                  And station.pompiste_has_client.client_id_client = client.id_client
   
                  WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )   
   
        Group By
        Date(station.quart.date_ouverture),
        client.nom_client,
        station.nom_station,
        client.id_client
             
             " ;
    
     /************************************************************************************************************************ */
    
         $query_vers_pompiste = " 
   
           Select
           Date(station.quart.date_ouverture) As date,
          
           station.nom_station As station,
           Sum(station.versement_pompiste.montant_versement) As montant
      From
      versement_pompiste Inner Join
      quart On versement_pompiste.id_quart = quart.id_quart Inner Join
      pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
      station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
                And station.pompiste.id_station = station.id_station
                And station.pompiste.id_region = station.id_region
      WHERE 
           
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
      Group By
           Date(station.quart.date_ouverture),
          
           station.nom_station
           
           
    
      " ;
   
   
        /******************** REQUETES MANQUANTS POMPISTES********************************************************************* */  
      
        $res_depenses = mysqli_query($conn, $query_depenses );
    
        $data_depenses = array();
    
        if (is_object($res_depenses)) {
    
    
              while($rows = mysqli_fetch_array($res_depenses))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_depenses[] = $obj ;
                   }
              
              }
    
    
        }
      
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->id_client = $rows['id_client'] ;
                        $obj->client = $rows['client'] ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
     $res_vers_pompiste = mysqli_query($conn, $query_vers_pompiste );
    
        $data_vers_pompiste = array();
    
        if (is_object($res_vers_pompiste)) {
    
    
              while($rows = mysqli_fetch_array($res_vers_pompiste))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_vers_pompiste[] = $obj ;
    
                        
                   }
              
              }
    
    
        }
    
     /***********************************VENTES-VERSEMENT************************************** */  
   
      
        $query = "
        
        Select
        Date(station.quart.date_ouverture) As date,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise +0.0)) As quantite,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise +0.0))* produit_station.prix_produit As montant,
        station.produit.nom_produit As produit,
        station.nom_station As station
        
        From
        pompiste_pistolet Inner Join
        pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
                  And pompiste_pistolet.id_cuve = pistolet.id_cuve
                  And pompiste_pistolet.id_station = pistolet.id_station
                  And pompiste_pistolet.id_region = pistolet.id_region
                  And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
        cuves On pistolet.id_cuve = cuves.id_cuve
                  And pistolet.id_station = cuves.id_station
                  And pistolet.id_region = cuves.id_region Inner Join
        produit On cuves.id_produit = produit.id_produit Inner Join
        quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        produit_station On produit_station.id_produit = station.produit.id_produit
                  And produit_station.id_station = station.id_station
                  And produit_station.id_region = station.id_region
   
        WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
        Group By
        Date(station.quart.date_ouverture),
        station.produit.nom_produit,
        station.nom_station
        
        
        ";  
        /********************************************************************************************************************* */
   
        $query_Lub = "
   
        Select
        Date(station.quart.date_ouverture) As date,
        station.nom_station As station,
        produit.nom_produit AS produit,
        produit.conditionnement AS conditionnement,
        SUM(station.produit_quart.qte_vendu) AS quantite,
        produit_station.prix_produit AS prix_unitaire,
        Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
    From
        produit_quart Inner Join
        quart On produit_quart.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region Inner Join
        produit On station.produit_quart.id_produit = produit.id_produit Inner Join
        produit_station On produit_station.id_station = station.id_station
                And produit_station.id_region = station.id_region
                And produit_station.id_produit = produit.id_produit
 
                WHERE 
 
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
    Group By
 
        Date(station.quart.date_ouverture),
        station.nom_station,
        produit.nom_produit,
        produit.conditionnement,
        produit_station.prix_produit
   
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
   
     " ;
       
    /************************************************************************************************** */

    $query_vers_client = " 
     
 Select
    station.client.nom_client As client,
    station.nom_station As station,
    Sum(station.reglement.montant_reglement) As montant,
    DATE(station.quart.date_ouverture) As date
 From
    reglement Inner Join
    client On reglement.id_client = client.id_client Inner Join
    station On station.reglement.id_station = station.id_station
            And station.reglement.id_region = station.id_region
            And station.client.id_station = station.id_station
            And station.client.id_region = station.id_region Inner Join
    quart On station.quart.id_station = station.station.id_station
            And station.quart.id_region = station.station.id_region
            And station.reglement.id_quart = station.quart.id_quart
 WHERE 

 (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) AND
 (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) 

     Group By
     DATE(station.quart.date_ouverture),
     station.client.nom_client,
     station.station.nom_station " ;

 /******************************************************************************************************** */

 $query_lien_banque = " 
     
     SELECT
  DATE (quart.date_ouverture) AS date,
  station.nom_station AS station,
  documents_banque.lien_banque
 FROM
  documents_banque
  INNER JOIN quart ON documents_banque.id_quart = quart.id_quart
  INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
  
 WHERE 
  
  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) 

  GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
  
 
  " ;


 /******************************************************************************************************** */

 $query_lien_stock = " 
     
     SELECT
  DATE (quart.date_ouverture) AS date,
  station.nom_station AS station,
  documents_stock.lien_stock
 FROM
  documents_stock
  INNER JOIN quart ON documents_stock.id_quart = quart.id_quart
  INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
  
 WHERE 
  
  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

  GROUP BY
     
  DATE(station.quart.date_ouverture),
  station.nom_station
  
 
  " ;
    

 /******************************************************************************************************* */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->quantite = intval($rows['quantite']) ;
                       $obj->produit = $rows['produit'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = $rows['montant'] ;
   
                       $data_carb[] = $obj ;
   
             }
          
       }
   
    /****************************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query_Lub );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
   
             while($rows = mysqli_fetch_array($res_lub))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
                       
                  }
             
             }
   
   
       }
   
    /*************************************************************************************************** */ 
    
    $res_vers_client = mysqli_query($conn, $query_vers_client );

 $data_vers_client = array(); 

 if (is_object($res_vers_client)) {


      while($rows = mysqli_fetch_array($res_vers_client))

      {
           if ($rows['station'] == $station) {

                $obj = new stdClass();

                $obj->date = $rows['date'] ;
                $obj->client = $rows['client'] ;
                $obj->montant = floatval($rows['montant']) ;
                $obj->station = $rows['station'] ;

                $data_vers_client[] = $obj ;

                
           }
      
      }


 }

 /*************************************************************************** */

 $res_lien_banque = mysqli_query($conn, $query_lien_banque );

 $data_lien_banque = array();

 if (is_object($res_lien_banque)) {


      while($rows = mysqli_fetch_array($res_lien_banque))

      {
           if ($rows['station'] == $station) {

                $obj = new stdClass();

                $obj->date = $rows['date'] ;
                $obj->station = $rows['station'] ;
                $obj->lien_banque = $rows['lien_banque'] ;

                $data_lien_banque[] = $obj ;

                
           }
      
      }


 }

     /*************************************************************************** */

     $res_lien_stock = mysqli_query($conn, $query_lien_stock );

     $data_lien_stock = array();

 if (is_object($res_lien_stock)) {


      while($rows = mysqli_fetch_array($res_lien_stock))

      {
           if ($rows['station'] == $station) {

                $obj = new stdClass();

                $obj->date = $rows['date'] ;
                $obj->station = $rows['station'] ;
                $obj->lien_stock = $rows['lien_stock'] ;

                $data_lien_stock[] = $obj ;

                
           }
      
      }


 }

 /***************************************************************************************************** */
   
          $datas = new stdClass();

          $datas->entete = [] ;
          $datas->corps = [] ;
          $datas->pied = [] ;

          $clients = array() ;
          $vers_clients = array() ;
   
        $en_tete = new stdClass();
                  
        $en_tete->date = 'DATE' ;
        $en_tete->super = 'SUPER' ;
        $en_tete->gasoil = 'GASOIL' ;
        $en_tete->petrole = 'PETROLE' ;
        $en_tete->tpc = 'TPC' ;
        $en_tete->total_carb = 'TOTAL CARB' ;
        $en_tete->total_lub = 'TOTAL LUB' ;
        $en_tete->total_attendu = 'TOTAL ATTENDU' ;
        $en_tete->versement = 'VERSEMENT' ;
        $en_tete->ventes_client = 0 ;
        $en_tete->versement_pompistes = 0 ;
        $en_tete->manquant_pompiste = 'MQTS POMPISTES' ;
        $en_tete->depense = 'DEPENSES' ;
        $en_tete->ecart = 'ECART' ;
        $en_tete->ecart_gerant = 'ECART GERANT' ;
        $en_tete->clients = [] ;
        $en_tete->total_clients = 0 ;
        $en_tete->vers_clients = [] ;
        $en_tete->total_vers_clients = 0 ;
        $en_tete->lien_banque = 'DOCUMENT BANQUE' ;
        $en_tete->lien_stock = 'DOCUMENT STOCK' ;
   
        foreach ($data_client as $key10 => $value10) {
                  
              $clients[] = $value10->client ;
             
        }

        foreach ($data_vers_client as $key11 => $value11) {
               
          $vers_clients[] = $value11->client ;
     
   }


        $en_tete->clients = array_unique($clients);
        $en_tete->vers_clients = array_unique($vers_clients);

        $total = new stdClass();
                  
        $total->date = 'TOTAL' ;
        $total->super = 0 ;
        $total->gasoil = 0 ;
        $total->petrole = 0 ;
        $total->tpc = 0 ;
        $total->total_carb = 0 ;
        $total->total_lub = 0 ;
        $total->total_attendu = 0 ;
        $total->versement = 0 ;
        $total->ventes_client = 0 ;
        $total->versement_pompistes = 0 ;
        $total->manquant_pompiste = 0 ;
        $total->depense = 0 ;
        $total->ecart = 0 ;
        $total->ecart_gerant = 0 ;
        $total->clients = [] ;
        $total->total_clients = 0 ;
        $total->vers_clients = [] ;
        $total->total_vers_clients = 0 ;
        $total->lien_banque = '' ;
        $total->lien_stock = '' ;

      //  $total->clients = array_unique($clients);

        $datas->entete[] = $en_tete ;
        
   
        foreach ($dates as $key => $value) {
   
             $data = new stdClass();
             $date = $value ;
   
             $data->date = $value ;
             $data->super = 0 ;
             $data->gasoil = 0 ;
             $data->petrole = 0 ;
             $data->tpc = 0 ;
             $data->total_carb = 0 ;
             $data->total_lub = 0 ;
             $data->total_attendu = 0 ;
             $data->versement = 0 ;
             $data->ventes_client = 0 ;
             $data->versement_pompistes = 0 ;
             $data->manquant_pompiste = 0 ;
             $data->depense = 0 ;
             $data->ecart = 0 ;
             $data->ecart_gerant = 0 ;
             $data->clients = [] ;
             $data->total_clients = 0 ;
             $data->vers_clients = [] ;
             $data->total_vers_clients = 0 ;
   
   
             foreach ($data_carb as $key2 => $value2) {
                  
                  if ($value2->date == $date) {
                       
                    if ($value2->produit == 'SUPER') {

                         $data->super += $value2->quantite ;
                         $total->super += $value2->quantite ;

                    } elseif ($value2->produit == 'GASOIL') {

                         $data->gasoil += $value2->quantite ;
                         $total->gasoil += $value2->quantite ;

                    } elseif ($value2->produit == 'PETROLE'){
                         
                         $data->petrole += $value2->quantite ;
                         $total->petrole += $value2->quantite ;
                    }

                    $data->tpc += $value2->quantite ;
                    $total->tpc += $value2->quantite ;

                    $data->total_carb += $value2->montant ;
                    $total->total_carb += $value2->montant ;
                    
                  }
   
             }
   
             foreach ($data_lub as $key3 => $value3) {


                  
                  if ($value3->date == $date) {
                       
                    $data->total_lub += $value3->montant ;
                    $total->total_lub += $value3->montant ;

                       
                  }
             }
   
             foreach ($data_vers as $key4 => $value4) {


                  
                  if ($value4->date == $date) {
                       
                    $data->versement += $value4->montant ;
                    $total->versement += $value4->montant ;

                       
                  }
             }
   
             foreach ($data_client as $key5 => $value5) {


                  
                  if ($value5->date == $date) {
   
                    $data->ventes_client += $value5->montant ;
                    $total->ventes_client += $value5->montant ;

   
                  }
             }

             foreach ($en_tete->clients as $key10 => $value10) {
   
               $client = 0 ;

               foreach ($data_client as $key11 => $value11) {


                    if ($value10 == $value11->client && $date == $value11->date) {
                    
                         $client += $value11->montant ;
                    } 
                    
               }

              
               $data->clients[] = $client ;
               $data->total_clients += $client ;

             }

             
             foreach ($en_tete->vers_clients as $key12 => $value12) {

               $vers_client = 0 ;
              
   
              foreach ($data_vers_client as $key13 => $value13) {
   
                   if ($value12 == $value13->client && $date == $value13->date) {
                   
                       $vers_client += $value13->montant ;
                   } 
                   
              }
   
             
              $data->vers_clients[] = $vers_client ;
              $data->total_vers_clients += $vers_client ;
              
   
             }

   
             foreach ($data_vers_pompiste as $key6 => $value6) {


                  
                 if ($value6->date == $date) {
   
                  $data->versement_pompistes += $value6->montant ;
                  $total->versement_pompistes += $value6->montant ;

                 }
             }
   
             foreach ($data_depenses as $key7 => $value7) {


                  
                  if ($value7->date == $date) {
                       
                       $data->depense += $value7->montant ;
                       $total->depense += $value7->montant ;

                  }
             }

             foreach ($data_lien_banque as $key14 => $value14) {
               
               if ($value14->date == $date) {
                    
                $data->lien_banque = $value14->lien_banque ;

               }
             }

             foreach ($data_lien_stock as $key15 => $value15) {
                    
               if ($value15->date == $date) {
                    
               $data->lien_stock = $value15->lien_stock ;

               }

             }
   
             $data->total_attendu = $data->total_carb + $data->total_lub ;
         

             foreach ($data_vers_client as $key9 => $value9) {
                    
               if ($value9->date == $date) {

                    $data->total_attendu += $value9->montant ;

               }

             }

             $data->ecart = $data->total_attendu - $data->versement ;
             $data->manquant_pompiste = $data->total_carb - $data->ventes_client - $data->versement_pompistes ;
   
             $data->ecart_gerant =  $data->ecart - $data->manquant_pompiste - $data->depense ;

            
             foreach ($data_client as $key8 => $value8) {
   
               if ($value8->date == $date) {

                    $data->ecart_gerant -= $value8->montant ;
    
               }
                  
                 
             }

            
             $datas->corps[] = $data ;
        }

        /**************************************LIEN FICHIER STOCK*************************** */

          $lien_stock = '' ;

          foreach ($data_lien_stock as $key15 => $value15) {
                         
               if ($value15->date == $date) {
                    
               $lien_stock = $value15->lien_stock ;

               }

          }

        /*********************************TOTAL CLIENTS A TERME*** *******************************************/

        $total->total_attendu = $total->total_carb + $total->total_lub ; // calcul total attendu

        foreach ($en_tete->clients as $key10 => $value10) {
   
          $client = 0 ;

          foreach ($data_client as $key11 => $value11) {


               if ($value10 == $value11->client) {
               
                    $client += $value11->montant ;
               } 
               
          }

         
          $total->clients[] = $client ;
          $total->total_clients += $client ;

        }

        foreach ($en_tete->vers_clients as $key => $value) {
         
          $montant = 0 ;
  
          foreach ($data_vers_client as $key2 => $value2) {
              
              if ($value == $value2->client) {
                  
                  $montant += $value2->montant ;
              }
          }
  
          $total->vers_clients[] = $montant ;
          $total->total_vers_clients += $montant ;


          $total->total_attendu += $montant ;  // incrementation sur total_attendu

        }  // incrementation sur total attendu
  
        $total->ecart = $total->total_attendu - $total->versement ; // calcul ecart 

        /******************************************************************** */

        $total->manquant_pompiste = $total->total_carb - $total->ventes_client - $total->versement_pompistes ;
   
        $total->ecart_gerant =  $total->ecart - $total->manquant_pompiste - $total->depense ;
   
        foreach ($data_client as $key8 => $value8) {

          $total->ecart_gerant -= $value8->montant ;
               
        }

        $datas->pied[] = $total ;


       print_r(json_encode($datas));
       return json_encode($datas);  
       
      }
       
}



function Etats_Creances() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->creances;
   
       $date_debut = $date_fin = $client =  '' ;
       
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $client = $requete->client ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
       
        $dates = [] ;
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);

     //   $dates [] = date_format($date_debut, 'Y-m-d') ;

        $date_initiale = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
        $date_initiale = date_format($date_initiale, 'Y-m-d');
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
       $clients = array() ;

       $res_clients=mysqli_query($conn, "
   
             Select
             client.nom_client,
             client.code_client,
             client.solde_initial,
             client.solde_client
         From
             client
         Group By
             
             client.code_client
   
         " ) ;
   
   
       
        if (is_object($res_clients)) {
   
           while($rows = mysqli_fetch_array($res_clients))
   
          {
            $clients[] = array(
   
             "nom_client"  =>   $rows['nom_client'],
             "code_client"  =>   $rows['code_client'],
             "solde_initial"  =>   $rows['solde_initial'],
             "solde_client"  =>   $rows['solde_client']
                 
                      ) ;
          }
        }
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "
   
        Select
       Date(station.quart.date_ouverture) As date,
       client.nom_client AS client,
       station.nom_station AS station,
       Sum(station.pompiste_has_client.quantite) As quantite,
       Sum(station.pompiste_has_client.montant) As montant
     
        From
        pompiste_has_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        client On client.id_station = station.id_station
                  And client.id_region = station.id_region
                  And station.pompiste_has_client.client_id_client = client.id_client

                  WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
                 
   
        Group By
        Date(station.quart.date_ouverture),
        client.nom_client,
        station.nom_station
       
             
             " ;


             $query_client_init = "
   
             Select
            Date(station.quart.date_ouverture) As date,
            client.nom_client AS client,
           
            station.nom_station AS station,
            Sum(station.pompiste_has_client.quantite) As quantite,
            Sum(station.pompiste_has_client.montant) As montant
          
             From
             pompiste_has_client Inner Join
             quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                       And station.quart.id_region = station.id_region Inner Join
             client On client.id_station = station.id_station
                       And client.id_region = station.id_region
                       And station.pompiste_has_client.client_id_client = client.id_client
     
                       WHERE 
             
                       (DATE( station.quart.date_fermerture ) <= '$date_initiale' )
        
                      
        
             Group By
             Date(station.quart.date_ouverture),
             client.nom_client,
             station.nom_station
            
                  
                  " ;
    
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
                   if ($rows['client'] == $client  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->client = $rows['client'] ;
                        $obj->quantite = intval($rows['quantite']) ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
                   }
              
              }
    
    
        }


        $res_client_init = mysqli_query($conn, $query_client_init );
    
        $data_client_init = array();
    
        if (is_object($res_client_init)) {
    
    
              while($rows = mysqli_fetch_array($res_client_init))
    
              {
                   if ($rows['client'] == $client  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->client = $rows['client'] ;
                        $obj->quantite = intval($rows['quantite']) ;

                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client_init[] = $obj ;
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
      
        $query_reglement = "
        
        Select
  
        DATE(station.reglement.date_reglement) AS date,
        station.client.nom_client AS client, 
        station.nom_station As station,
        Sum(station.reglement.montant_reglement) As montant
        
    From
        reglement Inner Join
        client On reglement.id_client = client.id_client Inner Join
        station On station.reglement.id_station = station.id_station
                And station.reglement.id_region = station.id_region
               
                And station.client.id_station = station.id_station
                And station.client.id_region = station.id_region
                WHERE 
        
                (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' )
    Group By
        Date(station.reglement.date_reglement),
        station.client.nom_client,
        station.nom_station
        
               
        
        ";  

        $query_reglement_init = "
          
        Select
  
        DATE(station.reglement.date_reglement) AS date,
        station.client.nom_client AS client, 
        station.nom_station As station,
        Sum(station.reglement.montant_reglement) As montant
        
    From
        reglement Inner Join
        client On reglement.id_client = client.id_client Inner Join
        station On station.reglement.id_station = station.id_station
                And station.reglement.id_region = station.id_region
               
                And station.client.id_station = station.id_station
                And station.client.id_region = station.id_region

                WHERE 
             
                (DATE( station.reglement.date_reglement) <= '$date_initiale' )
    Group By
        Date(station.reglement.date_reglement),
        station.client.nom_client,
        station.nom_station
        
          
     
     ";  
        /********************************************************************************************************************* */
   
   
       $res_reglement_init = mysqli_query($conn, $query_reglement_init );
   
       $data_reglement_init = array();
   
       if (is_object($res_reglement_init)) {
   
          while($rows = mysqli_fetch_array($res_reglement_init))
   
         {
             if ($rows['client'] == $client) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->client = $rows['client'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = intval($rows['montant']) ;
   
                       $data_reglement_init[] = $obj ;
   
              }
          
          }

       }

       $res_reglement = mysqli_query($conn, $query_reglement );
   
       $data_reglement = array();
   
       if (is_object($res_reglement)) {
   
          while($rows = mysqli_fetch_array($res_reglement))
   
         {
             if ($rows['client'] == $client) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->client = $rows['client'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = intval($rows['montant']) ;
   
                       $data_reglement[] = $obj ;
   
             }
          
         }
       }


   
        $datas = array() ;

        $data = new stdClass();

        $date = '' ;
        $data->client = '' ;
        $data->conso = 'solde' ;
        $data->montant =  'initial' ;
        $data->reglement = 'au' ;
        $data->station = $date_initiale ;
        
        $montant = 0;
        $reglement = 0;

        $solde_initial = 0 ;

        

        foreach ($clients as $key => $value) {

          if ($value['nom_client'] == $client) {

               $solde_initial = $value['solde_initial'] ;
          }
        }

   
          foreach ($data_client_init as $key5 => $value5) {
               
               if ($value5->client == $client) {

                 $montant += $value5->montant ;

                // var_dump($value5) ;
                   
               }
          }
         
          foreach ($data_reglement_init as $key8 => $value8) {

               
               if ($value8->client == $client) {

                    $reglement += $value8->montant ;

               }
          }



        $data->solde = $solde_initial + $montant - $reglement ;
        $datas[] = $data ;
   
   
        foreach ($dates as $key => $value) {

   
             $data = new stdClass();
             $date = $value ;
   
             $data->date = $value ;
             $data->client = $client ;
             $data->conso = 0 ;
             $data->montant = 0 ;
             $data->reglement = 0 ;
             $data->station = '' ;
             $data->solde = 0 ;

            
             foreach ($data_client as $key5 => $value5) {
   
                  
                  if ($value5->date == $date && $value5->client == $client) {
   
                    $data->conso = $value5->quantite ;
                    $data->montant = $value5->montant ;
                    $data->station = $value5->station ;
                      
                  }
             }
   
            
             foreach ($data_reglement as $key8 => $value8) {
   
                  
                  if ($value8->date == $date && $value8->client == $client) {
   
                       $data->reglement = $value8->montant ;
                       $data->station = $value5->station ;
   
                  }
             }


             $cle = count($datas) ;

             $data->solde = $datas[$cle - 1]->solde + $data->montant - $data->reglement ;

             $datas[] = $data ;
            
        }


   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      
       
}

function Etats_Creances_Station() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->creances;
   
        $date_fin = $station =  '' ;
        $station = $requete->station ;

        $date_init = new DateTime($requete->date_fin);
        $date_init2 = $date_init->modify("last day of previous month");
        $date_initiale = $date_init2->format("Y-m-d");
   
        $date_debut = new DateTime($requete->date_fin);
        $date_debut = $date_debut->modify("first day of this month");
        $date_debut2 = $date_debut->format("Y-m-d");

        $date_fin = date_create($requete->date_fin);
        $date_fin2 = date_format($date_fin, 'Y-m-d');

        // $dates [] = date_format($date_debut, 'Y-m-d') ;

         
       $clients = array() ;

       $res_clients=mysqli_query($conn, "
   
               Select
               client.nom_client,
               client.code_client,
               client.solde_initial,
               client.solde_client,
               station.nom_station
          From
               client Inner Join
               station On client.id_station = station.id_station
                         And client.id_region = station.id_region
          Group By
               client.code_client,
               station.nom_station
          
               " ) ;
   
   
       
        if (is_object($res_clients)) {
   
           while($rows = mysqli_fetch_array($res_clients))
   
          {
            $clients[] = array(
   
             "nom_client"  =>   $rows['nom_client'],
             "code_client"  =>   $rows['code_client'],
             "solde_initial"  =>   $rows['solde_initial'],
             "solde_client"  =>   $rows['solde_client'],
             "nom_station"  =>   $rows['nom_station']
                 
                      ) ;
          }
        }
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "
   
        Select
       Date(station.quart.date_ouverture) As date,
       client.nom_client AS client,
       station.nom_station AS station,
       Sum(station.pompiste_has_client.quantite) As quantite,
       Sum(station.pompiste_has_client.montant) As montant
     
        From
        pompiste_has_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        client On client.id_station = station.id_station
                  And client.id_region = station.id_region
                  And station.pompiste_has_client.client_id_client = client.id_client

                  WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
                 
   
        Group By
        Date(station.quart.date_ouverture),
        client.nom_client,
        station.nom_station
       
             
             " ;


             $query_client_init = "
   
             Select
            Date(station.quart.date_ouverture) As date,
            client.nom_client AS client,
           
            station.nom_station AS station,
            Sum(station.pompiste_has_client.quantite) As quantite,
            Sum(station.pompiste_has_client.montant) As montant
          
             From
             pompiste_has_client Inner Join
             quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                       And station.quart.id_region = station.id_region Inner Join
             client On client.id_station = station.id_station
                       And client.id_region = station.id_region
                       And station.pompiste_has_client.client_id_client = client.id_client
     
                       WHERE 
             
                       (DATE( station.quart.date_fermerture ) <= '$date_initiale' )
        
                      
        
             Group By
             Date(station.quart.date_ouverture),
             client.nom_client,
             station.nom_station
            
                  
                  " ;
    
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->client = $rows['client'] ;
                        $obj->quantite = intval($rows['quantite']) ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
                   }
              
              }
    
    
        }


        $res_client_init = mysqli_query($conn, $query_client_init );
    
        $data_client_init = array();
    
        if (is_object($res_client_init)) {
    
    
              while($rows = mysqli_fetch_array($res_client_init))
    
              {
                   if ($rows['station'] == $station ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->client = $rows['client'] ;
                        $obj->quantite = intval($rows['quantite']) ;

                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client_init[] = $obj ;
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
      
        $query_reglement = "
        
        Select
  
        DATE(station.reglement.date_reglement) AS date,
        station.client.nom_client AS client, 
        station.nom_station As station,
        Sum(station.reglement.montant_reglement) As montant
        
    From
        reglement Inner Join
        client On reglement.id_client = client.id_client Inner Join
        station On station.reglement.id_station = station.id_station
                And station.reglement.id_region = station.id_region
               
                And station.client.id_station = station.id_station
                And station.client.id_region = station.id_region
                WHERE 
        
                (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' )
    Group By
        Date(station.reglement.date_reglement),
        station.client.nom_client,
        station.nom_station
        
               
        
        ";  

        $query_reglement_init = "
          
        Select
  
        DATE(station.reglement.date_reglement) AS date,
        station.client.nom_client AS client, 
        station.nom_station As station,
        Sum(station.reglement.montant_reglement) As montant
        
    From
        reglement Inner Join
        client On reglement.id_client = client.id_client Inner Join
        station On station.reglement.id_station = station.id_station
                And station.reglement.id_region = station.id_region
               
                And station.client.id_station = station.id_station
                And station.client.id_region = station.id_region

                WHERE 
             
                (DATE( station.reglement.date_reglement) <= '$date_initiale' )
    Group By
        Date(station.reglement.date_reglement),
        station.client.nom_client,
        station.nom_station
        
          
     
     ";  
        /********************************************************************************************************************* */
   
   
       $res_reglement_init = mysqli_query($conn, $query_reglement_init );
   
       $data_reglement_init = array();
   
       if (is_object($res_reglement_init)) {
   
          while($rows = mysqli_fetch_array($res_reglement_init))
   
         {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->client = $rows['client'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = intval($rows['montant']) ;
   
                       $data_reglement_init[] = $obj ;
   
              }
          
          }

       }

       $res_reglement = mysqli_query($conn, $query_reglement );
   
       $data_reglement = array();
   
       if (is_object($res_reglement)) {
   
          while($rows = mysqli_fetch_array($res_reglement))
   
         {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->client = $rows['client'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = intval($rows['montant']) ;
   
                       $data_reglement[] = $obj ;
   
             }
          
         }
       }

   
        $datas = array() ;
   
   
        foreach ($clients as $key => $value) {

          if ($value['nom_station'] == $station) {
               

               $data = new stdClass();

             $client =  $value['nom_client'] ;

             $montant = 0 ;
             $reglement = 0 ;

             $solde_initial = $value['solde_initial'] ;
             
             $data->code_client = $value['code_client'] ;
             $data->client = $value['nom_client'] ;
             $data->solde_anterieur = 0 ;
             $data->conso = 0 ;
             $data->montant = 0 ;
             $data->reglement = 0 ;
             $data->station = '' ;
             $data->solde = 0 ;

            
             foreach ($data_client as $key5 => $value5) {
   
                  
                  if ($value5->station == $station && $value5->client == $client) {
   
                    $data->conso += $value5->quantite ;
                    $data->montant += $value5->montant ;
                    $data->station = $value5->station ;
                      
                  }
             }

             foreach ($data_client_init as $key6 => $value6) {
                  
               if ($value6->station == $station && $value6->client == $client) {

                 $montant += $value6->montant ;
                   
               }
             }
   
             foreach ($data_reglement as $key8 => $value8) {
   
                  
                  if ($value8->station == $station && $value8->client == $client) {
   
                       $data->reglement += $value8->montant ;
                       $data->station = $value8->station ;
   
                  }
             }

             foreach ($data_reglement_init as $key9 => $value9) {
   
               if ($value9->station == $station && $value9->client == $client) {

                    $reglement += $value9->montant ;

               }
             }

             $data->solde_anterieur = $solde_initial + $montant - $reglement ;
             $data->solde =  $data->solde_anterieur + $data->montant - $data->reglement ;

             if (! ($data->montant == 0 && $data->reglement == 0)) {
                  
                 $datas[] = $data ;
             }

             


          }
   
        }

   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
       
}

function Etats_Coulages() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->coulages;
   
       $date_debut = $date_fin =  '' ;
       
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $station = $requete->station ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
       
        $dates = [] ;
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);

        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }

     /****************************************************************************************************************************** */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise))* produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.nom_station As station
     
     From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And pompiste_pistolet.id_cuve = pistolet.id_cuve
               And pompiste_pistolet.id_station = pistolet.id_station
               And pompiste_pistolet.id_region = pistolet.id_region
               And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
               And produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region

     WHERE 
     
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.nom_station
     
     
     ";  
     /********************************************************************************************************************* */

     $query_vte_lub = "

     SELECT
     DATE(station.quart.date_ouverture)AS date,
     SUM(produit_quart.qte_vendu) AS quantite,
     SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
     produit.nom_produit AS produit,
     station.nom_station AS station
     FROM
     produit_quart
     INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
     WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     GROUP BY
     
     DATE(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station

    
    " ;

 /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station AS station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
     

     " ;


     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    

     $query_stock_ouverture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '07:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     $query_stock_fermerture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '17:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     
 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {
          if ($rows['station'] == $station) {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;
                    $obj->montant = intval($rows['montant']) ;

                    $data_vte_carb[] = $obj ;

          }
       
      }
    }

 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;
               }
          
          }


    }

 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_carb[] = $obj ;

                    
               }
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    
               }
          
          }


    }

     /******************************************************************************************************* */  

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;
 
                     
                }
           
           }
 
     }

     /******************************************************************************************************* */   

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /******************************************************************************************************** */

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;
 
                     
                }
           
           }
 
 
     }
   /******************************************************************************************************************** */

   $data_total = new stdClass();

   $data_total->date = 'TOTAL' ;

   $data_total->cou_gasoil_l = 0 ;
   $data_total->cou_super_l = 0 ;
   $data_total->cou_petrole_l = 0 ;
   $data_total->cou_lubrifiant_l = 0 ;
   
   $data_total->cou_gasoil_m = 0 ;
   $data_total->cou_super_m = 0 ;
   $data_total->cou_petrole_m = 0 ;
   $data_total->cou_lubrifiant_m = 0 ;


     $datas = array() ;

     foreach ($dates as $key => $value) {


          $data = new stdClass();
          $date = $value ;

          $data->date = $value ;

          $data->si_gasoil_l = 0 ;
          $data->si_super_l = 0 ;
          $data->si_petrole_l = 0 ;
          $data->si_lubrifiant_l = 0 ;

          $data->si_gasoil_m = 0 ;
          $data->si_super_m = 0 ;
          $data->si_petrole_m = 0 ;
          $data->si_lubrifiant_m = 0 ;

          $data->liv_gasoil_l = 0 ;
          $data->liv_super_l = 0 ;
          $data->liv_petrole_l = 0 ;
          $data->liv_lubrifiant_l = 0 ;
          
          $data->liv_gasoil_m = 0 ;
          $data->liv_super_m = 0 ;
          $data->liv_petrole_m = 0 ;
          $data->liv_lubrifiant_m = 0 ;

          $data->vte_gasoil_l = 0 ;
          $data->vte_super_l = 0 ;
          $data->vte_petrole_l = 0 ;
          $data->vte_lubrifiant_l = 0 ;
          
          $data->vte_gasoil_m = 0 ;
          $data->vte_super_m = 0 ;
          $data->vte_petrole_m = 0 ;
          $data->vte_lubrifiant_m = 0 ;

          $data->st_gasoil_l = 0 ;
          $data->st_super_l = 0 ;
          $data->st_petrole_l = 0 ;
          $data->st_lubrifiant_l = 0 ;
          
          $data->st_gasoil_m = 0 ;
          $data->st_super_m = 0 ;
          $data->st_petrole_m = 0 ;
          $data->st_lubrifiant_m = 0 ;

          $data->sf_gasoil_l = 0 ;
          $data->sf_super_l = 0 ;
          $data->sf_petrole_l = 0 ;
          $data->sf_lubrifiant_l = 0 ;
          
          $data->sf_gasoil_m = 0 ;
          $data->sf_super_m = 0 ;
          $data->sf_petrole_m = 0 ;
          $data->sf_lubrifiant_m = 0 ;

          $data->cou_gasoil_l = 0 ;
          $data->cou_super_l = 0 ;
          $data->cou_petrole_l = 0 ;
          $data->cou_lubrifiant_l = 0 ;
          
          $data->cou_gasoil_m = 0 ;
          $data->cou_super_m = 0 ;
          $data->cou_petrole_m = 0 ;
          $data->cou_lubrifiant_m = 0 ;
          

          
          foreach ($data_stock_ouverture_carb as $key1 => $value1) {

               if ($value1->date == $date && $value1->station == $station) {

                    if ($value1->produit == 'SUPER') {

                         
                         $data->si_super_l = $value1->quantite ;
                         $data->si_super_m = $value1->montant ;

                    
                    } elseif ($value1->produit == 'GASOIL') {

                         $data->si_gasoil_l = $value1->quantite ;
                         $data->si_gasoil_m = $value1->montant ;

                    } else {

                         $data->si_petrole_l = $value1->quantite ;
                         $data->si_petrole_m = $value1->montant ;


                    }
               
                    
               }
          }

          foreach ($data_stock_ouverture_lub as $key2 => $value2) {

          if ($value2->date == $date && $value2->station == $station) {

               $data->si_lubrifiant_l += $value2->quantite ;
               $data->si_lubrifiant_m += $value2->montant ;

          }
          }

          foreach ($data_livr_carb as $key3 => $value3) {

          if ($value3->date == $date && $value3->station == $station) {

                    if ($value3->produit == 'SUPER') {

                    
                         $data->liv_super_l = $value3->quantite ;
                         $data->liv_super_m = $value3->montant ;

                    
                    } elseif ($value3->produit == 'GASOIL') {

                         $data->liv_gasoil_l = $value3->quantite ;
                         $data->liv_gasoil_m = $value3->montant ;

                    } else {

                         $data->liv_petrole_l = $value3->quantite ;
                         $data->liv_petrole_m = $value3->montant ;


                    }
               
               
          }
          }

          foreach ($data_livr_lub as $key4 => $value4) {

          if ($value4->date == $date && $value4->station == $station) {

               $data->liv_lubrifiant_l += $value4->quantite ;
               $data->liv_lubrifiant_m += $value4->montant ;

          }
          }

          foreach ($data_vte_carb as $key5 => $value5) {

          if ($value5->date == $date && $value5->station == $station) {

                    if ($value5->produit == 'SUPER') {

                    
                         $data->vte_super_l = $value5->quantite ;
                         $data->vte_super_m = $value5->montant ;

                    
                    } elseif ($value5->produit == 'GASOIL') {

                         $data->vte_gasoil_l = $value5->quantite ;
                         $data->vte_gasoil_m = $value5->montant ;

                    } else {

                         $data->vte_petrole_l = $value5->quantite ;
                         $data->vte_petrole_m = $value5->montant ;


                    }
               
               
          }
          }  

          foreach ($data_vte_lub as $key6 => $value6) {

          if ($value6->date == $date && $value6->station == $station) {

               $data->vte_lubrifiant_l += $value6->quantite ;
               $data->vte_lubrifiant_m += $value6->montant ;

          }
          }

          foreach ($data_stock_fermerture_carb as $key7 => $value7) {

          if ($value7->date == $date && $value7->station == $station) {

                    if ($value7->produit == 'SUPER') {

                    
                         $data->sf_super_l = $value7->quantite ;
                         $data->sf_super_m = $value7->montant ;

                    
                    } elseif ($value7->produit == 'GASOIL') {

                         $data->sf_gasoil_l = $value7->quantite ;
                         $data->sf_gasoil_m = $value7->montant ;

                    } else {

                         $data->sf_petrole_l = $value7->quantite ;
                         $data->sf_petrole_m = $value7->montant ;


                    }
               
               
          }
          }

          foreach ($data_stock_fermerture_lub as $key8 => $value8) {

          if ($value8->date == $date && $value8->station == $station) {

               $data->sf_lubrifiant_l += $value8->quantite ;
               $data->sf_lubrifiant_m += $value8->montant ;

          }
          }


          $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
          $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
          $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
          $data->st_lubrifiant_l = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;
          
          $data->st_gasoil_m = $data->si_gasoil_m + $data->liv_gasoil_m - $data->vte_gasoil_m ;
          $data->st_super_m = $data->si_super_m + $data->liv_super_m - $data->vte_super_m ;
          $data->st_petrole_m = $data->si_petrole_m + $data->liv_petrole_m - $data->vte_petrole_m ;
          $data->st_lubrifiant_m = $data->si_lubrifiant_m + $data->liv_lubrifiant_m - $data->vte_lubrifiant_m ;

          $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
          $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
          $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
          $data->cou_lubrifiant_l = $data->sf_lubrifiant_l - $data->st_lubrifiant_l ;
          
          $data->cou_gasoil_m = $data->sf_gasoil_m - $data->st_gasoil_m ;
          $data->cou_super_m = $data->sf_super_m - $data->st_super_m ;
          $data->cou_petrole_m = $data->sf_petrole_m - $data->st_petrole_m ;
          $data->cou_lubrifiant_m = $data->sf_lubrifiant_m - $data->st_lubrifiant_m ;

          /********************************************TOTAL COULAGES********************************************************* */

          $data_total->cou_gasoil_l += ($data->sf_gasoil_l - $data->st_gasoil_l);
          $data_total->cou_super_l += ($data->sf_super_l - $data->st_super_l) ;
          $data_total->cou_petrole_l += ($data->sf_petrole_l - $data->st_petrole_l) ;
          $data_total->cou_lubrifiant_l += ($data->sf_lubrifiant_l - $data->st_lubrifiant_l) ;
          
          $data_total->cou_gasoil_m += ($data->sf_gasoil_m - $data->st_gasoil_m) ;
          $data_total->cou_super_m += ($data->sf_super_m - $data->st_super_m );
          $data_total->cou_petrole_m += ($data->sf_petrole_m - $data->st_petrole_m );
          $data_total->cou_lubrifiant_m += ($data->sf_lubrifiant_m - $data->st_lubrifiant_m) ;
          

          $datas[] = $data ;
          
     }

     $datas[] = $data_total ;

   
       print_r(json_encode($datas));
       return json_encode($datas);  


       
}

function Etats_Versements() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->versement;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
        $stations = [] ;
        $nom_banque = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     versement_banque.nom_banque,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station,
     versement_banque.nom_banque

     ORDER BY versement_banque.nom_banque
   
     " ;

     $query_vers_banque = " 
        
        SELECT

     versement_banque.nom_banque,
     DATE (quart.date_ouverture) AS date,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     versement_banque.nom_banque

     ORDER BY versement_banque.nom_banque
   
     " ;

     /************************************************************************************ */
    
     $datas2 = array() ;

     $obj2 = array();

     $obj2[] = 'date' ;
     $obj2[] = 'montant' ;
     $obj2[] = 'station' ;
     $obj2[] = 'nom_banque' ;

     $datas2[] = $obj2 ;

    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {

   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
              
               $obj = new stdClass();
               $obj2 = array();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
                       $obj->nom_banque = $rows['nom_banque'] ;

                       $obj2[] = $rows['date'] ;
                       $obj2[] = floatval($rows['montant']) ;
                       $obj2[] = $rows['station'] ;
                       $obj2[] = $rows['nom_banque'] ;
   
                       $data_vers[] = $obj ;
                       $datas2[] = $obj2 ;


                       $stations[] = $obj->station ;
                       $nom_banque[] = $rows['nom_banque'] ;
             
             }
   
       }
   
    /******************************************************************************************************* */  

    $res_vers_banque = mysqli_query($conn, $query_vers_banque );
   
    $data_vers_banque = array() ;

    if (is_object($res_vers_banque)) {


          while($rows = mysqli_fetch_array($res_vers_banque))

          {
           
                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->nom_banque = $rows['nom_banque'] ;

                    $data_vers_banque[] = $obj ;
          }

    }

 /******************************************************************************************************* */  

    // var_dump($data_vers) ;
    // var_dump($data_vers_banque) ;

    $datas = array() ;
    

    $data2[] = 

    $data_vers2 = array() ;

    $stations_unique = array_unique($stations);
    $nom_banque_unique = array_unique($nom_banque);


     // declaration variables BANQUE

      foreach($nom_banque_unique as $key => $value) {

          $banque = $value ;
           
          ${'data_'.$value} = [] ;

        
      }

     // classification par Banque

      foreach ($nom_banque as $key => $value) {

          $nom_banque = $value ;
           
          foreach ($data_vers as $key2 => $value2) {

               if ($value2->nom_banque == $nom_banque) {
                    
                    ${'data_'.$value}[] = $value2->station ;  // repartition station par banque
               }

          }

         
      }

      // array unique BANQUE STATION

      foreach($nom_banque_unique as $key => $value) {
           
          ${'data_unique'.$value} = array_unique(${'data_'.$value} ) ; // nettoyage doublons stations

      }

     
      // traitement 2

      foreach($nom_banque_unique as $key => $value) {

          foreach (${'data_unique'.$value} as $key2 => $value2) {

               $nom_station = $value2 ;

               $data = new stdClass() ;

               $data->station = '' ;
               $data->versement = [] ;
               $data->total = 0 ;

               foreach ($dates as $key3 => $value3) {

                    foreach ( $data_vers as $key4 => $value4) {


                         if ($value4->station == $value2 && $value4->nom_banque == $value && $value4->date == $value3 ) {
                         
                              $data->station = $value2 ;
                              $data->versement[] = $value4->montant;
                              $data->total += $value4->montant ;

                         }
                         
                    }

               }
                    
               $datas[] = $data ;
              // $datas2[] = $data ;

               /************************** */
          }

               /************************** */

               $data_total = new stdClass() ;

               $data_total->station = '' ;
               $data_total->versement = [] ;
               $data_total->total = 0 ;
               
               foreach ($dates as $key30 => $value30) {

                    foreach ( $data_vers_banque as $key40 => $value40) {


                         if ($value40->nom_banque == $value && $value40->date == $value30 ) {
                         
                              $data_total->station = 'TOTAL '.$value ;
                              $data_total->versement[] = $value40->montant;
                              $data_total->total += $value40->montant ;

                         }
                         
                    }

               }
                    
               $datas[] = $data_total ;

      }

      //      TRAITEMENT EXPORT

          $fp = fopen("data_versement_gerant.csv", "w");
         // fwrite($fp, json_encode($data2));

          foreach ($datas2 as $fields) {

               fputcsv($fp, $fields);
          }

          fclose($fp);

       
        $username = 'user';
        $password = 'bitnami';

    /*  
        $host = 'http://192.168.1.162:8081/jasperserver/rest_v2/reports/Etat_Versement_Gerant' ;
        $ch = curl_init($host);
        
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($ch, CURLOPT_TIMEOUT, 90);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

 
      if(curl_exec($ch) === false)
      {
          echo 'Curl error: ' . curl_error($ch);
      }  

      $errors = curl_error($ch);                                                                                                            
      $result = curl_exec($ch);
     
      echo $result ;

      */

       print_r(json_encode($datas)) ;
       return json_encode($datas) ;  
       
     
}

function Etats_Versements_ME() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->versement;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   
       
        $dates = [] ;
        $stations = [] ;
        $nom_banque = [] ;
   
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);
   
        $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
   
        $query_vers = " 
        
        Select
        DATE(station.quart.date_ouverture) AS date,
        station.client.nom_client AS nom_banque,
        Sum(station.pompiste_has_client.montant) As montant,
        station.nom_station AS station
    From
        pompiste_has_client Inner Join
        client On pompiste_has_client.client_id_client = client.id_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.client.id_station = station.id_station
                And station.client.id_region = station.id_region
                And station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
    Where

    (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
    (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
    
      ( station.client.nom_client = 'ORANGE MONEY' OR 
        station.client.nom_client = 'MTN MOBILLE MONEY' OR
        station.client.nom_client = 'YUP' )
        
    Group By
        DATE(station.quart.date_ouverture),
        station.client.nom_client,
        station.nom_station

     ORDER BY station.client.nom_client
   
     " ;

     $query_vers_banque = " 

     Select
        DATE(station.quart.date_ouverture) AS date,
        station.client.nom_client AS nom_banque,
        Sum(station.pompiste_has_client.montant) As montant
        
    From
        pompiste_has_client Inner Join
        client On pompiste_has_client.client_id_client = client.id_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.client.id_station = station.id_station
                And station.client.id_region = station.id_region
                And station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
    Where

    (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
    (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
    
      ( station.client.nom_client = 'ORANGE MONEY' OR 
        station.client.nom_client = 'MTN MOBILLE MONEY' OR
        station.client.nom_client = 'YUP' )
        
    Group By

        DATE(station.quart.date_ouverture),
        station.client.nom_client
        

     ORDER BY station.client.nom_client
        
   
     " ;

     /************************************************************************************ */
    
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {

   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
              
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
                       $obj->nom_banque = $rows['nom_banque'] ;
   
                       $data_vers[] = $obj ;


                       $stations[] = $obj->station ;
                       $nom_banque[] = $rows['nom_banque'] ;
             
             }
   
       }
   
    /******************************************************************************************************* */  

    $res_vers_banque = mysqli_query($conn, $query_vers_banque );
   
    $data_vers_banque = array() ;

    if (is_object($res_vers_banque)) {


          while($rows = mysqli_fetch_array($res_vers_banque))

          {
           
                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->nom_banque = $rows['nom_banque'] ;

                    $data_vers_banque[] = $obj ;
          }

    }

 /******************************************************************************************************* */  

    // var_dump($data_vers) ;
    // var_dump($data_vers_banque) ;

    $datas = array() ;

    $data_vers2 = array() ;

    $stations_unique = array_unique($stations);
    $nom_banque_unique = array_unique($nom_banque);


     // declaration variables BANQUE

      foreach($nom_banque_unique as $key => $value) {

          $banque = $value ;
           
          ${'data_'.$value} = [] ;

        
      }

     // classification par Banque

      foreach ($nom_banque as $key => $value) {

          $nom_banque = $value ;
           
          foreach ($data_vers as $key2 => $value2) {

               if ($value2->nom_banque == $nom_banque) {
                    
                    ${'data_'.$value}[] = $value2->station ;  // repartition station par banque
               }

          }

         
      }

      // array unique BANQUE STATION

      foreach($nom_banque_unique as $key => $value) {
           
          ${'data_unique'.$value} = array_unique(${'data_'.$value} ) ; // nettoyage doublons stations

      }

     
      // traitement 2

      foreach($nom_banque_unique as $key => $value) {

          foreach (${'data_unique'.$value} as $key2 => $value2) {

               $nom_station = $value2 ;

               $data = new stdClass() ;

               $data->station = '' ;
               $data->versement = [] ;
               $data->total = 0 ;

               foreach ($dates as $key3 => $value3) {

                    foreach ( $data_vers as $key4 => $value4) {


                         if ($value4->station == $value2 && $value4->nom_banque == $value && $value4->date == $value3 ) {
                         
                              $data->station = $value2 ;
                              $data->versement[] = $value4->montant;
                              $data->total += $value4->montant ;

                         }
                         
                    }

               }
                    
               $datas[] = $data ;

               /************************** */
          }

               /************************** */

               $data_total = new stdClass() ;

               $data_total->station = '' ;
               $data_total->versement = [] ;
               $data_total->total = 0 ;
               
               foreach ($dates as $key30 => $value30) {

                    foreach ( $data_vers_banque as $key40 => $value40) {


                         if ($value40->nom_banque == $value && $value40->date == $value30 ) {
                         
                              $data_total->station = 'TOTAL '.$value ;
                              $data_total->versement[] = $value40->montant;
                              $data_total->total += $value40->montant ;

                         }
                         
                    }

               }
                    
               $datas[] = $data_total ;

      }

       print_r(json_encode($datas)) ;
       return json_encode($datas) ;  
       
     
}

function Etats_Coulages_Station() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
      
       $requete = $data->coulages;
   
      
        $station = $requete ;

        $stations = [] ;
        $produits = ['GASOIL', 'SUPER', 'PETROLE'] ;

        $stations [] = $station ;
        // $stations [] = 'TOTAL' ;


      //  $date_debut2 = date('Y-m-d', strtotime(time()));
      //  $date_fin2 = date('Y-m-d', strtotime(time()));
       
        $date_debut = date_create();
        $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
        $date_debut2 = date_format($date_debut, 'Y-m-d') ;
      //  $date_debut2 = date('Y-m-d', strtotime($date_debut2)) ;

        $date_fin2 = $date_debut2 ;

       
   
        

     /****************************************************************************************************************************** */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
     produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.nom_station As station,
     region.nom_region AS region
  From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
             And pompiste_pistolet.id_cuve = pistolet.id_cuve
             And pompiste_pistolet.id_station = pistolet.id_station
             And pompiste_pistolet.id_region = pistolet.id_region
             And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
             And pistolet.id_station = cuves.id_station
             And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
             And produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     region On station.id_region = region.id_region
 
     WHERE 
         
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 
      Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.nom_station,
     region.nom_region
     
     ";  
     /********************************************************************************************************************* */

     $query_vte_lub = "

     SELECT
     DATE(station.quart.date_ouverture)AS date,
     SUM(produit_quart.qte_vendu) AS quantite,
     SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
     produit.nom_produit AS produit,
     station.nom_station AS station
     FROM
     produit_quart
     INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
     WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     GROUP BY
     
     DATE(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station

    
    " ;

 /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station AS station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
     

     " ;


     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    

     $query_stock_ouverture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '07:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     $query_stock_fermerture_carb = " 

          Select

     station.quart.date_ouverture As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     station.quart.date_ouverture,
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     
 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {
          if ($rows['station'] == $station) {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;
                    $obj->region = $rows['region'] ;
                    $obj->montant = intval($rows['montant']) ;

                    $data_vte_carb[] = $obj ;

          }
       
      }
    }

 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;
               }
          
          }


    }

 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_carb[] = $obj ;

                    
               }
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    
               }
          
          }


    }

     /******************************************************************************************************* */  

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;
 
                     
                }
           
           }
 
     }

     /******************************************************************************************************* */   

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /******************************************************************************************************** */

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;
 
                     
                }
           
           }
 
 
     }
   /******************************************************************************************************************** */

   $data_total_gasoil = new stdClass();
   $data_total_super = new stdClass();
   $data_total_petrole = new stdClass();

     $data_total_gasoil->station = 'TOTAL GASOIL' ;
     $data_total_gasoil->produit = '' ;
     $data_total_gasoil->si = 0 ;
     $data_total_gasoil->liv = 0 ;
     $data_total_gasoil->vte = 0 ;
     $data_total_gasoil->st = 0 ;
     $data_total_gasoil->sf = 0 ;
     $data_total_gasoil->freinte = 0 ;
     $data_total_gasoil->cou = 0 ;
     $data_total_gasoil->appreciation = '' ;

     $data_total_super->station = 'TOTAL SUPER' ;
     $data_total_super->produit = '' ;
     $data_total_super->si = 0 ;
     $data_total_super->liv = 0 ;
     $data_total_super->vte = 0 ;
     $data_total_super->st = 0 ;
     $data_total_super->sf = 0 ;
     $data_total_super->freinte = 0 ;
     $data_total_super->cou = 0 ;
     $data_total_super->appreciation = '' ;

     $data_total_petrole->station = 'TOTAL PETROLE' ;
     $data_total_petrole->produit = '' ;
     $data_total_petrole->si = 0 ;
     $data_total_petrole->liv = 0 ;
     $data_total_petrole->vte = 0 ;
     $data_total_petrole->st = 0 ;
     $data_total_petrole->sf = 0 ;
     $data_total_petrole->freinte = 0 ;
     $data_total_petrole->cou = 0 ;
     $data_total_petrole->appreciation = '' ;
     
   
   

        $datas = array() ;

             foreach ($stations as $key => $value) {
                  
                    foreach ($produits as $key10 => $value10) {

                         $data = new stdClass();

                         $data->station = $value ;
                         $data->region = '' ;
                         $data->produit = $value10 ;

                         $data->si_gasoil_l = 0 ;
                         $data->si_super_l = 0 ;
                         $data->si_petrole_l = 0 ;
                         $data->si_lubrifiant_l = 0 ;

                         
                         $data->liv_gasoil_l = 0 ;
                         $data->liv_super_l = 0 ;
                         $data->liv_petrole_l = 0 ;
                         $data->liv_lubrifiant_l = 0 ;
                         
                        

                         $data->vte_gasoil_l = 0 ;
                         $data->vte_super_l = 0 ;
                         $data->vte_petrole_l = 0 ;
                         $data->vte_lubrifiant_l = 0 ;
                         
                         
                         $data->st_gasoil_l = 0 ;
                         $data->st_super_l = 0 ;
                         $data->st_petrole_l = 0 ;
                         $data->st_lubrifiant_l = 0 ;
                         
                         

                         $data->sf_gasoil_l = 0 ;
                         $data->sf_super_l = 0 ;
                         $data->sf_petrole_l = 0 ;
                         $data->sf_lubrifiant_l = 0 ;
                         
                         

                         $data->cou_gasoil_l = 0 ;
                         $data->cou_super_l = 0 ;
                         $data->cou_petrole_l = 0 ;
                         $data->cou_lubrifiant_l = 0 ;
                         

                         $data->si = 0 ;
                         $data->liv = 0 ;
                         $data->vte = 0 ;
                         $data->st = 0 ;
                         $data->sf = 0 ;
                         $data->freinte = 0 ;
                         $data->appreciation = '' ;
                         

                         
                         foreach ($data_stock_ouverture_carb as $key1 => $value1) {
               
                              if ( $value1->station == $station) {
               
                                        if ($value1->produit == 'SUPER') {

                                        
                                             $data->si_super_l = $value1->quantite ;

                                        
                                        } elseif ($value1->produit == 'GASOIL') {

                                             $data->si_gasoil_l = $value1->quantite ;

                                        } else {

                                             $data->si_petrole_l = $value1->quantite ;


                                        }
                                   
                                   
                              }
                         }

                         foreach ($data_stock_ouverture_lub as $key2 => $value2) {
               
                              if ( $value2->station == $station) {

                                   $data->si_lubrifiant_l += $value2->quantite ;

                              }
                         }

                         foreach ($data_livr_carb as $key3 => $value3) {
               
                              if ( $value3->station == $station) {

                                   if ($value3->produit == 'SUPER') {

                                        
                                        $data->liv_super_l = $value3->quantite ;

                                   
                                   } elseif ($value3->produit == 'GASOIL') {

                                        $data->liv_gasoil_l = $value3->quantite ;

                                   } else {

                                        $data->liv_petrole_l = $value3->quantite ;


                                   }
                              
                              
                              }
                         }

                         foreach ($data_livr_lub as $key4 => $value4) {
               
                              if ($value4->station == $station) {

                                   $data->liv_lubrifiant_l += $value4->quantite ;

                              }
                         }

                         foreach ($data_vte_carb as $key5 => $value5) {
               
                              if ($value5->station == $station) {

                                   $data->region = $value5->region ;

                                   if ($value5->produit == 'SUPER') {

                                        
                                        $data->vte_super_l = $value5->quantite ;

                                   
                                   } elseif ($value5->produit == 'GASOIL') {

                                        $data->vte_gasoil_l = $value5->quantite ;

                                   } else {

                                        $data->vte_petrole_l = $value5->quantite ;


                                   }
                              
                              
                              }
                         }  

                         foreach ($data_vte_lub as $key6 => $value6) {
               
                              if ($value6->station == $station) {

                                   $data->vte_lubrifiant_l += $value6->quantite ;

                              }
                         }

                         foreach ($data_stock_fermerture_carb as $key7 => $value7) {
               
                              if ($value7->station == $station) {

                                   if ($value7->produit == 'SUPER') {

                                        
                                        $data->sf_super_l = $value7->quantite ;

                                   
                                   } elseif ($value7->produit == 'GASOIL') {

                                        $data->sf_gasoil_l = $value7->quantite ;

                                   } else {

                                        $data->sf_petrole_l = $value7->quantite ;


                                   }
                              
                              
                              }
                         }

                         foreach ($data_stock_fermerture_lub as $key8 => $value8) {
               
                              if ($value8->station == $station) {

                                   $data->sf_lubrifiant_l += $value8->quantite ;

                              }
                         }


                         $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
                         $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
                         $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
                         $data->st_lubrifiant_l = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;
                         

                         $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
                         $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
                         $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
                         $data->cou_lubrifiant_l = $data->sf_lubrifiant_l - $data->st_lubrifiant_l ;
                         

                         if ($value10 == 'GASOIL') {

                              $data->si =  $data->si_gasoil_l ;
                              $data->liv = $data->liv_gasoil_l ;
                              $data->vte = $data->vte_gasoil_l ;
                              $data->st = $data->st_gasoil_l ;
                              $data->sf = $data->sf_gasoil_l ;
                              $data->cou = $data->cou_gasoil_l ;
                              $data->freinte = $data->vte_gasoil_l * -0.003 ;
                              $data->appreciation = '' ;

                              if ($data->freinte < 1 ) {

                                   $data->appreciation ="BON" ;
                           
                                 }else if( $data->freinte == 1){
                           
                                   $data->appreciation = "ACCEPTABLE" ;
                           
                                 }else if ($data->freinte > 1 ) {
                           
                                   $data->appreciation = "MAUVAIS" ;
                           
                                 }else{
                           
                                   $data->appreciation = '' ;
                                 }

                              
                              }

                         if ($value10 == 'SUPER') {

                              $data->si = $data->si_super_l ;
                              $data->liv = $data->liv_super_l ;
                              $data->vte = $data->vte_super_l ;
                              $data->st = $data->st_super_l ;
                              $data->sf = $data->sf_super_l ;
                              $data->cou = $data->cou_super_l ;
                              $data->freinte = $data->vte_super_l * -0.003  ;
                              $data->appreciation = '' ;

                              if ($data->freinte < 1 ) {

                                   $data->appreciation ="BON" ;
                           
                                 }else if( $data->freinte == 1){
                           
                                   $data->appreciation = "ACCEPTABLE" ;
                           
                                 }else if ($data->freinte > 1 ) {
                           
                                   $data->appreciation = "MAUVAIS" ;
                           
                                 }else{
                           
                                   $data->appreciation = '' ;
                              }


                              
                         }
                         if ($value10 == 'PETROLE') {

                              $data->si = $data->si_petrole_l ;
                              $data->liv = $data->liv_petrole_l ;
                              $data->vte = $data->vte_petrole_l ;
                              $data->st = $data->st_petrole_l;
                              $data->sf = $data->sf_petrole_l ;
                              $data->cou = $data->cou_petrole_l  ;
                              $data->freinte = $data->vte_petrole_l * -0.003  ;
                              $data->appreciation = '' ;

                              if ($data->freinte < 1 ) {

                                   $data->appreciation ="BON" ;
                           
                                 }else if( $data->freinte == 1){
                           
                                   $data->appreciation = "ACCEPTABLE" ;
                           
                                 }else if ($data->freinte > 1 ) {
                           
                                   $data->appreciation = "MAUVAIS" ;
                           
                                 }else{
                           
                                   $data->appreciation = '' ;
                              }

                             
                         }

                         /********************************************TOTAL COULAGES********************************************************* */

                         $datas[] = $data ;
                    }
             }

       print_r(json_encode($datas));
       return json_encode($datas);  

       
}

function Etats_Coulages_Station_Mensuel() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
      
       $requete = $data->coulages;
       $periode = $data->periode;
      
        $station = $requete ;

        $stations = [] ;
        $produits = ['GASOIL', 'SUPER', 'PETROLE'] ;

        $stations [] = $station ;


        //  $date_debut2 = date('Y-m-d', strtotime(time()));
        //  $date_fin2 = date('Y-m-d', strtotime(time()));
       
         // $date_debut = date_create('first day of previous month') ;
         // $date_fin = date_create('last day of previous month') ;

          $date_debut = date_create($periode->date_debut) ;
          $date_fin = date_create($periode->date_fin) ;

         // $date_fin = date_add($date_fin, date_interval_create_from_date_string('-1 days')) ;
          
         
          $date_debut2 = date_format($date_debut, 'Y-m-d') ;
          $date_fin2 = date_format($date_fin, 'Y-m-d') ;

        

     /****************************************************************************************************************************** */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise + 0.0)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise + 0.0)) *
     produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.nom_station As station,
     region.nom_region AS region,
     produit_station.prix_produit
  From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
             And pompiste_pistolet.id_cuve = pistolet.id_cuve
             And pompiste_pistolet.id_station = pistolet.id_station
             And pompiste_pistolet.id_region = pistolet.id_region
             And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
             And pistolet.id_station = cuves.id_station
             And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
             And produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     region On station.id_region = region.id_region
 
     WHERE 
         
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 
      Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.nom_station,
     region.nom_region,
     produit_station.prix_produit
     
     ";  
     /********************************************************************************************************************* */

    /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station AS station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
     

     " ;


     $query_stock_ouverture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '07:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_fermerture_carb = " 

          Select

     station.quart.date_ouverture As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     station.quart.date_ouverture,
     produit.nom_produit,
     station.nom_station

     ORDER BY 

     station.quart.date_fermerture

     " ;

 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {
          if ($rows['station'] == $station) {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;
                    $obj->region = $rows['region'] ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->prix_produit = intval($rows['prix_produit']) ;

                    $data_vte_carb[] = $obj ;

          }
       
      }
    }

 /****************************************************************************************************************** */
    
 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_carb[] = $obj ;

                    
               }
          
          }


    }

    /**************************************************************************************************************************** */
    
     /******************************************************************************************************* */  

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
 
                     
                }
           
           }
 
     }
       
     /********************************************************************************************************************* */
    
     /******************************************************************************************************* */   

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
 
                     
                }
           
           }
 
 
     }
       
     /******************************************************************************************************** */
    
   /******************************************************************************************************************** */

   $data_total_gasoil = new stdClass();
   $data_total_super = new stdClass();
   $data_total_petrole = new stdClass();

     $data_total_gasoil->station = 'TOTAL GASOIL' ;
     $data_total_gasoil->produit = '' ;
     $data_total_gasoil->si = 0 ;
     $data_total_gasoil->liv = 0 ;
     $data_total_gasoil->vte = 0 ;
     $data_total_gasoil->st = 0 ;
     $data_total_gasoil->sf = 0 ;
     $data_total_gasoil->freinte = 0 ;
     $data_total_gasoil->cou = 0 ;
     $data_total_gasoil->appreciation = '' ;
     $data_total_gasoil->si_m = 0 ;
     $data_total_gasoil->liv_m = 0 ;
     $data_total_gasoil->vte_m = 0 ;
     $data_total_gasoil->st_m = 0 ;
     $data_total_gasoil->sf_m = 0 ;
     $data_total_gasoil->freinte_m = 0 ;
     $data_total_gasoil->cou_m = 0 ;


     $data_total_super->station = 'TOTAL SUPER' ;
     $data_total_super->produit = '' ;
     $data_total_super->si = 0 ;
     $data_total_super->liv = 0 ;
     $data_total_super->vte = 0 ;
     $data_total_super->st = 0 ;
     $data_total_super->sf = 0 ;
     $data_total_super->freinte = 0 ;
     $data_total_super->cou = 0 ;
     $data_total_super->appreciation = '' ;
     $data_total_super->si_m = 0 ;
     $data_total_super->liv_m = 0 ;
     $data_total_super->vte_m = 0 ;
     $data_total_super->st_m = 0 ;
     $data_total_super->sf_m = 0 ;
     $data_total_super->freinte_m = 0 ;
     $data_total_super->cou_m = 0 ;

     $data_total_petrole->station = 'TOTAL PETROLE' ;
     $data_total_petrole->produit = '' ;
     $data_total_petrole->si = 0 ;
     $data_total_petrole->liv = 0 ;
     $data_total_petrole->vte = 0 ;
     $data_total_petrole->st = 0 ;
     $data_total_petrole->sf = 0 ;
     $data_total_petrole->freinte = 0 ;
     $data_total_petrole->cou = 0 ;
     $data_total_petrole->appreciation = '' ;
     $data_total_petrole->si_m = 0 ;
     $data_total_petrole->liv_m = 0 ;
     $data_total_petrole->vte_m = 0 ;
     $data_total_petrole->st_m = 0 ;
     $data_total_petrole->sf_m = 0 ;
     $data_total_petrole->freinte_m = 0 ;
     $data_total_petrole->cou_m = 0 ;
     

        $datas = array() ;

             foreach ($stations as $key => $value) {
                  
                    foreach ($produits as $key10 => $value10) {

                         $data = new stdClass();

                         $data->station = $value ;
                         $data->region = '' ;
                         $data->produit = $value10 ;

                         $data->si_gasoil_l = 0 ;
                         $data->si_super_l = 0 ;
                         $data->si_petrole_l = 0 ;
                         $data->si_lubrifiant_l = 0 ;
                         $data->si_gasoil_m = 0 ;
                         $data->si_super_m = 0 ;
                         $data->si_petrole_m = 0 ;

                         
                         $data->liv_gasoil_l = 0 ;
                         $data->liv_super_l = 0 ;
                         $data->liv_petrole_l = 0 ;
                         $data->liv_lubrifiant_l = 0 ;
                         $data->liv_gasoil_m = 0 ;
                         $data->liv_super_m = 0 ;
                         $data->liv_petrole_m = 0 ;
                         

                         $data->vte_gasoil_l = 0 ;
                         $data->vte_super_l = 0 ;
                         $data->vte_petrole_l = 0 ;
                         $data->vte_lubrifiant_l = 0 ;
                         $data->vte_gasoil_m = 0 ;
                         $data->vte_super_m = 0 ;
                         $data->vte_petrole_m = 0 ;
                         
                         
                         $data->st_gasoil_l = 0 ;
                         $data->st_super_l = 0 ;
                         $data->st_petrole_l = 0 ;
                         $data->st_lubrifiant_l = 0 ;
                         $data->st_gasoil_m = 0 ;
                         $data->st_super_m = 0 ;
                         $data->st_petrole_m = 0 ;
                         

                         $data->sf_gasoil_l = 0 ;
                         $data->sf_super_l = 0 ;
                         $data->sf_petrole_l = 0 ;
                         $data->sf_lubrifiant_l = 0 ;
                         $data->sf_gasoil_m = 0 ;
                         $data->sf_super_m = 0 ;
                         $data->sf_petrole_m = 0 ;
                         

                         $data->cou_gasoil_l = 0 ;
                         $data->cou_super_l = 0 ;
                         $data->cou_petrole_l = 0 ;
                         $data->cou_lubrifiant_l = 0 ;
                         $data->cou_gasoil_m = 0 ;
                         $data->cou_super_m = 0 ;
                         $data->cou_petrole_m = 0 ;

                         $data->prix_gasoil = 0 ;
                         $data->prix_super = 0 ;
                         $data->prix_petrole = 0 ;
                         

                         $data->si = 0 ;
                         $data->liv = 0 ;
                         $data->vte = 0 ;
                         $data->st = 0 ;
                         $data->sf = 0 ;
                         $data->freinte = 0 ;
                         $data->appreciation = '' ;
                         $data->si_m = 0 ;
                         $data->liv_m = 0 ;
                         $data->vte_m = 0 ;
                         $data->st_m = 0 ;
                         $data->sf_m = 0 ;
                         $data->freinte_m = 0 ;
                         
                         // Stock Ouverture
                        // $nbre = count($data_stock_ouverture_carb) ;

                        array_splice($data_stock_ouverture_carb, 3) ;
                         
                         foreach ($data_stock_ouverture_carb as $key1 => $value1) {
               
                              if ( $value1->station == $station) {
               
                                        if ($value1->produit == 'SUPER') {

                                        
                                             $data->si_super_l = $value1->quantite ;
                                             $data->si_super_m = $value1->montant ;


                                        
                                        } elseif ($value1->produit == 'GASOIL') {

                                             $data->si_gasoil_l = $value1->quantite ;
                                             $data->si_gasoil_m = $value1->montant ;


                                        } else {

                                             $data->si_petrole_l = $value1->quantite ;
                                             $data->si_petrole_m = $value1->montant ;



                                        }
                                   
                                   
                              }
                         }

                       /*  foreach ($data_stock_ouverture_lub as $key2 => $value2) {
               
                              if ( $value2->station == $station) {

                                   $data->si_lubrifiant_l += $value2->quantite ;

                              }
                         }

                         */

                         foreach ($data_livr_carb as $key3 => $value3) {
               
                              if ( $value3->station == $station) {

                                   if ($value3->produit == 'SUPER') {

                                        
                                        $data->liv_super_l += $value3->quantite ;
                                        $data->liv_super_m += $value3->montant ;

                                   
                                   } elseif ($value3->produit == 'GASOIL') {

                                        $data->liv_gasoil_l += $value3->quantite ;
                                        $data->liv_gasoil_m += $value3->montant ;

                                   } else {

                                        $data->liv_petrole_l += $value3->quantite ;
                                        $data->liv_petrole_m += $value3->montant ;


                                   }
                              
                              
                              }
                         }

                         /*
                         foreach ($data_livr_lub as $key4 => $value4) {
               
                              if ($value4->station == $station) {

                                   $data->liv_lubrifiant_l += $value4->quantite ;

                              }
                         }
                         */

                         foreach ($data_vte_carb as $key5 => $value5) {
               
                              if ($value5->station == $station) {

                                   $data->region = $value5->region ;

                                   if ($value5->produit == 'SUPER') {

                                        
                                        $data->vte_super_l += $value5->quantite ;
                                        $data->vte_super_m += $value5->montant ;

                                        $data->prix_super = $value5->prix_produit ;


                                   
                                   } elseif ($value5->produit == 'GASOIL') {

                                        $data->vte_gasoil_l += $value5->quantite ;
                                        $data->vte_gasoil_m += $value5->montant ;

                                        $data->prix_gasoil = $value5->prix_produit ;


                                   } else {

                                        $data->vte_petrole_l += $value5->quantite ;
                                        $data->vte_petrole_m += $value5->montant ;

                                        $data->prix_petrole = $value5->prix_produit ;



                                   }
                              
                              
                              }
                         }  

                         /*
                         foreach ($data_vte_lub as $key6 => $value6) {
               
                              if ($value6->station == $station) {

                                   $data->vte_lubrifiant_l += $value6->quantite ;

                              }
                         }*/


                         foreach ($data_stock_fermerture_carb as $key7 => $value7) {
               
                              if ($value7->station == $station) {

                                   if ($value7->produit == 'SUPER') {

                                        
                                        $data->sf_super_l = $value7->quantite ;
                                        $data->sf_super_m = $value7->montant ;

                                   
                                   } elseif ($value7->produit == 'GASOIL') {

                                        $data->sf_gasoil_l = $value7->quantite ;
                                        $data->sf_gasoil_m = $value7->montant ;

                                   } else {

                                        $data->sf_petrole_l = $value7->quantite ;
                                        $data->sf_petrole_m = $value7->montant ;


                                   }
                              
                              
                              }
                         }
                         /*
                         foreach ($data_stock_fermerture_lub as $key8 => $value8) {
               
                              if ($value8->station == $station) {

                                   $data->sf_lubrifiant_l += $value8->quantite ;

                              }
                         }
                         */

                         $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
                         $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
                         $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
                         $data->st_lubrifiant_l = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;
                         /********************************************************* */
                         $data->st_gasoil_m = $data->si_gasoil_m + $data->liv_gasoil_m - $data->vte_gasoil_m ;
                         $data->st_super_m = $data->si_super_m + $data->liv_super_m - $data->vte_super_m ;
                         $data->st_petrole_m = $data->si_petrole_m + $data->liv_petrole_m - $data->vte_petrole_m ;
                        // $data->st_lubrifiant_m = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;

                         $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
                         $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
                         $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
                         $data->cou_lubrifiant_l = $data->sf_lubrifiant_l - $data->st_lubrifiant_l ;
                         /********************************************************** */
                         $data->cou_gasoil_m = $data->sf_gasoil_m - $data->st_gasoil_m;
                         $data->cou_super_m = $data->sf_super_m - $data->st_super_m ;
                         $data->cou_petrole_m = $data->sf_petrole_m - $data->st_petrole_m ;
                        // $data->cou_lubrifiant_m = $data->sf_lubrifiant_m - $data->st_lubrifiant_m ;

                         if ($value10 == 'GASOIL') {

                              $data->si =  $data->si_gasoil_l ;
                              $data->liv = $data->liv_gasoil_l ;
                              $data->vte = $data->vte_gasoil_l ;
                              $data->st = $data->st_gasoil_l ;
                              $data->sf = $data->sf_gasoil_l ;
                              $data->cou = $data->cou_gasoil_l ;
                              $data->freinte = $data->vte_gasoil_l * -0.003 ;
                              $data->appreciation = '' ;
                              $data->si_m =  $data->si_gasoil_m ;
                              $data->liv_m = $data->liv_gasoil_m ;
                              $data->vte_m = $data->vte_gasoil_m ;
                              $data->st_m = $data->st_gasoil_m ;
                              $data->sf_m = $data->sf_gasoil_m ;
                              $data->cou_m = $data->cou_gasoil_m ;
                              $data->freinte_m = $data->vte_gasoil_m * -0.003 ;

                              if ($data->freinte < 1 ) {

                                   $data->appreciation ="BON" ;
                           
                                 }else if( $data->freinte == 1){
                           
                                   $data->appreciation = "ACCEPTABLE" ;
                           
                                 }else if ($data->freinte > 1 ) {
                           
                                   $data->appreciation = "MAUVAIS" ;
                           
                                 }else{
                           
                                   $data->appreciation = '' ;
                                 }

                              
                              }

                         if ($value10 == 'SUPER') {

                              $data->si = $data->si_super_l ;
                              $data->liv = $data->liv_super_l ;
                              $data->vte = $data->vte_super_l ;
                              $data->st = $data->st_super_l ;
                              $data->sf = $data->sf_super_l ;
                              $data->cou = $data->cou_super_l ;
                              $data->freinte = $data->vte_super_l * -0.003  ;
                              $data->appreciation = '' ;
                              $data->si_m = $data->si_super_m ;
                              $data->liv_m = $data->liv_super_m ;
                              $data->vte_m = $data->vte_super_m ;
                              $data->st_m = $data->st_super_m ;
                              $data->sf_m = $data->sf_super_m ;
                              $data->cou_m = $data->cou_super_m ;
                              $data->freinte_m = $data->vte_super_m * -0.003  ;

                              if ($data->freinte < 1 ) {

                                   $data->appreciation ="BON" ;
                           
                                 }else if( $data->freinte == 1){
                           
                                   $data->appreciation = "ACCEPTABLE" ;
                           
                                 }else if ($data->freinte > 1 ) {
                           
                                   $data->appreciation = "MAUVAIS" ;
                           
                                 }else{
                           
                                   $data->appreciation = '' ;
                              }


                              
                         }
                         if ($value10 == 'PETROLE') {

                              $data->si = $data->si_petrole_l ;
                              $data->liv = $data->liv_petrole_l ;
                              $data->vte = $data->vte_petrole_l ;
                              $data->st = $data->st_petrole_l;
                              $data->sf = $data->sf_petrole_l ;
                              $data->cou = $data->cou_petrole_l  ;
                              $data->freinte = $data->vte_petrole_l * -0.003  ;
                              $data->appreciation = '' ;
                              $data->si_m = $data->si_petrole_m ;
                              $data->liv_m = $data->liv_petrole_m ;
                              $data->vte_m = $data->vte_petrole_m ;
                              $data->st_m = $data->st_petrole_m;
                              $data->sf_m = $data->sf_petrole_m ;
                              $data->cou_m = $data->cou_petrole_m  ;
                              $data->freinte_m = $data->vte_petrole_m * -0.003  ;

                              if ($data->freinte < 1 ) {

                                   $data->appreciation ="BON" ;
                           
                                 }else if( $data->freinte == 1){
                           
                                   $data->appreciation = "ACCEPTABLE" ;
                           
                                 }else if ($data->freinte > 1 ) {
                           
                                   $data->appreciation = "MAUVAIS" ;
                           
                                 }else{
                           
                                   $data->appreciation = '' ;
                              }

                             
                         }

                         /********************************************TOTAL COULAGES********************************************************* */

                         $datas[] = $data ;
                    }
             }

       print_r(json_encode($datas));
       return json_encode($datas);  

       
}

function Etats_Coulages_Lub_Station_Mensuel() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
      
       $requete = $data->coulages;
       $periode = $data->periode;
   
      
        $station = $requete ;

        $stations = [] ;
        $produits = [] ;

        $stations [] = $station ;
        
         // $date_debut = date_create('first day of previous month') ;
         // $date_fin = date_create('last day of previous month') ;

          $date_debut = date_create($periode->date_debut) ;
          $date_fin = date_create($periode->date_fin) ;

        //  $date_fin = date_add($date_fin, date_interval_create_from_date_string('-1 days')) ;
          
          /*var_dump($date_debut) ;
          var_dump($date_fin) ;
          */
          $date_debut2 = date_format($date_debut, 'Y-m-d') ;
          $date_fin2 = date_format($date_fin, 'Y-m-d') ;

          
   
        

     /****************************************************************************************************************************** */
     $query_produit = "

     Select
     station.nom_station As station,
     station.produit.id_produit,
     station.produit.nom_produit As produit,
     station.produit_station.prix_produit As prix,
     station.produit.conditionnement As emballage
     
     From
     produit_station Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     station On station.produit_station.id_station = station.id_station
               And station.produit_station.id_region = station.id_region
     Where
     station.produit.type_produit = 'LUBRIFIANT'
     
    
    " ;
     /********************************************************************************************************************* */

     $query_vte_lub = "

     SELECT
     DATE(station.quart.date_ouverture)AS date,
     SUM(produit_quart.qte_vendu) AS quantite,
     SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
     produit.id_produit,
     produit.nom_produit AS produit,
     station.nom_station AS station
     FROM
     produit_quart
     INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
     WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     GROUP BY
     
     DATE(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station

    
    " ;

 /************************************************************************************************************************ */

    /*************************************************************** */
     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.id_produit,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    
     /******************************************************************* */
    
     $query_stock_ouverture_lub = " 

     Select
          FIRST_DAY(station.quart.date_ouverture) As date,
          station.produit_quart.stock_ouverture As quantite,
          produit_station.prix_produit As prix,
          station.produit_quart.stock_ouverture * produit_station.prix_produit As montant,
          produit.id_produit,
          produit.nom_produit As produit,
          station.nom_station As station
     From
          produit_quart Inner Join
          quart On produit_quart.id_quart = quart.id_quart Inner Join
          station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
          produit On station.produit_quart.id_produit = produit.id_produit Inner Join
          produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where
          Time(station.quart.date_ouverture) = '07:00:00' and
          FIRST_DAY(station.quart.date_ouverture) = '$date_debut2' 
     
     GROUP BY 

     station.nom_station,
     produit.nom_produit
          

     " ;
     

    $query_stock_fermerture_lub = " 
    
     Select
          
          station.nom_station As station,
          station.produit.id_produit,
          station.produit.nom_produit As produit,
          station.produit_station.stock_initial As quantite,
          station.produit_station.stock_initial * station.produit_station.prix_produit As montant
          
      From
          produit_station Inner Join
          produit On produit_station.id_produit = produit.id_produit Inner Join
          station On station.produit_station.id_station = station.id_station
                    And station.produit_station.id_region = station.id_region
    
    
    " ;
     
 /************************************************************************************************** */
 $res_produit = mysqli_query($conn, $query_produit );

 // $produits = array();

 if (is_object($res_produit)) {


       while($rows = mysqli_fetch_array($res_produit))

       {
            if ($rows['station'] == $station) {

                 $obj = new stdClass();

                 $obj->id_produit = $rows['id_produit'] ;
                 $obj->produit = $rows['produit'] ;
                 $obj->emballage = $rows['emballage'] ;
                 $obj->prix = floatval($rows['prix']) ;
                 $obj->station = $rows['station'] ;

                 $produits[] = $obj ;
            }
       
       }


 }
 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = floatval($rows['quantite']) ;
                    $obj->id_produit = $rows['id_produit'] ;
                    $obj->produit = $rows['produit'] ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;
               }
          
          }


    }

 /******************************************************************************************************* */   

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = floatval($rows['quantite']) ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->id_produit = $rows['id_produit'] ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    
               }
          
          }


    }

     /******************************************************************************************************* */  
       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->prix = floatval($rows['prix']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->id_produit = $rows['id_produit'] ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;
 
                     
                }
           
           }
 
     }

     /******************************************************************************************************* */   
     /******************************************************************************************************** */

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     //$obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->id_produit = $rows['id_produit'] ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;
 
                     
                }
           
           }
 
 
     }
   /******************************************************************************************************************** */
   
   // var_dump($produits);
   // var_dump($data_stock_ouverture_lub);
   //var_dump($data_livr_lub);
   // var_dump($data_vte_lub);
   // var_dump($data_stock_fermerture_lub);
   

     $datas = array() ;

     $data_total = new stdClass();

     $data_total->produit = '';
     $data_total->emballage = '' ;
     $data_total->prix = 0;

     $data_total->si_l = 0 ;
     $data_total->si_m = 0 ;
     $data_total->liv_l = 0 ;
     $data_total->liv_m = 0 ;
     $data_total->vte_l = 0 ;
     $data_total->vte_m = 0 ;
     $data_total->st_l = 0 ;
     $data_total->st_m = 0 ;
     $data_total->sf_l = 0 ;
     $data_total->sf_m = 0 ;
     $data_total->mqt_l = 0 ;
     $data_total->mqt_m = 0 ;

     foreach ($produits as $key10 => $value10) {

          $data = new stdClass();

          $produit = $value10->id_produit ;

          $data->produit = $value10->produit ;
          $data->emballage = $value10->emballage ;
          $data->prix = $value10->prix ;

          $data->si_l = 0 ;
          $data->si_m = 0 ;
          $data->liv_l = 0 ;
          $data->liv_m = 0 ;
          $data->vte_l = 0 ;
          $data->vte_m = 0 ;
          $data->st_l = 0 ;
          $data->st_m = 0 ;
          $data->sf_l = 0 ;
          $data->sf_m = 0 ;
          $data->mqt_l = 0 ;
          $data->mqt_m = 0 ;

          foreach ($data_stock_ouverture_lub as $key => $value) {
               
               if ($value->id_produit == $produit) {
                    
                    $data->si_l += $value->quantite ;
                    $data->si_m += $value->montant ;
               }
          }

          foreach ($data_livr_lub as $key2 => $value2) {
               
               if ($value2->id_produit == $produit) {
                    
                    $data->liv_l += $value->quantite ;
                    $data->liv_m += $value->montant ;
               }
          }

          foreach ($data_vte_lub as $key3 => $value3) {
               
               if ($value3->id_produit == $produit) {
                    
                    $data->vte_l += $value->quantite ;
                    $data->vte_m += $value->montant ;
               }
          }

          foreach ($data_stock_fermerture_lub as $key4 => $value4) {
               
               if ($value4->id_produit == $produit) {
                    
                    $data->vte_l += $value->quantite ;
                    $data->vte_m += $value->montant ;
               }
          }

          $data->st_l = $data->si_l + $data->liv_l - $data->vte_l ;
          $data->st_m = $data->si_m + $data->liv_m - $data->vte_m ;

          $data->mqt_l = $data->st_l - $data->sf_l ;
          $data->mqt_m = $data->st_m - $data->sf_m ;

          /********************************************TOTAL EQUATION DE STOCK LUB********************************************************* */

          $datas[] = $data ;

          $data_total->produit = 'TOTAL' ;
          $data_total->emballage = '' ;
          $data_total->prix = 0 ;

          $data_total->si_l += $data->si_l ;
          $data_total->si_m += $data->si_m ;
          $data_total->liv_l += $data->liv_l;
          $data_total->liv_m += $data->liv_m ;
          $data_total->vte_l +=  $data->vte_l ;
          $data_total->vte_m += $data->vte_m ;
          $data_total->st_l += $data->st_l ;
          $data_total->st_m += $data->st_m ;
          $data_total->sf_l += $data->sf_l ;
          $data_total->sf_m += $data->sf_m ;
          $data_total->mqt_l += $data->mqt_l ;
          $data_total->mqt_m += $data->mqt_m ;


     }

     $datas[] = $data_total ;
             

       print_r(json_encode($datas));
       return json_encode($datas);  

       
}

function Etats_Coulages_Reseau() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
        $stations = [] ;
        $produits = ['GASOIL', 'SUPER', 'PETROLE'] ;


      //  $date_debut2 = date('Y-m-d', strtotime(time()));
      //  $date_fin2 = date('Y-m-d', strtotime(time()));
       
        $date_debut = date_create();
        $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
        $date_debut2 = date_format($date_debut, 'Y-m-d') ;
      //  $date_debut2 = date('Y-m-d', strtotime($date_debut2)) ;

        $date_fin2 = $date_debut2 ;

       
   
        

     /****************************************************************************************************************************** */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
     produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.nom_station As station,
     region.nom_region AS region
  From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
             And pompiste_pistolet.id_cuve = pistolet.id_cuve
             And pompiste_pistolet.id_station = pistolet.id_station
             And pompiste_pistolet.id_region = pistolet.id_region
             And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
             And pistolet.id_station = cuves.id_station
             And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
             And produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     region On station.id_region = region.id_region
 
     WHERE 
         
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 
      Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.nom_station,
     region.nom_region
         
     
     
     ";  
     /********************************************************************************************************************* */

     $query_vte_lub = "

     SELECT
     DATE(station.quart.date_ouverture)AS date,
     SUM(produit_quart.qte_vendu) AS quantite,
     SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
     produit.nom_produit AS produit,
     station.nom_station AS station
     FROM
     produit_quart
     INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
     WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     GROUP BY
     
     DATE(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station

    
    " ;

 /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station AS station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
     

     " ;


     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    

     $query_stock_ouverture_carb = " 

          Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     Time(station.quart.date_ouverture) = '07:00:00'  AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     $query_stock_fermerture_carb = " 

          Select
     station.quart.date_ouverture As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     station.quart.date_ouverture,
     produit.nom_produit,
     station.nom_station
    

     " ;


     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     
 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;
                    $obj->region = $rows['region'] ;
                    $obj->montant = intval($rows['montant']) ;

                    $data_vte_carb[] = $obj ;

                    $stations[] = $rows['station'] ;
          
       
      }
    }

 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;
          
          }


    }

 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_carb[] = $obj ;

                    
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    
          
          }


    }

     /******************************************************************************************************* */  

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
 
                     
           
           }
 
 
     }
       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;
 
                     
           
           }
 
     }

     /******************************************************************************************************* */   

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
 
                     
           
           }
 
 
     }
       
     /******************************************************************************************************** */

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;
                     
           
           }
 
 
     }
   /******************************************************************************************************************** */

   $data_total_gasoil = new stdClass();
   $data_total_super = new stdClass();
   $data_total_petrole = new stdClass();

     $data_total_gasoil->station = 'TOTAL GASOIL' ;
     $data_total_gasoil->produit = '' ;
     $data_total_gasoil->si = 0 ;
     $data_total_gasoil->liv = 0 ;
     $data_total_gasoil->vte = 0 ;
     $data_total_gasoil->st = 0 ;
     $data_total_gasoil->sf = 0 ;
     $data_total_gasoil->freinte = 0 ;
     $data_total_gasoil->cou = 0 ;
     $data_total_gasoil->appreciation = '' ;

     $data_total_super->station = 'TOTAL SUPER' ;
     $data_total_super->produit = '' ;
     $data_total_super->si = 0 ;
     $data_total_super->liv = 0 ;
     $data_total_super->vte = 0 ;
     $data_total_super->st = 0 ;
     $data_total_super->sf = 0 ;
     $data_total_super->freinte = 0 ;
     $data_total_super->cou = 0 ;
     $data_total_super->appreciation = '' ;

     $data_total_petrole->station = 'TOTAL PETROLE' ;
     $data_total_petrole->produit = '' ;
     $data_total_petrole->si = 0 ;
     $data_total_petrole->liv = 0 ;
     $data_total_petrole->vte = 0 ;
     $data_total_petrole->st = 0 ;
     $data_total_petrole->sf = 0 ;
     $data_total_petrole->freinte = 0 ;
     $data_total_petrole->cou = 0 ;
     $data_total_petrole->appreciation = '' ;
     
     $stations_unique = array_unique($stations);
   

        $datas = array() ;

             foreach ($stations_unique as $key => $value) {
                  
                    foreach ($produits as $key10 => $value10) {

                         $data = new stdClass();

                         $data->station = $value ;
                         $data->region = '' ;
                         $data->produit = $value10 ;

                         $data->si_gasoil_l = 0 ;
                         $data->si_super_l = 0 ;
                         $data->si_petrole_l = 0 ;
                         $data->si_lubrifiant_l = 0 ;

                         
                         $data->liv_gasoil_l = 0 ;
                         $data->liv_super_l = 0 ;
                         $data->liv_petrole_l = 0 ;
                         $data->liv_lubrifiant_l = 0 ;
                         

                         $data->vte_gasoil_l = 0 ;
                         $data->vte_super_l = 0 ;
                         $data->vte_petrole_l = 0 ;
                         $data->vte_lubrifiant_l = 0 ;
                         
                         
                         $data->st_gasoil_l = 0 ;
                         $data->st_super_l = 0 ;
                         $data->st_petrole_l = 0 ;
                         $data->st_lubrifiant_l = 0 ;
                         
                         

                         $data->sf_gasoil_l = 0 ;
                         $data->sf_super_l = 0 ;
                         $data->sf_petrole_l = 0 ;
                         $data->sf_lubrifiant_l = 0 ;
                         
                         

                         $data->cou_gasoil_l = 0 ;
                         $data->cou_super_l = 0 ;
                         $data->cou_petrole_l = 0 ;
                         $data->cou_lubrifiant_l = 0 ;
                         

                         $data->si = 0 ;
                         $data->liv = 0 ;
                         $data->vte = 0 ;
                         $data->st = 0 ;
                         $data->sf = 0 ;
                         $data->freinte = 0 ;
                         $data->appreciation = '' ;
                         

                         
                         foreach ($data_stock_ouverture_carb as $key1 => $value1) {
               
                              if ( $value1->station == $value) {
               
                                        if ($value1->produit == 'SUPER') {

                                        
                                             $data->si_super_l = $value1->quantite ;

                                        
                                        } elseif ($value1->produit == 'GASOIL') {

                                             $data->si_gasoil_l = $value1->quantite ;

                                        } else {

                                             $data->si_petrole_l = $value1->quantite ;


                                        }
                                   
                                   
                              }
                         }

                         foreach ($data_stock_ouverture_lub as $key2 => $value2) {
               
                              if ( $value2->station == $value) {

                                   $data->si_lubrifiant_l += $value2->quantite ;

                              }
                         }

                         foreach ($data_livr_carb as $key3 => $value3) {
               
                              if ( $value3->station == $value) {

                                   if ($value3->produit == 'SUPER') {

                                        
                                        $data->liv_super_l = $value3->quantite ;

                                   
                                   } elseif ($value3->produit == 'GASOIL') {

                                        $data->liv_gasoil_l = $value3->quantite ;

                                   } else {

                                        $data->liv_petrole_l = $value3->quantite ;


                                   }
                              
                              
                              }
                         }

                         foreach ($data_livr_lub as $key4 => $value4) {
               
                              if ($value4->station == $value) {

                                   $data->liv_lubrifiant_l += $value4->quantite ;

                              }
                         }

                         foreach ($data_vte_carb as $key5 => $value5) {

               
                              if ($value5->station == $value) {

                                   // COndition Region

                                   $data->region = $value5->region ;

                                   if ($value5->produit == 'SUPER') {

                                        
                                        $data->vte_super_l = $value5->quantite ;

                                   
                                        } elseif ($value5->produit == 'GASOIL') {

                                             $data->vte_gasoil_l = $value5->quantite ;

                                        } else {

                                        $data->vte_petrole_l = $value5->quantite ;


                                   }
                              
                              
                              }
                         }  

                         foreach ($data_vte_lub as $key6 => $value6) {
               
                              if ($value6->station == $value) {

                                   $data->vte_lubrifiant_l += $value6->quantite ;

                              }
                         }

                         foreach ($data_stock_fermerture_carb as $key7 => $value7) {
               
                                   
                                   if ($value7->station == $value) {

                                        if ($value7->produit == 'SUPER') {
     
                                             
                                             $data->sf_super_l = $value7->quantite ;
     
                                        
                                        } elseif ($value7->produit == 'GASOIL') {
     
                                             $data->sf_gasoil_l = $value7->quantite ;
     
                                        } else {
     
                                             $data->sf_petrole_l = $value7->quantite ;
     
     
                                        }
                                   
                                   
                                   }
                              
                              
                         }

                         foreach ($data_stock_fermerture_lub as $key8 => $value8) {
               
                              if ($value8->station == $value) {

                                   $data->sf_lubrifiant_l += $value8->quantite ;

                              }
                         }


                         $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
                         $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
                         $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
                         $data->st_lubrifiant_l = $data->si_lubrifiant_l + $data->liv_lubrifiant_l - $data->vte_lubrifiant_l ;
                         

                         $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
                         $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
                         $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
                         $data->cou_lubrifiant_l = $data->sf_lubrifiant_l - $data->st_lubrifiant_l ;
                         

                         if ($value10 == 'GASOIL') {

                              $data->si =  $data->si_gasoil_l ;
                              $data->liv = $data->liv_gasoil_l ;
                              $data->vte = $data->vte_gasoil_l ;
                              $data->st = $data->st_gasoil_l ;
                              $data->sf = $data->sf_gasoil_l ;
                              $data->cou = $data->cou_gasoil_l ;
                              $data->freinte = $data->vte_gasoil_l * -0.003 ;
                              $data->appreciation = '' ;

                              if ($data->cou < $data->freinte ) {

                                   $data->appreciation ="MAUVAIS" ;
                           
                                 }else if( $data->cou > $data->freinte){
                           
                                   $data->appreciation = "BON" ;
                           
                              }

                                   $data_total_gasoil->station = 'TOTAL GASOIL' ;
                                   $data_total_gasoil->produit = '' ;
                                   $data_total_gasoil->si += $data->si ;
                                   $data_total_gasoil->liv += $data->liv ;
                                   $data_total_gasoil->vte += $data->vte ;
                                   $data_total_gasoil->st += $data->st ;
                                   $data_total_gasoil->sf += $data->sf ;
                                   $data_total_gasoil->freinte += $data->freinte ;
                                   $data_total_gasoil->cou += $data->cou ;
                                   $data_total_gasoil->appreciation = '' ;


                                   
                              
                         }

                         if ($value10 == 'SUPER') {

                              $data->si = $data->si_super_l ;
                              $data->liv = $data->liv_super_l ;
                              $data->vte = $data->vte_super_l ;
                              $data->st = $data->st_super_l ;
                              $data->sf = $data->sf_super_l ;
                              $data->cou = $data->cou_super_l ;
                              $data->freinte = $data->vte_super_l * -0.003  ;
                              $data->appreciation = '' ;

                              if ($data->cou < $data->freinte ) {

                                   $data->appreciation ="MAUVAIS" ;
                           
                                 }else if( $data->cou > $data->freinte){
                           
                                   $data->appreciation = "BON" ;
                           
                              }

                              $data_total_super->station = 'TOTAL SUPER' ;
                              $data_total_super->produit = '' ;
                              $data_total_super->si += $data->si ;
                              $data_total_super->liv += $data->liv ;
                              $data_total_super->vte += $data->vte ;
                              $data_total_super->st += $data->st ;
                              $data_total_super->sf += $data->sf ;
                              $data_total_super->freinte += $data->freinte ;
                              $data_total_super->cou += $data->cou ;
                              $data_total_super->appreciation = '' ;


                              

                              
                         }
                         if ($value10 == 'PETROLE') {

                              $data->si = $data->si_petrole_l ;
                              $data->liv = $data->liv_petrole_l ;
                              $data->vte = $data->vte_petrole_l ;
                              $data->st = $data->st_petrole_l;
                              $data->sf = $data->sf_petrole_l ;
                              $data->cou = $data->cou_petrole_l  ;
                              $data->freinte = $data->vte_petrole_l * -0.003  ;
                              $data->appreciation = '' ;

                              if ($data->cou < $data->freinte ) {

                                   $data->appreciation ="MAUVAIS" ;
                           
                                 }else if( $data->cou > $data->freinte){
                           
                                   $data->appreciation = "BON" ;
                           
                              }

                              $data_total_petrole->station = 'TOTAL PETROLE' ;
                              $data_total_petrole->produit = '' ;
                              $data_total_petrole->si += $data->si ;
                              $data_total_petrole->liv += $data->liv ;
                              $data_total_petrole->vte += $data->vte ;
                              $data_total_petrole->st += $data->st ;
                              $data_total_petrole->sf += $data->sf ;
                              $data_total_petrole->freinte += $data->freinte ;
                              $data_total_petrole->cou += $data->cou ;
                              $data_total_petrole->appreciation = '' ;
                              
                         }

                         /********************************************TOTAL COULAGES********************************************************* */

                         $datas[] = $data ;
                    }

                    $data_separation = new stdClass();

                    $data_separation->si = '' ;
                    $data_separation->liv = '' ;
                    $data_separation->vte = '' ;
                    $data_separation->st = '' ;
                    $data_separation->sf = '' ;
                    $data_separation->freinte = '' ;
                    $data_separation->appreciation = '' ;

                    $datas[] = $data_separation ;
             }


             if ($data_total_gasoil->cou < $data_total_gasoil->freinte ) {

               $data_total_gasoil->appreciation ="MAUVAIS" ;
       
             }else if( $data_total_gasoil->cou > $data_total_gasoil->freinte){
       
               $data_total_gasoil->appreciation = "BON" ;
       
           }

           if ($data_total_super->cou < $data_total_super->freinte ) {

               $data_total_super->appreciation ="MAUVAIS" ;
       
             }else if( $data_total_super->cou > $data_total_super->freinte){
       
               $data_total_super->appreciation = "BON" ;
       
          }

          if ($data_total_petrole->cou < $data_total_petrole->freinte ) {

               $data_total_petrole->appreciation ="MAUVAIS" ;
       
             }else if( $data_total_petrole->cou > $data_total_petrole->freinte){
       
               $data_total_petrole->appreciation = "BON" ;
       
          }
        

             $datas[] = $data_total_gasoil ;
             $datas[] = $data_total_super ;
             $datas[] = $data_total_petrole ;

   
       print_r(json_encode($datas));
       return json_encode($datas);  

       
}

function Etats_Coulages_Reseau_Mensuel() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;

       //var_dump($data) ;

       //die();
   
        $stations = [] ;
        $produits = ['GASOIL', 'SUPER', 'PETROLE'] ;


          //  $date_debut2 = date('Y-m-d', strtotime(time()));
          //  $date_fin2 = date('Y-m-d', strtotime(time()));

          if ($data->coulages->accueil) {
               
               $date_debut = date_create('first day of this month') ;
               $date_fin = date_create('last day of this month') ;

          }else {
               
               $date_debut = date_create($data->coulages->date_debut) ;
               $date_fin = date_create($data->coulages->date_fin) ;
          }
          
         
          
          
          $date_debut2 = date_format($date_debut, 'Y-m-d') ;
          $date_fin2 = date_format($date_fin, 'Y-m-d') ;

          $date_debut_si = date_format($date_debut, 'Y-m-d') ;
          $date_debut_si .= ' 07:00:00' ;

          $date_fin_si = date_format($date_debut, 'Y-m-d') ;
          $date_fin_si .= ' 07:00:00' ;
       
   
          // var_dump($date_debut_si) ;
          // var_dump($date_fin_si) ;

     /****************************************************************************************************************************** */
   
     $query_vte_carb = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise))* produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     produit_station.prix_produit,
     station.nom_station As station
     
     From
     pompiste_pistolet Inner Join
     pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
               And pompiste_pistolet.id_cuve = pistolet.id_cuve
               And pompiste_pistolet.id_station = pistolet.id_station
               And pompiste_pistolet.id_region = pistolet.id_region
               And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
     cuves On pistolet.id_cuve = cuves.id_cuve
               And pistolet.id_station = cuves.id_station
               And pistolet.id_region = cuves.id_region Inner Join
     produit On cuves.id_produit = produit.id_produit Inner Join
     quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_produit = station.produit.id_produit
               And produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region

     WHERE 
     
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.nom_station,
     produit_station.prix_produit
     
     
     ";  
     /********************************************************************************************************************* */
     /************************************************************************************************************************ */

     $query_livr_carb = " 


     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_carburant.qte_recu) As quantite,
     Sum(livraison_carburant.qte_recu * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station AS station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     livraison_carburant On livraison_carburant.id_livraison = station.livraison.id_livraison Inner Join
     produit On livraison_carburant.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
     

     " ;


    /******************************************************** */
    

     $query_stock_ouverture_carb = " 

          Select
     station.quart.date_ouverture As date,
     Sum(station.jauge_quart.Jauge_depart) As quantite,
     Sum(station.jauge_quart.Jauge_depart * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     
     station.quart.date_ouverture = '$date_debut_si'

     Group By
     station.quart.date_ouverture,
     produit.nom_produit,
     station.nom_station
    

     " ;

     /*********************************************************** */

     $query_stock_fermerture_carb = " 

          Select
     station.quart.date_ouverture As date,
     Sum(station.jauge_quart.Jauge_fin) As quantite,
     Sum(station.jauge_quart.Jauge_fin * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
     From
     jauge_quart Inner Join
     quart On jauge_quart.id_quart = quart.id_quart Inner Join
     cuves On jauge_quart.id_cuve = cuves.id_cuve
               And jauge_quart.id_station = cuves.id_station
               And jauge_quart.id_region = cuves.id_region Inner Join
     station On station.cuves.id_station = station.id_station
               And station.cuves.id_region = station.id_region Inner Join
     produit On station.cuves.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit
     Where

     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
     Group By
     station.quart.date_ouverture,
     produit.nom_produit,
     station.nom_station
    

     " ;

     
 /************************************************************************************************** */

    $res_vte_carb = mysqli_query($conn, $query_vte_carb );

    $data_vte_carb = array();

    if (is_object($res_vte_carb)) {

       while($rows = mysqli_fetch_array($res_vte_carb))

      {

               $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->prix_produit = intval($rows['prix_produit']) ;
                    $obj->station = $rows['station'] ;
                    $obj->montant = intval($rows['montant']) ;

                    $data_vte_carb[] = $obj ;

                    $stations[] = $rows['station'] ;
          
       
      }
    }

 /****************************************************************************************************************** */
 /******************************************************************************************************* */   

 $res_livr_carb = mysqli_query($conn, $query_livr_carb );

    $data_livr_carb = array();

    if (is_object($res_livr_carb)) {


          while($rows = mysqli_fetch_array($res_livr_carb))

          {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = intval($rows['quantite']) ;
                    $obj->montant = intval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_carb[] = $obj ;

                    
          
          }


    }

    /**************************************************************************************************************************** */
     /******************************************************************************************************* */  

     $res_stock_ouverture_carb = mysqli_query($conn, $query_stock_ouverture_carb);

     $data_stock_ouverture_carb = array();
 
     if (is_object($res_stock_ouverture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_carb))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_carb[] = $obj ;
 
                     
           
           }
 
 
     }
       
     /********************************************************************************************************************* */
     /******************************************************************************************************* */   

     $res_stock_fermerture_carb = mysqli_query($conn, $query_stock_fermerture_carb);

     $data_stock_fermerture_carb = array();
 
     if (is_object($res_stock_fermerture_carb)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_carb))
 
           {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = intval($rows['quantite']) ;
                     $obj->montant = intval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_carb[] = $obj ;
 
                     
           
           }
 
 
     }
       
     /******************************************************************************************************** */
     /******************************************************************************************************************** */

   $data_total_gasoil = new stdClass();
   $data_total_super = new stdClass();
   $data_total_petrole = new stdClass();

     $data_total_gasoil->station = 'TOTAL GASOIL' ;
     $data_total_gasoil->produit = '' ;
     $data_total_gasoil->prix_gasoil = 0 ;
     $data_total_gasoil->si = 0 ;
     $data_total_gasoil->liv = 0 ;
     $data_total_gasoil->vte = 0 ;
     $data_total_gasoil->st = 0 ;
     $data_total_gasoil->sf = 0 ;
     $data_total_gasoil->freinte = 0 ;
     $data_total_gasoil->cou = 0 ;
     $data_total_gasoil->cou_m = 0 ;
     $data_total_gasoil->appreciation = '' ;
     $data_total_gasoil->prix_produit = 0 ;

     $data_total_super->station = 'TOTAL SUPER' ;
     $data_total_super->produit = '' ;
     $data_total_super->prix_super = 0 ;
     $data_total_super->si = 0 ;
     $data_total_super->liv = 0 ;
     $data_total_super->vte = 0 ;
     $data_total_super->st = 0 ;
     $data_total_super->sf = 0 ;
     $data_total_super->freinte = 0 ;
     $data_total_super->cou = 0 ;
     $data_total_super->cou_m = 0 ;
     $data_total_super->appreciation = '' ;
     $data_total_super->prix_produit = 0 ;

     $data_total_petrole->station = 'TOTAL PETROLE' ;
     $data_total_petrole->produit = '' ;
     $data_total_petrole->prix_petrole = '' ;
     $data_total_petrole->si = 0 ;
     $data_total_petrole->liv = 0 ;
     $data_total_petrole->vte = 0 ;
     $data_total_petrole->st = 0 ;
     $data_total_petrole->sf = 0 ;
     $data_total_petrole->freinte = 0 ;
     $data_total_petrole->cou = 0 ;
     $data_total_petrole->cou_m = 0 ;
     $data_total_petrole->appreciation = '' ;
     $data_total_petrole->prix_produit = 0 ;
     
     $stations_unique = array_unique($stations);
   

        $datas = array() ;

             foreach ($stations_unique as $key => $value) {

                    $data_separation = new stdClass();

                    $data_separation->station = '' ;
                    $data_separation->produit = 'TOTAL' ;
                    $data_separation->si = '' ;
                    $data_separation->liv = '' ;
                    $data_separation->vte = '' ;
                    $data_separation->st = '' ;
                    $data_separation->sf = '' ;
                    $data_separation->cou = 0  ;
                    $data_separation->cou_m = 0 ;
                    $data_separation->freinte = 0 ;
                    $data_separation->depassement = 0 ;
                    $data_separation->depassement_m = 0 ;
                    $data_separation->appreciation = '' ;
                    $data_separation->prix_produit = 0 ;
                  
                    foreach ($produits as $key10 => $value10) {

                         $data = new stdClass();

                         $data->station = $value ;
                         $data->produit = $value10 ;

                         $data->prix_gasoil = 0 ;
                         $data->prix_super = 0 ;
                         $data->prix_petrole = 0 ;

                         $data->si_gasoil_l = 0 ;
                         $data->si_super_l = 0 ;
                         $data->si_petrole_l = 0 ;
                         $data->si_lubrifiant_l = 0 ;

                         
                         $data->liv_gasoil_l = 0 ;
                         $data->liv_super_l = 0 ;
                         $data->liv_petrole_l = 0 ;
                         $data->liv_lubrifiant_l = 0 ;
                         
                        

                         $data->vte_gasoil_l = 0 ;
                         $data->vte_super_l = 0 ;
                         $data->vte_petrole_l = 0 ;
                         $data->vte_lubrifiant_l = 0 ;
                         
                         
                         $data->st_gasoil_l = 0 ;
                         $data->st_super_l = 0 ;
                         $data->st_petrole_l = 0 ;
                         $data->st_lubrifiant_l = 0 ;
                         
                         

                         $data->sf_gasoil_l = 0 ;
                         $data->sf_super_l = 0 ;
                         $data->sf_petrole_l = 0 ;
                         $data->sf_lubrifiant_l = 0 ;
                         
                         

                         $data->cou_gasoil_l = 0 ;
                         $data->cou_super_l = 0 ;
                         $data->cou_petrole_l = 0 ;
                         $data->cou_lubrifiant_l = 0 ;
                         

                         $data->si = 0 ;
                         $data->liv = 0 ;
                         $data->vte = 0 ;
                         $data->st = 0 ;
                         $data->sf = 0 ;
                         $data->freinte = 0 ;
                         $data->appreciation = '' ;
                         $data->prix_produit = 0 ;
                         
                         // *array_splice($data_stock_ouverture_carb, 3) ;
                         
                         foreach ($data_stock_ouverture_carb as $key1 => $value1) {
               
                              if ( $value1->station == $value) {
               
                                        if ($value1->produit == 'SUPER') {

                                        
                                             $data->si_super_l += $value1->quantite ;

                                        
                                        } elseif ($value1->produit == 'GASOIL') {

                                             $data->si_gasoil_l += $value1->quantite ;

                                        } else {

                                             $data->si_petrole_l += $value1->quantite ;


                                        }
                                   
                                   
                              }
                         }

                         

                         foreach ($data_livr_carb as $key3 => $value3) {
               
                              if ( $value3->station == $value) {

                                   if ($value3->produit == 'SUPER') {

                                        
                                        $data->liv_super_l += $value3->quantite ;

                                   
                                   } elseif ($value3->produit == 'GASOIL') {

                                        $data->liv_gasoil_l += $value3->quantite ;

                                   } else {

                                        $data->liv_petrole_l += $value3->quantite ;


                                   }
                              
                              
                              }
                         }

                         

                         foreach ($data_vte_carb as $key5 => $value5) {
               
                              if ($value5->station == $value) {

                                   if ($value5->produit == 'SUPER') {

                                        
                                        $data->vte_super_l += $value5->quantite ;
                                        $data->prix_super = $value5->prix_produit ;
                                        $data_total_super->prix_super = $value5->prix_produit ;

                                   
                                   } elseif ($value5->produit == 'GASOIL') {

                                        $data->vte_gasoil_l += $value5->quantite ;
                                        $data->prix_gasoil = $value5->prix_produit ;
                                        $data_total_gasoil->prix_gasoil = $value5->prix_produit ;


                                   } else {

                                        $data->vte_petrole_l += $value5->quantite ;
                                        $data->prix_petrole = $value5->prix_produit ;
                                        $data_total_petrole->prix_petrole = $value5->prix_produit ;


                                   }
                              
                              
                              }
                         }  

                         

                         foreach ($data_stock_fermerture_carb as $key7 => $value7) {
               
                                   
                                   if ($value7->station == $value) {

                                        if ($value7->produit == 'SUPER') {
     
                                             
                                             $data->sf_super_l = $value7->quantite ;
     
                                        
                                        } elseif ($value7->produit == 'GASOIL') {
     
                                             $data->sf_gasoil_l = $value7->quantite ;
     
                                        } else {
     
                                             $data->sf_petrole_l = $value7->quantite ;
     
     
                                        }
                                   
                                   
                                   }
                              
                              
                         }

                         


                         $data->st_gasoil_l = $data->si_gasoil_l + $data->liv_gasoil_l - $data->vte_gasoil_l ;
                         $data->st_super_l = $data->si_super_l + $data->liv_super_l - $data->vte_super_l ;
                         $data->st_petrole_l = $data->si_petrole_l + $data->liv_petrole_l - $data->vte_petrole_l ;
                         

                         $data->cou_gasoil_l = $data->sf_gasoil_l - $data->st_gasoil_l;
                         $data->cou_super_l = $data->sf_super_l - $data->st_super_l ;
                         $data->cou_petrole_l = $data->sf_petrole_l - $data->st_petrole_l ;
                         

                         if ($value10 == 'GASOIL') {

                              $data->si =  $data->si_gasoil_l ;
                              $data->liv = $data->liv_gasoil_l ;
                              $data->vte = $data->vte_gasoil_l ;
                              $data->st = $data->st_gasoil_l ;
                              $data->sf = $data->sf_gasoil_l ;
                              $data->cou = $data->cou_gasoil_l ;
                              $data->prix_produit = $data->prix_gasoil ;
                              $data->cou_m = $data->cou_gasoil_l*$data->prix_produit ;

                              $data->freinte = $data->vte_gasoil_l * -0.003 ;

                            //  $data_separation->depassement += ($data->cou - $data->freinte) ;
                            //  $data_separation->depassement_m += ($data->cou - $data->freinte)*$data->prix_produit ;

                              $data->appreciation = '' ;

                              if ($data->cou < $data->freinte ) {

                                   $data->appreciation ="MAUVAIS" ;
                           
                                 }else if( $data->cou > $data->freinte){
                           
                                   $data->appreciation = "BON" ;
                           
                              }

                                   $data_total_gasoil->station = 'TOTAL GASOIL' ;
                                   $data_total_gasoil->produit = '' ;
                                  // $data_total_gasoil->prix_produit = $data_total_gasoil->prix_gasoil ;
                                   $data_total_gasoil->si += $data->si ;
                                   $data_total_gasoil->liv += $data->liv ;
                                   $data_total_gasoil->vte += $data->vte ;
                                   $data_total_gasoil->st += $data->st ;
                                   $data_total_gasoil->sf += $data->sf ;
                                   $data_total_gasoil->freinte += $data->freinte ;
                                   $data_total_gasoil->cou += $data->cou ;
                                   $data_total_gasoil->cou_m += $data->cou_m ;
                                   $data_total_gasoil->appreciation = '' ;


                                   
                              
                         }

                         if ($value10 == 'SUPER') {

                              $data->si = $data->si_super_l ;
                              $data->liv = $data->liv_super_l ;
                              $data->vte = $data->vte_super_l ;
                              $data->st = $data->st_super_l ;
                              $data->sf = $data->sf_super_l ;
                              $data->cou = $data->cou_super_l ;
                              $data->prix_produit = $data->prix_super ;
                              $data->cou_m = $data->cou_super_l*$data->prix_produit ;


                              $data->freinte = $data->vte_super_l * -0.003  ;

                            //  $data_separation->depassement += ($data->cou - $data->freinte) ;
                            //  $data_separation->depassement_m += ($data->cou - $data->freinte)*$data->prix_produit ;

                              $data->appreciation = '' ;

                              if ($data->cou < $data->freinte ) {

                                   $data->appreciation ="MAUVAIS" ;
                           
                                 }else if( $data->cou > $data->freinte){
                           
                                   $data->appreciation = "BON" ;
                           
                              }

                              $data_total_super->station = 'TOTAL SUPER' ;
                              $data_total_super->produit = '' ;
                             // $data_total_super->prix_produit = $data_total_super->prix_super ;
                              $data_total_super->si += $data->si ;
                              $data_total_super->liv += $data->liv ;
                              $data_total_super->vte += $data->vte ;
                              $data_total_super->st += $data->st ;
                              $data_total_super->sf += $data->sf ;
                              $data_total_super->freinte += $data->freinte ;
                              $data_total_super->cou += $data->cou ;
                              $data_total_super->cou_m += $data->cou_m ;
                              $data_total_super->appreciation = '' ;


                              

                              
                         }

                         if ($value10 == 'PETROLE') {

                              $data->si = $data->si_petrole_l ;
                              $data->liv = $data->liv_petrole_l ;
                              $data->vte = $data->vte_petrole_l ;
                              $data->st = $data->st_petrole_l;
                              $data->sf = $data->sf_petrole_l ;
                              $data->cou = $data->cou_petrole_l  ;
                              $data->prix_produit = $data->prix_petrole ;
                              $data->cou_m = $data->cou_petrole_l*$data->prix_produit ;

                              $data->freinte = $data->vte_petrole_l * -0.003  ;

                             // $data_separation->depassement += ($data->cou - $data->freinte) ;
                            //  $data_separation->depassement_m += ($data->cou - $data->freinte)*$data->prix_produit ;

                              $data->appreciation = '' ;

                              if ($data->cou < $data->freinte ) {

                                   $data->appreciation ="MAUVAIS" ;
                           
                                 }else if( $data->cou > $data->freinte){
                           
                                   $data->appreciation = "BON" ;
                           
                              }

                              $data_total_petrole->station = 'TOTAL PETROLE' ;
                              $data_total_petrole->produit = '' ;
                            //  $data_total_petrole->prix_produit = $data_total_petrole->prix_petrole ;
                              $data_total_petrole->si += $data->si ;
                              $data_total_petrole->liv += $data->liv ;
                              $data_total_petrole->vte += $data->vte ;
                              $data_total_petrole->st += $data->st ;
                              $data_total_petrole->sf += $data->sf ;
                              $data_total_petrole->freinte += $data->freinte ;
                              $data_total_petrole->cou += $data->cou ;
                              $data_total_petrole->cou_m += $data->cou_m ;
                              $data_total_petrole->appreciation = '' ;
                              
                         }

                         /********************************************TOTAL COULAGES********************************************************* */

                         $datas[] = $data ;

                         $data_separation->si = '' ;
                         $data_separation->liv = '' ;
                         $data_separation->vte = '' ;
                         $data_separation->st = '' ;
                         $data_separation->sf = '' ;
                         $data_separation->cou += $data->cou  ;
                         $data_separation->cou_m += $data->cou_m ;
                         $data_separation->freinte += $data->freinte ;

                         $data_separation->depassement += ($data->cou - $data->freinte) ;
                         $data_separation->depassement_m += ($data->cou - $data->freinte)*$data->prix_produit ;


                         $data_separation->appreciation = '' ;
                    }

                   

                    $datas[] = $data_separation ;
             }


             if ($data_total_gasoil->cou < $data_total_gasoil->freinte ) {

               $data_total_gasoil->appreciation ="MAUVAIS" ;
       
             }else if( $data_total_gasoil->cou > $data_total_gasoil->freinte){
       
               $data_total_gasoil->appreciation = "BON" ;
       
           }

           if ($data_total_super->cou < $data_total_super->freinte ) {

               $data_total_super->appreciation ="MAUVAIS" ;
       
             }else if( $data_total_super->cou > $data_total_super->freinte){
       
               $data_total_super->appreciation = "BON" ;
       
          }

          if ($data_total_petrole->cou < $data_total_petrole->freinte ) {

               $data_total_petrole->appreciation ="MAUVAIS" ;
       
             }else if( $data_total_petrole->cou > $data_total_petrole->freinte){
       
               $data_total_petrole->appreciation = "BON" ;
       
          }
          

                $data_total_general = new stdClass();

               $data_total_general->station = '' ;
               $data_total_general->produit = 'TOTAL' ;
               $data_total_general->si = $data_total_gasoil->si + $data_total_super->si + $data_total_petrole->si ;
               $data_total_general->liv = $data_total_gasoil->liv + $data_total_super->liv + $data_total_petrole->liv ;
               $data_total_general->vte = $data_total_gasoil->vte + $data_total_super->vte + $data_total_petrole->vte ;
               $data_total_general->st = $data_total_gasoil->st + $data_total_super->st + $data_total_petrole->st ;
               $data_total_general->sf = $data_total_gasoil->sf + $data_total_super->sf + $data_total_petrole->sf ;
               $data_total_general->cou = $data_total_gasoil->cou + $data_total_super->cou + $data_total_petrole->cou  ;
               $data_total_general->cou_m = $data_total_gasoil->cou_m + $data_total_super->cou_m + $data_total_petrole->cou_m ;
               $data_total_general->freinte = $data_total_gasoil->freinte + $data_total_super->freinte + $data_total_petrole->freinte ;
               $data_total_general->depassement = $data_total_general->cou - $data_total_general->freinte ;
               $data_total_general->depassement_m = 0 ;
               $data_total_general->appreciation = '' ;
               $data_total_general->prix_produit = 0 ;

               
          

             $datas[] = $data_total_gasoil ;
             $datas[] = $data_total_super ;
             $datas[] = $data_total_petrole ;

             $datas[] = $data_total_general ;

   
       print_r(json_encode($datas));
       return json_encode($datas);  

       
}

function Etats_Ventes_Reseau() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
        $date_debut = date_create();
        $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
        $date_debut2 = date_format($date_debut, 'Y-m-d') ;

        $date_fin2 = $date_debut2 ;
        $stations = [] ;
   
        /********************************************MANQUANTS******************************************************************* */
   
        $query_depenses = "
        
             Select
             Sum(station.depense_station.montant_depense) As montant,
             Date(station.quart.date_ouverture) As date,
             station.nom_station As station
        From
             depense_station Inner Join
             quart On depense_station.id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region
   
                  WHERE 
           
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        Group By
             
             Date(station.quart.date_ouverture),
             station.nom_station
        
        " ;
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "

        Select
        Date(station.quart.date_ouverture) As date,
        client.nom_client AS client,
        station.nom_station AS station,
        Sum(station.pompiste_has_client.montant) As montant,
        client.id_client
         From
         pompiste_has_client Inner Join
         quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
         station On station.quart.id_station = station.id_station
                   And station.quart.id_region = station.id_region Inner Join
         client On client.id_station = station.id_station
                   And client.id_region = station.id_region
                   And station.pompiste_has_client.client_id_client = client.id_client
    
                   WHERE 
           
                   (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                   (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )   
    
         Group By
         Date(station.quart.date_ouverture),
         client.nom_client,
         station.nom_station,
         client.id_client
             
             " ;
    
     /************************************************************************************************************************ */
    
         $query_vers_pompiste = " 
   
           Select
           Date(station.quart.date_ouverture) As date,
           station.nom_station As station,
           Sum(station.versement_pompiste.montant_versement) As montant
      From
      versement_pompiste Inner Join
      quart On versement_pompiste.id_quart = quart.id_quart Inner Join
      pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
      station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
                And station.pompiste.id_station = station.id_station
                And station.pompiste.id_region = station.id_region
      WHERE 
           
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
      Group By
           Date(station.quart.date_ouverture),
           station.nom_station
           
           
    
      " ;
   
   
        /******************** REQUETES MANQUANTS POMPISTES********************************************************************* */  
      
        $res_depenses = mysqli_query($conn, $query_depenses );
    
        $data_depenses = array();
    
        if (is_object($res_depenses)) {
    
    
              while($rows = mysqli_fetch_array($res_depenses))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_depenses[] = $obj ;
              
              }
    
    
        }
      
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->id_client = $rows['id_client'] ;
                        $obj->client = $rows['client'] ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
     $res_vers_pompiste = mysqli_query($conn, $query_vers_pompiste );
    
        $data_vers_pompiste = array();
    
        if (is_object($res_vers_pompiste)) {
    
    
              while($rows = mysqli_fetch_array($res_vers_pompiste))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_vers_pompiste[] = $obj ;
    
              
              }
    
    
        }
    
     /******************************************************************************************************* */  
   
      
        $query = "
        
        Select
    Date(station.quart.date_ouverture) As date,
    Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
    (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
    Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
    (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
    produit_station.prix_produit As montant,
    station.produit.nom_produit As produit,
    station.nom_station As station,
    region.nom_region AS region
 From
    pompiste_pistolet Inner Join
    pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
            And pompiste_pistolet.id_cuve = pistolet.id_cuve
            And pompiste_pistolet.id_station = pistolet.id_station
            And pompiste_pistolet.id_region = pistolet.id_region
            And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
    cuves On pistolet.id_cuve = cuves.id_cuve
            And pistolet.id_station = cuves.id_station
            And pistolet.id_region = cuves.id_region Inner Join
    produit On cuves.id_produit = produit.id_produit Inner Join
    quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
    station On station.quart.id_station = station.id_station
            And station.quart.id_region = station.id_region Inner Join
    produit_station On produit_station.id_produit = station.produit.id_produit
            And produit_station.id_station = station.id_station
            And produit_station.id_region = station.id_region Inner Join
    region On station.id_region = region.id_region

    WHERE 
        
    (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
    (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )

     Group By
    Date(station.quart.date_ouverture),
    station.produit.nom_produit,
    station.nom_station,
    region.nom_region
        
        
        ";  
        /********************************************************************************************************************* */
   
        $query_Lub = "
   
        Select
        Date(station.quart.date_ouverture) As date,
        station.nom_station As station,
        produit.nom_produit AS produit,
        produit.conditionnement AS conditionnement,
        SUM(station.produit_quart.qte_vendu) AS quantite,
        produit_station.prix_produit AS prix_unitaire,
        Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
    From
        produit_quart Inner Join
        quart On produit_quart.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region Inner Join
        produit On station.produit_quart.id_produit = produit.id_produit Inner Join
        produit_station On produit_station.id_station = station.id_station
                And produit_station.id_region = station.id_region
                And produit_station.id_produit = produit.id_produit
 
                WHERE 
 
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
    Group By
 
        Date(station.quart.date_ouverture),
        station.nom_station
 
   
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
   
     " ;
       
    /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->quantite = intval($rows['quantite']) ;
                       $obj->produit = $rows['produit'] ;
                       $obj->station = $rows['station'] ;
                       $obj->region = $rows['region'] ;
                       $obj->montant = $rows['montant'] ;
   
                       $data_carb[] = $obj ;

                       $stations[] = $rows['station'] ;
        }
   
          
       }
   
    /****************************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query_Lub );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
   
             while($rows = mysqli_fetch_array($res_lub))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
             
             }
   
   
       }
   
    /******************************************************************************************************* */  
   
        $datas = array() ;
   
        $stations_unique = array_unique($stations) ;


        $data_total = new stdClass();
   
        $data_total->station = 'TOTAL' ;
        $data_total->super = 0 ;
        $data_total->gasoil = 0 ;
        $data_total->petrole = 0 ;
        $data_total->tpc = 0 ;
        $data_total->total_carb = 0 ;
        $data_total->total_lub = 0 ;
        $data_total->total_attendu = 0 ;
        $data_total->versement = 0 ;
        $data_total->ventes_client = 0 ;
        $data_total->versement_pompistes = 0 ;
        $data_total->manquant_pompiste = 0 ;
        $data_total->depense = 0 ;
        $data_total->ecart = 0 ;
        $data_total->ecart_gerant = 0 ;
        $data_total->vte_client = 0 ;
   
   
        foreach ($stations_unique as $key => $value) {
   
             $data = new stdClass();
             $station = $value ;
   
             $data->station = $value ;
             $data->region = '' ;
             $data->super = 0 ;
             $data->gasoil = 0 ;
             $data->petrole = 0 ;
             $data->tpc = 0 ;
             $data->total_carb = 0 ;
             $data->total_lub = 0 ;
             $data->total_attendu = 0 ;
             $data->versement = 0 ;
             $data->ventes_client = 0 ;
             $data->versement_pompistes = 0 ;
             $data->manquant_pompiste = 0 ;
             $data->depense = 0 ;
             $data->ecart = 0 ;
             $data->ecart_gerant = 0 ;
             $data->vte_client = 0 ;
   
   
   
             foreach ($data_carb as $key2 => $value2) {
                  
                       
               if ($value2->station == $station) {

                    $data->region = $value2->region ;
                    
                    if ($value2->produit == 'SUPER') {
   
                         $data->super += $value2->quantite ;
                         $data_total->super += $value2->quantite ;
   
                       } elseif ($value2->produit == 'GASOIL') {
   
                         $data->gasoil += $value2->quantite ;
                         $data_total->gasoil += $value2->quantite ;
   
                       } elseif ($value2->produit == 'PETROLE'){
                            
                         $data->petrole += $value2->quantite ;
                         $data_total->petrole += $value2->quantite ;
                       }
   
                       $data->tpc += $value2->quantite ;
                       $data->total_carb += $value2->montant ;

                       $data_total->tpc += $value2->quantite ;
                       $data_total->total_carb += $value2->montant ;
               }   
                       
             
             }
   
             foreach ($data_lub as $key3 => $value3) {
                  
                       
               if ($value3->station == $station) {

                    $data->total_lub += $value3->montant ;
                    $data_total->total_lub += $value3->montant ;
               }
                       
             }
   
             foreach ($data_vers as $key4 => $value4) {
                       
              if ($value4->station == $station) {
                   
                    $data->versement += $value4->montant ;
                    $data_total->versement += $value4->montant ;
              }
                  
             }
   
             foreach ($data_client as $key5 => $value5) {

   
               if ($value5->station == $station) {

                    $data->ventes_client += $value5->montant ;
                    
                    $data->vte_client += $value5->montant ;
                    $data_total->vte_client += $value5->montant ;
               }
                  
             }
   
             foreach ($data_vers_pompiste as $key6 => $value6) {
   
               if ($value6->station == $station) {
                    
                    $data->versement_pompistes += $value6->montant ;
                    $data_total->versement_pompistes += $value6->montant ;
               }
                 
             }
   
             foreach ($data_depenses as $key7 => $value7) {
                  
               if ($value7->station == $station) {
                    
                    $data->depense += $value7->montant ;
                    $data_total->depense += $value7->montant ;        
               }
                  
             }
   
   
             $data->total_attendu = $data->total_carb + $data->total_lub ;
             $data->ecart = $data->total_attendu - $data->versement ;
             $data->manquant_pompiste = $data->total_carb - $data->ventes_client - $data->versement_pompistes ;

             $data_total->total_attendu += ($data->total_carb + $data->total_lub) ;
             $data_total->ecart += ($data->total_attendu - $data->versement) ;
             $data_total->manquant_pompiste += ($data->total_carb - $data->ventes_client - $data->versement_pompistes) ;
   
             $data->ecart_gerant =  $data->ecart - $data->manquant_pompiste - $data->depense ;

             $data_total->ecart_gerant +=  ($data->ecart - $data->manquant_pompiste - $data->depense) ;
   
             foreach ($data_client as $key8 => $value8) {
   
              if ($value8->station == $station) {
                   
                    $data->ecart_gerant -= $value8->montant ;
                    $data_total->ecart_gerant -= $value8->montant ;
              }
   
             }
             
             $datas[] = $data ;
        }

        $datas[] = $data_total ;
   
   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      
   
       
}

function Etats_Ventes_Reseau_Mensuel() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $date_debut = date_create('first day of this month') ;
       $date_fin = date_create() ;
       
       $date_debut2 = date_format($date_debut, 'Y-m-d') ;
       $date_fin2 = date_format($date_fin, 'Y-m-d') ;

        $stations = [] ;
   
        /********************************************MANQUANTS******************************************************************* */
   
        $query_depenses = "
        
             Select
             Sum(station.depense_station.montant_depense) As montant,
             Date(station.quart.date_ouverture) As date,
             station.nom_station As station
        From
             depense_station Inner Join
             quart On depense_station.id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region
   
                  WHERE 
           
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        Group By
             
             Date(station.quart.date_ouverture),
             station.nom_station
        
        " ;
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "

        Select
        Date(station.quart.date_ouverture) As date,
        client.nom_client AS client,
        station.nom_station AS station,
        Sum(station.pompiste_has_client.montant) As montant,
        client.id_client
         From
         pompiste_has_client Inner Join
         quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
         station On station.quart.id_station = station.id_station
                   And station.quart.id_region = station.id_region Inner Join
         client On client.id_station = station.id_station
                   And client.id_region = station.id_region
                   And station.pompiste_has_client.client_id_client = client.id_client
    
                   WHERE 
           
                   (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                   (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )   
    
         Group By
         Date(station.quart.date_ouverture),
         client.nom_client,
         station.nom_station,
         client.id_client
             
             " ;
    
     /************************************************************************************************************************ */
    
         $query_vers_pompiste = " 
   
           Select
           Date(station.quart.date_ouverture) As date,
           station.nom_station As station,
           Sum(station.versement_pompiste.montant_versement) As montant
      From
      versement_pompiste Inner Join
      quart On versement_pompiste.id_quart = quart.id_quart Inner Join
      pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
      station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
                And station.pompiste.id_station = station.id_station
                And station.pompiste.id_region = station.id_region
      WHERE 
           
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
      Group By
           Date(station.quart.date_ouverture),
           station.nom_station
           
           
    
      " ;
   
   
        /******************** REQUETES MANQUANTS POMPISTES********************************************************************* */  
      
        $res_depenses = mysqli_query($conn, $query_depenses );
    
        $data_depenses = array();
    
        if (is_object($res_depenses)) {
    
    
              while($rows = mysqli_fetch_array($res_depenses))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_depenses[] = $obj ;
              
              }
    
    
        }
      
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->id_client = $rows['id_client'] ;
                        $obj->client = $rows['client'] ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
     $res_vers_pompiste = mysqli_query($conn, $query_vers_pompiste );
    
        $data_vers_pompiste = array();
    
        if (is_object($res_vers_pompiste)) {
    
    
              while($rows = mysqli_fetch_array($res_vers_pompiste))
    
              {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_vers_pompiste[] = $obj ;
    
              
              }
    
    
        }
    
     /******************************************************************************************************* */  
   
      
        $query = "
        
        Select
        Date(station.quart.date_ouverture) As date,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) *
        produit_station.prix_produit As montant,
        station.produit.nom_produit As produit,
        station.nom_station As station,
        region.nom_region AS region
     From
        pompiste_pistolet Inner Join
        pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
                And pompiste_pistolet.id_cuve = pistolet.id_cuve
                And pompiste_pistolet.id_station = pistolet.id_station
                And pompiste_pistolet.id_region = pistolet.id_region
                And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
        cuves On pistolet.id_cuve = cuves.id_cuve
                And pistolet.id_station = cuves.id_station
                And pistolet.id_region = cuves.id_region Inner Join
        produit On cuves.id_produit = produit.id_produit Inner Join
        quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region Inner Join
        produit_station On produit_station.id_produit = station.produit.id_produit
                And produit_station.id_station = station.id_station
                And produit_station.id_region = station.id_region Inner Join
        region On station.id_region = region.id_region
    
        WHERE 
            
        (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
        (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
    
         Group By
        Date(station.quart.date_ouverture),
        station.produit.nom_produit,
        station.nom_station,
        region.nom_region
            
        
        
        ";  
        /********************************************************************************************************************* */
   
        $query_Lub = "
   
        Select
        Date(station.quart.date_ouverture) As date,
        station.nom_station As station,
        produit.nom_produit AS produit,
        produit.conditionnement AS conditionnement,
        SUM(station.produit_quart.qte_vendu) AS quantite,
        produit_station.prix_produit AS prix_unitaire,
        Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
    From
        produit_quart Inner Join
        quart On produit_quart.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region Inner Join
        produit On station.produit_quart.id_produit = produit.id_produit Inner Join
        produit_station On produit_station.id_station = station.id_station
                And produit_station.id_region = station.id_region
                And produit_station.id_produit = produit.id_produit
 
                WHERE 
 
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
    Group By
 
        Date(station.quart.date_ouverture),
        station.nom_station
 
   
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
   
     " ;
       
    /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->quantite = intval($rows['quantite']) ;
                       $obj->produit = $rows['produit'] ;
                       $obj->station = $rows['station'] ;
                       $obj->region = $rows['region'] ;
                       $obj->montant = $rows['montant'] ;
   
                       $data_carb[] = $obj ;

                       $stations[] = $rows['station'] ;
        }
   
          
       }
   
    /****************************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query_Lub );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
   
             while($rows = mysqli_fetch_array($res_lub))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
             
             }
   
   
       }
   
    /******************************************************************************************************* */  
   
        $datas = array() ;
   
        $stations_unique = array_unique($stations) ;


        $data_total = new stdClass();
   
        $data_total->station = 'TOTAL' ;
        $data_total->super = 0 ;
        $data_total->gasoil = 0 ;
        $data_total->petrole = 0 ;
        $data_total->tpc = 0 ;
        $data_total->total_carb = 0 ;
        $data_total->total_lub = 0 ;
        $data_total->total_attendu = 0 ;
        $data_total->versement = 0 ;
        $data_total->ventes_client = 0 ;
        $data_total->versement_pompistes = 0 ;
        $data_total->manquant_pompiste = 0 ;
        $data_total->depense = 0 ;
        $data_total->ecart = 0 ;
        $data_total->ecart_gerant = 0 ;
        $data_total->vte_client = 0 ;
   
   
        foreach ($stations_unique as $key => $value) {
   
             $data = new stdClass();
             $station = $value ;
   
             $data->station = $value ;
             $data->region = '' ;
             $data->super = 0 ;
             $data->gasoil = 0 ;
             $data->petrole = 0 ;
             $data->tpc = 0 ;
             $data->total_carb = 0 ;
             $data->total_lub = 0 ;
             $data->total_attendu = 0 ;
             $data->versement = 0 ;
             $data->ventes_client = 0 ;
             $data->versement_pompistes = 0 ;
             $data->manquant_pompiste = 0 ;
             $data->depense = 0 ;
             $data->ecart = 0 ;
             $data->ecart_gerant = 0 ;
             $data->vte_client = 0 ;
   
   
   
             foreach ($data_carb as $key2 => $value2) {
                  
                       
               if ($value2->station == $station) {

                    $data->region = $value2->region ;
                    
                    if ($value2->produit == 'SUPER') {
   
                         $data->super += $value2->quantite ;
                         $data_total->super += $value2->quantite ;
   
                       } elseif ($value2->produit == 'GASOIL') {
   
                         $data->gasoil += $value2->quantite ;
                         $data_total->gasoil += $value2->quantite ;
   
                       } elseif ($value2->produit == 'PETROLE'){
                            
                         $data->petrole += $value2->quantite ;
                         $data_total->petrole += $value2->quantite ;
                       }
   
                       $data->tpc += $value2->quantite ;
                       $data->total_carb += $value2->montant ;

                       $data_total->tpc += $value2->quantite ;
                       $data_total->total_carb += $value2->montant ;
                    }   
                       
             
             }
   
             foreach ($data_lub as $key3 => $value3) {
                  
                       
               if ($value3->station == $station) {

                    $data->total_lub += $value3->montant ;
                    $data_total->total_lub += $value3->montant ;
               }
                       
             }
   
             foreach ($data_vers as $key4 => $value4) {
                       
              if ($value4->station == $station) {
                   
                    $data->versement += $value4->montant ;
                    $data_total->versement += $value4->montant ;
              }
                  
             }
   
             foreach ($data_client as $key5 => $value5) {

   
               if ($value5->station == $station) {

                    $data->ventes_client += $value5->montant ;
                    
                    $data->vte_client += $value5->montant ;
                    $data_total->vte_client += $value5->montant ;
               }
                  
             }
   
             foreach ($data_vers_pompiste as $key6 => $value6) {
   
               if ($value6->station == $station) {
                    
                    $data->versement_pompistes += $value6->montant ;
                    $data_total->versement_pompistes += $value6->montant ;
               }
                 
             }
   
             foreach ($data_depenses as $key7 => $value7) {
                  
               if ($value7->station == $station) {
                    
                    $data->depense += $value7->montant ;
                    $data_total->depense += $value7->montant ;        
               }
                  
             }
   
   
             $data->total_attendu = $data->total_carb + $data->total_lub ;
             $data->ecart = $data->total_attendu - $data->versement ;
             $data->manquant_pompiste = $data->total_carb - $data->ventes_client - $data->versement_pompistes ;

             $data_total->total_attendu += ($data->total_carb + $data->total_lub) ;
             $data_total->ecart += ($data->total_attendu - $data->versement) ;
             $data_total->manquant_pompiste += ($data->total_carb - $data->ventes_client - $data->versement_pompistes) ;
   
             $data->ecart_gerant =  $data->ecart - $data->manquant_pompiste - $data->depense ;

             $data_total->ecart_gerant +=  ($data->ecart - $data->manquant_pompiste - $data->depense) ;
   
             foreach ($data_client as $key8 => $value8) {
   
              if ($value8->station == $station) {
                   
                    $data->ecart_gerant -= $value8->montant ;
                    $data_total->ecart_gerant -= $value8->montant ;
              }
   
             }
             
             $datas[] = $data ;
        }

        $datas[] = $data_total ;
   
   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      
   
       
}

function Etats_Ventes_Station() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->ventes;
       $station = $requete ;
       $stations = [];
       $stations[] = $station ;
   
        $date_debut = date_create();
        $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
        $date_debut2 = date_format($date_debut, 'Y-m-d') ;

        $date_fin2 = $date_debut2 ;
   
      
   
        /********************************************MANQUANTS******************************************************************* */
   
        $query_depenses = "
        
             Select
             Sum(station.depense_station.montant_depense) As montant,
             Date(station.quart.date_ouverture) As date,
             station.nom_station As station
        From
             depense_station Inner Join
             quart On depense_station.id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region
   
                  WHERE 
           
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        Group By
             
             Date(station.quart.date_ouverture),
             station.nom_station
        
        " ;
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "
   
        Select
        Date(station.quart.date_ouverture) As date,
        client.nom_client AS client,
        station.nom_station AS station,
        Sum(station.pompiste_has_client.montant) As montant,
        client.id_client
         From
         pompiste_has_client Inner Join
         quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
         station On station.quart.id_station = station.id_station
                   And station.quart.id_region = station.id_region Inner Join
         client On client.id_station = station.id_station
                   And client.id_region = station.id_region
                   And station.pompiste_has_client.client_id_client = client.id_client
    
                   WHERE 
           
                   (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                   (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )   
    
         Group By
         Date(station.quart.date_ouverture),
         client.nom_client,
         station.nom_station,
         client.id_client
             
             " ;
    
     /************************************************************************************************************************ */
    
         $query_vers_pompiste = " 
   
           Select
           Date(station.quart.date_ouverture) As date,
          
           station.nom_station As station,
           Sum(station.versement_pompiste.montant_versement) As montant
      From
      versement_pompiste Inner Join
      quart On versement_pompiste.id_quart = quart.id_quart Inner Join
      pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
      station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
                And station.pompiste.id_station = station.id_station
                And station.pompiste.id_region = station.id_region
      WHERE 
           
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
      Group By
           Date(station.quart.date_ouverture),
          
           station.nom_station
           
           
    
      " ;
   
   
        /******************** REQUETES MANQUANTS POMPISTES********************************************************************* */  
      
        $res_depenses = mysqli_query($conn, $query_depenses );
    
        $data_depenses = array();
    
        if (is_object($res_depenses)) {
    
    
              while($rows = mysqli_fetch_array($res_depenses))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_depenses[] = $obj ;
                   }
              
              }
    
    
        }
      
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->id_client = $rows['id_client'] ;
                        $obj->client = $rows['client'] ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
     $res_vers_pompiste = mysqli_query($conn, $query_vers_pompiste );
    
        $data_vers_pompiste = array();
    
        if (is_object($res_vers_pompiste)) {
    
    
              while($rows = mysqli_fetch_array($res_vers_pompiste))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_vers_pompiste[] = $obj ;
    
                        
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */  
   
      
        $query = "
        
        Select
        Date(station.quart.date_ouverture) As date,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise))* produit_station.prix_produit As montant,
        station.produit.nom_produit As produit,
        station.nom_station As station
        
        From
        pompiste_pistolet Inner Join
        pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
                  And pompiste_pistolet.id_cuve = pistolet.id_cuve
                  And pompiste_pistolet.id_station = pistolet.id_station
                  And pompiste_pistolet.id_region = pistolet.id_region
                  And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
        cuves On pistolet.id_cuve = cuves.id_cuve
                  And pistolet.id_station = cuves.id_station
                  And pistolet.id_region = cuves.id_region Inner Join
        produit On cuves.id_produit = produit.id_produit Inner Join
        quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        produit_station On produit_station.id_produit = station.produit.id_produit
                  And produit_station.id_station = station.id_station
                  And produit_station.id_region = station.id_region
   
        WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
        Group By
        Date(station.quart.date_ouverture),
        station.produit.nom_produit,
        station.nom_station
        
        
        ";  
        /********************************************************************************************************************* */
   
        $query_Lub = "
   
          Select
     Date(station.quart.date_ouverture) As date,
     station.nom_station As station,
     Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
     From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit

               WHERE 
     
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     Group By
     Date(station.quart.date_ouverture),
     station.nom_station
    
   
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
   
     " ;
       
    /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->quantite = intval($rows['quantite']) ;
                       $obj->produit = $rows['produit'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = $rows['montant'] ;
   
                       $data_carb[] = $obj ;
   
             }
          
       }
   
    /****************************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query_Lub );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
   
             while($rows = mysqli_fetch_array($res_lub))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
                       
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */  
   
        $datas = array() ;
   
        
   
   
   
        foreach ($stations as $key => $value) {
   
             $data = new stdClass();
   
             $data->station = $value ;
             $data->super = 0 ;
             $data->gasoil = 0 ;
             $data->petrole = 0 ;
             $data->tpc = 0 ;
             $data->total_carb = 0 ;
             $data->total_lub = 0 ;
             $data->total_attendu = 0 ;
             $data->versement = 0 ;
             $data->ventes_client = 0 ;
             $data->versement_pompistes = 0 ;
             $data->manquant_pompiste = 0 ;
             $data->depense = 0 ;
             $data->ecart = 0 ;
             $data->ecart_gerant = 0 ;
             $data->vte_client = 0 ;
   
           
   
   
             foreach ($data_carb as $key2 => $value2) {
                  
                       
                       if ($value2->produit == 'SUPER') {
   
                            $data->super += $value2->quantite ;
   
                       } elseif ($value2->produit == 'GASOIL') {
   
                            $data->gasoil += $value2->quantite ;
   
                       } elseif ($value2->produit == 'PETROLE'){
                            
                            $data->petrole += $value2->quantite ;
                       }
   
                       $data->tpc += $value2->quantite ;
                       $data->total_carb += $value2->montant ;
                       
   
                  
             
             }
   
             foreach ($data_lub as $key3 => $value3) {
                  
                       
                       $data->total_lub += $value3->montant ;
                       
             }
   
             foreach ($data_vers as $key4 => $value4) {
                  
                       
                       $data->versement += $value4->montant ;
                       
             }
   
             foreach ($data_client as $key5 => $value5) {
                       
               $data->ventes_client += $value5->montant ;
               $data->vte_client += $value5->montant ;
                     
             }
   
             foreach ($data_vers_pompiste as $key6 => $value6) {
                  
   
                  $data->versement_pompistes += $value6->montant ;
             }
   
             foreach ($data_depenses as $key7 => $value7) {
                  
                       
                       $data->depense += $value7->montant ;
             }
   
   
             $data->total_attendu = $data->total_carb + $data->total_lub ;
             $data->ecart = $data->total_attendu - $data->versement ;
             $data->manquant_pompiste = $data->total_carb - $data->ventes_client - $data->versement_pompistes ;
   
             $data->ecart_gerant =  $data->ecart - $data->manquant_pompiste - $data->depense ;
   
             foreach ($data_client as $key8 => $value8) {
   
                  
   
                       $data->ecart_gerant -= $value8->montant ;
   
             }
             
             $datas[] = $data ;
        }
   
   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      }
      
       
}

function Etats_Ventes_Station_Mensuel() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input"));
   
      
       $requete = $data->ventes;
       $station = $requete ;
       $stations = [];
       $stations[] = $station ;
   
       $date_debut = date_create('first day of this month') ;
       $date_fin = date_create() ;
       
       $date_debut2 = date_format($date_debut, 'Y-m-d') ;
       $date_fin2 = date_format($date_fin, 'Y-m-d') ;
   
      
   
        /********************************************MANQUANTS******************************************************************* */
   
        $query_depenses = "
        
             Select
             Sum(station.depense_station.montant_depense) As montant,
             Date(station.quart.date_ouverture) As date,
             station.nom_station As station
        From
             depense_station Inner Join
             quart On depense_station.id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region
   
                  WHERE 
           
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        Group By
             
             Date(station.quart.date_ouverture),
             station.nom_station
        
        " ;
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "
   
        Select
        Date(station.quart.date_ouverture) As date,
        client.nom_client AS client,
        station.nom_station AS station,
        Sum(station.pompiste_has_client.montant) As montant,
        client.id_client
         From
         pompiste_has_client Inner Join
         quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
         station On station.quart.id_station = station.id_station
                   And station.quart.id_region = station.id_region Inner Join
         client On client.id_station = station.id_station
                   And client.id_region = station.id_region
                   And station.pompiste_has_client.client_id_client = client.id_client
    
                   WHERE 
           
                   (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                   (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )   
    
         Group By
         Date(station.quart.date_ouverture),
         client.nom_client,
         station.nom_station,
         client.id_client
             
             " ;
    
     /************************************************************************************************************************ */
    
         $query_vers_pompiste = " 
   
           Select
           Date(station.quart.date_ouverture) As date,
          
           station.nom_station As station,
           Sum(station.versement_pompiste.montant_versement) As montant
      From
      versement_pompiste Inner Join
      quart On versement_pompiste.id_quart = quart.id_quart Inner Join
      pompiste On versement_pompiste.id_pompiste = pompiste.id_pompiste Inner Join
      station On station.quart.id_station = station.id_station
                And station.quart.id_region = station.id_region
                And station.pompiste.id_station = station.id_station
                And station.pompiste.id_region = station.id_region
      WHERE 
           
                (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
      Group By
           Date(station.quart.date_ouverture),
          
           station.nom_station
           
           
    
      " ;
   
   
        /******************** REQUETES MANQUANTS POMPISTES********************************************************************* */  
      
        $res_depenses = mysqli_query($conn, $query_depenses );
    
        $data_depenses = array();
    
        if (is_object($res_depenses)) {
    
    
              while($rows = mysqli_fetch_array($res_depenses))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_depenses[] = $obj ;
                   }
              
              }
    
    
        }
      
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->id_client = $rows['id_client'] ;
                        $obj->client = $rows['client'] ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
     $res_vers_pompiste = mysqli_query($conn, $query_vers_pompiste );
    
        $data_vers_pompiste = array();
    
        if (is_object($res_vers_pompiste)) {
    
    
              while($rows = mysqli_fetch_array($res_vers_pompiste))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->montant = floatval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_vers_pompiste[] = $obj ;
    
                        
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */  
   
      
        $query = "
        
        Select
        Date(station.quart.date_ouverture) As date,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
        Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
        (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise))* produit_station.prix_produit As montant,
        station.produit.nom_produit As produit,
        station.nom_station As station
        
        From
        pompiste_pistolet Inner Join
        pistolet On pompiste_pistolet.id_pistolet = pistolet.id_pistolet
                  And pompiste_pistolet.id_cuve = pistolet.id_cuve
                  And pompiste_pistolet.id_station = pistolet.id_station
                  And pompiste_pistolet.id_region = pistolet.id_region
                  And pompiste_pistolet.id_pompe = pistolet.id_pompe Inner Join
        cuves On pistolet.id_cuve = cuves.id_cuve
                  And pistolet.id_station = cuves.id_station
                  And pistolet.id_region = cuves.id_region Inner Join
        produit On cuves.id_produit = produit.id_produit Inner Join
        quart On pompiste_pistolet.id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        produit_station On produit_station.id_produit = station.produit.id_produit
                  And produit_station.id_station = station.id_station
                  And produit_station.id_region = station.id_region
   
        WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
        Group By
        Date(station.quart.date_ouverture),
        station.produit.nom_produit,
        station.nom_station
        
        
        ";  
        /********************************************************************************************************************* */
   
        $query_Lub = "
   
        SELECT
        DATE(station.quart.date_ouverture)AS date,
        SUM(produit_quart.qte_vendu*produit.prix_produit) AS montant,
        station.nom_station AS station
        FROM
        produit_quart
        INNER JOIN quart ON produit_quart.id_quart = quart.id_quart
        INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
        INNER JOIN produit ON produit_quart.id_produit = produit.id_produit
        WHERE 
        
        (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
        (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
        
        GROUP BY
        
        DATE(station.quart.date_ouverture),
        station.nom_station
   
       
       " ;
   
    /************************************************************************************************************************ */
   
        $query_vers = " 
        
        SELECT
     DATE (quart.date_ouverture) AS date,
     station.nom_station AS station,
     SUM(versement_banque.montant_versement) AS montant
    FROM
     versement_banque
     INNER JOIN quart ON versement_banque.id_quart = quart.id_quart
     INNER JOIN station ON quart.id_station = station.id_station AND quart.id_region = station.id_region
     
    WHERE 
     
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
     
    GROUP BY
     
     DATE(station.quart.date_ouverture),
     station.nom_station
   
     " ;
       
    /************************************************************************************************** */
   
       $res_carb = mysqli_query($conn, $query );
   
       $data_carb = array();
   
       if (is_object($res_carb)) {
   
          while($rows = mysqli_fetch_array($res_carb))
   
        {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->quantite = intval($rows['quantite']) ;
                       $obj->produit = $rows['produit'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = $rows['montant'] ;
   
                       $data_carb[] = $obj ;
   
             }
          
       }
   
    /****************************************************************************************************************** */
   
       $res_lub = mysqli_query($conn, $query_Lub );
   
       $data_lub = array();
   
       if (is_object($res_lub)) {
   
   
             while($rows = mysqli_fetch_array($res_lub))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_lub[] = $obj ;
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */   
   
    $res_vers = mysqli_query($conn, $query_vers );
   
       $data_vers = array();
   
       if (is_object($res_vers)) {
   
   
             while($rows = mysqli_fetch_array($res_vers))
   
             {
                  if ($rows['station'] == $station) {
   
                       $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->montant = floatval($rows['montant']) ;
                       $obj->station = $rows['station'] ;
   
                       $data_vers[] = $obj ;
   
                       
                  }
             
             }
   
   
       }
   
    /******************************************************************************************************* */  
   
        $datas = array() ;
   
        foreach ($stations as $key => $value) {
   
             $data = new stdClass();
   
             $data->station = $value ;
             $data->super = 0 ;
             $data->gasoil = 0 ;
             $data->petrole = 0 ;
             $data->tpc = 0 ;
             $data->total_carb = 0 ;
             $data->total_lub = 0 ;
             $data->total_attendu = 0 ;
             $data->versement = 0 ;
             $data->ventes_client = 0 ;
             $data->versement_pompistes = 0 ;
             $data->manquant_pompiste = 0 ;
             $data->depense = 0 ;
             $data->ecart = 0 ;
             $data->ecart_gerant = 0 ;
             $data->vte_client = 0 ;
   
           
   
   
             foreach ($data_carb as $key2 => $value2) {
                  
                       
                       if ($value2->produit == 'SUPER') {
   
                            $data->super += $value2->quantite ;
   
                       } elseif ($value2->produit == 'GASOIL') {
   
                            $data->gasoil += $value2->quantite ;
   
                       } elseif ($value2->produit == 'PETROLE'){
                            
                            $data->petrole += $value2->quantite ;
                       }
   
                       $data->tpc += $value2->quantite ;
                       $data->total_carb += $value2->montant ;
                       
   
                  
             
             }
   
             foreach ($data_lub as $key3 => $value3) {
                  
                       
                       $data->total_lub += $value3->montant ;
                       
             }
   
             foreach ($data_vers as $key4 => $value4) {
                  
                       
                       $data->versement += $value4->montant ;
                       
             }
   
             foreach ($data_client as $key5 => $value5) {
                       
               $data->ventes_client += $value5->montant ;
               $data->vte_client += $value5->montant ;
                     
             }
   
             foreach ($data_vers_pompiste as $key6 => $value6) {
                  
   
                  $data->versement_pompistes += $value6->montant ;
             }
   
             foreach ($data_depenses as $key7 => $value7) {
                  
                       
                       $data->depense += $value7->montant ;
             }
   
   
             $data->total_attendu = $data->total_carb + $data->total_lub ;
             $data->ecart = $data->total_attendu - $data->versement ;
             $data->manquant_pompiste = $data->total_carb - $data->ventes_client - $data->versement_pompistes ;
   
             $data->ecart_gerant =  $data->ecart - $data->manquant_pompiste - $data->depense ;
   
             foreach ($data_client as $key8 => $value8) {
   
                  
   
                       $data->ecart_gerant -= $value8->montant ;
   
             }
             
             $datas[] = $data ;
        }
   
   
       print_r(json_encode($datas));
       return json_encode($datas);  
       
      }
      
       
}

function Etats_Stock_lubrifiant() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
      
       $requete = $data->stocks ;
       $station = $requete->station ;

        $stations = [] ;
        $produits = [] ;

        $stations [] = $station ;
        $dates = [] ;

        $date_debut = $date_fin = $client =  '' ;
       
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
       
        $dates = [] ;
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);

        $dates [] = date_format($date_debut, 'Y-m-d') ;

   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
        

     /****************************************************************************************************************************** */
     /********************************************************************************************************************* */

     $query_vte_lub = "

     Select
       Date(station.quart.date_ouverture) As date,
       station.nom_station As station,
       produit.nom_produit AS produit,
       produit.conditionnement AS conditionnement,
       SUM(station.produit_quart.qte_vendu) AS quantite,
       produit_station.prix_produit AS prix_unitaire,
       Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
   From
       produit_quart Inner Join
       quart On produit_quart.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit On station.produit_quart.id_produit = produit.id_produit Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit

               WHERE 

               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   Group By

       Date(station.quart.date_ouverture),
       station.nom_station,
       produit.nom_produit,
       produit.conditionnement,
       produit_station.prix_produit

    
    " ;

 /************************************************************************************************************************ */

    

     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    
     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

    
     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     
 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = floatval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->conditionnement = $rows['conditionnement'] ;
                    $obj->prix_unitaire = floatval($rows['prix_unitaire']) ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;

                    $produits[] = $rows['produit'] ;
               }
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = floatval($rows['quantite']) ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    $produits[] = $rows['produit'] ;

                    
               }
          
          }


    }

       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;

                     $produits[] = $rows['produit'] ;
 
                     
                }
           
           }
 
     }

     /******************************************************************************************************* */   

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;

                     $produits[] = $rows['produit'] ;
 
                     
                }
           
           }
 
 
     }
   /******************************************************************************************************************** */
     $produits_unique = array_unique($produits) ;
  
        $datas = array() ;

             foreach ($stations as $key => $value) {
                  
                    foreach ($produits_unique as $key10 => $value10) {

                         $data = new stdClass();

                         $data->station = $value ;
                         $data->produit = $value10 ;

                         $data->si = 0 ;
                         $data->liv = 0 ;
                         $data->vte = 0 ;
                         $data->st = 0 ;
                         $data->sf = 0 ;
                         $data->cou = 0 ;
                         $data->prix_unitaire = 0 ;
                         $data->montant = '' ;
                         $data->valeur_si = 0 ;
                         $data->valeur_liv = 0 ;
                         $data->valeur_vte = 0 ;
                         

                         foreach ($data_stock_ouverture_lub as $key2 => $value2) {
               
                              if ( $value2->station == $station && $value2->produit == $value10) {

                                   $data->si += $value2->quantite ;

                              }
                         }
                         

                         foreach ($data_livr_lub as $key4 => $value4) {
               
                              if ($value4->station == $station && $value4->produit == $value10) {

                                   $data->liv += $value4->quantite ;

                              }
                         }


                         foreach ($data_vte_lub as $key6 => $value6) {
               
                              if ($value6->station == $station && $value6->produit == $value10) {

                                   $data->vte += $value6->quantite ;
                                   $data->prix_unitaire = $value6->prix_unitaire ;

                              }
                         }
                        

                         foreach ($data_stock_fermerture_lub as $key8 => $value8) {
               
                              if ($value8->station == $station && $value8->produit == $value10) {

                                   $data->sf = $value8->quantite ;

                              }
                         }

                         
                         $data->st = $data->si + $data->liv - $data->vte ;
                         $data->cou = $data->sf - $data->st;
                         $data->montant = $data->st * $data->prix_unitaire ;
                         $data->valeur_si = $data->si * $data->prix_unitaire  ;
                         $data->valeur_liv = $data->liv * $data->prix_unitaire  ;
                         $data->valeur_vte = $data->vte * $data->prix_unitaire  ;
                         

                         /********************************************TOTAL COULAGES********************************************************* */
                         if (!($data->liv == 0 && $data->vte == 0)) {
                              
                              $datas[] = $data ;
                         }
                        
                    }
             }

       print_r(json_encode($datas));
       return json_encode($datas);  

       
}




function Etats_Stock_Gaz() { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     // $id_station = $_SESSION['id_station'];
        $id_region = $_SESSION['id_region'];
        $userId = $_SESSION['id_user'];
   
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
       $data = json_decode(file_get_contents("php://input")) ;
   
      
       $requete = $data->stocks ;
       $station = $requete->station ;

        $stations = [] ;
        $produits = [] ;

        $stations [] = $station ;
        $dates = [] ;

        $date_debut = $date_fin = $client =  '' ;
       
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
       
        $dates = [] ;
       
        $date_debut = date_create($date_debut);
        $date_fin = date_create($date_fin);

        $dates [] = date_format($date_debut, 'Y-m-d') ;

   
        while ($date_debut < $date_fin) {
             
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }
   
        

     /****************************************************************************************************************************** */
     /********************************************************************************************************************* */

     $query_vte_lub = "

     Select
       Date(station.quart.date_ouverture) As date,
       station.nom_station As station,
       produit.nom_produit AS produit,
       produit.conditionnement AS conditionnement,
       SUM(station.produit_quart.qte_vendu) AS quantite,
       produit_station.prix_produit AS prix_unitaire,
       Sum(station.produit_quart.qte_vendu * produit_station.prix_produit) As montant
   From
       produit_quart Inner Join
       quart On produit_quart.id_quart = quart.id_quart Inner Join
       station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region Inner Join
       produit On station.produit_quart.id_produit = produit.id_produit Inner Join
       produit_station On produit_station.id_station = station.id_station
               And produit_station.id_region = station.id_region
               And produit_station.id_produit = produit.id_produit

               WHERE 

               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
               produit.type_produit='GAZ12.5GK' ||  produit.type_produit='BTLE_GAZ12.5GK'
   Group By

       Date(station.quart.date_ouverture),
       station.nom_station,
       produit.nom_produit,
       produit.conditionnement,
       produit_station.prix_produit

    
    " ;

 /************************************************************************************************************************ */

    

     $query_livr_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(livraison_lubrifiant_gaz.qte_recu) As quantite,
     Sum(livraison_lubrifiant_gaz.qte_recu * produit.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     livraison Inner Join
     quart On livraison.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region Inner Join
     produit On produit_station.id_produit = produit.id_produit Inner Join
     livraison_lubrifiant_gaz On livraison_lubrifiant_gaz.id_livraison = station.livraison.id_livraison
             And livraison_lubrifiant_gaz.id_station = station.id_station
             And livraison_lubrifiant_gaz.id_region = station.id_region
             And livraison_lubrifiant_gaz.id_produit = produit.id_produit

             WHERE 
     
             (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
 Group By
     Date(station.quart.date_ouverture),
     produit.nom_produit,
     station.nom_station
     
    

     " ;
    
     $query_stock_ouverture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_ouverture) As quantite,
     Sum(station.produit_quart.stock_ouverture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '07:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
     produit.type_produit='GAZ12.5GK' ||  produit.type_produit='BTLE_GAZ12.5GK'
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

    
     $query_stock_fermerture_lub = " 

     Select
     Date(station.quart.date_ouverture) As date,
     Sum(station.produit_quart.stock_fermerture) As quantite,
     Sum(station.produit_quart.stock_fermerture * produit_station.prix_produit) As montant,
     produit.nom_produit As produit,
     station.nom_station As station
 From
     produit_quart Inner Join
     quart On produit_quart.id_quart = quart.id_quart Inner Join
     station On station.quart.id_station = station.id_station
             And station.quart.id_region = station.id_region Inner Join
     produit On station.produit_quart.id_produit = produit.id_produit Inner Join
     produit_station On produit_station.id_station = station.id_station
             And produit_station.id_region = station.id_region
             And produit_station.id_produit = produit.id_produit
 Where
     Time(station.quart.date_ouverture) = '17:00:00' AND
     (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
     (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
     produit.type_produit='GAZ12.5GK' ||  produit.type_produit='BTLE_GAZ12.5GK'
 Group By
     produit.nom_produit,
     station.nom_station,
     DATE(station.quart.date_ouverture)

     " ;

     
 /****************************************************************************************************************** */

    $res_vte_lub = mysqli_query($conn, $query_vte_lub );

    $data_vte_lub = array();

    if (is_object($res_vte_lub)) {


          while($rows = mysqli_fetch_array($res_vte_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = floatval($rows['quantite']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->conditionnement = $rows['conditionnement'] ;
                    $obj->prix_unitaire = floatval($rows['prix_unitaire']) ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->station = $rows['station'] ;

                    $data_vte_lub[] = $obj ;

                    $produits[] = $rows['produit'] ;
               }
          
          }


    }

    /**************************************************************************************************************************** */

    $res_livr_lub = mysqli_query($conn, $query_livr_lub);

    $data_livr_lub = array();

    if (is_object($res_livr_lub)) {


          while($rows = mysqli_fetch_array($res_livr_lub))

          {
               if ($rows['station'] == $station) {

                    $obj = new stdClass();

                    $obj->date = $rows['date'] ;
                    $obj->quantite = floatval($rows['quantite']) ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->produit = $rows['produit'] ;
                    $obj->station = $rows['station'] ;

                    $data_livr_lub[] = $obj ;

                    $produits[] = $rows['produit'] ;

                    
               }
          
          }


    }

       
     /********************************************************************************************************************* */
    
     $res_stock_ouverture_lub = mysqli_query($conn, $query_stock_ouverture_lub);

     $data_stock_ouverture_lub = array();
 
     if (is_object($res_stock_ouverture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_ouverture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_ouverture_lub[] = $obj ;

                     $produits[] = $rows['produit'] ;
 
                     
                }
           
           }
 
     }

     /******************************************************************************************************* */   

     $res_stock_fermerture_lub = mysqli_query($conn, $query_stock_fermerture_lub);

     $data_stock_fermerture_lub = array();
 
     if (is_object($res_stock_fermerture_lub)) {
 
 
           while($rows = mysqli_fetch_array($res_stock_fermerture_lub))
 
           {
                if ($rows['station'] == $station) {
 
                     $obj = new stdClass();
 
                     $obj->date = $rows['date'] ;
                     $obj->quantite = floatval($rows['quantite']) ;
                     $obj->montant = floatval($rows['montant']) ;
                     $obj->produit = $rows['produit'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_stock_fermerture_lub[] = $obj ;

                     $produits[] = $rows['produit'] ;
 
                     
                }
           
           }
 
 
     }
   /******************************************************************************************************************** */
     $produits_unique = array_unique($produits) ;
  
        $datas = array() ;

             foreach ($stations as $key => $value) {
                  
                    foreach ($produits_unique as $key10 => $value10) {

                         $data = new stdClass();

                         $data->station = $value ;
                         $data->produit = $value10 ;

                         $data->si = 0 ;
                         $data->liv = 0 ;
                         $data->vte = 0 ;
                         $data->st = 0 ;
                         $data->sf = 0 ;
                         $data->cou = 0 ;
                         $data->prix_unitaire = 0 ;
                         $data->montant = '' ;
                         $data->valeur_si = 0 ;
                         $data->valeur_liv = 0 ;
                         $data->valeur_vte = 0 ;
                         

                         foreach ($data_stock_ouverture_lub as $key2 => $value2) {
               
                              if ( $value2->station == $station && $value2->produit == $value10) {

                                   $data->si += $value2->quantite ;

                              }
                         }
                         

                         foreach ($data_livr_lub as $key4 => $value4) {
               
                              if ($value4->station == $station && $value4->produit == $value10) {

                                   $data->liv += $value4->quantite ;

                              }
                         }


                         foreach ($data_vte_lub as $key6 => $value6) {
               
                              if ($value6->station == $station && $value6->produit == $value10) {

                                   $data->vte += $value6->quantite ;
                                   $data->prix_unitaire = $value6->prix_unitaire ;

                              }
                         }
                        

                         foreach ($data_stock_fermerture_lub as $key8 => $value8) {
               
                              if ($value8->station == $station && $value8->produit == $value10) {

                                   $data->sf = $value8->quantite ;

                              }
                         }

                         
                         $data->st = $data->si + $data->liv - $data->vte ;
                         $data->cou = $data->sf - $data->st;
                         $data->montant = $data->st * $data->prix_unitaire ;
                         $data->valeur_si = $data->si * $data->prix_unitaire  ;
                         $data->valeur_liv = $data->liv * $data->prix_unitaire  ;
                         $data->valeur_vte = $data->vte * $data->prix_unitaire  ;
                         

                         /********************************************TOTAL COULAGES********************************************************* */
                         if (!($data->liv == 0 && $data->vte == 0)) {
                              
                              $datas[] = $data ;
                         }
                        
                    }
             }

       print_r(json_encode($datas));
       return json_encode($datas);  

       
}



function Etats_Creances_Station2($p_date_debut, $p_date_fin, $p_station) { 

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
    
    // connect DB
    $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
      // $data = json_decode(file_get_contents("php://input"));
   
      
        $date_init = new DateTime($p_date_debut);
        $date_init2 = $date_init->modify("-1 day");
        $date_initiale = $date_init2->format("Y-m-d");
   
        $date_debut = new DateTime($p_date_debut);
      //  $date_debut = $date_debut->modify("first day of this month");
        $date_debut2 = $date_debut->format("Y-m-d");

        $date_fin = date_create($p_date_fin);
        $date_fin2 = date_format($date_fin, 'Y-m-d');

        $station = $p_station ;

        // $dates [] = date_format($date_debut, 'Y-m-d') ;

         
       $clients = array() ;

       $res_clients=mysqli_query($conn, "
   
               Select
               client.nom_client,
               client.code_client,
               client.solde_initial,
               client.solde_client,
               station.code_station As station
          From
               client Inner Join
               station On client.id_station = station.id_station
                         And client.id_region = station.id_region

          Where station.code_station = '$station'
          
          Group By
               client.code_client,
               station.code_station
          
               " ) ;
   
   
       
        if (is_object($res_clients)) {
   
           while($rows = mysqli_fetch_array($res_clients))
   
          {
            $clients[] = array(
   
             "nom_client"  =>   $rows['nom_client'],
             "code_client"  =>   $rows['code_client'],
             "solde_initial"  =>   $rows['solde_initial'],
             "solde_client"  =>   $rows['solde_client'],
             "nom_station"  =>   $rows['station']
                 
                      ) ;
          }
        }
       
     /********************************************************************************************************************* */
    
        $query_client_terme = "
   
        Select
       Date(station.quart.date_ouverture) As date,
       client.nom_client AS client,
       station.code_station AS station,
       Sum(station.pompiste_has_client.quantite) As quantite,
       Sum(station.pompiste_has_client.montant) As montant
     
        From
        pompiste_has_client Inner Join
        quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
        station On station.quart.id_station = station.id_station
                  And station.quart.id_region = station.id_region Inner Join
        client On client.id_station = station.id_station
                  And client.id_region = station.id_region
                  And station.pompiste_has_client.client_id_client = client.id_client

                  WHERE 
        
                  (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
                  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )
   
                 
   
        Group By
        Date(station.quart.date_ouverture),
        client.nom_client,
        station.code_station
       
             
             " ;


             $query_client_init = "
   
             Select
            Date(station.quart.date_ouverture) As date,
            client.nom_client AS client,
           
            station.code_station AS station,
            Sum(station.pompiste_has_client.quantite) As quantite,
            Sum(station.pompiste_has_client.montant) As montant
          
             From
             pompiste_has_client Inner Join
             quart On pompiste_has_client.quart_id_quart = quart.id_quart Inner Join
             station On station.quart.id_station = station.id_station
                       And station.quart.id_region = station.id_region Inner Join
             client On client.id_station = station.id_station
                       And client.id_region = station.id_region
                       And station.pompiste_has_client.client_id_client = client.id_client
     
                       WHERE 
             
                       (DATE( station.quart.date_fermerture ) <= '$date_initiale' )
        
                      
        
             Group By
             Date(station.quart.date_ouverture),
             client.nom_client,
             station.code_station
            
                  
                  " ;
    
    
     /****************************************************************************************************************** */
    
        $res_client_terme = mysqli_query($conn, $query_client_terme );
    
        $data_client = array();
    
        if (is_object($res_client_terme)) {
    
    
              while($rows = mysqli_fetch_array($res_client_terme))
    
              {
                   if ($rows['station'] == $station  ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->client = $rows['client'] ;
                        $obj->quantite = intval($rows['quantite']) ;
                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client[] = $obj ;
                   }
              
              }
    
    
        }


        $res_client_init = mysqli_query($conn, $query_client_init );
    
        $data_client_init = array();
    
        if (is_object($res_client_init)) {
    
    
              while($rows = mysqli_fetch_array($res_client_init))
    
              {
                   if ($rows['station'] == $station ) {
    
                        $obj = new stdClass();
    
                        $obj->date = $rows['date'] ;
                        $obj->client = $rows['client'] ;
                        $obj->quantite = intval($rows['quantite']) ;

                        $obj->montant = intval($rows['montant']) ;
                        $obj->station = $rows['station'] ;
    
                        $data_client_init[] = $obj ;
                   }
              
              }
    
    
        }
    
     /******************************************************************************************************* */   
    
      
        $query_reglement = "
        
        Select
  
        DATE(station.reglement.date_reglement) AS date,
        station.client.nom_client AS client, 
        station.code_station As station,
        Sum(station.reglement.montant_reglement) As montant
        
    From
        reglement Inner Join
        client On reglement.id_client = client.id_client Inner Join
        station On station.reglement.id_station = station.id_station
                And station.reglement.id_region = station.id_region
               
                And station.client.id_station = station.id_station
                And station.client.id_region = station.id_region
                WHERE 
        
                (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' ) AND
                (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' )
    Group By
        Date(station.reglement.date_reglement),
        station.client.nom_client,
        station.code_station
        
               
        
        ";  

        $query_reglement_init = "
          
        Select
  
        DATE(station.reglement.date_reglement) AS date,
        station.client.nom_client AS client, 
        station.code_station As station,
        Sum(station.reglement.montant_reglement) As montant
        
    From
        reglement Inner Join
        client On reglement.id_client = client.id_client Inner Join
        station On station.reglement.id_station = station.id_station
                And station.reglement.id_region = station.id_region
               
                And station.client.id_station = station.id_station
                And station.client.id_region = station.id_region

                WHERE 
             
                (DATE( station.reglement.date_reglement) <= '$date_initiale' )
    Group By
        Date(station.reglement.date_reglement),
        station.client.nom_client,
        station.code_station
        
          
     
     ";  
        /********************************************************************************************************************* */
   
   
       $res_reglement_init = mysqli_query($conn, $query_reglement_init );
   
       $data_reglement_init = array();
   
       if (is_object($res_reglement_init)) {
   
          while($rows = mysqli_fetch_array($res_reglement_init))
   
         {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->client = $rows['client'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = intval($rows['montant']) ;
   
                       $data_reglement_init[] = $obj ;
   
              }
          
          }

       }

       $res_reglement = mysqli_query($conn, $query_reglement );
   
       $data_reglement = array();
   
       if (is_object($res_reglement)) {
   
          while($rows = mysqli_fetch_array($res_reglement))
   
         {
             if ($rows['station'] == $station) {
   
                  $obj = new stdClass();
   
                       $obj->date = $rows['date'] ;
                       $obj->client = $rows['client'] ;
                       $obj->station = $rows['station'] ;
                       $obj->montant = intval($rows['montant']) ;
   
                       $data_reglement[] = $obj ;
   
             }
          
         }
       }

   
        $datas = array() ;
   
   
        foreach ($clients as $key => $value) {

               

               $data = new stdClass();

             $client =  $value['nom_client'] ;

             $montant = 0 ;
             $reglement = 0 ;

             $solde_initial = $value['solde_initial'] ;
             
             $data->code_client = $value['code_client'] ;
             $data->client = $value['nom_client'] ;
             $data->solde_anterieur = 0 ;
             $data->conso = 0 ;
             $data->montant = 0 ;
             $data->reglement = 0 ;
             $data->station = '' ;
             $data->solde = 0 ;

            
             foreach ($data_client as $key5 => $value5) {
   
                  
                  if ($value5->station == $station && $value5->client == $client) {
   
                    $data->conso += $value5->quantite ;
                    $data->montant += $value5->montant ;
                    $data->station = $value5->station ;
                      
                  }
             }

             foreach ($data_client_init as $key6 => $value6) {
                  
               if ($value6->station == $station && $value6->client == $client) {

                 $montant += $value6->montant ;
                   
               }
             }
   
             foreach ($data_reglement as $key8 => $value8) {
   
                  
                  if ($value8->station == $station && $value8->client == $client) {
   
                       $data->reglement += $value8->montant ;
                       $data->station = $value8->station ;
   
                  }
             }

             foreach ($data_reglement_init as $key9 => $value9) {
   
               if ($value9->station == $station && $value9->client == $client) {

                    $reglement += $value9->montant ;

               }
             }

             $data->solde_anterieur = $solde_initial + $montant - $reglement ;
             $data->solde =  $data->solde_anterieur + $data->montant - $data->reglement ;

             if ($data->solde !== 0 ) {
                  
                 $datas[] = $data ;
             }
             

           
             


          
   
        }

   
      // print_r(json_encode($datas));
       return $datas ;  
       
       
}

function addRgt_cli() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
        // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $data = json_decode(file_get_contents("php://input"));

       $donnees  = $data->client ; 

       $type_reglement = $donnees->type_reglement ;
       $libelle_reglement = $donnees->libelle_reglement ;
       $montant_reglement = $donnees->montant ;
       $date_reglement = new DateTime($donnees->date_fin);  
       $date_reglement = $date_reglement->format("Y-m-d");
       $id_client = $donnees->client->id_client ;
       $nom_station = $donnees->station ;
   
       $res=mysqli_query($conn, "CALL add_rgt_client('$type_reglement', '$libelle_reglement', $montant_reglement, '$date_reglement', $id_client, '$nom_station', $id_region, $userId)");
   
       if ($res == false) {

          $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
             $jsn = json_encode($arr);
             print_r($jsn);
             return json_encode($jsn);  
          
        }

           $arr = array('msg' =>  '' , 'error' => 'Error In inserting record');
           $jsn = json_encode($arr);
           print_r($jsn);

        return json_encode($jsn); 
           
       
}

function getRgt_cli() {

     $host_name = 'localhost';
     $database = 'station';
     $user_name = 'station';
     $password = 'station';
   
     $id_station = $_SESSION['id_station'];
     $id_region = $_SESSION['id_region'];
     $userId = $_SESSION['id_user'];
   
        // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
   
        $data = json_decode(file_get_contents("php://input"));

       $donnees  = $data->client ; 

       $date_debut = new DateTime($donnees->date_debut);  
       $date_debut = $date_debut->format("Y-m-d");
      
       $date_fin = new DateTime($donnees->date_fin);  
       $date_fin = $date_fin->format("Y-m-d");

       $id_client = $donnees->client->id_client ;
       $nom_station = $donnees->station ;
   
       $res1=mysqli_query($conn, "
       
     Select
     Date(station.quart.date_ouverture) As date,
     station.reglement.type_reglement,
     station.reglement.montant_reglement AS montant,
     station.reglement.libelle_reglement AS libelle,
     station.nom_station,
     station.client.nom_client,
     station.client.code_client,
     station.reglement.userName
     From
     reglement Inner Join
     quart On reglement.id_quart = quart.id_quart Inner Join
     client On reglement.id_client = client.id_client Inner Join
     station On station.reglement.id_station = station.id_station
               And station.reglement.id_region = station.id_region
               And station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region
               And station.client.id_station = station.id_station
               And station.client.id_region = station.id_region 
     Where
     station.station.nom_station = '$nom_station' And
     station.client.id_client = '$id_client' and
     
     (DATE( station.quart.date_ouverture ) between '$date_debut' AND '$date_fin' ) AND
          (DATE( station.quart.date_fermerture ) between '$date_debut' AND '$date_fin' )
    
    ");

     $data1 = array();
    
     if (is_object($res1)) {

        while($rows = mysqli_fetch_array($res1))
       //mysqli_free_result($res);
      {

         $data1[] = array(

          "date"  => $rows['date'],
          "nom_client"  => $rows['nom_client'],
          "code_client"  => $rows['code_client'],
          "nom_station"  => $rows['nom_station'],
          "type_reglement"  => $rows['type_reglement'],
          "montant"  => $rows['montant'],
          "libelle"  => $rows['libelle'],
          "userName"  => $rows['userName']
                          
                     ) ;  
     }

     print_r(json_encode($data1));
     return json_encode($data1);  
    }
    else {
        $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In inserting record');
         $jsn = json_encode($arr);
         print_r($jsn);
     return json_encode($jsn);  
           
    }
}
    
 
   




?>


