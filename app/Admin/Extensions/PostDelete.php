<?php

namespace App\Admin\Extensions;
use Encore\Admin\Admin;


class PostDelete
{
    protected $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    protected function script()
    {
        return <<<SCRIPT

$('.grid-check-row').on('click', function () {

    // Your code.
    console.log($(this).data('id'));
	postid = $(this).data('id');
	
	var r=confirm("砍了就掰了，扔然要砍？");
	if (r==false) {
	  alert("取消刪除!");
	  return false;
	}
	
	$.ajax({
			method: "POST",
			dataType: "json",
			url: "/admin/postarticle/destroy",			
			data: {
				postid:postid,
                _token: LA.token,
                _method: 'DELETE'				
			},			
			success: function(data){
				
				if(data.ret == 0) {
					toastr.success(data.msg);
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

        return "<a class='btn btn-xs fa fa-trash grid-check-row' data-id='{$this->id}'></a>";
    }

    public function __toString()
    {
        return $this->render();
    }
}