<?php


namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($value);

    public function findOne($id);

    public function findByUuid(string $uuid);

    public function update(array $data, $uuid);

    public function delete(string $uuid);
}
