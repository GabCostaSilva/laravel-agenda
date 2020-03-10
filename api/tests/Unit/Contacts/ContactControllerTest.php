<?php


namespace Tests\Unit\Contacts;


use App\Models\Contact;
use App\Models\Phone;
use Carbon\Carbon;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function shouldCreateContact() {
        $this->withoutMiddleware();
        $contact = factory(Contact::class)->make();

        $phones = factory(Phone::class, 2)->make()->toArray();

        $contact['phones'] = $phones;

        $response = $this->call('POST', '/api/contacts', $contact->toArray());

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
               'uuid', 'first_name', 'last_name', 'birth', 'email'
            ]
        ]);
    }
    /**
     * @test
     */
    public function shouldGetContacts() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class, 3)->create();

        foreach ($contact as $contact) {
            factory(Phone::class, 3)->create(['contact_id' => $contact->id]);
        }

        $response = $this->call('GET', '/api/contacts');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                'contacts',
                'birthdays'
            ]
        ]);
    }

    /**
     * @test
     */
    public function shouldSearchContactByName() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class, 3)->create()->get(0);

        factory(Phone::class)->create();

        $response = $this->call('GET', "/api/contacts/search?q=$contact->last_name");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                ['uuid', 'first_name', 'last_name', 'email']
            ]
        ]);
    }
    /**
     * @test
     */
    public function shouldShowContact() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class, 3)->create()->get(0);

        $response = $this->call('GET', "/api/contacts/$contact->uuid");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                'contact',
                'phones'
            ]
        ]);
    }
    /**
     * @test
     */
    public function shouldNotShowContact() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class)->make();
        $contact['uuid'] = '1';
        $response = $this->call('GET', "/api/contacts/$contact->uuid");

        $response->assertStatus(422);
    }
    /**
     * @test
     */
    public function shouldDeleteContact() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class, 1)->create()->get(0);

        $response = $this->call('DELETE', "/api/contacts/$contact->uuid");

        $response->assertStatus(200);

        $response->assertJson([
            'data' => true
        ]);
    }

    /**
     * @test
     */
    public function shouldUpdateContact() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class)->create();
        $phone = factory(Phone::class)->make()->toArray();

        $response = $this->call('POST', "/api/contacts/$contact->uuid", ['phones' => [$phone]]);
        $response->assertStatus(200);

        $response->assertJson([
            'data' => true
        ]);
    }
}
