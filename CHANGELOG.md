# Change Log

## 1.0.3 (Released: TBC)
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