<?php
#*******************************************************************************************#


				#***********************************#
				#********** CLASS Blog **********#
				#***********************************#

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
				*	Class representing a Blog including an User object, and a Category object .			
				*
				*/
				class Blog {
					
					#*******************************#
					#********** ATTRIBUTE **********#
					#*******************************#
					
					/* 
						Innerhalb der Klassendefinition müssen Attribute nicht zwingend initialisiert werden.
						Ein Weglassen der Initialisierung bewirkt das gleiche, wie eine Initialisierung mit NULL.
					*/
					private $blog_id;
					private $blog_headline;
					private $blog_image;
					private $blog_imageAlignment;
					private $blog_content;
					private $blog_date;
					// User-Objekt
					private $user;
					// Category-Objekt
					private $category;
					
					
					
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
					*	@param	User 				$user						= NULL	User object owning Blog object
					*	@param	Category 		$category				= NULL	Category object owned by Blog object
					*	@param	String 			$blog_headline			= NULL	Blog headline
					*	@param	String 			$blog_image				= NULL	Blog image path
					*	@param	String 			$blog_imageAlignment	= NULL	Blog image alignment
					*	@param	String 			$blog_content			= NULL	Blog content text
					*	@param	String 			$blog_date				= NULL	Blog date
					*	@param	String 			$blog_id					= NULL	Record-Id given by database
					*
					*	@return	void
					*
					*/
					
					public function __construct( 	$user=NULL, $category=NULL, $blog_headline=NULL, $blog_image=NULL, 
															$blog_imageAlignment=NULL, $blog_content=NULL, $blog_date=NULL, 
															$blog_id=NULL ) {
if(DEBUG_CC)		echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\n";						

						if( isset($blog_headline)  		)		$this->setBlog_headline($blog_headline);
						if( isset($blog_image)				)		$this->setBlog_image($blog_image);
						if( isset($blog_imageAlignment)	)		$this->setBlog_imageAlignment($blog_imageAlignment);
						if( isset($blog_content)			)		$this->setBlog_content($blog_content);
						if( isset($blog_date)				)		$this->setBlog_date($blog_date);
						if( isset($user)						)		$this->setUser($user);
						if( isset($category)					)		$this->setCategory($category);
						if( isset($blog_id)					)		$this->setBlog_id($blog_id);

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

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
					
					
					#********** BLOG_HEADLINE **********#
					public function getBlog_headline(){
						return $this->blog_headline;
					}
					public function setBlog_headline($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->blog_headline = cleanString($value);
									
							}
						}	
					}
					
					#********** BLOG_IMAGE **********#
					public function getBlog_image(){
						return $this->blog_image;
					}
					public function setBlog_image($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->blog_image = cleanString($value);
									
							}
						}
						
					}
					
					#********** BLOG_IMAGEALINMENT **********#
					public function getBlog_imageAlignment(){
						return $this->blog_imageAlignment;
					}
					public function setBlog_imageAlignment($value){
						
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->blog_imageAlignment = cleanString($value);
									
							}
						}
					}
					
					#********** BLOG_CONTENT **********#
					public function getBlog_content(){
						return $this->blog_content;
					}
					public function setBlog_content($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->blog_content = cleanString($value);
									
							}
						}
						
					}
					
					#********** BLOG_DATE **********#
					public function getBlog_date(){
						return $this->blog_date;
					}
					public function setBlog_date($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->blog_date = cleanString($value);
									
							}
						}
						
					}
					
					#********** USER OBJECT **********#
					public function getUser() : ?User {
						return $this->user;
					}
					public function setUser(User $value) : void {
						$this->user = $value;					
					}
					
					#********** CATEGORY OBJECT **********#
					public function getCategory() : ?Category {
						return $this->category;
					}
					public function setCategory(Category $value) : void {
						$this->category = $value;					
					}
					
					#********** BLOG_ID **********#
					public function getBlog_id(){
						return $this->blog_id;
					}
					public function setBlog_id($value){
						if( $value !== '' ) {
if(DEBUG_C)				echo "<p class='debugClass'><b>Line " . __LINE__ . "</b>: " . __METHOD__ . "(): Gültiger Wert empfangen... <i>(" . basename(__FILE__) . ")</i></p>\r\n";				
							
							// Vor dem Schreiben in das Attribut auf korrekten Datentyp prüfen
							if( !is_string($value) ) {
if(DEBUG_C)					echo "<h3 class='debugClass err'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "(): Muss Datentyp String sein! (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
						
							} else {
								// Wert entschärfen
								$this->blog_id = cleanString($value);
									
							}
						}	
					}
					
					#********** DELEGATIONS **********#
					
										
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#
									
					
					#********** FETCH ALL OBJECTS DATA FROM DB **********#
					/**
					*
					*	Fetches  all blogs data and related objects data from DB
					*	Writes all object's data into corresponding objects
					*	Calling blog object must contain user object, and category object
					*
					*	@param	PDO		$pdo		               DB-connection object
					*	@param	int 		$categoryId		= NULL	Category-Id
					*
					*	@return	Array  	$blogsArray			      array of all Blogs in DB , is NULL when there is no Blogs
					*
					*/
					public static function fetchAllFromDb(PDO $pdo, $categoryId = NULL){
						if($categoryId){
if(DEBUG)				echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Lade Blog-Einträge nach Kategorie... <i>(" . basename(__FILE__) . ")</i></p>";					
							$sql 		= 	"SELECT * FROM blog
										INNER JOIN user USING(usr_id)
										INNER JOIN category USING(cat_id)
										WHERE cat_id = ?
										ORDER BY blog_date DESC
										";
						
						}else{
if(DEBUG)				echo "<p class='debug hint'>Line <b>" . __LINE__ . "</b>: Lade alle Blog-Einträge... <i>(" . basename(__FILE__) . ")</i></p>";
							$sql 		= 	"SELECT * FROM blog
										INNER JOIN user USING(usr_id)
										INNER JOIN category USING(cat_id)
										ORDER BY blog_date DESC
										";
						
						}
						
							
						$params 	= array( $categoryId );	

						// Schritt 2 DB: SQL-Statement vorbereiten
						$statement = $pdo->prepare($sql);
						
						// Schritt 3 DB: SQL-Statement ausführen und ggf. Platzhalter füllen
						$statement->execute($params);
if(DEBUG)			if($statement->errorInfo()[2]) echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>";
									
						// Gefundene Datensätze für spätere Verarbeitung in Array of Blog-object zwischenspeichern
						$blogsArray = NULL;
						while($row = $statement->fetch(PDO::FETCH_ASSOC)){
							$userObj = new User($row['usr_firstname'],$row['usr_lastname'],$row['usr_email'],$row['usr_city'],$row['usr_password'] ,$row['usr_id']);
							$categoryObj = new Category($row['cat_name'],$row['cat_id']);
													
							$blogsArray [] = new Blog($userObj,$categoryObj,$row['blog_headline'],$row['blog_image'],$row['blog_imageAlignment'],$row['blog_content'],$row['blog_date'],$row['blog_id']);

						}
						
						return $blogsArray;
					}
					
					#***********************************************************#
					
					
					#********** SAVE BLOG DATA INTO DB **********#
					/**
					*
					*	Saves new dataset of blog object attributes data into DB
					*	Writes the DB insert ID into calling blog object
					*
					*	@param	PDO		$pdo		DB-connection object
					*
					*	@return	Boolean				true if writing was successful, else false
					*
					*/
					public function saveToDb(PDO $pdo) {
						
						$sql 		= 	"INSERT INTO blog (blog_headline, blog_image, blog_imageAlignment, blog_content, cat_id, usr_id)
										VALUES (?,?,?,?,?,?) ";
						
						$params 	= array( $this->getBlog_headline(),
												$this->getBlog_image(),
												$this->getBlog_imageAlignment(),
												$this->getBlog_content(),
												$this->getCategory()->getCat_id(),
												$this->getUser()->getUsr_id()
												);
						
						// Schritt 2 DB: SQL-Statement vorbereiten
						$statement = $pdo->prepare($sql);
						// Schritt 3 DB: SQL-Statement ausführen und ggf. Platzhalter füllen
						$statement->execute($params);
if(DEBUG)			if($statement->errorInfo()[2]) echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>";
							
						// Schritt 4 DB: Daten weiterverarbeiten
						// Bei schreibendem Zugriff: Schreiberfolg prüfen
						$rowCount = $statement->rowCount();
if(DEBUG_C)			echo "<p class='debug'>Line <b>" . __LINE__ . "</b>: \$rowCount: $rowCount <i>(" . basename(__FILE__) . ")</i></p>";
						
						if( $rowCount != 1) {
							// Fehlerfall
							return false;
							
						} else {
							// Erfolgsfall
							$this->setBlog_id($pdo->lastInsertId());
							return true;
						}						
					}
					
					
					#***********************************************************#
					
					
					#********** FETCH A SINGLE OBJECT'S DATA FROM DB **********#
					/**
					*
					*	Fetches blog object data and related objects data from DB
					*	Writes all object's data into corresponding objects
					*	Calling blog object must contain user object, and category object
					*
					*	@param	PDO		$pdo		DB-connection object
					*
					*	@return	Boolean				true if dataset was found, else false
					*
					*/
					public function fetchFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";

								
					}
					
					
					#***********************************************************#
					
					
					#********** UPDATE TO DB **********#
					/**
					*
					*	Updates blog object's data into DB by blog_id
					*
					*	@param	PDO		$pdo		DB-connection object
					*
					*	@return	Int					Number of affected rows
					*
					*/
					public function updateToDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";
						
							
					//	return $rowCount;
						
					}
					
					
					#***********************************************************#
					
					
					#********** DELETE FROM DB **********#
					/**
					*
					*	Deletes current blog object's dataset from DB by Account ID
					*
					*	@param	PDO		$pdo		DB-connection object
					*
					*	@return	Int					Number of affected rows
					*
					*/
					public function deleteFromDb(PDO $pdo) {
if(DEBUG_C)			echo "<h3 class='debugClass'><b>Line " . __LINE__ .  "</b>: Aufruf " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\n";
						
					//return $rowCount;
						
					}
					
					
					#***********************************************************#
					
				}		
#*******************************************************************************************#
?>


















