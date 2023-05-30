<x-app-layout>

    <section class="px-6 py-8">

        <main class="max-w-lg mx-auto mt-10 ">

            <x-panel>


                <form class="mt-10"
                      action="{{route('library.store')}}"
                      method="POST">
                    @csrf

                    <x-form.input name="name"/>
                    <x-form.input name="address"/>
                    <x-form.button>Create</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>

</x-app-layout>
