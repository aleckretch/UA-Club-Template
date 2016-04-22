See this link for how to access the cPanel:
http://uits.arizona.edu/services/web-hosting/w6/initial-setup/cPanel

After having accessed the cPanel, to create a database:
http://uits.arizona.edu/content/creating-mysql-database-through-cpanel

Copy the information used to create the database, i.e database name,username,password

SSH into the site via the username,hostname and password received in the email from UITS

Go into the public_html folder via this command:
cd public_html

Copy the club template files from Github with this command:
git clone https://github.com/aleckretch/UA-Club-Template.git .

Run the following command to begin setting up the template:
php startup.php

This will ask for the following:
The name of the database that you created in the cPanel.
The username of the account for the database that you created in the cPanel.
The password of the account for the database that you created in the cPanel.
The netid of an editor for the club site.
The title of the club site that will show up on every web page.
The URL that the club site will be at.

Once this is done the site should be set up and should be able to be visited.


