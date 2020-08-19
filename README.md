# Installation

Move into UserRegistry directory and run the  commands below.

```
npm install
composer install
```

# Config

In the .env file that you would have created from .env.example , add the line below to it

```
VUE_APP_MIX_APP_URL="${APP_URL}"
```

This line added above is referenced in both IndexComponent.vue and CreateComponent.vue file located at UserRegistry/resources/assets/js/components

# Vue templates updates

Sometimes the defined config VUE_APP_MIX_APP_URL="${APP_URL} found at the .env file does not get pickedup in both IndexComponent.vue and CreateComponent.vue files, if that happens please update urls defines in those two files manually.

- For IndexComponent.vue

```

            // let url = process.env.VUE_APP_MIX_APP_URL + "/api/users/" + id;
            let url = "http://localhost/api/users/" + id;
```
and

```
            // let uri =
            //     process.env.VUE_APP_MIX_APP_URL +
            //     "/api/users?query=" +
            //     this.userSearch +
            //     "&limit=" +
            //     this.limit +
            //     "&ascending=" +
            //     order +
            //     "&page=" +
            //     this.page +
            //     "&orderBy=" +
            //     this.currentSort;

            let uri =
                "http://localhost/api/users?query=" +
                this.userSearch +
                "&limit=" +
                this.limit +
                "&ascending=" +
                order +
                "&page=" +
                this.page +
                "&orderBy=" +
                this.currentSort;
```

- For CreateComponent.vue

```
            // let url = process.env.VUE_APP_MIX_APP_URL + "/api/users";
            let url = "http://localhost/api/users";
```

# Migrate and seed database

```
php artisan migrate
php artisan db:seed
```

# Building VueJS Templates

```
npm run dev
```

# Rnning unite tests

```
phpunit
```

# Accessing the web interface

```
http://localhost or as an example http://everlytic.test if you have happened to have set your DNS as everlytic.test
```

# API call URL

```
http://localhost/api/users or http://everlytic.test/api/users
```

# Everlytic Developer Test
## Overview
Welcome to the Everlytic developer test. This test contains 2 required tasks. The first task contains the laravel 5.5 framework 
where you are required to implement a simple user listing as described below. The second task is more of an assessment that you need to complete

## Task 1

### Requirements
PHP 7.0 or higher

MySQL Database

Composer

### Setup
1. Setup the .env file with the database credentials and ensure this file is identical to .env.example
2. Create the table to store the user listing and include this structure with seed data in the laravel migration folder 

Note: The laravel documentation for this setup can be found here: https://laravel.com/docs/5.5/configuration

### Brief
Complete the user listing interface as per the design without using a responsive framework like bootstrap. 
For example, the modal can just be implemented using a absolute positioned container. The design files is inside the task1/UserRegistryDesign folder

1. The following features must be completed:
  
    a. List all users currently stored in the database
 
    b. Ability to add new users
  
    c. Ability to delete existing users
    
2. Create the routes for each of the above features
3. Implement a respository design pattern with models when interfacing with the database
4. Ensure the code in the controllers and repositories are tested using phpunit.

## Task 2
Complete the questionaire word document in the task 2 folder

  
  
  


