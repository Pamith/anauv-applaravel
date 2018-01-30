@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Header Title
        @endcomponent
    @endslot
{{-- Body --}}
    This is our main message {{ $user }}
{{-- Subcopy --}}
    
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $offer }}
                COUPON CODE:{{ $coupon }}
            @endcomponent
        @endslot
   
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. Super FOOTER!
        @endcomponent
    @endslot
@endcomponent