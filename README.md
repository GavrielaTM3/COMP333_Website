# Blossom Tech

Our website was created to address the significant lack of diversity in tech. We believe that coding should be accessible to everyone, regardless of age, gender, background, or interests. Our mission is to empower individuals from all demographics to learn how to code, providing tailored lesson plans that align with each person's unique passions and goals. By embracing diversity, we aim to break down barriers and inspire a new generation of tech creators who reflect the world we live in.

## Setup Instructions

To install our website, and run it locally, make sure you have XAMMP installed. Then navigate to the htdocs directory in XAMMP and execute the following commands

### 1. Clone the Repository (inside htdocs)

```bash
git clone https://github.com/GavrielaTM3/COMP333_Website.git
```
### 2. Create the SQL tables in phpMyAdmin

Launch phpMyAdmin and create a new database named app-db then execute the following two commands to create the nesecerary tables:

Create user table:
```bash
CREATE TABLE users (username VARCHAR(255) PRIMARY KEY, password VARCHAR(255));
```

Create learning_preferences table:
```bash
CREATE TABLE learning_preferences ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), coding_concept VARCHAR(255), theme VARCHAR(255), FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE );
```
Create points table:
```bash
CREATE TABLE points ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), sports1 BOOLEAN, sports2 BOOLEAN, fashion BOOLEAN, points INT, FOREIGN KEY (username) REFERENCES users(username) );
```
There are screenshots in the SQL section which show the desired structure of the tables

## Web Version 

After following the above commands you should be all set to use our website in your local browser! Simply navigate to URL below to see our homepage!

```bash
http://localhost/COMP333_website/index.php
```

## Mobile Version 

To run our webapge on a mobile device make sure you have an emulator running on your computer, we used andriod studio. Then navigate into the blossom-tech directory:

```bash
cd /Applications/XAMPP/htdocs/COMP333_Website/blossom-tech
```
Note that your path could be different based on your computer and where you installed XAMPP

Once you are in this directory you need to edit the config.js file with your IP address for the REST api to function properly
Simply change this line in config.js to the IP address of your computer
```bash
const IP_ADDRESS = '172.0.0.1'; // CHANGE THIS LINE TO YOUR IP ADDRESS
```

Then run: 
```bash
npm run android
```
Note: make sure you have installed npm. 
Then the homepage for our website should popup on the emulator!

## Creating an Account

One can create an account by clicking on "Log in" and then clicking the register button on the log in page. The user must provide a username
which is not already taken, and a password which is at least 10 characters long. After completing this form succesfully the user will be
redirected to the login page where they can login using their new credentials. After logging in they will be redirected back to our home page. 

## Making a Suggestion

Users who are already logged in can click the suggestions button in the top left corner of the homepage and they will be directed to 
a page where they can view all the current suggestions, make another, view a suggestion, or update/delete one of their own. 

## Take a Coding Lesson! 

Click on either the fashion icon or the sports icon to take the correspoding coding lesson. You will be rewarded for 50 points for each problem you solve and passes all the test cases. The amount of points you have earned will be displayed on the top of the homepage. Currently only fashion and sports are implemented but photography and biology are coming soon!

## Loging out

To log out simply click logout on the home page.

## Testing 

We have provided some unit tests in order to make sure that our api functionality was working as intended. In order to run these tests make sure you have PHPunit instealled. Then navigate to ./COMP333_Website/test-project which should be within your htdocs directory and execute the command:

```bash
./vendor/bin/phpunit ./tests/StackTest.php
```
Then you should see the output of the tests and if they passed it should say "OK (4 tests, 6 assertions)" 

## SQL  

![Users](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Users_Table.jpg)

![Learning Prefernces](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Learning_Perferences_Table.jpg)

## PHP Myadmin 
Conrad's PHP: 
![Conrad's PHP](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/main/Conrad_PHP.jpg)
Gavi's PHP:
![Gavi's PHP](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/PHP_Gavi.png)


## Postman

Conrad's API calls: 

Post: 
![Conrad's Post](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Conrad_Post.jpg)
Get:
![Conrad's Get](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Conrad_Get.jpg)

Gavi's API calls: 

Post: 
![Gavi's Post](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Gavi_Post.png)
Get:
![Gavi's Get](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Gavi_Get.png)
## Authors 

Conrad Fischl contributed 50 % 
Gavi Meyers contributed 50 %
