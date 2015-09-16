# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = '2'

@script = <<SCRIPT
DOCUMENT_ROOT_ZEND="/var/www/ams/public"
apt-get update
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get install -y apache2 git curl php5-cli php5 php5-intl libapache2-mod-php5 php5-intl php5-mysqlnd php5-xdebug libapache2-mod-php5 mysql-server-5.6 subversion openjdk-7-jdk ant nodejs npm nfs-common portmap

echo "xdebug.remote_enable=1
xdebug.remote_connect_back=1" > "/etc/php5/mods-available/xdebug-cfg.ini"

php5dismod opcache
php5enmod xdebug-cfg

echo "
<VirtualHost *:80>
    ServerName ams.local
    DocumentRoot $DOCUMENT_ROOT_ZEND
    <Directory $DOCUMENT_ROOT_ZEND>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
" > /etc/apache2/sites-available/ams.conf
a2enmod rewrite
a2dissite 000-default
a2ensite ams
service apache2 restart

echo "cd /var/www/ams" >> /home/vagrant/.bashrc

cd /var/www/ams
curl -Ss https://getcomposer.org/installer | php
php composer.phar install --no-progress
echo "** [ZEND] Visit http://localhost:8085 in your browser for to view the application **"
SCRIPT

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'bento/ubuntu-14.04'
  config.vm.network :private_network, ip: "192.168.50.50"
  config.vm.hostname = "ams.local"
  config.vm.synced_folder '.', '/var/www/ams',  :nfs => true
  config.vm.provision 'shell', inline: @script

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

end
