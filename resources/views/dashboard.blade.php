<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto mt-20 max-w-xl px-6 lg:max-w-4xl">
            <div class="w-full bg-gray-800 rounded-xl overflow-hidden grid lg:grid-cols-5"
                style="box-shadow: inset 0px -1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.1)">
                @livewire('chat-box')
                @if (Route::is('chat'))
                    @livewire('chat', ['user_id' => $id])
                @else
                    <!-- Right section for chat messages -->
                    <div class="overflow-x-auto text-sm lg:col-span-3">
                        <div class="flex-1 min-h-full relative">
                            <div
                                class="chatDashboard flex p-6 justify-center items-center h-full flex-col absolute top-0 left-0 right-0 bottom-0 gap-4">
                                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Start a
                                    Conversation</h2>
                                <p class="text-sm text-white text-center">Welcome to Laravel ChatApp! Whether you're
                                    here to
                                    chat, ask a question, or connect with friends, we're ready when you are. Click to
                                    start a
                                    conversation and experience seamless communication, all in one place. We're just a
                                    message
                                    away!</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
