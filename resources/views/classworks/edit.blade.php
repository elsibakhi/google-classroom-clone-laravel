<x-main-layout title="Edit classwork">



    <div class="container my-5">


      <x-alert class="alert-success" name="success"  />
    <x-alert class="alert-error" name="error"  />

        <form class="w-50" action={{route("classrooms.classworks.update",[$classroom->id,$classwork->id])}} method="POST" enctype="multipart/form-data" >
          @method("put")
         @csrf
            <h1>{{ __('Edit classwork') }}</h1>
            <hr>


    <x-classwork.form button-label="{{ __('Edit') }} {{__($classwork->classworkType)}}"
       :classroom="$classroom"
       type='{{$type}}'
       :classwork="$classwork"
         />

          </form>

    </div>

<x-slot:scripts >
  <script src="https://cdn.tiny.cloud/1/xyix0ehqxpv5zp8oulxfde0ouz2hibyhg9i4xwdh93hvspqo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
    });
  </script>
</x-slot>



    </x-main-layout>







