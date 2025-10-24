<h3>Hello {{ $user->name }},</h3>
<p>Thank you for registering. Please verify your email by clicking the link below:</p>
<a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>