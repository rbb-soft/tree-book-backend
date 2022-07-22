<?php
    error_reporting(-1);
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    
    $data = json_decode(file_get_contents("php://input"),true);
    
    $checkPost= isset($data['action']) ? true : false;

    if(!$checkPost){
        echo json_encode(array("status" => "empty post!"));
        exit;
    }else{
        require_once"core/classes/tree-book.class.php";
		$treeBook = new TreeBook();
	}
	
	switch($data['action']){

        case "getJson":
			echo $treeBook->GetPersons( $treeBook->GetLastNameCloud("d0a12fc3-25e6-42b2-8403-536cf3b9b7bb") );
		break;
	////
		case "setJson":
			echo $treeBook->SetPersons($data['tree'],$data['lastnameCloud']);
		break;
	////
		case "getShortBio":
			echo $treeBook->getShortBio($data['id']);
		break;
	//// 
		default:
			echo json_encode( array("status" => "ninguna peticion!") );
		break;
	}