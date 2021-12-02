<?php
				
				/**
				*
				* 	@file 				Controller for index-page (index.php)
				* 	@author 				Marwa Saada 
				* 	@copyright 			meineAgentur
				* 	@lastmodifydate 	2021-04-08
				*
				*/
				
				
#**********************************************************************#


				#********** INITIALIZE SESSION **********#				
				session_name("blogProject");
				session_start();
				
				if( !isset($_SESSION['usr_id']) ) {
					// delete empty session
					session_destroy();
					$showLoginForm = true;
				
				} else {
					$showLoginForm = false;					
				}
				
#**********************************************************************#
				
				
				#***********************************#
				#********** CONFIGURATION **********#
				#***********************************#
				
				require_once("include/config.inc.php");
				require_once("include/db.inc.php");
				require_once("include/form.inc.php");
				include_once("include/dateTime.inc.php");

				
				#********** INCLUDE CLASSES **********#
				require_once("Class/BlogInterface.class.php");
				require_once('class/Blog.class.php');
				require_once("Class/CategoryInterface.class.php");
				require_once('class/Category.class.php');
				require_once("Class/UserInterface.class.php");
				require_once('class/User.class.php');
		
#**********************************************************************#


				#**************************************#
				#********** OUTPUT BUFFERING **********#
				#**************************************#
				
				if( !ob_start() ) {
					// Fehlerfall
if(DEBUG)		echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: FEHLER beim Starten des Output Bufferings! <i>(" . basename(__FILE__) . ")</i></p>\n";				
					
				} else {
					// Erfolgsfall
if(DEBUG)		echo "<p class='debug ok'><b>Line " . __LINE__ . "</b>: Output Buffering erfolgreich gestartet. <i>(" . basename(__FILE__) . ")</i></p>\n";									
				}


#**********************************************************************#

				
				#**************************************#
				#******* ESTABLISH DB CONNECTION ******#	
				#**************************************#
				
				
				$pdo = dbConnect();



#**********************************************************************#


				#*************************************#
				#********** TESTING CLASSES **********#
				#*************************************#
/*	
				#********* USER *********#
if(DEBUG)	echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Testing User class... <i>(" . basename(__FILE__) . ")</i></p>\n";

if(DEBUG)	echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Empty User object: <i>(" . basename(__FILE__) . ")</i></p>\n";
				$userObject1 = new User();
				
if(DEBUG)	echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Filled User object: <i>(" . basename(__FILE__) . ")</i></p>\n";
				$userObject2 = new User("Ingmar", "Ehrig", "ingmar@mail.de",
												 "Berlin", "1234");
												 
				#********* Category *********#
if(DEBUG)	echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Testing Category class... <i>(" . basename(__FILE__) . ")</i></p>\n";

if(DEBUG)	echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Empty Category object: <i>(" . basename(__FILE__) . ")</i></p>\n";
				$CategoryObject1 = new Category();
				
if(DEBUG)	echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Filled Category object: <i>(" . basename(__FILE__) . ")</i></p>\n";
				$CategoryObject2 = new Category("Musik");
				
				#********* BLOG *********#
if(DEBUG)	echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Testing Blog class... <i>(" . basename(__FILE__) . ")</i></p>\n";

if(DEBUG)	echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Empty Blog object: <i>(" . basename(__FILE__) . ")</i></p>\n";
				$BlogObject1 = new Blog();
				
if(DEBUG)	echo "<p class='debug'><b>Line " . __LINE__ . "</b>: Filled Blog object: <i>(" . basename(__FILE__) . ")</i></p>\n";
				$BlogObject2 = new Blog($userObject2, $CategoryObject2, "Halooo World",NULL,"left","AAAA AAA AASA AAAAAAAAA","1999-03-13");
				
				//$user=NULL, $category=NULL, $blog_headline=NULL, $blog_image=NULL, 
															//$blog_imageAlignment=NULL, $blog_content=NULL, $blog_date=NULL, $blog_id=NULL								 
*/																			 
#***************************************************************************************#


				#******************************************#
				#********** INITIALIZE VARIABLES **********#
				#******************************************#
				
				$loginMessage 			= NULL;
				

				$currentPage 			= $_SERVER['QUERY_STRING'];
				$categoryFilterId    = NULL;


#***************************************************************************************#

			
				#********************************************#
				#********** PROCESS URL PARAMETERS **********#
				#********************************************#

				
				// Schritt 1 URL: Prüfen, ob Parameter übergeben wurde
				if( isset($_GET['action']) ) {
if(DEBUG)		echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: URL-Parameter 'action' wurde übergeben... <i>(" . basename(__FILE__) . ")</i></p>";	
			
					// Schritt 2 URL: Werte auslesen, entschärfen, DEBUG-Ausgabe
					$action = cleanString($_GET['action']);
if(DEBUG)		echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: \$action = $action <i>(" . basename(__FILE__) . ")</i></p>";
		
					// Schritt 3 URL: ggf. Verzweigung
										
					#********** LOGOUT **********#					
					if( $_GET['action'] == "logout" ) {
if(DEBUG)			echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: 'Logout' wird durchgeführt... <i>(" . basename(__FILE__) . ")</i></p>";	
						
						session_destroy();
						header("Location: index.php");
						exit();
						
						
					#********** KATEGORIENFILTER **********#					
					} elseif( $action == "showCategory" ) {
if(DEBUG)			echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: Kategoriefilter aktiv... <i>(" . basename(__FILE__) . ")</i></p>";				
						$categoryFilterId = cleanString($_GET['id']);
						
					}
					
				} // PROCESS URL PARAMETERS END
			

#***************************************************************************************#


				#****************************************#
				#********** PROCESS FORM LOGIN **********#
				#****************************************#
		
				// Schritt 1 FORM: Prüfen, ob Formular abgeschickt wurde
				if( isset($_POST['formsentLogin']) ) {
if(DEBUG)		echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Formular 'Login' wurde abgeschickt... <i>(" . basename(__FILE__) . ")</i></p>";	

					// Schritt 2 FORM: Werte auslesen, entschärfen, DEBUG-Ausgabe
					$userObj = new User('','',$_POST['loginName']);
					$loginPassword = cleanString($_POST['loginPassword']);
//if(DEBUG)		echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: \$loginName:". $userObj->getUsr_email() ."<i>(" . basename(__FILE__) . ")</i></p>";
if(DEBUG)		echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: \$loginPassword: $loginPassword <i>(" . basename(__FILE__) . ")</i></p>";

					// Schritt 3 FORM: ggf. Werte validieren
					$errorLoginName 		= checkEmail($userObj->getUsr_email());
					$errorLoginPassword 	= checkInputString($loginPassword);
					
					
					#********** FINAL FORM VALIDATION **********#					
					if( $errorLoginName OR $errorLoginPassword ) {
						// Fehlerfall
if(DEBUG)			echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: Formular enthält noch Fehler! <i>(" . basename(__FILE__) . ")</i></p>";						
						$loginMessage = "<p class='error'>Benutzer_email oder Passwort falsch!</p>";
						
					} else {
						// Erfolgsfall
if(DEBUG)			echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Formular ist fehlerfrei und wird nun verarbeitet... <i>(" . basename(__FILE__) . ")</i></p>";						
									
						// Schritt 4 FORM: Daten weiterverarbeiten
						
						#********** DATENSATZ ZUM LoginName(Email) AUSLESEN **********#
if(DEBUG)			echo "<p class='debug hint'><b>Line " . __LINE__ . "</b>: Email wird geprüft... <i>(" . basename(__FILE__) . ")</i></p>\n";				
						
						#********** VERIFY LOGIN Email **********#	
						if( !$userObj->fetchFromDb($pdo) ) {
							// Fehlerfall:							
if(DEBUG)				echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: FEHLER: Benutzer_email wurde nicht in DB gefunden! <i>(" . basename(__FILE__) . ")</i></p>";
							$loginMessage = "<p class='error'>Benutzer_email oder Passwort falsch!</p>";
						
						}else{
							// Erfolgsfall
if(DEBUG)				echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Benutzer_email wurde in DB gefunden. <i>(" . basename(__FILE__) . ")</i></p>";
						
							#********** VERIFY PASSWORD **********#							
							if( !password_verify( $loginPassword,$userObj->getUsr_password()) ) {
								// Fehlerfall	
if(DEBUG)					echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: FEHLER: Passwort stimmt nicht mit DB überein! <i>(" . basename(__FILE__) . ")</i></p>";
								$loginMessage = "<p class='error'>Benutzer_email oder Passwort falsch!</p>";
							
						
							}else{
								// Erfolgsfall								
if(DEBUG)					echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Passwort stimmt mit DB überein. LOGIN OK. <i>(" . basename(__FILE__) . ")</i></p>";
if(DEBUG)					echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: Userdaten werden in Session geschrieben... <i>(" . basename(__FILE__) . ")</i></p>";
							
								
								#********** SAVE USER DATA INTO SESSION **********#								
								session_start();
								//$_SESSION['usr'] = $userObj;
								$_SESSION['usr_id'] 			= $userObj->getUsr_id();
								$_SESSION['usr_email'] 			= $userObj->getUsr_email();
								
								#********** REDIRECT TO DASHBOARD **********#								
								header("Location: dashboard.php");
								exit;
								
							} // VERIFY PASSWORD END
						
						} // VERIFY LOGIN NAME END 
							
					} // FINAL FORM VALIDATION END

				} // PROCESS FORM LOGIN END

			
#***************************************************************************************#


				#************************************************#
				#********** FETCH BLOG ENTRIES FORM DB **********#
				#************************************************#
				
if(DEBUG)	echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Lade Blogs... \$categoryFilterId = ".$categoryFilterId." <i>(" . basename(__FILE__) . ")</i></p>";				

				// $categoryFilterId = NULL oder hat ein wert
				$blogEntriesArray = Blog::fetchAllFromDb($pdo, $categoryFilterId);
			
#***************************************************************************************#


				#**********************************************#
				#********** FETCH CATEGORIES FROM DB **********#
				#**********************************************#

if(DEBUG)	echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Lade Kategorien... <i>(" . basename(__FILE__) . ")</i></p>";	
				$categoriesArray = Category::fetchAllFromDb($pdo);
/*				
if(DEBUG)	echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";					
if(DEBUG)	print_r($categoriesArray);					
if(DEBUG)	echo "</pre>";
*/
			
#***************************************************************************************#
?>

