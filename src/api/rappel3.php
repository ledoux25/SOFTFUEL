<?php

     require 'src/Exception.php';
     require 'src/PHPMailer.php';
     require 'src/SMTP.php';		// PHP Mailer
     
     use PHPMailer\PHPMailer\PHPMailer ;
    // use PHPMailer\PHPMailer\Exception;
     
     function getDB2(){
         
         try {
             $conn = new PDO('mysql:host=localhost;dbname=station;charset=utf8', 'station', 'station');
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             // echo "Connected successfully";
             return $conn ;
         }
         catch(PDOException $e)
         {
             echo "Connection failed: " . $e->getMessage();
         }
     }
     
     function sendEmail($email_station, $email_regional, $nom_station, $date_quart, $html){

     
         $mail = new PHPMailer(true);  
         $mail->CharSet = 'UTF-8';
         $mail->Encoding = 'base64';
         $mail->setLanguage('fr', '/optional/path/to/language/directory/');
     
     
               //Server settings
          
            // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
             $mail->isSMTP();                                      // Set mailer to use SMTP
             $mail->Host = 'smtp.blessingpetroleum.net';                 // Specify main and backup SMTP servers
             $mail->SMTPAuth = false;                               // Enable SMTP authentication
             $mail->Username = 'blessingp122';                 // SMTP username
             $mail->Password = 'softfuel';                           // SMTP password
        // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
             $mail->Port = 25;                                    // TCP port to connect to
               //Recipients
               
         $mail->setFrom($email_station, $nom_station) ;

         $mail->addAddress($email_regional);

         
     
         $mail->addReplyTo($email_station, $nom_station);

         $mail->addCC($email_station);
         
      //   $mail->addBCC('');
     
               //Attachments
               
      //    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
               //Content
               
         $nom_station2 = substr($nom_station, 8) ;
               
         $mail->isHTML(true);    // Set email format to HTML                  
         $mail->Subject = 'VENTES '.$nom_station2.' AU '.$date_quart ;
         $mail->Body    = $html ;
     
      // $mail->AltBody = 'Felicitation M.'.$nom.' votre inscription a été correctement prise en compte!';
     
         $mail->send();
                
     
     }

    

     // connect DB

     $host_name = 'localhost' ;
     $user_name = 'station' ;
     $password = 'station' ;
     $database = 'station' ;

    $conn = mysqli_connect($host_name, $user_name, $password, $database);
   
    $station = $nom_station ;

    $date_debut = new DateTime($date_quart);
   // $date_debut->modify('first day of this month');

    $date_fin = new DateTime($date_quart);
    // $date_fin->modify('-1 day');

    $date_debut2 = $date_debut->format('Y-m-d') ;
    $date_fin2 = $date_fin->format('Y-m-d') ;
    
     $dates = [] ;
    
     $dates [] = $date_debut->format('Y-m-d') ;

     while ($date_debut < $date_fin) {
          
          $date_debut = $date_debut->modify('+1 day') ;
          
          $dates [] = $date_debut->format('Y-m-d') ;

     }

     /********************************************QUERY MANQUANTS POMPISTES ******************************************************************* */

     $query_depenses = "
     
          Select
          Sum(station.depense_station.montant_depense) As montant,
          Date(station.quart.date_ouverture) As date,
          station.depense_station.nature_depense,
          station.nom_station As station
     From
          depense_station Inner Join
          quart On depense_station.id_quart = quart.id_quart Inner Join
          station On station.quart.id_station = station.id_station
               And station.quart.id_region = station.id_region

               WHERE 
        
               (DATE( station.quart.date_ouverture ) between '$date_debut2' AND '$date_fin2' ) AND
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
               station.id_station = '$id_station'
     
     Group By
          
          Date(station.quart.date_ouverture),
          station.depense_station.nature_depense,
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
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' )  AND
               station.id_station = '$id_station'

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
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
             station.id_station = '$id_station'

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
                     $obj->nature_depense = $rows['nature_depense'] ;
                     $obj->station = $rows['station'] ;
 
                     $data_depenses[] = $obj ;
                }
           
           }
 
 
     }
   
 
  /********************************************** ******************************************************************** */
 
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
 
  /***************************************QUERY VENTES-VERSEMENT******************************************* */  

   
     $query = "
     
     Select
     Date(station.quart.date_ouverture) As date,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise)) As quantite,
     Sum((station.pompiste_pistolet.index_fermerture - station.pompiste_pistolet.index_ouverture) -
     (station.pompiste_pistolet.index_fermerture_remise - station.pompiste_pistolet.index_ouverture_remise))* produit_station.prix_produit As montant,
     station.produit.nom_produit As produit,
     station.produit_station.prix_produit As prix_unitaire,
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
               (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
               station.id_station = '$id_station'

     Group By
     Date(station.quart.date_ouverture),
     station.produit.nom_produit,
     station.produit_station.prix_produit,
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
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
             station.id_station = '$id_station'
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
  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
  station.id_station = '$id_station'
  
 GROUP BY
  
  DATE(station.quart.date_ouverture),
  station.nom_station

  " ;

  /******************************************************************************************************* */ 
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
 (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) AND
 station.station.id_station = '$id_station'

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
  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
  station.id_station = '$id_station'
  
 
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
  (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
  station.id_station = '$id_station'
  
 
  " ;
    
 /*************************************REQUETES VENTES-VERSEMENT********************************************** */

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
                    $obj->prix_unitaire = $rows['prix_unitaire'] ;

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
                    $obj->quantite = $rows['quantite'] ;
                    $obj->conditionnement = $rows['conditionnement'] ;
                    $obj->montant = floatval($rows['montant']) ;
                    $obj->prix_unitaire = floatval($rows['prix_unitaire']) ;
                    $obj->station = $rows['station'] ;
                    $obj->produit = $rows['produit'] ;

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


 /*************************TRAITEMENT BLOC VENTES-VERSEMENT**************************************** */
 /***************************** ***************************************************** */


    $datas = array() ;

    $clients = array() ;

    $vers_clients = array() ;

     $en_tete = new stdClass() ;
               
     $en_tete->date = 'DATE' ;
     $en_tete->super = 'SUPER' ;
     $en_tete->gasoil = 'GASOIL' ;
     $en_tete->petrole = 'PETROLE' ;
     $en_tete->tpc = 'TPC' ;
     $en_tete->total_carb = 'TOTAL CARB' ;
     $en_tete->total_lub = 'TOTAL LUB' ;
     $en_tete->vers_clients = [] ;
     $en_tete->total_attendu = 'TOTAL ATTENDU' ;
     $en_tete->versement = 'VERSEMENT BANQUE' ;
     $en_tete->ventes_client = 0 ;
     $en_tete->versement_pompistes = 0 ;
     $en_tete->manquant_pompiste = 'MQTS POMPISTES' ;
     $en_tete->depense = 'DEPENSES' ;
     $en_tete->ecart = 'ECART' ;
     $en_tete->ecart_gerant = 'ECART GERANT' ;
     $en_tete->clients = [] ;
     $en_tete->lien_banque = 'DOCUMENT BANQUE' ;
     $en_tete->lien_stock = 'DOCUMENT STOCK' ;

     $total = new stdClass() ;
               
     $total->date = 'TOTAL' ;
     $total->super = 0 ;
     $total->gasoil = 0 ;
     $total->petrole = 0 ;
     $total->tpc = 0 ;
     $total->total_carb = 0 ;
     $total->total_lub = 0 ;
     $total->vers_clients = [] ;
     $total->total_attendu = 0 ;
     $total->versement = 0 ;
     $total->ventes_client = 0 ;
     $total->versement_pompistes = 0 ;
     $total->manquant_pompiste = 0 ;
     $total->depense = 0 ;
     $total->ecart = 0 ;
     $total->ecart_gerant = 0 ;
     $total->clients = [] ;
     $total->lien_banque = '' ;
     $total->lien_stock = '' ;

     foreach ($data_client as $key10 => $value10) {
               
           $clients[] = $value10->client ;
          
     }

     foreach ($data_vers_client as $key11 => $value11) {
               
            $vers_clients[] = $value11->client ;
       
     }

     $en_tete->clients = array_unique($clients);
     $en_tete->vers_clients = array_unique($vers_clients);

     $datas[] = $en_tete ;

      // var_dump($datas) ;

     // CALCUL LIGNE DATE

     foreach ($dates as $key => $value) {

          $data = new stdClass() ;
          $date = $value ;

          $data->date = $value ;
          $data->super = 0 ;
          $data->prix_unitaire_super = 0 ;
          $data->montant_super = 0 ;
          $data->gasoil = 0 ;
          $data->prix_unitaire_gasoil = 0 ;
          $data->montant_gasoil = 0 ;
          $data->petrole = 0 ;
          $data->prix_unitaire_petrole = 0 ;
          $data->montant_petrole = 0 ;
          $data->tpc = 0 ;
          $data->total_carb = 0 ;
          $data->total_lub = 0 ;
          $data->vers_clients = [] ;
          $data->total_vers_clients = 0 ;
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
          $data->lien_banque = '' ;
          $data->lien_stock = '' ;


          foreach ($data_carb as $key2 => $value2) {
               
               if ($value2->date == $date) {
                    
                    if ($value2->produit == 'SUPER') {

                         $data->super += $value2->quantite ;

                        $data->prix_unitaire_super += $value2->prix_unitaire ;
                        $data->montant_super += $value2->montant ;

                        $total->super += $value2->quantite ;

                    } elseif ($value2->produit == 'GASOIL') {

                         $data->gasoil += $value2->quantite ;

                        $data->prix_unitaire_gasoil += $value2->prix_unitaire ;
                        $data->montant_gasoil += $value2->montant ;

                        $total->gasoil += $value2->quantite ;

                    } elseif ($value2->produit == 'PETROLE'){
                         
                         $data->petrole += $value2->quantite ;

                        $data->prix_unitaire_petrole += $value2->prix_unitaire ;
                        $data->montant_petrole += $value2->montant ;

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

         
          $datas[] = $data ;
   
         
     }

     // CALCUL LIGNE DE TOTAL

     $total->total_attendu = $total->total_carb + $total->total_lub ;

     foreach ($en_tete->clients as $key10 => $value10) {
   
          $client = 0 ;

          foreach ($data_client as $key11 => $value11) {


               if ($value10 == $value11->client) {
               
                    $client += $value11->montant ;
               } 
               
          }

         
          $total->clients[] = $client ;

     }

     foreach ($en_tete->vers_clients as $key => $value) {
         
        $montant = 0 ;

        foreach ($data_vers_client as $key2 => $value2) {
            
            if ($value == $value2->client) {
                
                $montant += $value2->montant ;
            }
        }

        $total->vers_clients[] = $montant ;
        $total->total_attendu += $montant ;  // incrementation sur total_attendu
     }  // incrementation sur total attendu

     $total->ecart = $total->total_attendu - $total->versement ; // calcul ecart 

     $total->manquant_pompiste = $total->total_carb - $total->ventes_client - $total->versement_pompistes ;

     $total->ecart_gerant =  $total->ecart - $total->manquant_pompiste - $total->depense ; // calcul ecart gerant

     foreach ($data_client as $key8 => $value8) {

          $total->ecart_gerant -= $value8->montant ;
               
     }

     $datas[] = $total ;

 }

 /**************************************LIEN FICHIER STOCK*************************** */

 $lien_stock = '' ;

 foreach ($data_lien_stock as $key15 => $value15) {
               
     if ($value15->date == $date_quart) {
          
      $lien_stock = $value15->lien_stock ;

     }

}
 
 $fmt = new NumberFormatter('cm-CM', NumberFormatter::DECIMAL );
 $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

/**********************************NOUVELLE VUE VENTES MODIFIEE *********************************************************************** */
     
$html10 = ' <h2>VENTES-VERSEMENT '.$nom_station.'</h2> ' ;

         $html10 .= '<table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;
         
                $html10 .= '<tr>' ;
             
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>PRODUIT</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>SUPER</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>GASOIL</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>PETROLE</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TPC</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TOTAL CARB</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TOTAL LUB</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TOTAL ATTENDU</b><td>' ;

     
                $html10 .= '</tr>' ;

               /***********************************VOLUMES**************** */

                $html10 .= '<tr>' ;
 
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>VOLUME</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($datas[1]->super).'<td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($datas[1]->gasoil).'<td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($datas[1]->petrole).'<td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->tpc).'</b><td>' ;
                
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;" ><td>' ;

     
                $html10 .= '</tr>' ;

               /*****************************VALEURS**************************************************** */

                $html10 .= '<tr>' ;
             
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>VALEURS</b><td>' ;

                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($datas[1]->total_carb).'<td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($datas[1]->total_lub).'<td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->total_carb + $datas[1]->total_lub).'</b><td>' ;

     
                $html10 .= '</tr>' ;

                /*********************************REGLEMENTS CLIENTS**************************** */

                

                /*********************************TOTAL REGLEMENTS CLIENTS*********************** */

                $html10 .= '<tr>' ;
             
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TOTAL REGL CLIENT</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; ">'.$fmt->format($datas[1]->total_vers_clients).'<td>' ;

     
                $html10 .= '</tr>' ;

                /****************************TOTAL ATTENDU**************************************************** */

                $html10 .= '<tr>' ;
             
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TOTAL ATTENDU</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->total_attendu).'</b><td>' ;

     
                $html10 .= '</tr>' ;

                /***********************VERSEMENT BANQUE********************************************************** */

                $html10 .= '<tr>' ;
             
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>VERSEMENT BANQUE</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->versement).'</b><td>' ;

     
                $html10 .= '</tr>' ;

                /**************************ECART******************************************************************************* */

                $html10 .= '<tr>' ;
             
                 
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>ECART</b><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;"><td>' ;
                $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->ecart).'</b><td>' ;

     
                $html10 .= '</tr>' ;
               
    
               /************************TOTAL VENTES CLIENTS*************************************** */
    
                    $html10 .= '<tr>' ;
                 
                     
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>TOTAL CLIENT</b><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; ">'.$fmt->format($datas[1]->total_clients).'<td>' ;
    
         
                    $html10 .= '</tr>' ;
    
                    /********************MANQUANT POMPISTE************************************************************ */
                    
                    $html10 .= '<tr>' ;
               
                    
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>MQT POMPISTE</b><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->manquant_pompiste).'</b><td>' ;

          
                    $html10 .= '</tr>' ;

                    /*********************DEPENSES************************************************************* */
                    
                    $html10 .= '<tr>' ;
             
                 
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>DEPENSE</b><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->depense).'</b><td>' ;

          
                    $html10 .= '</tr>' ;

                    /******************************ECART GERANT************************************************** */

                    $html10 .= '<tr>' ;
             
                 
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse;"><b>ECART GERANT</b><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;" ><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($datas[1]->ecart_gerant).'</b><td>' ;

          
                    $html10 .= '</tr>' ;

                    /**************************LIEN BANQUE**************************************************************** */
                    
                    $html10 .= '<tr>' ;
             
                 
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse;"><b>LIEN FICHIER BANQUE</b><td>' ;
                    $html10 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse;" colspan="7">'.$datas[1]->lien_banque.'<td>' ;

          
                    $html10 .= '</tr>' ;

         $html10 .=  '</table>' ;

/*******************************************VUE VENTES  ************************************************************ */

$html = ' <h2>VENTES-VERSEMENT '.$nom_station.'</h2> ' ;

         $html .= '<CENTER><table width=70% style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;
         
                $html .= '<tr>' ;
             
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>PRODUIT</b><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>QUANTITE</b><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>PU</b><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>MONTANT</b><td>' ;
                
     
                $html .= '</tr>' ;

               /***********************************SUPER**************** */

                $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>SUPER</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($datas[1]->super).'<td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($datas[1]->prix_unitaire_super).'<td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->montant_super).'</b><td>' ;
                
                
     
                $html .= '</tr>' ;

               /*****************************GASOIL**************************************************** */

               $html .= '<tr>' ;
 
                 
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>GASOIL</b><td>' ;

               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($datas[1]->gasoil).'<td>' ;
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($datas[1]->prix_unitaire_gasoil).'<td>' ;
               
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->montant_gasoil).'</b><td>' ;
               
               
    
               $html .= '</tr>' ;

                /*********************************PETROLE**************************** */

                $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>PETROLE</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($datas[1]->petrole).'<td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($datas[1]->prix_unitaire_petrole).'<td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->montant_petrole).'</b><td>' ;
                
                
     
                $html .= '</tr>' ;

                /*********************************TOTAL CARB*********************** */

                $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>TOTAL CARB</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->tpc).'</b><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->total_carb).'</b><td>' ;
                
                
     
                $html .= '</tr>' ;

                /****************************FOREACH SUR DATA LUB**************************************************** */

                foreach ($data_lub as $key => $value) {
                     

                    if ($value->quantite != 0) {
                         
                         $html .= '<tr>' ;
 
                 
                         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; ">'.$value->produit.'<td>' ;

                         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($value->quantite).'<td>' ;
                         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; ">'.$fmt->format($value->prix_unitaire).'<td>' ;
                         
                         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($value->montant).'</b><td>' ;
                         
               
                         $html .= '</tr>' ;
                    }
                    
                }

                /***********************TOTAL LUBRIFIANT********************************************************** */

                $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>TOTAL LUB</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->total_lub).'</b><td>' ;
                
      
                $html .= '</tr>' ;
                

                /**************************FOREACH SUR vers_client******************************************************************************* */

                foreach ($datas[1]->vers_clients as $key => $value) {
                     
                    $html .= '<tr>' ;
 
                 
                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; ">'.$datas[0]->vers_clients[$key].'<td>' ;

                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                    
                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->vers_clients[$key]).'</b><td>' ;
                    
          
                    $html .= '</tr>' ;
                }
               
               /************************TOTAL ATTENDU******************************************* */
               
               $html .= '<tr>' ;
 
                 
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>TOTAL ATTENDU</b><td>' ;

               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->total_attendu).'</b><td>' ;
               
     
               $html .= '</tr>' ;

               /************************TOTAL VERSEMENT BANQUE*************************************** */
    
               $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>VERSEMENT BANQUE</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->versement).'</b><td>' ;
                
      
                $html .= '</tr>' ;
    
               /*******************************************ECART A JUSTIFIER************************************************************ */
                    
               $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>ECART A JUSTIFIER</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->ecart).'</b><td>' ;
                
      
                $html .= '</tr>' ;

               /*******************************CREANCES******************************************** */

               $html .= '<tr>' ;
 
                 
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>CREANCES</b><td>' ;

               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->total_clients).'</b><td>' ;
               
     
               $html .= '</tr>' ; 
               

               /*********************MANQUANTS POMPISTES************************************************************* */
                    
               $html .= '<tr>' ;
 
                 
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>MQT POMPISTE</b><td>' ;

                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                
                $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->manquant_pompiste).'</b><td>' ;
                
      
                $html .= '</tr>' ; 

               /*******************************DEPENSES************************************************* */

               foreach ($data_depenses as $key => $value) {
                     
                         
                    $html .= '<tr>' ;

               
                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; ">'.$value->nature_depense.'<td>' ;

                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
                    
                    $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($value->montant).'</b><td>' ;
                    
          
                    $html .= '</tr>' ;
                    
                    
               }

               /******************************TOTAL DEPENSE************************************************** */
                    
               $html .= '<tr>' ;
 
                 
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>DEPENSE</b><td>' ;

               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->depense).'</b><td>' ;
               
     
               $html .= '</tr>' ;

               /**************************ECART GERANT**************************************************************** */
                    
               $html .= '<tr>' ;
 
                 
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;  border-collapse:collapse; height:50px; "><b>ECART GERANT</b><td>' ;

               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse; height:50px; "><b>'.$fmt->format($datas[1]->ecart_gerant).'</b><td>' ;
               
     
               $html .= '</tr>' ;

               /***************************LIEN BANQUE******************************************** */

               $html .= '<tr>' ;
 
                 
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white;  border-collapse:collapse; height:50px; "><b>FICHIER JOINT</b><td>' ;

               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><td>' ;
               
               $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse; height:50px; "><b>'.$datas[1]->lien_banque.'</b><td>' ;
               
     
               $html .= '</tr>' ;

         $html .=  '</table></CENTER>' ;  


/*************************************DEBUT REQUETES  ETAT DE CREANCES*****************************************/
    

     $date_debut = new DateTime($date_quart);
     //$date_debut->modify('-2 day');

     $date_fin = new DateTime($date_quart);
     // $date_fin->modify('-1 day');

     $date_debut2 = $date_debut->format('Y-m-d') ;
     $date_fin2 = $date_fin->format('Y-m-d') ;

     $date_init = new DateTime($date_quart);
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

        WHERE station.id_station = '$id_station'

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
                (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
                station.id_station = '$id_station'
 
               
 
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
           
                     (DATE( station.quart.date_fermerture ) <= '$date_initiale' ) AND
                     station.id_station = '$id_station'
      
                    
      
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

      DATE(quart.date_ouverture) As date,
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
          Inner Join
              quart On quart.id_station = station.id_station
                      And quart.id_region = station.id_region
                      And station.reglement.id_quart = quart.id_quart
              WHERE 
      
              (DATE(quart.date_ouverture)  between '$date_debut2' AND '$date_fin2' ) AND
              (DATE(quart.date_ouverture)  between '$date_debut2' AND '$date_fin2' ) AND
              station.id_station = '$id_station'
  Group By
      DATE(quart.date_ouverture),
      station.client.nom_client,
      station.nom_station
      
             
      
      ";  

      $query_reglement_init = "
        
      Select

      DATE(quart.date_ouverture) As date,
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
          Inner Join
              quart On quart.id_station = station.id_station
                      And quart.id_region = station.id_region
                      And station.reglement.id_quart = quart.id_quart
              WHERE 
      
              (DATE( station.reglement.date_reglement) <= '$date_initiale' ) AND 
              station.id_station = '$id_station'
  Group By
      DATE(quart.date_ouverture),
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


/********************************FIN REQUETES ETAT DE CREANCES********************************************* */

$datas_creances = array() ;

$en_tete_creance = new stdClass() ;

$en_tete_creance->code_client = 'CODE CLIENT' ;
$en_tete_creance->client = 'CLIENT' ;
$en_tete_creance->solde_anterieur = 'SOLDE ANTERIEUR' ;
$en_tete_creance->conso = 'CONSO' ;
$en_tete_creance->montant = 'MONTANT' ;
$en_tete_creance->reglement = 'REGLEMENT' ;
$en_tete_creance->solde = 'SOLDE' ;

$datas_creances[] = $en_tete_creance ;

$total_creance = new stdClass() ;

$total_creance->code_client = 'TOTAL' ;
$total_creance->client = 'TOTAL' ;
$total_creance->solde_anterieur = 0;
$total_creance->conso = 0 ;
$total_creance->montant = 0 ;
$total_creance->reglement = 0 ;
$total_creance->solde = 0 ;
   
   
foreach ($clients as $key => $value) {

  if ($value['nom_station'] == $station) {
       
     $data = new stdClass() ;

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

            $data->conso = $value5->quantite ;
            $data->montant = $value5->montant ;
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

               $data->reglement = $value8->montant ;
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



     $total_creance->conso += $data->conso ;
     $total_creance->montant += $data->montant ;
     $total_creance->reglement += $data->reglement ;

     $total_creance->solde_anterieur += $data->solde_anterieur ;
     $total_creance->solde += $data->solde ;


     if (! ($data->montant == 0 && $data->reglement == 0)) {
          
         $datas_creances[] = $data ;
     }


  }

}


$datas_creances[] = $total_creance ;

/*********************************************FIN ETAT CREANCES********************************************************* */

/*****************************************VUE ETAT CREANCES*********************************************************************** */
 

    

    $html2  = ' <h2>CREANCES CLIENTS '.$nom_station.'</h2> ' ;
    $html2  .= '<CENTER><table width=70% style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;

    foreach ($datas_creances as $key => $value) {

        if ($value->client == 'TOTAL' ) {


            $html2  .= '<tr>' ;
                
          //  $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->code_client.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->client.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->solde_anterieur).'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->conso).'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->montant).'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->reglement).'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->solde).'</b><td>' ;
           
            $html2  .= '</tr>' ;


        }elseif ($value->client == 'CLIENT') {
            
            $html2  .= '<tr>' ;
                
          //  $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->code_client.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->client.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->solde_anterieur.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->conso.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->montant.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->reglement.'</b><td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->solde.'</b><td>' ;
           
            $html2  .= '</tr>';

        }else{


            $html2  .= '<tr>' ;
            
                
          //  $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->code_client.'<td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->client.'<td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->solde_anterieur).'<td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->conso).'<td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->montant).'<td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->reglement).'<td>' ;
            $html2  .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->solde).'<td>' ;
            
        
            $html2  .= '</tr>';

        }


    }

    $html2  .= '</table></CENTER>' ;

/************************************************COULAGES*************************************************** */


$dates = [] ;
    
$date_debut = new DateTime($date_quart);
// $date_debut->modify('first day of this month');

$date_fin = new DateTime($date_quart);

$date_debut2 = $date_debut->format('Y-m-d') ;
$date_fin2 = $date_fin->format('Y-m-d') ;


$dates [] = $date_debut->format('Y-m-d') ;

while ($date_debut < $date_fin) {
     
     $date_debut = $date_debut->modify('+1 day');
     $dates [] = $date_debut->format('Y-m-d') ;

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
station.nom_station As station,
cuves.nom_cuve
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
station.nom_station,
cuves.nom_cuve


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
             $obj->nom_cuve = $rows['nom_cuve'] ;

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

/**********************************************TRAITEMENT STOCK********************************************* */

$data_stock = array() ;

$total_gasoil = new stdClass() ;

$total_gasoil->nom_cuve =  'TOTAL';
$total_gasoil->quantite =  0;
$total_gasoil->montant =  0;
$total_gasoil->produit =  '';

$total_super = new stdClass() ;

$total_super->nom_cuve =  'TOTAL';
$total_super->quantite =  0;
$total_super->montant =  0;
$total_super->produit =  '';

$total_petrole = new stdClass() ;

$total_petrole->nom_cuve =  'TOTAL';
$total_petrole->quantite =  0;
$total_petrole->montant =  0;
$total_petrole->produit =  '';

$total_general = new stdClass() ;

$total_general->nom_cuve =  'TOTAL';
$total_general->quantite =  0;
$total_general->montant =  0;
$total_general->produit =  'TPC';

foreach ($data_stock_fermerture_carb as $key => $value) {

     if ($value->date == $date_quart) {

          if ($value->produit == 'GASOIL') {

               $obj_gasoil = new stdClass() ;

               $obj_gasoil->nom_cuve =  $value->nom_cuve;
               $obj_gasoil->quantite =  $value->quantite;
               $obj_gasoil->montant =  $value->montant;
               $obj_gasoil->produit =  $value->produit;

               $data_stock[] = $obj_gasoil ;

               $total_gasoil->nom_cuve =  'TOTAL GASOIL';
               $total_gasoil->quantite +=  $value->quantite;
               $total_gasoil->montant +=  $value->montant;
               $total_gasoil->produit =  'GASOIL';

               $total_general->quantite +=  $value->quantite;
               $total_general->montant += $value->montant;

          } 


     }
     
}

$data_stock[] = $total_gasoil ;

foreach ($data_stock_fermerture_carb as $key => $value) {

     if ($value->date == $date_quart) {
          
          if ($value->produit == 'SUPER') {

               $obj_super = new stdClass() ;

               $obj_super->nom_cuve =  $value->nom_cuve;
               $obj_super->quantite =  $value->quantite;
               $obj_super->montant =  $value->montant;
               $obj_super->produit =  $value->produit;

               $data_stock[] = $obj_super ;

               $total_super->nom_cuve =  'TOTAL SUPER';
               $total_super->quantite +=  $value->quantite;
               $total_super->montant +=  $value->montant;
               $total_super->produit =  'SUPER';

               $total_general->quantite +=  $value->quantite;
               $total_general->montant += $value->montant;

          }
     }
     
}

$data_stock[] = $total_super ;

foreach ($data_stock_fermerture_carb as $key => $value) {

     if ($value->date == $date_quart) {

          if ($value->produit == 'PETROLE') {

               $obj_petrole = new stdClass() ;

               $obj_petrole->nom_cuve =  $value->nom_cuve;
               $obj_petrole->quantite =  $value->quantite;
               $obj_petrole->montant =  $value->montant;
               $obj_petrole->produit =  $value->produit;

               $data_stock[] = $obj_petrole ;

               $total_petrole->nom_cuve =  'TOTAL PETROLE';
               $total_petrole->quantite +=  $value->quantite;
               $total_petrole->montant +=  $value->montant;
               $total_petrole->produit =  'PETROLE';

               $total_general->quantite +=  $value->quantite;
               $total_general->montant += $value->montant;
               
          }
          
          

     }
     
}

$data_stock[] = $total_petrole ;
$data_stock[] = $total_general ;


/**********************************************TRAITEMENT COULAGES*************************************************** */

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


$datas_coulages = array() ;

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

                 
                   $data->sf_super_l += $value7->quantite ;
                   $data->sf_super_m += $value7->montant ;

              
              } elseif ($value7->produit == 'GASOIL') {

                   $data->sf_gasoil_l += $value7->quantite ;
                   $data->sf_gasoil_m += $value7->montant ;

              } else {

                   $data->sf_petrole_l += $value7->quantite ;
                   $data->sf_petrole_m += $value7->montant ;


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
     
     /*
     if ($data->cou_gasoil_l !== 0 && $data->cou_super_l !== 0 && $data->cou_petrole_l !== 0) {
         
        $datas_coulages[] = $data ;
     }
    */
         
     $datas_coulages[] = $data ;
       

    
    
}

     $datas_coulages[] = $data_total ;


/*************************************************VUE COULAGES*********************************** */

$html3 = ' <h2>COULAGE '.$nom_station.'</h2> ' ;
$html3 .= '<CENTER><table width=70% style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;

$html3 .= '<tr>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>DATE</b><td>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>SUPER(L)</b><td>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>GASOIL(L)</b><td>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>PETROLE(L)</b><td>' ;
// $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>LUB(L)</b><td>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>SUPER(M)</b><td>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>GASOIL(M)</b><td>' ;
$html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>PETROLE(M)</b><td>' ;
// $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>LUB(M)</b><td>' ;

$html3 .= '</tr>';



foreach ($datas_coulages as $key => $value) {

    if ($value->date == 'TOTAL') {
        
        $html3 .= '<tr>' ;

        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->date.'</b><td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_super_l.'</b><td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_gasoil_l.'</b><td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_petrole_l.'</b><td>' ;
        // $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_lubrifiant_l.'</b><td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_super_m.'</b><td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_gasoil_m.'</b><td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_petrole_m.'</b><td>' ;
        // $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$value->cou_lubrifiant_m.'</b><td>' ;

        $html3 .= '</tr>';

    } else {
        
        $html3 .= '<tr>' ;
        
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->date.'<td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_super_l).'<td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_gasoil_l).'<td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_petrole_l).'<td>' ;
        // $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_lubrifiant_l).'<td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_super_m).'<td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_gasoil_m).'<td>' ;
        $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_petrole_m).'<td>' ;
        // $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->cou_lubrifiant_m).'<td>' ;

        $html3 .= '</tr>' ;
    }

}

$html3 .=  '</table></CENTER>' ;


/**************************************REQUETES COMMENTAIRES*********************************************** */

$commentaire = array() ;

$res_commentaire=mysqli_query($conn, "

Select
station.nom_station AS station,
DATE(station.quart.date_ouverture) AS date,
station.commentaire.commentaire_ventes,
station.commentaire.commentaire_pannes
From
commentaire Inner Join
quart On commentaire.id_quart = quart.id_quart Inner Join
station On station.quart.id_station = station.id_station
        And station.quart.id_region = station.id_region

        WHERE 
   
        (DATE(station.quart.date_ouverture) between '$date_quart' AND '$date_quart' ) AND
        (DATE(station.quart.date_ouverture) between '$date_quart' AND '$date_quart' ) AND
        station.id_station = '$id_station'
    
        " ) ;



if (is_object($res_commentaire)) {

    while($rows = mysqli_fetch_array($res_commentaire))

    {

    $commentaire[] = array(

    "date"  =>   $rows['date'],
    "commentaire_ventes"  =>   $rows['commentaire_ventes'],
    "commentaire_pannes"  =>   $rows['commentaire_pannes'],
    "station"  =>   $rows['station']
        
                ) ;
    }
}


$datas_commentaire = array() ;

foreach ($commentaire as $key => $value) {

    $data = new stdClass();

    $data->station = $value['station'] ;
    $data->commentaire_ventes = $value['commentaire_ventes']  ;
    $data->commentaire_pannes = $value['commentaire_pannes'] ;


    $datas_commentaire[] = $data ;
}


/***********************************************VUE COMMENTAIRES*************************************************** */
     
    $html4 = ' <h2>COMMENTAIRES '.$nom_station.'</h2> ' ;
    $html4 .= '<CENTER><table width=70% style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;

    $html4 .= '<tr>' ;
    $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>DATE</b><td>' ;
    $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>VENTES</b><td>' ;
    $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>HOUSEKEEPING</b><td>' ;
    
    
    $html4 .= '</tr>';

    
    
    foreach ($datas_commentaire as $key => $value) {

        $html4 .= '<tr>' ;
        

            
                $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->date.'<td>' ;
                $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->commentaire_pannes.'<td>' ;
                $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->commentaire_ventes.'<td>' ;
                
                

        $html4 .= '</tr>';

    }

    $html4 .=  '</table></CENTER>' ;

/*************************************************VUE STOCK*********************************** */

$html5 = ' <h2>TABLEAU STOCK '.$nom_station.'</h2> ' ;
$html5 .= '<CENTER><table width=70% style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;

$html5 .= '<tr>' ;
$html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>CUVE</b><td>' ;
$html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>PRODUIT</b><td>' ;
$html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>QUANTITE</b><td>' ;
$html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>MONTANT</b><td>' ;


$html5 .= '</tr>';



foreach ($data_stock as $key => $value) {

    if (substr($value->nom_cuve, 0, 5) == 'TOTAL') {
        
        $html5 .= '<tr>' ;

        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->nom_cuve.'</b><td>' ;
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>'.$value->produit.'</b><td>' ;
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->quantite).'</b><td>' ;
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->montant).'</b><td>' ;
        
        $html5 .= '</tr>';

    } else {
        
        $html5 .= '<tr>' ;
        
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->nom_cuve.'<td>' ;
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->produit.'<td>' ;
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->quantite).'<td>' ;
        $html5 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->montant).'<td>' ;
        
        $html5 .= '</tr>' ;
    }

}

$html5 .=  '</table></CENTER>' ;

if ( !($lien_stock == '')) {
                     
     $html5 .= '<p><a href=http://192.168.1.3/'.$lien_stock.'>Ouvrir Fichier stock en Interne</a> | <a href=http://41.205.18.149/'.$lien_stock.'>Ouvrir Fichier stock en Externe</a></p>' ;

 }


/************************************************REQUETES OBJECTIF********************************* */

$objectifs = array() ;

$res_objectifs = mysqli_query($conn, "

Select
station.objectif_carburant,
station.objectif_gasoil,
station.objectif_super,
station.objectif_petrole

From

station
        WHERE 
        
        station.id_station = '$id_station'
    
        " ) ;



if (is_object($res_objectifs)) {

    while($rows = mysqli_fetch_array($res_objectifs))

    {

    $objectifs = array(

    
    "objectif_carburant"  =>   $rows['objectif_carburant'],
    "objectif_gasoil"  =>   $rows['objectif_gasoil'],
    "objectif_super"  =>   $rows['objectif_super'],
    "objectif_petrole"  =>   $rows['objectif_petrole']
        
                ) ;
    }
}

/******************************************************************************************* */


$numero = count($datas) ;

// var_dump($numero) ;

$last_row = $datas[$numero - 2] ;
$total_row = $datas[$numero - 1] ;

$datas_objectifs = array() ;

$objectif_gasoil = new stdClass() ;
$objectif_super = new stdClass() ;
$objectif_petrole = new stdClass() ;
$objectif_tpc = new stdClass() ;

$objectif_gasoil->produit = 'GASOIL' ;
$objectif_gasoil->objectif_jour =  $objectifs['objectif_gasoil']/30 ;
$objectif_gasoil->realisation_jour = $last_row->gasoil ;
$objectif_gasoil->ecart_jour = $objectif_gasoil->realisation_jour - $objectif_gasoil->objectif_jour ;
$objectif_gasoil->objectif_mois = $objectifs['objectif_gasoil'] ;
$objectif_gasoil->realisation_mois = $total_row->gasoil ;
$objectif_gasoil->ecart_mois = $objectif_gasoil->realisation_mois - $objectif_gasoil->objectif_mois ;
$objectif_gasoil->realisation_min = 0 ;
$objectif_gasoil->realisation_max = 0 ;
$objectif_gasoil->realisation_med = 0 ;

$objectif_super->produit = 'SUPER' ;
$objectif_super->objectif_jour =  $objectifs['objectif_super']/30 ;
$objectif_super->realisation_jour = $last_row->super ;
$objectif_super->ecart_jour = $objectif_super->realisation_jour - $objectif_super->objectif_jour ;
$objectif_super->objectif_mois = $objectifs['objectif_super'] ;
$objectif_super->realisation_mois = $total_row->super ;
$objectif_super->ecart_mois = $objectif_super->realisation_mois - $objectif_super->objectif_mois ;
$objectif_super->realisation_min = 0 ;
$objectif_super->realisation_max = 0 ;
$objectif_super->realisation_med = 0 ;

$objectif_petrole->produit = 'PETROLE' ;
$objectif_petrole->objectif_jour =  $objectifs['objectif_petrole']/30 ;
$objectif_petrole->realisation_jour = $last_row->petrole ;
$objectif_petrole->ecart_jour = $objectif_petrole->realisation_jour - $objectif_petrole->objectif_jour ;
$objectif_petrole->objectif_mois = $objectifs['objectif_petrole'] ;
$objectif_petrole->realisation_mois = $total_row->petrole ;
$objectif_petrole->ecart_mois = $objectif_petrole->realisation_mois - $objectif_petrole->objectif_mois ;
$objectif_petrole->realisation_min = 0 ;
$objectif_petrole->realisation_max = 0 ;
$objectif_petrole->realisation_med = 0 ;

$objectif_tpc->produit = 'TPC' ;
$objectif_tpc->objectif_jour =  $objectifs['objectif_carburant']/30 ;
$objectif_tpc->realisation_jour = $last_row->tpc ;
$objectif_tpc->ecart_jour = $objectif_tpc->realisation_jour - $objectif_tpc->objectif_jour ;
$objectif_tpc->objectif_mois = $objectifs['objectif_carburant'] ;
$objectif_tpc->realisation_mois =  $total_row->tpc ;
$objectif_tpc->ecart_mois = $objectif_tpc->realisation_mois - $objectif_tpc->objectif_mois ;
$objectif_tpc->realisation_min = 0 ;
$objectif_tpc->realisation_max = 0 ;
$objectif_tpc->realisation_med = 0 ;

/********************************************************************* */

$datas_objectifs[] = $objectif_gasoil ;
$datas_objectifs[] = $objectif_super ;
$datas_objectifs[] = $objectif_petrole ;
$datas_objectifs[] = $objectif_tpc ;


/***********************************************VUE OBJECTIFS*************************************************** */
     
    $html6 = ' <h2>OBJECTIFS '.$nom_station.'</h2> ' ;
    $html6 .= '<CENTER><table width=70% style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;

    $html6 .= '<tr>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>OJECTIF</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>OBJECTIF JOUR</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>REALISATION JOUR</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>ECART JOUR</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>OBJECTIF MOIS</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>REALISATION MOIS</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>ECART MOIS</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>REALISATION MIN</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>REALISATION MAX</b><td>' ;
    $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298;; border-collapse:collapse;"><b>REALISATION MEDIANE</b><td>' ;
    $html6 .= '</tr>';

    
    
    foreach ($datas_objectifs as $key => $value) {

        $html6 .= '<tr>' ;
        
          if ($value->produit == 'TPC') {

               $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; border-collapse:collapse;"><b>'.$value->produit.'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->objectif_jour).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->realisation_jour).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->ecart_jour).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->objectif_mois).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->realisation_mois).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->ecart_mois).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->realisation_min).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->realisation_max).'</b><td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background-color:#fa8298; text-align: right; border-collapse:collapse;"><b>'.$fmt->format($value->realisation_med).'</b><td>' ;
               
          } else {
               
               $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->produit.'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->objectif_jour).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->realisation_jour).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->ecart_jour).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->objectif_mois).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->realisation_mois).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->ecart_mois).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->realisation_min).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->realisation_max).'<td>' ;
                $html6 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; text-align: right; border-collapse:collapse;">'.$fmt->format($value->realisation_med).'<td>' ;
          }
          

        $html6 .= '</tr>';

    }

    $html6 .=  '</table></CENTER>' ;

     
?>