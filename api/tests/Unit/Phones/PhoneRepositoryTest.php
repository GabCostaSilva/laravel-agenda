<?php


namespace Tests\Unit;


use App\Models\Phone;
use App\Repositories\PhoneRepository;
use Tests\TestCase;

class PhoneRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new PhoneRepository(new Phone());
    }

    /**
     * @test
     */
    public function shouldCreatePhone() {
        $data = factory(Phone::class)->make()->toArray();

        $createdPhone = $this->repository->create($data);

        $this->assertNotNull($createdPhone);
    }

    /**
     * @test
     */
    public function shouldUpdatePhone() {
        $phone = factory(Phone::class, 1)->create()->get(0);

        $data = ['number' => $this->faker->phonenumber];

        $this->repository->update($data, $phone->id);

        $phoneUpdated = $this->repository->findOne(1);

        $this->assertEquals($phoneUpdated->number, $data['number']);
    }
    /**
     * @test
     */
    public function shouldUpdateOrCreatePhone() {
        $phone = factory(Phone::class)->make()->toArray();

        $this->repository->updateOrCreate($phone);

        $phoneUpdated = $this->repository->findOne(1);

        $this->assertArrayHasKey('id', $phoneUpdated);
    }
    /**
     * @test
     */
    public function shouldFindPhone() {
        $phone = factory(Phone::class, 1)->create()->get(0);

        $phoneFound = $this->repository->findOne($phone->id);

        $this->assertNotNull($phoneFound);
    }

    /**
     * @test
     */
    public function shouldFindPhoneByField() {
        $phone = factory(Phone::class, 1)->create()->get(0);

        $phoneFound = $this->repository->findBy('uuid', $phone->uuid)->first();

        $this->assertEquals($phone->number, $phoneFound->number);
    }

    /**
     * @test
     */
    public function shouldDeletePhone() {
        $phone = factory(Phone::class, 1)->create()->get(0);

        $this->repository->delete($phone->id);

        $deletedPhone = $this->repository->findOne($phone->id);

        $this->assertNull($deletedPhone);

    }
}
