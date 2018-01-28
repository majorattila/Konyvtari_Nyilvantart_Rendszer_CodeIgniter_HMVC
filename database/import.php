<?php
/*
if(file_exists("../php_classes/sql_import/php-mysqlimporter.php")){
include("../php_classes/sql_import/php-mysqlimporter.php");
}else{
	echo "File not found<br/>";
}

//import sql file
$drive = substr($_SERVER['DOCUMENT_ROOT'],0,1);
exec("setx path \"%path%;".$drive.":\\biblioteka-x64\\mariadb\\bin\"");

//exec("mysql -u root biblioteka < \"G:/biblioteka-x64/apache/htdocs/biblioteka/database/5tFxGg9gDP5F.sql\"");

$mysqlImport = new MySQLImporter("localhost", "root", "", "3404");
$mysqlImport->doImport("5tFxGg9gDP5F.sql","biblioteka", true, true);


// Check for errors
if ($mysqlImport->hadErrors){
	// Display errors
	echo "<pre>\n";
	print_r($mysqlImport->errors);
	echo "\n</pre>";
} else {
	echo "<strong>File imported successfully</strong>";
}
*/

$drive = substr($_SERVER['DOCUMENT_ROOT'],0,1);
$item = $_POST['item'];
if(!empty($item)){
$myfile = fopen("MyBatch.bat", "w") or die("Unable to open file!");
$txt = 'mysql -e "drop database biblioteka; create database biblioteka;" -u root
mysql -u root biblioteka < "'.$drive.':/biblioteka-x64/apache/htdocs/biblioteka/database/'.$item.'.sql"
';
fwrite($myfile, $txt);
fclose($myfile);

exec("MyBatch.bat");
}else{
	die("ERROR");
}

?>