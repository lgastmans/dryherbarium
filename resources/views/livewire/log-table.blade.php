<div>

    <h1 class="mb-4 py-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-4xl dark:text-white">
        <span class="underline underline-offset-3 decoration-4 decoration-blue-400 dark:decoration-blue-600">User Activity Log</span>
    </h1>

    <form class="max-w-sm">
        <div class="grid grid-cols-12 py-4">
            <div class="col-span-6 gap-4 px-6">
                <x-select
                    placeholder="Select a period"
                    :options="[
                        ['name' => 'This week', 'id' => '_WEEK', 'selected'],
                        ['name' => 'This Month', 'id' => '_MONTH'],
                        ['name' => 'Last 6 Months', 'id' => '_6MONTHS'],
                        ['name' => 'All', 'id' => '_ALL'],
                    ]"
                    option-label="name"
                    option-value="id"
                    wire:model="period"
                />
            </div>
            <div class="col-span-6 gap-4">
                <x-button sm icon="refresh" dark label="Load" wire:click="load" />

            </div>
        </div>
    </form>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 py-24"> 
        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    On
                </th>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($activities as $activity)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $activity['created_at'] }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $activity['username'] }} 
                    </td>
                    <td class="px-6 py-4">
                        {!! $activity['description'] !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="py-24 mb-12"></div>
</div>
