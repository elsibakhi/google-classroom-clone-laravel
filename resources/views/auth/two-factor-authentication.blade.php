<x-main-layout title="{{ __('2fA') }}">


    <div class="container my-5">

        @if (session('status') == 'two-factor-authentication-enabled')
            <div class="mb-4 font-medium text-sm alert alert-warning">
                Please finish configuring two factor authentication below.
            </div>
        @endif

        @if (session('status') == 'two-factor-authentication-confirmed')
            <div class="mb-4 font-medium text-sm alert alert-success ">
                Two factor authentication confirmed and enabled successfully.
            </div>
        @endif


          @if($user->two_factor_recovery_codes && $user->two_factor_secret && $user->two_factor_confirmed_at)

          <ul>
            <h4>Recovery codes</h4>
           @foreach ($user->recoveryCodes() as $code)
                            <li>{{ $code }}</li>
           @endforeach
          </ul>

                        <form action="/user/two-factor-authentication" method="post" class="text-center">
                           @csrf
                           @method("delete")
                          <input type="submit" class="btn btn-danger"  value="disable 2FA" />

                        </form>

          @else
                @if (session('status') == 'two-factor-authentication-enabled')
                            <h3>Scan this QR with any QR authenticator</h3>
                            {!!  $user->twoFactorQrCodeSvg()  !!}
                 <form action="/user/confirmed-two-factor-authentication" method="post" class="text-center">
                           @csrf
                           <label >

                                Enter the code here: <br>
                               <input type="text" name="code">
                           </label>
                          <input type="submit" class="btn btn-dark"  value="Confirm 2FA Now" />

                        </form>
                @else

                    <form action="/user/two-factor-authentication" method="post" class="text-center">
                           @csrf
                          <input type="submit" class="btn btn-primary"  value="Enable 2FA" />

                        </form>

                @endif

          @endif


    </div>


</x-main-layout>
