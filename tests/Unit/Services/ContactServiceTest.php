<?php


namespace Tests\Unit\Services;


use App\Models\Person;
use App\Repositories\ContactRepository;
use App\Services\ContactService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ContactServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var ContactService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new ContactService(new ContactRepository(new Person()));
    }

    /**
     * @test
     */
    public function shouldCreateContact() {
        $data = factory(Person::class)->make()->toArray();

        $contact = $this->service->create($data);

        $this->assertEquals($contact->first_name, $data['first_name']);
    }
}
