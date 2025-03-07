# Blossom Tech

Our website was created to address the significant lack of diversity in tech. We believe that coding should be accessible to everyone, regardless of age, gender, background, or interests. Our mission is to empower individuals from all demographics to learn how to code, providing tailored lesson plans that align with each person's unique passions and goals. By embracing diversity, we aim to break down barriers and inspire a new generation of tech creators who reflect the world we live in.


## Code Structure

Index.php is our home page. The one html file is a sample lesson which is embeded in our homepage. The rest of the .php files are various functional files that allow users to register/login/ make or update or delete or view suggestions. 

## Running the Website Locally

To run locally make sure you have XAMPP installed. Clone the git repo inside your htdocs file in XAMMP. Then configure mySQL in PHP Admin 
to add the tables given with the commands below. Now you should be all set to navigate to http://localhost/COMP333_website/index.php? and the homepage for our website should be visible. 

## Running the website on InfinityFree

You can simply follow the link given at the end of this file to see our website deployed through infinity free. Note the mySQL connection is not configured to work properly so you will not be able to log in or make suggestions. However you can still view our home page, and locally our app works perfectly with mySQL and phpAdmin.  

## Creating an Account

One can create an account by clicking on Log in and then clicking the register button on the log in page. The user must provide a username
which is not already taken, and a password which is at least 10 characters long. After completing this form succesfully the user will be
redirected to the login page where they can login using their new credentials. After logging in they will be redirected back to our home page. 

## Making a Suggestion

Users who are already logged in can click the suggestions button in the top left corner of the homepage and they will be directed to 
a page where they can view all the current suggestions, make another, view a suggestion, or update/delete one of their own. 

## Loging out

To log out simply click logout on the home page

## SQL Commands 
Create user table: 

CREATE TABLE users (username VARCHAR(255) PRIMARY KEY, password VARCHAR(255));

![Users](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Users_Table.jpg)


Create learning_preferences table:

CREATE TABLE learning_preferences ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255), coding_concept VARCHAR(255), theme VARCHAR(255), FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE );

![Learning Prefernces](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/Learning_Perferences_Table.jpg)

## PHP Myadmin 

![Conrad's PHP](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/main/Conrad_PHP.jpg)
![Gavi's PHP](https://raw.githubusercontent.com/GavrielaTM3/COMP333_Website/refs/heads/main/PHP_Gavi.png)

## Infinity Deployment 
Conrad's deployment:  http://blossomtech.ct.ws/
Gavi's deployment: http://blossomtech.infinityfreeapp.com/

## Authors 

Conrad Fischl contributed 50 % 
Gavi Meyers contributed 50 %
