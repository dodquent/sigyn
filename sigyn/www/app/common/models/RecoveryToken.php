<?php

namespace Sigyn\Models;

use Phalcon\Mvc\Model;

class RecoveryToken extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=32, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $expiration_date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("sigyn");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Recovery_Token';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RecoveryToken[]|RecoveryToken
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RecoveryToken
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Exécuté avant chaque insertion. Création d'un ID unique sur l'objet inséré.
     * 
     * @return void
     */
    public function beforeValidationOnCreate() {
        $this->id = bin2hex(openssl_random_pseudo_bytes(16));
        $this->expiration_date = time();
    }

}
