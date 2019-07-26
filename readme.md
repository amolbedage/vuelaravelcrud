
//------- Laravel APi  setup---
https://itsolutionstuff.com/post/laravel-57-create-rest-api-with-authentication-using-passport-tutorialexample.html
//---- Vue.js and laravel setup 
https://appdividend.com/2018/11/17/vue-laravel-crud-example-tutorial-from-scratch/

//---------helper--------------------------------------------

 1) create helper file in app floder 
 2) add file in composer.json

  "autoload": {
  "files": [
        "app/helpers.php"
    ],
    "classmap": [
        "database/seeds",
        "database/factories"
    ],
    "psr-4": {
        "App\\": "app/"
    }
},
"autoload-dev": {
    "psr-4": {
        "Tests\\": "tests/"
    }
},

3) composer dump-autoload

4) call function except $this

//-----------------------------------------


https://startbootstrap.com/previews/sb-admin-2/