<?php

namespace Sigyn\Models;
use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $pro_type;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $type;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("sigyn");
        $this->hasMany('id', 'Messages', 'id_receiver', ['alias' => 'Messages']);
        $this->hasMany('id', 'Messages', 'id_sender', ['alias' => 'Messages']);
        $this->hasMany('id', 'RecoveryToken', 'user_id', ['alias' => 'RecoveryToken']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
