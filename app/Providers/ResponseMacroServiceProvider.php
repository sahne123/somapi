<?php

namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function register()
    {
        Response::macro('build', function($data, $status, $error=false)
        {
          if(!is_array($data))
            $data = [];

          $data = array_merge($data, [
            'status_code' => (int)$status,
            'error' => $error,
          ]);

          return response()
                  ->json($data, (int)$status)
                  ->header('Access-Control-Allow-Origin', '*')
                  ->header('Content-Type', 'application/json');
        });
    }

}
