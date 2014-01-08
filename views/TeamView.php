<?php

    /**
     * Provides functions to handle a team view
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class TeamView extends Displayable
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
         * @var team
         */
        protected $team;


        /**
         * Constructor for the class
         * 
         * @param team $team Team object
         */
        public function __construct($team)
        {
            $this->team = $team;
        }

        /**
         * {@inheritdoc}
         */
        public function composeBodyObject()
        {
            $object = new stdClass();
            $object->id      = $this->team->getId();
            $object->name    = $this->team->name;
            $object->members = array();

            foreach ($this->team->members as $member) {
                $pv = new PersonView(new PersonModel($member));
                $object->members[] = $pv->composeBodyObject();
            }

            return $object;
        }

    }