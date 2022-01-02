<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $show = '';
    public $search = '';
    
 
    public function increment()
    {
        $this->count++;
    }
    public function show()
    {
        $this->show = 'NIGGA!';
    }
 
    public function render()
    {
        return view('livewire.counter', [
            'nati' => User::where('name', $this->search)->get(),
        ]);
    }
}