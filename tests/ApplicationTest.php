<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

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
        $name = ['name' => 'ya'];
        $response = $this->post(route('domains.store'), $name);
        $response->seeInDatabase('domains', $name);
    }

    public function testDomainShow()
    {
        \DB::table('domains')->insert([
            'name' => 'name',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]);
        #$response = $this->get(route('domains.show'), ['id' => 1]);
        $response = $this->call('GET', route('domains.show', ['id' => 1]));
        $this->assertResponseOk();
    }
}
