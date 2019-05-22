<!DOCTYPE html>
<html>
<head>
	<title>server-side</title>
	<base href="<?php echo base_url(); ?>"/>
	<link rel="stylesheet" type="text/css" href="./assets/css/jquery.dataTables.min.css">
	<script src="./assets/js/jquery.min.js"></script>
	<script src="./assets/js/jquery.dataTables.min.js"></script>
</head>
<body>

	<table id="example" class="display" style="width:100%"> 
		<thead> 
			<tr> 
				<th>First name</th> 
				<th>Last name</th> 
				<th>Username</th> 
				<th></th> 
			</tr> 
		</thead> 
	</table>

</body>

<script type="text/javascript">

	$('#example').DataTable({
		processing: true,
		serverSide: true,
		ajax: {
			url: 'account/marco_ssp',
			type: 'post',
			error: function(err){
				console.log(err);
			}
		},
		columns: [
			{ data: 'first_name' },
			{ data: 'last_name' },
			{ data: 'user_name' },
		],
		columnDefs: [
			{
				targets: 3,
				className: 'input-group-btn',
				render: function(data, type, row){
					button  = `<button value="${row['user_id']}"><i class="fa fa-eye"></i></button>`;
					button += `<button value="${row['user_id']}"><i class="fa fa-pencil"></i></button>`;
					button += `<button value="${row['user_id']}"><i class="fa fa-remove"></i></button>`;
					return button;
				}
			}
		]
	});

</script>

</html>