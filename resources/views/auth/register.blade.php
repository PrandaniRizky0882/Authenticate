<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
        <form action="{{ route('register.action')}}" method="POST">
        @csrf
        <input type="text"      name="name" placeholder="nama">
        <input type="text"      name="username" placeholder="username">
        <input type="text"      name="telp" placeholder="nomor HP">
        <input type="password"  name="password" placeholder="password">
        <input type="submit"    name="login" value="Daftar">
        </form>
</body>
</html>