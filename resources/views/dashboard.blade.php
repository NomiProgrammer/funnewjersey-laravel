@php
    use Illuminate\Support\Facades\Auth;
@endphp

@if(Auth::check())
    @if(Auth::user()->level() == 2)
        <script>window.location.href = "{{ route('admin.dashboard') }}";</script>
    @else
        <script>window.location.href = "{{ route('home') }}";</script>
    @endif
@endif
