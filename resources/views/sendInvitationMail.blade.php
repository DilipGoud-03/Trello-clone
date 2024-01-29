<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h2>This is mail for invited on board</h2>
    <p> Hello : {{$mailData['name']}}</p>
    <p> Mr. {{$mailData['invited_by']}} is invite on board : {{$mailData['board']}}</p>
    <p>as Role <b> {{$mailData['role']}}</b></p>
    <p> Click bellow to accept or reject invitation </p>
    <a href="{{ route('userAcceptInvitation',$mailData['token']) }}"><button type="sbumit" class="btn btn-primary">Accept</button></a>
    <a href="{{ route('userRejectInvitation',$mailData['token']) }}"><button type="sbumit" class="btn btn-danger">Reject</button></a>
</body>

</html>