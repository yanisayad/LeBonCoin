<?php

namespace App\Models;

use App\Models\AbstractModel;

class UserModel extends AbstractModel
{
    /** @var string  */
    protected $table = "users";

    /**
     * @return mixed
     */
    public function login()
    {
        //@TODO
    }

    /**
     * Méthode de récupération le premier utilisateur
     *
     * @return array|bool|mixed|\PDOStatement
     */
    public function getFirstUserId()
    {
        return $this->query("SELECT id FROM {$this->table} ORDER BY id ASC LIMIT 1");
    }
}
