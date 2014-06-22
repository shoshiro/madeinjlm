<?php

$debug = true;
// we connect to example.com and port 3307
$link = mysql_connect('127.0.0.1:3306', 'root','sr2498');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
if($debug)
	echo 'Connected successfully';


mysql_select_db("madeinjlm");

if($debug)
	echo "<br>start<br>";



$row = 1;
if (($handle = fopen("files/madeInJLM_data.csv", "r")) !== FALSE) {
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	$num = count($data);
	if($debug)
	{
		echo "<p> $num fields in line $row: <br /></p>\n";
	}
		if($row>1)
		{
			//InsertIntoSQL("test",$data[7]);  //Company Category
			$industry_id = GetSQLFieldValue("list_industry","industry_id","name",$data[7]);
			$company_type_id = GetSQLFieldValue("list_company_type","company_type_id","name",$data[19]);
			//SET IDs to "-1" in case values were not returned.
			if(!$industry_id)
				$industry_id = -1;
			if(!$company_type_id)
				$company_type_id = -1;

			$sql = "INSERT INTO  company(
										industry_id ,
										type_id ,
										name ,
										description ,
										url ,
										picture ,
										address ,
										Area ,
										tags ,
										numOfEmployees ,
										contactEmail ,
										contactPhone ,
										contactName ,
										twitter ,
										facebookPage ,
										latitude ,
										longitude ,
										IsHiring ,
										onMapLogo
										)
								VALUES( $industry_id	,
									   $company_type_id ,"
									   .CleanText($data[0]).","	//name
									   .CleanText($data[11]).","	//description
									   .CleanText($data[1]).","	//url
									   .CleanText($data[28]).","	//picture
									   .CleanText($data[3]).","	//address
									   .CleanText($data[4]).","	//Area
									   .CleanText($data[5]).","	//tags
									   .ReturnNumericValue($data[6]) .","//numOfEmployees
									   .CleanText($data[8]).","	//contactEmail
									   .CleanText($data[9]).","	//contactPhone
									   .CleanText($data[10]).","	//contactName
									   .CleanText($data[12]).","	//twitter
									   .CleanText($data[13]).","	//facebookPage
									   .ReturnNumericValue($data[14]) .","	//latitude
									   .ReturnNumericValue($data[15]) .","	//longtitude
									   .ReturnBooleanAnswer($data[16]) .","	//IsHiring
									   .ReturnBooleanAnswer($data[17]) 		//onMapLogo
									 .")";
									;


			ExecuteSQL($sql);
			//InsertIntoSQL("company",$industry_id,$company_type_id,str_replace("'", "",$data[0]),str_replace( "'", "",$data[11]) );  //Company Category
			//InsertIntoSQL("list_company_type",$data[19]); //Company Type

		}
		else
		{
			TruncateTableSQL("company");
		}
		$row++;

		if($debug)
		{
			for ($c=0; $c <40; $c++)
				echo $c.":". $data[$c] . "<br />\n";

		echo "--------------------------------------------------------------------------------------<br>";
		}
	}
	fclose($handle);
}

	function GetSQLFieldValue($tablename,$returnfield,$lookupfield, $value)
	{

		$query = "SELECT $returnfield as res FROM $tablename WHERE $lookupfield = '$value'";
		$result = mysql_query($query);
		$result = mysql_fetch_array($result);

		return $result[0];

	}

	function TruncateTableSQL($tablename)
	{
		$sql = "TRUNCATE TABLE $tablename";
		$result = mysql_query($sql);

	}

	function ExecuteSQL($sql)
	{
		 	$result = mysql_query($sql);
			if(!$result)
				echo "ERROR IN EXECUTING SQL!!!<br>$sql<br>Error:".mysql_error()."<br>";
			if($debug)
				echo "sql=".$sql."<br>";


	}

	function CleanText($var)
	{

		$fieldPrefix = substr($var, 0,4);

		if($fieldPrefix == 'http' || $fieldPrefix == '<img')	//don't change anything in case of link or image
		{
			$result = $var;
		}
		else
		{
			//I'm sure there is a better way to get rid of special charachters or replace them with tags - please look into it. Shoshi 16.june.14
			$result = str_replace("'","", $var);
			$result = str_replace("`","",$result);
			$result = str_replace("’","",$result);
			$result = str_replace("‘","",$result);
			$result = str_replace("“","",$result);
			$result = str_replace("”","",$result);
			$result = str_replace("™"," TM ",$result);
			$result = str_replace("—","-",$result);
			$result = str_replace(",", ";", $result);
			$result = str_replace("\"", "", $result);
		}
		if(!$result )
			$result = "";
	 	return "'".$result."'";
	}
	function ReturnNumericValue($var)
	{
		if(is_numeric($var))
			return $var;
		else
			return -1;
	}
	function ReturnBooleanAnswer($var)
	{
		if($var == "Yes, we are hiring!" || $var =="TRUE" || $var == "V")
			$result = 1;
		else
			$result = 0;
		return $result;
	}
	function InsertIntoSQL($tablename, $field1,$field2, $field3,$field4)
	{
		if($tablename)
		{
			$sql = "INSERT INTO $tablename (industry_id, type_id,name,description) VALUES($field1,$field2,'$field3','$field4')";

			$result = mysql_query($sql);
			if(!$result)
				echo "ERROR IN INSERT!!!<br>";
		 	if($debug)
				echo "sql=".$sql."<br>";
		}

	}


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


?>