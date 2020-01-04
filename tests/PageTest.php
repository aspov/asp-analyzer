<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PageTest extends TestCase
{
    public function testWelcomePage()
    {
        $this->get(route('page.welcome'));
        $this->assertResponseOk();
    }

    public function testMainPage()
    {
        print_r(\DB::getDatabaseName());
        $this->get(route('page.main'));
        #print_r(\DB::getSchemaBuilder()->getColumnListing('domains'));
        $this->assertResponseOk();
    }
}
