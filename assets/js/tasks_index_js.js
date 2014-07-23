$(document).ready(function(){
	$(document).on('submit', '#create', function(){
		$.post($(this).attr('action'),
			$(this).serialize(),
			function(info){
				if(info.flag) {
					var newTask = "<div class='row'>"+
							"<form class='form-inline'>"+
								"<div class='form-group'>"+
									"<input type='hidden' name='task_id' value='"+info.id+"'>\n"+
									"<input class='btn btn-primary btn-xs' type='submit' name='edit' value='Edit'>\n"+
									"<input id='task"+info.id+"' taskid='"+info.id+"'  class='checkbox btn-lg' type='checkbox' name='status'>\n"+
									"<label class='taskLabels'>"+info.name+"</label>\n"+
								"</div>"+
							"</form>"+
						"</div>";
					$('#tasksWrapper').append(newTask);
				} else {
					$('#createStatusWrapper').append(info.error);
				}
			}, 'json');
		return false;
	})

	$(document).on('submit', '#update', function(){
		var form = $(this);
		$.post($(this).attr('action'),
			$(this).serialize(),
			function(info){
				$('.error').remove();
				if(info.flag) {
					var id = form.find("input[type='hidden']").attr('task_id');
					form.find("input[type='text']").replaceWith("<label class='taskLabels' for='task"+id+"'>"+info.name+"</label>");
					form.find("input[type='submit']").attr({type: 'button',
															value: 'Edit',
															class: 'btn btn-primary btn-xs'});
				} else {
					$('#updateStatusWrapper').append(info.error);
					if(!(form.find("input[type='text']").val())){
						form.find("input[type='text']").attr('placeholder', info.placeholder);
						form.find("input[type='submit']").attr('class', 'btn btn-danger btn-xs');
					}
				}
			}, 'json');
		return false;
	})

	$(document).on('submit', '#updateTasks', function() {
		var task_ids = [];
		$("input[type='checkbox']:checked").each(function(){
			task_ids.push($(this).attr('taskid'));
		})
		if((task_ids).length > 0) {
			var string = task_ids.join();
			$.get($(this).attr('action')+"?ids="+string,
				function(info){
					$("input[type='checkbox']:checked").each(function(){
						$(this).parent().parent().parent().remove();
					});
				}, 'json');
		}
		return false;
	})

	$(document).on('click', "input[type='checkbox']", function(){
		var checkbox = $(this);
		if($(this).is(':checked')){
			$(this).parent().children().attr('disabled', 'disabled');
			$(this).removeAttr('disabled');
		} else {
			$(this).parent().children().removeAttr('disabled', 'disabled');
			$(this).removeAttr('disabled');
		}
	})

	$(document).on('click', "input[type='button']", function(){
		$(this).parent().parent().attr('id', 'update');
		var name = $(this).parent().find('label').text();
		var label = $(this).parent().find('label');
		$(this).replaceWith("<input class='btn btn-primary btn-xs' type='submit' name='edit' value='Submit'>");
		label.replaceWith("<input type='text' name='updated_name' value='"+name+"'>");
	})
})