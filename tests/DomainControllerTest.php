<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestClient;
use App\Domain;

class DomainControllerTest extends TestCase
{
    use DatabaseTransactions;
  
    public function testIndex()
    {
        $domain = factory(Domain::class)->create();
        $response = $this->get(route('domains.index'));
        $this->assertResponseOk();
        $response->seeInDatabase('domains', ['name' => $domain->name]);
    }

    public function testStore()
    {
        $domain = factory(Domain::class)->create();
        $testClient = new TestClient($domain->body);
        $this->app->bind('GuzzleHttp\ClientInterface', function () use ($testClient) {
            return $testClient;
        });
        $response = $this->post(route('domains.store'), ['name' => $domain->name]);
        $response->seeInDatabase('domains', ['body' => $domain->body]);
    }

    public function testShow()
    {
        $domain = factory(Domain::class)->create();
        $response = $this->get(route('domains.show', ['id' => $domain]));
        $this->assertResponseOk();
        $response->seeInDatabase('domains', ['name' => $domain->name]);
    }
}
