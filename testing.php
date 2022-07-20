<?php

/**
 * @author Christian
 * @copyright 2022
 */
 /**/
$tree = new stdclass;

$tree->id = "ide+2wlrf+eqjrg0qejnr0ginj";

$tree->data = new stdclass;
$tree->data->first_name= "Richard";
$tree->data->lastname_name= "barolin";
$tree->data->birthday= "1977";
$tree->data->avatar= "assets";
$tree->data->gender= "M";

$tree->rels= new stdclass;
$tree->rels->father = "Nelson";
$tree->rels->mother = "Lourdes";
$tree->rels->spouses = ["carina"];
$tree->rels->children = ["Brandon","Waldy","Alex"];





?>

<pre>
<?php
print_r( $tree );
?>
</pre>
<pre>
<?php
print_r( json_encode($tree) );
?>
</pre>