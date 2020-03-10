<?php


use App\Models\Contact;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    public function run() {
        $contacts = factory(Contact::class, 20)->create();
        foreach ($contacts as $contact) {
            factory(Phone::class, 2)->create(['contact_id' => $contact->id]);
        }
    }
}
