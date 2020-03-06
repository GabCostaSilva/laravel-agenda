<?php


namespace Tests\Unit\Repositories;


use App\Repositories\ContactRepository;
use App\Models\Person;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ContactRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var ContactRepository
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new ContactRepository(new Person());
    }

    /**
     * @test
     */
    public function shouldListAllContacts() {
        factory(Person::class, 3)->create();

        $contacts = $this->repository->all();

        $this->assertNotEmpty($contacts);
    }/**
     * @test
     */
    public function shouldFindAContact() {
        factory(Person::class, 1)->create();

        $contactFound = $this->repository->find(1);

        $this->assertNotNull($contactFound);
    }
    /**
     * @test
     */
    public function updateAContact() {
        factory(Person::class, 1)->create();

        $data = ['first_name' => 'Louis'];

        $this->repository->update($data,1);

        $contactUpdated = $this->repository->find(1);

        $this->assertEquals($contactUpdated->first_name, $data['first_name']);
    }/**
     * @test
     */
    public function shouldCreateAContact() {
        $data = factory(Person::class)->make()->toArray();

        $contact = $this->repository->create($data);

        $this->assertNotNull($contact);
    }
}
