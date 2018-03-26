<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Metadata {
        private $groupid;	
	private $volume;
	private $callno;

        private $note;
	private $available;
        private $due;
        
        function get_callno() {
            return $this->callno;
        }

        function get_volume() {
            return $this->volume;
        }

        function get_groupid() {
            return $this->groupid;
        }

        function get_note() {
            return $this->note;
        }

        function get_available() {
            return $this->available;
        }

        function get_due() {
            return $this->due;
        }

        function set_callno($callno) {
            $this->callno = $callno;
        }

        function set_volume($volume) {
            $this->volume = $volume;
        }

        function set_groupid($groupid) {
            $this->groupid = $groupid;
        }

        function set_note($note) {
            $this->note = $note;
        }

        function set_available($available) {
            $this->available = $available;
        }

        function set_due($due) {
            $this->due = $due;
        }
        
        public function __construct() {
            
        }
        
        




        


}