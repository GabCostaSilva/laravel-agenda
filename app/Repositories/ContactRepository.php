<?php


namespace App\Repositories;


use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class ContactRepository implements RepositoryInterface
{
    private $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $contact = $this->model->find($id);

        $contact->update($data);

        return $contact->save();
    }

    public function findOne($id)
    {
       return $this->model->find($id);
    }

    public function delete($id)
    {
        $contact = $this->model->find($id);

        return $contact->delete();
    }

    public function find($value) {
        return $this->model
            ->where('first_name', 'LIKE', "%$value%")
            ->orWhere('last_name', 'LIKE', "%$value%")->get();
    }

    public function findByUuid(string $uuid){
        return $this->model->where('uuid', '=', $uuid)->get();
    }


    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
