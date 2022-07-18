 <?php
 header('Content-Type: application/json; charset=utf-8');
 error_reporting(-1);
$mysqli = new mysqli("localhost","rbbautor","ABRIL28042015","treebook");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Perform query
if ($sql = $mysqli -> query("SELECT * 
								FROM person 
								where last_name 
								LIKE '%barolin%' 
								OR last_name LIKE '%bueno%'
								OR last_name LIKE '%dasilva%'
								ORDER BY person_id
								")) {
  
 // $row= $sql ->fetch_all(MYSQLI_ASSOC);
  
  
  
}



while($row=$sql->fetch_object()){
	$resResult=[];
	unset($spouses);
	unset($children);
	unset($father);
	unset($mother);
	
	
	$data = array(
					"id"    =>  $row->id,
					"data"  =>  array(
										"first name" => $row->first_name,
										"last name"  => $row->last_name,
										"birthday"   => $row->birthday,
										"avatar"	 => $row->avatar,
										"gender"	 => $row->gender
													)
								);
				
	if( $row->spouses != "" ){
		$spouses = array("rels" => array("spouses" => explode(",",$row->spouses) ));
	}
	if( $row->children != "" ){
		$children = array("rels" => array("children" => explode(",",$row->children) ));
	}
	if($row->father != ""){
		$father = array("rels" => array("father" => $row->father));
	}
	if($row->mother != ""){
		$mother = array("rels" => array("mother" => $row->mother));
	}
					
	if( (isset($father)) ){     $resResult = array_replace_recursive($father,$resResult);   }
	if( (isset($mother)) ){     $resResult = array_replace_recursive($mother,$resResult);   }
	if( (isset($spouses)) ){    $resResult = array_replace_recursive($spouses,$resResult);  }
	if( (isset($children)) ){   $resResult = array_replace_recursive($children,$resResult); }
	$res[] = array_merge($data,$resResult);
} 

$mysqli -> close();
?> 


<?php
print_r( json_encode($res) );
//print_r( $res );
?>

