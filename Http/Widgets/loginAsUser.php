<?php

namespace Modules\RootAccess\Http\Widgets;

use Arrilot\Widgets\AbstractWidget;

class loginAsUser extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {

        return view('rootaccess::widgets.login-as-user', [
            'user' => $this->config["model"],
        ]);
        
    }
}
