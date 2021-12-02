<?php
				
				/**
				*
				* 	@file 				Controller for dashboard-page (dashboard.php)
				* 	@author 				Marwa Saada 
				* 	@copyright 			meineAgentur
				* 	@lastmodifydate 	2021-04-08
				*
				*/
				
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

			
				#*********************************#
				#********** SECURE PAGE **********#
				#*********************************#
				
				#********** INITIALIZE SESSION **********#
				session_name("blogProject");
				session_start();
				
				#********** CHECK FOR VALID LOGIN **********#
				if( !isset($_SESSION['usr_id']) ) {
					header("Location: index.php");
					exit();
					
				} else {

					//$userObj = unserialize($_SESSION['usr']);
					$usrId 			= $_SESSION['usr_id'];
					$usrEmail		= $_SESSION['usr_email'];
				}
			
			

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

			
				#******************************************#
				#********** INITIALIZE VARIABLES **********#
				#******************************************#
				
				
				$catObject           = NULL;
				$blogObject          = NULL;
				
				$errorCatName 			= NULL;
				$errorHeadline 		= NULL;
				$errorImageUpload 	= NULL;
				$errorContent 			= NULL;
				
				$catExists 				= false;
				$catErrorMessage		= NULL;
				$catSuccessMessage	= NULL;
				$blogMessage 			= NULL;

if(DEBUG)	echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: User Daten nach \$_SESSION['usr_email'] aus die DB auslesen... <i>(" . basename(__FILE__) . ")</i></p>";	
				$user = new User('','',$usrEmail);
				$user->fetchFromDb($pdo);
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
					}
					
				} // URL-PARAMETERVERARBEITUNG ENDE


#***************************************************************************************#	
			
			
				#**********************************************#
				#********** FETCH CATEGORIES FROM DB **********#
				#**********************************************#

if(DEBUG)	echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Lade Kategorien... <i>(" . basename(__FILE__) . ")</i></p>";	
				$categoriesArray = Category::fetchAllFromDb($pdo);
									
#***************************************************************************************#			

	
				#*************************************************#
				#********** PROCESS FORM 'NEW CATEGORY' **********#
				#*************************************************#
				
				// Schritt 1 FORM: Prüfen, ob Formular abgeschickt wurde
				if( isset($_POST['formsentNewCategory']) ) {
if(DEBUG)		echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Formular 'New Category' wurde abgeschickt... <i>(" . basename(__FILE__) . ")</i></p>";	
		
					// Schritt 2 FORM: Werte auslesen, entschärfen, DEBUG-Ausgabe
					$catObject = new Category($_POST['cat_name']);
if(DEBUG)		echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: \$catObject->getCat_name:". $catObject->getCat_name() ."<i>(" . basename(__FILE__) . ")</i></p>";
				
					// Schritt 3 FORM: Werte ggf. validieren
					$errorCatName = checkInputString($catObject->getCat_name());
					
					
					#********** FINAL FORM VALIDATION **********#
					if( $errorCatName ) {
if(DEBUG)			echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: Formular enthält noch Fehler! <i>(" . basename(__FILE__) . ")</i></p>";						
						
					} else {
if(DEBUG)			echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Formular ist fehlerfrei und wird nun verarbeitet... <i>(" . basename(__FILE__) . ")</i></p>";						
						
						// Schritt 4 FORM: Daten weiterverarbeiten

						
						#********** CHECK IF CATEGORY NAME ALREADY EXISTS **********#
						
						// Um sich eine DB-Operation zu sparen, kann man auch das oben bereits ausgelsenene $categoriesArray durchsuchen
						// Nach erfolgreichem Anlegen der neuen Kategorie muss diese nun aber zwingend zusätzlich in das $categoriesArray geschrieben werden,
						// damit sie im New Blog Formular sofort zur Verfügung steht
						foreach($categoriesArray AS $singleCategoryObj) {
							if( $catObject->getCat_name() == $singleCategoryObj->getCat_name() ) {
								$catExists = true;
							}
						}
						
						if( $catExists ) {
							// Fehlerfall
							echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: Kategorie <b>".$catObject->getCat_name()."</b> existiert bereits! <i>(" . basename(__FILE__) . ")</i></p>";
							$catErrorMessage = "<p class='error'>Es existiert bereits eine Kategorie mit diesem Namen!</p>"; 
						
						} else {
							// Erfolgsfall
if(DEBUG)				echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: Neue Kategorie <b>".$catObject->getCat_name()."</b> wird gespeichert... <i>(" . basename(__FILE__) . ")</i></p>";	

							if( !$catObject->saveToDb($pdo) ) {
								// Fehlerfall
if(DEBUG)					echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: FEHLER beim Speichern der neuen Kategorie! <i>(" . basename(__FILE__) . ")</i></p>";
								$catErrorMessage = "<p class='error'>Fehler beim Speichern der neuen Kategorie!</p>";
																	
							} else {
								// Erfolgsfall								
if(DEBUG)					echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Kategorie <b>".$catObject->getCat_name()."</b> wurde erfolgreich unter der ID" .$catObject->getCat_id()." in der DB gespeichert. <i>(" . basename(__FILE__) . ")</i></p>";								
								$catSuccessMessage = "<p class='success'>Die neue Kategorie mit dem Namen <b>".$catObject->getCat_name()."</b> wurde erfolgreich gespeichert.</p>";
								
								// Die neue Kategorie in $categoriesArray hinzufügen, damit sie in selectbox gezeigt wird
								$categoriesArray[] = $catObject;
								// Felder aus Formular wieder leeren
								$catObject = NULL;
								
							} // SAVE CATEGORY INTO DB END
							 
						} // CHECK IF CATEGORY NAME ALREADY EXISTS END
						
					} // FINAL FORM VALIDATION END

				} // PROCESS FORM 'NEW CATEGORY' END


#***************************************************************************************#


				#***************************************************#
				#********** PROCESS FORM 'NEW BLOG ENTRY' **********#
				#***************************************************#
				
				// Schritt 1 FORM: Prüfen, ob Formular abgeschickt wurde
				if( isset($_POST['formsentNewBlogEntry']) ) {			
if(DEBUG)		echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Formular 'New Blog Entry' wurde abgeschickt... <i>(" . basename(__FILE__) . ")</i></p>";	

					// Schritt 2 FORM: Werte auslesen, entschärfen, DEBUG-Ausgabe
					$catObject  = new Category('',$_POST['cat_id']);
					
					//                    ($user, $category, $blog_headline,        $blog_image, $blog_imageAlignment,    $blog_content,      $blog_date, $blog_id)
					$blogObject = new Blog($user,$catObject, $_POST['blog_headline'],NULL, $_POST['blog_imageAlignment'], $_POST['blog_content']);  
if(DEBUG)		echo "<pre class='debug'>Line <b>" . __LINE__ . "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\r\n";					
if(DEBUG)		print_r($blogObject);					
if(DEBUG)		echo "</pre>";
				
				
					// Schritt 3 FORM: ggf. Werte validieren
					$errorHeadline = checkInputString($blogObject->getBlog_headline());
					$errorContent 	= checkInputString($blogObject->getBlog_content(), 5, 64000);


					#********** FINAL FORM VALIDATION PART I (FIELDS VALIDATION) **********#					
					if( $errorHeadline OR $errorContent) {
						// Fehlerfall
if(DEBUG)			echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: Formular enthält noch Fehler! <i>(" . basename(__FILE__) . ")</i></p>";
						
					} else {
if(DEBUG)			echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Formular ist fehlerfrei. Bildupload wird geprüft... <i>(" . basename(__FILE__) . ")</i></p>";


						#********** FILE UPLOAD **********#					
						// Prüfen, ob eine Datei hochgeladen wurde
						if( $_FILES['blog_image']['tmp_name'] !=  "") {
if(DEBUG)				echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Bild Upload aktiv... <i>(" . basename(__FILE__) . ")</i></p>";

							// imageUpload() liefert ein Array zurück, das eine Fehlermeldung (String oder NULL) enthält
							// sowie den Pfad zum gespeicherten Bild
							$imageUploadResultArray = imageUpload($_FILES['blog_image']);
					
							// Wenn Fehler:
							if( $imageUploadResultArray['imageError'] ) {
								$errorImageUpload = $imageUploadResultArray['imageError'];
								
							// Wenn kein Fehler:
							} else {
if(DEBUG)					echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Bild wurde erfolgreich unter <i>" . $imageUploadResultArray['imagePath'] . "</i> gespeichert. <i>(" . basename(__FILE__) . ")</i></p>";
								// Pfad zum Bild speichern
								$blogObject->setBlog_image($imageUploadResultArray['imagePath']); 
							}
						} else {
if(DEBUG)				echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: Es wurde kein Bild hochgeladen. <i>(" . basename(__FILE__) . ")</i></p>";
							
						} // FILE UPLOAD END

						
						#********** FINAL FORM VALIDATION PART II (IMAGE UPLOAD) **********#					
						if( $errorImageUpload) {
							// Fehlerfall
if(DEBUG)				echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: Formular enthält noch Fehler (Bildupload)! <i>(" . basename(__FILE__) . ")</i></p>";
							
						} else {
if(DEBUG)				echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Formular ist fehlerfrei. Blogeintrag wird in DB gespeichert... <i>(" . basename(__FILE__) . ")</i></p>";


							#********** SAVE BLOG ENTRY INTO DB **********#
							
							if( !$blogObject->saveToDb($pdo) ) {
								// Fehlerfall
if(DEBUG)					echo "<p class='debug err'>Line <b>" . __LINE__ . "</b>: FEHLER beim Speichern des neuen Beitrags! <i>(" . basename(__FILE__) . ")</i></p>";
								$blogmessage = "<p class='error'>Fehler beim Speichern des Beitrags!</p>";
							
							} else {
								// Erfolgsfall								
if(DEBUG)					echo "<p class='debug ok'>Line <b>" . __LINE__ . "</b>: Neuer Beitrag erfolgreich mit der ID ".$blogObject->getBlog_id()." gespeichert. <i>(" . basename(__FILE__) . ")</i></p>";
								$blogMessage = "<p class='success'>Der Beitrag wurde erfolgreich gespeichert.</p>";
								
								// Felder aus Formular wieder leeren
								$blogObject = NULL;
								
							} // SAVE BLOG ENTRY INTO DB END
							
						} // FINAL FORM VALIDATION PART II (IMAGE UPLOAD) END
							
					} // FINAL FORM VALIDATION PART I (FIELDS VALIDATION) END
					
				} // PROCESS FORM 'NEW BLOG ENTRY' END
			

#***************************************************************************************#		
?>

