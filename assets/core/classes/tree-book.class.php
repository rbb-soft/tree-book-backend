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

            //$sqlResult=$sqlRes=$sql->fetchAll(PDO::FETCH_ASSOC);
			
			
            if($sql->rowCount() > 0){
				$resResult =[];
				
				while($row=$sql->fetchObject()){
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
				
				
				
				$result	=	array(
								"status"	=>	"ok",
								"tree"		=> $res
							);					

            }else{

                $result= array( "status" => "fail");

            }
			
			return json_encode( $result );
			
        }



        


    }// end class