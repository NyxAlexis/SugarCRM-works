<?php
/**
 * Login
 *
 * @category  Portal login
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
 
 if (isset($_POST["user"]) && isset($_POST["mdp"])){
	// setcookie( "username", $_POST["user"], 0, "/", ".{your website}" );
	setcookie("username", $_POST["user"], 0, "/");
	setcookie( "mdp", md5($_POST["mdp"]), 0, "/");
	// Lancement de la page 
	header('Location: {URL of your webpage}');
 }
 ?>
