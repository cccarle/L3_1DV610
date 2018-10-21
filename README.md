# 1DV610
# Introduction
Assigment L3. Requirements and Code Quality <br>
A course for better understanding of code quality

1. Installation
2. Additional Requirements
3. Status
4. Use cases
5. Manual tests

### Features

  * login/register module 

### Executable version

* https://ce222qw-1dv610.000webhostapp.com/?


```sh
Login credentials
username: kalle
password : hejhej
```

### Software Architecture
 - MVC
 
### Tech
* [PHP](https://secure.php.net/) - Language.
* [XAMPP](https://www.apachefriends.org/index.html) - To run and test locally.
* [VSCODE](https://code.visualstudio.com/) - Editor.

<hr> 

# 1. Installation

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

###### 3. Add your db credantials to your newly renamed file "config.php" (This will make the gitignore hinder you from uploading your config-file to github.)
```javascript
 private $db_host = 'your host';
 private $db_user = 'your db username';
 private $db_password = 'your db password';
 private $db_name = 'your db name';
    
```

###### 4. Create two tables called users & highScore in your mysql database. Add id as auto increment and primary key in both tables.

```javascript
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
``` 

```javascript
CREATE TABLE `highScore` (
  `name` varchar(10) NOT NULL,
  `score` int(5) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

<hr>

# 2. Additional Requirements
* If the user is logged in a small game based on guessing a secret number will be available.
* User can choose to add their score in a high score
* User can view high score list.

<hr>

# 3. Status
The application fulfills all the additional use cases, but has a bug first time a user want to make a guess and the "addTriesToCounterSession()" is called. It do not effect the application but shows a "Notice" message of the bug. 

#### Todos
* Fix bug "first time session sets counter for tries". SessionModel.php, line 61. 
* Handle the navigations in views in a more "cleaner", get rid of all the "ifs"
* Implement Exceptions.(get rid of all the "ifs" in responseMessage) 
* Break out showHighScoreHTML from gameView. 

#### Reflection
After working with this assignment for a couple of weeks and comparing it to assignment 2 in this course i see so much improvement. The workshops has given so much value about how other people see and read each other's code. It has taught me alot about the MVC architecture and i have tried to follow it as good as i can. 

There are doe some things i would liked to worked more on.
The navigation in the views has a lot of “ifs” especially the “GameView” and it tends to be a bit messy to follow and the “read it like a newspaper” maybe  . 
Another thing is to implement exceptions.

Overall im am happy with the outcome.


<hr>

# 4. Use cases

#### Use case 1 - User want to start a new game
1. If user is logged in the user will be shown a description of the game & a "start game" button.
2. User click on "start game" button & the system generate a secret number between 1-20.
3. An input field and a "make a guess" button shall be shown.

##### Alternate scenarios
3.1 The user is not logged in and will not be shown the "start game" button.
#### Use case 2 - User want to make a guess
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a number between 1-20 & click on "make a guess" button.
4. System compare users guess with the secret number & give feedback on the guessed number.


#### Use Case 3 - User guesses the secret number
1. User has clicked on "start game" button.
2. User is shown a input-field and a "make a guess" button.
3. User enter a valid number between 1-20 & click on "make a guess" button.
4. System compare the guessed number to the secret number.
5. The user has guessed the right number & the system provide a message to the user "You guessed right on "x-amount" of tries".


#### Use case 4 - User want to play again
1. User has guessed the correct secret number.
2. System has provided a message with amount of tries it took to guess the secret number.
3. The "make a guess" button is replaced with a "Play again" button.
4. User click on the "Play again" button and is redirected back to "description of the game"/ use case 1 - start a new game, page.

#### Use case 5 - User want to save their attemps of trys in a high score
1. User has guessed the correct secret number
2. System has provided a message with amount of tries it took to guess the secret number.
3. The system provide two buttons, one "Play again" and one "add to high score" button. 
4. The user click on "add to high score" button and the system will present an highscore with the users result.

<hr>

# 5. Manual tests
### Use case tested : Use case 1 - User want to start a new game
#### Test Case 1.1 - Start a game
__Test steps :__ <br>
1.1 User enter correct user credentails and is logged in. <br>
1.2 User will be shown a description of the game & a “start game” button. <br>
1.3 User click on "start game" button. <br>

__Exptected result :__  input field with a “make a guess” button is shown. <br>
__Actuall result :__ input field with a “make a guess” button is shown. <br>
__Pass/fail :__ Pass <br>



### Use case tested : Use case 2 - User want to make a guess
#### Test Case 2.1 - User make a guess without enter any value
__Test steps :__ <br>
1.1 User is logged in & has started a new game. <br>
2.2 User click on "make a guess" button without enter any value to the input-field. <br>

__Exptected result :__ System provide a message to the user "no number was entered". <br>
__Actuall result :__ System provide a message to the user "no number was entered". <br>
__Pass/fail :__ Pass <br>

#### Test Case 2.2 - User enters invalid characters
__Test steps :__ <br>
1. User is logged in & has started a new game. <br>
2. User enter a character that is not a numeric value & click on "make a guess" button. <br>

__Exptected result :__ System provide a message to the user "Only numbers allowed". <br>
Actuall result : System provide a message to the user "Only numbers allowed". <br>
__Pass/fail :__ Pass <br>

#### Test Case 2.3 - User enters a to high number
__Test steps :__ <br>
1. User is logged in & has started a new game. <br>
2. User enter a number higher than 20 & click on "make a guess" button. <br>

__Exptected result :__ System provide a message to the user "The number is higher then 20, only numbers between 1-20 is allowed". <br>
__Actuall result :__ System provide a message to the user "The number is higher then 20, only numbers between 1-20 is allowed". <br>
__Pass/fail :__ Pass <br>

#### Test Case 2.4 - User enters a to low number
__Test steps__ : <br>
1. User is logged in & has started a new game. <br>
2. User enter a number lower than 1 & click on "make a guess" button. <br>

__Exptected result :__  System provide a message to the user "The number is lower then 1, only numbers between 1-20 is allowed". <br>
__Actuall result :__  System provide a message to the user "The number is lower then 1, only numbers between 1-20 is allowed". <br>
__Pass/fail :__ Pass <br>

### Use case tested : Use case 3 -  User guesses the secret number
#### Test Case 3.1 - User guesses the secret number
__Test steps :__ <br>
1. User is logged in & has started a new game. <br>
2. User click on "make a guess" button. <br>
3. User has guessed the correct secret number. <br>

__Exptected result :__ the system provide a message to the user “You guessed right on “x-amount” of tries”. <br>
__Actuall result :__ the system provide a message to the user “You guessed right on “x-amount” of tries”. <br>
__Pass/fail :__ Pass <br>

### Use case tested : Use case 4 - User want to play again
#### Test Case 4.1 - User has won and want to play again
__Test steps :__ <br>
1.1 User has won and is shown a "play again" button & a "add to high score" button. <br>
2.2 User click on "play again" button. <br>

__Exptected result :__ System redirect to start page and show a description of the game & a “start game” button. <br>
__Actuall result :__ System redirect to start page and show a description of the game & a “start game” button. <br>
__Pass/fail :__ Pass <br>

### Use case tested : Use case 5 - User want to save their attemps of trys in a high score
#### Test Case 5.1 - User want to save their attemps of trys in a high score
__Test steps :__ <br>
1.1 User has won and is shown a "play again" button & a "add to high score" button. <br>
2.2 User click on "add to high score" button. <br>

__Exptected result :__ System redirect to highscore page and the users result is added to the highscore. <br>
__Actuall result :__ System redirect to highscore page and the users result is added to the highscore. <br>
__Pass/fail :__ Pass <br>

