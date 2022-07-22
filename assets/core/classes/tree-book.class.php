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
					unset($tree);
					$tree = new stdclass;
					$tree->data=[];
					$tree->rels = new stdclass;
					$tree->id = $row->id;
					$tree->data = array	(
											"first name"	=> $row->first_name,
											"last name"		=> $row->last_name,
											"birthday" 		=> $row->birthday,
											"avatar" 		=> $row->avatar,
											"gender" 		=> $row->gender,
										);
					if($row->father != ""){
						$tree->rels->father = $row->father;
					}
					if($row->mother != ""){
						$tree->rels->mother = $row->mother;
					}
					if($row->spouses != ""){
						$tree->rels->spouses = explode(",",$row->spouses);
					}
					if($row->children != ""){
						$tree->rels->children = explode(",",$row->children);
					}
					$res[]= $tree;
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
		public function SetPersons($tree,$lastnameCloud){
			$rows=0;
			$result = [];
			
			foreach($tree as $person){
			////
				if($this->base->query("	SELECT * 
										FROM person 
										WHERE id = '$person[id]'")->rowCount() > 0 )
				{
					$spouses	= isset($person['rels']["spouses"])		? implode(",",$person['rels']["spouses"]) : "";
					$children	= isset($person['rels']["children"])	? implode(",",$person['rels']["children"]) : "";
					$father		= isset($person['rels']["father"])		? $person['rels']["father"] : "";
					$mother		= isset($person['rels']["mother"])		? $person['rels']["mother"] : "";
					
					$sql=$this->base->query(
					"	UPDATE person 
						SET	first_name	= '" . $person['data']["first name"]."', 
						last_name		= '" . $person['data']["last name"] ."', 
						birthday		= '" . $person['data']["birthday"]	."',
						avatar			= '" . $person['data']["avatar"]	."',
						gender			= '" . $person['data']["gender"]	."',
						spouses			= '" . $spouses	."',
						children		= '" . $children	."',
						father			= '" . $father	."',
						mother			= '" . $mother	."',
						lastnames_tree	= '" . implode(",",$lastnameCloud)	."'
						WHERE id = '$person[id]'");
				////
					if( $sql->rowCount() > 0 ){
						$rows++;
						$result = array	(
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
					$father		= isset($person['rels']["father"]) 	? $person['rels']["father"] : "";
					$mother		= isset($person['rels']["mother"]) 	? $person['rels']["mother"] : "";
					$spouses	= isset($person['rels']["spouses"])	? implode(",",$person['rels']["spouses"]) : "";
					$children	= isset($person['rels']["children"])? implode(",",$person['rels']["children"]) : "";
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
													'" . implode(",",$lastnameCloud) ."')");
					if( $sql->rowCount() > 0 ){
						$rows++;
						$result = array(
										"status" => "ok",
										"insert" => "agragados $rows"
										);
					}
				}
			////
			}
			
			return json_encode($result);
		}
        /****************************************************************************************************** */
		public function getShortBio($id){
				$sql=$this->base->query("SELECT * FROM person_bio WHERE person_id = '$id'");
				
				if($sql->rowCount() > 0){
					$row = $sql->fetchObject();
					$result = array(	
										"status"	=> "ok",
										"bio"		=>	$row
										);
				}else{
					$result = array(
										"status" => "fail",
										"message" => $sql->errorCode()
										);
				}
				
				return json_encode($result);

		}
		/****************************************************************************************************** */
		public function GetLastNameCloud($id){
			$sql=$this->base->query("SELECT * FROM person WHERE id ='$id'");
			if($sql->rowCount() > 0){
				
					return $sql->fetchObject()->lastnames_tree;
			}
		}
		/****************************************************************************************************** */
    }// end class