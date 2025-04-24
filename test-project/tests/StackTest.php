<?php

class StackTest extends PHPUnit\Framework\TestCase
{
   protected $client;
   #`${BASE_URL}/user.php`
   protected function setUp() : void{
      parent::setUp();
      $this->client = new GuzzleHttp\Client(["base_uri" => "http://172.21.69.89/"]);
   }

   public function testGet_UserList() {
      $response = $this->client->request('GET', 'COMP333_website/api/user.php');
      $this->assertEquals(200, $response->getStatusCode());
   }
   public function testPost_CreateUser() {
    $response = $this->client->request('POST', 'COMP333_website/api/register.php', [
        'json' => [
            'username' => 'testuser',
            'password' => 'securepassword123',
            'confirmPassword' => 'securepassword123']
    ]);
    $this->assertEquals(201, $response->getStatusCode());
    
    }
    public function testPost_LoginUser() {
        $response = $this->client->request('POST', 'COMP333_website/api/login.php', [
            'json' => [
                'username' => 'Joe',
                'password' => '1231231231']
        ]);
        $this->assertEquals(201, $response->getStatusCode());
    }
    public function testPost_FailedLogin() {
        try {
            $this->client->request('POST', 'COMP333_website/api/login.php', [
                'json' => [
                    'username' => 'nonexistent_user',
                    'password' => 'wrongpassword'
                ]
            ]);
            $this->fail('Expected exception not thrown'); // Fail if no exception
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertEquals(401, $response->getStatusCode());
    
            $body = json_decode($response->getBody(), true);
            $this->assertFalse($body['success']);
            $this->assertEquals('Invalid login credentials', $body['error']);
        }
    }


   public function tearDown() : void{
      parent::tearDown();
      $this->client = null;
   }
}
?>