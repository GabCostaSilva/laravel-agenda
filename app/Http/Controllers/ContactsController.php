<?php


namespace App\Http\Controllers;


use App\Repositories\RepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsController extends Controller
{
    /**
     * @param RepositoryInterface $contactsRepository
     * @return void
     */
    private $contactsRepository;

    public function __construct(RepositoryInterface $repository) {
        $this->contactsRepository = $repository;
    }

    /**
     * @api {post} /contacts Save contact
     * @apiName StoreContact
     * @apiGroup Contact
     *
     * @apiExample {curl} Example usage:
     *    curl -i http://localhost/contacts
     *    body: {
     *       "customer" : {
     *          "first_name": "JOSE",
     *          "last_name": "MARIA",
     *          "email": "jose.maria@gmail.com",
     *          "birth": "1985-10-24",
     *          "address": "HENRI DUNANT",
     *          "post_code": "04709110",
     *          "number": "742",
     *          "city": "SAO PAULO",
     *          "state": "SP",
     *          "neighborhood": "SANTO AMARO",
     *       }
     *    }
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *          {
     *               "type": "success",
     *               "message": "Contato criado com sucesso!",
     *               "data": {
     *                   "customer": {
     *                       "id": 1,
     *                       "uuid": "6dffce4e-3e01-41d0-aab8-81ad488cad34",
     *                       "name": "José Maria",
     *                       "email": "camilo.goncalves@hotmail.com",
     *                       "birth": "2000-12-05 14:56:38",
     *                       "address": "Travessa Meireles",
     *                       "postcode": "56799-429",
     *                       "number": "1",
     *                       "city": "São Paulo",
     *                       "state": "SP",
     *                       "neighborhood": "Vila Madalena",
     *                       "created_at": "2019-12-05 14:56:38",
     *                       "updated_at": "2019-12-05 14:56:39",
     *                       "deleted_at": null
     *                    }
     *                }
     *            }
     *
     */
    public function store(Request $request){
        $data = $request->all();
        try {
            $contact = $this->contactsRepository->create($data);

            $address = [
                'street' => $request['street'],
                'neighborhood' => $request['neighborhood'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country']
            ];

        } catch(\Exception $exception) {
            return response()->json(['code' => 0, 'message' => 'Request not accepted', 'data' => ''],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['code' => 1, 'message' => 'Contato criado com sucesso.', 'data' => $contact]);
    }

    public function index(Request $request){
        try {
//            if($request->getQueryString()) {
//                $field = $request->input();
//                $value = $field[1];
//                $contacts = $this->contactsRepository->findBy($field, $value);
//            }

            $contacts = $this->contactsRepository->all();
        } catch(\Exception $exception) {
            return response()->json(['code' => 0, 'message' => $exception->getMessage(), 'data' => ''],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(['code' => 1, 'message' => '', 'data' => $contacts]);
    }

    public function show(Request $request) {

    }
}
