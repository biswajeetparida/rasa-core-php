<?php

namespace RasaCore\Request;

class IntentRequest extends Request {
        public $intentName;
        public $slots = array();

        public function __construct($rawData) {
                parent::__construct($rawData);
                $data = $this->data;

                $this->intentName = $data['request']['intent']['name'];

                if (isset($data['request']['intent']['slots'])) {
                        foreach ($data['request']['intent']['slots'] as $slot) {
                                if (isset($slot['value'])) {
                                        $this->slots[$slot['name']] = $slot['value'];
                                }
                        }
                }
        }


        /**
         * Returns the value for the requested intent slot, or $default if not
         * found.
         * @param string $name
         * @param mixed $default
         * @return mixed
         */
        public function getSlot($name, $default = false) {
                if(array_key_exists($name, $this->slots)) {
                        return $this->slots[$name];
                } else {
                        return $default;
                }
        }
}
