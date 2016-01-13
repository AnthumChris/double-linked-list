<?php

Class LinkedListTest extends PHPUnit_Framework_TestCase {

	public function testReverse() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$list->reverse();
		$this->assertEquals('1', $list);

		$list = new DoubleLinkedList();
		$list->add(1);
		$list->add(2);
		$list->reverse();
		$this->assertEquals('2,1', $list);

		$list = new DoubleLinkedList();
		$list->add(4);
		$list->add(3);
		$list->add(2);
		$list->add(1);
		$list->reverse();
		$this->assertEquals('4,3,2,1', $list);

		$list->reverse();
		$this->assertEquals('1,2,3,4', $list);
	}

	public function testFirstValue() {
		$list = new DoubleLinkedList();
		$list->add(2);
		$this->assertEquals(2, $list->first());

		$list->add(1);
		$this->assertEquals(1, $list->first());
	}

	public function testLastValue() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$this->assertEquals(1, $list->last());

		$list->add(2);
		$this->assertEquals(2, $list->last());
	}

	public function testCurrentValue() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$list->first();
		$this->assertEquals(1, $list->current());
	}

	public function testNextValue() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$list->add(2);
		$this->assertEquals(1, $list->next());
		$this->assertEquals(2, $list->next());
	}

	public function testPreviousValue() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$list->add(2);

		$this->assertEquals(2, $list->last());
		$this->assertEquals(1, $list->previous());
	}

	public function testOrderingAfterAdd() {
		$list = new DoubleLinkedList();
		$this->assertEquals('', $list);
		
		$list->add('3');
		$this->assertEquals('3', $list);
		
		$list->add('1');
		$this->assertEquals('1,3', $list);

		$list->add('2');
		$this->assertEquals('1,2,3', $list);

		$list->add('2');
		$this->assertEquals('1,2,2,3', $list);

		$list->add('0');
		$this->assertEquals('0,1,2,2,3', $list);

		$list->add('-1');
		$this->assertEquals('-1,0,1,2,2,3', $list);

		$list->add('4');
		$this->assertEquals('-1,0,1,2,2,3,4', $list);

		$list->add(null);
		$this->assertEquals(',-1,0,1,2,2,3,4', $list);

		$list->add('');
		$this->assertEquals(',,-1,0,1,2,2,3,4', $list);

		// array/object ordering is a little weird in string representation
		$list->add([3,4]);
		$this->assertEquals(',,-1,0,1,2,2,3,4,[3,4]', $list);

		$o = new stdClass();
		$list->add($o);
		$this->assertEquals(',,-1,0,1,2,2,3,4,[3,4],'.serialize($o), $list);
	}

	public function testCount() {
		$list = new DoubleLinkedList();
		$this->assertEquals(0, $list->count());
		
		$list->add('value1');
		$this->assertEquals(1, $list->count());
		
		$list->add('value2');
		$this->assertEquals(2, $list->count());
	}

	public function testValid() {
		$list = new DoubleLinkedList();
		$this->assertFalse($list->valid());

		$list->add(1);
		$this->assertFalse($list->valid());
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionEmptyCurrent() {
		$list = new DoubleLinkedList();
		$list->current();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionEmptyNext() {
		$list = new DoubleLinkedList();
		$list->next();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionEmptyPrevious() {
		$list = new DoubleLinkedList();
		$list->previous();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionPreviousBoundary() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$this->assertEquals(1, $list->next());
		$list->previous();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionEmptyFirst() {
		$list = new DoubleLinkedList();
		$list->first();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionNextBoundary() {
		$list = new DoubleLinkedList();
		$list->add(1);
		$this->assertEquals(1, $list->next());
		$list->next();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionEmptyLast() {
		$list = new DoubleLinkedList();
		$list->last();
	}

	/**
	 * @expectedException DoubleLinkedListException
	 */
	public function testExceptionEmptyReverse() {
		$list = new DoubleLinkedList();
		$list->reverse();
	}
}