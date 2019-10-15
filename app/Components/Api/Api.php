<?php

namespace App\Components;
use App\Components\Api\ApiService;

class Api extends ApiService
{
    /**
     * Palindrome
     */
    public function palindrome()
    {
        if ($this->getRequestMethod() != "POST") {
            $this->response('', 406);
        }

        $name = $this->request['name'];
        // TODO ecrire un objet palindrome
        //$palindrome = new Palindrome($name);

        if ($name) {
            // TODO ecrire la methode isValid() de l'objet palindrome et la tester avec PHPUnit
            /*
            if ($palindrome->isValid()) {
                $this->response($this->json(["response" => true]), 200);
            } else {
                $this->response($this->json(["response" => false]), 200);
            }
            */
        }
    }

    /**
     * Vérification du format de l'email
     */
    public function email()
    {
        if ($this->getRequestMethod() != "POST") {
            $this->response('', 406);
        }
        $email = $this->_request['email'];
        if ($email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->response($this->json([
                    "response" => true,
                    "message"  => "L'email est au bon format"
                ]), 200);
            } else {
                $this->response($this->json([
                    "response" => false,
                    "message"  => "Le format de l'email n'est pas correct"
                ]), 200);
            }
        }
    }

    /**
     * Encodage des données en json
     *
     * @param $data
     *
     * @return string
     */
    private function json($data)
    {
        if (is_array($data)) {
            return json_encode($data);
        }

    }
}

$api = new Api();
$api->processApi();