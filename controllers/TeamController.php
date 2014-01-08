<?php

    /**
     * Provides functions to manage teams
     *
     * @author Carlos Ortega Huetos <carlosV2.0@gmail.com>
     */
    class TeamController extends Rest
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

            // Check for a valid members
            if (!isset($this->request['members']) || !is_array($this->request['members'])) {
                $ifv = new InvalidFieldView('members');
                $ifv->send();
                return;
            }

            // Check all the members
            foreach ($this->request['members'] as $member) {
                if (!is_int($member)) {
                    $ifv = new InvalidFieldView('members:' . $member);
                    $ifv->send();
                    return;
                }
            }

            // Everything is ok, create the team
            $id = strtotime('now');
            $team = new TeamModel($id);
            $team->name    = $this->request['name'];
            $team->members = $this->request['members'];

            if (!$team->save()) {
                // Send an error back
                $utsfv = new UnableToSaveFileView($team->getPath());
                $utsfv->send();
                return;
            }

            // Show the full data of the team
            $tcv = new TeamCreatedView($team);
            $tcv->send();
        }

        /**
         * {@inheritdoc}
         */
        protected function getObject($id)
        {
            // Load the team
            $team = new TeamModel($id);

            // Show the full data of the team
            $tv = new TeamView($team);
            $tv->send();
        }

        /**
         * {@inheritdoc}
         */
        protected function updateObject($id)
        {
            // Load the team
            $team = new TeamModel($id);

            // Check for a valid name
            if (isset($this->request['name']) && is_string($this->request['name'])) {
                $team->name = $this->request['name'];
            }

            // Check for a valid members
            if (isset($this->request['members']) && is_array($this->request['members'])) {
                $success = true;

                foreach ($this->request['members'] as $member) {
                    if (!is_int($member)) {
                        $success = false;
                        break;
                    }
                }

                if ($success) {
                    $team->members = $this->request['members'];
                }
            }

            if (!$team->save()) {
                // Send an error back
                $utsfv = new UnableToSaveFileView($team->getPath());
                $utsfv->send();
                return;
            }

            // Show the full data of the team
            $tv = new TeamView($team);
            $tv->send();
        }

        /**
         * {@inheritdoc}
         */
        protected function deleteObject($id)
        {
            // Load the team
            $team = new TeamModel($id);

            if (!$team->delete()) {
                // Send an error back
                $utdfv = new UnableToDeleteFileView($team->getPath());
                $utdfv->send();
                return;
            }

            // Show the full data of the team
            $tdv = new TeamDeletedView($team);
            $tdv->send();
        }
    }