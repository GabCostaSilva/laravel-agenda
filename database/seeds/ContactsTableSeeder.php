<?php


use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    public function run() {
        factory(Contact::class, 20)->create();
    }
}
