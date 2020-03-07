<?php


namespace App\Repositories;


use App\Models\Contact;
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

    public function find($id)
    {
       return $this->model->find($id);
    }

    public function delete($id)
    {
        $contact = $this->model->find($id);

        return $contact->delete();
    }

    public function findBy(string $field, string $value) {
        return $this->model->where($field, $value);
    }


    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
