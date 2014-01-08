<?php

    /**
     * Provides functions to manage persons
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class PersonModel extends Store
    {

        /**
         * Prefix to be added to the filename
         *
         * @var string
         */
        protected $filename_prefix = 'person';

        /**
         * Name
         * 
         * @var string
         */
        public $name;

        /**
         * Surname
         * 
         * @var string
         */
        public $surname;

        /**
         * Age
         * 
         * @var int
         */
        public $age;


        /**
         * {@inheritdoc}
         */
        public function load()
        {
            // Load the object
            $object = $this->loadObject();

            // Check for the present of all the fields
            foreach (array(
                'name',
                'surname',
                'age'
            ) as $key) {
                if (isset($object->$key)) {
                    $this->$key = $object->$key;
                }
            }
        }

        /**
         * {@inheritdoc}
         */
        public function save()
        {
            // Generate a new object with all the fields
            $object = new stdClass();
            foreach (array(
                'name',
                'surname',
                'age'
            ) as $key) {
                $object->$key = $this->$key;
            }

            // Save the object
            return $this->saveObject($object);
        }

        /**
         * {@inheritdoc}
         */
        public function delete()
        {
            if (is_file($this->store_path)) {
                return unlink($this->store_path);
            } else {
                return false;
            }
        }

    }