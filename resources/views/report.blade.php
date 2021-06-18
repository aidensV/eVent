<html>
<head>
	<title>{{$title}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>{{$title}}</h4>
		
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Nama</th>
				<th>Jurusan</th>
				<th>Corrective</th>
				<th>Preventive</th>
			</tr>
		</thead>
		<tbody>
			
			@foreach($reports as $key => $report)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{\Carbon\Carbon::parse($report->date)->format('d/m/Y')}}</td>
				<td>{{$report->user->name}}</td>
				<td>{{$report->user->prodis->name}}</td>
				<td>{{$report->corrective}}</td>
				<td>{{$report->preventive}}</td>
			
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>