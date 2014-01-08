<?php

    /**
     * Provides functions to read and write stores of data
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    abstract class Store
    {

        /**
         * Prefix to be added to the filename
         *
         * @var string
         */
        protected $filename_prefix;

        /**
         * Store identifier
         *
         * @var int
         */
        protected $id;

        /**
         * Path to the store file
         * 
         * @var string
         */
        protected $store_path;


        /**
         * Constructor of the class. It loads the selected store
         *
         * @param int $id Identifier for the store
         * 
         * @throws StoreNotFoundException If the supplied id does not match any file
         */
        public function __construct($id)
        {
            // Generate the path to the store
            $this->id = $id;
            $this->store_path = '../stores/' . $this->filename_prefix . '_' . $this->id . '.json';

            // Load the store
            $this->load();
        }

        /**
         * Function to load an object from the file
         * 
         * @return object The object read of an empty object
         */
        protected function loadObject()
        {
            if (file_exists($this->store_path)) {
                // Load and decode the content
                $data = json_decode(file_get_contents($this->store_path));

                // Check for a minimum valid content
                if (isset($data) && is_object($data)) {
                    return $data;
                } else {
                    return new stdClass();
                }
            } else {
                return new stdClass();
            }
        }

        /**
         * Function to load the store from a file
         * 
         * @throws FieldNotFoundException If a required field is not present
         */
        abstract protected function load();

        /**
         * Function to store an object into the file
         * 
         * @param object $object Object to store
         * 
         * @return bool Whether it was successfully saved or not
         */
        protected function saveObject($object)
        {
            // Check for a minimum valid object
            if (!isset($object) || !is_object($object)) {
                $object = new stdClass();
            }

            return (file_put_contents($this->store_path, json_encode($object)) !== false);
        }

        /**
         * Function to save the store into a file
         * 
         * @return bool Whether it was successfully saved or not
         */
        abstract public function save();

        /**
         * Function to delete the store
         * 
         * @return bool Whether it was successfully deleted or not
         */
        abstract public function delete();

        /**
         * Function to get the identifier
         * 
         * @return int The identifier
         */
        public function getId()
        {
            return $this->id;
        }
        
        /**
         * Function to get the file path
         * 
         * @return sting The file path
         */
        public function getPath()
        {
            return $this->store_path;
        }

    }