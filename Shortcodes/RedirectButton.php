<?php

namespace Modules\RootAccess\Shortcodes;

use Illuminate\Support\Facades\URL;

class RedirectButton
{

    public function register($shortcode, $content, $compiler, $name, $viewData)
    {

        // Definer redirect type
        $url = $shortcode->url ?? '/';

        $type = $shortcode->type ?? 'loginAsUserShortcode';

        $params = http_build_query([
            'params' => [
                "url" => $url,
                "type" => $type
            ]
        ]);



        $https = request()->secure() ? 'https://' : 'http://';

        $domain = env('DOMAIN') ?? $_SERVER['HTTP_HOST'];
        
        // Byg URL med query param
        $url =  $https . $domain . '/root-access/loginAsUser/' . $shortcode->user_id . '?' . $params;


        // Button tekst
        $text = $shortcode->text ?? ($content ?: 'Login som bruger');


        // Returner HTML-knap
        return sprintf(
            '<a href="%s" 
                target="_blank"
                style="background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; display: inline-block;">
                %s
            </a>',
            e($url),
            e($text)
        );


    }

}
