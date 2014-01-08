<?php

    /**
     * Provides functions to handle a person view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class PersonView extends Displayable
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code = 200;

        /**
         * Person object
         * 
         * @var person
         */
        protected $person;


        /**
         * Constructor for the class
         * 
         * @param person $person Person object
         */
        public function __construct($person)
        {
            $this->person = $person;
        }

        /**
         * {@inheritdoc}
         */
        public function composeBodyObject()
        {
            $object = new stdClass();
            $object->id      = $this->person->getId();
            $object->name    = $this->person->name;
            $object->surname = $this->person->surname;
            $object->age     = $this->person->age;

            return $object;
        }

    }