<?php

namespace App\Livewire;

use Livewire\Component;

class HomeSearch extends Component
{
    public string $location = '';

    public string $service = '';

    /**
     * @var array<int, string>
     */
    public array $serviceOptions = [];

    /**
     * @param  iterable<int, string>  $serviceNames
     */
    public function mount(iterable $serviceNames = []): void
    {
        $this->serviceOptions = collect($serviceNames)
            ->filter(fn ($name): bool => is_string($name) && $name !== '')
            ->values()
            ->all();
    }

    public function search(): void
    {
        $this->redirect(route('customer.services', array_filter([
            'lokasi' => trim($this->location),
            'layanan' => $this->service,
        ])), navigate: true);
    }

    public function render()
    {
        return view('livewire.home-search');
    }
}
