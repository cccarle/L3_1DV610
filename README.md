# 1DV610

Assigment L3. Requirements and Code Quality <br>
A course for better understanding of code quality

### Features

  - Authenticate module - login - register 


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

### Additional Requirements
If the user is logged in a small game based on guessing a secret number will be available.
#### Use Cases

#### Use case 1 - Start a new game
1. If user is logged in the user will be shown a description of the game & a "start game" button.
2. User click on "start game" button & the system generate a secret number between 1-20.
3. An input field and a "make a guess" button shall be shown.

#### Alternate scenarios
3.1 The user is not logged in and will not be shown the "start game" button.

#### Use case 2 - User makes a guess
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a number between 1-20 & click on "make a guess" button.
4. System compare users guess with the secret number.

#### Alternate scenarios
2.1 User click on "make a guess" button without enter any value to the input-field.
2.2 System provide a message to the user "no number was entered".

#### Use case 3 - User enters invalid characters
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a character that is not a numeric value & click on "make a guess" button.
4. System provide a message to the user "Only numbers allowed".

#### Use case 4 - User enters a to high number
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a number higher than 20 & click on "make a guess" button.
4. System provide a message to the user "The number is higher then 20, only numbers between 1-20 is allowed".

#### Use case 5 - User enters a to low number
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a number lower than 1 & click on "make a guess" button.
4. System provide a message to the user "The number is lower then 1, only numbers between 1-20 is allowed".

#### Use case 6 - User guesses the secret number
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a valid number between 1-20 & click on "make a guess" button.
4. System compare the guessed number to the secret number.
5. The user has guessed the right number & the system provide a message to the user "You guessed right on "x-amount" of tries".

#### Use case 7 - User want to play again
1. User has guessed the correct secret number
2. System has provided a message with amount of tries it took to guess the secret number.
3. The "make a guess" button is replaced with a "Play again" button.
4. User click on the "Play again" button and is redirected back to "description of the game"/ use case 1 - start a new game, page.

#### Use case 8 - User want to save their attemps of trys in a high score
1. TODO

### Status
The application fulfills use case 1-7, 

### Todos
* Implement Use case 8 - User want to save their attemps of trys in a highscore
* Implement expetions
