<?php
#*******************************************************************************************#


				#*************************************#
				#********** INTERFACE USER ***********#
				#*************************************#

				

				
#*******************************************************************************************#

				/** 
				* 	 
				*	Interface for User Class.			
				*
				*/
				interface UserInterface {
					
					/*
						Ein Interface darf keinerlei Attribute beinhalten.
					*/
					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					
					public function __construct( 	$usr_firstname=NULL, $usr_lastname=NULL, $usr_email=NULL,
															$usr_city=NULL, $usr_password=NULL, $usr_id=NULL );
					
					
					#********** DESTRUCTOR **********#
					
					public function __destruct();
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					
					#********** USR_ID **********#
					public function getUsr_id();
					public function setUsr_id($value);
					
					
					#********** USR_FIRSTNAME **********#
					public function getUsr_firstname();
					public function setUsr_firstname($value);
					
					
					#********** USR_LASTNAME **********#
					public function getUsr_lastname();
					public function setUsr_lastname($value);
					
					
					#********** USR_EMAIL **********#
					public function getUsr_email();
					public function setUsr_email($value);
					
					
					#********** USR_CITY **********#
					public function getUsr_city();
					public function setUsr_city($value);
					
					
					#********** USR_PASSWORD **********#
					public function getUsr_password();
					public function setUsr_password($value);


					#********** VIRTUAL ATTRIBUTES **********#
					public function getFullname();
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#
					
					public static function fetchAllFromDb(PDO $pdo);
					
					public function saveToDb(PDO $pdo);
					
					public function fetchFromDb(PDO $pdo);
					
					public Function updateToDb(PDO $pdo);
					
					public function deleteFromDb(PDO $pdo);					
					
					
					#***********************************************************#
					
					
				}
				
				
#*******************************************************************************************#
?>


















