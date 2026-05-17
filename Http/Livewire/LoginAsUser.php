<?php

namespace Modules\RootAccess\Http\Livewire;

use Livewire\Component;


class LoginAsUser extends Component
{

    public int $user_id;
    
    public string $name = 'login';

    public array $params = [];



    public function mount($user_id, $name = 'login', $params = [])
    {

        $this->user_id = (int)$user_id;

        $this->name = $name;

        $this->params = $params ?? [];

    }


    public function render()
    {

        return view('rootaccess::livewire.login-as-user');

    }

    
}
