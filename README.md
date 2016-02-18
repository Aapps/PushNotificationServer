# GCMPushNotificationServer
*************************************************
Server side code for GCM push notification in PHP
*************************************************

#php files and their role:
     1. db_functions.php: contains Database manipulation functions. Automatically connects to the default database upon object creation.
     2. db_functions_auth.php: contains Database functions to deal with authentication.
     3. gcm_main.php: main php file which sends push notification upon form submission in index.php
     4. index.php: A simple html form to submit message to be sent as push notification.
     5. register.php: accessed from android device. It stores the registration ID sent from android client app.
     6. unregister.php: unregisters an ID sent from android client app.
     7. config.php: database configuration.
     8. urls.php: Commonly used URLS.
     9. commonutils.php: Commonly used functions.
     10. validator.php: Form Validation functions.
