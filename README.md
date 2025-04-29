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

## Generative AI 

Question: Explore how you could use generative AI tools in the testing of your app. For
example, can you ask such a tool to write a test case for you? This question is open-ended and there
are many possible answers. Please explain in your readme what you did, provide any code, and let
us know how we could reproduce what you did.


We used generative AI tools to help us with the testing of our app. We used ChatGPT to help up generate unit tests for us. On example of our prompt was: Can you please fix this version of a PHPUnit test function for a POST request:

```bash
public function testPost_CreateUser() { $response = $this->client->request('POST', 'COMP333_website/api/register.php', [ 'json' => [ 'username' => 'testuser', 'password' => 'securepassword123', 'confirmPassword' ==> 'securepassword123'] ]); $this->assertEquals(201, $response->getStatusCode()); }
```

ChatGPT provided us with this code: Here’s the corrected version of your PHPUnit test function for a POST request. The syntax error was in the => operator for 'confirmPassword' and the closing brackets needed alignment:

```bash
php
CopyEdit
public function testPost_CreateUser() {
    $response = $this->client->request('POST', 'COMP333_website/api/register.php', [
        'json' => [
            'username' => 'testuser',
            'password' => 'securepassword123',
            'confirmPassword' => 'securepassword123'
        ]
    ]);
    $this->assertEquals(201, $response->getStatusCode());
}
```

If you would like to reproduce what we did, you can put in the same prompt we used, but with the specific test you would like ChatGPT to help you with. 
Generative AI has been great in increasing our productivity with this project. 
It saved us time, allowing us to spend our time being more creative in the design and functionality of BlossomTech. 

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
