<?php
    class DependencyFailure extends TestCase{
        public function testOne(){
            $this->assertTrue(false);
        }

        /**
        *@depends testOne
        */
        public function testTow(){
            
        }
    }
?>