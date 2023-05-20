#!/bin/bash
#
cp .env env.beforedeploy
cp env.prod .env

UI_PATH="../bhakundo-webapp-react/";

export PORT=80

echo "Trying to Build the frontend code.";
echo "Enter the Frontend code path. Will wait for 10 seconds after which default path $UI_PATH is assumend!";
read -p "Enter UI repo path: " -t 5 input;
if [ ! -z "$input" ]; then
    UI_PATH=$input
fi


echo "UI repo path $UI_PATH";

cd $UI_PATH;
npm i
npm run build

cd -
echo "Using the latest UI build"
rm -rf ./public/assets
cp -rf $UI_PATH/dist/assets ./public/
cat $UI_PATH/dist/index.html > ./resources/views/ui.blade.php

rm -rf node_modules
rm package-lock.json

npm install
npm run build

sudo docker-compose build
sudo docker-compose up -d
sleep 10
sudo docker-compose exec bhakundo /usr/bin/composer install --no-interaction
sudo docker-compose exec bhakundo php artisan key:generate
sudo docker-compose exec bhakundo php artisan config:clear
sudo docker-compose exec bhakundo php artisan config:cache
sudo docker-compose exec bhakundo php artisan route:clear
sudo docker-compose exec bhakundo php artisan view:clear
sudo docker-compose exec bhakundo php artisan optimize
sudo docker-compose exec bhakundo php artisan migrate --force
sudo docker-compose exec bhakundo php artisan db:seed --force --class=UsersTableSeeder
sudo docker-compose exec bhakundo php aritsan storage:link
sudo docker-compose exec bhakundo php artisan passport:install


echo "Deployed Sucessfully! Check Servers."
