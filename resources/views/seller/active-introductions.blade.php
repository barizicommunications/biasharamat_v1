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
                        <div class="flex justify-between">
                            <h2 class="font-bold text-primary text-lg md:text-4xl">Inbox</h2>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-2xl font-bold mb-6">Inbox</h2>
                            <div x-data="{ openConversation: null }" class="space-y-6">
                                @foreach ($conversations as $conversation)
                                    <div class="border border-gray-200 rounded-lg shadow-sm">
                                        <div class="p-4 flex justify-between items-center cursor-pointer bg-gray-100 rounded-lg"
                                             @click="openConversation = openConversation === {{ $conversation->id }} ? null : {{ $conversation->id }}">
                                            <div class="flex items-center space-x-4">
                                                <img src="{{ asset('images/logo.png') }}" alt="Conversation Logo" class="w-10 h-10 rounded-full">
                                                <h3 class="font-semibold text-lg text-primary">
                                                    {{ $conversation->userOne->first_name }} & {{ $conversation->userTwo->first_name }}
                                                </h3>
                                            </div>
                                            <p class="text-sm text-gray-500">
                                                {{ $conversation->messages->last()->created_at->diffForHumans() }}
                                            </p>
                                        </div>

                                        <div x-show="openConversation === {{ $conversation->id }}" x-transition x-cloak class="p-4 bg-gray-50">
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
                    <div x-show="activeTab === 'profile'" x-data="{ isModalOpen: false }">
                        <h2 class="font-bold text-primary text-lg md:text-4xl mb-8">Profile</h2>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                                <button @click="isModalOpen = true" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Edit Profile</button>
                            </div>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <p>Phone: {{ Auth::user()->phone }}</p>
                        </div>

                        <!-- Edit Profile Modal -->
                        <div x-show="isModalOpen" x-transition x-cloak class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg" @click.away="isModalOpen = false">
                                <h3 class="font-bold text-lg mb-4">Edit Profile</h3>
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                                        <input type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="w-full border rounded-lg p-2 focus:ring-primary focus:border-primary">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                        <input type="text" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="w-full border rounded-lg p-2 focus:ring-primary focus:border-primary">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border rounded-lg p-2 focus:ring-primary focus:border-primary">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="w-full border rounded-lg p-2 focus:ring-primary focus:border-primary">
                                    </div>
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" @click="isModalOpen = false" class="px-4 py-2 text-gray-500 border rounded-lg hover:bg-gray-100">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
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
