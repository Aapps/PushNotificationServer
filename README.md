*************************************************
Server side code for GCM push notification in PHP
*************************************************
For a complete tutorial on how you can make use of this project visit [this link](https://neurobin.org/docs/android/push-notification-gcm-client-server/).
<span id="server-php-files"></span>
#PHP files at a glance:

1. **commonutils.php:** Common utilities.
2. **config.php:** Defines constants. Among all the codes, only this file needs to be modified. Other files can be left untouched.
3. **db_functions.php:** Database functions for making database connection, storing/retrieving users and their info and performing various tests on the **gcm_users** table.
4. **gcm_main.php:** This is the file that is responsible for sending push notification.
5. **index.php:** This is the form i.e the admin panel page.
6. **register.php:** This is the php file that your client app should post registration id to register with your server.
7. **unregister.php:** This is the php file that your client app should post registration id to un-register with your server.

<span id="server-php-funcs"></span>
#Notable PHP functions at a glance:

1. `redirect($url)`: Redirects to the specified url.
2. `storeUser($gcm_regid, $instanceId, $name, $email)`: Member function of **DB_Functions_GCM** class. Stores registration id in database along with other info.
3. `checkUserById($id)`: Member function of **DB_Functions_GCM** class. Checks if an existing user already exists in database with the same registration id.
4. `deleteUserById($id)`: Member function of **DB_Functions_GCM** class. Deletes a user from database according to the registration id (unsubscribe).
5. `sendPushNotification($registration_ids, $message)`: Sends push notification `$message` to all ids in the `$registration_ids` array.
