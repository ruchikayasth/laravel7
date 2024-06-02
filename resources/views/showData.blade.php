<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    label.error {
         color: #dc3545;
         font-size: 14px;
    }
</style>
</head>
<body>
    <center>
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
        @foreach($register as $key => $value)
        <tr>
            <td>{{ $value->name}}</td>
            <td>{{ $value->email}}</td>
            <td>{{ $value->mobile_no}}</td>
            <td>{{ $value->gender}}</td>
            <td>{{ $value->registration_date}}</td>
            <td>{{ $value->country}}</td>
            <td>{{ $value->state}}</td>
            <td>{{ $value->city}}</td>            
            <td><a href="{{ route('pdfview',['download'=>'pdf']) }}">PDF</a></td>
            <td><a href="{{url('delete',$value->id)}}">Delete</a></td>
            <td>
          
        </tr>
        @endforeach
        </tr>
    </table>
</center>
</body>
</html>