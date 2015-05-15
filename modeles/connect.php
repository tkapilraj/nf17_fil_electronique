<?php

function connect() {
	$host = "tuxa.sme.utc";
	$port = "5432";
	$dbname = "dbnf17p***";
	$user = "nf17p***";
	$password = "********";
	return pg_connect("host = $host port = $port dbname = $dbname user =$user password = $password");
}

?>
