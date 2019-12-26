<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestClient;

class ApplicationTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        print_r(\DB::getDatabaseName());
        $this->get('/');
        #print_r(\DB::getSchemaBuilder()->getColumnListing('domains'));
        $this->assertResponseOk();
    }

    public function testDomainPost()
    {
        $domain = [
            'name' => 'google.com',
            'status_code' => "200",
            'content_length' => "999",
            'keywords' => "test_keyword",
            'description' => "test_description",
            'heading' => "test_h1"
        ];
        
        #$testClient = new TestClient($domain);
        #$this->app->bind('GuzzleHttp\ClientInterface', function () use ($testClient) {
            #return $testClient;
        #});

        $response = $this->post(route('domains.store'), $domain);
        $response->seeInDatabase('domains', $domain);
        $this->assertResponseStatus(302);
    }

    public function testDomainShow()
    {
        \DB::table('domains')->insert([
            'name' => 'testNameShow'
            ]);
        $response = $this->call('GET', route('domains.show', ['id' => 1]));
        $this->assertResponseOk();
        $this->assertStringContainsString('testNameShow', $response->content());
    }

    public function testDomainsIndex()
    {
        $domain = \DB::table('domains')->insert([
            'name' => 'testNameIndex'
            ]);
        $response = $this->call('GET', route('domains.index', ['id' => 1]));
        $this->assertResponseOk();
        $this->assertStringContainsString('testNameIndex', $response->content());
    }
}
