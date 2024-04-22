<?php

session_start();

$document_root = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'station' . DIRECTORY_SEPARATOR . 'documents' ;

// var_dump($document_root) ;

$nom_station = $_SESSION['nomStation'];

if ( !empty( $_FILES ) ) {

    $tempPath = str_replace(" ",  "-", $_FILES[ 'file' ][ 'tmp_name' ]) ;

    @mkdir($document_root .  DIRECTORY_SEPARATOR . 'relevestock' . DIRECTORY_SEPARATOR . $nom_station, 0700);

    $uploadPath = $document_root .  DIRECTORY_SEPARATOR . 'relevestock' . DIRECTORY_SEPARATOR . $nom_station . DIRECTORY_SEPARATOR . str_replace(" ", "-", $_FILES[ 'file' ][ 'name' ]);

    var_dump($tempPath) ;
    var_dump($uploadPath) ;

    move_uploaded_file( $tempPath, $uploadPath );

    /* $date_directory = (explode(".", $uploadPath)) ;
    $date_directory2 = $date_directory[0] ;
    $date_directory3 = substr($date_directory2,-10) ;

    // var_dump($date_directory3) ;
     // var_dump($date_directory[1]) ;

    @mkdir($document_root .  DIRECTORY_SEPARATOR . 'relevestock' . DIRECTORY_SEPARATOR . $nom_station . DIRECTORY_SEPARATOR . $date_directory3, 0700);

    $destPath = $document_root .  DIRECTORY_SEPARATOR . 'relevestock' . DIRECTORY_SEPARATOR . $nom_station . DIRECTORY_SEPARATOR .$date_directory3 . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ] ;

    // var_dump($uploadPath) ;
    // var_dump($destPath) ;

    rename($uploadPath, $destPath);  */

    $answer = array( 'answer' => 'File transfer completed' );
    $json = json_encode( $answer );

    echo $json;

} else {

    echo 'No files';

}

?>