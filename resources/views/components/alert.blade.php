         @props(['title'])
               <div class=" max-w-xl mx-auto">
               <div  {{ $attributes->merge(['class' => 'absolute z-50 top-0 max-w-xl p-4 mx-auto flex-1 rounded-none bg-gray-200  md:rounded-t-2xl max-h-screen mt-auto overflow-auto flex flex-col w-full md:w-3/4 md:max-h-96 transition-transform  ']) }}
                style="transition-duration: 150ms; left: -36rem;">
               <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{$title}}</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{$title}} a Book</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
            </div>
           {{$slot}}
       </div>
   </div>
