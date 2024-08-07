<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Snowboard;

class Create extends Component
{   
    public $name;
    public $price;
    public $description;

    protected $rules = [
        'name' => 'required|min:6',
        'price' => 'required',
        'description' => 'required|min:5|max:255',
    ];

    protected $messages = [
        'name.required' => 'Il titolo è richiesto',
        'name.min' => 'Il titolo deve essere di almeno 6 caratteri',
        'price.required' => 'Il prezzo è richiesto',
        'description.required' => 'La descrizione è richiesta',
        'description.min' => 'La descrizione deve essere lunga almeno 5 caratteri',
        'description.max' => 'La descrizione non può superare i 255 caratteri',
    ];

    public function store()
    {
        $this->validate();

        Snowboard::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ]);

        $this->reset();
        session()->flash('status', 'Articolo Aggiunto');;
    }

    public function sort()
    {
        return Snowboard::orderBy('price');
    }

    public function render()
    {
        return view('livewire.create');
    }
}
