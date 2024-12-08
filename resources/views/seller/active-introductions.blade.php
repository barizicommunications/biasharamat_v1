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
                <div class="w-1/4">
                    <div class="flex flex-col">
                        <div :class="{'border-primary': activeTab === 'inbox', 'border-l-4': activeTab === 'inbox'}">
                            <div class="ml-2 pl-4 py-2" :class="{ 'bg-[#e4e6ef] ': activeTab === 'inbox', 'rounded-md ': activeTab === 'inbox'}">
                                <a href="#" @click="activeTab = 'inbox'">Inbox</a>
                            </div>
                        </div>
                        <div :class="{'border-primary': activeTab === 'notifications', 'border-l-4': activeTab === 'notifications'}">
                            <div class="ml-2 pl-4 py-2" :class="{ 'bg-[#e4e6ef] ': activeTab === 'notifications', 'rounded-md ': activeTab === 'notifications'}">
                                <a href="#" @click="activeTab = 'notifications'">Notifications</a>
                            </div>
                        </div>
                        <div :class="{'border-primary': activeTab === 'profile', 'border-l-4': activeTab === 'profile'}">
                            <div class="ml-2 pl-4 py-2" :class="{ 'bg-[#e4e6ef] ': activeTab === 'profile', 'rounded-md ': activeTab === 'profile'}">
                                <a href="#" @click="activeTab = 'profile'">Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-3/4">
                    <!-- Inbox Section -->
                    <div x-show="activeTab === 'inbox'">
                        {{-- <div class="flex justify-between mb-4">
                            <h2 class="font-bold text-primary text-lg md:text-4xl">Inbox</h2>
                        </div> --}}

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold mb-6">Inbox</h2>

                            <div x-data="{ openConversation: null }" class="space-y-4">
                                @foreach ($conversations as $conversation)
                                    <div class="border border-gray-200 rounded-lg shadow-sm transition-all hover:shadow-md">
                                        <div class="p-4 flex justify-between items-center cursor-pointer bg-gray-100 hover:bg-gray-200 rounded-lg"
                                             @click="openConversation = openConversation === {{ $conversation->id }} ? null : {{ $conversation->id }}">
                                            <div class="flex items-center space-x-4">
                                                <img src="{{ asset('images/logo.png') }}" alt="Conversation Logo" class="w-12 h-12 rounded-full">
                                                <h3 class="font-semibold text-lg text-primary">
                                                    {{ $conversation->userOne->first_name }} & {{ $conversation->userTwo->first_name }}
                                                </h3>
                                            </div>
                                            <p class="text-sm text-gray-500">
                                                {{ $conversation->messages->last()->created_at->diffForHumans() }}
                                            </p>
                                        </div>

                                        <div x-show="openConversation === {{ $conversation->id }}" x-transition x-cloak class="p-4 bg-gray-50 border-t">
                                            <livewire:conversation-messages :conversation-id="$conversation->id" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <!-- Notifications Section -->
                    <div x-show="activeTab === 'notifications'">
                        <h2 class="font-bold text-primary text-lg md:text-4xl mb-6">Notifications</h2>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <p class="text-gray-700">You have no new notifications.</p>
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
