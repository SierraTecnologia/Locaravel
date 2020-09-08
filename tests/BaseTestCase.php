<?php

abstract class BaseTestCase extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }
}
