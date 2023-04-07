<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordlessLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PasswordlessLoginController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('auth.login');
    // }

    public function sendMagicLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
      
        $url = URL::temporarySignedRoute(
            'passwordless.authenticate', now()->addMinutes(30), ['user' => $user->id]
        );


        // Send the email with the magic link to the user's email address
        Mail::to($request->email)->send(new PasswordlessLogin($url));

        return back()->with('status', 'A magic link has been sent to your email address.');
    }

    public function authenticate(Request $request)
    {
        $user = User::findOrFail($request->user);

        if (! URL::hasValidSignature($request)) {
            return redirect('/login')->withErrors(['url' => 'The magic link is invalid.']);
        }

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
