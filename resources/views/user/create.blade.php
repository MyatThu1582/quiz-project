<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                    Create New User
                </h2>
            </div>

            <a href="{{ route('users.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-800 rounded-md shadow-sm transition">
                ← Back to User List
            </a>
        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Role --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Role</label>
                        <select name="role"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                    hover:border-indigo-400 transition duration-200 ease-in-out
                                    px-3 py-2 bg-white cursor-pointer">
                            <option value="" disabled selected>-- Choose Role  --</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Password</label>
                        <input type="password" name="password"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
