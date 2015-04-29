<?php
namespace Nextras\Datagrid;


interface ColumnInterface {
    /**
     * @param $name
     * @param $label
     * @param Datagrid $grid
     */
    public function __construct($name, $label, Datagrid $grid);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return mixed
     */
    public function canSort();

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @return integer
     */
    public function getColspan();

    /**
     * @return integer
     */
    public function getRowspan();

    /**
     * @return integer
     */
    public function getChildrenDeep();
}