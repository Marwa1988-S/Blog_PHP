<?php
#*******************************************************************************************#


				#*************************************#
				#********** INTERFACE Category ***********#
				#*************************************#

				
#*******************************************************************************************#

				/** 
				* 	 
				*	Interface for Category Class.			
				*
				*/
				interface CategoryInterface {
					
					/*
						Ein Interface darf keinerlei Attribute beinhalten.
					*/
					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					public function __construct( 	$cat_name=NULL, $cat_id=NULL );
					
					
					#********** DESTRUCTOR **********#
					
					public function __destruct();
					
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					
					#********** CAT_ID **********#
					public function getCat_id();
					public function setCat_id($value);
					
					
					#********** CAT_NAME **********#
					public function getCat_name();
					public function setCat_name($value);
					
					
					
					#********** VIRTUAL ATTRIBUTES **********#
					
					
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


















