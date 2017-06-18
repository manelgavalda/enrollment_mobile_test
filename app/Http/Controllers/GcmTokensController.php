<?php

namespace Manelgavalda\EnrollmentMobileTest\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Manelgavalda\EnrollmentMobileTest\Notifications\GcmTokenCreated;

/**
 * Class GcmTokensController.
 *
 * @package ManelGavalda\TodosBackend\Http\Controllers
 */
class GcmTokensController extends Controller
{
    /**
     * Add gcm token to user.
     */
    public function addToken(Request $request)
    {
        $user = $request->user();
        $token = $user->gcmTokens()->firstOrCreate([
            'registration_id' => $request->input('registration_id')
        ]);
        //Broadcast
        broadcast(new GcmTokenCreated($user,$token))->toOthers();
        return ['status' => 'Token saved!'];
    }
}