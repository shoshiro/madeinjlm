<?php

$debug = false;
/*
// we connect to example.com and port 3307
$link = mysql_connect('db439196920.db.1and1.com', 'dbo439196920','12345678');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';


mysql_select_db("db439196920");
*/

/*
if($handle = fopen("madeInJLMdata.csv", "r") !== FALSE){

	while (!feof($handle)) {
		$line_of_text = fgets($handle);
		foreach( fgetcsv($line_of_text, 0, "\t") as $csv_item)
			print $csv_item."," ;
		print "<br>";
	}

	fclose($handle);
}*/

$link = mysqli_connect('db439196920.db.1and1.com', 'dbo439196920','12345678', "db439196920");

/* check connection */
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}





$commands = file_get_contents("sql/madeinjlm_17June2014.sql");


/* execute multi query */
if (mysqli_multi_query($link, $commands))
	echo "Success";
else
	echo "Fail";

?>