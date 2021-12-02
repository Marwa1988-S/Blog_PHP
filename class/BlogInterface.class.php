<?php
#*******************************************************************************************#


				#*************************************#
				#********** INTERFACE BLOG ***********#
				#*************************************#

				
#*******************************************************************************************#

				/** 
				* 	 
				*	Interface for Blog Class.			
				*
				*/
				interface BlogInterface {
					
					/*
						Ein Interface darf keinerlei Attribute beinhalten.
					*/
					
					#***********************************************************#
					
					
					#*********************************#
					#********** KONSTRUKTOR **********#
					#*********************************#
					
					public function __construct( 	$user=NULL, $category=NULL, $blog_headline=NULL, $blog_image=NULL, 
															$blog_imageAlignment=NULL, $blog_content=NULL, $blog_date=NULL, 
															$blog_id=NULL );
					
					
					#********** DESTRUCTOR **********#
					
					public function __destruct();
					
					#***********************************************************#

					
					#*************************************#
					#********** GETTER & SETTER **********#
					#*************************************#
				
					#********** BLOG_HEADLINE **********#
					public function getBlog_headline();
					public function setBlog_headline($value);
					
					#********** BLOG_IMAGE **********#
					public function getBlog_image();
					public function setBlog_image($value);
					
					#********** BLOG_IMAGEALINMENT **********#
					public function getBlog_imageAlignment();
					public function setBlog_imageAlignment($value);
					
					#********** BLOG_CONTENT **********#
					public function getBlog_content();
					public function setBlog_content($value);
					
					#********** BLOG_DATE **********#
					public function getBlog_date();
					public function setBlog_date($value);
					
					#********** USER OBJECT **********#
					public function getUser();
					public function setUser(User $value);
					
					#********** CATEGORY OBJECT **********#
					public function getCategory();
					public function setCategory(Category $value);
					
					#********** BLOG_ID **********#
					public function getBlog_id();
					public function setBlog_id($value);
					
					#********** VIRTUAL ATTRIBUTES **********#
					
					
					#***********************************************************#
					

					#******************************#
					#********** METHODEN **********#
					#******************************#
					
					public static function fetchAllFromDb(PDO $pdo, $categoryId = NULL);
					
					public function saveToDb(PDO $pdo);
					
					public function fetchFromDb(PDO $pdo);
					
					public Function updateToDb(PDO $pdo);
					
					public function deleteFromDb(PDO $pdo);					
					
					
					#***********************************************************#
					
					
				}
				
				
#*******************************************************************************************#
?>


















