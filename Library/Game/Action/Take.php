<?php
namespace Game\Action;
class Take extends AbstractAction
{
    /**
     * name of the action, it is the id of a specific action
     *
     * @var string
     */
    protected $name = 'take';

    /**
     * The commands under which the action can be found and executed
     *
     * @var array of regex compatible strings
     */
    protected $synonyms = array(
        'take[ ]?',
        'pick[ ]?up[ ]?',
        'get[ ]?',
    );

    /**
     * Takes an item from the tile and puts it in the private inventory
     * @see Game\Action.AbstractAction::execute()
     * @return boolean true on taken
     */
    public function execute()
    {
        if ($this->grid->getTileFromPosition()->getInventory()->takeItem($this->subject)) {
            $this->personalInventory->addItem($this->subject, 1);
            $this->executeSuccess();
            return $this->getExecutedMessageSuccess();
        } else  {
            foreach ($this->grid->getTileFromPosition()->getInventory()->getItems() as $item) {
                if ($item->getInventory()->takeItem($this->subject)) {
                      $this->personalInventory->addItem($this->subject, 1);
                   $this->executeSuccess();
                   return $this->getExecutedMessageSuccess();
               }
            }
        }
        $this->executeFailed();
        return $this->getExecutedMessageFailed();
    }

    /**
     * When the action was successfully executed this message could be displayed
     *
     * @return string;
     */
    protected function getExecutedMessageSuccess()
    {
        return $this->subject->getName().' taken';
    }

    /**
     * When the action executed failed this message could be displayed
     *
     * @return string;
     */
    protected function getExecutedMessageFailed()
    {
        return 'could not take '.$this->subject->getName();
    }
}