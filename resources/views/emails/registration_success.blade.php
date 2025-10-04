<!DOCTYPE html>
<html>
<head>
    <title>Registration Success</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}!</h2>
    <p>Congratulations! Your registration for <strong>{{ $company->name }}</strong> has been successful.</p>
    <p>Your account email: <strong>{{ $user->email }}</strong></p>
    <p>Thank you for joining our Expense Management System!</p>
    <br>
    <p>Regards,<br>Expense Management Team</p>
</body>
</html>
