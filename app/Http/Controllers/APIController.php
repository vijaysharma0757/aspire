<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Constants\APIConstants;
use Illuminate\Http\Response;

class APIController extends Controller
{

    use APIConstants;


    protected $statusCode = 200;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): ApiController
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respond(array $data, $headers = []): JsonResponse
    {
        return response()->json(array_merge($data, ['status' => $this->getStatusCode()]),
            $this->getStatusCode(), $headers);
    }

    public function respondWithSuccess(string $message, array $errorData = []): JsonResponse
    {
        $return = array(
            $this->message => $message
        );
        if (!empty($errorData)) {
            $return['error']['data'] = $errorData;
        }
        return $this->setStatusCode(200)->respond($return);
    }

    public function respondSuccessWithData(string $message, array $data = []): JsonResponse
    {
        $return = array(
            $this->message => $message
        );
        if (!empty($data)) {
            $return[$this->data] = $data;
        }
        return $this->setStatusCode(201)->respond($return);
    }

    public function respondWithError($message): JsonResponse
    {
        return $this->setStatusCode(400)->respondErrorMessage($message);
    }

    public function respondErrorMessage(string $message, string $code = ''): JsonResponse
    {
        return $this->respond([
            $this->error => array_filter([
                $this->code => $code,
                $this->message => $message
            ]),
        ]);
    }

    public function respondWithValidationError(object $listOfErrors): JsonResponse
    {

        $errorMessagesList = $this->getFormattedErrorList($listOfErrors->toArray());
        return $this->setStatusCode(400)
            ->respond([$this->error => [
                $this->message => trans('alerts.missing.fields.invalid'),
                'details' => $errorMessagesList
            ],]);
    }

    public function respondWithContent(array $data): JsonResponse
    {
        return $this->setStatusCode(200)->respond([
            'data' => $data
        ]);
    }

    public function respondInternalError(string $message = 'Internal Error'): JsonResponse
    {
        return $this->setStatusCode(500)->respondErrorMessage($message);
    }

    public function respondForbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->setStatusCode(403)->respondErrorMessage($message);
    }

    public function respondWithNoContent(): JsonResponse
    {
        return $this->setStatusCode(204)->respond([]);
    }

    public function respondWithTemporaryRedirect($url): JsonResponse
    {
        return $this->setStatusCode(307)->respond(['redirect_url' => $url]);
    }

    private function getFormattedErrorList(array $listOfErrors): array
    {

        $formattedErrorList = [];
        foreach ($listOfErrors as $errorKey => $errorValue) {
            $formattedErrorList[] = [
                "target" => $errorKey,
                "message" => $errorValue[0]
            ];
        }
        return $formattedErrorList;
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUnauthorized(array $messageBag = []): JsonResponse
    {
        return $this->setStatusCode(401)->respondErrorMessage($messageBag['message'], $messageBag['code']);
    }


    /**
     * Respond as data created for given input.
     *
     * @param string|array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondDataCreated($data): JsonResponse
    {
        return $this->setStatusCode(200)->respond($data);
    }

    /**
     * responsd not found.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound(string $message = 'Not Found'): JsonResponse
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondErrorMessage($message);
    }

}
