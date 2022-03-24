# Horizon Suite
Made for gaming communities.
## Horizon is a work in progress, forums/admin area not yet complete, but still partially working. Not recommended for live sites.

## About Horizon
Horizon is a web application which is aimed to gaming communities who don't fancy spending money on custom websites. With Horizion, setup everything in a few seconds! And create roles/forums/server queries/donation methods in just a few clicks in the custom admin panel.

## Setup

~~In order to setup Horizon, simply create a database and setup your ~~ `.env` file.
Within this, you'll want to create some variables. So, add the following to your `.env` file.~~

```
STEAM_REDIRECT_URI=http://yoursite.com/auth/user
STEAM_CLIENT_SECRET=STEAM_API_KEY(https://steamcommunity.com/dev/apikey)

BM_SECRET_KEY=BATTLEMETRICS_AUTH_TOKEN(https://www.battlemetrics.com/developers/token)
```

~~You will then need to migrate the database by running `php artisan migrate`. The first account to login will become the ``root`` user.
And finally, to get all the packages and compile the css/js, simply run `npm install` and `npm run dev`.
Then you're all good!~~

The new installation page will do it for you! Just input your SQL details and API Keys, and voila!
