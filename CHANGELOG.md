# Change Log

## 1.0.6 (Released: TBC)
* Rewrite of Core/App;
* Removed the JSONresponse method from Core/Controller;
* Added a new response utility to set headers and output JSON;
* Updated Core/Presenter;
* Renamed Presenter/User to Presenter/Profile;
* Updated the flash settings in the config file;

## 1.0.5 (Released: 11/04/2017)
* Added presenters;
* Updated Utility/Redirect to handle 404 errors;
* Updated the login script, moving the email, password and remember from the controller into the model method;
* Updated Utility/Session::get to check if the session key exists;
* Added a basic Error 404 template;

## 1.0.4 (Released: 28/02/2017)
* Added CSRF token checking;
* Added user profiles;
* Updated the project README.md;
* Updated Utility/Token to read from the config file;
* Updated Utility/Validate error system and made it so a unique record can be defined for use in the unique record checking rule;
* Fixed some minor logic bugs;

## 1.0.3 (Released: 20/02/2017)
* Added functionality for the user to set a remember me cookie;
* Automatically login a user if a remember me cookie has been set and they are unauthenticated;
* Renamed the database SQL files, added the order in which they need to be executed to the filename;
* Bug fixes;

## 1.0.2 (Released: 13/02/2017)
* Added a new core model class;
* Removed the dummy text from the config.php file;
* Added a new user model;
* Added login model, view and controller;
* Added register model, view and controller;
* Added the schema for the database;
* Added a new method to validate inputs in Utility/Input;
* Added a new authentication utility to check if the user is logged in or not;
* Fixed some minor logic bugs;

## 1.0.1 (Released: 07/02/2017)
* Added a CHANGELOG.md;
* Added a README.md;
* Added new helper classes;
* Updated Core/App to use the Utility/Input helper instead of using the $_GET super global;

## 1.0 (Released: 05/02/2017)
* Initial commit of the core functionality and demo controller, model and view;
