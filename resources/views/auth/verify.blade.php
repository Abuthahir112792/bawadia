@extends('layouts.app')

@section('content')
                <div class="container ">
                    <!-- <img class="d-flex logo " src="logo.png" alt="SimlpistQ" width="230px"> -->
                </div>
                <div class="align-content-center">
                <h4 class="py-4 px-4" style="text-align: center">Restricted Area</h4>
                <a class="btn btn-primary btn-block shadow-lg" href="{{ route('logout') }}"
							onclick="event.preventDefault();
										  document.getElementById('logout-form').submit();">
							 {{ __('Logout') }}
						 </a>

						 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							 @csrf
						 </form>
                </div>
@endsection
