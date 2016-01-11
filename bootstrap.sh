#!/bin/bash

readonly DEV_PROJECT_NAME=adscend_challenge

# Install LAMP stack.
debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
apt-get update
apt-get install -y apache2 mysql-server php5 php-pear php5-mysql php5-mcrypt php5-json vim
a2enmod rewrite
rm -rf /var/www/
mkdir /var/www/
service apache2 restart

# Upgrade to PHP 5.5.
apt-get update
apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php5
apt-get update
apt-get dist-upgrade

# Install Composer.
cd ~
apt-get install -y curl libcurl3 libcurl3-dev php5-curl
curl -sS https://getcomposer.org/installer | php
chmod +x composer.phar
mv composer.phar /usr/local/bin/composer

# Setup Laravel using Composer.
cd /var/www/
composer create-project laravel/laravel ${DEV_PROJECT_NAME} --prefer-dist
chown -R vagrant:www-data ${DEV_PROJECT_NAME}/
chmod -R ug+w ${DEV_PROJECT_NAME}/app/storage/
mysql -uroot -ppassword -e "CREATE DATABASE ${DEV_PROJECT_NAME};"

# Configure Apache.
a2dissite default
echo "<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        ServerName ${DEV_PROJECT_NAME}.dev
        DocumentRoot /var/www/${DEV_PROJECT_NAME}/public/
        ErrorLog ${APACHE_LOG_DIR}/${DEV_PROJECT_NAME}-error.log
        LogLevel warn
        CustomLog ${APACHE_LOG_DIR}/${DEV_PROJECT_NAME}-access.log combined
</VirtualHost>" > /etc/apache2/sites-available/${DEV_PROJECT_NAME}
a2ensite ${DEV_PROJECT_NAME}
service apache2 reload