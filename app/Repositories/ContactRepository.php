<?php


namespace App\Repositories;


use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->model->distinct()->select(DB::raw('first_name,last_name, contacts.uuid, email'))->distinct()
            ->join('phones', 'phones.contact_id', '=', 'contacts.id')
            ->where('contacts.first_name', 'LIKE', "%$value%")
            ->orWhere('contacts.last_name', 'LIKE', "%$value%")
            ->orWhere('phones.area_code', 'LIKE', "%$value%")
            ->orWhere('phones.number', 'LIKE', "%$value%")
            ->groupBy('contacts.uuid')
            ->orderByRaw(
                "CAST(first_name AS UNSIGNED), first_name, CAST(last_name AS UNSIGNED), last_name")
            ->get();
    }

    public function findByUuid(string $uuid){
        return $this->model->where('uuid', $uuid)->get();
    }

    public function findBirthdays($month) {
        return  $this->model->whereMonth('birth', $month)->get();
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
