<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTwoFactorCodesMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isNull;

// Import ValidationException

class TwoFactorAuthenticationController extends Controller
{
  //  public function showTwoFactorChallengeForm()
  //  {
        // Dispatch the job to send the email containing the recovery codes


 //       $userId = session('login.id');

//        $user = User::find($userId);

//        $user = session::get('login.user');
//        dd($user);*/
//        ProcessTwoFactorCodesMail::dispatch($user);

//        return view('auth.two-factor-challenge');
//    }

    public function checkTwoFactorAuthentication(Request $request): \Illuminate\Http\RedirectResponse
    {

        $userId = session('login.id');

        $user = User::find($userId);

        if( isNull(($user->recoverycodes()))){
            dd('dashboard');
            return redirect()->route('dashboard');
        }

        ProcessTwoFactorCodesMail::dispatch($user);


        if (!$this->isValidTwoFactorCode($user, $request->code)) {
            throw ValidationException::withMessages(['code' => 'Invalid authentication code provided.']);
        }

       // Update the user's record to indicate 2FA is enabled
        Auth::user()->update(['two_factor_confirmed_at' => now()]);

        return redirect()->route('dashboard')->with('status', 'Two-factor authentication enabled successfully.');
    }

    // Custom method to validate the two-factor authentication code
    protected function isValidTwoFactorCode($user, $code): bool
    {

        $recoveryCodes = $user->recoveryCodes();

        foreach ($recoveryCodes as $recoveryCode) {
            if ($code === $recoveryCode) {
                return true; // Code matches one of the recovery codes
            }
        }

        return false; // Code does not match any of the recovery code

    }
}


