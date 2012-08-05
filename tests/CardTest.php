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

    public function testFallbackToArrayFormatOnSettingAnInvalidOne()
    {
        $this->object->setFormat(1000);
        $this->assertEquals(namespace\OUTPUT_ARRAY, $this->object->getFormat());
    }

    /**
    * @expectedException      DomainException
    * @expectedExceptionCode  1000
    */
    public function testGettingRandomCardWithNoUsernameRaisesException()
    {
        $this->object->setUser('');
        $this->assertEmpty($this->object->getRandomCard());
    }

    /**
    * @expectedException      DomainException
    * @expectedExceptionCode  1000
    */
    public function testGettingAllCardsWithNoUsernameRaisesException()
    {
        $this->object->setUser('');
        $this->assertEmpty($this->object->getAllCards());
    }

    /**
    * @medium
    */
    public function testGettingRandomCardMustReturnJustOneCard()
    {
        $this->object->setUser('arglbr');
        $this->assertCount(1, $this->object->getRandomCard());
    }

    /**
    * @medium
    */
    public function testGettingAllCardsMustReturnAnArray()
    {
        $this->object->setUser('arglbr');
        $this->object->setFormat(namespace\OUTPUT_ARRAY);
        $this->assertTrue(is_array($this->object->getAllCards()));
    }
}
