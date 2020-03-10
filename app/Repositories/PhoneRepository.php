<?php


namespace App\Repositories;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Model;

class PhoneRepository
{
    private $model;

    public function __construct(Phone $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $phone = $this->model->find($id);

        $phone->update($data);

        return $phone->save();
    }

    public function updateOrCreate(array $data)
    {
        return $this->getModel()->updateOrCreate($data);
    }

    public function findOne($id) {
        return $this->model->find($id);
    }

    public function findBy(string $field, $value) {
        return $this->model->where($field, $value)->get();
    }

    public function delete(string $id) {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
