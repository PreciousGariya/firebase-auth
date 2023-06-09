
  
echo "enter the name of virtual host you want to create"
read vhost
sudo touch /etc/apache2/sites-available/$vhost.conf
echo "Enter the root path of your project"
read path

echo  " <VirtualHost *:80>
    
    ServerName $vhost
    ServerAdmin webmaster@localhost
    DocumentRoot $path
    
    <Directory /var/www>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
    </Directory>
    # Available loglevels: trace8, ..., trace1, debug, info, notice, warn,
    # error, crit, alert, emerg.
    # It is also possible to configure the loglevel for particular
    # modules, e.g.
    #LogLevel info ssl:warn
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
    # For most configuration files from conf-available/, which are
    # enabled or disabled at a global level, it is possible to
    # include a line for only one particular virtual host. For example the
    # following line enables the CGI configuration for this host only
    # after it has been globally disabled with "a2disconf".
    #Include conf-available/serve-cgi-bin.conf
</VirtualHost> " >  /etc/apache2/sites-available/$vhost.conf

sudo a2ensite $vhost.conf
sudo service apache2 restart
echo "127.0.0.1  $vhost" >> /etc/hosts

