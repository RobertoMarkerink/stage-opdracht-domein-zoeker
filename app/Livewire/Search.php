<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Search extends Component
{
    public string $query = '';
    public array $results = [];
    public string $api_token = 'Basic 072dee999ac1a7931c205814c97cb1f4d1261559c0f6cd15f2a7b27701954b8d';
    public string $api_url = 'https://dev.api.mintycloud.nl/api/v2.1';
    public string $api_route = '/domains/search?with_price=true';
    private array $tlds = ['nl','com','eu','org','net','info','shop','online','amsterdam','business','blog','site','pro','academy','design','tech','store','dev','services','world'];

    private function fetchResults() : array {
        $url = sprintf('%s%s', $this->api_url, $this->api_route);
        $body = collect($this->tlds)
            ->map(fn($tld) => ['name' => Str::before($this->query, '.'), 'extension' => $tld])
            ->toArray();
        $response = Http::withHeaders(['Authorization' => $this->api_token])->post($url, $body)->json();
        $sessionItems = session()->get('items', []);
        
        return collect($response)
        ->filter(fn($item) => $item['status'] === 'free')
        ->mapWithKeys(function($value, $key) use ($sessionItems) {
            return [
                $value['domain'] => [
                    'domain' => $value['domain'],
                    'price' => data_get($value, 'price.product.price'),
                    'added_to_cart' => isset($sessionItems[$value['domain']])
                ]
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.search');
    }

    public function updatedQuery()
    {
        $this->results = $this->fetchResults();
    }

    public function addToCart(string $key)
    {
        $this->results[$key]['added_to_cart'] = true;
        $result = $this->results[$key];
        
        $this->dispatch('itemAddedToCart', $result['domain'], $result['price']);
    }

    #[On('restoreDomain')]
    public function restoreDomain(string $domain)
    {
        if (isset($this->results[$domain])) {
            $this->results[$domain]['added_to_cart'] = false;
        }
    }
}
