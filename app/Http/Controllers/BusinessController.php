<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Models\User;
use App\Repositories\Business\CompanyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BusinessController extends Controller
{

    protected $company;

    public function __construct(CompanyRegistration $company)
    {
        $this->company = $company;
    }

    public function companyRegister()
    {
        return view('company.register');
    }

    public function postCompanyRegister(Request $request)
    {
        $this->validate($request,[
           // 'companyEmail' => 'required',
        ]);

        if($request->formData['registrationType'] == 'individual') {
            $user = User::create([
                'firstName' => $request->formData['firstName'],
                'lastName' => $request->formData['lastName'],
                'email' => $request->formData['emailAddress'],
                'contactNumber' => $request->formData['contactNumber'],
                'user_type' => 'person',
                'password' => '********************'
            ]);

            Auth::login($user);

            $user->sendEmailVerificationNotification();
        }

        if($request->formData['registrationType'] == 'company') {
            $user = User::create([
                'companyName' => $request->formData['companyName'],
                'companyLocation' => $request->formData['companyLocation'],
                'contactNumber' => $request->formData['companyNumber'],
                'email' => $request->formData['companyEmail'],
                'user_type' => 'company',
                'password' => '********************'
            ]);

            Auth::login($user);
           // Mail::to( $request->formData['companyEmail'])->send(new VerifyMail());
            $user->sendEmailVerificationNotification();
        }

    }
}
