# ITEX

The aim is to summarise the function of each page:


-itex_addMoney.php: This is a front page where users add money to their wallets

-itex_dashboard.php: It is a front page where users can view their account details at a glance

-itex_design: CSS stylesheet

-itex_homepage.php: It includes the links to either login or register

-itex_login.php: users login to account 

-itex_register.php: users create new wallet account

-itex_withdrawMoney.php: front page where users withdraw money from account

-server_addMoney.php:backend page where money added by user is recorded in database

-server_deactivateUser: backend page where user account is deactivated

-server_itexLogin.php: backend page where user login on server and session variables are created

-server_itexRegister.php: backend page where user opens new account record on server

-server_reactivateUser.php: backend page to reactivate user account on server

-server_withdrawMoney.php: backend page where money withdrawn by user is recorded in database.

-create_tables: MYSQL script showing how tables were created in a database.



In an real situation the server scripts ought to communicate directly with bank APIs
and debit/credit card APIs but I don't have access to those APIs.


So I made some assumptions like:

The bank has approved the transaction.


The credit/debit card company has approved the transaction.


Then I prepared the account balance and stored the record in a table.




Thanks a lot for your time.

Regards.
