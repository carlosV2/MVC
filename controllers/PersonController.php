<?php

    /**
     * Provides functions to manage persons
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class PersonController extends Rest
    {

        /**
         * {@inheritdoc}
         */
        protected function createObject()
        {
            // Check for a valid name
            if (!isset($this->request['name']) || !is_string($this->request['name'])) {
                $ifv = new InvalidFieldView('name');
                $ifv->send();
                return;
            }

            // Check for a valid surname
            if (!isset($this->request['surname']) || !is_string($this->request['surname'])) {
                $ifv = new InvalidFieldView('surname');
                $ifv->send();
                return;
            }

            // Check for a valid age
            if (!isset($this->request['age']) || !is_int($this->request['age'])) {
                $ifv = new InvalidFieldView('age');
                $ifv->send();
                return;
            }

            // Everything is ok, create person
            $id = strtotime('now');
            $person = new PersonModel($id);
            $person->name    = $this->request['name'];
            $person->surname = $this->request['surname'];
            $person->age     = $this->request['age'];

            if (!$person->save()) {
                // Send an error back
                $utsfv = new UnableToSaveFileView($person->getPath());
                $utsfv->send();
                return;
            }

            // Show the full data of the person
            $pcv = new PersonCreatedView($person);
            $pcv->send();
        }

        /**
         * {@inheritdoc}
         */
        protected function getObject($id)
        {
            // Load the person
            $person = new PersonModel($id);

            // Show the full data of the person
            $pv = new PersonView($person);
            $pv->send();
        }

        /**
         * {@inheritdoc}
         */
        protected function updateObject($id)
        {
            // Load the person
            $person = new PersonModel($id);

            // Check for a valid name
            if (isset($this->request['name']) && is_string($this->request['name'])) {
                $person->name = $this->request['name'];
            }

            // Check for a valid surname
            if (isset($this->request['surname']) && is_string($this->request['surname'])) {
                $person->surname = $this->request['surname'];
            }

            // Check for a valid age
            if (isset($this->request['age']) && is_int($this->request['age'])) {
                $person->age = $this->request['age'];
            }

            if (!$person->save()) {
                // Send an error back
                $utsfv = new UnableToSaveFileView($person->getPath());
                $utsfv->send();
                return;
            }

            // Show the full data of the person
            $pv = new PersonView($person);
            $pv->send();
        }

        /**
         * {@inheritdoc}
         */
        protected function deleteObject($id)
        {
            // Load the person
            $person = new PersonModel($id);

            if (!$person->delete()) {
                // Send an error back
                $utdfv = new UnableToDeleteFileView($person->getPath());
                $utdfv->send();
                return;
            }

            // Show the full data of the person
            $pdv = new PersonDeletedView($person);
            $pdv->send();
        }
    }