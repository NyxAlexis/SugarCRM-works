<?php
/**
 * Redirect Class
 *
 * @category  Address redirection from landingpage
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
require_once ("Router.php");

if (isset($_REQUEST['tool'])){
	switch($_REQUEST['tool']){
		case 'desktop': // lancement de la page CRM
		$router_crm = new Router();
		$router_crm->routeToCrm('localhost', 'root', '', 'crm74');
		// header("Location: http://localhost/crm/index.php?MSID={$session_id}");
	 }
 }
 ?>
