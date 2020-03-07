<?php


namespace Tests\Unit;


use App\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function shouldGetContacts() {
        $this->withoutMiddleware();

        factory(Contact::class, 3)->create();

        $response = $this->call('GET', '/api/contacts');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                ['id', 'first_name', 'last_name', 'birth', 'email']
            ]
        ]);
    }
    /**
     * @test
     */
    public function shouldSearchContactByName() {
        $this->withoutMiddleware();

        $contact = factory(Contact::class, 3)->create()->get(0);

        $response = $this->call('GET', "/api/contacts/search?q=$contact->last_name");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'code',
            'message',
            'data' => [
                ['id', 'first_name', 'last_name', 'birth', 'email']
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
                ['id', 'first_name', 'last_name', 'birth', 'email']
            ]
        ]);
    }
}
