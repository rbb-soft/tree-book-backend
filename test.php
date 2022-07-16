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
								LIKE '%BAROLIN%' 
								OR last_name LIKE '%BUENO%'
								OR last_name LIKE '%DASILVA%'
								")) {
  
  //$row= $result ->fetch_all();
  
}


$resResult=[];
while($row=$sql->fetch_object()){
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
				
	if( count( explode(",",$row->spouses) ) > 0 ){
		$spouses = array("rels" => array("spouses" => explode(",",$row->spouses) ));
	}
	if( count( explode(",",$row->children) ) > 0 ){
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
	$res[] = array_merge($resResult,$data);
} 

$mysqli -> close();
?> 


<?php
print_r( json_encode($res) );
?>
