<?php

namespace App\Controller\Api;

use App\Controller\AppController;

class PersonasController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    public function index()
    {
        // Lógica para obtener una lista de personas y enviarla como respuesta JSON
        $personas = $this->Personas->find()->toArray();
        $this->response = $this->response->withStringBody(json_encode($personas));
        return $this->response;
    }
    public function view($id = null)
    {
        $this->autoRender = false;
        $person = $this->Personas->get($id);

        if ($person) {
            $this->response = $this->response->withStringBody(json_encode($person));
        } else {
            // Si no se encontró la persona, responder con un mensaje de error
            $this->response = $this->response
                ->withStatus(404) // Código de respuesta HTTP 404 para "No encontrado"
                ->withStringBody(json_encode(['error' => 'Persona no encontrada']));
        }

        return $this->response;
    }

    public function add()
    {
        $this->request->allowMethod(['post']); // Solo permitir solicitudes POST

        $data = $this->request->input('json_decode', true);

        $persona = $this->Personas->newEntity($data);

        if ($this->Personas->save($persona)) {
            $statusCode = '200';
            $message = 'La persona ha sido guardada correctamente.';
        } else {
            $statusCode = '401';
            $message = 'No se pudo guardar la persona. Por favor, inténtelo de nuevo.';
        }
        $this->viewBuilder()->setClassName('Json');
        $this->set([
            'statusCode' => $statusCode,
            'message' => $message,
            'persona' => $persona,
        ]);
        $this->viewBuilder()->setOption('serialize', ['message', 'persona']);
    }
    public function edit($id = null)
    {
        $this->request->allowMethod(['put']); // Solo permitir solicitudes PUT

        $data = $this->request->input('json_decode', true);
        $resourceId = $id; // Suponiendo que el ID se pasa en los datos JSON

        // Buscar la entidad existente por ID
        $persona = $this->Personas->get($resourceId);

        // Patchear (actualizar) la entidad con los nuevos datos
        $persona = $this->Personas->patchEntity($persona, $data);

        if ($this->Personas->save($persona)) {
            $statusCode = '200';
            $message = 'La persona ha sido actualizada correctamente.';
        } else {
            $statusCode = '401';
            $message = 'No se pudo actualizar la persona. Por favor, inténtelo de nuevo.';
        }

        $this->viewBuilder()->setClassName('Json');
        $this->set([
            'statusCode' => $statusCode,
            'message' => $message,
            'persona' => $persona, // Puede ser útil devolver la entidad actualizada
        ]);
        $this->viewBuilder()->setOption('serialize', ['message', 'persona']);
    }
}