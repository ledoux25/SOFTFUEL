
<?php

session_start();

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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

 $id_station = $_SESSION['id_station'];
 $id_region = $_SESSION['id_region'];
 $userId = $_SESSION['id_user'];

$nom_station = $_SESSION['nomStation'];

$email_station = $_SESSION['userEmail'];

$email_regional = $_SESSION['email_regional'];


/* $email_direction = 'giresse.guekam@blessingpetroleum.net';
$email_superviseur = 'paul.dengoue@blessingpetroleum.net';
$email_superviseur2 = 'denis.monthe@blessingpetroleum.net';
$email_superviseur3 = 'francois.mpondo@blessingpetroleum.net';
$email_superviseur4 = 'emmanuel.fotso@blessingpetroleum.net';
$email_superviseur5 = 'herve.youdom@blessingpetroleum.net';
$email_superviseur6 = 'indra.yappi@blessingpetroleum.net';
$email_superviseur7 = 'stevin.youbi@blessingpetroleum.net';
$email_superviseur8 = 'audrey.kemayou@blessingpetroleum.net';
$email_superviseur9 = 'francois.kambe@blessingpetroleum.net';
$email_superviseur10 = 'helene.dengoue@blessingpetroleum.net';
$email_superviseur11 = 'kevin.kindzeka@blessingpetroleum.net';
$email_superviseur12 = 'arnold.noutchie@blessingpetroleum.net';
$email_superviseur13 = 'laura.moke@blessingpetroleum.net';
$email_superviseur14 = 'amedee.tchanpga@blessingpetroleum.net';

*/


if (isset($_POST["quart"])) {

    //$nom_station = $_POST["station"] ;

    $date_ou = new DateTime($_POST["date_ouverture"]);
    $date_ou = $date_ou->format('Y-m-d') ;
    $date_ouvert = new DateTime($date_ou);
    $date_ouverture = $date_ouvert->modify('+07 hours') ;
    $date_ouverture = $date_ouverture->format('Y-m-d H:i:s') ;


    $date_ou2 = new DateTime($_POST["date_ouverture"]);
    $date_ou2 = $date_ou2->format('Y-m-d') ;
    $date_ouvert2 = new DateTime($date_ou2);
    $date_ouverture2 = $date_ouvert2->modify('+17 hours') ;
    $date_ouverture2 = $date_ouvert2->format('Y-m-d H:i:s') ;

    
    $date_fer = new DateTime($_POST["date_ouverture"]);
    $date_fer = $date_fer->format('Y-m-d') ;
    $date_fermer = new DateTime($date_fer);
    $date_fermerture = $date_fermer->modify('+17 hours') ;
    $date_fermerture = $date_fermer->format('Y-m-d H:i:s') ;

    $date_fer2 = new DateTime($_POST["date_ouverture"]);
    $date_fer2 = $date_fer2->format('Y-m-d') ;
    $date_fermer2 = new DateTime($date_fer2);
    $date_fermerture2 = $date_fermer2->modify('+23 hours') ;
    $date_fermerture2 = $date_fermer2->format('Y-m-d H:i:s') ;
    
    $date_qua = new DateTime($_POST["date_ouverture"]);
    $date_qua = $date_qua->format('Y-m-d') ;
    $date_quart = new DateTime($date_qua);
    $date_quart = $date_quart->format('Y-m-d') ;
   
    /*
    if ($_POST["quart"] == 'quart 1') {
    
        $date_ouverture = new DateTime($_POST["date_ouverture"]);
        $date_ouverture = $date_ouverture->format('Y-m-d H:i:s') ;

        $date_ouverture2 = new DateTime($_POST["date_ouverture"]);
        $date_fermerture = $date_ouverture2->modify('+10 hours') ;
        $date_fermerture = $date_fermerture->format('Y-m-d H:i:s') ;

        $date_ouverture3 = new DateTime($_POST["date_ouverture"]);
        $date_quart = $date_ouverture3->modify('-07 hours') ;
        $date_quart = $date_quart->format('Y-m-d') ;
        

        //var_dump($date_ouverture) ;
        //var_dump($date_fermerture) ;

    }else {
        
        $date_ouverture = new DateTime($_POST["date_ouverture"]);
        $date_ouverture = $date_ouverture->format('Y-m-d H:i:s') ;

        $date_ouverture2 = new DateTime($_POST["date_ouverture"]);
        $date_fermerture = $date_ouverture2->modify('+06 hours') ;
        $date_fermerture = $date_fermerture->format('Y-m-d H:i:s') ;

        $date_ouverture3 = new DateTime($_POST["date_ouverture"]);
        $date_quart = $date_ouverture3->modify('-17 hours') ;
        $date_quart = $date_quart->format('Y-m-d') ;


        //var_dump($date_ouverture) ;
        //var_dump($date_fermerture) ;

    }	 
    */
       
    if (!empty( $_FILES )) {

        // LISTE DES FICHIERS AUTORISES
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];


          if(in_array($_FILES["file"]["type"],$allowedFileType)){
      
              $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
              $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];
              $targetPath = 'uploads/'.$_FILES['file']['name'];
      
              if (move_uploaded_file( $tempPath, $uploadPath )) {
      
                  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");

                  $worksheetNames = $reader->listWorksheetNames($targetPath);

                  $reader->setReadDataOnly(true);
                  $spreadsheet = $reader->load($targetPath);
                  
                  $data = [];

                  foreach ($worksheetNames as $worksheetName) {


                    if ($worksheetName == 'MIRA' && $nom_station == 'MIRA') {

                        // $worksheet = $spreadsheet->getActiveSheet();
                        $worksheet = $spreadsheet->getSheetByName('MIRA');
        
                        // Get the highest row and column numbers referenced in the worksheet
                        $highestRow = $worksheet->getHighestRow(); // e.g. 10
                        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
            
                        //var_dump($highestRow) ;
                        //var_dump($highestColumnIndex) ;


                        for ($row = 2; $row <= ($highestRow); ++$row) {
                    
                            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            
                                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                                $data[($row-2)][($col-1)] = $value ;
            
                        
                            }
                        }

                        // var_dump($data) ;
            
                        for ($i=0; $i < 1 ; $i++) { 
            
                             
                            $stock_ouverture = 0;
                            $stock_fermerture = 0;
                            $livraison = 0;
                            $index_ouverture = 0;
                            $index_fermerture = 0;
                            $index_ouverture_remise = 0;
                            $index_fermerture_remise = 0;
                            
            
                            $stock_ouverture =  intval($data[$i][0]) ;
                            $stock_fermerture =  intval($data[$i][1]) ;
                            $livraison =  intval($data[$i][2]) ;
                            $index_ouverture =  intval($data[$i][3]) ;
                            $index_fermerture =  intval($data[$i][4]) ;
                            $index_ouverture_remise =  intval($data[$i][5]) ;
                            $index_fermerture_remise =  intval($data[$i][6]) ;

                            $id_cuve = 171 ;
                            
                           // $adhesion = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($data[$i][4]);
                           // $adhesion = date ("Y-m-d H:i:s", $adhesion);
            
                        
                            $db = getDB2();
                            
                            
                            try
                            {
                               
                                $db->beginTransaction();

                                /*
                                $sql0 = "SELECT id_station, id_region FROM station WHERE nom_station = :nom_station " ;
                                
                                $stmt0 = $db->prepare($sql0);
                                $stmt0->bindParam("nom_station", $nom_station, PDO::PARAM_STR);
                                
                                $stmt0->execute();

                                $result0 = $stmt0->fetch(PDO::FETCH_OBJ);

                                $id_station = $result0->id_station ;
                                $id_region = $result0->id_region ;

                                */

                                /*******************************INSERTION 1ER QUART************************** */

                                $sql1 = "INSERT INTO `quart` (`date_ouverture`, `date_fermerture`, `userId`, `id_station`, `id_region`) VALUES (:date_ouverture, :date_fermerture, :userId, :id_station, :id_region);" ;
                                
                                $stmt1 = $db->prepare($sql1);
                                $stmt1->bindParam("date_ouverture", $date_ouverture);
                                $stmt1->bindParam("date_fermerture", $date_fermerture);
                                $stmt1->bindParam("userId", $userId, PDO::PARAM_INT);
                                $stmt1->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt1->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt1->execute();

                                /*****************************RECUPERATION ID QUART**************************** */

                                $sql2 = "SELECT MAX(id_quart) AS id_quart FROM quart WHERE id_station = :id_station AND id_region = :id_region" ;
                                
                                $stmt2 = $db->prepare($sql2);
                                $stmt2->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt2->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                
                                $stmt2->execute();

                                $result2 = $stmt2->fetch(PDO::FETCH_OBJ);

                                $id_quart = $result2->id_quart ;

                                /****************************INSERTION JAUGE QUART******************************* */

                                $sql3 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt3 = $db->prepare($sql3) ;
                                
                                $stmt3->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt3->bindParam("id_cuve", $id_cuve, PDO::PARAM_INT);
                                $stmt3->bindParam("jauge_depart", $stock_ouverture, PDO::PARAM_INT);
                                $stmt3->bindParam("jauge_fin", $stock_fermerture, PDO::PARAM_INT);

                                $stmt3->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt3->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt3->execute();

                                /******************************INSERTION LIVRAISON****************** */

                                $id_transporteur = 42 ;
                                $num_bon = 'MIRA' ;
                                $type_livraison = 'Carb' ;

                                $sql4 = "INSERT INTO `livraison` (`id_quart`, `num_bon`, `id_transporteur`, `type_livraison`) VALUES (:id_quart, :num_bon, :id_transporteur, :type_livraison);" ;
                                
                                $stmt4 = $db->prepare($sql4);
                                
                                $stmt4->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt4->bindParam("num_bon", $num_bon, PDO::PARAM_STR);
                                $stmt4->bindParam("id_transporteur", $id_transporteur, PDO::PARAM_INT);
                                $stmt4->bindParam("type_livraison", $type_livraison, PDO::PARAM_STR);

                                
                                $stmt4->execute();

                                /******************************GET ID LIVRAISON *************************** */

                                $sql5 = "SELECT MAX(id_livraison) AS id_livraison FROM livraison WHERE id_quart = :id_quart" ;
                                
                                $stmt5 = $db->prepare($sql5);
                                $stmt5->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                
                                $stmt5->execute();

                                $result5 = $stmt5->fetch(PDO::FETCH_OBJ);

                                $id_livraison = $result5->id_livraison ;

                                /*********************************INSERTION LIVRAISON 2*************************************** */

                                $id_produit = 1 ;
                                
                                $sql6 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                
                                $stmt6 = $db->prepare($sql6);
                                
                                $stmt6->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                $stmt6->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                $stmt6->bindParam("qte_commande", $livraison, PDO::PARAM_INT);
                                $stmt6->bindParam("qte_recu", $livraison, PDO::PARAM_INT);
                                $stmt6->bindParam("id_cuve", $id_cuve, PDO::PARAM_INT);
                                $stmt6->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt6->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                
                                $stmt6->execute();

                                /*****************************INSERTION PISTOLET****************** */

                                $id_pompiste = 293 ;
                                $id_pistolet = 256 ;
                                $id_pompe = 92 ;

                                
                                $sql7 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt7 = $db->prepare($sql7);
                                
                                $stmt7->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt7->bindParam("id_pistolet", $id_pistolet, PDO::PARAM_INT);
                                $stmt7->bindParam("index_ouverture", $index_ouverture, PDO::PARAM_INT);
                                $stmt7->bindParam("index_fermerture", $index_fermerture, PDO::PARAM_INT);
                                $stmt7->bindParam("index_ouverture_remise", $index_ouverture_remise, PDO::PARAM_INT);
                                $stmt7->bindParam("index_fermerture_remise", $index_fermerture_remise, PDO::PARAM_INT);
                                $stmt7->bindParam("id_cuve", $id_cuve, PDO::PARAM_INT);
                                $stmt7->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt7->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt7->bindParam("id_pompe", $id_pompe, PDO::PARAM_INT);
                                $stmt7->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                
                                $stmt7->execute();

                                /*******************************INSERTION 2EME QUART************************** */

                                $sql8 = "INSERT INTO `quart` (`date_ouverture`, `date_fermerture`, `userId`, `id_station`, `id_region`) VALUES (:date_ouverture, :date_fermerture, :userId, :id_station, :id_region);" ;
                                
                                $stmt8 = $db->prepare($sql8);
                                $stmt8->bindParam("date_ouverture", $date_ouverture2);
                                $stmt8->bindParam("date_fermerture", $date_fermerture2);
                                $stmt8->bindParam("userId", $userId, PDO::PARAM_INT);
                                $stmt8->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt8->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt8->execute();

                                /*****************************RECUPERATION ID 2eme QUART**************************** */

                                $sql9 = "SELECT MAX(id_quart) AS id_quart FROM quart WHERE id_station = :id_station AND id_region = :id_region" ;
                                
                                $stmt9 = $db->prepare($sql9);
                                $stmt9->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt9->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                
                                $stmt9->execute();

                                $result9 = $stmt9->fetch(PDO::FETCH_OBJ);

                                $id_quart = $result9->id_quart ;

                                /****************************INSERTION JAUGE 2eme QUART******************************* */

                                $sql10 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt10 = $db->prepare($sql10);
                                
                                $stmt10->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt10->bindParam("id_cuve", $id_cuve, PDO::PARAM_INT);
                                $stmt10->bindParam("jauge_depart", $stock_fermerture, PDO::PARAM_INT);
                                $stmt10->bindParam("jauge_fin", $stock_fermerture, PDO::PARAM_INT);

                                $stmt10->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt10->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt10->execute();

                                /*****************************INSERTION INDEX PISTOLET 2EME QUART ****************** */

                                $id_pompiste = 293 ;
                                $id_pistolet = 256 ;
                                $id_pompe = 92 ;

                                
                                $sql11 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt11 = $db->prepare($sql11);
                                
                                $stmt11->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt11->bindParam("id_pistolet", $id_pistolet, PDO::PARAM_INT);
                                $stmt11->bindParam("index_ouverture", $index_fermerture, PDO::PARAM_INT);
                                $stmt11->bindParam("index_fermerture", $index_fermerture, PDO::PARAM_INT);
                                $stmt11->bindParam("index_ouverture_remise", $index_fermerture_remise, PDO::PARAM_INT);
                                $stmt11->bindParam("index_fermerture_remise", $index_fermerture_remise, PDO::PARAM_INT);
                                $stmt11->bindParam("id_cuve", $id_cuve, PDO::PARAM_INT);
                                $stmt11->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt11->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt11->bindParam("id_pompe", $id_pompe, PDO::PARAM_INT);
                                $stmt11->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                
                                $stmt11->execute();

                                // *****************INSERTION VERSEMENT POMPISTE 2EME QUART*********************


                                $id_pompiste = 293 ;
                                $prix_gasoil = 575 ;
                                $montant_versement = ($index_fermerture - $index_ouverture)*$prix_gasoil;

                                
                                $sql12 = "INSERT INTO `versement_pompiste` (`id_pompiste`, `montant_versement`,  `id_quart`) VALUES (:id_pompiste, :montant_versement, :id_quart);" ;
                                
                                $stmt12 = $db->prepare($sql12);
                                
                                $stmt12->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt12->bindParam("montant_versement", $montant_versement, PDO::PARAM_INT);
                                $stmt12->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                
                                $stmt12->execute();

                                 //si jusque là tout se passe bien on valide la transaction
                                 $db->commit();


                                // Envoyer Email

                                include 'rappel_upload.php' ;

                                try {
                                            

                                    sendEmail($email_station, $email_regional, 'BLESSING '.$nom_station, $date_quart, $html.$html2.$html5.$html3.$html6.$html4) ;
                            
                                    // Response
                                    $answer = array( 'answer' => 'opération exécutée avec success' );
                                    $json = json_encode( $answer );
                                    echo $json;

                                } catch (Exception $e) {

                                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                    // Response
                                    $answer = array( 'answer' => 'opération exécutée avec success' );
                                    $json = json_encode( $answer );
                                    echo $json;
                                }

                               
                            
                               
                            }
                            catch(Exception $e) //en cas d'erreur
                            {
                                //on annule la transation
                                $db->rollback();

                                echo 'Erreur : '.$e->getMessage().'<br />';
                                echo 'N° : '.$e->getCode();

                                exit('Erreur : '.$e->getMessage().'<br />') ;

                               
                            }

                        
                        }

                    }

                    if ($worksheetName == 'NKOLBIKON' && $nom_station == 'NKOLBIKON') {

                        // $worksheet = $spreadsheet->getActiveSheet();
                        $worksheet = $spreadsheet->getSheetByName('NKOLBIKON');
        
                        /* Get the highest row and column numbers referenced in the worksheet
                        $highestRow = $worksheet->getHighestRow(); // e.g. 10
                        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
                        */

                        $livraison_CS1 = $worksheet->getCell('B2')->getValue() ;
                        $livraison_CG1 = $worksheet->getCell('B3')->getValue() ;
                        $livraison_CG2 = $worksheet->getCell('B4')->getValue() ;
                        $livraison_CP1 = $worksheet->getCell('B5')->getValue() ;

                        $stock_ouverture_CS1 = $worksheet->getCell('E2')->getValue() ;
                        $stock_ouverture_CG1 = $worksheet->getCell('E3')->getValue() ;
                        $stock_ouverture_CG2 = $worksheet->getCell('E4')->getValue() ;
                        $stock_ouverture_CP1 = $worksheet->getCell('E5')->getValue() ;

                        $stock_fermerture_CS1 = $worksheet->getCell('F2')->getValue() ;
                        $stock_fermerture_CG1 = $worksheet->getCell('F3')->getValue() ;
                        $stock_fermerture_CG2 = $worksheet->getCell('F4')->getValue() ;
                        $stock_fermerture_CP1 = $worksheet->getCell('F5')->getValue() ;

                        $index_ouverture_S1 = $worksheet->getCell('I2')->getValue() ;
                        $index_ouverture_S2 = $worksheet->getCell('I3')->getValue() ;
                        $index_ouverture_S3 = $worksheet->getCell('I4')->getValue() ;
                        $index_ouverture_S4 = $worksheet->getCell('I5')->getValue() ;
                        $index_ouverture_G1 = $worksheet->getCell('I6')->getValue() ;
                        $index_ouverture_G2 = $worksheet->getCell('I7')->getValue() ;
                        $index_ouverture_G3 = $worksheet->getCell('I8')->getValue() ;
                        $index_ouverture_G4 = $worksheet->getCell('I9')->getValue() ;
                        $index_ouverture_P1 = $worksheet->getCell('I10')->getValue() ;

                        $index_fermerture_S1 = $worksheet->getCell('J2')->getValue() ;
                        $index_fermerture_S2 = $worksheet->getCell('J3')->getValue() ;
                        $index_fermerture_S3 = $worksheet->getCell('J4')->getValue() ;
                        $index_fermerture_S4 = $worksheet->getCell('J5')->getValue() ;
                        $index_fermerture_G1 = $worksheet->getCell('J6')->getValue() ;
                        $index_fermerture_G2 = $worksheet->getCell('J7')->getValue() ;
                        $index_fermerture_G3 = $worksheet->getCell('J8')->getValue() ;
                        $index_fermerture_G4 = $worksheet->getCell('J9')->getValue() ;
                        $index_fermerture_P1 = $worksheet->getCell('J10')->getValue() ;

                        $index_remise_ouverture_S1 = $worksheet->getCell('K2')->getValue() ;
                        $index_remise_ouverture_S2 = $worksheet->getCell('K3')->getValue() ;
                        $index_remise_ouverture_S3 = $worksheet->getCell('K4')->getValue() ;
                        $index_remise_ouverture_S4 = $worksheet->getCell('K5')->getValue() ;
                        $index_remise_ouverture_G1 = $worksheet->getCell('K6')->getValue() ;
                        $index_remise_ouverture_G2 = $worksheet->getCell('K7')->getValue() ;
                        $index_remise_ouverture_G3 = $worksheet->getCell('K8')->getValue() ;
                        $index_remise_ouverture_G4 = $worksheet->getCell('K9')->getValue() ;
                        $index_remise_ouverture_P1 = $worksheet->getCell('K10')->getValue() ;

                        $index_remise_fermerture_S1 = $worksheet->getCell('L2')->getValue() ;
                        $index_remise_fermerture_S2 = $worksheet->getCell('L3')->getValue() ;
                        $index_remise_fermerture_S3 = $worksheet->getCell('L4')->getValue() ;
                        $index_remise_fermerture_S4 = $worksheet->getCell('L5')->getValue() ;
                        $index_remise_fermerture_G1 = $worksheet->getCell('L6')->getValue() ;
                        $index_remise_fermerture_G2 = $worksheet->getCell('L7')->getValue() ;
                        $index_remise_fermerture_G3 = $worksheet->getCell('L8')->getValue() ;
                        $index_remise_fermerture_G4 = $worksheet->getCell('L9')->getValue() ;
                        $index_remise_fermerture_P1 = $worksheet->getCell('L10')->getValue() ;
            
                            

                           
                            
                           // $adhesion = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($data[$i][4]);
                           // $adhesion = date ("Y-m-d H:i:s", $adhesion);
            
                        
                            $db = getDB2();
                            
                            
                            try
                            {
                               
                                $db->beginTransaction();
                               
                                /*******************************INSERTION QUART************************** */

                                $sql1 = "INSERT INTO `quart` (`date_ouverture`, `date_fermerture`, `userId`, `id_station`, `id_region`) VALUES (:date_ouverture, :date_fermerture, :userId, :id_station, :id_region);" ;
                                
                                $stmt1 = $db->prepare($sql1);
                                $stmt1->bindParam("date_ouverture", $date_ouverture);
                                $stmt1->bindParam("date_fermerture", $date_fermerture);
                                $stmt1->bindParam("userId", $userId, PDO::PARAM_INT);
                                $stmt1->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt1->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt1->execute();

                                /*****************************RECUPERATION ID QUART**************************** */

                                $sql2 = "SELECT MAX(id_quart) AS id_quart FROM quart WHERE id_station = :id_station AND id_region = :id_region" ;
                                
                                $stmt2 = $db->prepare($sql2);
                                $stmt2->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt2->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                
                                $stmt2->execute();

                                $result2 = $stmt2->fetch(PDO::FETCH_OBJ);

                                $id_quart = $result2->id_quart ;

                                /****************************INSERTION JAUGE QUART******************************* */

                                // INSERTION CS1 

                                $id_CS1 = 167 ;

                                $sql3 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt3 = $db->prepare($sql3);
                                
                                $stmt3->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt3->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt3->bindParam("jauge_depart", $stock_ouverture_CS1, PDO::PARAM_INT);
                                $stmt3->bindParam("jauge_fin", $stock_fermerture_CS1, PDO::PARAM_INT);

                                $stmt3->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt3->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt3->execute();

                                // INSERTION CG1 

                                $id_CG1 = 168 ;

                                $sql4 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt4 = $db->prepare($sql4);
                                
                                $stmt4->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt4->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                $stmt4->bindParam("jauge_depart", $stock_ouverture_CG1, PDO::PARAM_INT);
                                $stmt4->bindParam("jauge_fin", $stock_fermerture_CG1, PDO::PARAM_INT);

                                $stmt4->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt4->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt4->execute();

                                // INSERTION CG2 

                                $id_CG2 = 169 ;

                                $sql5 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt5 = $db->prepare($sql5);
                                
                                $stmt5->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt5->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                $stmt5->bindParam("jauge_depart", $stock_ouverture_CG2, PDO::PARAM_INT);
                                $stmt5->bindParam("jauge_fin", $stock_fermerture_CG2, PDO::PARAM_INT);

                                $stmt5->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt5->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt5->execute();

                                // INSERTION CP1 

                                $id_CP1 = 170 ;

                                $sql6 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt6 = $db->prepare($sql6);
                                
                                $stmt6->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt6->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                $stmt6->bindParam("jauge_depart", $stock_ouverture_CP1, PDO::PARAM_INT);
                                $stmt6->bindParam("jauge_fin", $stock_fermerture_CP1, PDO::PARAM_INT);

                                $stmt6->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt6->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt6->execute();

                                /******************************INSERTION LIVRAISON****************** */

                                if ($livraison_CS1 !== 0 || $livraison_CG1 !== 0 || $livraison_CG2 !== 0 || $livraison_CP1 !== 0) {
                                    
                                    $id_transporteur = 41 ;
                                    $num_bon = 'NKOLBIKON' ;
                                    $type_livraison = 'Carb' ;

                                    $sql7 = "INSERT INTO `livraison` (`id_quart`, `num_bon`, `id_transporteur`, `type_livraison`) VALUES (:id_quart, :num_bon, :id_transporteur, :type_livraison);" ;
                                    
                                    $stmt7 = $db->prepare($sql7);
                                    
                                    $stmt7->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                    $stmt7->bindParam("num_bon", $num_bon, PDO::PARAM_STR);
                                    $stmt7->bindParam("id_transporteur", $id_transporteur, PDO::PARAM_INT);
                                    $stmt7->bindParam("type_livraison", $type_livraison, PDO::PARAM_STR);

                                    
                                    $stmt7->execute();

                                    /******************************GET ID LIVRAISON *************************** */

                                    $sql8 = "SELECT MAX(id_livraison) AS id_livraison FROM livraison WHERE id_quart = :id_quart" ;
                                    
                                    $stmt8 = $db->prepare($sql8);
                                    $stmt8->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                    
                                    $stmt8->execute();

                                    $result8 = $stmt8->fetch(PDO::FETCH_OBJ);

                                    $id_livraison = $result8->id_livraison ;

                                    /*********************************INSERTION LIVRAISON 2*************************************** */

                                    // LIVRAISON CS1

                                    $id_produit = 2 ;
                                    
                                    $sql9 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt9 = $db->prepare($sql9);
                                    
                                    $stmt9->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt9->bindParam("qte_commande", $livraison_CS1, PDO::PARAM_INT);
                                    $stmt9->bindParam("qte_recu", $livraison_CS1, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt9->execute();

                                    // LIVRAISON CG1

                                    $id_produit = 1 ;
                                    
                                    $sql10 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt10 = $db->prepare($sql10);
                                    
                                    $stmt10->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt10->bindParam("qte_commande", $livraison_CG1, PDO::PARAM_INT);
                                    $stmt10->bindParam("qte_recu", $livraison_CG1, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt10->execute();

                                    // LIVRAISON CG2

                                    $id_produit = 1 ;
                                    
                                    $sql11 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt11 = $db->prepare($sql11);
                                    
                                    $stmt11->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt11->bindParam("qte_commande", $livraison_CG2, PDO::PARAM_INT);
                                    $stmt11->bindParam("qte_recu", $livraison_CG2, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt11->execute();

                                    // LIVRAISON CP1

                                    $id_produit = 3 ;
                                    
                                    $sql12 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt12 = $db->prepare($sql12);
                                    
                                    $stmt12->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt12->bindParam("qte_commande", $livraison_CP1, PDO::PARAM_INT);
                                    $stmt12->bindParam("qte_recu", $livraison_CP1, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt12->execute();

                                }

                                /*****************************INSERTION PISTOLET****************** */

                                $id_pompiste = 292 ;

                                $id_pistolet_S1 = 246 ;
                                $id_pistolet_S2 = 247 ;
                                $id_pistolet_S3 = 248 ;
                                $id_pistolet_S4 = 249 ;

                                $id_pistolet_G1 = 250 ;
                                $id_pistolet_G2 = 251 ;
                                $id_pistolet_G3 = 252 ;
                                $id_pistolet_G4 = 253 ;
                                $id_pistolet_P1 = 254 ;

                                $id_pompe_P1 = 87 ;
                                $id_pompe_P2 = 88 ;
                                $id_pompe_P3 = 89 ;
                                $id_pompe_P4 = 90 ;
                                $id_pompe_P5 = 91 ;

                                // PISTOLET S1

                                $sql13 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt13 = $db->prepare($sql13);
                                
                                $stmt13->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt13->bindParam("id_pistolet", $id_pistolet_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_ouverture", $index_ouverture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_fermerture", $index_fermerture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_ouverture_remise", $index_remise_ouverture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_fermerture_remise", $index_remise_fermerture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt13->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt13->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt13->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                $stmt13->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt13->execute();

                                // PISTOLET S2

                                $sql14 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt14 = $db->prepare($sql14);
                                
                                $stmt14->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt14->bindParam("id_pistolet", $id_pistolet_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_ouverture", $index_ouverture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_fermerture", $index_fermerture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_ouverture_remise", $index_remise_ouverture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_fermerture_remise", $index_remise_fermerture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt14->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt14->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt14->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                $stmt14->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt14->execute();


                                // PISTOLET S3

                                $sql15 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt15 = $db->prepare($sql15);
                                
                                $stmt15->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt15->bindParam("id_pistolet", $id_pistolet_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_ouverture", $index_ouverture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_fermerture", $index_fermerture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_ouverture_remise", $index_remise_ouverture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_fermerture_remise", $index_remise_fermerture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt15->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt15->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt15->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt15->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt15->execute();

                                // PISTOLET S4

                                $sql16 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt16 = $db->prepare($sql16);
                                
                                $stmt16->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt16->bindParam("id_pistolet", $id_pistolet_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_ouverture", $index_ouverture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_fermerture", $index_fermerture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_ouverture_remise", $index_remise_ouverture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_fermerture_remise", $index_remise_fermerture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt16->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt16->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt16->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt16->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt16->execute();

                                 // PISTOLET G1

                                 $sql17 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                 $stmt17 = $db->prepare($sql17);
                                 
                                 $stmt17->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_pistolet", $id_pistolet_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_ouverture", $index_ouverture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_fermerture", $index_fermerture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_ouverture_remise", $index_remise_ouverture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_fermerture_remise", $index_remise_fermerture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
 
                                 $stmt17->execute();

                                  // PISTOLET G2

                                  $sql18 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt18 = $db->prepare($sql18);
                                  
                                  $stmt18->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_pistolet", $id_pistolet_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_ouverture", $index_ouverture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_fermerture", $index_fermerture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_ouverture_remise", $index_remise_ouverture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_fermerture_remise", $index_remise_fermerture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt18->execute();

                                  // PISTOLET G3

                                  $sql19 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt19 = $db->prepare($sql19);
                                  
                                  $stmt19->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_pistolet", $id_pistolet_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_ouverture", $index_ouverture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_fermerture", $index_fermerture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_ouverture_remise", $index_remise_ouverture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_fermerture_remise", $index_remise_fermerture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt19->execute();

                                  // PISTOLET G4

                                  $sql20 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt20 = $db->prepare($sql20);
                                  
                                  $stmt20->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_pistolet", $id_pistolet_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_ouverture", $index_ouverture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_fermerture", $index_fermerture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_ouverture_remise", $index_remise_ouverture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_fermerture_remise", $index_remise_fermerture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt20->execute();
 
                                  // PISTOLET P1

                                  $sql21 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt21 = $db->prepare($sql21);
                                  
                                  $stmt21->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_pistolet", $id_pistolet_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_ouverture", $index_ouverture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_fermerture", $index_fermerture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_ouverture_remise", $index_remise_ouverture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_fermerture_remise", $index_remise_fermerture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_pompe", $id_pompe_P5, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt21->execute();
 

                                /*******************************INSERTION 2EME QUART************************** */

                                $sql22 = "INSERT INTO `quart` (`date_ouverture`, `date_fermerture`, `userId`, `id_station`, `id_region`) VALUES (:date_ouverture, :date_fermerture, :userId, :id_station, :id_region);" ;
                                
                                $stmt22 = $db->prepare($sql22);
                                $stmt22->bindParam("date_ouverture", $date_ouverture2);
                                $stmt22->bindParam("date_fermerture", $date_fermerture2);
                                $stmt22->bindParam("userId", $userId, PDO::PARAM_INT);
                                $stmt22->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt22->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt22->execute();

                                /*****************************RECUPERATION ID 2eme QUART**************************** */

                                $sql23 = "SELECT MAX(id_quart) AS id_quart FROM quart WHERE id_station = :id_station AND id_region = :id_region" ;
                                
                                $stmt23 = $db->prepare($sql23);
                                $stmt23->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt23->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                
                                $stmt23->execute();

                                $result23 = $stmt23->fetch(PDO::FETCH_OBJ);

                                $id_quart = $result23->id_quart ;

                                /****************************INSERTION JAUGE 2eme QUART******************************* */

                                // INSERTION CS1 

                                $id_CS1 = 167 ;

                                $sql24 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt24 = $db->prepare($sql24);
                                
                                $stmt24->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt24->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt24->bindParam("jauge_depart", $stock_fermerture_CS1, PDO::PARAM_INT);
                                $stmt24->bindParam("jauge_fin", $stock_fermerture_CS1, PDO::PARAM_INT);

                                $stmt24->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt24->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt24->execute();

                                // INSERTION CG1 

                                $id_CG1 = 168 ;

                                $sql25 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt25 = $db->prepare($sql25);
                                
                                $stmt25->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt25->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                $stmt25->bindParam("jauge_depart", $stock_fermerture_CG1, PDO::PARAM_INT);
                                $stmt25->bindParam("jauge_fin", $stock_fermerture_CG1, PDO::PARAM_INT);

                                $stmt25->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt25->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt25->execute();

                                // INSERTION CG2 

                                $id_CG2 = 169 ;

                                $sql26 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt26 = $db->prepare($sql26);
                                
                                $stmt26->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt26->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                $stmt26->bindParam("jauge_depart", $stock_fermerture_CG2, PDO::PARAM_INT);
                                $stmt26->bindParam("jauge_fin", $stock_fermerture_CG2, PDO::PARAM_INT);

                                $stmt26->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt26->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt26->execute();

                                // INSERTION CP1 

                                $id_CP1 = 170 ;

                                $sql27 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt27 = $db->prepare($sql27);
                                
                                $stmt27->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt27->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                $stmt27->bindParam("jauge_depart", $stock_fermerture_CP1, PDO::PARAM_INT);
                                $stmt27->bindParam("jauge_fin", $stock_fermerture_CP1, PDO::PARAM_INT);

                                $stmt27->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt27->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt27->execute();


                                /*****************************INSERTION INDEX PISTOLET 2EME QUART ****************** */

                                $id_pompiste = 292 ;

                                $id_pistolet_S1 = 246 ;
                                $id_pistolet_S2 = 247 ;
                                $id_pistolet_S3 = 248 ;
                                $id_pistolet_S4 = 249 ;

                                $id_pistolet_G1 = 250 ;
                                $id_pistolet_G2 = 251 ;
                                $id_pistolet_G3 = 252 ;
                                $id_pistolet_G4 = 253 ;
                                $id_pistolet_P1 = 254 ;

                                $id_pompe_P1 = 87 ;
                                $id_pompe_P2 = 88 ;
                                $id_pompe_P3 = 89 ;
                                $id_pompe_P4 = 90 ;
                                $id_pompe_P5 = 91 ;

                                // PISTOLET S1

                                $sql28 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt28 = $db->prepare($sql28);
                                
                                $stmt28->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt28->bindParam("id_pistolet", $id_pistolet_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_ouverture", $index_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_fermerture", $index_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_ouverture_remise", $index_remise_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_fermerture_remise", $index_remise_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt28->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt28->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt28->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                $stmt28->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt28->execute();

                                // PISTOLET S2

                                $sql29 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt29 = $db->prepare($sql29);
                                
                                $stmt29->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt29->bindParam("id_pistolet", $id_pistolet_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_ouverture", $index_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_fermerture", $index_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_ouverture_remise", $index_remise_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_fermerture_remise", $index_remise_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt29->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt29->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt29->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                $stmt29->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt29->execute();


                                // PISTOLET S3

                                $sql30 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt30 = $db->prepare($sql30);
                                
                                $stmt30->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt30->bindParam("id_pistolet", $id_pistolet_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_ouverture", $index_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_fermerture", $index_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_ouverture_remise", $index_remise_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_fermerture_remise", $index_remise_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt30->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt30->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt30->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt30->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt30->execute();

                                // PISTOLET S4

                                $sql31 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt31 = $db->prepare($sql31);
                                
                                $stmt31->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt31->bindParam("id_pistolet", $id_pistolet_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_ouverture", $index_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_fermerture", $index_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_ouverture_remise", $index_remise_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_fermerture_remise", $index_remise_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt31->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt31->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt31->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt31->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt31->execute();

                                 // PISTOLET G1

                                 $sql32 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                 $stmt32 = $db->prepare($sql32);
                                 
                                 $stmt32->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_pistolet", $id_pistolet_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_ouverture", $index_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_fermerture", $index_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_ouverture_remise", $index_remise_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_fermerture_remise", $index_remise_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
 
                                 $stmt32->execute();

                                  // PISTOLET G2

                                  $sql33 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt33 = $db->prepare($sql33);
                                  
                                  $stmt33->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_pistolet", $id_pistolet_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_ouverture", $index_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_fermerture", $index_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_ouverture_remise", $index_remise_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_fermerture_remise", $index_remise_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt33->execute();

                                  // PISTOLET G3

                                  $sql34 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt34 = $db->prepare($sql34);
                                  
                                  $stmt34->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_pistolet", $id_pistolet_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_ouverture", $index_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_fermerture", $index_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_ouverture_remise", $index_remise_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_fermerture_remise", $index_remise_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt34->execute();

                                  // PISTOLET G4

                                  $sql35 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt35 = $db->prepare($sql35);
                                  
                                  $stmt35->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_pistolet", $id_pistolet_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_ouverture", $index_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_fermerture", $index_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_ouverture_remise", $index_remise_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_fermerture_remise", $index_remise_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt35->execute();
 
                                  // PISTOLET P1

                                  $sql36 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt36 = $db->prepare($sql36);
                                  
                                  $stmt36->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_pistolet", $id_pistolet_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_ouverture", $index_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_fermerture", $index_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_ouverture_remise", $index_remise_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_fermerture_remise", $index_remise_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_pompe", $id_pompe_P5, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt36->execute();
 

                                 // *****************INSERTION VERSEMENT POMPISTE 2EME QUART*********************


                                 $id_pompiste = 292 ;

                                 $prix_gasoil = 584 ;
                                 $prix_super = 639 ;
                                 $prix_petrole = 359 ;

                                 $montant_gasoil = (($index_fermerture_G1 - $index_ouverture_G1)*$prix_gasoil) +
                                                   (($index_fermerture_G2 - $index_ouverture_G2)*$prix_gasoil) +
                                                   (($index_fermerture_G3 - $index_ouverture_G3)*$prix_gasoil) +
                                                   (($index_fermerture_G4 - $index_ouverture_G4)*$prix_gasoil) ;

                                 $montant_super = (($index_fermerture_S1 - $index_ouverture_S1)*$prix_super) +
                                                    (($index_fermerture_S2 - $index_ouverture_S2)*$prix_super) +
                                                    (($index_fermerture_S3 - $index_ouverture_S3)*$prix_super) +
                                                    (($index_fermerture_S4 - $index_ouverture_S4)*$prix_super) ;

                                 $montant_petrole = (($index_fermerture_P1 - $index_ouverture_P1)*$prix_petrole) ;
                                                    

                                 $montant_versement = $montant_gasoil + $montant_super + $montant_petrole ;
 
                                 
                                 $sql37 = "INSERT INTO `versement_pompiste` (`id_pompiste`, `montant_versement`,  `id_quart`) VALUES (:id_pompiste, :montant_versement, :id_quart);" ;
                                 
                                 $stmt37 = $db->prepare($sql37);
                                 
                                 $stmt37->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                 $stmt37->bindParam("montant_versement", $montant_versement, PDO::PARAM_INT);
                                 $stmt37->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
 
                                 
                                 $stmt37->execute();
 
                                /*******************************FIN TRANSACTION****************************** */

                                //si jusque là tout se passe bien on valide la transaction
                                $db->commit();

                                // Envoyer Email

                            include 'rappel_upload.php' ;

                            try {
                                        

                                sendEmail($email_station, $email_regional, 'BLESSING '.$nom_station, $date_quart, $html.$html2.$html5.$html3.$html6.$html4) ;
                        
                                // Response
                                $answer = array( 'answer' => 'opération exécutée avec success' );
                                $json = json_encode( $answer );
                                echo $json;

                            } catch (Exception $e) {

                                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                // Response
                                $answer = array( 'answer' => 'opération exécutée avec success' );
                                $json = json_encode( $answer );
                                echo $json;
                            }

                            
                               
                            }
                            catch(Exception $e) //en cas d'erreur
                            {
                                //on annule la transation
                                $db->rollback();

                                echo 'Erreur : '.$e->getMessage().'<br />';
                                echo 'N° : '.$e->getCode();

                                exit('Erreur : '.$e->getMessage().'<br />') ;

                               
                            }

                        

                    }

                    if ($worksheetName == 'KEKEM' && $nom_station == 'KEKEM') {

                        // $worksheet = $spreadsheet->getActiveSheet();
                        $worksheet = $spreadsheet->getSheetByName('KEKEM');
        
                        /* Get the highest row and column numbers referenced in the worksheet
                        $highestRow = $worksheet->getHighestRow(); // e.g. 10
                        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
                        */

                        $livraison_CS1 = $worksheet->getCell('B2')->getValue() ;
                        $livraison_CG1 = $worksheet->getCell('B3')->getValue() ;
                        $livraison_CP1 = $worksheet->getCell('B4')->getValue() ;

                        $stock_ouverture_CS1 = $worksheet->getCell('E2')->getValue() ;
                        $stock_ouverture_CG1 = $worksheet->getCell('E3')->getValue() ;
                        $stock_ouverture_CP1 = $worksheet->getCell('E4')->getValue() ;

                        $stock_fermerture_CS1 = $worksheet->getCell('F2')->getValue() ;
                        $stock_fermerture_CG1 = $worksheet->getCell('F3')->getValue() ;
                        $stock_fermerture_CP1 = $worksheet->getCell('F4')->getValue() ;

                        $index_ouverture_S1 = $worksheet->getCell('I2')->getValue() ;
                        $index_ouverture_S2 = $worksheet->getCell('I3')->getValue() ;
                        $index_ouverture_S3 = $worksheet->getCell('I4')->getValue() ;
                        $index_ouverture_G1 = $worksheet->getCell('I5')->getValue() ;
                        $index_ouverture_G2 = $worksheet->getCell('I6')->getValue() ;
                        $index_ouverture_G3 = $worksheet->getCell('I7')->getValue() ;
                        $index_ouverture_P1 = $worksheet->getCell('I8')->getValue() ;

                        $index_fermerture_S1 = $worksheet->getCell('J2')->getValue() ;
                        $index_fermerture_S2 = $worksheet->getCell('J3')->getValue() ;
                        $index_fermerture_S3 = $worksheet->getCell('J4')->getValue() ;
                        $index_fermerture_G1 = $worksheet->getCell('J5')->getValue() ;
                        $index_fermerture_G2 = $worksheet->getCell('J6')->getValue() ;
                        $index_fermerture_G3 = $worksheet->getCell('J7')->getValue() ;
                        $index_fermerture_P1 = $worksheet->getCell('J8')->getValue() ;

                        $index_remise_ouverture_S1 = $worksheet->getCell('K2')->getValue() ;
                        $index_remise_ouverture_S2 = $worksheet->getCell('K3')->getValue() ;
                        $index_remise_ouverture_S3 = $worksheet->getCell('K4')->getValue() ;
                        $index_remise_ouverture_G1 = $worksheet->getCell('K5')->getValue() ;
                        $index_remise_ouverture_G2 = $worksheet->getCell('K6')->getValue() ;
                        $index_remise_ouverture_G3 = $worksheet->getCell('K7')->getValue() ;
                        $index_remise_ouverture_P1 = $worksheet->getCell('K8')->getValue() ;

                        $index_remise_fermerture_S1 = $worksheet->getCell('L2')->getValue() ;
                        $index_remise_fermerture_S2 = $worksheet->getCell('L3')->getValue() ;
                        $index_remise_fermerture_S3 = $worksheet->getCell('L4')->getValue() ;
                        $index_remise_fermerture_G1 = $worksheet->getCell('L5')->getValue() ;
                        $index_remise_fermerture_G2 = $worksheet->getCell('L6')->getValue() ;
                        $index_remise_fermerture_G3 = $worksheet->getCell('L7')->getValue() ;
                        $index_remise_fermerture_P1 = $worksheet->getCell('L8')->getValue() ;
            
                        
                            $db = getDB2();
                            
                            
                            try
                            {
                               
                                $db->beginTransaction();
                               
                                /*******************************INSERTION QUART************************** */

                                $sql1 = "INSERT INTO `quart` (`date_ouverture`, `date_fermerture`, `userId`, `id_station`, `id_region`) VALUES (:date_ouverture, :date_fermerture, :userId, :id_station, :id_region);" ;
                                
                                $stmt1 = $db->prepare($sql1);
                                $stmt1->bindParam("date_ouverture", $date_ouverture);
                                $stmt1->bindParam("date_fermerture", $date_fermerture);
                                $stmt1->bindParam("userId", $userId, PDO::PARAM_INT);
                                $stmt1->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt1->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt1->execute();

                                /*****************************RECUPERATION ID QUART**************************** */

                                $sql2 = "SELECT MAX(id_quart) AS id_quart FROM quart WHERE id_station = :id_station AND id_region = :id_region" ;
                                
                                $stmt2 = $db->prepare($sql2);
                                $stmt2->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt2->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                
                                $stmt2->execute();

                                $result2 = $stmt2->fetch(PDO::FETCH_OBJ);

                                $id_quart = $result2->id_quart ;

                                /****************************INSERTION JAUGE QUART******************************* */

                                // INSERTION CS1 

                                $id_CS1 = 164 ;

                                $sql3 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt3 = $db->prepare($sql3);
                                
                                $stmt3->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt3->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt3->bindParam("jauge_depart", $stock_ouverture_CS1, PDO::PARAM_INT);
                                $stmt3->bindParam("jauge_fin", $stock_fermerture_CS1, PDO::PARAM_INT);

                                $stmt3->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt3->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt3->execute();

                                // INSERTION CG1 

                                $id_CG1 = 165 ;

                                $sql4 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt4 = $db->prepare($sql4);
                                
                                $stmt4->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt4->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                $stmt4->bindParam("jauge_depart", $stock_ouverture_CG1, PDO::PARAM_INT);
                                $stmt4->bindParam("jauge_fin", $stock_fermerture_CG1, PDO::PARAM_INT);

                                $stmt4->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt4->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt4->execute();

                                /* INSERTION CG2 

                                $id_CG2 = 169 ;

                                $sql5 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt5 = $db->prepare($sql5);
                                
                                $stmt5->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt5->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                $stmt5->bindParam("jauge_depart", $stock_ouverture_CG2, PDO::PARAM_INT);
                                $stmt5->bindParam("jauge_fin", $stock_fermerture_CG2, PDO::PARAM_INT);

                                $stmt5->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt5->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt5->execute();

                                */

                                // INSERTION CP1 

                                $id_CP1 = 166 ;

                                $sql6 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt6 = $db->prepare($sql6);
                                
                                $stmt6->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt6->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                $stmt6->bindParam("jauge_depart", $stock_ouverture_CP1, PDO::PARAM_INT);
                                $stmt6->bindParam("jauge_fin", $stock_fermerture_CP1, PDO::PARAM_INT);

                                $stmt6->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt6->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt6->execute();

                                /******************************INSERTION LIVRAISON****************** */

                                if ($livraison_CS1 !== 0 || $livraison_CG1 !== 0  || $livraison_CP1 !== 0) {
                                    
                                    $id_transporteur = 43 ;
                                    $num_bon = 'KEKEM' ;
                                    $type_livraison = 'Carb' ;

                                    $sql7 = "INSERT INTO `livraison` (`id_quart`, `num_bon`, `id_transporteur`, `type_livraison`) VALUES (:id_quart, :num_bon, :id_transporteur, :type_livraison);" ;
                                    
                                    $stmt7 = $db->prepare($sql7);
                                    
                                    $stmt7->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                    $stmt7->bindParam("num_bon", $num_bon, PDO::PARAM_STR);
                                    $stmt7->bindParam("id_transporteur", $id_transporteur, PDO::PARAM_INT);
                                    $stmt7->bindParam("type_livraison", $type_livraison, PDO::PARAM_STR);

                                    
                                    $stmt7->execute();

                                    /******************************GET ID LIVRAISON *************************** */

                                    $sql8 = "SELECT MAX(id_livraison) AS id_livraison FROM livraison WHERE id_quart = :id_quart" ;
                                    
                                    $stmt8 = $db->prepare($sql8);
                                    $stmt8->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                    
                                    $stmt8->execute();

                                    $result8 = $stmt8->fetch(PDO::FETCH_OBJ);

                                    $id_livraison = $result8->id_livraison ;

                                    /*********************************INSERTION LIVRAISON 2*************************************** */

                                    // LIVRAISON CS1

                                    $id_produit = 2 ;
                                    
                                    $sql9 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt9 = $db->prepare($sql9);
                                    
                                    $stmt9->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt9->bindParam("qte_commande", $livraison_CS1, PDO::PARAM_INT);
                                    $stmt9->bindParam("qte_recu", $livraison_CS1, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt9->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt9->execute();

                                    // LIVRAISON CG1

                                    $id_produit = 1 ;
                                    
                                    $sql10 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt10 = $db->prepare($sql10);
                                    
                                    $stmt10->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt10->bindParam("qte_commande", $livraison_CG1, PDO::PARAM_INT);
                                    $stmt10->bindParam("qte_recu", $livraison_CG1, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt10->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt10->execute();

                                    /* LIVRAISON CG2

                                    $id_produit = 1 ;
                                    
                                    $sql11 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt11 = $db->prepare($sql11);
                                    
                                    $stmt11->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt11->bindParam("qte_commande", $livraison_CG2, PDO::PARAM_INT);
                                    $stmt11->bindParam("qte_recu", $livraison_CG2, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt11->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt11->execute();

                                    */

                                    // LIVRAISON CP1

                                    $id_produit = 3 ;
                                    
                                    $sql12 = "INSERT INTO `livraison_carburant` (`id_livraison`, `id_produit`, `qte_commande`, `qte_recu`, `id_cuve`, `id_station`, `id_region`) VALUES (:id_livraison, :id_produit, :qte_commande, :qte_recu, :id_cuve, :id_station, :id_region);" ;
                                    
                                    $stmt12 = $db->prepare($sql12);
                                    
                                    $stmt12->bindParam("id_livraison", $id_livraison, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_produit", $id_produit, PDO::PARAM_INT);
                                    $stmt12->bindParam("qte_commande", $livraison_CP1, PDO::PARAM_INT);
                                    $stmt12->bindParam("qte_recu", $livraison_CP1, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                    $stmt12->bindParam("id_region", $id_region, PDO::PARAM_INT);

                                    
                                    $stmt12->execute();

                                }

                                /*****************************INSERTION PISTOLET****************** */

                                $id_pompiste = 294 ;

                                $id_pistolet_S1 = 239 ;
                                $id_pistolet_S2 = 240 ;
                                $id_pistolet_S3 = 241 ;

                                $id_pistolet_G1 = 242 ;
                                $id_pistolet_G2 = 243 ;
                                $id_pistolet_G3 = 244 ;
                                $id_pistolet_P1 = 245 ;

                                $id_pompe_P1 = 83 ;
                                $id_pompe_P2 = 84 ;
                                $id_pompe_P3 = 85 ;
                                $id_pompe_P4 = 86 ;
                                

                                // PISTOLET S1

                                $sql13 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt13 = $db->prepare($sql13);
                                
                                $stmt13->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt13->bindParam("id_pistolet", $id_pistolet_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_ouverture", $index_ouverture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_fermerture", $index_fermerture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_ouverture_remise", $index_remise_ouverture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("index_fermerture_remise", $index_remise_fermerture_S1, PDO::PARAM_INT);
                                $stmt13->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt13->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt13->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt13->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                $stmt13->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt13->execute();

                                // PISTOLET S2

                                $sql14 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt14 = $db->prepare($sql14);
                                
                                $stmt14->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt14->bindParam("id_pistolet", $id_pistolet_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_ouverture", $index_ouverture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_fermerture", $index_fermerture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_ouverture_remise", $index_remise_ouverture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("index_fermerture_remise", $index_remise_fermerture_S2, PDO::PARAM_INT);
                                $stmt14->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt14->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt14->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt14->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                $stmt14->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt14->execute();


                                // PISTOLET S3

                                $sql15 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt15 = $db->prepare($sql15);
                                
                                $stmt15->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt15->bindParam("id_pistolet", $id_pistolet_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_ouverture", $index_ouverture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_fermerture", $index_fermerture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_ouverture_remise", $index_remise_ouverture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("index_fermerture_remise", $index_remise_fermerture_S3, PDO::PARAM_INT);
                                $stmt15->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt15->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt15->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt15->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt15->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt15->execute();

                                /* PISTOLET S4

                                $sql16 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt16 = $db->prepare($sql16);
                                
                                $stmt16->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt16->bindParam("id_pistolet", $id_pistolet_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_ouverture", $index_ouverture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_fermerture", $index_fermerture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_ouverture_remise", $index_remise_ouverture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("index_fermerture_remise", $index_remise_fermerture_S4, PDO::PARAM_INT);
                                $stmt16->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt16->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt16->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt16->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt16->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt16->execute();

                                */

                                 // PISTOLET G1

                                 $sql17 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                 $stmt17 = $db->prepare($sql17);
                                 
                                 $stmt17->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_pistolet", $id_pistolet_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_ouverture", $index_ouverture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_fermerture", $index_fermerture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_ouverture_remise", $index_remise_ouverture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("index_fermerture_remise", $index_remise_fermerture_G1, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                 $stmt17->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
 
                                 $stmt17->execute();

                                  // PISTOLET G2

                                  $sql18 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt18 = $db->prepare($sql18);
                                  
                                  $stmt18->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_pistolet", $id_pistolet_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_ouverture", $index_ouverture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_fermerture", $index_fermerture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_ouverture_remise", $index_remise_ouverture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("index_fermerture_remise", $index_remise_fermerture_G2, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                  $stmt18->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt18->execute();

                                  // PISTOLET G3

                                  $sql19 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt19 = $db->prepare($sql19);
                                  
                                  $stmt19->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_pistolet", $id_pistolet_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_ouverture", $index_ouverture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_fermerture", $index_fermerture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_ouverture_remise", $index_remise_ouverture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("index_fermerture_remise", $index_remise_fermerture_G3, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                  $stmt19->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt19->execute();

                                  /* PISTOLET G4

                                  $sql20 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt20 = $db->prepare($sql20);
                                  
                                  $stmt20->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_pistolet", $id_pistolet_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_ouverture", $index_ouverture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_fermerture", $index_fermerture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_ouverture_remise", $index_remise_ouverture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("index_fermerture_remise", $index_remise_fermerture_G4, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt20->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt20->execute();

                                  */
 
                                  // PISTOLET P1

                                  $sql21 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt21 = $db->prepare($sql21);
                                  
                                  $stmt21->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_pistolet", $id_pistolet_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_ouverture", $index_ouverture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_fermerture", $index_fermerture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_ouverture_remise", $index_remise_ouverture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("index_fermerture_remise", $index_remise_fermerture_P1, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt21->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt21->execute();
 

                                /*******************************INSERTION 2EME QUART************************** */

                                $sql22 = "INSERT INTO `quart` (`date_ouverture`, `date_fermerture`, `userId`, `id_station`, `id_region`) VALUES (:date_ouverture, :date_fermerture, :userId, :id_station, :id_region);" ;
                                
                                $stmt22 = $db->prepare($sql22);
                                $stmt22->bindParam("date_ouverture", $date_ouverture2);
                                $stmt22->bindParam("date_fermerture", $date_fermerture2);
                                $stmt22->bindParam("userId", $userId, PDO::PARAM_INT);
                                $stmt22->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt22->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt22->execute();

                                /*****************************RECUPERATION ID 2eme QUART**************************** */

                                $sql23 = "SELECT MAX(id_quart) AS id_quart FROM quart WHERE id_station = :id_station AND id_region = :id_region" ;
                                
                                $stmt23 = $db->prepare($sql23);
                                $stmt23->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt23->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                
                                $stmt23->execute();

                                $result23 = $stmt23->fetch(PDO::FETCH_OBJ);

                                $id_quart = $result23->id_quart ;

                                /****************************INSERTION JAUGE 2eme QUART******************************* */

                                // INSERTION CS1 

                                $id_CS1 = 164 ;

                                $sql24 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt24 = $db->prepare($sql24);
                                
                                $stmt24->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt24->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt24->bindParam("jauge_depart", $stock_fermerture_CS1, PDO::PARAM_INT);
                                $stmt24->bindParam("jauge_fin", $stock_fermerture_CS1, PDO::PARAM_INT);

                                $stmt24->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt24->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt24->execute();

                                // INSERTION CG1 

                                $id_CG1 = 165 ;

                                $sql25 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt25 = $db->prepare($sql25);
                                
                                $stmt25->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt25->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                $stmt25->bindParam("jauge_depart", $stock_fermerture_CG1, PDO::PARAM_INT);
                                $stmt25->bindParam("jauge_fin", $stock_fermerture_CG1, PDO::PARAM_INT);

                                $stmt25->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt25->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt25->execute();

                                /* INSERTION CG2 

                                $id_CG2 = 169 ;

                                $sql26 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt26 = $db->prepare($sql26);
                                
                                $stmt26->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt26->bindParam("id_cuve", $id_CG2, PDO::PARAM_INT);
                                $stmt26->bindParam("jauge_depart", $stock_fermerture_CG2, PDO::PARAM_INT);
                                $stmt26->bindParam("jauge_fin", $stock_fermerture_CG2, PDO::PARAM_INT);

                                $stmt26->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt26->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt26->execute();

                                */

                                // INSERTION CP1 

                                $id_CP1 = 166 ;

                                $sql27 = "INSERT INTO `jauge_quart` (`id_quart`, `id_cuve`, `jauge_depart`, `jauge_fin`, `id_station`, `id_region`) VALUES (:id_quart, :id_cuve, :jauge_depart, :jauge_fin, :id_station, :id_region);" ;
                                
                                $stmt27 = $db->prepare($sql27);
                                
                                $stmt27->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
                                $stmt27->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                $stmt27->bindParam("jauge_depart", $stock_fermerture_CP1, PDO::PARAM_INT);
                                $stmt27->bindParam("jauge_fin", $stock_fermerture_CP1, PDO::PARAM_INT);

                                $stmt27->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt27->bindParam("id_region", $id_region, PDO::PARAM_STR);
                                $stmt27->execute();


                                /*****************************INSERTION INDEX PISTOLET 2EME QUART ****************** */

                                $id_pompiste = 294 ;

                                $id_pistolet_S1 = 239 ;
                                $id_pistolet_S2 = 240 ;
                                $id_pistolet_S3 = 241 ;

                                $id_pistolet_G1 = 242 ;
                                $id_pistolet_G2 = 243 ;
                                $id_pistolet_G3 = 244 ;
                                $id_pistolet_P1 = 245 ;

                                $id_pompe_P1 = 83 ;
                                $id_pompe_P2 = 84 ;
                                $id_pompe_P3 = 85 ;
                                $id_pompe_P4 = 86 ;

                                // PISTOLET S1

                                $sql28 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt28 = $db->prepare($sql28);
                                
                                $stmt28->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt28->bindParam("id_pistolet", $id_pistolet_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_ouverture", $index_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_fermerture", $index_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_ouverture_remise", $index_remise_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("index_fermerture_remise", $index_remise_fermerture_S1, PDO::PARAM_INT);
                                $stmt28->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt28->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt28->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt28->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                $stmt28->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt28->execute();

                                // PISTOLET S2

                                $sql29 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt29 = $db->prepare($sql29);
                                
                                $stmt29->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt29->bindParam("id_pistolet", $id_pistolet_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_ouverture", $index_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_fermerture", $index_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_ouverture_remise", $index_remise_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("index_fermerture_remise", $index_remise_fermerture_S2, PDO::PARAM_INT);
                                $stmt29->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt29->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt29->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt29->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                $stmt29->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt29->execute();


                                // PISTOLET S3

                                $sql30 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt30 = $db->prepare($sql30);
                                
                                $stmt30->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt30->bindParam("id_pistolet", $id_pistolet_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_ouverture", $index_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_fermerture", $index_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_ouverture_remise", $index_remise_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("index_fermerture_remise", $index_remise_fermerture_S3, PDO::PARAM_INT);
                                $stmt30->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt30->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt30->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt30->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt30->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt30->execute();

                                /* PISTOLET S4

                                $sql31 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                $stmt31 = $db->prepare($sql31);
                                
                                $stmt31->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                $stmt31->bindParam("id_pistolet", $id_pistolet_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_ouverture", $index_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_fermerture", $index_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_ouverture_remise", $index_remise_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("index_fermerture_remise", $index_remise_fermerture_S4, PDO::PARAM_INT);
                                $stmt31->bindParam("id_cuve", $id_CS1, PDO::PARAM_INT);
                                $stmt31->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                $stmt31->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                $stmt31->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                $stmt31->bindParam("id_quart", $id_quart, PDO::PARAM_INT);

                                $stmt31->execute();

                                */

                                 // PISTOLET G1

                                 $sql32 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                 $stmt32 = $db->prepare($sql32);
                                 
                                 $stmt32->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_pistolet", $id_pistolet_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_ouverture", $index_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_fermerture", $index_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_ouverture_remise", $index_remise_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("index_fermerture_remise", $index_remise_fermerture_G1, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_pompe", $id_pompe_P1, PDO::PARAM_INT);
                                 $stmt32->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
 
                                 $stmt32->execute();

                                  // PISTOLET G2

                                  $sql33 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt33 = $db->prepare($sql33);
                                  
                                  $stmt33->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_pistolet", $id_pistolet_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_ouverture", $index_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_fermerture", $index_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_ouverture_remise", $index_remise_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("index_fermerture_remise", $index_remise_fermerture_G2, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_pompe", $id_pompe_P2, PDO::PARAM_INT);
                                  $stmt33->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt33->execute();

                                  // PISTOLET G3

                                  $sql34 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt34 = $db->prepare($sql34);
                                  
                                  $stmt34->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_pistolet", $id_pistolet_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_ouverture", $index_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_fermerture", $index_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_ouverture_remise", $index_remise_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("index_fermerture_remise", $index_remise_fermerture_G3, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_pompe", $id_pompe_P3, PDO::PARAM_INT);
                                  $stmt34->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt34->execute();

                                  /* PISTOLET G4

                                  $sql35 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt35 = $db->prepare($sql35);
                                  
                                  $stmt35->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_pistolet", $id_pistolet_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_ouverture", $index_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_fermerture", $index_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_ouverture_remise", $index_remise_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("index_fermerture_remise", $index_remise_fermerture_G4, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_cuve", $id_CG1, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt35->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt35->execute();

                                  */
 
                                  // PISTOLET P1

                                  $sql36 = "INSERT INTO `pompiste_pistolet` (`id_pompiste`, `id_pistolet`, `index_ouverture`, `index_fermerture`, `index_ouverture_remise`, `index_fermerture_remise`, `id_cuve`, `id_station`, `id_region`, `id_pompe`, `id_quart`) VALUES (:id_pompiste, :id_pistolet, :index_ouverture, :index_fermerture, :index_ouverture_remise, :index_fermerture_remise, :id_cuve, :id_station, :id_region, :id_pompe, :id_quart);" ;
                                
                                  $stmt36 = $db->prepare($sql36);
                                  
                                  $stmt36->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_pistolet", $id_pistolet_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_ouverture", $index_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_fermerture", $index_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_ouverture_remise", $index_remise_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("index_fermerture_remise", $index_remise_fermerture_P1, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_cuve", $id_CP1, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_station", $id_station, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_region", $id_region, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_pompe", $id_pompe_P4, PDO::PARAM_INT);
                                  $stmt36->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
  
                                  $stmt36->execute();

                                  // *****************INSERTION VERSEMENT POMPISTE 2EME QUART*********************


                                 $id_pompiste = 294 ;

                                 $prix_gasoil = 583 ;
                                 $prix_super = 638 ;
                                 $prix_petrole = 358 ;

                                 $montant_gasoil = (($index_fermerture_G1 - $index_ouverture_G1)*$prix_gasoil) +
                                                   (($index_fermerture_G2 - $index_ouverture_G2)*$prix_gasoil) +
                                                   (($index_fermerture_G3 - $index_ouverture_G3)*$prix_gasoil)
                                                    ;

                                 $montant_super = (($index_fermerture_S1 - $index_ouverture_S1)*$prix_super) +
                                                    (($index_fermerture_S2 - $index_ouverture_S2)*$prix_super) +
                                                    (($index_fermerture_S3 - $index_ouverture_S3)*$prix_super)
                                                     ;

                                 $montant_petrole = (($index_fermerture_P1 - $index_ouverture_P1)*$prix_petrole) ;
                                                    

                                 $montant_versement = $montant_gasoil + $montant_super + $montant_petrole ;
 
                                 
                                 $sql37 = "INSERT INTO `versement_pompiste` (`id_pompiste`, `montant_versement`,  `id_quart`) VALUES (:id_pompiste, :montant_versement, :id_quart);" ;
                                 
                                 $stmt37 = $db->prepare($sql37);
                                 
                                 $stmt37->bindParam("id_pompiste", $id_pompiste, PDO::PARAM_INT);
                                 $stmt37->bindParam("montant_versement", $montant_versement, PDO::PARAM_INT);
                                 $stmt37->bindParam("id_quart", $id_quart, PDO::PARAM_INT);
 
                                 
                                 $stmt37->execute();
 

                                
                                /*******************************FIN TRANSACTION****************************** */

                                //si jusque là tout se passe bien on valide la transaction
                                $db->commit();

                                // Envoyer Email

                                include 'rappel_upload.php' ;

                                try {
                                            

                                    sendEmail($email_station, $email_regional, 'BLESSING '.$nom_station, $date_quart, $html.$html2.$html5.$html3.$html6.$html4) ;
                            
                                    // Response
                                    $answer = array( 'answer' => 'opération exécutée avec success' );
                                    $json = json_encode( $answer );
                                    echo $json;

                                } catch (Exception $e) {

                                    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                    // Response
                                    $answer = array( 'answer' => 'opération exécutée avec success' );
                                    $json = json_encode( $answer );
                                    echo $json;
                                }

                            
                               
                            }
                            catch(Exception $e) //en cas d'erreur
                            {
                                //on annule la transation
                                $db->rollback();

                                echo 'Erreur : '.$e->getMessage().'<br />';
                                echo 'N° : '.$e->getCode();

                                exit('Erreur : '.$e->getMessage().'<br />') ;

                               
                            }

                            

                    }

                  }
      
                  
                  /* Response
                  $answer = array( 'answer' => 'opération exécutée avec success' );
                  $json = json_encode( $answer );
                  echo $json;
                  */
              }
                          
          }else{ 
      
               // Response
              $answer = array( 'answer' => 'Le type de fichier ne correspond pas' );
              $json = json_encode( $answer );
              echo $json;
                          
          }
      
      
    }else {
          
          // Response
          $answer = array( 'answer' => 'Pas de fichier Joint' );
          $json = json_encode( $answer );
          echo $json;
      
    }
      
}else{
    
    /* Response
    $answer = array( 'answer' => 'Pas de station selectionnée' );
    $json = json_encode( $answer );
    echo $json;

    */

}




    

?>