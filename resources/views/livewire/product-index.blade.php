<div class="container mt-3">

    <div class="card">
        <div class="card-header">
            <h3>{{ __('dashboard.products') }}</h3>
                <a href="{{ route('products.create') }}" class="btn btn-primary float-end btn-sm text-white  ">{{ __('dashboard.add') }}</a>


            </h3>
        </div>
        <div class="table-responsive text-nowrap">
                    <input type="search" wire:model="search" class="form-control float-end mx-10" placeholder="Search..."
            style="width: 230px; margin-bottom:10px;" />

            <table class="table text-center">
                <thead>
                    <tr>
                        <th>{{ __('dashboard.title') }}</th>
                        <th>{{ __('dashboard.quantity') }}</th>
                        <th>{{ __('dashboard.category') }}</th>
                        <th>{{ __('dashboard.price') }}</th>
                        <th>{{ __('dashboard.discount') }}</th>
                        <th>{{ __('dashboard.priceafterdiscount') }}</th>
                        <th>{{ __('dashboard.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                    @forelse($products as $product)
                    @include('products.modal')
                        <tr>
                            <td> {{ $product->title }} </td>
                            <td> {{ $product->quantity }} </td>
                            <td> {{ $product->category->name }} </td>
                            <td> {{ $product->price }} </td>
                            <td> {{ $product->tax }} </td>
                            <td> {{ $product->price_after_tax }} </td>
                           <td><a class="btn btn-sm round btn-outline-primary"
                            href="{{ route('products.edit', $product->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i></i>
                        </a>

                        <a class="btn btn-sm round btn-outline-primary"
                            href="{{ route('products.show' ,$product->id ) }}"><i
                                class="fa-solid fa-bars"></i></i>
                        </a>
                        <span class="btn btn-sm round btn-outline-danger" data-id={{ $product->id }}
                            class="btn btn-danger delete" data-bs-toggle="modal" data-bs-target="#basicModa3"><i
                                class="fa-solid fa-trash"></i></span>
                    
                    </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7">No Data</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>