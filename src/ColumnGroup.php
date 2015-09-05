<?php
/**
 * Created by PhpStorm.
 * User: spnball
 * Date: 4/29/15
 * Time: 11:31 AM
 */

namespace Nextras\Datagrid;


class ColumnGroup extends ColumnBase implements ColumnInterface, ParentInterface {

    /** @var string */
    public $name;

    /** @var string */
    public $label;

    /** @var string */
    protected $sort = FALSE;

    /** @var Datagrid */
    protected $grid;

    /** @var array */
    protected $columnStructure = array();

    public function __construct($name, $label, Datagrid $grid)
    {
        $this->name = $name;
        $this->label = $label;
        $this->grid = $grid;
    }

    public function getColumnStructure()
    {
        return $this->columnStructure;
    }

    public function addColumn(ColumnInterface $column)
    {
        $this->columnStructure[] = $column;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function canSort()
    {
        return false;
    }

    public function getColspan()
    {
        $column = 0;
        foreach ($this->getColumnStructure() as $child) {
            $column += $child->getColspan();
        }

        return $column;
    }

    public function getChildrenDeep ()
    {
        $deep = 1;
        foreach ($this->getColumnStructure() as $child) {
            $childDeep = $child->getChildrenDeep();
            if ($childDeep > $deep - 1) {
                $deep = $childDeep + 1;
            }
        }
        return $deep;
    }

    public function buildColumnHeader(array &$columnRow = null, $level = 0)
    {
        foreach ($this->getColumnStructure() as $column) {
			if ($this->level !== FALSE) {
				$level = $this->level;
			}

            if ($column instanceof ParentInterface) {
                $column->buildColumnHeader($columnRow, $level + 1);
            }

            if (isset($columnRow[$level])) {
                $columnRow[$level][] = $column;
            }
            else {
                $columnRow[$level] = array($column);
            }
        }
    }
}