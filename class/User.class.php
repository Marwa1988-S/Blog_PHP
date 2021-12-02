<?php
#*******************************************************************************************#


				#********************************#
				#********** CLASS USER **********#
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
				*	Class representing an User.			
				*
				*/
				class User implements UserInterface{
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
					/* 
						Innerhalb der Klassendefinition müssen Attribute nicht zwingend initialisiert werden.
						Ein Weglassen der Initialisierung bewirkt das gleiche, wie eine Initialisierung mit NULL.
					*/
					private $usr_id;
					private $usr_firstname;
					private $usr_lastname;
					private $usr_email;
					
					private $usr_city;
					private $usr_password;

					
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
					*	@param	String $usr_firstname =NULL			Firstname of user
					*	@param	String $usr_lastname  =NULL			Lastname of user
					*	@param	String $usr_email		 =NULL			Email of user
					*	@param	String $usr_city		 =NULL			City of user
					*	@param	String $usr_password  =NULL			Password of user
					*	@param	String $usr_id        =NULL			Record-Id given by database
					*
					*	@return	void
					*
					*/
					public function __construct( 	$usr_firstname=NULL, $usr_lastname=NULL, $usr_email=NULL,
															$usr_city=NULL, $usr_password=NULL, $usr_id=NULL ) {
if(DEBUG_CC)		echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						

						if( isset($usr_firstname))		$this->setUsr_firstname($usr_firstname);
						if( isset($usr_lastname))		$this->setUsr_lastname($usr_lastname);
						if( isset($usr_email))			$this->setUsr_email($usr_email);
						if( isset($usr_city) )			$this->setUsr_city($usr_city);
						if( isset($usr_password))		$this->setUsr_password($usr_password);
						if( isset($usr_id))				$this->setUsr_id($usr_id);

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
				
					/* 
						Type Hinting
						Man kann den Datentyp einer Variablen bzw. eines Rückgabewertes
						mittels Type Hinting vorbestimmen. Für eine Variable wird der 
						Datentyp DAVOR notiert (string $variable), für einen Rückgabewert
						erfolgt die Notation hinter der Funktionsdeklaration und wird mittels 
						einem : ausgewiesen (function() : string)
						Um alternativ zum vorgegebenen Datentyp auch NULL zurückgeben zu können,
						wird vor den Datentyp ein ? (nullable return type) notiert. 
						Das bedeutet: return spezifizierter Datentyp oder NULL
					*/
				
					#********** USR_ID **********#
					public function getUsr_id(){
						return $this->usr_id;
					}
					public function setUsr_id($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->usr_id = cleanString($value);
									
							}
						}	
					}
					
					
					#********** USR_FIRSTNAME **********#
					public function getUsr_firstname(){
						return $this->usr_firstname;
					}
					public function setUsr_firstname($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->usr_firstname = cleanString($value);
									
							}
						}	
					}
					
					
					#********** USR_LASTNAME **********#
					public function getUsr_lastname(){
						return $this->usr_lastname;
					}
					public function setUsr_lastname($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->usr_lastname = cleanString($value);
									
							}
						}
					}
					
					
					#********** USR_EMAIL **********#
					public function getUsr_email(){
						return $this->usr_email;
					}
					public function setUsr_email($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							// Prüfen: Muss eine valide Emailadresse sein
							} elseif( !filter_var( $value, FILTER_VALIDATE_EMAIL )  ) {
if(DEBUG_C)					echo "<p class='debugClass err'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Muss eine valide Email-Adresse sein! <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
						
							// Wenn alles ok ist:						
							} else {
								// Wert entschärfen
								$this->usr_email	= cleanString($value);
							}
						}
					}
					
					
					#********** USR_CITY **********#
					public function getUsr_city(){
						return $this->usr_city;
					}
					public function setUsr_city($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->usr_city = cleanString($value);
									
							}
						}	
					}


					#********** USR_PASSWORD **********#
					public function getUsr_password(){
						return $this->usr_password;
					}
					public function setUsr_password($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->usr_password = cleanString($value);
									
							}
						}	
					}


					#********** VIRTUAL ATTRIBUTES **********#
					public function getFullname(){
						return $this->getUsr_firstname() . ' ' . $this->getUsr_lastname();
					}
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#


					public static function fetchAllFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					
					public function saveToDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					
					
					#***********************************************************#
				
					#******* FETCH A SINGLE OBJECT'S DATA FROM DB *******#
					/**
					*
					*	Fetches user object data from DB
					*	Writes all object's data into corresponding object
					*
					*	@param	PDO		$pdo		DB-connection object
					*
					*	@return	Boolean				true if dataset was found, else false
					*
					*/
					public function fetchFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
											
						$sql 		= 	"SELECT * FROM user 
										WHERE usr_email = ?";
						
						$params 	= array($this->getUsr_email());
						
						// Schritt 2 DB: SQL-Statement vorbereiten
						$statement = $pdo->prepare($sql);
						
						// Schritt 3 DB: SQL-Statement ausführen und ggf. Platzhalter füllen
						$statement->execute($params);
if(DEBUG)			if($statement->errorInfo()[2]) echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>";
						
						if( !$row = $statement->fetch() ){
							return flase;
						}else{
							$this->setUsr_id($row['usr_id']);
							$this->setUsr_firstname($row['usr_firstname']);
							$this->setUsr_lastname($row['usr_lastname']);
							$this->setUsr_city($row['usr_city']);
							$this->setUsr_password($row['usr_password']);
							
							return true;
						}
						
					}
					
				
					#***********************************************************#
					
					
					public function updateToDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					
					#***********************************************************#
					
					
					public function deleteFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
					}
					
					#***********************************************************#
					
				}
				
				
#*******************************************************************************************#
?>


















