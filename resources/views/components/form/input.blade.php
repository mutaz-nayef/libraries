@props(['name'])
<x-form.feild>

    <x-form.label name="{{$name}}"/>

    <input class="focus:outline-none focus:shadow-outline border border-gray-200 p-2 w-full rounded"
           name="{{$name}}"
           id="{{$name}}"

        {{ $attributes(['value' => old($name) ]) }}
    >
   <span id="{{$name}}-errors" class="text-xs text-red-500"></span>
    <x-form.errors name="{{$name}}"/>
</x-form.feild>
