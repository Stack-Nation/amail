@extends('layouts.frontend')

@section('title', trans('messages.subscriptions'))

@section('page_script')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/validate.js') }}"></script>
@endsection

@section('page_header')

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ \Acelle\Cashier\Cashier::lr_action("HomeController@index") }}">{{ trans('messages.home') }}</a></li>
            <li class="active">{{ trans('messages.subscription') }}</li>
        </ul>
    </div>

@endsection

@section('content')

    @include("account._menu", ['tab' => 'subscription'])

    <div class="row">
        <div class="col-md-6">
            <h2>{!! trans('cashier::messages.direct.pending.title') !!}</h2>  

            <p>{!! trans('cashier::messages.direct.pending.intro', [
                'plan' => $subscription->plan->getBillableName(),
                'price' => $subscription->plan->getBillableFormattedPrice(),
            ]) !!}</p>  

            <ul class="dotted-list topborder section mb-4">
                <li>
                    <div class="unit size1of2">
                        {{ trans('cashier::messages.direct.plan') }}
                    </div>
                    <div class="lastUnit size1of2">
                        <mc:flag>{{ $subscription->plan->getBillableName() }}</mc:flag>
                    </div>
                </li>
                <li>
                    <div class="unit size1of2">
                        {{ trans('cashier::messages.direct.amount') }}
                    </div>
                    <div class="lastUnit size1of2">
                        <mc:flag>{{ $transaction->amount }}</mc:flag>
                    </div>
                </li>
                <li>
                    <div class="unit size1of2">
                        {{ trans('cashier::messages.direct.next_period_day') }}
                    </div>
                    <div class="lastUnit size1of2">
                        <mc:flag>{{ $transaction->ends_at }}</mc:flag>
                    </div>
                </li>
            </ul>
            <div class="alert alert-info bg-grey-light">
            {!! $service->getPaymentInstruction() !!}
            </div>
            <hr>
            
                
                <div class="d-flex align-items-center">
                    <form method="POST" action="{{ \Acelle\Cashier\Cashier::lr_action('\Acelle\Cashier\Controllers\DirectController@claim', ['subscription_id' => $subscription->uid]) }}">
                        {{ csrf_field() }}
                        <button
                            class="btn btn-primary mr-10 mr-2"
                        >{{ trans('cashier::messages.direct.claim_payment') }}</button>
                    </form>
                    
                    <form class="" method="POST" action="{{ \Acelle\Cashier\Cashier::lr_action('\Acelle\Cashier\Controllers\DirectController@cancelNow', ['subscription_id' => $subscription->uid]) }}">
                        {{ csrf_field() }}
                        
                        <a href="javascript:;" onclick="$(this).closest('form').submit()"
                            class="text-muted ml-4"
                            style="font-size: 13px; text-decoration: underline;color:#333"
                        >{{ trans('cashier::messages.direct.change_mind_cancel_subscription') }}</a>
                    </form>
                </div>
            
        </div>
        <div class="col-md-2"></div>
    </div>
@endsection