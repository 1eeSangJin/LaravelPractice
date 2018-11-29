@extends('layout.template')

@section('content')
    @if(Auth::check())
        로그인 되었습니다.
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        로그인 되어있지 않습니다.
    @endif
@endsection