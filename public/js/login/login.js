$(document).ready(function(){
	$('#username').focus(function(){
		this.value = '';
	});
	$('#username').blur(function(){
		if(this.value == ''){
			this.value = '用户名';
		}
	});

	$('#pwd').focus(function(){
		this.value = '';
	});
	// $('#pwd').blur(function(){
	// 	if(this.value == ''){
	// 		this.value = 'Password';
	// 	}
	// });
	var username = $('#username');
	var pwd = $('#pwd');
	$('.signin input').click(function(){
		$.post('/',{'username':username,'pwd':pwd},function(result){
			if(result == 1){
				window.location.href = '/'
			}
			else if(result == 2){
				alert("用户不存在");
			}
			else if(result == 3){
				alert("密码错误")
			}
		});
	})
	
});