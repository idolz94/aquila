<div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
@if (session()->has('message') || session()->has('error'))
<div id="toast-container" class="toast-top-right">
    <div class="toast {{ session()->has('message') ? 'toast-success' : 'toast-error' }}" aria-live="polite" style="">
        <div class="toast-message">
            @if (session()->has('message'))
                {{ session('message') }}
            @endif
            @if (session()->has('error'))
                {{ session('error') }}
            @endif
        </div>
    </div>
</div>
@endif