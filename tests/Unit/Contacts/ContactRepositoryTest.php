<?php


namespace Tests\Unit\Repositories\Contacts;


use App\Models\Phone;
use App\Repositories\ContactRepository;
use App\Models\Contact;
use Carbon\Carbon;
use Tests\TestCase;


class ContactRepositoryTest extends TestCase
{

    /**
     * @var ContactRepository
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new ContactRepository(new Contact());
    }

    /**
     * @test
     */
    public function shouldListAllContacts() {
        factory(Contact::class, 20)->create();

        $contacts = $this->repository->all();

        $this->assertNotEmpty($contacts);
    }/**
     * @test
     */
    public function shouldFindContact() {
        factory(Contact::class, 1)->create();

        $contactFound = $this->repository->findOne(1);

        $this->assertNotNull($contactFound);
    }
    /**
     * @test
     */
    public function shouldUpdateContact() {
        $contact = factory(Contact::class, 1)->create()->get(0);

        $data = ['first_name' => $this->faker->name];

        $contact = $this->repository->update($data, $contact->uuid);

        $contactUpdated = $this->repository->findOne(1);

        $this->assertEquals($contactUpdated->first_name, $data['first_name']);
    }

    /**
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
    public function shouldFindContactsByFirstName() {
        $contact = factory(Contact::class)->create();
        factory(Phone::class)->create();
        $contactFound = $this->repository->find($contact->first_name)->first();

        $this->assertEquals($contact->first_name, $contactFound->first_name);
    }
    /**
     * @test
     */
    public function shouldFindContactsByPhoneNumber() {
        $contact = factory(Contact::class)->create();

        $phone = factory(Phone::class)->create();

        $contactFound = $this->repository->find($phone->number)->first();

        $this->assertEquals($contact->first_name, $contactFound->first_name);
    }
    /**
     * @test
     */
    public function shouldFindContactsByAreaCode() {
        $contact = factory(Contact::class)->create();

        $phone = factory(Phone::class)->create();

        $contactFound = $this->repository->find($phone->area_code)->first();

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

    /**
     * @test
     */
    public function shouldFindMonthBirthdays() {
        factory(Contact::class, 5)->create(['birth' => Carbon::now()->toDateString()]);

        $currentMonth = Carbon::now()->month;

        $birthdays = $this->repository->findBirthdays($currentMonth);

        $this->assertTrue($birthdays->count() > 0);
    }
}
