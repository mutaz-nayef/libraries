<x-form.feild>

    <button type="submit"

            {{$attributes(['class' => 'rounded-lg bg-blue-500 text-white uppercase text-xs px-10 py-2 rounded-2xl font-semibold hover:bg-blue-600' , 'id' => ''])}}
            style="transition:.3s" ;
    >
        {{$slot}}
    </button>
</x-form.feild>
