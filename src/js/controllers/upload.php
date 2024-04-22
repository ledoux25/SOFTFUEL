<?php

session_start();

$document_root = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'station' . DIRECTORY_SEPARATOR . 'documents' ;

// var_dump($document_root) ;

$nom_station = $_SESSION['nomStation'];

if ( !empty( $_FILES ) ) {

    $tempPath = str_replace(" ",  "-", $_FILES[ 'file' ][ 'tmp_name' ]) ;

    @mkdir($document_root .  DIRECTORY_SEPARATOR . 'relevebanque' . DIRECTORY_SEPARATOR . $nom_station, 0700);

    $uploadPath = $document_root .  DIRECTORY_SEPARATOR . 'relevebanque' . DIRECTORY_SEPARATOR . $nom_station . DIRECTORY_SEPARATOR . str_replace(" ", "-", $_FILES[ 'file' ][ 'name' ]);

    var_dump($tempPath) ;
    var_dump($uploadPath) ;

    move_uploaded_file( $tempPath, $uploadPath );

    

    // rename($uploadPath, $destPath);

    $answer = array( 'answer' => 'File transfer completed' );
    $json = json_encode( $answer );

    echo $json;

} else {

    echo 'No files';

}

?>