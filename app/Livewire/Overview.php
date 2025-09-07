<?php

namespace App\Livewire;

use App\Models\Domain;
use Livewire\Component;

class Overview extends Component
{
    public array $items = [];
    public float $subtotal = 0.0;
    public float $tax = 0.0;
    public float $total = 0.0;

    public function mount()
    {
        $this->items = Domain::all()->toArray();
        $this->subtotal = array_sum(array_column($this->items, 'price'));
        $this->tax = $this->subtotal * 0.23;
        $this->total = $this->subtotal + $this->tax;
    }

    public function render()
    {
        return view('livewire.overview');
    }
}
