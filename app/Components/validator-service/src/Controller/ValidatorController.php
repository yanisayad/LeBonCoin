<?php

namespace App\Controller;

use App\Utils\Palindrome;
use App\Utils\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ValidatorController extends AbstractController
{
    /**
     * Fonction permettant de définir si l'email est valide
     *
     * @Route("/api/email", methods={"POST"}, name="email")
     *
     * @param Request $req
     *
     * @return JsonResponse
     */
    public function email(Request $req): JsonResponse
    {
        $email = $req->request->get('email');

        if ($email === null) {
            return $this->json(false, 200);
        }

        $email = filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        );

        if(strcmp($email, strtolower($email)) !== 0) {
            return $this->json(false, 200);
        }

        return $this->json(true, 200);
    }

    /**
     * Fonction permettant de définir si le nom est un palindrome
     *
     * @Route("/api/palindrome", methods={"POST"}, name="palindrome")
     *
     * @param Request $req
     *
     * @return JsonResponse
     */
    public function palindrome(Request $req): JsonResponse
    {
        $name = $req->request->get('name');
        if ($name === null) {
            return $this->json(false, 200);
        }

        $palindrome = new Palindrome($name);

        return $this->json($palindrome->isValid(), 200);
    }
}
