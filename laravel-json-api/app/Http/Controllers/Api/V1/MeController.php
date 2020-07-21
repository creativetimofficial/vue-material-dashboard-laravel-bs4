<?php

namespace App\Http\Controllers\Api\V1;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use CloudCreativity\LaravelJsonApi\Document\Error;
use CloudCreativity\LaravelJsonApi\Http\Controllers\JsonApiController;

class MeController extends JsonApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function readProfile(Request $request)
    {
        $http = new Client(['verify' => false]);

        $headers = $this->parseHeaders($request->header());

        $headers = [
            'Accept' => 'application/vnd.api+json',
            'Authorization' => $headers['authorization']
        ];

        $input = $request->json()->all();
        $input['data']['id'] = (string)auth()->id();
        $input['data']['type'] = 'users';

        $data = [
            'headers' => $headers,
            'query' => $request->query()
        ];

        try {
            $response = $http->get(route('api:v1:users.read', ['record' => auth()->id()]), $data);

            $responseBody = json_decode((string)$response->getBody(), true);
            $responseStatus = $response->getStatusCode();
            $responseHeaders = $this->parseHeaders($response->getHeaders());

            unset($responseHeaders['Transfer-Encoding']);

            return response()->json($responseBody, $responseStatus)->withHeaders($responseHeaders);
        } catch (ClientException $e) {
            $errors = json_decode($e->getResponse()->getBody()->getContents(), true)['errors'];
            $errors = collect($errors)->map(function ($error) { return Error::create($error); })->toArray();

            return $this->reply()->errors($errors);
        }
    }

    /**
     * Update the specified resource.
     * Not named update because it conflicts with JsonApiController update method signature
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        $http = new Client(['verify' => false]);

        $headers = $this->parseHeaders($request->header());

        $input = $request->json()->all();

        $input['data']['id'] = (string)auth()->id();
        $input['data']['type'] = 'users';

        $data = [
            'headers' => $headers,
            'json' => $input,
            'query' => $request->query()
        ];

        try {
            $response = $http->patch(route('api:v1:users.update', ['record' => auth()->id()]), $data);
        } catch (ClientException $e) {

            $errors = json_decode($e->getResponse()->getBody()->getContents(), true)['errors'];

            $errors = collect($errors)->map(function ($error) {
                return Error::create($error);
            })->toArray();

            return $this->reply()->errors($errors);
        }

        $responseBody = json_decode((string)$response->getBody(), true);
        $responseStatus = $response->getStatusCode();
        $responseHeaders = $this->parseHeaders($response->getHeaders());

        unset($responseHeaders['Transfer-Encoding']);

        return response()->json($responseBody, $responseStatus)->withHeaders($responseHeaders);
    }

    /**
     * Parse headers to collapse internal arrays
     * TODO: move to helpers
     *
     * @param array $headers
     * @return array
     */
    protected function parseHeaders($headers)
    {
        return collect($headers)->map(function ($item) {
            return $item[0];
        })->toArray();
    }
}
