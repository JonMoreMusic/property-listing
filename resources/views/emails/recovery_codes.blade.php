<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery Codes</title>
</head>
<body>
<div style="font-family: Arial, sans-serif;">

    <h1 style="color: #333;">Recovery Codes</h1>

    <p>Here are your recovery codes:</p>

    <ul>
        @foreach ($recoveryCodes as $code)
            <li>{{ $code }}</li>
        @endforeach
    </ul>

    <p>This email was sent to you as part of the two-factor authentication setup process.</p>

    <p>Thanks,<br>{{ config('app.name') }}</p>

</div>
</body>
</html>
