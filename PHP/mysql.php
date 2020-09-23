<?php
namespace MySql; 

const host = "localhost";
const username = "root";
const password = "root";
const dbname = "test";
const port = 3306;
 
// Check connection
function ConnSql()
{
	return mysqli_connect(host, username, password, dbname, port);
}
?>