
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
        <h3>Registration Form</h3><br/>
        <form id="registrationForm" method="POST" action="{{route('create')}}">
            @csrf
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Enter Name" />
            <br/>
            <br/>
            <label>Email</label>
            <input type="text" name="email" placeholder="Email" />
            <br/>
            <br/>
            <label>Mobile No</label>
            <input type="text" name="mobile" id="mobile" placeholder="Enter No"/>
            <br><br>
            <label for="gender">Gender  </label>
            <label for="gender">male:</label>
            <input type="radio" name="gender" value="male" />
            <label for="gender">female:</label>
            <input type="radio" name="gender" value="female" />
            <br><br>            
            <label>Registration Date</label>
            <input type="date" name="date"  />
            <br/>
            <br/>
            <label>Country</label>
            <select name="country" id="country">
            <option value="">Select Country</option>
            @foreach ($countries as $data)
            <option value="{{$data->id}}">
                {{$data->name}}
            </option>
            @endforeach
          </select>
            <br><br>            
            <label>State</label>
            <select name="state" id="state">
            </select>
            <br><br>
            <label>City</label>
            <select name="city" id="city">
            </select>
            <br><br>
            <button type="submit">Submit</button>
        </form>
    </center>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').validate({
                rules:{
                    email : {
                        required: true,
                        email:true,
                    },
                    mobile : {
                        required: true,
                        maxlength:10
                    },
                },
                message:{
                    number : "testing",
                }
            });

            $('#country').on('change', function () {
                var idCountry = this.value;
                $("#state").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state').html('<option value="">Select State</option>');
                        $.each(result.states, function (key, value) {
                            $("#state").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state').on('change', function () {
                var idState = this.value;
                $("#city").html('');
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</html>