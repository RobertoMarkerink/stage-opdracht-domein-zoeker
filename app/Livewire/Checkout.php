<?php

namespace App\Livewire;

use App\Models\Domain;
use Livewire\Component;

class Checkout extends Component
{
    public array $items = [];
    public float $subtotal = 0.0;
    public float $tax = 0.0;
    public float $total = 0.0;
    public bool $orderFinished = false;

    public function mount()
    {
        $this->items = session()->get('items', []);
        $this->subtotal = array_sum(array_column($this->items, 'price'));
        $this->tax = $this->subtotal * 0.23;
        $this->total = $this->subtotal + $this->tax;
    }

    public function render()
    {
        return view('livewire.checkout');
    }

    public function finishOrder()
    {
        foreach ($this->items as $item) {
            Domain::create([
                'domain' => $item['domain'],
                'price' => $item['price'],
            ]);
        }

        $this->orderFinished = true;
        session()->forget('items');
    }
}
