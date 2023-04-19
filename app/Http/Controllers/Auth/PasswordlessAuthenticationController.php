<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PasswordlessAuthenticationController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
      
        $url = URL::temporarySignedRoute(
            'passwordless.authenticate', now()->addMinutes(30), ['user' => $user->id]
        );

        // Send the email with the link to the user's email address
        Mail::to($request->email)->send(new SendMail($url));

        return back()->with('status', 'A link has been sent to your email address. Please click the link login to login');
    }

    public function authenticateUser(Request $request)
    {
        $user = User::findOrFail($request->user);

        if (! URL::hasValidSignature($request)) {
            return redirect('/login')->withErrors(['url' => 'The link is invalid.']);
        }

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
}
