<?php

include "connect.php"; //include php file of connection string.

$link=mysqli_connect($mysql_host, $mysql_user,$mysql_pass, $mysql_default_database);

function DisplaySQLTableDataASJSON($link,$query)
{
	$myArray = array();
	if ($result = $link->query($query)) {

		while($row = $result->fetch_array(MYSQL_ASSOC)) {
			$myArray[] = $row;
		}
		//echo json_encode($myArray);
		echo 'var data = { "companies" : '.json_encode($myArray).' };';

	}

	$result->close();

}




$query = "SELECT
		 tblCompany.picture
		,tblCompany.name AS CompanyName
		,tblCompany.description
		,listType.name 	 AS CompanyType
		,listIndustry.name  AS Industry
		,tblCompany.url
		,tblCompany.latitude
		,tblCompany.longitude
		,tblCompany.isHiring
		from company as tblCompany
		LEFT JOIN list_industry as listIndustry ON CASE WHEN tblCompany.industry_id = -1 THEN 13 ELSE tblCompany.industry_id END = listIndustry.industry_id
		LEFT JOIN list_company_type as listType ON CASE WHEN tblCompany.type_id = -1 THEN 13 ELSE tblCompany.type_id END = listType.company_type_id
		ORDER BY listIndustry.order_by,tblCompany.name;
		";
DisplaySQLTableDataASJSON($link, $query);

/* close connection */
$link->close();
?>