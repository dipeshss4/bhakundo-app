#!/bin/bash
#
cp .env env.beforedeploy
cp env.prod .env

rm -rf node_modules
rm package-lock.json

npm install
npm run build

docker-compose build
docker-compose up -d
sleep 10
docker-compose exec bhakundo php artisan key:generate
docker-compose exec bhakundo php artisan config:clear
docker-compose exec bhakundo php artisan config:cache
docker-compose exec bhakundo php artisan optimize
docker-compose exec bhakundo php artisan migrate --force
docker-compose exec bhakundo php artisan db:seed --force
docker-compose exec bhakundo php artisan passport:install

echo "Deployed Sucessfully! Check Servers."
