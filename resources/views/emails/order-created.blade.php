@component('mail::message')
    # Order
    ## Currency: {{ $toCurrencyName }}
    ## Currency amount: {{ $toCurrencyAmount }}
    ## Total paid: {{ $amountPaid }} - {{$fromCurrencyName}}
@endcomponent
