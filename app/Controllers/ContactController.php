<?php

namespace App\Controllers;

use App\Controllers\ControllerInterface;
use App\Utils\Palindrome;
use InvalidArgumentException;
use Exception;

class ContactController extends MainController implements ControllerInterface
{
    /** @var int $userId */
    protected $userId;

    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // $this->userId = $_SESSION['auth']['id'];
        $this->userId = 2;
        $this->loadModel("Contact");
    }

    /**
     * Affichage de la liste des contacts de l'utilisateur connecté
     */
    public function index()
    {
        $contacts = [];
        if (!empty($this->userId)) {
            $contacts = $this->Contact->getContactByUser($this->userId);
        }
        echo $this->twig->render('index.html.twig', ['contacts' => $contacts]);
    }

    /**
     * Ajout d'un contact
     */
    public function add()
    {
        $error = false;
        if (!empty($_POST)) {
            $response = $this->sanitize($_POST);
            if ($response["response"]) {
                $result = $this->Contact->create([
                    'nom'    => $response['nom'],
                    'prenom' => $response['prenom'],
                    'email'  => $response['email'],
                    'userId' => $this->userId
                ]);
                if ($result) {
                    header('Location: /index.php?p=contact.index');
                }
            } else {
                $error = true;
            }
        }
        echo $this->twig->render('add.html.twig', ['error' => $error]);
    }

    /**
     * Modification d'un contact
     */
    public function edit()
    {
        //@todo
        $contact = $this->Contact->findById($_GET['id']);


        $error = false;
        if (!empty($_POST)) {
            $response = $this->sanitize($_POST);
            if ($response["response"]) {
                $result = $this->Contact->update($_GET['id'],[
                    'nom'    => $response['nom'],
                    'prenom' => $response['prenom'],
                    'email'  => $response['email']
                ]);
                if ($result) {
                    header('Location: /index.php?p=contact.index');
                }
            } else {
                $error = true;
            }
        }
        echo $this->twig->render('edit.html.twig', ['contact' => $contact,'error' => $error]);
    }

    /**
     * Suppression d'un contact
     */
    public function delete()
    {
        $result = $this->Contact->delete($_GET['id']);
        if ($result) {
            header('Location: /index.php?p=contact.index');
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function sanitize(array $data = []): array
    {
        if (empty($data["nom"])) {
            throw new Exception('Le nom est obligatoire');
        }

        if (empty($data["prenom"])) {
            throw new Exception('Le prenom est obligatoire');
        }

        if (empty($data["email"])) {
            throw new Exception('Le email est obligatoire');
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Le format de l\'email est invalide');
        }

        $firstname = ucwords($data['prenom']);
        $lastname  = ucwords($data['nom']);
        $email     = strtolower($data['email']);

        $lastname_palindrome = new Palindrome(strtolower($lastname));
        if (!$lastname_palindrome->isValid()) {
            throw new Exception('Le format du nom ne doit pas être un palindrome');
        }
        $firstname_palindrome = new Palindrome($firstname);
        if (!$firstname_palindrome->isValid()) {
            throw new Exception('Le format du prenom ne doit pas être un palindrome');
        }

        // $isEmail = $this->apiClient('email', ['email' => $email]);
        return [
            'response' => true,
            'email'    => $email,
            'prenom'   => $firstname,
            'nom'      => $lastname
        ];
    }
}
