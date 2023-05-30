<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div id="render" class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b-2 border-gray-300">


                    @foreach($users as $user)
                        @if(auth()->user()->is($user))
                            @continue
                        @endif
                        <div class="flex mx-auto justify-center mb-2">
                            <div class="w-40">
                                {{$user->username}}
                            </div>
                            @if($user->status == 0)
                                <div class=" w-auto flex justify-between ml-20 items-center">
                                    <a href="{{route('admin.user.update',$user->id)}}"
                                       class="mx-auto text-sm text-white bg-green-500  hover:bg-green-600 px-2 py-1 rounded">
                                        Activate
                                    </a>
                                    @else
                                        <div
                                            class=" text-sm text-green-500 px-2 py-1 rounded">
                                            Activated
                                        </div>
                                        <a href="{{route('admin.user.update', $user->id)}}"
                                           class="ml-1 text-sm text-white bg-red-500 hover:bg-red-600 px-2 py-1 rounded">
                                            deactivate
                                        </a>
                                    @endif
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
