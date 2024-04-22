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

        $sheet->setCellValueByColumnAndRow($index, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+1, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+2, 1, $value) ;
        $sheet->setCellValueByColumnAndRow($index+3, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+4, 1, '') ;
        $sheet->setCellValueByColumnAndRow($index+5, 1, '') ;

        $index += 6 ;

      }

      $index = 1 ;

      foreach ($stations_unique as $key => $value) {
        
        $sheet->setCellValueByColumnAndRow($index, 2, '') ;
        $sheet->setCellValueByColumnAndRow($index+1, 2, 'RECETTE DECLARE') ;
        $sheet->setCellValueByColumnAndRow($index+2, 2, 'MONTANT VERSE') ;
        $sheet->setCellValueByColumnAndRow($index+3, 2, 'N° BORDEREAU COTRAVA') ;
        $sheet->setCellValueByColumnAndRow($index+4, 2, 'OBSERVATION BANCAIRE') ;
        $sheet->setCellValueByColumnAndRow($index+5, 2, 'ECART') ;

        $index += 6 ;

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
  
              $sheet->setCellValueByColumnAndRow($index_colonne+1, $index_ligne, $value->montant) ;
              $sheet->setCellValueByColumnAndRow($index_colonne+2, $index_ligne, 0) ;
              $sheet->setCellValueByColumnAndRow($index_colonne+3, $index_ligne, '') ;
              $sheet->setCellValueByColumnAndRow($index_colonne+4, $index_ligne, '') ;
              $sheet->setCellValueByColumnAndRow($index_colonne+5, $index_ligne, 0) ;
      
              
  
            }
    
          }

          $index_colonne += 6 ;
  
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