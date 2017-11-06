<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Mensaje recibido</title>
    </head>
    <body>
        <h1>Te responderemos pronto</h1>
        <p>
            Nombre: {{ $msg->nombre }}<br>
            Email: {{ $msg->email }}<br>
            Message: {{ $msg->mensaje }}<br>
        </p>
    </body>
</html>
