<?php
	error_reporting(-1);
    require_once"core/classes/db.class.php";

    

    class TreeBook extends ConectDB{

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        // constructor for connect to DB /////////////////////////////////////////////////////////////////////////

        //////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function __construct(){

            parent::__construct();

        }

        /****************************************************************************************************** */

        // methods for get Json Family Tree

        /****************************************************************************************************** */

        public function GetPersons($string){
		///
			$val = explode(",",$string );
			$LIKE ="last_name LIKE " ."'%" . $val[0] ."%'";
			array_shift($val);
			foreach($val as $lastname){
				$LIKE.=" OR last_name LIKE '%$lastname%'";
			}
		///
            $sql=$this->base->query("SELECT * FROM person WHERE $LIKE");
			if($sql->rowCount() > 0){
				while($row=$sql->fetchObject()){
					$resResult= array("rels" => []);
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
				
					if($row->spouses != ""){
						$spouses = array("rels" => array("spouses" => explode(",",$row->spouses) ));
					}
					if($row->children != ""){
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
				$result	=	array(
								"status"	=>	"ok",
								"tree"		=> $res
							);					
			}else{
				$result= array( "status" => "fail");
			}
			return json_encode( $result );
		}
		/****************************************************************************************************** */
		public function SetPersons($tree){
			$rows=0;
			$result = [];
			
			foreach($tree as $person){
			////
				if($this->base->query("	SELECT * 
										FROM person 
										WHERE id = '$person[id]'")->rowCount() > 0 )
				{
					
					$sql=$this->base->query( "	UPDATE person 
												SET	first_name	= '" . $person['data']["first name"] ."', 
													last_name	= '" . $person['data']["last name"] ."', 
													birthday	= '" . $person['data']["birthday"] ."',
													avatar		= '" . $person['data']["avatar"] ."',
													gender		= '" . $person['data']["gender"] ."' 
												WHERE id = '$person[id]'");
				////
					if( $sql->rowCount() > 0 ){
						$rows++;
						$result = array(
										"status" => "ok",
										"update" => "actualizado $rows personas"
										);
					}
				////
				}else{
					unset($father);
					unset($mother);
					unset($spouses);
					unset($children);
					$father		= isset($person['data']["father"]) 	? $person['data']["father"] : "";
					$mother		= isset($person['data']["mother"]) 	? $person['data']["mother"] : "";
					$spouses	= isset($person['data']["spouses"])	? implode(",",$person['data']["spouses"]) : "";
					$children	= isset($person['data']["children"])? implode(",",$person['data']["children"]) : "";
					$sql=$this->base->query("INSERT INTO 
												person(
													person_id,
													id, 
													father,
													mother,
													spouses,
													children,
													first_name,
													last_name,
													birthday,
													avatar, 
													gender, 
													lastnames_tree
													) 
												VALUES (
													 NULL, 
													'$person[id]', 
													'$father', 
													'$mother', 
													'$spouses', 
													'$children', 
													'" . $person['data']["first name"] ."', 
													'" . $person['data']["last name"] ."', 
													'" . $person['data']["birthday"] ."', 
													'" . $person['data']["avatar"] ."',
													'" . $person['data']["gender"] ."',
													'')");
					if( $sql->rowCount() > 0 ){
						$rows++;
						$result = array(
										"status" => "ok",
										"insert" => $person['data']["first name"]
										);
					}
				}
			////
			}
			
			return json_encode($result);
		}
        


    }// end class