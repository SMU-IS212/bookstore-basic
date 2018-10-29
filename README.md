# bookstore-basic PHP
CHANGELOG
Please update following files:
- include/common.php = >     "if (!isset($value) || empty($value)) {" to   "if (!isset($value) || (empty($value) && $value !== "0")) {"
- inlcude/Sort.php = > "uasort()" to "usort()"
Replace these files with current latest version
- json/bootstrap.php 
- include/userDAO.php
I have got suggestion to replace sort($errors) with $errors=usort($errors,"strnatcasecmp") to ignore case-sensitive (ISBN13 before )
Current - Revision 1.4


The project structure as follow:

---------------------------------


Configuration

	include/configuration.php	# This is where you change your config to match your
					deployment
View

	list-view.php 			# This is your main interface to display books
	login-view.php
	add-view.php
	edit-view.php
	bootstrap-view.php
Control

	login.php-logout.php
	add.php
	delete.php
	edit.php
	json/bootstrap.php
	include/Sort.php		# Use this to sort your book-list
Protect

	include/protect.php
Common functions

	include/common.php		# Common functions, error checking ... This file
					along with protect.php to be included in the beginning
					of every php file. 
DAO

	include/book.php		# Book class
	include/BookDAO.php
	inlcude/user.php		# User class
	include/UserDAO.php
MISC

	include/token.php		# Generate user token
	json/				# All json interfaces


Revision 1 . Files affected : bootstrap.php, login.php, include/protect.php, include/token.php
- fix bootstrap unlink() on windows 
- fix admin user protection

Revision 1.1
- add ids for views add-view.php, bootstrap-view.php, edit-view.php, header.php, list-view.php,
login-view.php
- change uasort() to usort() to avoid displaying index : include/Sort.php

Revision 1.2 . Files affected json/bootstrap.php ; include/UserDAO.php ; include/Sort.php
- refactor and fix inconsistency in bootstrap

Current - Revision 1.3 . Files affected json/bootstrap.php ; json/authenticate.php ; include/protect.php; include/common.php
- Fix several bugs in bootstrap.php
- "message"->"messages" in authenticate.php
- Protect Upload in protect.php
- Fix a bug where "ISBN13 record not found" is displayed along "invalid ISBN13 value" Common.php