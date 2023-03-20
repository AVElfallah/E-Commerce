<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductIndex extends Component
{
    public $search = '';

    public function render()
    {
        $products = Product::where('title', 'LIKE', '%' . $this->search . '%')->get();

        return view('livewire.product-index', ['products' => $products]);
    }
}
