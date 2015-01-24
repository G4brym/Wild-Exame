<?php
$actions = array("getUser", "changeUserPassword");
//&quot = "
//verifica se o token de segurança é valido
if(!isset($_GET["token"])) {
	echo "{&quoterror&quot:&quottoken is not set&quot}";
	die;
} elseif ($_GET["token"] != settings::get("securityToken")) {
	echo "{&quoterror&quot:&quottoken is not valid&quot}";
	die;
}

//verifica se a acão é valida
if(!isset($_GET["action"])) {
	echo "{&quoterror&quot:&quotaction is not set&quot}";
	die;
} elseif (!in_array($_GET["action"], $actions)) {
	echo "{&quoterror&quot:&quotaction is not valid&quot}";
	die;
}

	echo "ola";
?>