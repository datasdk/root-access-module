<?php

namespace Modules\RootAccess\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RootAccessController extends Controller
{
    /**
     * Redirect og log ind som anden bruger (impersonation)
     */
    public function loginAsUserRedirect(Request $request, int $id)
    {

        // Indstillinger fra .env
        $https  = filter_var(env('HTTPS', false), FILTER_VALIDATE_BOOLEAN);
        $domain = env('MAIN_DOMAIN', 'localhost');


        // Hent params fra query (?params[foo]=bar)
        $params = $request->query('params', []);


        if (!is_array($params)) {
            $params = [];
        }

        // Login / impersonation
        $result = $this->login($id);


        // Byg query (lad http_build_query encode alt korrekt)
        $query = array_merge(
            $params,
            [
                'name'  => $request->query('name'),
                'token' => $result['token'], 
            ]
        );

        // Fjern null-værdier
        $query = array_filter($query, fn ($v) => !is_null($v));


        // Byg URL
        $url = ($https ? 'https://' : 'http://')
            . $domain
            . '/auth/autologin?'
            . http_build_query($query);


        return redirect()->away($url);

    }

    
    /**
     * API-login som anden bruger (uden redirect)
     */
    public function loginAsUser(Request $request, int $id)
    {
        return $this->login($id);
    }

    /**
     * Udfører selve impersonation-login
     */
    private function login(int $id)
    {
        $authUser = Auth::user();

        // Kun admin må impersonere
        if (!$authUser || !$authUser->hasRole('admin')) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        // Find bruger
        $user = User::findOrFail($id);

        // Generér token
        $token = $user->createToken('RootAccessToken')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
