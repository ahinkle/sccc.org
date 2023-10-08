<x-mail::message>
# New Newsletter Subscriber Request: {{ $newsletterContact->email }}

A new subscriber has just verified their email address to receive our newsletter!

Here are the details:

Name: {{ $newsletterContact->name }}

Email: {{ $newsletterContact->email }}

Please take a moment to manually add this subscriber to our newsletter distribution list. We want to ensure they start receiving our updates promptly.

This is an automated message - If you find the submissions to be inappropriate or higher spam than normal, please contact the Site Administrator (Andy Hinkle) at andy@sccc.org.

</x-mail::message>
