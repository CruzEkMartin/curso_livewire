<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Main extends Component
{
    public $welcome = "Bienvenid@, estas son tus tareas";

    // se declara un listener para cada que se guarde un registro desde el componente Task, se lance el método taskSaved 
    protected $listeners = [
        'taskSaved'
    ];

    public function taskSaved($message)
    {
        session()->flash('message', $message);
    }

    public function render()
    {
        return view('livewire.main');
    }
}
