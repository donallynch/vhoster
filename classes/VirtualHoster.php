<?php

/**
 * Class VirtualHoster
 */
class VirtualHoster {

    /**
     * @param string $username
     * @param string $projectName
     */
    public function generate($username, $projectName)
    {
        $this->setPlainTextHeader();
        echo $this->generateTemplate($username, $projectName);
        die();
    }

    private function setPlainTextHeader()
    {
        // Set plaintext header:
        header("Content-Type: text/plain");
    }

    private function generateTemplate($username, $projectName)
    {
        return "
Apache Virtual Host setup on Linux Mint
Every project developed locally needs a Virtual Host:

Prerequisites: 
- Projects folder created locally: /var/www/html/projects
- Installed \"git\" on your local machine.
- Installed Sublime Text Editor (or any other text editor)
    We're using the command \"subl\" which can be replaced with \"gedit\" or any other text editor application.
- A GitHub account (https://github.com) or similar (BitBucket etc)
- Optionally, create an alias/shortcut for cd'ing to your projects folder, like this: alias cd-projects=\"cd /var/www/html/projects/\"

1)
Go to your github.com account and manually create a new project (https://github.com/new)
Open Terminal and type:
    cd projects

2)
Clone the new github project to your local machine:
Lets say the github account username is \"{$username}\" and the project is called \"{$projectName}\":
Paste these into the Terminal and hit return, one at a time (not all together):
    1. git clone https://github.com/{$username}/{$projectName}.git
    2. cd {$projectName}
    3. git init

3)
Create project index.php file, project.conf file and open apache2/sites-available/ file for editing:
    sudo touch /var/www/html/projects/{$projectName}/index.php && sudo touch /etc/apache2/sites-available/{$projectName}.conf && sudo subl /etc/apache2/sites-available/{$projectName}.conf

4)
Paste & Save this into \"/etc/apache2/sites-available/{$projectName}.conf\" virtual host file:
<VirtualHost *:80>
    ServerName {$projectName}
    DocumentRoot /var/www/html/projects/{$projectName}
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

5)
Paste this into the index.php file located at /var/www/html/projects/{$projectName}/index.php
    <?php echo \"HELLO WORLD\"; ?>

6)
Tell Apache about this new Virtual Host and add it to your hosts file:
    sudo a2ensite {$projectName}.conf && sudo service apache2 restart && sudo subl /etc/hosts

7)
Paste & Save this line at top of /etc/hosts under the localhost reference:
    127.0.0.1	{$projectName}

8)
Restart Apache server:
    service apache2 reload

9)
Run the new project in the browser, you should see \"HELLO WORLD\":
    firefox http://{$projectName}/

10)
That's it, you're done!
You should now see \"HELLO WORLD\" displaying in your browser!
Your vhost has been created and you\'re ready to start this new project.

Optional Reading:
Now browse to your new project root directory in the Terminal:
    cd-projects && cd /{$projectName}/ (only if you have setup the optional prerequisite before step 1), or
    cd /var/www/html/projects/{$projectName}/

Type these into the Terminal, one by one:
    git status
    git add .
    git commit -m \"Initial commit; added index.php file;\"
    git push origin HEAD

You will now be prompted to enter your github username, followed by your github password (depending on your settings).
The index.php file (and any other project files added or changed) have now been synchronised with github.
You can now browse to your github account and see the index.php file is now hosted by github and is now retrieved during any additional
project clone processes.

";
    }
}

