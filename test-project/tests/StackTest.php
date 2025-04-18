<?php

class StackTest extends PHPUnit\Framework\TestCase
{
   protected $client;
   #`${BASE_URL}/user.php`
   protected function setUp() : void{
      parent::setUp();
      $this->client = new GuzzleHttp\Client(["base_uri" => "http://172.21.69.89/"]);
   }

   public function testPost_NewSong() {
      $response = $this->client->request('GET', 'COMP333_website/api/user.php');
      $this->assertEquals(200, $response->getStatusCode());
   }

   public function tearDown() : void{
      parent::tearDown();
      $this->client = null;
   }
}
?>