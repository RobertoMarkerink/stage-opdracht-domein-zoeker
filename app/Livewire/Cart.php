<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
    public array $items = [];

    public function mount()
    {
        $this->items = session()->get('items', []);
    }

    public function render()
    {
        return view('livewire.cart');
    }

    #[On('itemAddedToCart')]
    public function addItem($domain, $price)
    {        
        $this->items[$domain] = ['domain' => $domain, 'price' => $price];
        session()->put('items', $this->items);
    }

    public function removeFromCart(string $key)
    {
        $this->dispatch('restoreDomain', $key);
        unset($this->items[$key]);
        session()->put('items', $this->items);
    }
}
