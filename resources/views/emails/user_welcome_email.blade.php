<x-mail::message>

# Welcome {{$user->name}}

The body of your message.

<x-mail::panel>
This is the panel content.
</x-mail::panel>


<x-mail::button :url="'http://127.0.0.1:8000/cms/admin/login'" :color="'success'">
Button Text
</x-mail::button>



{{-- <x-mail::table>
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
</x-mail::table> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
