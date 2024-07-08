<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SendOtpMail;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            if ($user->otp_verified === 'false') {
                return redirect()->route('otp.verify');
            } elseif ($user->hasRole('admin')) {
                return redirect(route('admindashboard'));
            } elseif ($user->hasRole('user')) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
    
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if(Auth::check())
        {
            $user = Auth::user();
            if ($user->otp_verified=='false') {
                $otp = mt_rand(100000, 999999);
                $user->otp = $otp;
                $user->otp_verified = 'false'; // Set otp_verified to false
                $user->save();
                $email = $request->email;
                $maildata = \getMailableData(new SendOtpMail($otp));
                $maildata['to'] = $email;
                $response = sendRemoteMail($maildata);
                
                if($response['status']=='success'){
                    $message = 'An OTP has been sent to your email. Please check your inbox and enter the OTP to complete the verification.';
                }
                else{
                     $message = 'Unable to send OTP.';
                }
                //Mail::to($email)->send(new SendOtpMail($otp));
                return redirect()->route('otp.verify')->with('message', $message);
            }
            else {
                // User is already verified, redirect to the appropriate page based on their role
                if ($user->hasRole('admin')) {
                    return redirect(route('admindashboard'));
                } elseif ($user->hasRole('user')) {
                    return redirect()->intended(RouteServiceProvider::HOME);
                }
            }

        }
   

    }
    public function showOtpVerificationForm()
    {
        $user = Auth::user();

        if ($user && $user->otp_verified === 'false') {
            return view('auth.otp-verify');
        } elseif ($user && $user->otp_verified === 'true') {
            if ($user->hasRole('admin')) {
                return redirect()->route('admindashboard');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('dashboard');
            }
        }
    
        return redirect('/');
    }
    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);
    
        $user = Auth::user();
        
        if ($request->otp == $user->otp) {
            $user->otp_verified = 'true';
            $user->save();
            
            if ($user->hasRole('admin')) {
                return redirect(route('admindashboard'));
             }
            elseif ($user->hasRole('user')) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
        
        return back()->withErrors(['otp' => 'Invalid OTP']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user->otp = null;
        $user->otp_verified = 'false';
        $user->save();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
