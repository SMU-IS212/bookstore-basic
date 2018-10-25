# bookstore-basic PHP

The project structure as follow:

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

CHANGELOG

Revision 1 . Files affected : bootstrap.php, login.php, include/protect.php, include/token.php
- fix bootstrap unlink() on windows 
- fix admin user protection

Current - Revision 1.1

- add ids for views add-view.php, bootstrap-view.php, edit-view.php, header.php, list-view.php,
login-view.php
- change uasort() to usort() to avoid displaying index : include/Sort.php