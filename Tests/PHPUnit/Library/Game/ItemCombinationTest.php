<?php
namespace Game;
class ItemCombinationTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorSettingOfItemOneAndTwo()
    {
        $item = $this->getMock('Game\AbstractItem', array('additemCombination', 'addAction'), array(), '', false);
        $item->expects($this->once())
             ->method('additemCombination')
             ->with($this->isInstanceOf('\Game\AbstractItemCombination'));
        $item->expects($this->once())
             ->method('addAction');
        $item2 = $this->getMock('Game\AbstractItem', null, array(), '', false);

        require_once TEST_PATH.'/ItemCombination/Stub.php';
        $itemCombination = new \Game\ItemCombination\Stub($item, $item2);

        // assert Setting and Getting
        $this->assertTrue($itemCombination->getItemOne() === $item);
        $this->assertTrue($itemCombination->getItemTwo() === $item2);
    }

    public function testConstructorTestingOfActionProperty()
    {
        $this->setExpectedException('Game\Exception\RuntimeException' );
        $item = $this->getMock('Game\AbstractItem', null, array(), '', false);
        $itemCombination = $this->getMockForAbstractClass('\Game\AbstractItemCombination', array($item, $item));

    }

    public function testAutomaticCallingOfInitFunction()
    {
        $this->markTestIncomplete('still need to test the invocation of the protected template method _init');
    }
}