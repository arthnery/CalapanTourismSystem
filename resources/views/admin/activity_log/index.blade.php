<x-app-layout>
    <style>
        .force-gradient {
            background: linear-gradient(to right, #2563eb, #f97316) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            color: transparent !important;
            display: inline-block;
        }
        .apple-heading {
            font-weight: 700;
            letter-spacing: -0.025em;
        }
    </style>

    <div class="relative min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-4xl font-bold apple-heading">Activity Log. <span class="text-gray-400">System audit trail.</span></h1>
                <p class="text-gray-500 mt-2">Monitor system-wide actions and user activities.</p>
            </div>

            <div class="apple-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">User</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Activity</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Description</th>
                                <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-gray-400">Date & Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($logs as $log)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-3">
                                                {{ substr($log->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-gray-900">{{ $log->user->name }}</div>
                                                <div class="text-xs text-gray-400">{{ $log->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-50 text-blue-600">
                                            {{ $log->activity }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-sm text-gray-600 max-w-md">{{ $log->description }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-sm text-gray-900">{{ $log->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $log->created_at->format('h:i A') }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
