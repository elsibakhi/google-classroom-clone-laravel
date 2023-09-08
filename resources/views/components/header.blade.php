<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"   dir={{ app()->getLocale()=="ar"? 'rtl' : 'ltr' }} >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    @if (app()->getLocale()=="ar")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @else

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>{{$title}}</title>

   {{$slot}}


</head>
<body  >
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5  ">
        <div class="container-fluid">
          <a class="navbar-brand" href={{route("classrooms.index")}}>{{config("app.name")}}</a>
      {{-- i use config instead env -- becaues we can cache config but env not --}}
      {{-- we should env in configration files just  -- these is true use --}}
      {{-- if we cache configration we can't use env just cached configration files   --}}

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-between ">

            <x-classwork-user-notification />
              <li  class="nav-item ">
                <form class="d-flex     ">
              <input class="form-control me-2" type="search" placeholder="{{ __('Search') }}" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">{{ __('Search') }}</button>
            </form>
              </li>

            </ul>
            <li class="nav-item dropdown">
              <a   class=" dropdown-toggle  text-light text-decoration-none" href="#" id="navbarDropdown"   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->name}}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>

              @cannot("subscription.confirmed")

           
                  <li><a class="dropdown-item" href="{{ route('plans.index') }}">{{ __('Subscribe now') }}</a></li>

             @endcannot


                <li><hr class="dropdown-divider"></li>
                <li>      <form method="POST" action="{{ route('logout') }}">
                          @csrf

                          <x-dropdown-link :href="route('logout')" class="dropdown-item"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </x-dropdown-link>
                      </form></li>


              </ul>
            </li>


          </div>
        </div>
      </nav>
