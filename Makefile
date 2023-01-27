# É um worker, será necessário dar um terminate no horizon e deixar o supervisor criar um novo processo.
# OU
# É um webserver, será necessário dar um reload no php-fpm.
deploy:
	@(git pull | grep -qF "Already up to date.") || ((test -s /etc/init.d/supervisor && echo "Worker Reload" && php artisan horizon:terminate) || (test -s /etc/init.d/php7.4-fpm && echo "Webserver Reload" && sudo service php7.4-fpm reload))	

