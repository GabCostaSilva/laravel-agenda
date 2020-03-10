<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use App\Repositories\PhoneRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class AbstractController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* @var ContactRepository $contactsRepository */
    protected $contactsRepository;

    /* @var PhoneRepository $phonesRepository */
    protected $phonesRepository;

    public function __construct(ContactRepository $contactsRepository, PhoneRepository $phonesRepository)
    {
        $this->contactsRepository = $contactsRepository;
        $this->phonesRepository = $phonesRepository;
    }
}
