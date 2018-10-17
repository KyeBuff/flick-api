# Flick Laravel API  
<p style="color: red"><strong>STILL IN DEVELOPMENT</strong></p>

The idea behind Flick is that users can tell us which apps they currently use to watch movies and TV series and we return a random collection of titles available on those apps and within the boundaries of their preferences. 

The Flick API is reponsible for handling POST requests that have been sent by my streaming platform web scrapers and then serving that data to the Flick app. Each POST request represents a film or TV series available on that platform.

Users can click the 'Flick' button on the front end, which requests a random collection of media titles from the API. 

I'm using Laravel because Eloquent is a top of the range ORM, which is going to be heavily utilised when dealing with this [challenge](#challenges). It's also a framework that I feel comfortable with having studied it on the Coding Fellowship.

## Table of Contents
1. [Challenges and Nice Features](#challenges-and-nice-Features)
2. [What have I learned so far?](#what-have-i-learned-so-far?)
3. [Setup](#setup)
2. [Documentation](#documentation)

## Challenges and Nice Features

### Ensuring that titles available on multiple platforms are handled correctly

For example, Saving Private Ryan could be available on both Amazon Prime and Rakuten.

This functionality isn't currently built into the API but here is my thought process:

* The title and year of release are going to be my most reliable data points 
* Each web scraper should post to an individual endpoint for each streaming platform and each platform should have it's own set of tables. This will allow me to leverage Laravel's Eloquent ORM rather than using regular php conditional logic in the controllers to check if a title already exists
* I will setup a cron task to wipe the DB and run scrapers periodically, in this situation PUT requests aren't going to be easy enough to work with
* I should define an acceptable tolerance for determining if a title is available on more than 1 platform, e.g. if the year is correct and the title is a near match then merge the matching titles into a combined media table
* The API should report any instances where acceptable tolerance were almost met
* I need to build a simple UI for accepting/rejecting these cases, recording manual acceptance in a table so that the API can handle these cases independently next time

### Make the service accessible to authenticated and unauthenticated users

We want to ensure that users can download the app and get started without any barriers. Any user should be able to tell us the apps they use and other preferences such as genres they want to watch or whether they just want to watch films or TV series regardless of authentication.

I have created filterMedia and filterBy methods of the Media model which can handle the preferences of both authenticated and unauthenticated users. These methods take the user's preferences and then query the media_genre and media_app pivot tables so that it only returns titles that fall inline with the user's choices.

### API deployment to AWS

This is the first time THAT I have deployed an API before and I'd heard good things about AWS and Elastic Beanstalk. I followed <a href="https://www.youtube.com/watch?v=ISVaMijczKc" target="_blank">this</a> tutorial on YouTube which helped me better understand the deployment process. I have since setup the ability to SSH into my EC2 instance and have ran artisan commands on the server.

Next I'll be looking at how I can use AWS CLI tools so I can move away from the UI, especially as the UX is pretty bad.

## What have I learned so far?

* How to build token authentication into an API using Laravel Passport
* How to filter data by querying multple pivot tables, creating a reusable queryData function in the process
* How to randomise data sets with Eloquent and Laravel collections
* How to paginate data in laravel
* How the API will handle multiple streaming platforms conceptually
* How to deploy a Laravel API to AWS

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

The API is currently deployed <a href="http://flickapi2-env.sdqwkshunp.us-east-2.elasticbeanstalk.com/">here</a>.

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