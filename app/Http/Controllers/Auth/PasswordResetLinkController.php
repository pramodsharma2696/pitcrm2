<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        return $status == Password::RESET_LINK_SENT
//                    ? back()->with('status', __($status))
//                    : back()->withInput($request->only('email'))
//                            ->withErrors(['email' => __($status)]);

        $email = $request->get('email');
        $data = generateResetLink($email);
        if (!$data) {
            return back()->withInput($request->only('email'))->withErrors(['email' => __(Password::INVALID_USER)]);
        }
        $response = sendRemoteMail($data);

        if ($response['status'] == 'success') {
            return back()->with('status', __(Password::RESET_LINK_SENT));
        } else {
            return back()->withInput($request->only('email'))->withErrors(['email' => __(Password::INVALID_USER)]);
        }
    }
}
