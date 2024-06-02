<style type="text/css">
	table td, table th{
		border:1px solid black;
	}
</style>
<div class="container">	
<h3>Registration Details</h3><br/>
    <table border="1">
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>Gender</th>
            <th>Register Date</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>PDF</th>
            <th>Edit / Delete</th>
        </tr>                
        @foreach($items as $key => $value)
        <tr>
            <td>{{ $value->name}}</td>
            <td>{{ $value->email}}</td>
            <td>{{ $value->mobile_no}}</td>
            <td>{{ $value->gender}}</td>
            <td>{{ $value->registration_date}}</td>
            <td>{{ $value->country}}</td>
            <td>{{ $value->state}}</td>
            <td>{{ $value->city}}</td>            
            <td><a href="{{route('generatePDF')}}">PDF</a></td>
            <td><a href="{{url('delete',$value->id)}}">Delete</a></td>
            <td>
          
        </tr>
        @endforeach
        </tr>
    </table>
</div>