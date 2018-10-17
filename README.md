# 1DV610

Assigment L3. Requirements and Code Quality <br>
A course for better understanding of code quality

### Features

  - Authenticate module - login - register 
  - Connection to database

### Software Architecture
 - MVC
 
### Tech
* [PHP](https://secure.php.net/) - Language.
* [XAMPP](https://www.apachefriends.org/index.html) - To run and test locally.
* [VSCODE](https://code.visualstudio.com/) - Editor.


### Installation

###### 1.Clone the repo

```sh
$ git clone https://github.com/cccarle/L3_1DV610.git

```
###### 2. Change a file named "config-default.php" to "config.php"

```sh
Open folder "L3_1DV610"
cd config
Change the file "config-default.php" to "config.php"

```

###### 3. Add your db credantials to your newly renamed file "config.php"
```javascript
 private $db_host = 'your host';
 private $db_user = 'your db username';
 private $db_password = 'your db password';
 private $db_name = 'your db name';
    
```

###### 4. Create a table called users in your mysql database

```javascript
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

### Observations
#### Changes
### Status

### Additional Requirements
If the user is logged in a small game based on guessing a secret number will be available.
#### Use Cases

##### Use case 1 - Start a new game
##### Use case 2 - User enters invalid characters
##### Use case 3 - User enters a to high number
##### Use case 4 - User enters a to low number
##### Use case 5 - User guesses the secret number
##### Use case 6 - User want to play again
##### Use case 7 - User want to go back to the logged in page
##### Use case 8 - User want to save their attemps of trys in a high score


### Todos

 - Write MORE Tests
 - Add Night Mode
