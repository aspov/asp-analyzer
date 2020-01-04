<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestClient;

class DomainControllerTest extends TestCase
{
    use DatabaseTransactions;
  
    public function testIndex()
    {
        $faker = \Faker\Factory::create();
        $domainName = $faker->domainName;
        \DB::table('domains')->insert(['name' => $domainName]);
        $response = $this->get(route('domains.index', ['id' => 1]));
        $response->seeInDatabase('domains', ['name' => $domainName]);
        $this->assertResponseOk();
    }

    public function testStore()
    {
        $faker = \Faker\Factory::create();
        $domain = [
            'name' => $faker->domainName,
            'body' =>
                "<meta name=\"keywords\" content=\"{$faker->words($nb = 3, $asText = true)}\">" .
                "<meta name=\"description\" content=\"{$faker->text($maxNbChars = 200)}\">" .
                "<h1>{$faker->paragraph()}</h1>"
        ];
        
        $testClient = new TestClient($domain);
        $this->app->bind('GuzzleHttp\ClientInterface', function () use ($testClient) {
            return $testClient;
        });
        
        $response = $this->post(route('domains.store'), $domain);
        $response->seeInDatabase('domains', $domain);
        $this->assertResponseStatus(302);
    }

    public function testShow()
    {
        $faker = \Faker\Factory::create();
        $domainName = $faker->domainName;
        \DB::table('domains')->insert(['name' => $domainName]);
        $response = $this->get(route('domains.show', ['id' => 1]));
        $response->seeInDatabase('domains', ['name' => $domainName]);
        $this->assertResponseOk();
    }
}
