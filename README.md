# MacOSX Setup

## Apache

- Using the prefix of sudo is required for commands that have their applications protected in certain folders – when using sudo you will need to confirm with your admin password or iCloud password if set up that way…. lets get to it...

- To start Apache web sharing: ```sudo apachectl start```
- To stop it: ```sudo apachectl stop```
- To restart it: ```sudo apachectl restart```
- To find the Apache version: ```httpd -v // find apache version```

## Document root

- Document root is the location where the files are shared from the file system and is similar to the traditional names of ‘public_html‘ and ‘htdocs‘, OSX has historically had 2 web roots one at a system level and one at a user level – you can set both up or just run with one, the user level one allows multiple accounts to have their own web root whilst the system one is global for all users. It seems there is less effort from Apple in continuing with the user level one but it still can be set up with a couple of extra tweaks in configuration files. It is easier to use the user level one as you don’t have to keep on authenticating as an admin user.

## System Level Web Root

- The files are shared in the filing system at: ```/Library/WebServer/Documents/```

## User Level Root

- This is the one we are gonna use. We will store information in a folder called Sites, inside the user folder.

	- ```cd ~ && mkdir Sites```

	- ```whoami```: This will output your current user name, mine is daniel. Use yours from now on throughout this tutorial.

	- ```cd /etc/apache2/users/ && sudo touch daniel.conf```

	- ```echo " # This should be omitted in the production environment
				SetEnv APPLICATION_ENV development

				<Directory "/Users/daniel/Sites/">
     				AllowOverride All
     				Options Indexes MultiViews FollowSymLinks
     				Require all granted
				</Directory>" > daniel.conf```

	- ```sudo chmod 644 daniel.conf```

	- ```sudo nano /etc/apache2/httpd.conf```
		- Make sure the following modules are uncommented:

			- ```LoadModule authz_core_module libexec/apache2/mod_authz_core.so```

			- ```LoadModule authz_host_module libexec/apache2/mod_authz_host.so```

			- ```LoadModule userdir_module libexec/apache2/mod_userdir.so```

			- ```LoadModule include_module libexec/apache2/mod_include.so```

			- ```LoadModule rewrite_module libexec/apache2/mod_rewrite.so```

			- ```LoadModule php5_module libexec/apache2/libphp5.so```

			- ```Include /private/etc/apache2/extra/httpd-userdir.conf```

			- Also add the lines (enable symlinks):
				- ```User daniel```
			 	- ```Group staff```
			 	- and comment out:
			 	- ```User _www```
			 	- ```Group _www```

	- ```sudo nano /etc/apache2/extra/httpd-userdir.conf```
		- Make sure the following module is uncommented:
			- ```Include /private/etc/apache2/users/*.conf```

	- ```sudo apachectl restart```

	- Now you can access: http://localhost/~daniel/

## PHP

- PHP 5.6.24 is loaded in the build of macOS Sierra and needs to be turned on by uncommenting a line in the httpd.conf file.

	- ```sudo nano /etc/apache2/httpd.conf```

	- Make sure the following module is uncommented:
		- ```LoadModule php5_module libexec/apache2/libphp5.so```

	- ```cd ~/Sites && touch phpinfo.php```

	- ```echo "<?php phpinfo(); ?>" > phpinfo.php```

## MySQL

- The macOS Sierra Public Beta’s didn’t play well with MySQL 5.7.x, but these issues are now resolved by using MySQL 5.7.16

- MySQL doesn’t come pre-loaded with macOS Sierra and needs to be dowloaded from the MySQL site.

- The latest version of MySQL 5.7.16 does work with the public release of macOS.

- Use the Mac OS X 10.11 (x86, 64-bit), DMG Archive version (works on macOS Sierra).

- When it is finished installing you get a dialog box with a temporary mysql root password – that is a MySQL root password not a macOS admin password, copy and paste it so you can use it. But I have found that the temporary password is pretty much useless so we’ll need to change it straight away.

	- ```2017-03-28T03:21:25.122815Z 1 [Note] A temporary password is generated for root@localhost: F5JIg+Yupi.n```
		- If you lose this password, please consult the section How to Reset the Root Password in the MySQL reference manual

	- Note that this is not the same as the root or admin password of macOS – this is a unique password for the mysql root user, use one and remember/jot down somewhere what it is.

	- Stop MySQL: ```sudo /usr/local/mysql/support-files/mysql.server stop```

	- ```echo "export PATH=${PATH}:/usr/local/mysql/bin" > ~/.bash_profile```

	- ```source ~/.bash_profile```

	- Start it in safe mode:  ```sudo mysqld_safe --skip-grant-tables```

	- ```mysql -u root```

		- ```FLUSH PRIVILEGES;```
		- ```ALTER USER 'root'@'localhost' IDENTIFIED BY 'projeto_incluir';```
		- ```\q```

	- ```sudo /usr/local/mysql/support-files/mysql.server start```

	- Check MySQL version: ```mysql -u root -p -v```


## Fix the 2002 MySQL Socket error

- Fix the looming 2002 socket error – which is linking where MySQL places the socket and where macOS thinks it should be, MySQL puts it in /tmp and macOS looks for it in /var/mysql the socket is a type of file that allows mysql client/server communication.

	- ```sudo mkdir /var/mysql```

	- ```sudo ln -s /tmp/mysql.sock /var/mysql/mysql.sock```

## phpMyAdmin

- Download phpMyAdmin, the zip English package will suit a lot of users, then unzip it and move the folder with its contents into the document root level renaming folder to ‘phpmyadmin’.

	- Make the config folder: ```mkdir ~/Sites/phpmyadmin/config```

	- Change permission: ```chmod o+w ~/Sites/phpmyadmin/config```

	- Access: http://localhost/~daniel/phpmyadmin/setup/

		- Click "New Server"

		- Setup authentication for the root user, or any other valid mysql user

	- Access: http://localhost/~daniel/phpmyadmin/

		- To upgrade phpmyadmin just download the latest version and copy the older ‘config.inc.php‘ from the existing directory into the new folder and replace – backup the older one just in case.

## Permissions

- Lets say that you have a site in the User Sites folder at the following location ~/Sites/daniel you would set it to be writeable like so:

	- ```sudo chmod -R a+w ~/Sites/daniel```


- If you are concerned about security then instead of making it world writeable you can set the owner to be Apache _www but when working on files you would have to authenticate more as admin you are “not” the owner, you would do this like so:

	- ```sudo chown -R _www ~/Sites/daniel```

	- This will set the contents recursively to be owned by the Apache user.
