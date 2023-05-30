@props(['name'])

<x-form.feild>

    <x-form.label name="{{$name}}"/>
    <textarea class="border border-gray-200 p-2 w-full rounded"
              name="{{$name}}"
              required
    >
        {{ $slot ?? old($name) }}
                </textarea>
    <x-form.errors name="{{$name}}"/>

</x-form.feild>
