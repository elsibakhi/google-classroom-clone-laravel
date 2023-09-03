<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Additional settings') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Adjust these settings to suit you.") }}
        </p>
    </header>



    <form method="post" action="{{ route('profile.update.extra') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->profile->first_name)" required autofocus  />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->profile->last_name)" required autofocus  />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />

          <select name="gender" id="gender">
            <option value="male" @selected($user->profile->gender=="male")>{{ __('Male') }}</option>
            <option value="female" @selected($user->profile->gender=="female")>{{ __('Female') }}</option>
          </select>

                <x-input-error class="mt-2" :messages="$errors->get('gender')" />


        </div>

            <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $user->profile->birthdate)" required autofocus  />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>


               <div>
            <x-input-label for="locale" :value="__('Language')" />

          <select name="locale" id="locale">
            <option value="ar" @selected($user->profile->locale=="ar")>{{ __('Arabic') }}</option>
            <option value="en" @selected($user->profile->locale=="en")>{{ __('English') }}</option>
          </select>

                <x-input-error class="mt-2" :messages="$errors->get('locale')" />


        </div>
               <div>
            <x-input-label for="timezone" :value="__('Timezone')" />

          <select name="timezone" id="timezone">
            @foreach ($timezones as $timezone)

            <option value="{{ $timezone['name'] }}" @selected($user->profile->timezone==$timezone['name'])>{{ $timezone["name"] }}</option>
            @endforeach

          </select>

                <x-input-error class="mt-2" :messages="$errors->get('timezone')" />


        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated-extra')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
