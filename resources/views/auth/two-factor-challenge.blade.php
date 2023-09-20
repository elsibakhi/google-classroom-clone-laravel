<x-guest-layout >

<div class="container">
     <form method="POST" action="/two-factor-challenge">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="code" :value="__('Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" value=""   />
            <x-input-error :messages="$errors->get("code")" class="mt-2" />
        </div>
        <div>
            <x-input-label for="recovery_code" :value="__('Recovery code')" />
            <x-text-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" value=""   />
            <x-input-error :messages="$errors->get("recovery_code")" class="mt-2" />
        </div>


            <x-primary-button class="ml-3">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</div>


</x-guest-layout>
