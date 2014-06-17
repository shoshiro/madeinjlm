<!DOCTYPE HTML>
<html>

<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Shoshi PHP Test</title>

</head>
<?php
$debug = true;

$link=mysqli_connect('db439196920.db.1and1.com', 'dbo439196920','12345678', "db439196920");


function DisplaySQLTableData($link,$query)
{
	if ($result = $link->query($query)) {
		echo '<table border="1" bgcolor="white"><tr>';
		while ($field = $result->fetch_field()) {
			echo "<th>$field->name</th>";
		}
		/* fetch associative array */
		while ($row = $result->fetch_row()) {
			echo "<tr>";
			for($i=0;$i<mysqli_num_fields($result);$i++)
				echo "<td>" .CheckForImagesOrLinks($row[$i], $i)."</td>" ;
			echo "</tr>";

		}
		echo "</table>";

		/* free result set */
		$result->free();
	}
	else echo 'ERROR:'.mysqli_error($link);
}

function CheckForImagesOrLinks($fieldvalue)
{
	$result = $fieldvalue; //set result as same value by default;

	if($fieldvalue)
	{
		//set result data to image or link if applicable
		if(is_string($fieldvalue))
		{
			$file_extension = substr($fieldvalue,strlen($fieldvalue)-4,4);
			if($file_extension==".png" || $file_extension == ".jpg" || $file_extension==".gif" || $file_extension=="jpeg")
			{
				$isImage = true;
				$result = "<img src='$fieldvalue' alt='$fieldvalue' style='max-height: 100px; max-width: 100px'>";
			}
			if(!$isImage && substr($fieldvalue, 0,4)=="http")
					$result = "<a href='$fieldvalue'>$fieldvalue</a>";


		}

	}
	return $result;
}
?>

<body>
<form>
<header class="body"></header>
<div align="right">

<table>
	<tr>
		 <td></td>
	</tr>
</table>
</div>

  <div class="mainpage">
            <header>
            <br><br><br><br>
                <h1>Made In JLM - <span>Company List</span></h1>

            </header>
  </div>
<section class="section" ><div align="center">

<?


$query = "SELECT
		 tblCompany.picture
		,tblCompany.name
		,tblCompany.description
		,listType.name
		,listIndustry.name
		,tblCompany.url
		from company as tblCompany
		JOIN list_industry as listIndustry ON tblCompany.industry_id = listIndustry.industry_id
		JOIN list_company_type as listType ON tblCompany.type_id = listType.company_type_id;";
DisplaySQLTableData($link,$query);


/* close connection */
$link->close();
?>
							</div>
							</section>
<footer class="body">
</footer>

</form>
 </body>
</html>