<?php

namespace Tests;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        #$database = $this->app->make('db');
        #$connection = $database->connection($name);
        #\DB::setDatabaseName(__DIR__ . '/database/testDatabase.sqlite');
        #\DB::makeConnection(__DIR__ . '/database/testDatabase.sqlite');
        #\config(['DB_DATABASE' => 'database/testDatabase.sqlite']);
        
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
