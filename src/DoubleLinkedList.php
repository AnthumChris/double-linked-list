<?php

class DoubleLinkedList {
	private $node_first;
	private $node_last;
	private $node_current;
	private $total_nodes = 0;

	public function __toString() {
		if (0 >= $this->total_nodes) {
			return '';
		}

		$node = $this->node_first;
		$s = $node->__toString();

		while ($node->next) {
			$node = $node->next;
			$s .= ',' . $node->__toString();
		}
		return $s;
	}

	private function is_valid() {
		return ($this->node_first && $this->node_current);
	}

	private function throw_exception_if_invalid() {
		if (!$this->is_valid()) {
			throw new DoubleLinkedListException("DoubleLinkedList is invalid. Please add an element or set a pointer.");
		}
	}

	private function throw_exception_if_empty() {
		if (!$this->total_nodes) {
			throw new DoubleLinkedListException("List is empty.");
		}
	}

	public function add($value) {
		$node_new = new LinkedListNode($value);

		if (0 === $this->total_nodes) { // initialize (set first/last nodes)
			$this->node_first = $node_new;
			$this->node_last = $node_new;
		} else { // walk list and put in the proper order
			$node_added = false;
			$current = $this->node_first;

			do {
				if ($node_new->value <= $current->value) {  // add new node before current node
					if (!$current->prev) { // we're adding to beginning
						$this->node_first = $node_new;
					} else { // we're adding in between
						$node_new->prev = $current->prev;
						$node_new->prev->next = $node_new;
					}
					$node_new->next = $current;
					$current->prev = $node_new;
					$node_added = true;
				} else {
					if (!$current->next) { // end of list, add to end
						$current->next = $node_new;
						$node_new->prev = $current;
						$this->node_last = $node_new;
						$node_added = true;
					} else { // move pointer to eval next node
						$current = $current->next;
					}
				}
			} while (!$node_added);
		}

		$this->total_nodes++;
	}

	public function count() {
		return $this->total_nodes;
	}

	public function current() {
		$this->throw_exception_if_invalid();
		return $this->node_current->value;
	}

	public function first() {
		$this->throw_exception_if_empty();
		$this->node_current = $this->node_first;
		return $this->node_current->value;
	}

	public function last() {
		$this->throw_exception_if_empty();
		$this->node_current = $this->node_last;
		return $this->node_current->value;
	}

	public function next() {
		$this->throw_exception_if_empty();

		if (!$this->node_current) { // pointer not yet set
			$this->node_current = $this->node_first;
		} else { // pointer set, eval next element
			if (!$this->node_current->next) {
				throw new DoubleLinkedListException("Exceeded End of List boundary");
			}
			$this->node_current = $this->node_current->next;
		}
		return $this->node_current->value;
	}

	public function previous() {
		$this->throw_exception_if_invalid();

		if (!$this->node_current->prev) {
			throw new DoubleLinkedListException("Exceeded beginning of List boundary");
		}
		$this->node_current = $this->node_current->prev;
		return $this->node_current->value;
	}

	public function valid() {
		return $this->is_valid();
	}

	public function reverse() {
		$this->throw_exception_if_empty();
		if ($this->total_nodes > 0) {
			$current = $this->node_first;
			$tmp = $this->node_first;
			$this->node_first = $this->node_last;
			$this->node_last = $tmp;
			while ($current) {
				// swap next/prev on each node
				$tmp = $current->prev;
				$current->prev = $current->next;
				$current->next = $tmp;

				$current = $current->prev;
			}
		}
	}
}
