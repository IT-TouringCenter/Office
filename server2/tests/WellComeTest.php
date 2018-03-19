<?php

class WellComeTest extends TestCase {
    public function testDisplayLaravel5(){
        // $this->call('/')
        //     ->see('Laravel');                
      
        $response=$this->call('GET','/');
        $this->assertEquals(200,$response->getStatusCode());       
    }
}
?>