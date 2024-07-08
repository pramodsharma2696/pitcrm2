<?php

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\URL;

if (!function_exists('getMailableData')) {
    /**
     * Extract subject and body from a mailable
     *
     * @param Mailable $mailable
     * @return array
     */
    function getMailableData($mailable)
    {
        // Build the Mailable object
        $mailable->build();

        // Get subject
        $subject = $mailable->subject;

        // Render the Mailable as a string
        $body = $mailable->render();

        return compact('subject', 'body');
    }
}

if (!function_exists('sendRemoteMail')) {

    function sendRemoteMail($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://34.126.103.185/EmailApi/index.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($data),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic Y3JtdXNlcjpzZGZ2aGl1ZWZod2VmOHdpZnV3ZWlmZXdpZWU='
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response,true);

    }
}


if (!function_exists('generateResetLink')) {

    function generateResetLink($email)
    {
        // Step 1: Generate the Token and URL
        $user = User::where('email', $email)->first();
        if (!$user) {
            return false;
        }
        $token   = Password::createToken($user);
        $url     = url(config('app.url') . route('password.reset', ['token' => $token, 'email' => $user->email], false));
        $subject = Lang::get('Reset Password Notification');
        // Step 2: Construct the MailMessage
        $mailMessage = (new MailMessage)
            ->subject($subject)
            ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
            ->action(Lang::get('Reset Password'), $url)
            ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
            ->line(Lang::get('If you did not request a password reset, no further action is required.'));

        // Step 3: Render the Message as String (rudimentary example)
        $emailBodyAsString = "";
        foreach ($mailMessage->introLines as $line) {
            $emailBodyAsString .= $line . "<br/>";
        }
        $button            = '<a href="' . $mailMessage->actionUrl . '" style="background-color: #1F2937; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer; width: 100%; text-align: center;">' . $mailMessage->actionText . '</a>';
        $emailBodyAsString .= "<br/> $button <br/><br/><br/>";
        foreach ($mailMessage->outroLines as $line) {
            $emailBodyAsString .= $line . "<br/>";
        }
        $to   = $email;
        $body = $emailBodyAsString;
        return compact('to', 'subject', 'body');
    }

}

