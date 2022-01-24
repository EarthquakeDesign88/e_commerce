<!doctype html>
<html>
<head>
    <title>BotMan Widget</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
</head>
<body>
    <script>
        var botmanWidget = {
            title: 'Earth shop',
            introMessage: 'Hi, Welcome to Earth shop&#127773</p>',
            aboutText: '{{ Auth::user()->username }}'
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>
</html>


