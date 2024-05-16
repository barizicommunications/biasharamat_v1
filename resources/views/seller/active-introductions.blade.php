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
                <div x-show="activeTab === 'profile'">
                <h2 class="font-bold text-primary text-lg md:text-4xl mb-8">Profile</h2>
                <div class="bg-white p-6">
                    <div class=" max-w-screen-md mb-6 ">
                        <div class="flex space-x-10">
                            <div>
                                <img src="{{ asset('images/profile-picture.png') }}" alt="">
                            </div>
                            <div>
                                <h5 class="text-primary text-2xl font-bold mb-3">{{ Auth::user()->full_name }}</h5>
                                <p>johndoe@gmail.com</p>
                                <p>Kenya</p>
                                <p>Africa / Nairobi</p>
                                <p>Joine Feb, 2023</p> <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                  </svg>
                                  </span>
                            </div>
                            <div>
                                <h5 class="text-primary text-2xl font-bold mb-3">Preferences</h5>
                                <div class="flex space-x-4">
                                    <div>
                                        <p>Industries</p>
                                        <p>Location</p>
                                    </div>
                                    <div>
                                        <p>All industries</p>
                                        <p>Kenya</p> <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                          </svg>
                                          </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="max-w-2xl ml-28">
                        <h5 class="text-primary text-2xl font-bold mb-3">Email preferences</h5>
                        <div class="flex space-x-10">
                            <div>
                                <p>Important communication</p>
                                <p>Business proposals</p>
                                <p>New opportunity notifications</p>
                            </div>
                            <div>
                                <p>Unsubscribed</p>
                                <p>Real time</p>
                                <p>Weekly</p> <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                  </svg>
                                  </span>
                            </div>
                        </div>
                    </div>
                </div>
                 </div>
            </div>
          </div>

        </article>

    </section>
</x-guest-layout>