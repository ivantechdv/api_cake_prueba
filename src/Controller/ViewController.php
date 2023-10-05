<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Http\Client;
use Cake\Http\ServerRequest;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class ViewController extends AppController
{
    public function index()
    {
        $this->autoRender = false;
        // Configurar la instancia del cliente HTTP
        $http = new Client();
        $data = [];

        // Configurar las cabeceras para indicar que esperamos una respuesta JSON
        $headers = [
            'Accept' => 'application/json',
        ];

        // Realizar la solicitud GET a la URL deseada
        $response = $http->get('http://localhost/api_cake_prueba/api/personas/', [], [
            'headers' => $headers,
        ]);

        // Verificar si la solicitud fue exitosa
        if ($response->isOk()) {
            // Obtener el cuerpo de la respuesta JSON
            $jsonResponse = (string) $response->getBody();

            // Decodificar la respuesta JSON en un arreglo asociativo
            $data = json_decode($jsonResponse, true);
            // Ahora $data contiene los datos obtenidos como arreglo asociativo
            // Puedes procesar los datos según sea necesario
            echo '<pre>';
            \print_r($data);
            exit;
        } else {
            // La solicitud no fue exitosa, manejar el error aquí
        }

        // Renderizar una vista o responder con JSON, según tus necesidades
        // ...

    }
    public function add()
    {
        if ($this->request->is('post')) {
            // Obtener los datos enviados desde la vista
            $data = $this->request->getData();

            // Configurar el cliente HTTP
            $http = new Client();

            // Configurar las cabeceras para indicar que estamos enviando JSON
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];

            // Convertir los datos a formato JSON
            $jsonData = json_encode($data);

            // Realizar una solicitud POST a la URL deseada
            $response = $http->post('http://localhost/api_cake_prueba/api/personas/', $jsonData, [
                'headers' => $headers,
            ]);

            // Verificar si la solicitud fue exitosa
            if ($response->isOk()) {
                // Obtener la respuesta JSON del servidor
                $jsonResponse = (string) $response->getBody();

                // Decodificar la respuesta JSON en un arreglo asociativo
                $result = json_decode($jsonResponse, true);

                // Ahora $result contiene la respuesta del servidor, que puede incluir un mensaje de éxito o error

                $this->response = $this->response->withStringBody($jsonResponse);
                // Retornar la respuesta
                return $this->response;
            } else {
                // La solicitud no fue exitosa, manejar el error aquí
                $errorResponse = ['message' => 'Hubo un error al enviar los datos.'];
                return json_decode($errorResponse);
            }
        }
    }
    public function edit($id = null)
    {
        //$this->autoRender = false;
        // Configurar el cliente HTTP
        $http = new Client();

        // Configurar las cabeceras para indicar que estamos enviando JSON
        $headers = [
            'Accept' => 'application/json',
        ];

        // Realizar una solicitud POST a la URL deseada
        $response = $response = $http->get('http://localhost/api_cake_prueba/api/personas/' . $id, [], [
            'headers' => $headers,
        ]);

        // echo '<pre>';
        // print_r($response);
        // exit;

        // Verificar si la solicitud fue exitosa
        if ($response->isOk()) {
            // Obtener la respuesta JSON del servidor
            $jsonResponse = (string) $response->getBody();

            // Decodificar la respuesta JSON en un arreglo asociativo
            $result = json_decode($jsonResponse, true);

            // Ahora $result contiene la respuesta del servidor, que puede incluir un mensaje de éxito o error

            $this->response = $this->response->withStringBody($jsonResponse);
            // Retornar la respuesta

            $this->set(compact('result'));
        } else {
            // La solicitud no fue exitosa, manejar el error aquí
            $errorResponse = ['message' => 'Hubo un error al enviar los datos.'];

            return $errorResponse;
        }
    }

    public function update($id = null)
    {
        $this->autoRender = false;
        if ($this->request->is('put')) { // Cambia 'put' según el método HTTP necesario (PUT, PATCH, etc.)
            // Obtener los datos enviados desde la vista
            $data = $this->request->getData();


            // Configurar el cliente HTTP
            $http = new Client();

            // Configurar las cabeceras para indicar que estamos enviando JSON
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];

            // Convertir los datos a formato JSON
            $jsonData = json_encode($data);

            // Obtener el ID del recurso que deseas actualizar (cambia 'id' por el nombre correcto)
            $resourceId = $id; // Asegúrate de ajustar esto según cómo se envíe el ID

            // Realizar una solicitud PUT a la URL deseada con el ID del recurso
            $response = $http->put('http://localhost/api_cake_prueba/api/personas/' . $resourceId, $jsonData, [
                'headers' => $headers,
            ]);


            // Verificar si la solicitud fue exitosa
            if ($response->isOk()) {
                // Obtener la respuesta JSON del servidor
                $jsonResponse = (string) $response->getBody();

                // Decodificar la respuesta JSON en un arreglo asociativo
                $result = json_decode($jsonResponse, true);

                // Ahora $result contiene la respuesta del servidor, que puede incluir un mensaje de éxito o error

                $this->response = $this->response->withStringBody($jsonResponse);
                // Retornar la respuesta
                return $this->response;
            } else {
                // La solicitud no fue exitosa, manejar el error aquí
                $errorResponse = ['message' => 'Hubo un error al enviar los datos.'];
                return json_decode($errorResponse);
            }
        }
    }
}
