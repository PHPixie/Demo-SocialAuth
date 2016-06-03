# PHPixie Social Auth demo

This is an example of implementing social based login in PHPixie.
Upon their first social login a database entry will be created to store the user.

First create a database with the following table:

```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebookId` varchar(255) DEFAULT NULL,
  `twitterId` varchar(255) DEFAULT NULL,
  `googleId` varchar(255) DEFAULT NULL,
  `vkId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

Update `assets/config/database.php` with your database credentials, and
`assets/config/social.php` with you API keys.

Point your webserver to the /web/ folder
