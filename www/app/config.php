<?php

return [
    // 
    // Core Config
    // =========================================================================
    "DATABASE_HOST" => "localhost",
    "DATABASE_NAME" => "myApp",
    "DATABASE_USERNAME" => "root",
    "DATABASE_PASSWORD" => "password",
    // 
    // Cookie Config
    // =========================================================================
    "COOKIE_DEFAULT_EXPIRY" => 604800,
    "COOKIE_USER" => "user",
    "" => "",
    // 
    // Session Config
    // =========================================================================
    "SESSION_ERRORS" => "errors",
    "SESSION_FLASH_DANGER" => "danger",
    "SESSION_FLASH_INFO" => "info",
    "SESSION_FLASH_SUCCESS" => "success",
    "SESSION_FLASH_WARNING" => "warning",
    "SESSION_TOKEN" => "token",
    "SESSION_TOKEN_TIME" => "token_time",
    "SESSION_USER" => "user",
    "" => "",
    // 
    // Texts Config
    // =========================================================================
    "TEXTS" => [
        // 
        // Login Model Texts
        // =====================================================================
        "LOGIN_INVALID_PASSWORD" => "The email / password combination you have entered is incorrect",
        "LOGIN_USER_NOT_FOUND" => "The email you have entered has not been found!",
        "" => "",
        // 
        // Register Model Texts
        // =====================================================================
        "REGISTER_USER_CREATED" => "Your account has been successfully created!",
        "" => "",
        // 
        // User Model Texts
        // =====================================================================
        "USER_CREATE_EXCEPTION" => "There was a problem creating this account!",
        "USER_UPDATE_EXCEPTION" => "There was a problem updating this account!",
        "" => "",
        // 
        // Input Utility Texts
        // =====================================================================
        "INPUT_INCORRECT_CSRF_TOKEN" => "Cross-site request forgery verification failed!",
        "" => "",
        // 
        // Validate Utility Texts
        // =====================================================================
        "VALIDATE_FILTER_RULE" => "%ITEM% is not a valid %RULE_VALUE%!",
        "VALIDATE_MISSING_INPUT" => "Unable to validate %ITEM%!",
        "VALIDATE_MISSING_METHOD" => "Unable to validate %ITEM%!",
        "VALIDATE_MATCHES_RULE" => "%RULE_VALUE% must match %ITEM%.",
        "VALIDATE_MAX_CHARACTERS_RULE" => "%ITEM% can only be a maximum of %RULE_VALUE% characters.",
        "VALIDATE_MIN_CHARACTERS_RULE" => "%ITEM% must be a minimum of %RULE_VALUE% characters.",
        "VALIDATE_REQUIRED_RULE" => "%ITEM% is required!",
        "VALIDATE_UNIQUE_RULE" => "%ITEM% already exists.",
        "" => "",
        // 
        // Texts
        // =====================================================================
        "" => "",
    ],
    // 
    // Config
    // =========================================================================
    "" => "",
];
