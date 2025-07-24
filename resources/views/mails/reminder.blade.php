<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder</title>
</head>
<body>
    <h1>Pengingat: {{ $event->judul }}</h1>
    <p>Event ini akan berlangsung pada {{ $event->tanggal_formatted }}.</p>
    <p>Deskripsi: {{ $event->deskripsi }}</p>
    <p>Harap bersiap untuk menghadiri event ini!</p>
    <p>Terima kasih,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>