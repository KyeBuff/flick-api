# Flick Laravel API

# Setup
```
git clone git@github.com:KyeBuff/flick-api.git`
```

In the flick-api directory run:
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

# API documentation

## Auth

### Without token

#### Register - POST

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

#### Login - POST


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

### With token

The following routes should have the Authorization header set with the Bearer token.

#### Logout - GET

```
http://{baseURL}/api/auth/logout
```

#### Get user - GET

```
http://{baseURL}/api/auth/user
```

#### Set user's apps - POST

```
http://{baseURL}/api/auth/user/apps
```

```
{
	"apps": ["Netflix", "BBC"]
}
```

#### Get user's apps - GET

```
http://{baseURL}/api/auth/user/apps
```

#### Get media - GET

```
http://{baseURL}/api/auth/user/media
```

#### Get films - GET

```
http://{baseURL}/api/auth/user/films
```

#### Get series - GET 

```
http://{baseURL}/api/auth/user/series
```

## Media

Media fetching for unauthenticated users.

#### Get media - GET

```
http://{baseURL}/api/media
```

#### Get films - GET

```
http://{baseURL}/api/films
```

#### Get series - GET 

```
http://{baseURL}/api/series
```

#### Get a single media - GET 

```
http://{baseURL}/api/media/{id}
```

#### Get a single media's apps - GET 

```
http://{baseURL}/api/media/{id}/apps
```

#### Get a single media's genres - GET 

```
http://{baseURL}/api/media/{id}/genres
```

#### Store a single media - POST

```
http://{baseURL}/api/media/
```

### Apps

#### Get all apps - GET 

```
http://{baseURL}/api/apps
```

### Genres

#### Get all genres - GET 

```
http://{baseURL}/api/genres
```