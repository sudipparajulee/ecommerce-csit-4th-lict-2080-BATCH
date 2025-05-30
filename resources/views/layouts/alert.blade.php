@if(Session::has('success'))
<div id="alert" class="fixed top-4 right-4 bg-green-600 text-white py-3 px-5 text-xl font-bold rounded-lg transition-all duration-1000">
    {{session('success')}}
</div>
<script>
    setTimeout(() => {
        document.getElementById('alert').style.marginRight = '-100%';
    }, 3000);
</script>
@endif
