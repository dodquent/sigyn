<?php
 
namespace Sigyn\Models;

class Messages extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id_sender;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id_receiver;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $test;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("sigyn");
        $this->belongsTo('id_receiver', '\Sigyn\Models\Users', 'id', ['alias' => 'Users']);
        $this->belongsTo('id_sender', '\Sigyn\Models\Users', 'id', ['alias' => 'Users']);
    }

    public function beforeValidationOnCreate() 
    {
        $this->date = date("Y-m-d H:i:s");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Messages';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Messages[]|Messages
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Messages
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
