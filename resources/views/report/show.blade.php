@extends('layouts.template')

@section('title', 'Employee Detail')

@section('content')
    <h3 class="heading_b uk-margin-bottom">Employee Detail</h3>

    <div class="md-card">
        <div class="md-card-toolbar">
            <h3 class="md-card-toolbar-heading-text">
                {{ $result['name'] }}
            </h3>
        </div>
        <div class="md-card-content large-padding">
            <div class="uk-grid uk-grid-divider uk-grid-medium">
                <div class="uk-width-large-1-2">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-large-1-3">
                            <span class="uk-text-muted uk-text-small">Product Name</span>
                        </div>
                        <div class="uk-width-large-2-3">
                            <span class="uk-text-large uk-text-middle"><a href="ecommerce_product_details.html#">Galaxy S6 edge</a></span>
                        </div>
                    </div>
                    <hr class="uk-grid-divider">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-large-1-3">
                            <span class="uk-text-muted uk-text-small">Manufacturer</span>
                        </div>
                        <div class="uk-width-large-2-3">
                            <span class="uk-text-large uk-text-middle">Samsung</span>
                        </div>
                    </div>
                    <hr class="uk-grid-divider">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-large-1-3">
                            <span class="uk-text-muted uk-text-small">Serial Number</span>
                        </div>
                        <div class="uk-width-large-2-3">
                            SM-G925TZKFTMB
                        </div>
                    </div>
                    <hr class="uk-grid-divider">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-large-1-3">
                            <span class="uk-text-muted uk-text-small">Internal Memory</span>
                        </div>
                        <div class="uk-width-large-2-3">
                            64GB
                        </div>
                    </div>
                    <hr class="uk-grid-divider">
                    <div class="uk-grid uk-grid-small">
                        <div class="uk-width-large-1-3">
                            <span class="uk-text-muted uk-text-small">Color</span>
                        </div>
                        <div class="uk-width-large-2-3">
                            Black
                        </div>
                    </div>
                    <hr class="uk-grid-divider uk-hidden-large">
                </div>
                <div class="uk-width-large-1-2">
                    <p>
                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Tags</span>
                        <span class="uk-badge uk-badge-success">LTE</span>
                        <span class="uk-badge uk-badge-primary">Quad HD</span>
                        <span class="uk-badge uk-badge-success">Android™ 5.0</span>
                        <span class="uk-badge uk-badge-success">64GB</span>
                    </p>
                    <hr class="uk-grid-divider">
                    <p>
                        <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Description</span>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam necessitatibus suscipit velit voluptatibus! Ab accusamus ad adipisci alias aliquid at atque consectetur, dicta dignissimos, distinctio dolores esse fugiat iste laborum libero magni maiores maxime modi nemo neque, nesciunt nisi nulla optio placeat quas quia quibusdam quis saepe sit ullam!
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/employee.js') }}"></script>
@endpush