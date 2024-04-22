<?php


 ob_start();
 session_start();

 require 'vendor/autoload.php';

 use PhpOffice\PhpSpreadsheet\Spreadsheet;
 use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

 

 require 'TCPDF/tcpdf.php';          // php file to pdf

  $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';

  $conn=mysqli_connect($host_name, $user_name, $password, $database);

  $id_station = $_SESSION['id_station'];
  $id_region = $_SESSION['id_region'];
  $userId = $_SESSION['id_user'];
  $userEmail = $_SESSION['userEmail'];

  $today = new datetime() ;
  $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );
  $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
 
  /**  Switch Case to Get Action from controller  **/
 
 switch($_GET['action'])  {
 
     case 'Etats_Ventes_Export' :
          Etats_Ventes_Export();
          break;

     case 'Etats_Manquants_Export' :
          Etats_Manquants_Export();
          break;


     case 'Etats_Ventes_Reseau_Conso' :
          Etats_Ventes_Reseau_Conso();
          break;

     case 'Etats_Versements_ME' :
          Etats_Versements_ME();
          break;

     case 'Etats_Versements' :
            Etats_Versements();
            break;

    case 'Etats_Versements_Excel' :
            Etats_Versements_Excel();
            break;

     case 'Equation_Stock_Carb_Pdf' :
            Equation_Stock_Carb_Pdf();
            break;

    case 'Equation_Stock_Carb_Pdf_Valeur' :
            Equation_Stock_Carb_Pdf_Valeur();
            break;

            case 'Vente_Reseau_Carb_Pdf' :
              Vente_Reseau_Carb_Pdf();
              break;

              case 'coulage_Reseau_Carb_Pdf' :
                coulage_Reseau_Carb_Pdf();
                break;

     case 'Equation_Stock_Lub_Pdf' :
            Equation_Stock_Lub_Pdf();
            break;

     case 'Equation_Stock_Carb_Excel' :
            Equation_Stock_Carb_Excel();
            break;

      case 'Manquant_Station_Excel' :
            Manquant_Station_Excel();
            break;

      case 'Etats_Coulages_Reseau_Pdf' :
            Etats_Coulages_Reseau_Pdf();
            break;

      case 'Etats_Coulages_Reseau_Excel' :
            Etats_Coulages_Reseau_Excel();
            break;

      case 'Ventes_Conso_Excel' :
            Ventes_Conso_Excel();
            break;
    
 }

function Etats_Ventes_Export() { 

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
        $format = $requete->format ;
   
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

         
        $fp = fopen("data_etat_ventes.json", "w");
        fwrite($fp, json_encode($datas->corps));
        fclose($fp);

        
       // include 'export_etat_ventes.php' ;

       $username = 'user';
       $password = 'bitnami';

       $payloadName = '

       {
         "reportUnitUri": "/themes/Etat_Ventes_Carburant",
         "async": false,
         "freshData": true,
         "saveDataSnapshot": false,
         "outputFormat": "'.$format.'",
         "interactive": false,
         "ignorePagination": false,
         "parameters": {
             "reportParameter": [
              {
                   "name": "date_debut",
                   "value": ["'.$date_debut2.'"]
               },

               {
                   "name": "date_fin",
                   "value": ["'.$date_fin2.'"]
               },

               {
                   "name": "station",
                   "value": ["'.$station.'"]
               }


             ]
         }
     }
       
       ' ;


     
       $host = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions' ;
       $ch = curl_init($host);
       
       curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
       curl_setopt($ch, CURLOPT_TIMEOUT, 90);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
       curl_setopt($ch,  CURLOPT_HEADER,  1);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
         'Accept: application/json',
         'Content-Type: application/json')                                                           
     ); 



     if(curl_exec($ch) === false)
     {
         echo 'Curl error: ' . curl_error($ch);
     }                                                                                                      
     $errors = curl_error($ch);                                                                                                            
     $result = curl_exec($ch);

     // get cookies

    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
    }

    /*
    $headerArr = explode(PHP_EOL, $headerstring);
   foreach ($headerArr as $headerRow) {
       preg_match('/([a-zA-Z\-]+):\s(.+)$/',$headerRow, $matches);
       if (!isset($matches[0])) {
           continue;
       }
       $header[$matches[1]] = $matches[2];
   }
   */

   

    $cookie = $cookies['JSESSIONID'] ;

    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerstring = substr($result, 0, $header_size);
    $body = substr($result, $header_size);


     $result2 = json_decode($body) ;
     
       $login = 'user';
       $password = 'bitnami';
       $url = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions/'.$result2->requestId.'/exports/'.$result2->exports[0]->id.'/outputResource' ;
       $ch2 = curl_init();
       curl_setopt($ch2, CURLOPT_URL,$url);
       curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
       curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       curl_setopt($ch2, CURLOPT_USERPWD, "$login:$password");
       curl_setopt($ch2, CURLOPT_HTTPHEADER, array(   
         'Accept: application/json',
        
         "Cookie: JSESSIONID=$cookie")                                                           
     ); 


       $result3 = curl_exec($ch2);

       $returnCode = (int)curl_getinfo($ch2, CURLINFO_HTTP_CODE);

       curl_close($ch2);  

       $file_name = "etat_ventes.".$format ;

       $fp = fopen($file_name, "w");

       fwrite($fp, $result3);
       fclose($fp);

       $result = array("status" => "OK");
      

       print_r(json_encode($result));
       return json_encode($result);  
       
      }
       
}

function Etats_Manquants_Export() { 

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
   
      
       $requete = $data->manquants;
   
       $date_debut = $date_fin = $quart = $station = "";
   
        $date_debut = $requete->date_debut ;
        $date_fin = $requete->date_fin ;
        $quart = $requete->quart ;
        $station = $requete->station ;
        $format = $requete->format ;
   
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

   
      $datas = array() ;
      $datas2 = array() ;
     
     // GESTION LIGNES

   
             foreach ($dates as $key2 => $value2) {
                  

               foreach ($pompistes_unique as $key => $value) {

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
     

                    $datas[] = $data ;
               }
                      
               

             
             }


       /*************************EXPORT MANQUANTS POMPISTES********************************* */
         
        $fp = fopen("data_etat_manquants.json", "w");
        fwrite($fp, json_encode($datas));
        fclose($fp);

       $username = 'user';
       $password = 'bitnami';

       $payloadName = '

       {
         "reportUnitUri": "/reports/Etat_Ventes_Manquants",
         "async": false,
         "freshData": true,
         "saveDataSnapshot": false,
         "outputFormat": "'.$format.'",
         "interactive": false,
         "ignorePagination": false,
         "parameters": {
             "reportParameter": [
              {
                   "name": "date_debut",
                   "value": ["'.$date_debut2.'"]
               },

               {
                   "name": "date_fin",
                   "value": ["'.$date_fin2.'"]
               },

               {
                   "name": "station",
                   "value": ["'.$station.'"]
               }


             ]
         }
     }
       
       ' ;


     
       $host = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions' ;
       $ch = curl_init($host);
       
       curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
       curl_setopt($ch, CURLOPT_TIMEOUT, 90);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
       curl_setopt($ch,  CURLOPT_HEADER,  1);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
         'Accept: application/json',
         'Content-Type: application/json')                                                           
     ); 



     if(curl_exec($ch) === false)
     {
         echo 'Curl error: ' . curl_error($ch);
     }                                                                                                      
     $errors = curl_error($ch);                                                                                                            
     $result = curl_exec($ch);

     // get cookies

    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
    }

    /*
    $headerArr = explode(PHP_EOL, $headerstring);
   foreach ($headerArr as $headerRow) {
       preg_match('/([a-zA-Z\-]+):\s(.+)$/',$headerRow, $matches);
       if (!isset($matches[0])) {
           continue;
       }
       $header[$matches[1]] = $matches[2];
   }
   */

   

    $cookie = $cookies['JSESSIONID'] ;

    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerstring = substr($result, 0, $header_size);
    $body = substr($result, $header_size);


     $result2 = json_decode($body) ;
     
       $login = 'user';
       $password = 'bitnami';
       $url = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions/'.$result2->requestId.'/exports/'.$result2->exports[0]->id.'/outputResource' ;
       $ch2 = curl_init();
       curl_setopt($ch2, CURLOPT_URL,$url);
       curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
       curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       curl_setopt($ch2, CURLOPT_USERPWD, "$login:$password");
       curl_setopt($ch2, CURLOPT_HTTPHEADER, array(   
         'Accept: application/json',
        
         "Cookie: JSESSIONID=$cookie")                                                           
     ); 


       $result3 = curl_exec($ch2);

       $returnCode = (int)curl_getinfo($ch2, CURLINFO_HTTP_CODE);

       curl_close($ch2);  

       $file_name = "etat_manquants.".$format ;

       $fp = fopen($file_name, "w");

       fwrite($fp, $result3);
       fclose($fp);

       $result = array("status" => "OK");
      

       print_r(json_encode($result));
       return json_encode($result);  
       
      }
       
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
        $format = $requete->format ;
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

        /*********************TRAVAIL EXPORT*************************** */

        $fp = fopen("data_etat_ventes_conso.json", "w");
        fwrite($fp, json_encode($datas));
        fclose($fp);

        
       // include 'export_etat_ventes.php' ;

       $username = 'user';
       $password = 'bitnami';

       $payloadName = '

       {
         "reportUnitUri": "/themes/Etat_Ventes_Carburant_Conso",
         "async": false,
         "freshData": true,
         "saveDataSnapshot": false,
         "outputFormat": "'.$format.'",
         "interactive": false,
         "ignorePagination": false,
         "parameters": {
             "reportParameter": [
              {
                   "name": "date_debut",
                   "value": ["'.$date_debut2.'"]
               },

               {
                   "name": "date_fin",
                   "value": ["'.$date_fin2.'"]
               }

              


             ]
         }
     }
       
       ' ;


     
       $host = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions' ;
       $ch = curl_init($host);
       
       curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
       curl_setopt($ch, CURLOPT_TIMEOUT, 90);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
       curl_setopt($ch,  CURLOPT_HEADER,  1);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
         'Accept: application/json',
         'Content-Type: application/json')                                                           
     ); 



     if(curl_exec($ch) === false)
     {
         echo 'Curl error: ' . curl_error($ch);
     }                                                                                                      
     $errors = curl_error($ch);                                                                                                            
     $result = curl_exec($ch);

     // get cookies

    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
    }

    /*
    $headerArr = explode(PHP_EOL, $headerstring);
   foreach ($headerArr as $headerRow) {
       preg_match('/([a-zA-Z\-]+):\s(.+)$/',$headerRow, $matches);
       if (!isset($matches[0])) {
           continue;
       }
       $header[$matches[1]] = $matches[2];
   }
   */

   

    $cookie = $cookies['JSESSIONID'] ;

    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headerstring = substr($result, 0, $header_size);
    $body = substr($result, $header_size);


     $result2 = json_decode($body) ;

    // var_dump($result2) ;
     
       $login = 'user';
       $password = 'bitnami';
       $url = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions/'.$result2->requestId.'/exports/'.$result2->exports[0]->id.'/outputResource' ;
       $ch2 = curl_init();
       curl_setopt($ch2, CURLOPT_URL,$url);
       curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
       curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       curl_setopt($ch2, CURLOPT_USERPWD, "$login:$password");
       curl_setopt($ch2, CURLOPT_HTTPHEADER, array(   
         'Accept: application/json',
        
         "Cookie: JSESSIONID=$cookie")                                                           
     ); 


       $result3 = curl_exec($ch2);

       $returnCode = (int)curl_getinfo($ch2, CURLINFO_HTTP_CODE);

       curl_close($ch2);  

       $file_name = "etat_ventes_conso.".$format ;

       $fp = fopen($file_name, "w");

       fwrite($fp, $result3);
       fclose($fp);

       $result = array("status" => "OK");

     /**************************************************************** */
       print_r(json_encode($result));
       return json_encode($result);  
       
       
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
        $format = $requete->format ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   

       /*********************TRAVAIL EXPORT*************************** */


      $username = 'user';
      $password = 'bitnami';

      $payloadName = '

      {
        "reportUnitUri": "/reports/test",
        "async": false,
        "freshData": true,
        "saveDataSnapshot": false,
        "outputFormat": "'.$format.'",
        "interactive": false,
        "ignorePagination": false,
        "parameters": {
            "reportParameter": [
             {
                  "name": "date_debut",
                  "value": ["'.$date_debut2.'"]
              },

              {
                  "name": "date_fin",
                  "value": ["'.$date_fin2.'"]
              }

             


            ]
        }
    }
      
      ' ;


    
      $host = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions' ;
      $ch = curl_init($host);
      
      curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
      curl_setopt($ch, CURLOPT_TIMEOUT, 90);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch,  CURLOPT_HEADER,  1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
        'Accept: application/json',
        'Content-Type: application/json')                                                           
    ); 



    if(curl_exec($ch) === false)
    {
        echo 'Curl error: ' . curl_error($ch);
    }                                                                                                      
    $errors = curl_error($ch);                                                                                                            
    $result = curl_exec($ch);

    // get cookies

   preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
   $cookies = array();
   foreach($matches[1] as $item) {
   parse_str($item, $cookie);
   $cookies = array_merge($cookies, $cookie);
   }

   /*
   $headerArr = explode(PHP_EOL, $headerstring);
  foreach ($headerArr as $headerRow) {
      preg_match('/([a-zA-Z\-]+):\s(.+)$/',$headerRow, $matches);
      if (!isset($matches[0])) {
          continue;
      }
      $header[$matches[1]] = $matches[2];
  }
  */

  

   $cookie = $cookies['JSESSIONID'] ;

   $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $headerstring = substr($result, 0, $header_size);
   $body = substr($result, $header_size);


    $result2 = json_decode($body) ;
    
      $login = 'user';
      $password = 'bitnami';
      $url = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions/'.$result2->requestId.'/exports/'.$result2->exports[0]->id.'/outputResource' ;
      $ch2 = curl_init();
      curl_setopt($ch2, CURLOPT_URL,$url);
      curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch2, CURLOPT_USERPWD, "$login:$password");
      curl_setopt($ch2, CURLOPT_HTTPHEADER, array(   
        'Accept: application/json',
       
        "Cookie: JSESSIONID=$cookie")                                                           
    ); 


      $result3 = curl_exec($ch2);

      $returnCode = (int)curl_getinfo($ch2, CURLINFO_HTTP_CODE);

      curl_close($ch2);  

      $file_name = "etat_versements_me.".$format ;

      $fp = fopen($file_name, "w");

      fwrite($fp, $result3);
      fclose($fp);

      $result = array("status" => "OK");

    /**************************************************************** */

       print_r(json_encode($result)) ;
       return json_encode($result) ;  
       
     
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
        $format = $requete->format ;
   
        $date_debut2 = date('Y-m-d', strtotime($date_debut));
        $date_fin2 = date('Y-m-d', strtotime($date_fin));
   

       /*********************TRAVAIL EXPORT*************************** */


      $username = 'user';
      $password = 'bitnami';

      $payloadName = '

      {
        "reportUnitUri": "/reports/Etat_Versement",
        "async": false,
        "freshData": true,
        "saveDataSnapshot": false,
        "outputFormat": "'.$format.'",
        "interactive": false,
        "ignorePagination": false,
        "parameters": {
            "reportParameter": [
             {
                  "name": "date_debut",
                  "value": ["'.$date_debut2.'"]
              },

              {
                  "name": "date_fin",
                  "value": ["'.$date_fin2.'"]
              }

             


            ]
        }
    }
      
      ' ;


    
      $host = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions' ;
      $ch = curl_init($host);
      
      curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
      curl_setopt($ch, CURLOPT_TIMEOUT, 90);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadName);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch,  CURLOPT_HEADER,  1);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
        'Accept: application/json',
        'Content-Type: application/json')                                                           
    ); 



    if(curl_exec($ch) === false)
    {
        echo 'Curl error: ' . curl_error($ch);
    }                                                                                                      
    $errors = curl_error($ch);                                                                                                            
    $result = curl_exec($ch);

    // get cookies

   preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
   $cookies = array();
   foreach($matches[1] as $item) {
   parse_str($item, $cookie);
   $cookies = array_merge($cookies, $cookie);
   }

   /*
   $headerArr = explode(PHP_EOL, $headerstring);
  foreach ($headerArr as $headerRow) {
      preg_match('/([a-zA-Z\-]+):\s(.+)$/',$headerRow, $matches);
      if (!isset($matches[0])) {
          continue;
      }
      $header[$matches[1]] = $matches[2];
  }
  */

  

   $cookie = $cookies['JSESSIONID'] ;

   $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);

   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $headerstring = substr($result, 0, $header_size);
   $body = substr($result, $header_size);


    $result2 = json_decode($body) ;
    
      $login = 'user';
      $password = 'bitnami';
      $url = 'http://192.168.1.162:8081/jasperserver/rest_v2/reportExecutions/'.$result2->requestId.'/exports/'.$result2->exports[0]->id.'/outputResource' ;
      $ch2 = curl_init();
      curl_setopt($ch2, CURLOPT_URL,$url);
      curl_setopt($ch2, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch2, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch2, CURLOPT_USERPWD, "$login:$password");
      curl_setopt($ch2, CURLOPT_HTTPHEADER, array(   
        'Accept: application/json',
       
        "Cookie: JSESSIONID=$cookie")                                                           
    ); 


      $result3 = curl_exec($ch2);

      $returnCode = (int)curl_getinfo($ch2, CURLINFO_HTTP_CODE);

      curl_close($ch2);  

      $file_name = "etat_versements.".$format ;

      $fp = fopen($file_name, "w");

      fwrite($fp, $result3);
      fclose($fp);

      $result = array("status" => "OK");

    /**************************************************************** */

       print_r(json_encode($result)) ;
       return json_encode($result) ;  
       
     
}

function Etats_Versements_Excel() { 

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

     $date_debut = date_create($date_debut);
     $date_fin = date_create($date_fin);

     $dates[] = date_format($date_debut, 'Y-m-d') ;
   
        while ($date_debut < $date_fin) {
             
             $date_debut = date_add($date_debut, date_interval_create_from_date_string('1 days'));
             $dates [] = date_format($date_debut, 'Y-m-d') ;
   
        }

    // var_dump($dates) ;

     /*************************QUERY******************* */

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

      

  " ;

  /**************************************RESULT********************************* */

  $res_vers = mysqli_query($conn, $query_vers );
   
  $data_vers = array();
  $stations = array();

  if (is_object($res_vers)) {

        while($rows = mysqli_fetch_array($res_vers))

        {
         
          $obj = new stdClass();

                  $obj->date = $rows['date'] ;
                  $obj->montant = floatval($rows['montant']) ;
                  $obj->station = $rows['station'] ;
                  $obj->banque = $rows['nom_banque'] ;

                  $data_vers[] = $obj ;
                  $stations[] = $rows['station'] ;
        }

  }

  //var_dump($data_vers);

    /*********************TRAVAIL EXPORT*************************** */

    $stations_unique = array_unique($stations);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
  
       // $data = json_decode(file_get_contents("php://input"));
  
      // $requete = $data->coulages;

      /*********************TRAVAIL EXPORT*************************** */
      

      $index = 1 ;

      foreach ($stations_unique as $key => $value) {

  /*       $sheet->setCellValueByColumnAndRow($index, 1, '') ;  //colonne ,ligne,element
        $sheet->setCellValueByColumnAndRow($index+1, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+2, 1, $value) ;
        $sheet->setCellValueByColumnAndRow($index+3, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+4, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+5, 1, '') ; */

        $sheet->setCellValueByColumnAndRow($index, 1, '') ;  //colonne ,ligne,element
        $sheet->setCellValueByColumnAndRow($index+1, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+2, 1, $value) ;
       
      
        

        $index += 3 ;

      }

      $index = 1 ;
      $sheet->setCellValueByColumnAndRow($index, 2, 'DATE VERSEMENT') ;//avant la ligne montant


      foreach ($stations_unique as $key => $value) {
        
      /* bon initiale  $sheet->setCellValueByColumnAndRow($index, 2, '') ;
        $sheet->setCellValueByColumnAndRow($index+1, 2, 'RECETTE DECLARE') ;
        $sheet->setCellValueByColumnAndRow($index+2, 2, 'MONTANT VERSE') ;
        $sheet->setCellValueByColumnAndRow($index+3, 2, 'N° BORDEREAU COTRAVA') ;
        $sheet->setCellValueByColumnAndRow($index+4, 2, 'OBSERVATION BANCAIRE') ;
        $sheet->setCellValueByColumnAndRow($index+5, 2, 'ECART') ; */


        $sheet->setCellValueByColumnAndRow($index+1, 2, '') ;
        $sheet->setCellValueByColumnAndRow($index+2, 2, 'MONTANT') ;
       
       
      
        $index += 3 ;

      }

     
      $index_ligne = 3 ;

      foreach ($dates as $key20 => $value20) {

        $date = $value20 ;

        
        $index_colonne = 1 ;

        $sheet->setCellValueByColumnAndRow($index_colonne, $index_ligne, $date) ;

        
        foreach ($stations_unique as $key10 => $value10) {

          $station = $value10;
  
          foreach ($data_vers as $key => $value) {
  
            if ($value->date === $date && $value->station === $station) {
  
            /* bon initiale  $sheet->setCellValueByColumnAndRow($index_colonne+1, $index_ligne, $value->montant) ;
              $sheet->setCellValueByColumnAndRow($index_colonne+2, $index_ligne, 0) ;
              $sheet->setCellValueByColumnAndRow($index_colonne+3, $index_ligne, '') ;
              $sheet->setCellValueByColumnAndRow($index_colonne+4, $index_ligne, '') ;
              $sheet->setCellValueByColumnAndRow($index_colonne+5, $index_ligne, 0) ; */


              $sheet->setCellValueByColumnAndRow($index_colonne+2, $index_ligne, $value->montant) ;
              $sheet->setCellValueByColumnAndRow($index_colonne+3, $index_ligne, '') ;
              
             
             
      
              
  
            }
    
          }

          $index_colonne += 3 ;
  
        }

        $index_ligne += 1 ;

      }


      /********************************************************************** */

      $excel_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/etat_versements.xlsx";

      $writer = new Xlsx($spreadsheet);
      $writer->save($excel_file);


    $result = array("status" => "OK");


     print_r(json_encode($result));
     return json_encode($result);  


  
  
}

function Equation_Stock_Carb_Pdf() { 

   
     $today = new datetime() ;
     $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );
     $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);

       $requete = json_decode(file_get_contents("php://input"));
   
       // var_dump($requete);

        $date_debut = date_create($requete->date_debut);
        $date_fin = date_create($requete->date_fin);

        $date_debut2 = date_format($date_debut, 'd-m-Y') ;
        $date_fin2 = date_format($date_fin, 'd-m-Y') ;

       /* $fmt = new NumberFormatter('cm-CM', NumberFormatter::SPELLOUT );
	   $montant_lettre = '' ;
        $montant_lettre = $fmt->format($montant_total);
       */

        //var_dump($requete);
   
       /*********************TRAVAIL EXPORT*************************** */

       /**********************HEADER******************************* */

          $pdf = new TCPDF($orientation = 'P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
          $pdf->setPrintHeader(false);
          $pdf->setPrintFooter(false);

       /************************BODY********************************** */

       $html = '<h2>EQUATION DES STOCKS STATION SERVICE BLESSING <b>'.$requete->coulages[0]->station.'</b></h2>' ;

       $html .= ' <table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">
       <tr>
           <td colspan="4" style="border:1px solid #D9D5BE;">
             
            <img src="logo_blessing.jpg" border="0" style="width:100px;height:100px;"><br>
              
           </td>
       </tr>
       <tr>
         <td colspan="3" style="border:1px solid #D9D5BE;">

                    <b>BLESSING PETROLEUM S.A</b> <br>
                    blessingpetro@blessingpetroleum.net<br>
                    Akwa 1845 Bld de la liberté<br>
                    Tel : +237 233 42 50 71<br>
                    Fax : +237 233 42 50 72<br>
                    NIU : M110900029355B<br>
                    BP:  5405 Douala Cameroun<br>
                    www.blessingpetroleum.net
         </td>
         <td colspan="1" style="border:1px solid #D9D5BE;">
           
             
             STATION SERVICE : <b>'.$requete->coulages[0]->station.'</b> <br>           
             Date Debut : <b>'.$date_debut2.'</b> <br>           
             Date Fin : <b>'.$date_fin2.'</b> <br>           
             Edité le :  <b>'.$today->format('d-m-Y').' </b>à <b>'.$today->format('H:i:s').' </b> 
                             
           
         </td>
       </tr>
       
       
       </table><hr>
   
       ' ;
      //  <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->si_gasoil_l).'</td>
      //  <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format(14042).'</td>BiS11EME
      //  <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format(26286).'</td>KRIBIPARC
      //  <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format(12797).'</td>MEHANDAN
      //   <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->si_gasoil_l).'</td>


       $html .= '
       
       <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div>

                            <table style="border:1px solid #D9D5BE;  ">
                            <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
                                <td ><b>NATURE PRODUITS</b></td>
                                <td style=" text-align:center;"><b>SUPER</b></td>
                                <td style=" text-align:center;"><b>GASOIL</b></td>
                                <td style=" text-align:center;"><b>PETROLE</b></td>
                                
                                
                            </tr>  

                            <tr  style="border:1px solid #D9D5BE;">

                                <td  style="border:1px solid #D9D5BE;  "><b>SI DEBUT PERIODE (A)</b></td>
                                <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->si_super_l).'</td>
                                 <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->si_gasoil_l).'</td>

                                <td  style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->si_petrole_l).'</td>
                                
                            </tr>  

                            <tr><td></td><td></td><td></td><td></td></tr>

                            <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
                                <td style="border:1px solid #D9D5BE;"><b>TOTAL DES LIVRAISONS PERIODE (B)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->liv_super_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->liv_gasoil_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->liv_petrole_l).'</td>
                                
                            </tr>  

                            <tr><td></td><td></td><td></td><td></td></tr>

                            <tr >
                                <td style="border:1px solid #D9D5BE;"><b>TOTAL DES SORTIES PERIODE (C)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->vte_super_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->vte_gasoil_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->vte_petrole_l).'</td>
                                
                            </tr>  

                            <tr><td></td><td></td><td></td><td></td></tr>

                            <tr >
                                <td style="border:1px solid #D9D5BE;"><b>TOTAL REMISE EN CUVES PERIODE (D)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">0</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">0</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">0</td>
                                
                            </tr>  

                            <tr><td></td><td></td><td></td><td></td></tr>

                            <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
                                <td style="border:1px solid #D9D5BE;"><b>TOTAL DES VENTES NETTES PERIODE(E)=(C) - (D)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->vte_super_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->vte_gasoil_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->vte_petrole_l).'</td>
                                
                            </tr>  

                            <tr><td></td><td></td><td></td><td></td></tr>

                            <tr >
                                <td style="border:1px solid #D9D5BE;"><b>STOCK FINAL THEORIQUE FIN PERIODE (F)=(A) + (B) - (E)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->st_super_l).'</td>
                                 <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->st_gasoil_l).'</td> 
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->st_petrole_l).'</td>
                                
                            </tr>  

                            <tr><td></td><td></td><td></td><td></td></tr>

                            <tr >
                                <td style="border:1px solid #D9D5BE;"><b>STOCK FINAL PHYSIQUE FIN PERIODE (G)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->sf_super_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->sf_gasoil_l).'</td>
                                <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->sf_petrole_l).'</td>
                                
                            </tr>

                            <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
                                <td style="border:1px solid #D9D5BE;"><b>CUMUL COULAGES FIN PERIODE (G)</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[1]->cou_super_l).'</b></td>
                                <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[0]->cou_gasoil_l).'</b></td>



                                <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[2]->cou_petrole_l).'</b></td>
                                
                            </tr>

                            </table>

                            <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div><hr>

                            

                            <!--    SIGNATURE---->

                            <table>
                              <tr>
                                   <td>Le Chef de Piste</td>
                                   <td>Le Gérant</td>
                                   <td>Le Régional </td>
                              </tr>
                            </table>
                           
                            <!--    SIGNATURE---->
                    
                            
           ' ;
//                                  <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[0]->cou_gasoil_l).'</b></td>


          //  <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->st_gasoil_l).'</td> bon
          //  <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format(12787).'</td> Mehanda
          //  <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format(14645).'</td> KRIBIPARCK


          //  <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format(-219).'</b></td>-219 BIS11EME
          //  <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[0]->cou_gasoil_l).'</b></td>
          //  <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format(3).'</b></td> KRIBI

       

       /********************************************************************** */

          $pdf->AddPage();

          $pdf->setPageUnit('pt');
          $document_width = $pdf->pixelsToUnits('100');
          $document_height = $pdf->pixelsToUnits('100');
          $x = $pdf->pixelsToUnits('20');
          $y = $pdf->pixelsToUnits('20');
          $font_size = $pdf->pixelsToUnits('10');
          //$txt = $html;

          $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
          // $pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

          $pdf->writeHTML($html, true, false, true, false, '');

               // reset pointer to the last page
          $pdf->lastPage();

          ob_end_clean();

      $pdf_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/equation_stock_carb.pdf";
      //$result3 = $pdf->Output('equation_stock_carb', 'S') ;
      $pdf->Output($pdf_file, 'F') ;

 /*
      $fp = fopen($pdf_file, "w");
      fwrite($fp, $result3);
      fclose($fp);
 */  

     $result = array("status" => "OK");


      print_r(json_encode($result));
      return json_encode($result);  

       
     
}



  function Vente_Reseau_Carb_Pdf() { 

   $today = new datetime();
   $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );
   $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);

    $requete = json_decode(file_get_contents("php://input"));

   /* foreach ($requete->coulages as  $key => $value) {
      var_dump($value->station);
    //  return json_encode($value); 
    }  */

    // var_dump($requete);

   /*  print_r(json_encode($requete));
     return json_encode($requete);  */
     $date_debut = date_create($requete->date_debut);
     $date_fin = date_create($requete->date_fin);

     $date_debut2 = date_format($date_debut, 'd-m-Y') ;
     $date_fin2 = date_format($date_fin, 'd-m-Y') ;

    /**********************HEADER******************************* */

       $pdf = new TCPDF($orientation = 'P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $pdf->setPrintHeader(false);
       $pdf->setPrintFooter(false);

    /************************BODY********************************** */
 
        $html = ' <div class="row">

       
                <div class="wrapper-md"><h4>Tableau des Ventes <b> </h2>' ;
         $html .= '  <table class="table table-bordered table-hover table-condensed bg-white-only">
    
            <tr>
                <td><b>STATIONS</b></td>

                                        <td><b>SUPER</b></td>
                                        <td><b>GASOIL</b></td>
                                        <td>TCP</td>
                                        <td>RECET CARB</td>
                                        <td>RECET LUB</td>

                                        <td>VERS.CLT</td>

                                        <td><b>REC ATTENDU</b></td>
                                        <td><b>VERSE</b></td>

                                      
                                        <td><b>ECART</b></td>
                                        <td>VTE_TERM</td>
                                        <td>MQTS POMP</td>
                                        <td>DEPENS</td>
                                        <td>ECART GE</td>
    
            </tr>'; 

   // foreach ($requete->coulages as $key => $value) {
   
       
  
   foreach ($requete->coulages as $key => $value) {
     

    $html .= '

    <tr>
    <td class="v-middle">
    '.$value->station.'
            </td>

    <td class="v-middle">
    '.$value->super.'
    </td>

    <td class="v-middle">
    '.$value->gasoil.'
    </td>



    <td class="v-middle">
    '.$value->tpc.'
    </td>

    <td class="v-middle">
    '.$value->total_carb.'
    </td>


 
  

    <td class="v-middle">
    '.$value->total_lub.'
    </td>

    <td class="v-middle">
    '.$value->total_vers_clients.'
    </td>

    <td class="v-middle">
    '.$value->total_attendu.'
    </td>

    <td class="v-middle">
    '.$value->versement.'
    </td>
    
    <td class="v-middle">
    '.$value->ecart.'
    </td>

    <td class="v-middle">
    '.$value->vte_client.'
    
    </td>

    <td class="v-middle">
    '.$value->manquant_pompiste.'
    
    </td>

    <td class="v-middle">
    '.$value->depense.'
    
    </td>


    

    <td class="text-center text-danger">
    '.$value->ecart_gerant.'
    </td>

   </tr>';
   }
   $html .= '
   </table>
   </div> </div> ';

    

    /********************************************************************** */

       $pdf->AddPage();

       $pdf->setPageUnit('pt');
       $document_width = $pdf->pixelsToUnits('10');
       $document_height = $pdf->pixelsToUnits('10');
       $x = $pdf->pixelsToUnits('20');
       $y = $pdf->pixelsToUnits('20');
       $font_size = $pdf->pixelsToUnits('7');
       //$txt = $html;

       $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
       // $pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

       $pdf->writeHTML($html, true, false, true, false, '');

            // reset pointer to the last page
       $pdf->lastPage();

       ob_end_clean();

   $pdf_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/tableau_vente_carb.pdf";
   //$result3 = $pdf->Output('equation_stock_carb', 'S') ;
   $pdf->Output($pdf_file, 'F') ;

    /*
   $fp = fopen($pdf_file, "w");
   fwrite($fp, $result3);
   fclose($fp);
   */  

    $result = array("status" => "OK");


      print_r(json_encode($result));
       //print_r(json_encode($requete->coulages));
      //return json_encode($requete->coulages);   
      return json_encode($result);   
      // return json_encode($result);   
  
}





function coulage_Reseau_Carb_Pdf() { 

  $today = new datetime();
  $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );
  $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);

   $requete = json_decode(file_get_contents("php://input"));

  /* foreach ($requete->coulages as  $key => $value) {
     var_dump($value->station);
   //  return json_encode($value); 
   }  */

   // var_dump($requete);

  /*  print_r(json_encode($requete));
    return json_encode($requete);  */
    $date_debut = date_create($requete->date_debut);
    $date_fin = date_create($requete->date_fin);

    $date_debut2 = date_format($date_debut, 'd-m-Y') ;
    $date_fin2 = date_format($date_fin, 'd-m-Y') ;

   /**********************HEADER******************************* */

      $pdf = new TCPDF($orientation = 'P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);

   /************************BODY********************************** */

       $html = ' <div class="row">

      
               <div class="wrapper-md"><h4>Tableau des Coulages <b> </h2>' ;
        $html .= '  <table class="table table-bordered table-hover table-condensed bg-white-only">
   
           <tr>
               <td><b>STATIONS</b></td>
               <td><b>SUPER(L)</b></td>
               <td><b>GASOIL(L)</b></td>
               <td><b>PETROLE(L)</b></td>
               <td><b>TOTAL(L)</b></td>
               <td><b>SUPER(M)</b></td>
               <td><b>GASOIL(M)</b></td>
               <td><b>PETROLE(M)</b></td>
               <td><b>TOTAL(M)</b></td>
   
           </tr>'; 

  // foreach ($requete->coulages as $key => $value) {
  
      
 
  foreach ($requete->coulages as $key => $value) {
    

   $html .= '

   <tr>
   <td class="v-middle">
   '.$value->station.'
           </td>

   <td class="v-middle">
   '.$value->cou_super_l.'
   </td>

   <td class="v-middle">
   '.$value->cou_gasoil_l.'
   </td>



   <td class="v-middle">
   '.$value->cou_petrole_l.'
   </td>

   <td class="v-middle">
   '.$value->cou_total_l.'
   </td>


   <td class="v-middle">
   '.$value->cou_super_m.'
   </td>

   <td class="v-middle">
   '.$value->cou_gasoil_m.'
   </td>

   <td class="v-middle">
   '.$value->cou_petrole_m.'
   </td>

  </tr>';
  }
  $html .= '
  </table>
  </div> </div> ';

   

   /********************************************************************** */

      $pdf->AddPage();

      $pdf->setPageUnit('pt');
      $document_width = $pdf->pixelsToUnits('10');
      $document_height = $pdf->pixelsToUnits('10');
      $x = $pdf->pixelsToUnits('20');
      $y = $pdf->pixelsToUnits('20');
      $font_size = $pdf->pixelsToUnits('7');
      //$txt = $html;

      $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
      // $pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

      $pdf->writeHTML($html, true, false, true, false, '');

           // reset pointer to the last page
      $pdf->lastPage();

      ob_end_clean();

  $pdf_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/tableau_coulage_carb.pdf";
  //$result3 = $pdf->Output('equation_stock_carb', 'S') ;
  $pdf->Output($pdf_file, 'F') ;

   /*
  $fp = fopen($pdf_file, "w");
  fwrite($fp, $result3);
  fclose($fp);
  */  

   $result = array("status" => "OK");


     print_r(json_encode($result));
      //print_r(json_encode($requete->coulages));
     //return json_encode($requete->coulages);   
     return json_encode($result);   
     // return json_encode($result);   
 
}




function Equation_Stock_Carb_Pdf_Valeur() { 

   
  $today = new datetime() ;
  $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );
  $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);

    $requete = json_decode(file_get_contents("php://input"));

    // var_dump($requete);

     $date_debut = date_create($requete->date_debut);
     $date_fin = date_create($requete->date_fin);

     $date_debut2 = date_format($date_debut, 'd-m-Y') ;
     $date_fin2 = date_format($date_fin, 'd-m-Y') ;

    /* $fmt = new NumberFormatter('cm-CM', NumberFormatter::SPELLOUT );
  $montant_lettre = '' ;
     $montant_lettre = $fmt->format($montant_total);
    */

     //var_dump($requete);

    /*********************TRAVAIL EXPORT*************************** */

    /**********************HEADER******************************* */

       $pdf = new TCPDF($orientation = 'P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $pdf->setPrintHeader(false);
       $pdf->setPrintFooter(false);

    /************************BODY********************************** */

    $html = '<h2>FICHE DE STOCK STATION SERVICE BLESSING <b>'.$requete->coulages[0]->station.'</b></h2>' ;

    $html .= ' <table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">
    <tr>
        <td colspan="4" style="border:1px solid #D9D5BE;">
          
         <img src="logo_blessing.jpg" border="0" style="width:100px;height:100px;"><br>
           
        </td>
    </tr>
    <tr>
      <td colspan="3" style="border:1px solid #D9D5BE;">

                 <b>BLESSING PETROLEUM S.A</b> <br>
                 blessingpetro@blessingpetroleum.net<br>
                 Akwa 1845 Bld de la liberté<br>
                 Tel : +237 233 42 50 71<br>
                 Fax : +237 233 42 50 72<br>
                 NIU : M110900029355B<br>
                 BP:  5405 Douala Cameroun<br>
                 www.blessingpetroleum.net
      </td>
      <td colspan="1" style="border:1px solid #D9D5BE;">
        
          
          STATION SERVICE : <b>'.$requete->coulages[0]->station.'</b> <br>           
          Date Debut : <b>'.$date_debut2.'</b> <br>           
          Date Fin : <b>'.$date_fin2.'</b> <br>           
          Edité le :  <b>'.$today->format('d-m-Y').' </b>à <b>'.$today->format('H:i:s').' </b> 
                          
        
      </td>
    </tr>
    
    
    </table><hr>

    ' ;

    $html .= '
    
    <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div>

                         <table style="border:1px solid #D9D5BE;  ">
                         <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">

                             <td ><b>NATURE PRODUITS</b></td>
                             <td style=" text-align:center;"><b>SUPER</b></td>
                             <td style=" text-align:center;"><b>GASOIL</b></td>
                             <td style=" text-align:center;"><b>PETROLE</b></td>
                             <td style=" text-align:center;"><b>TOTAL</b></td>
                             
                         </tr>  

                         <tr><td></td><td></td><td></td><td></td></tr>

                         <tr >
                             <td style="border:1px solid #D9D5BE;"><b>PRIX PRODUIT</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[1]->prix_super).'</td>
                             <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[0]->prix_gasoil).'</td>
                             <td style="border:1px solid #D9D5BE; text-align:center;">'.$fmt->format($requete->coulages[2]->prix_petrole).'</td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"></td>
                             
                         </tr>

                         <tr><td></td><td></td><td></td><td></td></tr>

                        

                         <tr style="border:1px solid #D9D5BE;">
                             <td style="border:1px solid #D9D5BE;"><b>CUMUL COULAGES FIN PERIODE (QTY)</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[1]->cou_super_l).'</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[0]->cou_gasoil_l).'</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[2]->cou_petrole_l).'</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[1]->cou_super_l + $requete->coulages[0]->cou_gasoil_l + $requete->coulages[2]->cou_petrole_l).'</b></td>
                             
                         </tr>

                         <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
                             <td style="border:1px solid #D9D5BE;"><b>CUMUL COULAGES FIN PERIODE (VALEUR)</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[1]->cou_super_m).'</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[0]->cou_gasoil_m).'</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[2]->cou_petrole_m).'</b></td>
                             <td style="border:1px solid #D9D5BE; text-align:center;"><b>'.$fmt->format($requete->coulages[1]->cou_super_m + $requete->coulages[0]->cou_gasoil_m + $requete->coulages[2]->cou_petrole_m).'</b></td>
                             
                         </tr>

                         </table>

                         <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div><hr>


                         <!--    SIGNATURE---->

                         <table>
                          <tr>
                              <td>RD</td>
                              <td>CC</td>
                              <td>CDCC</td>
                              <td>CDEX</td>
                              <td>DAF</td>
                              <td>DC</td>
                              <td>DT/DG</td>
                          </tr>
                        </table>
                        
                         <!--    SIGNATURE---->
                 
                         
        ' ;
    

    /********************************************************************** */

       $pdf->AddPage();

       $pdf->setPageUnit('pt');
       $document_width = $pdf->pixelsToUnits('100');
       $document_height = $pdf->pixelsToUnits('100');
       $x = $pdf->pixelsToUnits('20');
       $y = $pdf->pixelsToUnits('20');
       $font_size = $pdf->pixelsToUnits('10');
       //$txt = $html;

       $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
       // $pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

       $pdf->writeHTML($html, true, false, true, false, '');

            // reset pointer to the last page
       $pdf->lastPage();

       ob_end_clean();

   $pdf_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/equation_stock_carb_valeur.pdf";
   //$result3 = $pdf->Output('equation_stock_carb', 'S') ;
   $pdf->Output($pdf_file, 'F') ;

  /*
    $fp = fopen($pdf_file, "w");
    fwrite($fp, $result3);
    fclose($fp);
  */  

  $result = array("status" => "OK");


   print_r(json_encode($result));
   return json_encode($result);  

    
  
}

function Equation_Stock_Lub_Pdf() { 

   
     $today = new datetime() ;
     $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );

     $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);

       $requete = json_decode(file_get_contents("php://input"));
   
       // var_dump($requete);

        $date_debut = date_create($requete->date_debut);
        $date_fin = date_create($requete->date_fin);

        $station = $requete->station ;

        $date_debut2 = date_format($date_debut, 'd-m-Y') ;
        $date_fin2 = date_format($date_fin, 'd-m-Y') ;

       /* $fmt = new NumberFormatter('cm-CM', NumberFormatter::SPELLOUT );
	   $montant_lettre = '' ;
        $montant_lettre = $fmt->format($montant_total);
       */

        //var_dump($requete);
   
       /*********************TRAVAIL EXPORT*************************** */

       /**********************HEADER******************************* */

          $pdf = new TCPDF($orientation = 'L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
          $pdf->setPrintHeader(false);
          $pdf->setPrintFooter(false);

       /************************BODY********************************** */

       $html = '<h2>EQUATION DES STOCKS LUBRIFIANTS STATION SERVICE BLESSING <b>'.$requete->station.'</b></h2>' ;

       $html .= ' <table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">
       <tr>
           <td colspan="4" style="border:1px solid #D9D5BE;">
             
            <img src="logo_blessing.jpg" border="0" style="width:100px;height:100px;"><br>
              
            
              
           </td>
       </tr>
       <tr>
         <td colspan="3" style="border:1px solid #D9D5BE;">

                    <b>BLESSING PETROLEUM S.A</b> <br>
                    blessingpetro@blessingpetroleum.net<br>
                    Akwa 1845 Bld de la liberté<br>
                    Tel : +237 233 42 50 71<br>
                    Fax : +237 233 42 50 72<br>
                    NIU : M110900029355B<br>
                    BP:  5405 Douala Cameroun<br>
                    www.blessingpetroleum.net
         </td>
         <td colspan="1" style="border:1px solid #D9D5BE;">
           
             
             STATION SERVICE : <b>'.$requete->station.'</b> <br>           
             Date Debut : <b>'.$date_debut2.'</b> <br>           
             Date Fin : <b>'.$date_fin2.'</b> <br>           
             Edité le :  <b>'.$today->format('d-m-Y').' </b>à <b>'.$today->format('H:i:s').' </b> 
                             
           
         </td>
       </tr>
       
       
       </table> <hr>
   
       ' ;

       $html .= '

       <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div>
       
       <table >
                            
       <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">


           <td style="border:1px solid #D9D5BE;">
               
                   <b>PRODUITS</b>
              
           </td>

           <td style="border:1px solid #D9D5BE;">
             
                    <b>EMBALLAGE</b>
               
           </td >
           

           <td style="border:1px solid #D9D5BE;">
              
                  <b>STOCK INI</b>
              
           </td>

           
           <td style="border:1px solid #D9D5BE;">
             
                  <b>LIVRAISON</b>
              
           </td>

           <td style="border:1px solid #D9D5BE;">
              
                   <b>VENTES</b>
             
           </td>

           <td style="border:1px solid #D9D5BE;">
            
                  <b>STOCK THEO</b>
              
           </td>
           

           <td style="border:1px solid #D9D5BE;">
              
                  <b>STOCK PHYSIQUE</b>
            
           </td>

           <td style="border:1px solid #D9D5BE;">
              
                  <b>MANQUANT</b>
            
           </td>
           
       </tr> ' ;

     foreach ($requete->coulages as $key => $value) {

        if ($value->produit == 'TOTAL') {


              $html .= '
              
              <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
              
              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$value->produit.'</b>
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$value->emballage.'</b>
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$fmt->format($value->si_l).'</b>
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$fmt->format($value->liv_l).'</b>
                  
              </td>
              
              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$fmt->format($value->vte_l).'</b>
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$fmt->format($value->st_l).'</b>
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                 <b> '.$fmt->format($value->sf_l).'</b>
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  <b>'.$fmt->format($value->mqt_l).'</b>
                
              </td>

              
          </tr> ' ;


        } else {


              $html .= '
              
              <tr style="border:1px solid #D9D5BE;">
              
              <td style="border:1px solid #D9D5BE;">
                  
                  '.$value->produit.'
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  '.$value->emballage.'
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  '.$fmt->format($value->si_l).'
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  '.$fmt->format($value->liv_l).'
                  
              </td>
              
              <td style="border:1px solid #D9D5BE;">
                  
                  '.$fmt->format($value->vte_l).'
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  '.$fmt->format($value->st_l).'
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  '.$fmt->format($value->sf_l).'
                  
              </td>

              <td style="border:1px solid #D9D5BE;">
                  
                  '.$fmt->format($value->mqt_l).'
                
              </td>

              
              
          </tr> ' ;

          


          
        }
        
     } ;

     $html .= '

     </table>
     <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div> <hr>
                            <!--    SIGNATURE---->

                            <table>
                              <tr>
                                   <td>Le Chef de Piste</td>
                                   <td>Le Gérant</td>
                                   <td>Le Régional </td>
                              </tr>
                            </table>
                           
                            <!--    SIGNATURE---->
                    
                            
           ' ;
       

       /********************************************************************** */

          $pdf->AddPage();

          $pdf->setPageUnit('pt');
          $document_width = $pdf->pixelsToUnits('100');
          $document_height = $pdf->pixelsToUnits('100');
          $x = $pdf->pixelsToUnits('20');
          $y = $pdf->pixelsToUnits('20');
          $font_size = $pdf->pixelsToUnits('10');
          //$txt = $html;

          $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
          // $pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

          $pdf->writeHTML($html, true, false, true, false, '');

               // reset pointer to the last page
          $pdf->lastPage();

          ob_end_clean();

      $pdf_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/equation_stock_lub.pdf";
      //$result3 = $pdf->Output('equation_stock_lub', 'S') ;
      $pdf->Output($pdf_file, 'F') ;

 /*
      $fp = fopen($pdf_file, "w");
      fwrite($fp, $result3);
      fclose($fp);
 */  

     $result = array("status" => "OK");


      print_r(json_encode($result));
      return json_encode($result);  

       
     
}

function Equation_Stock_Carb_Excel() { 
     

     $spreadsheet = new Spreadsheet();
     $sheet = $spreadsheet->getActiveSheet();
   
       $data = json_decode(file_get_contents("php://input"));
   
        $requete = $data->coulages;

       /*********************TRAVAIL EXPORT*************************** */
       $sheet->setCellValueByColumnAndRow(1, 1, 'NATURE DE PRODUITS:') ;
       $sheet->setCellValueByColumnAndRow(2, 1, 'SUPER') ;
       $sheet->setCellValueByColumnAndRow(3, 1, 'GASOIL') ;
       $sheet->setCellValueByColumnAndRow(4, 1, 'PETROLE') ;

       $sheet->setCellValueByColumnAndRow(1, 2, 'STOCK INITIAL DEBUT DU MOIS:') ;
       $sheet->setCellValueByColumnAndRow(2, 2, 'SUPER') ;
       $sheet->setCellValueByColumnAndRow(3, 2, 'GASOIL') ;
       $sheet->setCellValueByColumnAndRow(4, 2, 'PETROLE') ;

       /********************************************************************** */

       $excel_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/equation_stock_carb.xlsx";

       $writer = new Xlsx($spreadsheet);
       $writer->save($excel_file);
 

     $result = array("status" => "OK");


      print_r(json_encode($result));
      return json_encode($result);  

       
     
}

function Manquant_Station_Excel() { 
     

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

    $data = json_decode(file_get_contents("php://input"));

     $requete = $data->manquant;

    /*********************TRAVAIL EXPORT*************************** */
    $sheet->setCellValueByColumnAndRow(1, 1, 'NATURE DE PRODUITS:') ;
    $sheet->setCellValueByColumnAndRow(2, 1, 'SUPER') ;
    $sheet->setCellValueByColumnAndRow(3, 1, 'GASOIL') ;
    $sheet->setCellValueByColumnAndRow(4, 1, 'PETROLE') ;

    $sheet->setCellValueByColumnAndRow(1, 2, 'STOCK INITIAL DEBUT DU MOIS:') ;
    $sheet->setCellValueByColumnAndRow(2, 2, 'SUPER') ;
    $sheet->setCellValueByColumnAndRow(3, 2, 'GASOIL') ;
    $sheet->setCellValueByColumnAndRow(4, 2, 'PETROLE') ;

    /********************************************************************** */

    $excel_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/equation_stock_carb.xlsx";

    $writer = new Xlsx($spreadsheet);
    $writer->save($excel_file);


  $result = array("status" => "OK");


   print_r(json_encode($result));
   return json_encode($result);  

    
  
}
 
function Etats_Coulages_Reseau_Pdf() { 

     $today = new datetime() ;

     $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );

     $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

       $requete = json_decode(file_get_contents("php://input"));
   
       // var_dump($requete);

        $date_debut = date_create($requete->date_debut);
        $date_fin = date_create($requete->date_fin);

        $station = $requete->station ;

        $date_debut2 = date_format($date_debut, 'd-m-Y') ;
        $date_fin2 = date_format($date_fin, 'd-m-Y') ;


   /**********************HEADER******************************* */

   $pdf = new TCPDF($orientation = 'L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
   $pdf->setPrintHeader(false);
   $pdf->setPrintFooter(false);

 /************************BODY********************************** */

  $html = '<h2>DETAILS COULAGES RESEAU</h2>' ;

  $html .= ' <table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">
  <tr>
      <td colspan="4" style="border:1px solid #D9D5BE;">
        
      <img src="logo_blessing.jpg" border="0" style="width:100px;height:100px;"><br>
        
      </td>
  </tr>
  <tr>
    <td colspan="3" style="border:1px solid #D9D5BE;">

              <b>BLESSING PETROLEUM S.A</b> <br>
              blessingpetro@blessingpetroleum.net<br>
              Akwa 1845 Bld de la liberté<br>
              Tel : +237 233 42 50 71<br>
              Fax : +237 233 42 50 72<br>
              NIU : M110900029355B<br>
              BP:  5405 Douala Cameroun<br>
              www.blessingpetroleum.net
    </td>
    <td colspan="1" style="border:1px solid #D9D5BE;">
      
        
        Date Debut : <b>'.$date_debut2.'</b> <br>           
        Date Fin : <b>'.$date_fin2.'</b> <br>           
        Edité le :  <b>'.$today->format('d-m-Y').' </b>à <b>'.$today->format('H:i:s').' </b> 
                        
      
    </td>
  </tr>


  </table> <hr>

  ' ;

  $html .= '

  <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div>

  <table >
                      
  <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">

      <td style="border:1px solid #D9D5BE;"><b>STATION</b></td>
      <td style="border:1px solid #D9D5BE;"><b>PRODUITS</b></td>
      <td style="border:1px solid #D9D5BE;"><b>SI</b></td>
      <td style="border:1px solid #D9D5BE;"><b>LIV</b></td>
      <td style="border:1px solid #D9D5BE;"><b>VTE</b></td>
      <td style="border:1px solid #D9D5BE;"><b>SF THEO</b></td>
      <td style="border:1px solid #D9D5BE;"><b>STOCK PHY</b></td>
      <td style="border:1px solid #D9D5BE;"><b>ECART</b></td>
      <td style="border:1px solid #D9D5BE;"><b>PRIX</b></td>
      <td style="border:1px solid #D9D5BE;"><b>VALEUR COULAGE</b></td>
      <td style="border:1px solid #D9D5BE;"><b>FREINTE</b></td>
      <td style="border:1px solid #D9D5BE;"><b>DEPASSEMENT</b></td>
      <td style="border:1px solid #D9D5BE;"><b>VALEUR DEPASSEMENT</b></td>

      
      
  </tr> ' ;

  foreach ($requete->coulages as $key => $value) {

  if ($value->produit == 'TOTAL') {

        $html .= '
        
        <tr bgcolor="#D9D5BE" style="border:1px solid #D9D5BE;">
        
            <td style="border:1px solid #D9D5BE;">
                '.$value->station.'
            </td>
            <td style="border:1px solid #D9D5BE;">
                <b>'.$value->produit.'</b>
            </td>
            <td style="border:1px solid #D9D5BE;">
                '.$fmt->format($value->si).'
            </td>
            <td style="border:1px solid #D9D5BE;">
                '.$fmt->format($value->liv).'
            </td>
            <td style="border:1px solid #D9D5BE;">
                '.$fmt->format($value->vte).'
            </td>
            <td style="border:1px solid #D9D5BE;">
                '.$fmt->format($value->st).'
            </td>
            <td style="border:1px solid #D9D5BE;">
                '.$fmt->format($value->sf).'
            </td>
            <td style="border:1px solid #D9D5BE;">
                <b>'.$fmt->format($value->cou).'</b>
            </td>
            <td style="border:1px solid #D9D5BE;">
                <b>'.$fmt->format($value->prix_produit).'</b>
            </td>
            <td style="border:1px solid #D9D5BE;">
                <b>'.$fmt->format($value->cou_m).'</b>
            </td>
            <td style="border:1px solid #D9D5BE;">
                <b>'.$fmt->format($value->freinte).'</b>
            </td>
            <td style="border:1px solid #D9D5BE;">
                <b>'.$fmt->format($value->depassement).'</b>
            </td>
            <td style="border:1px solid #D9D5BE;">
               <b> '.$fmt->format($value->depassement_m).'</b>
            </td>

        
    </tr> ' ;


  } else {

        $html .= '
        
        <tr style="border:1px solid #D9D5BE;">

            <td style="border:1px solid #D9D5BE;">
            '.$value->station.'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$value->produit.'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->si).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->liv).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->vte).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->st).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->sf).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->cou).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->prix_produit).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->cou_m).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->freinte).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->cou - $value->freinte).'
              </td>
              <td style="border:1px solid #D9D5BE;">
                  '.$fmt->format($value->cou - $value->freinte)*$value->prix_produit.'
              </td>
        
        </tr> ' ;
    
  }
  
  } ;

  $html .= '

  </table>
  <div style="padding-top: 15em; border:1px solid #D9D5BE;" ></div> <hr>
                      <!--    SIGNATURE---->
  <table>
    <tr>
        <td>RD</td>
        <td>CC</td>
        <td>CDCC</td>
        <td>CDEX</td>
        <td>DAF</td>
        <td>DC</td>
        <td>DT/DG</td>
    </tr>
  </table>
                      
                      <!--    SIGNATURE---->
              
                      
      ' ;


  /********************************************************************** */

    $pdf->AddPage();

    $pdf->setPageUnit('pt');
    $document_width = $pdf->pixelsToUnits('100');
    $document_height = $pdf->pixelsToUnits('100');
    $x = $pdf->pixelsToUnits('20');
    $y = $pdf->pixelsToUnits('20');
    $font_size = $pdf->pixelsToUnits('10');
    //$txt = $html;

    $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );
    // $pdf->Text  ( $x, $y, $txt, false, false, true, 0, 0, '', false, '', 0, false, 'T', 'M', false );

    $pdf->writeHTML($html, true, false, true, false, '');

          // reset pointer to the last page
    $pdf->lastPage();

    ob_end_clean();

  $pdf_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/details_coulages.pdf";
  //$result3 = $pdf->Output('equation_stock_lub', 'S') ;
  $pdf->Output($pdf_file, 'F') ;

  $result = array("status" => "OK");


  print_r(json_encode($result));
  return json_encode($result);    

    
}

function Etats_Coulages_Reseau_Excel() { 
     

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

    $data = json_decode(file_get_contents("php://input"));

     $requete = $data->coulages;

     /* print_r(json_encode($requete));
     return json_encode($requete); 
 */
    // var_dump($requete); die();

    /*********************TRAVAIL EXPORT*************************** */
    $sheet->setCellValueByColumnAndRow(1, 1, 'STATION') ;
    $sheet->setCellValueByColumnAndRow(2, 1, 'PRODUIT') ;
    $sheet->setCellValueByColumnAndRow(3, 1, 'STOCK INI') ;
    $sheet->setCellValueByColumnAndRow(4, 1, 'LIVRAISON') ;
    $sheet->setCellValueByColumnAndRow(5, 1, 'VENTES') ;
    $sheet->setCellValueByColumnAndRow(6, 1, 'STOCK THEO') ;
    $sheet->setCellValueByColumnAndRow(7, 1, 'STOCK PHY') ;
    $sheet->setCellValueByColumnAndRow(8, 1, 'ECART') ;
    $sheet->setCellValueByColumnAndRow(9, 1, 'PRIX') ;
    $sheet->setCellValueByColumnAndRow(10, 1, 'VALEUR COULAGE') ;
    $sheet->setCellValueByColumnAndRow(11, 1, 'FREINTE') ;
    $sheet->setCellValueByColumnAndRow(12, 1, 'DEPASSEMENT') ;
    $sheet->setCellValueByColumnAndRow(13, 1, 'VALEUR DEPASSEMENT') ;

    $key_ligne = 2 ;

   // var_dump($requete);

    foreach ($requete as $key => $value) {

     // var_dump($value); die();

      if ($value->station == 'TOTAL') {

        
      $sheet->setCellValueByColumnAndRow(1, $key_ligne, $value->station) ;
      $sheet->setCellValueByColumnAndRow(2, $key_ligne, $value->produit) ;
      $sheet->setCellValueByColumnAndRow(3, $key_ligne, $value->si) ;
      $sheet->setCellValueByColumnAndRow(4, $key_ligne, $value->liv) ;
      $sheet->setCellValueByColumnAndRow(5, $key_ligne, $value->vte) ;
      $sheet->setCellValueByColumnAndRow(6, $key_ligne, $value->st) ;
      $sheet->setCellValueByColumnAndRow(7, $key_ligne, $value->sf) ;
      $sheet->setCellValueByColumnAndRow(8, $key_ligne, $value->cou) ;
      $sheet->setCellValueByColumnAndRow(9, $key_ligne, 0) ;
      $sheet->setCellValueByColumnAndRow(10, $key_ligne, $value->cou_m) ;
      $sheet->setCellValueByColumnAndRow(11, $key_ligne, $value->freinte) ;
      $sheet->setCellValueByColumnAndRow(12, $key_ligne, $value->depassement) ;
      $sheet->setCellValueByColumnAndRow(13, $key_ligne, $value->depassement_m) ;

      $key_ligne += 1 ;
        

      } else {
        
        
      $sheet->setCellValueByColumnAndRow(1, $key_ligne, $value->station) ;
      $sheet->setCellValueByColumnAndRow(2, $key_ligne, $value->produit) ;
      $sheet->setCellValueByColumnAndRow(3, $key_ligne, $value->si) ;
      $sheet->setCellValueByColumnAndRow(4, $key_ligne, $value->liv) ;
      $sheet->setCellValueByColumnAndRow(5, $key_ligne, $value->vte) ;
      $sheet->setCellValueByColumnAndRow(6, $key_ligne, $value->st) ;
      $sheet->setCellValueByColumnAndRow(7, $key_ligne, $value->sf) ;
      $sheet->setCellValueByColumnAndRow(8, $key_ligne, $value->cou) ;
      $sheet->setCellValueByColumnAndRow(9, $key_ligne, $value->prix_produit) ;
      $sheet->setCellValueByColumnAndRow(10, $key_ligne, $value->cou_m) ;
      $sheet->setCellValueByColumnAndRow(11, $key_ligne, $value->freinte) ;
      $sheet->setCellValueByColumnAndRow(12, $key_ligne, $value->cou-$value->freinte) ;
      $sheet->setCellValueByColumnAndRow(13, $key_ligne, ($value->cou-$value->freinte)*$value->prix_produit) ;

      $key_ligne += 1 ;

      }
      

     

    }

    /********************************************************************** */

    $excel_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/details_coulages.xlsx";

    $writer = new Xlsx($spreadsheet);
    $writer->save($excel_file);


  $result = array("status" => "OK");


   print_r(json_encode($result));
   return json_encode($result);  

    
  
}

function Ventes_Conso_Excel() { 
     

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();

    $data = json_decode(file_get_contents("php://input"));

     $requete = $data->ventes;

    // var_dump($requete); die();

    /*********************TRAVAIL EXPORT*************************** */
    $sheet->setCellValueByColumnAndRow(1, 1, 'STATION') ;
    $sheet->setCellValueByColumnAndRow(2, 1, 'SUPER') ;
    $sheet->setCellValueByColumnAndRow(3, 1, 'GASOIL') ;
    $sheet->setCellValueByColumnAndRow(4, 1, 'PETROLE') ;
    $sheet->setCellValueByColumnAndRow(5, 1, 'TPC') ;
    $sheet->setCellValueByColumnAndRow(6, 1, 'RECETTE CARB') ;
    $sheet->setCellValueByColumnAndRow(7, 1, 'RECETTE LUB') ;
    $sheet->setCellValueByColumnAndRow(8, 1, 'VERSEMENT CLIENT') ;
    $sheet->setCellValueByColumnAndRow(9, 1, 'RECETTE ATTENDU') ;
    $sheet->setCellValueByColumnAndRow(10, 1, 'VERSEMENT') ;
    $sheet->setCellValueByColumnAndRow(11, 1, 'ECART') ;
    $sheet->setCellValueByColumnAndRow(12, 1, 'VENTES A TERME') ;
    $sheet->setCellValueByColumnAndRow(13, 1, 'MANQUANT POMPISTE') ;
    $sheet->setCellValueByColumnAndRow(14, 1, 'DEPENSES') ;
    $sheet->setCellValueByColumnAndRow(15, 1, 'ECART GERANT') ;

    $key_ligne = 2 ;

   // var_dump($requete);

    foreach ($requete as $key => $value) {

      //var_dump($value); die();

      if (1) {

        
      $sheet->setCellValueByColumnAndRow(1, $key_ligne, $value->station) ;
      $sheet->setCellValueByColumnAndRow(2, $key_ligne, $value->super) ;
      $sheet->setCellValueByColumnAndRow(3, $key_ligne, $value->gasoil) ;
      $sheet->setCellValueByColumnAndRow(4, $key_ligne, $value->petrole) ;
      $sheet->setCellValueByColumnAndRow(5, $key_ligne, $value->tpc) ;
      $sheet->setCellValueByColumnAndRow(6, $key_ligne, $value->total_carb) ;
      $sheet->setCellValueByColumnAndRow(7, $key_ligne, $value->total_lub) ;
      $sheet->setCellValueByColumnAndRow(8, $key_ligne, $value->total_vers_clients) ;
      $sheet->setCellValueByColumnAndRow(9, $key_ligne, $value->total_attendu) ;
      $sheet->setCellValueByColumnAndRow(10, $key_ligne, $value->versement) ;
      $sheet->setCellValueByColumnAndRow(11, $key_ligne, $value->ecart) ;
      $sheet->setCellValueByColumnAndRow(12, $key_ligne, $value->vte_client) ;
      $sheet->setCellValueByColumnAndRow(13, $key_ligne, $value->manquant_pompiste) ;
      $sheet->setCellValueByColumnAndRow(14, $key_ligne, $value->depense) ;
      $sheet->setCellValueByColumnAndRow(15, $key_ligne, $value->ecart_gerant) ;

      $key_ligne += 1 ;
        

      } else {
        
        
      

      }
      

     

    }

    /********************************************************************** */

    $excel_file = $_SERVER['DOCUMENT_ROOT']."/station/src/api/DOCUMENTS/ventes_conso_excel.xlsx";

    $writer = new Xlsx($spreadsheet);
    $writer->save($excel_file);


  $result = array("status" => "OK");


   print_r(json_encode($result));
   return json_encode($result);  

    
  
}


?>