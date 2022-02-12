{{-- Hello {{$email}}
Thank You for create an account please verify your email using this link:
{{route('verify',$user->verification_token)}} --}}

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reset Password</title>
</head>
<body>
    Your Reset Password 4 digit unique id  is : <b>{{$uniqueId}}</b>
    
</body>
</html>
