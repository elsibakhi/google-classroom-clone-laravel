<x-header title={{ $title }}>


    {{ $styles ?? null }}


</x-header>


<div id="alertEvent" style="position:fixed; top:10px; z-index: 10 " class="alert alert-primary  fade " role="alert">


</div>

<main>
    {{ $slot }}
</main>


<x-footer>

    {{ $scripts ?? null }}


</x-footer>
