<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Task Manger</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/assets/js/tasks_index_js.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/assets/css/tasks_index_css.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="page-header">
					<h1>List of Tasks:</h1>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div id="leftWrapper" class="col-sm-8">
				<div class="row">
					<div id="updateStatusWrapper" class="col-sm-12"></div>
				</div>
				<div class="row">
					<div id="tasksWrapper" class="col-sm-12">
						<?php
						foreach ($tasks as $index => $task) {
							?>
							<div class="row">
								<form class="form-inline" action='/tasks/process_updated_task' method="post">
									<div class="form-group">
										<input type="hidden" name="task_id" value="<?= $task['id'] ?>">
										<input class="btn btn-primary btn-xs" type="button" name="edit" value="Edit">
										<input id="task<?= $task['id'] ?>" taskid="<?= $task['id'] ?>" class="checkbox btn-lg" type="checkbox" name="status">
										<label class="taskLabels"><?= $task['name'] ?></label>
									</div>
								</form>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<form id="updateTasks" class='form-horizontal' role="form" action="tasks/delete_completed_tasks" method="post">
							<div class="form-group">
								<input class="btn btn-success btn-small" type="submit" name="updateTasks" value="Remove Completed Tasks">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="formWrapper" class="col-sm-4">
				<form id="create" role="form-horizontal" action="/tasks/process_task" method="post">
					<div class="form-group">
						<label for="taskName">Create a New Task:</label>
					</div>
					<div class="row">
						<div id="createStatusWrapper" class="col-sm-12"></div>
					</div>
					<div class="form-group">
						<input id="taskName" class="col-sm-12" type="text" name="name" placeholder="Type a new task here...">
					</div>
					<div class="form-group">
						<input class="btn btn-primary pull-right" type="submit" name="create" value="Add Task">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>