# Tasty-Recipes
This project is a part of the ID1354 Internet Applications course at KTH.
Code written by WolfAlexander under September - October 2015.

Project assignment: create a website for imaginary company Tasty Recipes who wants a website for recipes for every day of the month. 
Website have to have a welcoming page, index page, which will promote a calendar. 
Calendar page have to contain, of course, a calendar for one month with clickable images of the month’s dishes.
These images shall be links to corresponding recipes.
Recipes page shall display recipes information, show users comments and provide possibility for inlogged user to leave comments.
Recipes are stored in XML files and users information and comments are stored in a SQL database. Comments are retrieved using
long polling where client is asking server for new comments, server checks if any new comments have been entered and returns them to user, if not server will wait for new comments. Inlogged users are also able to change their comments, but not to delete or change to empty.


Architectural pattern:
  • Model-view-viewmodel
  
Languages and libraries:
  •	HTML 
  •	XML for content storage like recipes
  •	CSS3, SCSS
  •	JavaScript KnockOutJS
  •	Object oriented PHP
  •	SQL
  
Security:
  • File System Security - prohibit HTTP access to file that containts login to server
  • Input filtering(only basic, no regular expressions) and XSS  - htmlentities(), check if empty, real_escape_string() in PHP for SQL parameters
  • Database security - prepare statements to prevent SQL injection and limited access for this application: only SELECT, INSERT and UPDATE
  • Password Encryption - using PHP build-in password_hash() and password_verify()
  • Impersonation - reset PHPSESSID when user log in or log out 

Tools used: 
  • Intellij PHPStorm
  •	XAMPP with SQL database

Some material taken from other websites:
  •	Told by teacher to use recipe information and pictures from http://www.tasteofhome.com.
  •	XML Schema: http://mycookbook-android.com/site/my-cookbook-xml-schema/

