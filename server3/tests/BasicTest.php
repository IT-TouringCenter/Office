<?php
use App\UnitTests\Box;

class BasicTest extends TestCase{
    public function testHasItemInBox(){        
        $box = new Box(['cat', 'toy', 'torch']);
        
        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }

    public function testTakeOneFromTheBox(){
        $box = new Box(['torch']);

        $this->assertEquals('torch',$box->takeOne());
        $this->assertNull($box->takeOne());
    }

    public function testStartWithALetter(){
        $box = new Box(['toy', 'torch', 'ball', 'cat', 'tissue']);
        $result=$box->startsWith('t');

        $this->assertCount(3,$result);
        $this->assertContains('toy',$result);
        $this->assertContains('torch',$result);
        $this->assertContains('tissue',$result);

        $this->assertEmpty($box->startsWith('s'));
    }
}
?>