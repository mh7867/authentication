    <!-- Left section for user search and list -->
    <div class="border-r border-gray-700 p-8 pb-12 lg:col-span-2">
        <div class="relative w-full">
            <input type="text" wire:model.live="search" placeholder="Search users"
                class="transition-color block w-full max-w-[16rem] rounded-[10px] border-0 bg-gray-700 py-2.5 pl-10 pr-4 text-sm text-gray-300 placeholder-gray-600 outline-none focus-visible:ring-1 focus-visible:ring-pink-400/50 sm:max-w-none">
            <div class="pointer-events-none absolute inset-0 left-3 flex items-center" aria-hidden="true">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.25 9.167a5.917 5.917 0 1 1 11.833 0 5.917 5.917 0 0 1-11.833 0ZM9.167 1.75a7.417 7.417 0 1 0 4.687 13.165l2.282 2.282a.75.75 0 0 0 1.061-1.06l-2.282-2.283A7.417 7.417 0 0 0 9.167 1.75Z"
                        fill="#475569" opacity=".8"></path>
                </svg>
            </div>
        </div>

        <!-- Scrollable user list -->
        <div id="userList" class="no-scrollbar h-96" style="overflow-y: auto;" wire:scroll="loadMore">
            <ul class="mt-8 space-y-5">
                @foreach ($users as $user)
                    <li class="flex items-center gap-4 text-sm text-white">
                        <img class="h-10 w-10 overflow-hidden rounded-full"
                            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFsZSUyMGhlYWRzaG90fGVufDB8fDB8fA%3D%3D&amp;auto=format&amp;w=80&amp;h=80&amp;q=60&amp;fit=facearea&amp;facepad=3">
                        <span><a href="{{ route('chat', $user->id) }}" wire:navigate>{{ $user->name }}</a></span>
                    </li>
                @endforeach
            </ul>

            <!-- Loading spinner -->
            @if ($users->hasMorePages())
                <div wire:loading wire:target="loadMore">
                    <span class="text-sm text-white">Loading more users...</span>
                </div>
            @endif
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let userList = document.getElementById('userList');

            userList.addEventListener('scroll', function() {
                if (userList.scrollTop + userList.clientHeight >= userList.scrollHeight) {
                    @this.call('loadMore');
                }
            });
        });
    </script>
