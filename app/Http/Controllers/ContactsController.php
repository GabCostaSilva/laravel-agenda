<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsController extends AbstractController
{
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
     *          "street": "HENRI DUNANT",
     *          "post_code": "04709110",
     *          "number": "742",
     *          "city": "SAO PAULO",
     *          "state": "SP",
     *          "country": "Brazil",
     *          "phones": [
     *              {
     *                  "area_code": "11",
     *                  "number": "984509696",
     *                  "primary": true
     *              },
     *              {
     *                  "area_code": "11"
     *                  "number": "26205383",
     *                  "primary": false
     *              }
     *          ]
     *       }
     *    }
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *          {
     *               "type": "success",
     *               "message": "Contato criado com sucesso!",
     *               "data": {
     *                       "uuid": "6dffce4e-3e01-41d0-aab8-81ad488cad34",
     *                       "name": "José Maria",
     *                       "email": "camilo.goncalves@hotmail.com",
     *                       "birth": "1985-10-24T00:00:00.000000Z",
     *                       "street": "HENRI DUNANT",
     *                       "post_code": "04709110",
     *                       "number": "742",
     *                       "city": "SAO PAULO",
     *                       "state": "SP",
     *                       "country": "Brazil",
     *                       "phones": [
     *                           {
     *                               "area_code": "11",
     *                               "number": "984509696",
     *                               "primary": true
     *                           },
     *                           {
     *                               "area_code": "11"
     *                               "number": "26205383",
     *                               "primary": false
     *                           }
     *                        ]
     *                       "created_at": "2019-12-05 14:56:38",
     *                       "updated_at": "2019-12-05 14:56:39",
     *                       "deleted_at": null
     *                }
     *         }
     *
     */
    public function store(Request $request){
        $data = $request->all();
        try {
            $contact = $this->contactsRepository->create($data);

            foreach ($data['phones'][0] as $phone) {
                $contact->phones()->save($phone);
            }

        } catch(\Exception $exception) {
            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => ''],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'code' => 0,
            'message' => 'Contato criado com sucesso.',
            'data' => $contact
        ]);
    }

    public function index(){
        try {
            $contacts = $this->contactsRepository->all();

        } catch(\Exception $exception) {
            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => ''],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(['code' => 0, 'message' => '', 'data' => $contacts]);
    }

    public function search(Request $request)
    {
        try {
            $input = $request->input('q');
            $results = $this->contactsRepository->find($input);
        }catch (\Exception $exception) {
            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => ''],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(['code' => 0, 'message' => '', 'data' => $results]);
    }

    public function show($uuid)
    {
        try {
            $results = $this->contactsRepository->findByUuid($uuid);
        }catch (\Exception $exception) {
            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => ''],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(['code' => 0, 'message' => '', 'data' => $results]);
    }

    public function destroy($uuid)
    {
        try {
            $removedContact =$this->contactsRepository->delete($uuid);
            if(!$removedContact) {
                return response()->json(['code' => 0, 'message' => 'Contato não encontrado.', 'data' => '']);
            }
        } catch (\Exception $exception) {

            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => ''],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['code' => 0, 'message' => 'Contato removido com sucesso.', 'data' => $removedContact]);
    }

    public function update(Request $request, $uuid)
    {
        try {
            $updatedContact = $this->contactsRepository->update($request->all(), $uuid);
            if(!$updatedContact) {
                return response()->json(['code' => 0, 'message' => 'Contato não encontrado.', 'data' => $updatedContact]);
            }
        } catch(\Exception $exception) {
            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => ''],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json(['code' => 0, 'message' => 'Contato atualizado com successo.', 'data' => $updatedContact]);
    }
}
