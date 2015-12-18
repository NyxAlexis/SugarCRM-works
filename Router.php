<?php
/**
 * Router Class
 *
 * @category  File routage
 * @package   Launcher
 * @author    Alexis TADIFO <alexis.tadifo@nyx-e.com>
 * @copyright Copyright (c) 2015
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @link      
 * @version   1.0
 */
 /*
	Récupération des données en provenance de l'index
 */
 require_once("MySQLi_wrapper/MysqliDb.php"); // Import of the MySQLi_wrapper package
 class Router{
	 
	public function routeToCrm($host, $username, $password, $databaseName){
		if(isset($_COOKIE['username'])) $user = $_COOKIE['username'];
		if(isset($_COOKIE['mdp'])) {
		//Récupération du mot de passe stocké
		$db = new MysqliDb ($host, $username, $password, $databaseName);
		$db->where("user_name", $user);
		$users = $db->getOne ("users");
		$pwd = $users['user_hash'];
		// Création du mot de passe hashé
		// $mdp = crypt(strtolower($_COOKIE['mdp']),$pwd);		
		$mdp = $_COOKIE['mdp'];		
		}
		// Login au CRM	
		$url = "http://localhost/mysite/crm74/service/v4_1/soap.php?wsdl";
		require_once("../crm74/include/nusoap/lib/nusoap.php");
		//retrieve WSDL
		$client = new nusoap_client($url, 'wsdl');
		$proxy = $client->getProxy();
		//Affichage des erreurs
		$err = $client->getError();
		if ($err)
		{
			echo '<h2>Erreur du constructeur</h2><pre>'.$err.'</pre>';
			echo '<h2>Debug</h2><pre>'.htmlspecialchars($client->getDebug(), ENT_QUOTES).'</pre>';
			exit();
		}
		// login ---------------------------------------------------- 
		$login_parameters = array(
			 'user_auth' => array(
				  'user_name' => $user,
				  'password' => $mdp,
				  'version' => '1'),
			 'application_name' => 'SugarTest');
			$login_result = $client->call('login', $login_parameters);
		
		echo '<pre>';
		//get session id
		$session_id = $login_result['id'];
		$result = $proxy->seamless_login($session_id);
		// Ouverture de la session SuiteCRM
		header("Location: http://localhost/mysite/crm74/index.php?module=Administration&action=index&MSID={$session_id}");		
	}
 }
 ?>
