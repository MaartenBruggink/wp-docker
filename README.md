# Simple docker setup

Features:

- Volume for the theme to get instant updates while editing
- Volume for the DB for persistant storage
- Composer for installing plugins

## Setup

1. Copy the .env.example to the `/config/local`
2. Replace the salt vales in the `/wordpress/wp-config.php`
3. Add required free plugins to the `/wordpress/composer.json` from [WPackagist](http://wpackagist.org/)
4. Add bought/unavailable plugins to the `/wordpress/wp-content/plugins` folder and if the repo is private add them to the `.gitignore` as an exception like so:

```
!/wordpress/wp-content/plugins/plugin-folder-name
```

5. Replace the theme in the `/wordpress/wp-content/themes/your-theme` with your theme, and update the rules in the `.gitignore` so the theme is in your repo but the theme vendor folder is not
6. Run `docker compose up` in the root of the project, first time will require a build of the containers so it will take a bit longer
7. (Optional) If you need to load in a DB, after the containers are both running you can conntect to localhost:3306 with the credentials in the `/config/local/.env`

## Running

1. Start docker on your local machine
2. Run `docker compose up` in the root of the project
3. Wordpress should be up and running on `localhost:80`

## Closing

1. Hit `ctrl/cmnd + c` on the running containers to kill them
2. To clean them up run `docker compose down`, this will remove the containers
