--TEST--
Null member crash
--DESCRIPTION--
This test verifies that null members do not crash php
--ENV--
USE_ZEND_ALLOC=0
--FILE--
<?php

if (!extension_loaded('pthreads'))
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.inc';

class Test extends Threaded {
    public function run(){}
}
$test = new Test();
@$test[$undefined]="what";
var_dump($test);
?>
--EXPECTF--
object(Test)#1 (1) {
  ["0"]=>
  string(4) "what"
}
