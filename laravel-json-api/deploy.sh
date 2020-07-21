echo "Deploy script started"
cd /usr/share/nginx/json-api/
git fetch --all
git reset --hard origin/develop
php7.2 /usr/local/bin/composer install
php7.2 artisan migrate
php7.2 artisan view:clear
php7.2 artisan route:clear
php7.2 artisan config:clear
php7.2 artisan cache:clear
chown -R www-data:www-data /usr/share/nginx/json-api
echo "Deploy script finished execution"
