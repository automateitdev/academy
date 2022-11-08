
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload='document.forms[0].submit()'>
    <form name='PostForm' method='GET' action='https://spg.sblesheba.com:6313/SpgLanding/SpgLanding/{{$sessiontoken['session_token']}}'/'>
        @csrf
    </form>

</body>
</html>