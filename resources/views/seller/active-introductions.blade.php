<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="#" class="text-gray-600 hover:underline">Home</a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a 1 1 0 010 1.414l-4 4a 1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">Register business profile</a>
            </div>

            <div class="flex md:space-x-10" x-data="{ activeTab: 'inbox' }">
                <div class="w-64 bg-white rounded-lg shadow-sm">
                    <nav class="flex flex-col space-y-1 p-3">
                        <div class="relative" :class="{'border-l-4 border-[#030e4f]': activeTab === 'inbox', 'border-l-4 border-transparent': activeTab !== 'inbox'}">
                            <a href="#"
                               @click="activeTab = 'inbox'"
                               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all duration-200"
                               :class="{
                                   'bg-[#030e4f]/5 text-[#030e4f]': activeTab === 'inbox',
                                   'text-gray-600 hover:bg-gray-50 hover:text-[#030e4f]': activeTab !== 'inbox'
                               }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" :class="{'text-[#be3502]': activeTab === 'inbox'}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                Inbox
                            </a>
                        </div>

                        <div class="relative" :class="{'border-l-4 border-[#030e4f]': activeTab === 'notifications', 'border-l-4 border-transparent': activeTab !== 'notifications'}">
                            <a href="#"
                               @click="activeTab = 'notifications'"
                               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all duration-200"
                               :class="{
                                   'bg-[#030e4f]/5 text-[#030e4f]': activeTab === 'notifications',
                                   'text-gray-600 hover:bg-gray-50 hover:text-[#030e4f]': activeTab !== 'notifications'
                               }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" :class="{'text-[#be3502]': activeTab === 'notifications'}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Notifications
                            </a>
                        </div>

                        <div class="relative" :class="{'border-l-4 border-[#030e4f]': activeTab === 'profile', 'border-l-4 border-transparent': activeTab !== 'profile'}">
                            <a href="#"
                               @click="activeTab = 'profile'"
                               class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-all duration-200"
                               :class="{
                                   'bg-[#030e4f]/5 text-[#030e4f]': activeTab === 'profile',
                                   'text-gray-600 hover:bg-gray-50 hover:text-[#030e4f]': activeTab !== 'profile'
                               }">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" :class="{'text-[#be3502]': activeTab === 'profile'}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>
                        </div>
                    </nav>
                </div>

                <div class="w-3/4">
                    <!-- Inbox Section -->
                    <div x-show="activeTab === 'inbox'">


                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold mb-6">Inbox</h2>

                            <div x-data="{ openConversation: null }" class="space-y-4">
                                @php
                                    // Filter conversations with at least one approved message
                                    $approvedConversations = $conversations->filter(function ($conversation) {
                                        return $conversation->messages->where('status', 'approved')->count() > 0;
                                    });
                                @endphp

                                @if ($approvedConversations->isNotEmpty())
                                    @foreach ($approvedConversations as $conversation)
                                    <div class="bg-white rounded-xl shadow-md transition-all duration-300 hover:shadow-lg border border-gray-100">
                                        <div class="p-5 flex justify-between items-center cursor-pointer transition-colors duration-200 hover:bg-gray-50 rounded-t-xl"
                                             @click="openConversation = openConversation === {{ $conversation->id }} ? null : {{ $conversation->id }}">
                                            <div class="flex items-center space-x-4">
                                                <div class="relative">
                                                    <img src="{{ asset('images/logo.png') }}"
                                                         alt="Conversation Logo"
                                                         class="w-12 h-12 rounded-full ring-2 ring-[#030e4f]/10">
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-lg text-[#030e4f]">
                                                        {{ $conversation->userOne->first_name }} & {{ $conversation->userTwo->first_name }}
                                                    </h3>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $conversation->messages->last()->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <span class="text-[#be3502] hover:text-[#030e4f] transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <div x-show="openConversation === {{ $conversation->id }}"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                                             x-transition:enter-end="opacity-100 transform translate-y-0"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100 transform translate-y-0"
                                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                                             x-cloak
                                             class="border-t border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                                            <div class="p-5">
                                                <livewire:conversation-messages :conversation-id="$conversation->id" />
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-12">
                                        <p class="text-gray-500 text-lg">No messages found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>


                    <!-- Notifications Section -->
                    <div x-show="activeTab === 'notifications'"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-y-4"
     x-transition:enter-end="opacity-100 transform translate-y-0">

    <div class="flex justify-between items-center mb-6">
        <h2 class="font-bold text-[#030e4f] text-lg md:text-2xl">Notifications</h2>
        <div class="flex items-center space-x-2">
            <button class="text-sm text-[#be3502] hover:text-[#030e4f] transition-colors duration-200">
                Mark all as read
            </button>
        </div>
    </div>

    <!-- Notifications Container -->
    <div class="bg-white rounded-xl shadow-sm divide-y divide-gray-100">
        <!-- Unread Notification - New Message -->
        <div class="p-4 hover:bg-gray-50 transition-colors duration-200 flex items-start space-x-4">
            <div class="flex-shrink-0">
                <div class="w-2 h-2 mt-2 rounded-full bg-[#be3502]"></div>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-[#030e4f]">
                        New message from <span class="font-semibold">John Doe</span>
                    </p>
                    <span class="text-xs text-gray-500">2m ago</span>
                </div>
                <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                    Hi there! I wanted to discuss the project timeline...
                </p>
            </div>
        </div>

        <!-- Read Notification - System Update -->
        <div class="p-4 hover:bg-gray-50 transition-colors duration-200 flex items-start space-x-4">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#030e4f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        System Update Complete
                    </p>
                    <span class="text-xs text-gray-500">1h ago</span>
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    The system has been successfully updated to version 2.0.
                </p>
            </div>
        </div>

        <!-- Read Notification - Task Assignment -->
        <div class="p-4 hover:bg-gray-50 transition-colors duration-200 flex items-start space-x-4">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#030e4f]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        Task Assigned by <span class="font-semibold">Sarah Smith</span>
                    </p>
                    <span class="text-xs text-gray-500">Yesterday</span>
                </div>
                <p class="mt-1 text-sm text-gray-600">
                    You have been assigned to the "Website Redesign" project.
                </p>
            </div>
        </div>

        <!-- Empty State (Shown when no notifications) -->
        <div x-show="false" class="p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <p class="text-gray-600 mb-2">You're all caught up!</p>
            <p class="text-sm text-gray-500">No new notifications at the moment.</p>
        </div>
    </div>
</div>

                    <!-- Profile Section -->
                    <div x-show="activeTab === 'profile'" x-data="{ isModalOpen: false, showSuccess: {{ session('status') ? 'true' : 'false' }} }" x-init="if(showSuccess) { setTimeout(() => showSuccess = false, 4000) }">
                        <h2 class="font-bold text-primary text-lg md:text-4xl mb-8">Profile</h2>

                        <!-- Display success message with 4-second timeout -->
                        <div x-show="showSuccess" x-transition x-cloak class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            Profile updated successfully!
                        </div>

                        <!-- Profile Info Section -->
                        <div x-show="activeTab === 'profile'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform -translate-y-4"
                        x-transition:enter-end="opacity-100 transform translate-y-0">

                      

                       <!-- Profile Card -->
                       <div class="bg-white rounded-xl shadow-sm">
                           <!-- Profile Header Section -->
                           <div class="p-6 border-b border-gray-100">
                               <div class="flex items-start justify-between">
                                   <div class="flex items-center space-x-4">
                                       <div class="w-16 h-16 rounded-full bg-[#030e4f]/5 flex items-center justify-center">
                                           <span class="text-[#030e4f] text-xl font-semibold">
                                               {{ substr(Auth::user()->first_name, 0, 1) }}{{ substr(Auth::user()->last_name, 0, 1) }}
                                           </span>
                                       </div>
                                       <div>
                                           <h3 class="text-xl font-semibold text-[#030e4f]">
                                               {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                           </h3>
                                       </div>
                                   </div>
                                   <button @click="isModalOpen = true"
                                           class="inline-flex items-center px-4 py-2 bg-[#030e4f] text-white text-sm font-medium rounded-lg hover:bg-[#030e4f]/90 transition-colors duration-200">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                       </svg>
                                       Edit Profile
                                   </button>
                               </div>
                           </div>

                           <!-- Profile Information -->
                           <div class="p-6">
                               <div class="space-y-4">
                                   <div class="flex items-center space-x-3">
                                       <div class="flex-shrink-0">
                                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#be3502]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                           </svg>
                                       </div>
                                       <div>
                                           <p class="text-sm font-medium text-gray-900">Email Address</p>
                                           <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                                       </div>
                                   </div>

                                   <div class="flex items-center space-x-3">
                                       <div class="flex-shrink-0">
                                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#be3502]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                           </svg>
                                       </div>
                                       <div>
                                           <p class="text-sm font-medium text-gray-900">Phone Number</p>
                                           <p class="text-sm text-gray-600">{{ Auth::user()->phone }}</p>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
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
