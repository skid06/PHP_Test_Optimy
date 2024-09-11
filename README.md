# PHP test

## 1. Installation

- create an empty database named "phptest" on your MySQL server
- import the dbdump.sql in the "phptest" database
- put your MySQL server credentials in the constructor of DB class
- you can test the demo script in your shell: "php index.php"

## 2. Expectations

This simple application works, but with very old-style monolithic codebase, so do anything you want with it, to make it:

- easier to work with
- more maintainable

# Solutions

## 1. Setup composer.json file to autoload class files.

- Uses autoloader to handle file inclusion rather than manually including files within the constructor. This approach is more scalable and aligns with modern PHP practices.
- Removes file inclusion in the constructor as it should focus on initialization of objects' state.

# Important: Run the command 'composer dump-autoload' to generate the autoloader.

## 2. Creates an Abstract class BaseManger as base class for CommentManager and NewsManager.

- BaseManager defines abstract methods to be implemented by the child classes. It also handles methods for DB operations.
- CommentManager and NewsManager extend AbstractManager to reuse common functionality and implement the abstract methods.
- Removes the previous usage of getInstance method as we will directly instantiate the CommentManager and NewsManager, by having a base class, singleton instance will no longer be needed.
- The previous use of the Singleton pattern (via the getInstance method) has been removed. Instead, CommentManager and NewsManager can now be instantiated directly. This change simplifies the code and aligns with the new design where each manager class operates independently.

## 3. Using constructors and a base class for Comment.php and News.php

- Adds \_\_construct methods for initializing properties to all the classes. This reduces the need for setters if initial values are provided.
- Creates a BaseEntity class that serves as a common base class that contains shared functionality and properties. Both News and Comment classes will then extend this base class, promoting code reuse and simplifying maintenance.
- Makes a BaseEntity class as Abstract class to prevent direct instantiation and by using a base class, we reduce code duplication and centralize common functionality.

## 3. Prevent SQL Injection

- Rewrites the sql statements for add and delete methods on both CommentManager and NewsManager that prevents SQL injection by preparing the sql statements and bind the parameters before executing the sql query.
