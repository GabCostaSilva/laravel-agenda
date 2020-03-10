<?php


namespace Tests\Unit\Phones;


use App\Models\Phone;
use Tests\TestCase;

class PhoneControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function shouldDeleteAPhone() {
        $this->withoutMiddleware();

        $phone = factory(Phone::class)->create();

        $response = $this->call('POST', "/api/phones/". $phone->uuid);

        $response->assertStatus(200);

        $response->assertJson(['code' => 0, 'message' => 'Telefone removido com sucesso.', 'data' => true]);
    }
}
