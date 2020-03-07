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

        $contactFound = $this->repository->find(1);

        $this->assertNotNull($contactFound);
    }
    /**
     * @test
     */
    public function updateAContact() {
        factory(Contact::class, 1)->create();

        $data = ['first_name' => 'Louis'];

        $this->repository->update($data,1);

        $contactUpdated = $this->repository->find(1);

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
        $contactFound = $this->repository->findBy('first_name', $contact->first_name)->get()->first();

        $this->assertEquals($contact->first_name, $contactFound->first_name);

    }

}
