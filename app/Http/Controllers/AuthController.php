<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    
    public function verifyEmail(Request $request, string $id, string $hash)
    {
        $user = User::findOrFail($id);
        $frontend = config('app.frontend_url');
        
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Enlace de verificacion invalido'], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'El email ya estaba verificado'], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect("{$frontend}/verify-email?status=success");
    }


    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return Response()->json(['message' => 'el email ya estaba verificado cv']);
        }

        $request->user()->sendEmailVerificationNotification();

        return Response()->json(['message' => 'Correo de verificacion reenviado con exito']);
    }
}
