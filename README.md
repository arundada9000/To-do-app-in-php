# To run the code

- Make sure Xampp is installed and run apache and mysql
- Open phpmyadmin by going to a browser and search localhost/phpmyadmin/ in url bar
- copy the code sql below and run in phpmyadmin it will create all the necessary table and columns
- Create a folder in C -> xampp -> htdocs
- In the url bar search for localhost/folder_name/index.php

# sql code for table and columns used in the code

```
CREATE DATABASE todoapp;

USE todoapp;

CREATE TABLE todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
