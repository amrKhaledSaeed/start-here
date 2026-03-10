<?php

declare(strict_types=1);

namespace App\Livewire\Store;

use App\Data\Product\ProductListData;
use App\Services\Store\StorefrontService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.store')]
class HomePage extends Component
{
    use WithPagination;

    #[Url(as: 'search')]
    public ?string $search = null;

    #[Url(as: 'category')]
    public ?string $category = null;

    #[Url(as: 'sort')]
    public string $sort = 'relevance';

    #[Url(as: 'per_page')]
    public int $perPage = 12;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->search = null;
        $this->category = null;
        $this->sort = 'relevance';
        $this->perPage = 12;
        $this->resetPage();
    }

    public function render(
        StorefrontService $storefrontService,
    ): View {
        $listingData = ProductListData::fromArray([
            'search' => $this->search,
            'category' => $this->category,
            'sort' => $this->sort,
            'per_page' => $this->perPage,
        ]);
        $resolvedUser = auth()->check() ? user() : null;

        return view('store.home', $storefrontService->home($listingData, $resolvedUser));
    }
}
