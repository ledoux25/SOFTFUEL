<?php


session_start();

$userEmail = $_SESSION['userEmail'];
$nomStation = $_SESSION['nomStation'];

     require 'src/Exception.php';
     require 'src/PHPMailer.php';
     require 'src/SMTP.php';		// PHP Mailer
     require 'src/Osms.php';    // Orange API
     
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;
     use \Osms\Osms;
     
     
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
    
     
     function sendSMSOrange ($numero, $nom, $carte){
          
          $config = array(
         'clientId' => 'SM8smir6BI9GRCmm8nO8NGtwE77YsAxU',
         'clientSecret' => 'ceXlaaFPISni4Gm6'
     );
     
     
         $osms = new Osms($config);
         $osms->setVerifyPeerSSL(false);
     
         // retrieve an access token
          
         $response = $osms->getTokenFromConsumerKey();
          
          
          if (empty($response['error'])) {
               
          echo $response['access_token'];
         
          } else {
               
                echo $response['error'];
          }
          
               
         if (!empty($response['access_token'])) {
               
               
             $senderAddress = 'tel:+237699008194';
             $receiverAddress = 'tel:+237'.$numero ;
             $message = 'Bonjour M/Mme '.$nom.' . Votre abonnement CANAL+ N°'.$carte.' arrive à expiration dans 4 Jours.' ;
             $senderName = 'Global Cleaning';
     
             $osms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);
               
         } else {
     
             echo $response['error'] ;
             
         }   
     
     
     }
     
     function sendEmail($email, $html){

         $userEmail = $_SESSION['userEmail'];
         $nomStation = $_SESSION['nomStation'];
     
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
               
         $mail->setFrom('softfuel@blessingpetroleum.net', 'SOFTFUEL') ;
         $mail->addAddress($email);     // Add a recipient
      // $mail->addAddress('ellen@example.com');               // Name is optional
         $mail->addReplyTo($userEmail, $nomStation);
      // $mail->addCC('info@intelcameroun.net');
      // $mail->addBCC('');
     
               //Attachments
               
      //    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
               //Content
               
         $mail->isHTML(true);    // Set email format to HTML                  
         $mail->Subject = 'REPORTING JOURNALIER '.$nomStation ;
         $mail->Body    = $html ;
     
      // $mail->AltBody = 'Felicitation M.'.$nom.' votre inscription a été correctement prise en compte!';
     
         $mail->send();
                
     
     }
     
     // Function Etats des ventes reseau
     
         $host_name = 'localhost';
         $database = 'station';
         $user_name = 'station';
         $password = 'station';
       
       
        // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
       
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
                      (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
                      station.id_station = '$id_station'

            
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
                       (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
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
             (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
             station.id_station = '$id_station'
     
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
            (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
            station.id_station = '$id_station'
            
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
         (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
         station.id_station = '$id_station'
         
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
       
           
     
     // FIn Etats_Ventes_Reseau ;
     
     
     /*********************************************ETATS COULAGE RESEAU********************************************************** */
     
     
         $host_name = 'localhost';
         $database = 'station';
         $user_name = 'station';
         $password = 'station';
        
       
        // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
       
       
            $stations = [] ;
            $produits = ['GASOIL', 'SUPER', 'PETROLE'] ;
     
     
            $date_debut = date_create();
            $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
            $date_debut2 = date_format($date_debut, 'Y-m-d') ;
     
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
         (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
         station.id_station = '$id_station'
     
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
         (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
         station.id_station = '$id_station'
         
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
                 (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
                 station.id_station = '$id_station'
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
                 (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
                 station.id_station = '$id_station'
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
         (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
         station.id_station = '$id_station'
     
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
         station.id_station = '$id_station'
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
         (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
         station.id_station = '$id_station'
         
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
         (DATE( station.quart.date_fermerture ) between '$date_debut2' AND '$date_fin2' ) AND
         station.id_station = '$id_station'
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
       
     
            $datas_coulage = array() ;
     
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
                                  $data->freinte = $data->vte_gasoil_l * -0.02 ;
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
                                  $data->freinte = $data->vte_super_l * -0.02  ;
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
                                  $data->freinte = $data->vte_petrole_l * -0.02  ;
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
     
                             $datas_coulage[] = $data ;
                        }
     
                        $data_separation = new stdClass();
     
                        $data_separation->si = '' ;
                        $data_separation->liv = '' ;
                        $data_separation->vte = '' ;
                        $data_separation->st = '' ;
                        $data_separation->sf = '' ;
                        $data_separation->freinte = '' ;
                        $data_separation->appreciation = '' ;
     
                        $datas_coulage[] = $data_separation ;
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
            
     
                 $datas_coulage[] = $data_total_gasoil ;
                 $datas_coulage[] = $data_total_super ;
                 $datas_coulage[] = $data_total_petrole ;
     
       
           
     /*********************************************FIN ETAT COULAGE RESEAU********************************************************* */
     
     /*********************************************DEBUT ETAT CREANCES********************************************************* */
     
         $host_name = 'localhost';
         $database = 'station';
         $user_name = 'station';
         $password = 'station';
       
       
        // connect DB
        $conn=mysqli_connect($host_name, $user_name, $password, $database);
       
          
            $date_fin = $station =  '' ;
     
            $date_init = date_create();
            $date_init2 = date_add($date_debut, date_interval_create_from_date_string('-2 days'));
            $date_initiale = date_format($date_debut, 'Y-m-d') ;
     
            $date_debut = date_create();
            $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
            $date_debut2 = date_format($date_debut, 'Y-m-d') ;
     
            $date_fin2 = $date_debut2 ;
     
            $stations = [] ;
     
             
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
                    
               WHERE 
                    station.id_station = '$id_station'

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
        
                            $obj = new stdClass();
        
                            $obj->date = $rows['date'] ;
                            $obj->client = $rows['client'] ;
                            $obj->quantite = intval($rows['quantite']) ;
                            $obj->montant = intval($rows['montant']) ;
                            $obj->station = $rows['station'] ;
        
                            $data_client[] = $obj ;
     
                            $stations[] = $rows['station'] ;
                  
                  }
        
        
            }
     
     
            $res_client_init = mysqli_query($conn, $query_client_init );
        
            $data_client_init = array();
        
            if (is_object($res_client_init)) {
        
        
                  while($rows = mysqli_fetch_array($res_client_init))
        
                  {
        
                            $obj = new stdClass();
        
                            $obj->date = $rows['date'] ;
                            $obj->client = $rows['client'] ;
                            $obj->quantite = intval($rows['quantite']) ;
     
                            $obj->montant = intval($rows['montant']) ;
                            $obj->station = $rows['station'] ;
        
                            $data_client_init[] = $obj ;
     
                            $stations[] = $rows['station'] ;
                  
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
                    (DATE(station.reglement.date_reglement) between '$date_debut2' AND '$date_fin2' ) AND
                    station.id_station = '$id_station'
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
                 
                    (DATE( station.reglement.date_reglement) <= '$date_initiale' ) AND
                    station.id_station = '$id_station'
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
       
                      $obj = new stdClass();
       
                           $obj->date = $rows['date'] ;
                           $obj->client = $rows['client'] ;
                           $obj->station = $rows['station'] ;
                           $obj->montant = intval($rows['montant']) ;
       
                           $data_reglement_init[] = $obj ;
     
                           $stations[] = $rows['station'] ;
       
              }
     
           }
     
           $res_reglement = mysqli_query($conn, $query_reglement );
       
           $data_reglement = array();
       
           if (is_object($res_reglement)) {
       
              while($rows = mysqli_fetch_array($res_reglement))
       
             {
       
                      $obj = new stdClass();
       
                           $obj->date = $rows['date'] ;
                           $obj->client = $rows['client'] ;
                           $obj->station = $rows['station'] ;
                           $obj->montant = intval($rows['montant']) ;
       
                           $data_reglement[] = $obj ;
     
                           $stations[] = $rows['station'] ;
       
             }
           }
     
     
         $stations_unique = array_unique($stations) ;
     
         $datas_creance = array() ;
     
            foreach ($stations_unique as $key10 => $value10) {
     
             foreach ($clients as $key => $value) {
     
                 if ($value['nom_station'] == $value10) {
                      
        
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
                    $data->station = $value10 ;
                    $data->solde = 0 ;
        
                   
                    foreach ($data_client as $key5 => $value5) {
          
                         
                         if ($value5->station == $value10 && $value5->client == $client) {
          
                           $data->conso += $value5->quantite ;
                           $data->montant += $value5->montant ;
                           $data->station = $value5->station ;
                             
                         }
                    }
        
                    foreach ($data_client_init as $key6 => $value6) {
                         
                      if ($value6->station == $value10 && $value6->client == $client) {
        
                        $montant += $value6->montant ;
                          
                      }
                    }
          
                    foreach ($data_reglement as $key8 => $value8) {
          
                         
                         if ($value8->station == $value10 && $value8->client == $client) {
          
                              $data->reglement += $value8->montant ;
                              $data->station = $value8->station ;
          
                         }
                    }
        
                    foreach ($data_reglement_init as $key9 => $value9) {
          
                      if ($value9->station == $value10 && $value9->client == $client) {
        
                           $reglement += $value9->montant ;
        
                      }
                    }
        
                    $data->solde_anterieur = $solde_initial + $montant - $reglement ;
                    $data->solde =  $data->solde_anterieur + $data->montant - $data->reglement ;
        
                    if (! ($data->montant == 0 && $data->reglement == 0)) {
                         
                        $datas_creance[] = $data ;
                    }
        
        
                 }
          
             }
        
            }
       
       
            
       /*********************************************FIN ETAT CREANCES********************************************************* */
        
     
         $date_debut = date_create();
         $date_debut = date_add($date_debut, date_interval_create_from_date_string('-1 days'));
         $date_debut2 = date_format($date_debut, 'Y-m-d') ;
     
         $date_fin2 = $date_debut2 ;
         
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
            
                 (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) AND
                 (DATE(station.quart.date_ouverture) between '$date_debut2' AND '$date_fin2' ) 
             
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
     
     
         //var_dump($datas);
         //var_dump($datas_coulage);
         //var_dump($datas_creance);
         //var_dump($datas_commentaire);
                 
       /*********************************************FIN COMMENTAIRE********************************************************* */
     
     
         /*****************************************VUE VENTES*********************************************************************** */
     
         $html = ' <h2>Ventes | Versements du '.$date_debut2.'</h2> ' ;
         $html .= '<table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;
     
         $html .= '<tr>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STATION<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">SUPER<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">GASOIL<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">PETROLE<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">TPC<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">TOTAL CARB<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">TOTAL LUB<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">TOTAL ATTENDU<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">VERSEMENT<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">ECART<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">CLIENTS<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">MQT POMPISTE<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">DEPENSES<td>' ;
         $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">ECART GERANT<td>' ;
         $html .= '</tr>';
     
         
         
         foreach ($datas as $key => $value) {
     
             $html .= '<tr>' ;
             
     
                 
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->station.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->super.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->gasoil.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->petrole.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->tpc.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->total_carb.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->total_lub.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->total_attendu.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->versement.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->ecart.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->ventes_client.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->manquant_pompiste.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->depense.'<td>' ;
                     $html .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->ecart_gerant.'<td>' ;
                     
     
             $html .= '</tr>';
     
         }
     
         $html .=  '</table>' ;
     
         /***********************************************VUE COULAGE*************************************************** */
     
       
     
         $html2 = ' <h2>Stocks | Coulages</h2> ' ;
         $html2 .= '<table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;
     
         $html2 .= '<tr>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STATIONS<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">PRODUIT<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STOCK INITIAL<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">LIVRAISON<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">VENTES<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STOCK THEORIQUE<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STOCK PHYSIQUE<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">COULAGE<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">FREINTE<td>' ;
         $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">APPRECIATION<td>' ;
         
         $html2 .= '</tr>';
     
         
         
         foreach ($datas_coulage as $key => $value) {
     
             $html2 .= '<tr>' ;
             
                 
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->station.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->produit.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->si.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->liv.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->vte.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->st.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->sf.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->cou.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->freinte.'<td>' ;
             $html2 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->appreciation.'<td>' ;
             
             
     
             $html2 .= '</tr>';
     
         }
     
         $html2 .=  '</table>' ;
     
         /***********************************************FIN VUE COULAGE*************************************************** */
     
     
         $html3 = ' <h2>Creances | Clients</h2> ' ;
         $html3 .= '<table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;
     
         $html3 .= '<tr>' ;
         $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STATION<td>' ;
         $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">CODE CLIENT<td>' ;
         $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">CLIENT<td>' ;
         $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">CONSO<td>' ;
         $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">MONTANT<td>' ;
         $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">REGLEMENT<td>' ;
         
         $html3 .= '</tr>';
     
         
         
         foreach ($datas_creance as $key => $value) {
     
             $html3 .= '<tr>' ;
             
     
                 
                     $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->station.'<td>' ;
                     $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->code_client.'<td>' ;
                     $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->client.'<td>' ;
                     $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->conso.'<td>' ;
                     $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->montant.'<td>' ;
                     $html3 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->reglement.'<td>' ;
                     
     
             $html3 .= '</tr>';
     
         }
     
         $html3 .=  '</table>' ;
     
         /***********************************************VUE COMMENTAIRES*************************************************** */
     
         $html4 = ' <h2>Commentaires | Stations</h2> ' ;
         $html4 .= '<table style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">' ;
     
         $html4 .= '<tr>' ;
         $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">STATION<td>' ;
         $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">VENTES<td>' ;
         $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">HOUSEKEEPING<td>' ;
         
         
         $html4 .= '</tr>';
     
         
         
         foreach ($datas_commentaire as $key => $value) {
     
             $html4 .= '<tr>' ;
             
     
                 
                     $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->station.'<td>' ;
                     $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->commentaire_ventes.'<td>' ;
                     $html4 .= '<td style="border:1px solid #D9D5BE; margin:10px; background:white; border-collapse:collapse;">'.$value->commentaire_pannes.'<td>' ;
                     
                     
     
             $html4 .= '</tr>';
     
         }
     
         $html4 .=  '</table>' ;
     
         
     
         // sendEmail('denis.monthe@blessingpetroleum.net', $html.'TEST SOFTFUEL OK') ;
         // sendSMSOrange($numero, $nom, $carte) ;
     
     
             try {
                    
                    if(count($datas) != 0) {
     
                    sendEmail($userEmail, $html.$html2.$html3.$html4) ;
                    sendEmail('denis.monthe@blessingpetroleum.net', $html.$html2.$html3.$html4) ;
                    sendEmail('giresse.guekam@blessingpetroleum.net', $html.$html2.$html3.$html4) ;
                    // sendEmail('paul.dengoue@blessingpetroleum.net', $html) ;
                    // sendEmail('francois.kambe@blessingpetroleum.net', $html) ;
                    // sendEmail('francois.mpondo@blessingpetroleum.net', $html) ;
          
                    }
     
             } catch (Exception $e) {
                 echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
             }
     

?>