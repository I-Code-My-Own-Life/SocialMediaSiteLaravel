<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

class AutocompleteSearch extends Component
{
    public $search = '';

    public function render()
    {
        $users = [];
        if(!($this->search == '')){
            $users = User::with('profile')->where('name', 'LIKE', '%' . $this->search . '%')->take(5)->get();
        }
        
        return view('livewire.autocomplete-search',compact('users'));
    }
}
