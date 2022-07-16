 <?php
$mysqli = new mysqli("localhost","rbbautor","ABRIL28042015","treebook");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Perform query
if ($result = $mysqli -> query("SELECT * FROM person where person_id = 1 ")) {
  
  $row= $result ->fetch_object();
  
}

$mysqli -> close();


$test = explode(",",$row->spouses);
?> 

<pre>
<?php
print_r( $test );
?>
</pre>