<!-- resources/viview/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-grey-200 dark:border-gray-800">
                    <table class="text-center w-full border-collapse">
                        <thead>
                            <tr>
                                <th
                                    class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">
                                    view</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($views as $view)
                                <tr class="hover:bg-gray-lighter">
                                    <td class="py-4 px-6 border-b border-gray-light dark:border-gray-600">
                                        <a href="{{ route('view.show', $view->id) }}">
                                            <!-- ð½ è¿½å  -->
                                            <p class="text-left text-gray-800 dark:text-gray-200">
                                                {{ $view->user->name }}</p>
                                            <h3 class="text-left font-bold text-lg text-gray-800 dark:text-gray-200">
                                                {{ $view->view }}</h3>
                                        </a>
                                        <div class="flex">
                                            <!-- æ¡ä»¶åå²ã§ã­ã°ã¤ã³ãã¦ããã¦ã¼ã¶ãæç¨¿ããviewã®ã¿ç·¨éãã¿ã³ã¨åé¤ãã¿ã³ãè¡¨ç¤ºããã -->
                                            @if ($view->user_id === Auth::user()->id)
                                                <!-- æ´æ°ãã¿ã³ -->
                                                <form action="{{ route('view.edit', $view->id) }}" method="GET"
                                                    class="text-left">
                                                    @csrf
                                                    <x-primary-button class="ml-3">
                                                        <svg class="h-6 w-6 text-gray-500" fill="none"
                                                            viewBox="0 0 24 24" stroke="gray">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </x-primary-button>
                                                </form>
                                                <!-- åé¤ãã¿ã³ -->
                                                <form action="{{ route('view.destroy', $view->id) }}" method="POST"
                                                    class="text-left">
                                                    @method('delete')
                                                    @csrf
                                                    <x-primary-button class="ml-3">
                                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                            stroke="gray">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </x-primary-button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
