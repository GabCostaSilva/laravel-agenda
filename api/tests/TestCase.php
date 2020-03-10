<?php

namespace Tests;

use Faker\Factory;
use Faker\Provider\Person;
use Faker\Provider\PhoneNumber;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;

    public $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();

        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new PhoneNumber($this->faker));

    }
}
