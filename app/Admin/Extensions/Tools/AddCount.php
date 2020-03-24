<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Grid\Tools\BatchAction;

class AddCount extends BatchAction
{
    protected $action;

    public function __construct($action = 1)
    {
        $this->action = $action;
    }

    public function script()
    {
		//echo 123;   							    
        
        return <<<EOT

$('{$this->getElementClass()}').on('click', function() {
    toastr.success('操作成功');
});

EOT;

    }
}