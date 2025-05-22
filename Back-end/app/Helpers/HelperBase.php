<?php

if (!function_exists('createTokenCookie')) {
    function createTokenCookie($token, $expiresIn)
    {
        return cookie(
            'access_token',
            $token,
            $expiresIn,
            '/',
            config('session.domain'),
            config('session.secure'),
            true,  // HttpOnly
            false, // Cross-site allowed
            config('session.same_site')
        );
    }
}
