@props(['status' => 'info'])

@php
if(session('status') === 'info'){$bgColor = 'bg-indigo-500';}
if(session('status') === 'alert'){$bgColor = 'bg-red-500';}
@endphp

@if(session('message'))
 <div id="flash" class="{{ $bgColor }} w-1/2 mx-auto rounded-full px-4 text-white text-center animate-pulse">
   {{ session('message')}}
 </div>
@endif

<script>
  const toast = document.querySelector("#flash")
    flash.style.visibility = "visible";
    setTimeout(function(){
      flash.style.visibility = "hidden";
    }, 5000);
</script>
