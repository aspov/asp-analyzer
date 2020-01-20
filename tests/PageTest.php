<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PageTest extends TestCase
{
    public function testMainPage()
    {
        print_r(\DB::getDatabaseName());
        $this->get(route('page.main'));
        $this->assertResponseOk();
    }
}
