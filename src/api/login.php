<?php

 session_start();

  $host_name = 'localhost';
  $database = 'station';
  $user_name = 'station';
  $password = 'station';

  $conn=mysqli_connect($host_name, $user_name, $password, $database);

 if (isset($_GET['logout'])) {

    unset($_SESSION['id_user']);
    unset($_SESSION['id_station']);
    unset($_SESSION['id_region']);

    session_unset();
    session_destroy();

  //  header("Location: index.php");

    exit;
    
  }

 // connect DB
 $conn=mysqli_connect($host_name, $user_name, $password, $database);
    // recuperer l' Id du patient
    $data = json_decode(file_get_contents("php://input"));
    $nom  =  $data->name;
    $password  =  $data->password;
    $errMSG = '';
// print_r($data);
   
    // clean user inputs to prevent sql injections
    $nameuser = trim($nom);
    $nameuser = strip_tags($nom);
    $nameuser = htmlspecialchars($nom);
    
    $pass = trim($password);
    $pass = strip_tags($password);
    $pass = htmlspecialchars($password);


    $res=mysqli_query($conn, "

      SELECT
   users.userName,
   users.userEmail,
   users.userId,
   users.userPass,
   users.role,
   users.id_station,
   users.id_region,
   station.nom_station,
   station.code_station,
   station.email_station,
   station.nom_gerant,
   station.telephone_gerant,
   station.objectif_carburant,
   station.objectif_lubrifiant,
   station.objectif_coulage,
   station.email_regional,
   station.telephone_regional
   From
   users Inner Join
   station On users.id_station = station.id_station And users.id_region =
      station.id_region WHERE userName='$nameuser'

   /*     SELECT userId, userName, userPass, userEmail, role, id_station, id_region FROM users WHERE userName='$nameuser' */

         ") ;

    $rows=mysqli_fetch_array($res) ;
    $count = mysqli_num_rows($res) ; // if uname/pass correct it returns must be 1 row
    
    //var_dump($res);
    //var_dump($count);

    if( $count == 1 && $rows['userPass']==$pass ) {

        $_SESSION['id_user']= $rows['userId'];
        $_SESSION['id_station']= $rows['id_station'];
        $_SESSION['id_region']= $rows['id_region'];
        $_SESSION['userEmail']= $rows['userEmail'];
        $_SESSION['nomStation']= $rows['nom_station'];
        $_SESSION['code_station']= $rows['code_station'];
        $_SESSION['email_regional']= $rows['email_regional'];

       // var_dump($_SESSION['email_regional']);

        $nom_user= $rows['userName'];
        $email_user= $rows['userEmail'];
        $role_user= $rows['role'];
        $nom_station= $rows['nom_station'];
        $email_station= $rows['email_station'];
        $nom_gerant= $rows['nom_gerant'];
        $telephone_gerant= $rows['telephone_gerant'];

        $objectif_carburant = $rows['objectif_carburant'];
        $objectif_lubrifiant = $rows['objectif_lubrifiant'];
        $objectif_coulage = $rows['objectif_coulage'];
        $email_regional = $rows['email_regional'];
        $telephone_regional = $rows['telephone_regional'];
        
     //   $photo_user= $rows['photo_profil'];
        $arr = array('msg' => "success", 'id' => $_SESSION['id_user'], 'nom' => $nom_user, 'email' => $email_user, 'role' => $role_user, 'id_station' => $_SESSION['id_station'], 'id_region' => $_SESSION['id_region'],'nom_station' => $nom_station, 'email_station' => $email_station, 'nom_gerant' => $nom_gerant,
         'telephone_gerant' => $telephone_gerant, 'objectif_carburant' => $objectif_carburant );

        

        $jsn = json_encode($arr);
        print_r($jsn);

     }else{

        exit;
     }

    
     

?>


