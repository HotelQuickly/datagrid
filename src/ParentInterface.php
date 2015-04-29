<?php
/**
 * Created by PhpStorm.
 * User: spnball
 * Date: 4/29/15
 * Time: 12:23 PM
 */

namespace Nextras\Datagrid;


interface ParentInterface {

    public function getColumnStructure();

    public function buildColumnHeader();
}