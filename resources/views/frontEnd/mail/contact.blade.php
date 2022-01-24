<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enquiry mail</title>
  
</head>
<body>
    <div class="container">
        <h3>New Enquiry mail</h3>
        <p>From Khun' {{ $contact['full_name'] }}</p>
        <p>Email: {{ $contact['email'] }}</p>
        <br>
        <p>Subject: {{ $contact['subject'] }}</p>
        <p>Message: {{ $contact['message'] }}</p>
        <br>

        <p>Best Regards,</p>
        <p>{{ $contact['full_name'] }} </p>      
      
    </div>


</body>
</html>

