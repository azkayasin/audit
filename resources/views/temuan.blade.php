<!DOCTYPE html>
<html>
<head>
	@include('admin.template.head')
</head>
<body>

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>no</th>
					<th>temuan</th>
					<th>keterangan</th>
					<th>id kda</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($temuan as $temuan)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $temuan->name}}</td>
					<td>{{ $temuan->keterangan}}</td>
					<td>{{ $temuan->kda_id}}</td>
				</tr>
				@endforeach
			</tfoot>
		</table>
	</div>
	@include('admin.template.setting')
</body>
</html>