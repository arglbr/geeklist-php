<?php
namespace Geeklist;

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Card
     */
    protected $object;

    /**
     * http://www.phpunit.de/manual/3.6/en/fixtures.html
     * Before a test method is run, this template method
         * called setUp() is invoked
     */
    protected function setUp()
    {
        $this->object = new namespace\Card;
    }

    /**
    * @expectedException      DomainException
        * @expectedExceptionCode  1000
    */
    public function testAvoidInvalidUser()
    {
        $this->object->setUser('');
        $this->object->getUser('');
    }

}
