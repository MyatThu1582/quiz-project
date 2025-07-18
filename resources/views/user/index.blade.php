<x-app-layout>
<x-slot name="header">
    <div class="flex items-center justify-between">
        {{-- Left: Title + Icon --}}
        <div class="flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M3 20h5v-2a4 4 0 013-3.87m4-6.13a4 4 0 00-8 0v4a4 4 0 008 0v-4z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 leading-tight">
                User Management
            </h2>
        </div>

        @if(session('success'))
            <div 
                x-data="{ show: false }" 
                x-init="$nextTick(() => show = true); setTimeout(() => show = false, 5000);" 
                x-show="show"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="transform translate-x-full opacity-0"
                x-transition:enter-end="transform translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="transform translate-x-0 opacity-100"
                x-transition:leave-end="transform translate-x-full opacity-0"
                class="fixed bottom-5 right-5 z-50 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-lg flex items-center justify-between space-x-3 w-[300px]"
            >
                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>
                <button @click="show = false" class="text-green-800 hover:text-green-900 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Right: Button --}}
        <a href="{{ route('users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-md shadow-sm transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4" />
            </svg>
            Add User
        </a>
    </div>
</x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-800">
                    <thead class="bg-gray-100 border-b text-xs uppercase text-gray-500">
                        <tr>
                            <th class="px-6 py-3">#</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Joined</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $index => $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-xs px-2 py-1 rounded bg-blue-100 text-blue-800">
                                        {{ ucfirst($user->role ?? 'user') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->email_verified_at)
                                        <span class="text-green-600 text-xs font-semibold">Verified</span>
                                    @else
                                        <span class="text-red-600 text-xs font-semibold">Unverified</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    {{-- Edit Role --}}
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="text-indigo-600 hover:text-indigo-900 text-xs font-medium">Edit</a>

                                    {{-- Delete --}}
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class="text-red-600 hover:text-red-900 text-xs font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
