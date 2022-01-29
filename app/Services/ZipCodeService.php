<?php

namespace App\Services;

use App\Http\Resources\City as CityResource;
use App\Http\Resources\CityCollection as CityResourceCollection;
use App\Models\City;
use Symfony\Component\HttpKernel\Exception\HttpException;


class ZipCodeService
{

    public function findZipCode(string $cep)
    {
        $address = $this->request($cep);

        $city = City::where('code', '=', $address['ibge'])
            ->first();

        return [
            'city' => new CityResource($city),
            'address' => $address,
        ];

        return $address;
    }

    /**
     * @param string $cep
     * @throws HttpException
     * @return object
     */
    private function request(string $cep)
    {
        $cep = str_replace(".", "", $cep);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://viacep.com.br/ws/' . $cep . '/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['erro']) && $data['erro'] === true || $data === null) {
            return 'Erro de API de terceiros, verifique os parâmetros e tente novamente';
        } else {
            return $data;
        }
    }
}
