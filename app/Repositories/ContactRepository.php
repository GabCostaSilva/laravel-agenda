<?php


namespace App\Repositories;


use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;

class ContactRepository
{
    private $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->orderByRaw(
                "CAST(first_name AS UNSIGNED), first_name, CAST(last_name AS UNSIGNED), last_name"
            )->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $uuid)
    {
        $contact = $this->model->findByUuid($uuid);

        $contact->update($data);

        return $contact->save();
    }

    public function findOne($id)
    {
       return $this->model->find($id);
    }

    public function find($value) {
        return $this->model
            ->where('first_name', 'LIKE', "%$value%")
            ->orWhere('last_name', 'LIKE', "%$value%")->get();
    }

    public function findByUuid(string $uuid){
        return $this->model->where('uuid', $uuid)->get();
    }

    public function delete(string $uuid) {
        return $this->model->where('uuid', $uuid)->delete();
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
