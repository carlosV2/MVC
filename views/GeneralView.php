<?php

    /**
     * Provides functions to handle an error view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class GeneralView extends Displayable
    {

        /**
         * Status code
         * 
         * @var int
         */
        protected $status_code;

        /**
         * Error code
         * 
         * @var string
         */
        protected $error_code;

        /**
         * Error issue
         * 
         * @var string
         */
        protected $error_issue;


        /**
         * {@inheritdoc}
         */
        public function composeBodyObject()
        {
            $object = new stdClass();
            $object->error_code  = $this->error_code;
            $object->error_msg   = Messages::GetMessage($this->error_code);

            if (isset($this->error_issue)) {
                $object->error_issue = $this->error_issue;
            }

            return $object;
        }

    }