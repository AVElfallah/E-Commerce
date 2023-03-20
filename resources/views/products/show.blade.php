@extends('dashboard.master')

@section('content')
    <div class="container mt-4">
        <div class="card p-4">
            <div class="row">
                <div class="col-md-6">
                    <div
                        style="height:25rem;background-size: contain;
                    background-repeat: no-repeat;background-image: url({{ asset($product->attachmentRelation[0]->path) }});">
                    </div>
                </div>
                <div class="col-md-6 align-self-center">
                    <p style="color: #0F898E; font-weight: 600">{{ $product->category->name }}</p>
                    <h4>{{ $product->title }}</h4>
                    <div class="d-flex">

                        @foreach ($product->productColors as $color)
                            <p
                                style="margin-right:2%;width:30px; height: 30px;border-radius: 50%; background-color: {{ $color->color->code }}">
                            </p>
                        @endforeach

                    </div>
                    <div class="d-flex mt-3">
                        @foreach ($product->productSizes as $size)
                            <p style="margin-right:2%;color: #0F898E; font-weight: 600">{{ $size->size->size }}</p>
                        @endforeach
                    </div>
                    <div class="d-flex">
                        <span style="text-decoration: line-through;margin-right: 2%">{{ $product->price }} &nbsp;EGP</span>
                        <span style="margin-right: 2%;color:#000;font-weight: 700">{{ $product->price_after_tax }}
                            &nbsp;EGP</span>
                        <span style="margin-right: 2%">+{{ $product->price_after_tax }} &nbsp;EGP</span>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane"
                    type="button" role="tab" aria-controls="description-tab-pane"
                    aria-selected="true">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review-tab-pane"
                    type="button" role="tab" aria-controls="review-tab-pane" aria-selected="false">Review</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                aria-labelledby="description-tab" tabindex="0">
                <p>
                    {{ $product->description }}
                </p>
            </div>
            <div class="tab-pane fade" id="review-tab-pane" role="tabpanel" aria-labelledby="review-tab" tabindex="0">
                @foreach ($reviews as $review)
                    @php
                        $rating = $review->rate;
                    @endphp
                    <div class="review">
                        <div class="d-flex">
                            <div class="person-image">
                                <img src="@/assets/img/Frame 440.png" class="img-fluid" alt="">
                            </div>
                            <div class="person-details">
                                <h3 class="name">Ahmed Elsolya</h3>
                                <p class=" date">20/1/2023</p>
                            </div>
                        </div>
                        <div class="rate">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <span class="text-muted float-right">
                                        <i class="fa fa-star" style="color:gold;"></i>
                                    </span>
                                @else
                                <span class="text-muted float-right">
                                    <i class="fa fa-star" style="color:#ddd;"></i>
                                </span>
                                @endif
                            @endfor
                        </div>
                        <p style="clear:both">{{ $review->review }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
