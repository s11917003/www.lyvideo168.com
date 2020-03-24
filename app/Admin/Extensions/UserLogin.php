<?php

namespace App\Admin\Extensions;
use Encore\Admin\Admin;

class UserLogin
{
    protected $id;
    protected $acc;
    public function __construct($id, $acc)
    {
        $this->id = $id;
		$this->acc = $acc;

    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-check-row').on('click', function () {

    // Your code.
    console.log($(this).data('acc'));
	useracc = $(this).data('acc');
	
	
	$.ajax({
			method: "POST",
			dataType: "json",
			url: "/admin/users/userlogin",			
			data: {
				useracc:useracc,
                _token: LA.token,
			},			
			success: function(data){
				
				if(data.ret == 'success') {
					toastr.success(data.ret);
					window.open("/");

				} else {
					toastr.success(data.msg);
	      		}
	      		$.pjax.reload('#pjax-container');
	      	},
		  	error :function( data ) {
	        	var errors = data.responseJSON;
				if( data.status === 422 ) {
					$.each(errors, function(index, value) {
						alert(value[0])
					});
	      		}
			}
	  	})
   
});

SCRIPT;
    }

    protected function render()
    {
        Admin::script($this->script());
        return "<a class='btn btn-xs fa fa-user grid-check-row' data-acc='{$this->acc}'></a>";
    }

    public function __toString()
    {
        return $this->render();
    }
}