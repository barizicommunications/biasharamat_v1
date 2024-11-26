<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">


                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Home
                </a>
                <span class="mx-3 text-gray-500 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>

                <a href="#" class="text-primary">
                    Register business profile
                </a>
            </div>

          <div class="flex md:space-x-10"  x-data="{ activeTab: 'profile' }">
            <div class="w-1/4">
                <div class="flex flex-col">
                    <div  :class="{'border-primary':activeTab === 'inbox' ,'border-l-4':activeTab === 'inbox'  }" >
                        <div class="ml-2 pl-4 py-2 " :class="{ 'bg-[#e4e6ef] ': activeTab === 'inbox', 'rounded-md ': activeTab === 'inbox',  }"><a href="#" @click="activeTab = 'inbox'">Inbox</a></div>
                    </div>
                    <div :class="{'border-primary':activeTab === 'notifications' ,'border-l-4':activeTab === 'notifications'  }">
                       <div  class="ml-2 pl-4 py-2 " :class="{ 'bg-[#e4e6ef] ': activeTab === 'notifications', 'rounded-md ': activeTab === 'notifications',  }">
                        <a href="#"  @click="activeTab = 'notifications'">Notification</a>
                       </div>
                    </div>
                    <div :class="{'border-primary':activeTab === 'profile' ,'border-l-4':activeTab === 'profile'  }">
                        <div  class="ml-2 pl-4 py-2 " :class="{ 'bg-[#e4e6ef] ': activeTab === 'profile', 'rounded-md ': activeTab === 'notifications',  }">
                         <a href="#"  @click="activeTab = 'profile'">Profile</a>
                        </div>
                     </div>

                </div>
            </div>
            <div class="w-3/4">
                <div x-show="activeTab === 'inbox'">
                   <div class="flex justify-between">
                    <h2 class="font-bold text-primary text-lg md:text-4xl">Inbox</h2>

                    <div class="relative mb-10">
                        <input type="text" class=" md:w-96 py-2 pl-4 pr-4 text-gray-700 bg-white border rounded-lg   focus:border-primary/50  focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-primary/50" placeholder="Search introductions">
                        <span class="absolute  inset-y-0 right-0  flex items-center p-3 rounded-md  ">
                            <svg class="w-5 h-5   text-primary" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>


                   </div>
                   <div class="bg-white">
                    <div class="p-4">
                        Showing 1 - 4 of 20 messages
                    </div>
                    <hr>

                    {{-- @foreach ($conversations as $conversation)
                    <div class="p-4 flex flex-col border-b-2">
                        <!-- Conversation Header with Alpine.js for Toggle -->
                        <div class="flex items-center space-x-8" x-data="{ open: false }">
                            <!-- Display User One's Profile Picture -->
                            <div>
                                <img src="{{ asset('images/logo.png') }}" alt="{{ $conversation->userOne->first_name }}" class="w-10 h-10 rounded-full">
                            </div>

                            <!-- Display Conversation Title and Toggle Button -->
                            <h3 class="font-bold text-primary text-sm self-center ml-2 cursor-pointer"
                                @click="open = ! open">
                                {{ $conversation->userOne->first_name }} & {{ $conversation->userTwo->first_name }} Conversation
                            </h3>
                        </div>

                        <!-- Accordion Content (Messages) -->
                        <div x-show="open" x-transition class="self-center ml-3 mt-3 space-y-3">
                            @if ($conversation->messages->isNotEmpty())
                                @foreach ($conversation->messages as $message)
                                    <div class="mb-2">
                                        <p class="text-xs">
                                            <strong>{{ $message->sender_id == auth()->id() ? 'You' : $message->sender->first_name }}:</strong>
                                            {{ $message->content }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div>
                                    <p class="text-xs">No messages yet.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Last Message Timestamp (Always Visible) -->
                        <div class="ml-12 self-center mt-3">
                            @if ($conversation->messages->isNotEmpty())
                                <p class="text-sm">
                                    Last message sent {{ $conversation->messages->last()->created_at->diffForHumans() }}
                                </p>
                            @else
                                <p class="text-sm">No messages yet</p>
                            @endif
                        </div>
                    </div>
                @endforeach --}}


                @foreach ($conversations as $conversation)
    <div class="p-4 flex flex-col border-b-2">
        <!-- Conversation Header with Alpine.js for Toggle -->
        <div class="flex items-center space-x-8" x-data="{ open: false }">
            <!-- Display User One's Profile Picture -->
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="{{ $conversation->userOne->first_name }}" class="w-10 h-10 rounded-full">
            </div>

            <!-- Display Conversation Title and Toggle Button -->
            <h3 class="font-bold text-primary text-sm self-center ml-2 cursor-pointer"
                @click="open = !open">
                {{ $conversation->userOne->first_name }} & {{ $conversation->userTwo->first_name }} Conversation
            </h3>
        </div>

        <!-- Accordion Content (Messages) -->
        <div x-show="open" x-transition class="self-center ml-3 mt-3 space-y-3">
            @if ($conversation->messages->isNotEmpty())
                @foreach ($conversation->messages as $message)
                    <div class="mb-2">
                        <p class="text-xs">
                            <strong>{{ $message->sender_id == auth()->id() ? 'You' : $message->sender->first_name }}:</strong>
                            {{ $message->content }}
                        </p>
                        <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            @else
                <div>
                    <p class="text-xs">No messages yet.</p>
                </div>
            @endif
        </div>

        <!-- Last Message Timestamp (Always Visible) -->
        <div class="ml-12 self-center mt-3">
            @if ($conversation->messages->isNotEmpty())
                <p class="text-sm">
                    Last message sent {{ $conversation->messages->last()->created_at->diffForHumans() }}
                </p>
            @else
                <p class="text-sm">No messages yet</p>
            @endif
        </div>
    </div>
@endforeach









                    <div class="p-4 flex border-b-2">
                       <div class="flex space-x-8 justify-evenly">
                       <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                        <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                       </div>
                       <div class="self-center ml-3">
                        <div >
                            <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                        </div>
                       </div>

                       <div class="ml-12 self-center">
                        <p class="text-sm">2 days ago</p>
                       </div>
                    </div>
                    <div class="p-4 flex border-b-2 bg-[#ececec]">
                        <div class="flex space-x-8 justify-evenly">
                        <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                         <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                        </div>
                        <div class="self-center ml-3">
                         <div >
                             <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                         </div>
                        </div>

                        <div class="ml-12 self-center">
                         <p class="text-sm">2 days ago</p>
                        </div>
                     </div>
                     <div class="p-4 flex border-b-2">
                        <div class="flex space-x-8 justify-evenly">
                        <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                         <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                        </div>
                        <div class="self-center ml-3">
                         <div >
                             <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                         </div>
                        </div>

                        <div class="ml-12 self-center">
                         <p class="text-sm">2 days ago</p>
                        </div>
                     </div>
                     <div class="p-4 flex border-b-2 bg-[#ececec]">
                        <div class="flex space-x-8 justify-evenly">
                        <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                         <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                        </div>
                        <div class="self-center ml-3">
                         <div >
                             <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                         </div>
                        </div>

                        <div class="ml-12 self-center">
                         <p class="text-sm">2 days ago</p>
                        </div>
                     </div>

                </div>
                </div>
                <div x-show="activeTab === 'notifications'">
                    <div class="flex justify-between">
                        <h2 class="font-bold text-primary text-lg md:text-4xl">Notifications</h2>

                        <div class="relative mb-10">
                            <input type="text" class=" md:w-96 py-2 pl-4 pr-4 text-gray-700 bg-white border rounded-lg   focus:border-primary/50  focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-primary/50" placeholder="Search introductions">
                            <span class="absolute  inset-y-0 right-0  flex items-center p-3 rounded-md  ">
                                <svg class="w-5 h-5   text-primary" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>


                       </div>
                    <div class="bg-white">
                        <div class="p-4">
                            Showing 1 - 4 of 20 messages
                        </div>
                        <hr>

                        <div class="p-4 flex border-b-2">
                           <div class="flex space-x-8 justify-evenly">
                           <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                            <h3 class="font-bold text-primary text-sm self-center ml-2">New profile visit, Nairobi , Kenya </h3>
                           </div>
                           <div class="self-center ml-3">
                            <div >
                                <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                            </div>
                           </div>

                           <div class="ml-12 self-center">
                            <p class="text-sm">2 days ago</p>
                           </div>
                        </div>
                        <div class="p-4 flex border-b-2 bg-[#ececec]">
                            <div class="flex space-x-8 justify-evenly">
                            <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                             <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                            </div>
                            <div class="self-center ml-3">
                             <div >
                                 <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                             </div>
                            </div>

                            <div class="ml-12 self-center">
                             <p class="text-sm">2 days ago</p>
                            </div>
                         </div>
                         <div class="p-4 flex border-b-2">
                            <div class="flex space-x-8 justify-evenly">
                            <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                             <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                            </div>
                            <div class="self-center ml-3">
                             <div >
                                 <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                             </div>
                            </div>

                            <div class="ml-12 self-center">
                             <p class="text-sm">2 days ago</p>
                            </div>
                         </div>
                         <div class="p-4 flex border-b-2 bg-[#ececec]">
                            <div class="flex space-x-8 justify-evenly">
                            <div> <img src="{{ asset('images/logo.png') }}" alt=""></div>
                             <h3 class="font-bold text-primary text-sm self-center ml-2">Edutech Company Investment Opportunity </h3>
                            </div>
                            <div class="self-center ml-3">
                             <div >
                                 <p class="text-xs">Hello, we’ve had a look at your profile and believe...</p>
                             </div>
                            </div>

                            <div class="ml-12 self-center">
                             <p class="text-sm">2 days ago</p>
                            </div>
                         </div>

                    </div>
                </div>
                <div x-show="activeTab === 'profile'" x-data="{ isModalOpen: false, showSuccess: {{ session('status') ? 'true' : 'false' }} }" x-init="if(showSuccess) { setTimeout(() => showSuccess = false, 4000) }">
                    <h2 class="font-bold text-primary text-lg md:text-4xl mb-8">Profile</h2>

                    <!-- Display success message with 4-second timeout -->
                    <div x-show="showSuccess" x-transition x-cloak class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        Profile updated successfully!
                    </div>

                    <!-- Profile Info Section -->
                    <div class="bg-white p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                            <button @click="isModalOpen = true" class="text-blue-500 hover:underline">Edit Profile</button>
                        </div>
                        <p>Email: {{ Auth::user()->email }}</p>
                        <p>Phone: {{ Auth::user()->phone }}</p>
                    </div>

                    <!-- Edit Profile Modal -->
                    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-8" @click.away="isModalOpen = false">
                            <h2 class="text-2xl font-bold text-primary mb-4">Edit Profile</h2>

                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')

                                <!-- First Name Field -->
                                <div class="mb-4">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', Auth::user()->first_name) }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                </div>

                                <!-- Last Name Field -->
                                <div class="mb-4">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', Auth::user()->last_name) }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                </div>

                                <!-- Email Field -->
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                </div>

                                <!-- Phone Field -->
                                <div class="mb-4">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                </div>

                                <!-- Save and Cancel Buttons -->
                                <div class="flex items-center justify-end space-x-4 mt-6">
                                    <button type="button" @click="isModalOpen = false" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md">Cancel</button>
                                    <button type="submit" class="px-4 py-2 text-white bg-primary rounded-md">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
          </div>

        </article>

    </section>
</x-guest-layout>