<?php

namespace App\Livewire\Module\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class SetPassword extends Component
{
    public string $identifiant;
    public string $password;

    //Upload datas
    public function mount()
    {
        $myId = Auth::user();
        $this->name = $myId->name;
        $this->identifiant = $myId->identifiant;
    }

    //Submit new datas
    public function submitData(Request $request)
    {

        $myId = Auth::user();

        if($this->password == '')
        {
            $myId->update([
                'identifiant' => $this->identifiant,
            ]);
        }
        else
        {
            $myId->update([
                'identifiant' => $this->identifiant,
                'password' => Hash::make($this->password),
            ]); 
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login',)->with('status', "Connectez-vous avec les nouvelles identifiants");
    }
    public function render()
    {
        return view('livewire.module.user.set-password');
    }
}
