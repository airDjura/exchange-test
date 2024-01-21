<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Setup

## Run docker compose
``` docker compose up -d ```

## Setup project
#### Install dependencies, initialize env and generate app key
``` 
docker compose exec php composer install &&
cp .env.example .env &&
docker compose exec php php artisan key:generate
```
In `.env` file set `CURRENCY_LAYER_API_KEY` which can be obtained [here](https://currencylayer.com/dashboard)

And `SOURCE_CURRENCY` which is the currency you want to convert from. (Default is `USD`)

#### Setup database and fetch currencies rates
```
docker compose exec php php artisan migrate --seed &&
docker compose exec php php artisan currency:update-rates
```

## Cron job command
It's already part of the setup script above, don't need to run it again.
``` 
php artisan currency:update-rates 
```

## Check emails

MailCatcher should be available [here](http://localhost:8100/) after docker setup

