<?php
// app/Http/Controllers/Auth/InviteController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\SignupInvitation;

class InviteController extends Controller
{
    public function send(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $url = URL::temporarySignedRoute(
            'invite.register',
            now()->addDay(),
            ['email' => $request->email]
        );

        Mail::to($request->email)->send(new SignupInvitation($url));

        return back()->with('status', 'Invite sent!');
    }
}