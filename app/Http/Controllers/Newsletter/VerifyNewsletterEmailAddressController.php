<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Models\NewsletterContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyNewsletterEmailAddressController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $newsletterContact = NewsletterContact::where('token', $request->token)
            ->where('email', $request->email)
            ->firstOrFail();

        if ($newsletterContact->email_verified_at) {
            return redirect('/');
        }

        $newsletterContact->update([
            'email_verified_at' => now(),
        ]);

        return redirect('/')->with('modal', [
            'title' => 'Email Address Verified',
            'body' => 'Thank you for verifying your email address. You\'re all set to receive our newsletter!',
        ]);
    }
}
