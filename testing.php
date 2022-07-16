<?php

/**
 * @author Christian
 * @copyright 2022
 */
 /**/


$data = array(
                "data" => array(
                                "fisrt name" => "Nelson",
                                "last name" => "Barolin",
                                "birthday" => "1954",
                                "avatar" => "assets",
                                "gender" => "M",
                )
);


$father = array("rels" => array("father" => "Elvio Barolin"));

$mother = array("rels" => array("mother" => "Marta Maeso"));

$spouses = array("rels" => array("spouses" => ["lourdes", "griselda"]));

$children = array("rels" => array("children" => ["Nelsito", "richard"]));

$resResult =[];
if( (isset($father)) ){     $resResult = array_replace_recursive($father,$resResult);   }
if( (isset($mother)) ){     $resResult = array_replace_recursive($mother,$resResult);   }
if( (isset($spouses)) ){    $resResult = array_replace_recursive($spouses,$resResult);  }
if( (isset($children)) ){   $resResult = array_replace_recursive($children,$resResult); }

$res[] = array_replace_recursive($resResult,$data);



?>

<pre>
<?php
print_r( $res );
?>
</pre>