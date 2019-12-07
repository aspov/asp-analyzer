<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ApplicationTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $this->get('/');
        #print_r(\DB::getSchemaBuilder()->getColumnListing('domains'));
        $this->assertResponseOk();
    }

    public function testDomainPost()
    {
        $name = ['name' => 'ya'];
        
        #$response = $this->post(route('domains.store'), $name);
        
        $response = $this->call('POST', '/domains', $name);
        

        $this->assertEquals(200, $response->status());
        #$response->assertStatus(302);

        #$this->assertDatabaseHas('domains', [
            #'name' => 'ya'
        #]);
    }
}
