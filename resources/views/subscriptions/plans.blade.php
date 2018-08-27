@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{asset('css/pricing.css')}}">
@endpush

@section('jumbotron')
    @include('partials.jumbotron',[
        'title'=> __("Subscribete ahora a uno de nuestros planes"),
        'icon' => 'globe'
    ])
@endsection

@section('content')
    <div class="container">
        <div class="pricing-table pricing-three-column row">
            <div class="plan col-sm-6 col-lg-4">
                <div class="plan-name-bronze">
                    <h2>{{ __("MENSUAL")}}</h2>
                    <span>{{ __(":price / Mes", ['price'=> '135 MXN'])}}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{__("Acceso a todos los cursos")}}</li>
                    <li class="plan-feature">{{__("Acceso a todos los archivos")}}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            'product'=> [
                                "name" => __("Suscripción"),
                                "description" => __("Mensual"),
                                "type" => "monthly",
                                "plan"=> "prod_DTjVH9FJWpJmCV",
                                'amount'=> 13500.00
                            ]
                        ])
                    </li>
                </ul>
            </div>
            <div class="plan col-sm-6 col-lg-4">
                <div class="plan-name-silver">
                    <h2>{{ __("TRIMESTRAL")}}</h2>
                    <span>{{ __(":price / 3 Meses", ['price'=> '220 MXN'])}}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{__("Acceso a todos los cursos")}}</li>
                    <li class="plan-feature">{{__("Acceso a todos los archivos")}}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            'product'=> [
                                'name' => 'Suscripción',
                                'description' => 'Trimestral',
                                'type' => 'quarterly',
                                "plan"=> "prod_DTjXQnS0cGWG9v",
                                'amount'=> 22000.00
                            ]
                        ])
                    </li>
                </ul>
            </div>
            <div class="plan col-sm-6 col-lg-4">
                <div class="plan-name-gold">
                    <h2>{{ __("ANUAL")}}</h2>
                    <span>{{ __(":price / Mes", ['price'=> '1860 MXN'])}}</span>
                </div>
                <ul>
                    <li class="plan-feature">{{__("Acceso a todos los cursos")}}</li>
                    <li class="plan-feature">{{__("Acceso a todos los archivos")}}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            'product'=> [
                                'name'=> __("Suscripción"),
                                'description'=> __("Anual"),
                                'type'=> 'yearly',
                                "plan"=> "prod_DTjZEarrfbTSe6",
                                'amount'=> 186000.00
                            ]
                        ])
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

