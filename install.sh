wget https://raw.githubusercontent.com/LucienShui/PasteMeBackend/master/installer.sh -O backend_installer.sh
wget https://raw.githubusercontent.com/LucienShui/PasteMeFrontend/master/installer.sh -O frontend_installer.sh
bash backend_installer.sh install && \
bash frontend_installer.sh install && \
rm backend_installer.sh && \
rm frontend_installer.sh && \
bash -c "
clear
echo 'Installation finished'
echo -e '\033[31mEdit config files below is required\033[0m'
echo '------------------PasteMe-------------------'
echo '| Config files:                            |'
echo -e '| Nginx: \033[32m/etc/pasteme/conf.d/default.conf\033[0m  |'
echo -e '| Frontend: \033[32m/etc/pasteme/usr/config.json\033[0m   |'
echo -e '| Backend: \033[32m/etc/pastemed/config.sh\033[0m         |'
echo '--------------------------------------------'
"
