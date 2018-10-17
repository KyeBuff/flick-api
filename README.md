# Flick Laravel API  
**STILL IN DEVELOPMENT**

The idea behind Flick is that users can tell us which apps they currently use to watch movies and TV series and we return a random collection of titles available on those apps and within the boundaries of their user preferences. 

The Flick API is reponsible for handling POST requests that have been sent by the streaming platform web scrapers and also serving that data to the Flick app. Each POST request represents a film or TV series available on that platform.

Users can click the 'Flick' button on the front end, which requests a random collection of media titles from the API. 

## Table of Contents
1. [Challenges](#challenges)
1. [Setup](#setup)
2. [Documentation](#documentation)

## Challenges and Interesting Features

### Ensuring that titles available on multiple platforms are handled correctly

For example, Saving Private Ryan could be available on Amazon Prime, Rakuten etc.

This functionality isn't currently built into the API but here is my thought process:

* The title and year of release are going to be my most reliable data points 
* Each web scraper should post to an individual endpoint for each streaming platform and each platform should have it's own set of tables. This will allow me to leverage Laravel's Eloquent ORM rather than using regular php conditional logic in the controllers to check if a title already exists
* PUT requests would be extremely difficult to handle, so setup a cron task to wipe the DB and run scrapers periodically
* Define an acceptable tolerance, e.g. if the year is correct and the title is a near match then merge the data
* API should report any instances where attempts to a merge a title were made but criteria wasn't satisfied
* Build simple UI for accepting/rejecting unsatisfied merges. Keep a record of manual acceptance in a table so that the API can handle this independently next time

### Make the service accessible to authenticated and unauthenticated users

We want to ensure that users can download the app and get started without any barriers. Any user should be able to tell us the apps they use and other preferences such as genres they want to watch or whether they just want to watch films or TV series.

Auth users have their preferences persisted, and other users send their preferences as a query string to the relevant endpoint. 

### Random



## Setup
```
git clone git@github.com:KyeBuff/flick-api.git`
```

In the flick-api directory run:

The below command requires composer to be installed.
```
composer require laravel/homestead --dev
```
```
vendor/bin/homestead make
```

Consider editing the IP address and mapped domain in the Homstead.yaml file to avoid clashes with other environments.

```
vagrant up
```

```
vagrant ssh
```

```
cd code
```

```
composer install
```

Copy the .env.example file and save it as .env.

```
artisan migrate
```

```
artisan key:generate
```

```
php artisan make:auth 
```

```
artisan migrate:fresh
```

```
artisan passport:install --force
```

```
artisan migrate:fresh
```

## Documentation

### Auth

#### Without token

##### Register - POST

```
http://{baseURL}/api/auth/login
```

```
{
   "name": "",
   "email": "",
   "password": "",
   "password_confirmation": ""
}
```

```
{
   "email": "",
   "password": "",
   "remember_me": false
}
```

##### Login - POST


```
http://{baseURL}/api/auth/login
```

```
{
   "email": "",
   "password": "",
   "remember_me": false
}
```

#### With token

The following routes should have the Authorization header set with the Bearer token.

##### Logout - GET

```
http://{baseURL}/api/auth/logout
```

##### Get user - GET

```
http://{baseURL}/api/auth/user
```

##### Set user's apps - POST

```
http://{baseURL}/api/auth/user/apps
```

```
{
	"apps": ["Netflix", "BBC"]
}
```

##### Get user's apps - GET

```
http://{baseURL}/api/auth/user/apps
```

##### Get media - GET

```
http://{baseURL}/api/auth/user/media
```

##### Get films - GET

```
http://{baseURL}/api/auth/user/films
```

##### Get series - GET 

```
http://{baseURL}/api/auth/user/series
```

### Media

Media fetching for unauthenticated users.

##### Get media - GET

```
http://{baseURL}/api/media
```

##### Get films - GET

```
http://{baseURL}/api/films
```

##### Get series - GET 

```
http://{baseURL}/api/series
```

##### Get a single media - GET 

```
http://{baseURL}/api/media/{id}
```

##### Get a single media's apps - GET 

```
http://{baseURL}/api/media/{id}/apps
```

##### Get a single media's genres - GET 

```
http://{baseURL}/api/media/{id}/genres
```

##### Store a single media - POST

```
http://{baseURL}/api/media/
```

#### Apps

##### Get all apps - GET 

```
http://{baseURL}/api/apps
```

#### Genres

##### Get all genres - GET 

```
http://{baseURL}/api/genres
```