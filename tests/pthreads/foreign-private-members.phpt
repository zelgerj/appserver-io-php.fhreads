--TEST--
Testing foreign private member access, magic methods bug #32
--DESCRIPTION--
Test that the fix for bug #32 is a success
--ENV--
USE_ZEND_ALLOC=0
--FILE--
<?php

if (!extension_loaded('pthreads'))
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.inc';

class MY {
        private $test = "Hello World";

        public function getTest(){
                return $this->test;
        }
}

class TEST extends Thread {
        public function __construct($my) {
                $this->my = $my;
        }

        public function run(){
                printf("TEST: %s\n", $this->my->getTest());
        }
}

$my = new MY();
$test = new TEST($my);
$test->start();
--EXPECT--
TEST: Hello World


