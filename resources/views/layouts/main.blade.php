<x-header title={{$title}}>


{{$styles??null}}
   

</x-header>



<main>

{{$slot}}
</main>


<x-footer> 
   
    {{$scripts??null}}

    
</x-footer>
