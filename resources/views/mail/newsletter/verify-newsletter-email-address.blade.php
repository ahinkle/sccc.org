<x-mail::message>
# Verify Your Email Address

Dear {{ $newsletterContact->name }},

We're thrilled to have you as a part of our church community, and we're excited to keep you updated with the latest news, events, and messages from our congregation.

To ensure you receive our newsletters promptly, please take a moment to verify your email address by clicking the button below:

<x-mail::button url="{{ route('newsletter.verify') }}?email={{ $newsletterContact->email }}&token={{ $newsletterContact->token }}">
Verify Email Address
</x-mail::button>

By confirming your email, you'll stay connected with us and receive timely updates on our upcoming events, inspirational sermons, and community outreach initiatives.

We value your presence in our church family, and we're grateful for the opportunity to share our journey of faith together. If you have any questions or need further assistance, feel free to reach out to us at office@sccc.org.

</x-mail::message>
