<?php
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{

    public function test1plus2equal3()
    {
        $tree = new Tree();
        $this->assertEquals(3, $tree->sum(1, 2));
    }

    public function test2plus2equal4()
    {
        $tree = new Tree();
        $this->assertEquals(4, $tree->sum(2, 2));
    }
}