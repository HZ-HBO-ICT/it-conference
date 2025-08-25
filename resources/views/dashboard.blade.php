<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Welcome to your Dashboard!
                    </div>
                    <div class="mt-6 text-gray-500">
                        Here you can manage your team, presentations, booths, and more.
                    </div>
                </div>
                <div class="bg-orange-100 bg-opacity-50 border-t border-gray-200 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                            <span class="text-3xl font-bold text-orange-500">{{ \App\Models\Company::count() }}</span>
                            <span class="mt-2 text-gray-700">Companies</span>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                            <span class="text-3xl font-bold text-orange-500">{{ \App\Models\Booth::count() }}</span>
                            <span class="mt-2 text-gray-700">Booths</span>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center">
                            <span class="text-3xl font-bold text-orange-500">{{ \App\Models\Presentation::count() }}</span>
                            <span class="mt-2 text-gray-700">Presentations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
