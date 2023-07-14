@include('partials.header')

<main>

@push('styles')
@stack("styles")
@endpush


@yield('content')
{{-- 
اذا انا محتاج اعرف حقل ز ي الييلد بس بدي اعبيه اكتر من مرة في الصفحة  لانو بالييلد م بقدر اعرف نفس السكشن اكتر من مرة بستخدم هاد    
@stack("content") --}}

{{-- انا ممكن اعبي الستاك باستخدام هاذ 
@push("content")
content
@endpush

وبقدر اعمل بوش اكتر من مرة على عكس السكشن --}}


</main>


@include('partials.footer')

@push('scripts')
@stack("scripts")
@endpush