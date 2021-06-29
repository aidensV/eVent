
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<td style="text-align: center" colspan="6">Laporan Peminjaman</td>
			</tr>
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
 