<?php

namespace App\Http\Livewire\Sizes;

use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;

class SizeIndex extends Component
{
    public $size, $size_id;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function rules()
    {
        return [
            'size' => 'required',
        ];
    }

    public function resetInput()
    {
        $this->size = null;

    }

    public function store()
    {
        $ValidatedData = $this->validate();
        Size::create([
            'size' => $this->size,
        ]);
        session()->flash('message', 'Service added successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function render()
    {
        $sizes = Size::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.sizes.size-index', ['sizes' => $sizes]);
    }
}