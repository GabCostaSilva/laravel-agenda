<?php


namespace Tests\Unit\Repositories;


use App\Repositories\ContactRepository;
use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery\Exception;
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
        $this->repository = new ContactRepository(new Contact());
//        $this->tearDown();
    }

    /**
     * @test
     */
    public function shouldListAllContacts() {
        factory(Contact::class, 3)->create();

        $contacts = $this->repository->all();

        $this->assertNotEmpty($contacts);
    }/**
     * @test
     */
    public function shouldFindAContact() {
        factory(Contact::class, 1)->create();

        $contactFound = $this->repository->findOne(1);

        $this->assertNotNull($contactFound);
    }
    /**
     * @test
     */
    public function updateAContact() {
        $contact = factory(Contact::class, 1)->create()->get(0);

        $data = ['first_name' => 'Louis'];

        $contact = $this->repository->update($data, $contact->uuid);

        $contactUpdated = $this->repository->findOne(1);

        $this->assertEquals($contactUpdated->first_name, $data['first_name']);
    }/**
     * @test
     */
    public function shouldCreateAContact() {
        $data = factory(Contact::class)->make()->toArray();

        $contact = $this->repository->create($data);

        $this->assertNotNull($contact);
    }

    /**
     * @test
     */
    public function shouldFindContactByFirstName() {
        $contact = factory(Contact::class)->create();
        $contactFound = $this->repository->find($contact->first_name)->first();

        $this->assertEquals($contact->first_name, $contactFound->first_name);
    }
    /**
     * @test
     */
    public function shouldFindContactByUuid() {
        $contact = factory(Contact::class)->create();
        $contactFound = $this->repository->findByUuid($contact->uuid)->first();

        $this->assertEquals($contact->first_name, $contactFound->first_name);
    }

    /**
     * @test
     */
    public function shouldDeleteAContact() {
        $contact = factory(Contact::class, 1)->create()->get(0);
        $deleted = $this->repository->delete($contact->uuid);

        $this->assertEquals($deleted, true);
    }
}
