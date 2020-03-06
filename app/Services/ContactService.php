<?php


namespace App\Services;


use App\Models\Person;
use App\Repositories\ContactRepository;

class ContactService
{
    /**
     * @var ContactRepository $repository
     */
    private $repository;

    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $attributes): Person {

        return $this->repository->create($attributes);
    }

    public function getAll() {
        return $this->repository->all();
    }
}
