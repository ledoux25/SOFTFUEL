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

  switch($_GET['action'])  {

    case 'get_lubrifiants' :
          get_lubrifiants();
          break;

    case 'add_lubrifiant' :
          add_lubrifiant();
          break;

    case 'edit_lubrifiant' :
          edit_lubrifiant();
          break;
}


  function get_lubrifiants() {

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
        id_produit,
        code_produit,
        nom_produit,
        conditionnement,
        type_produit,
        prix_produit
      From
        produit
      Where 
      type_produit = 'LUBRIFIANT'
        "
      );
  
      $data = array();
      
       if (is_object($res)) {
  
          while($rows = mysqli_fetch_array($res))
  
        {
           $data[] = array(
  
                 "id_produit"  => $rows['id_produit'],
                 "code_produit"  => $rows['code_produit'],
                  "nom_produit"  => $rows['nom_produit'],
                  "conditionnement"  => $rows['conditionnement'],
                  "type_produit"  => $rows['type_produit'],
                  "prix_produit"  => $rows['prix_produit'],
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

function add_lubrifiant() {
  $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';

  // Connect to the database
  $conn = mysqli_connect($host_name, $user_name, $password, $database);

  // Get the data from the request
  $data = json_decode(file_get_contents("php://input"));

  $produit     = $data->produit;


  //  var_dump($pompiste) ;
  
   $nom_produit = $produit ->nom_produit;
   $code_produit = $produit ->code_produit;
   $conditionnement = $produit ->conditionnement;

   $checkQuery = "SELECT * FROM produit WHERE code_produit = '$code_produit'";
   $checkResult = mysqli_query($conn, $checkQuery);
   if (mysqli_num_rows($checkResult) > 0) {
       $arr = array('msg' => $errorMessage, 'error' => 'Le code ou le nom que vous avez inserer existe deja');
       $jsn = json_encode($arr);
       print_r($jsn);
       return json_encode($jsn);
   }
   
          
          $res = mysqli_query($conn, "CALL add_lubrifiant('$code_produit', '$nom_produit','$conditionnement')");
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

function edit_lubrifiant() {

  $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';


  // connect DB
  $conn=mysqli_connect($host_name, $user_name, $password, $database);

  $data = json_decode(file_get_contents("php://input"));
  //   print_r($data)   ;
  

  $produit     = $data->produit;


  //  var_dump($pompiste) ;
  
   $nom_produit = $produit ->nom_produit;
   $code_produit = $produit ->code_produit;
   $conditionnement = $produit ->conditionnement;



  
       $res=mysqli_query($conn, "CALL edit_lubrifiant('$code_produit', '$nom_prouduit', '$conditionnement')");
            if ($res == false) {

            $arr = array('msg' =>  mysqli_error($conn) , 'error' => 'Error In modifying record');
                 $jsn = json_encode($arr);
                 print_r($jsn);
                 return json_encode($jsn);  
            }
  


  $arr = array('msg' => '' , 'error' => 'Error In inserting record');
  $jsn = json_encode($arr);
  print_r($jsn);
  return json_encode($jsn);  

  
}


?>
