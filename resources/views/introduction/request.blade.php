<x-guest-layout>
    <section class="bg-[#f4f4f4]">
        <article class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:py-8">
            <!-- Breadcrumb -->
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap mb-8">
                <a href="/" class="text-gray-600 hover:underline">Home</a>
                <span class="mx-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
                <a href="#" class="text-primary">Request Introduction</a>
            </div>

            <div class="max-w-4xl mx-auto">
                <!-- Page Header -->
                <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
                    <div class="text-center mb-6">
                        <h1 class="text-3xl md:text-4xl font-bold text-primary mb-4">Request Professional Introduction</h1>
                        <p class="text-gray-600 text-lg">Connect with verified businesses and investors through our secure introduction service</p>
                    </div>

                    <!-- Service Features -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.25-4.5a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">Verified Connections</h3>
                            <p class="text-sm text-gray-600">All parties are pre-verified for authenticity</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 0h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">Confidential Process</h3>
                            <p class="text-sm text-gray-600">Your information is protected throughout</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-900 mb-1">Professional Support</h3>
                            <p class="text-sm text-gray-600">Ongoing assistance during negotiations</p>
                        </div>
                    </div>
                </div>

                <!-- Introduction Request Form -->
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-primary mb-6">Introduction Request Form</h2>

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Success message -->
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('introduction.request.submit') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Hidden fields for pre-filled data -->
                        @if(isset($profile))
                            <input type="hidden" name="profile_type" value="{{ $type }}">
                            <input type="hidden" name="profile_id" value="{{ $profile->id }}">
                        @endif

                        <!-- Target Selection -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Introduction Type -->
                            <div>
                                <label for="introduction_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Type of Introduction <span class="text-red-500">*</span>
                                </label>
                                <select name="introduction_type" id="introduction_type"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                        onchange="toggleTargetOptions()" required>
                                    <option value="">Select introduction type</option>
                                    <option value="business" {{ (old('introduction_type', $type ?? '') == 'business') ? 'selected' : '' }}>
                                        Connect with a Business
                                    </option>
                                    <option value="investor" {{ (old('introduction_type', $type ?? '') == 'investor') ? 'selected' : '' }}>
                                        Connect with an Investor
                                    </option>
                                </select>
                                @error('introduction_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Target Selection -->
                            <div>
                                <label for="target_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Select Target <span class="text-red-500">*</span>
                                </label>
                                <select name="target_id" id="target_id"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                        required>
                                    <option value="">Choose a target</option>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                                @error('target_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Your Information -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="requester_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="requester_name" id="requester_name"
                                           value="{{ old('requester_name', auth()->user()->first_name . ' ' . auth()->user()->last_name) }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                           required>
                                    @error('requester_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="requester_email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="requester_email" id="requester_email"
                                           value="{{ old('requester_email', auth()->user()->email) }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                           required>
                                    @error('requester_email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="requester_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" name="requester_phone" id="requester_phone"
                                           value="{{ old('requester_phone', auth()->user()->phone ?? '') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                           required>
                                    @error('requester_phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="requester_company" class="block text-sm font-medium text-gray-700 mb-2">
                                        Company/Organization
                                    </label>
                                    <input type="text" name="requester_company" id="requester_company"
                                           value="{{ old('requester_company') }}"
                                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    @error('requester_company')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Introduction Details -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Introduction Details</h3>

                            <div class="mb-6">
                                <label for="introduction_purpose" class="block text-sm font-medium text-gray-700 mb-2">
                                    Purpose of Introduction <span class="text-red-500">*</span>
                                </label>
                                <select name="introduction_purpose" id="introduction_purpose"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                        required>
                                    <option value="">Select purpose</option>
                                    <option value="investment_opportunity" {{ old('introduction_purpose') == 'investment_opportunity' ? 'selected' : '' }}>
                                        Investment Opportunity
                                    </option>
                                    <option value="business_acquisition" {{ old('introduction_purpose') == 'business_acquisition' ? 'selected' : '' }}>
                                        Business Acquisition
                                    </option>
                                    <option value="partnership" {{ old('introduction_purpose') == 'partnership' ? 'selected' : '' }}>
                                        Strategic Partnership
                                    </option>
                                    <option value="financing" {{ old('introduction_purpose') == 'financing' ? 'selected' : '' }}>
                                        Business Financing
                                    </option>
                                    <option value="asset_purchase" {{ old('introduction_purpose') == 'asset_purchase' ? 'selected' : '' }}>
                                        Asset Purchase
                                    </option>
                                    <option value="other" {{ old('introduction_purpose') == 'other' ? 'selected' : '' }}>
                                        Other
                                    </option>
                                </select>
                                @error('introduction_purpose')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Introduction Message <span class="text-red-500">*</span>
                                </label>
                                <textarea name="message" id="message" rows="4"
                                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                          placeholder="Please provide details about your interest, what you're looking for, and any relevant background information..."
                                          required>{{ old('message') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">Minimum 50 characters. Be specific about your intentions and background.</p>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-2">
                                    Budget/Investment Range
                                </label>
                                <select name="budget_range" id="budget_range"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <option value="">Select range (optional)</option>
                                    <option value="under_1m" {{ old('budget_range') == 'under_1m' ? 'selected' : '' }}>Under KES 1M</option>
                                    <option value="1m_5m" {{ old('budget_range') == '1m_5m' ? 'selected' : '' }}>KES 1M - 5M</option>
                                    <option value="5m_10m" {{ old('budget_range') == '5m_10m' ? 'selected' : '' }}>KES 5M - 10M</option>
                                    <option value="10m_50m" {{ old('budget_range') == '10m_50m' ? 'selected' : '' }}>KES 10M - 50M</option>
                                    <option value="50m_100m" {{ old('budget_range') == '50m_100m' ? 'selected' : '' }}>KES 50M - 100M</option>
                                    <option value="over_100m" {{ old('budget_range') == 'over_100m' ? 'selected' : '' }}>Over KES 100M</option>
                                </select>
                                @error('budget_range')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Terms and Service Fee -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                                <h4 class="font-medium text-blue-900 mb-2">Introduction Service Fee</h4>
                                <p class="text-sm text-blue-700 mb-2">
                                    Our professional introduction service includes:
                                </p>
                                <ul class="text-xs text-blue-700 space-y-1 mb-3 ml-4">
                                    <li>• Verification of both parties</li>
                                    <li>• Professional introduction email</li>
                                    <li>• Initial meeting coordination</li>
                                    <li>• Ongoing support during early discussions</li>
                                </ul>
                                <p class="text-sm font-medium text-blue-900">Service Fee: KES 2,500 (payable after successful introduction)</p>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" name="agree_to_terms" id="agree_to_terms"
                                       class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 mt-1"
                                       required {{ old('agree_to_terms') ? 'checked' : '' }}>
                                <label for="agree_to_terms" class="ml-3 text-sm text-gray-700">
                                    I agree to the <a href="/terms" class="text-primary hover:underline">terms of service</a>
                                    and understand that a service fee of KES 2,500 will be charged upon successful introduction.
                                    <span class="text-red-500">*</span>
                                </label>
                            </div>
                            @error('agree_to_terms')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-6">
                            <button type="submit"
                                    class="bg-primary text-white px-8 py-3 rounded-lg font-medium hover:bg-primary/90 transition-colors duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Submit Introduction Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </section>

    <!-- JavaScript for dynamic form behavior -->
    <script>
        // Data for populating dropdowns
        const businessProfiles = @json($businessProfiles ?? []);
        const investorProfiles = @json($investorProfiles ?? []);

        function toggleTargetOptions() {
            const introductionType = document.getElementById('introduction_type').value;
            const targetSelect = document.getElementById('target_id');

            // Clear existing options
            targetSelect.innerHTML = '<option value="">Choose a target</option>';

            if (introductionType === 'business') {
                // Populate with business profiles
                businessProfiles.forEach(profile => {
                    const option = document.createElement('option');
                    option.value = profile.id;
                    option.textContent = `${profile.application_data.company_name} - ${profile.application_data.business_industry}`;
                    if ({{ $profile->id ?? 'null' }} == profile.id) {
                        option.selected = true;
                    }
                    targetSelect.appendChild(option);
                });
            } else if (introductionType === 'investor') {
                // Populate with investor profiles
                investorProfiles.forEach(profile => {
                    const option = document.createElement('option');
                    option.value = profile.id;
                    option.textContent = `${profile.company_name} - ${profile.buyer_interest}`;
                    if ({{ $profile->id ?? 'null' }} == profile.id) {
                        option.selected = true;
                    }
                    targetSelect.appendChild(option);
                });
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleTargetOptions();
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const message = document.getElementById('message').value;
            if (message.length < 50) {
                e.preventDefault();
                alert('Please provide a more detailed message (minimum 50 characters).');
                return false;
            }
        });
    </script>
</x-guest-layout>