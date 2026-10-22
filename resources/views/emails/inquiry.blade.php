<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Inquiry</title>
</head>
<body>
    <h2>New {{ isset($project_name) && $project_name ? 'Property' : 'Contact' }} Inquiry</h2>
    <p><strong>Name:</strong> {{ $name }}</p>
    @if(isset($company) && $company)
        <p><strong>Company:</strong> {{ $company }}</p>
    @endif
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>
    @if(isset($project_name) && $project_name)
        <p><strong>Project Name:</strong> {{ $project_name }}</p>
    @endif
    @if(isset($user_message) && $user_message)
        <p><strong>Message:</strong></p>
        <p>{{ $user_message }}</p>
    @endif
</body>
</html>
