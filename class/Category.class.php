<?php
#*******************************************************************************************#


				#********************************#
				#********** CLASS Category **********#
				#********************************#

				/*
					Die Klasse ist quasi der Bauplan/die Vorlage für alle Objekte, die aus ihr erstellt werden.
					Sie gibt die Eigenschaften/Attribute eines späteren Objekts vor (Variablen) sowie 
					die "Fähigkeiten" (Methoden/Funktionen), über die das spätere Objekt besitzt.

					Jedes Objekt einer Klasse ist nach dem gleichen Schema aufgebaut (gleiche Eigenschaften und Methoden), 
					besitzt aber i.d.R. unterschiedliche Attributswerte.
				*/

				
#*******************************************************************************************#

				
				/** 
				* 	 
				*	Class representing a Category.			
				*
				*/
				class Category implements CategoryInterface{
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
					/* 
						Innerhalb der Klassendefinition müssen Attribute nicht zwingend initialisiert werden.
						Ein Weglassen der Initialisierung bewirkt das gleiche, wie eine Initialisierung mit NULL.
					*/
					private $cat_id;
					private $cat_name;
					

					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					/*
						Der Konstruktor ist eine magische Methode und wird automatisch aufgerufen,
						sobald mittels des new-Befehls ein neues Objekt erstellt wird.
						Der Konstruktor erstellt eine neue Klasseninstanz/Objekt.
						Soll ein Objekt beim Erstellen bereits mit Attributwerten versehen werden,
						muss ein eigener Konstruktor geschrieben werden. Dieser nimmt die Werte in 
						Form von Parametern (genau wie bei Funktionen) entgegen und ruft seinerseits 
						die entsprechenden Setter auf, um die Werte zuzuweisen.					
					*/
					
					/**
					*
					*	@construct
					*	@param	String $cat_name	=NULL			   name of category
					*	@param	String $cat_id		=NULL				Record-Id given by database
					*
					*	@return	void
					*
					*/
					public function __construct( 	$cat_name=NULL, $cat_id=NULL ) {
if(DEBUG_CC)		echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						

						if( isset($cat_name))			$this->setCat_name($cat_name);
						if( isset($cat_id))				$this->setCat_id($cat_id);

if(DEBUG_CC)		echo "<pre class='debugClass'><b>Line  " . __LINE__ .  "</b> <i>(" . basename(__FILE__) . ")</i>:<br>\n";					
if(DEBUG_CC)		print_r($this);					
if(DEBUG_CC)		echo "</pre>";						
					}
					
					
					#********** DESTRUCTOR **********#
					/*
						Der Destruktor ist eine magische Methode und wird automatisch aufgerufen,
						sobald ein Objekt mittels unset() gelöscht wird, oder sobald das Skript beendet ist.
						Der Destructor gibt den vom gelöschten Objekt belegten Speicherplatz wieder frei.
					*/
					/**
					*
					*	@destruct
					*
					*	@return	void
					*
					*/
					public function __destruct() {
if(DEBUG_CC)		echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						
					}
					
					
					#***********************************************************#

					
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					
				   #********** CAT_ID **********#
					public function getCat_id(){
						return $this->cat_id;
					}
					public function setCat_id($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->cat_id = cleanString($value);
									
							}
						}	
					}
					
					
					#********** CAT_NAME **********#
					public function getCat_name(){
						return $this->cat_name;
					}
					public function setCat_name($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->cat_name = cleanString($value);
									
							}
						}	
					}
					
					
					

					#********** VIRTUAL ATTRIBUTES **********#
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#

					
					#********** FETCH ALL OBJECTS DATA FROM DB **********#
					/**
					*
					*	Fetches  all categories data  from DB
					*	Writes all object's data into corresponding object
					*
					*	@param	PDO		$pdo		               DB-connection object
					*
					*	@return	Array  	$categoriesArray			      array of all categories in DB , is NULL when there is no categories
					*
					*/
					public static function fetchAllFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						$categoriesArray = NULL;
						$sql = "SELECT * FROM category";
				
						// Schritt 2 DB: SQL-Statement vorbereiten
						$statement = $pdo->prepare($sql);
						
						// Schritt 3 DB: SQL-Statement ausführen und ggf. Platzhalter füllen
						$statement->execute();
if(DEBUG_C)			if($statement->errorInfo()[2]) echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>";
				
						// Gefundene Datensätze für spätere Verarbeitung in Array of Category-object zwischenspeichern
			
						while($row = $statement->fetch(PDO::FETCH_ASSOC)){
							$categoriesArray [] = new Category($row['cat_name'],$row['cat_id']);
						}
						
						return $categoriesArray;
					}
					
					#***************************************************#
					
					
					#********** SAVE CATEGORY DATA INTO DB **********#
					/**
					*
					*	Saves new dataset of category object attributes data into DB
					*	Writes the DB insert ID into calling category object
					*
					*	@param	PDO		$pdo		DB-connection object
					*
					*	@return	Boolean				true if writing was successful, else false
					*
					*/
					public function saveToDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
						$sql 		= "INSERT INTO category (cat_name) VALUES (?)";
						$params 	= array($this->getCat_name());
						
						// Schritt 2 DB: SQL-Statement vorbereiten
						$statement = $pdo->prepare($sql);
						// Schritt 3 DB: SQL-Statement ausführen und ggf. Platzhalter füllen
						$statement->execute($params);
if(DEBUG_C)			if($statement->errorInfo()[2]) echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>";
							
					
						// Schritt 4 DB: Daten weiterverarbeiten
						// Bei schreibendem Zugriff: Schreiberfolg prüfen
						$rowCount = $statement->rowCount();
if(DEBUG_C)			echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: \$rowCount: $rowCount <i>(" . basename(__FILE__) . ")</i></p>";
						
						if( $rowCount != 1) {
							// Fehlerfall
							return false;
							
						} else {
							// Erfolgsfall
							$this->setCat_id($pdo->lastInsertId());
							return true;
						}						
					}
					#***************************************************#
					
					public function fetchFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					#***************************************************#
				
					
					public function updateToDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					#***************************************************#
					
					
					public function deleteFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					
					#***********************************************************#
					
					
					/*
					public function checkIfExists(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					
					public function fetchNumberOfEntries(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}	
					
					*/
				
					
				}
				
				
#*******************************************************************************************#
?>


















