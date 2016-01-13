<?php

Class LinkedListNodeTest extends PHPUnit_Framework_TestCase {

	public function testValueInstantiation() {
		$node = new LinkedListNode(1);
		$this->assertEquals(1, $node->value);

		$node = new LinkedListNode('2');
		$this->assertEquals('2', $node->value);

		$node = new LinkedListNode([]);
		$this->assertEquals([], $node->value);

		$node = new LinkedListNode([1,2]);
		$this->assertEquals([1,2], $node->value);
	}

	public function testToString() {
		// scalar
		$node = new LinkedListNode(1);
		$this->assertEquals('1', $node);

		// scalar
		$node = new LinkedListNode(1.2);
		$this->assertEquals('1.2', $node);

		// scalar
		$node = new LinkedListNode('foo');
		$this->assertEquals('foo', $node);

		$node = new LinkedListNode(null);
		$this->assertEquals('', $node);

		// empty array
		$node = new LinkedListNode([]);
		$this->assertEquals('[]', $node);

		// filled array
		$node = new LinkedListNode([1,2]);
		$this->assertEquals('[1,2]', $node);

		// non-scalar objects
		$o = new stdClass();
		$node = new LinkedListNode($o);
		$this->assertEquals(serialize($o), $node);
	}
}
