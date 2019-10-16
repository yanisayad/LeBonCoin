<?php

namespace App\Models;

use App\Models\AbstractModel;

class AddressModel extends AbstractModel
{
    /** @var string  */
    protected $table = "addresses";

    /**
     * Méthode de récupération des adresses d'utilisateur
     * @param $idContact
     *
     * @return array|bool|mixed|\PDOStatement
     */
    public function getByContact(int $idContact)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE idContact = {$idContact}");
    }
}
