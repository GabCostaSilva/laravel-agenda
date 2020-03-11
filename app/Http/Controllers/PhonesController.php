<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PhonesController extends AbstractController
{
      /**
       * @api {delete} /phones Delete phones
       * @apiName DeletePhones
       * @apiGroup Phone
       *
       * @apiExample {curl} Example usage:
       *    curl -i http://localhost/phones
       *    body: {
       *            {
                        "uuid": "684701bc-3c9c-48e6-b854-b67137d22b26"
       *            },
       *            {
                        "uuid": "37c4abc5-1df8-4c0d-9844-4132765b9a8e"
       *            }
       *    }
       *
       **/
    public function destroy($uuid)
    {
        try {
            $foundPhone = $this->phonesRepository->findBy('uuid', $uuid)->first();

            if(!$foundPhone) {
                throw  new UnprocessableEntityHttpException();
            }

            $data = $this->phonesRepository->delete($foundPhone->id);
        } catch (\Exception $exception) {

            return response()->json(['code' => 1, 'message' => $exception->getMessage(), 'data' => false],
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['code' => 0, 'message' => 'Telefone removido com sucesso.', 'data' => $data]);
    }
}
