# quantox-test
Test application for Quantox

DESCRIPTION

  So, first i red and analyzed the sheet, then i created a skeleton folders and files that i knew i was going to use
  for this App, although i'v added some more later on, and then i did the initial commit to my GitHub repo.

  Config.php, Database.php and User.php are core files here. In those i put the variables and functions needed for the
  app to work. I also used .htaccess file two times, for security and a bit nicer url. Views are separated into includes
  and real pages, with index.php having as minimum as possible data inside the file, everything comes from other pages
  via includes. There is also an .sql file, which the user can import into his database to easy him things.

  I found out some nice redirection technique, so i used it if a person tries to approach forbidden pages. Check it out!

  Speaking of PDO, or the content.php page, i had issues which i managed to solve in unconvinient way, you will see.
  But it worked out eventually :) i still dont know the reason why the convinient way didnt work.
  
  INSTRUCTIONS
  
  First create database 'quantox'. Or you can name it however you want, tho you will have to change credentials in config.php.

  Then, insert file 'users.sql' into your database. It will now create table 'users' with needed columns for you.

  Third, go to 'http://localhost/quantox-test' and it will redirect you to the login/register page, or you can simply
  go to 'http://localhost/quantox-test/views/pages/register' directly.

  Register an account and login into the system.

  And that's it :) now you can search users or see About page, also you can logout on the logout button.
