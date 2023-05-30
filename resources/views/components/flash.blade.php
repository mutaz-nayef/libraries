@if(session()->has('flash'))
    <div x-data="{show : true}"
         x-init="setTimeout(()=> show = false,4000)"
         x-show="show"
         style="right: 11px; bottom: 13px;"
         class="  fixed bg-blue-500 text-white px-4 py-2 rounded-lg bottom-3 right-3  text-sm"
    >
        <p>
            {{ session('flash') }}
        </p>
    </div>
@endif
