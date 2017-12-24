<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="#">Groups</a></li>
			<li><a href="#">Create a Group</a></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-search"></i>
					<span>Create a Group</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">
				<form class="form-horizontal" role="form" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label">Group Title</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" placeholder="Group Title" data-toggle="tooltip" data-placement="bottom" title="Title/Name of group" required="required" name="group_title">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="form-styles">Members Email Addresses</label>
						<div class="col-sm-10">
								<textarea class="form-control" rows="5" id="wysiwig_simple" placeholder="Use semicolon (;) to separate multiple email addresses" required="required" name="member_emails"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary btn-label-left" name="create_group">
								<span><i class="fa fa-clock-o"></i></span>Submit
							</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>
</div>
