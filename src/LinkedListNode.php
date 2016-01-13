<?php

class LinkedListNode {
	public $value;
	public $prev;
	public $next;

	public function __construct($value) {
		$this->value = $value;
	}

	public function __toString() {
		if (is_object($this->value)) {
			return serialize($this->value);
		} else {
			return (is_array($this->value))? '['.implode(",", $this->value).']' : (string)$this->value;
		}
	}
}
