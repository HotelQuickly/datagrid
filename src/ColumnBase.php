<?php
/**
 * Created by PhpStorm.
 * User: spnball
 * Date: 4/29/15
 * Time: 12:25 PM
 */

namespace Nextras\Datagrid;


class ColumnBase extends \Nette\Object {

    /** @var string */
    protected $name;

    /** @var string */
    protected $label;

    /**
     * @var ParentInterface
     */
    protected $parent;

	/**
	 * @var integer|FALSE
	 */
	protected $rowSpan = FALSE;


	/**  @var interger */
	protected $level = FALSE;


    public function getName()
    {
        return $this->name;
    }

    public function getLabel()
    {
        return $this->label;
    }

	public function setLevel ($level)
	{
		$this->level = $level;
		return $this;
	}

    /**
     * @param ParentInterface $parent
     */
    public function setParent(ParentInterface $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

	public function setRowspan($rowspan)
	{
		$this->rowSpan = $rowspan;
		return $this;
	}

    public function getRowspan()
    {
		if ($this->rowSpan !== FALSE) {
			return $this->rowSpan;
		}

        $maxDeep = 0;
        foreach ($this->getParent()->getColumnStructure() as $column) {
            if ($this->getName() != $column->getName()) {
                $deep = $column->getChildrenDeep();
                if ($maxDeep < $deep) {
                    $maxDeep = $deep;
                }
            }
        }

        $maxDeep++;

        return $maxDeep - $this->getChildrenDeep();
    }
}