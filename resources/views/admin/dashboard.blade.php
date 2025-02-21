<x-layout-admin>
    <div class="p-4 md:p-6 md:ml-[250px] overflow-x-auto">
        <!-- Container untuk kartu -->
        <div class="flex flex-wrap md:flex-nowrap gap-4">
            
            <!-- Earnings (Monthly) Card -->
            <div class="w-full md:w-1/2 lg:w-1/4 bg-white border-l-4 border-blue-500 shadow-md p-4 rounded-lg flex items-center justify-between">
                <div>
                    <div class="text-xs font-bold text-blue-500 uppercase mb-1">Earnings (Monthly)</div>
                    <div class="text-lg font-bold text-gray-800">$40,000</div>
                </div>
                <i class="fas fa-calendar text-gray-300 text-3xl"></i>
            </div>

            <!-- Earnings (Annual) Card -->
            <div class="w-full md:w-1/2 lg:w-1/4 bg-white border-l-4 border-green-500 shadow-md p-4 rounded-lg flex items-center justify-between">
                <div>
                    <div class="text-xs font-bold text-green-500 uppercase mb-1">Earnings (Annual)</div>
                    <div class="text-lg font-bold text-gray-800">$215,000</div>
                </div>
                <i class="fas fa-dollar-sign text-gray-300 text-3xl"></i>
            </div>

            <!-- Tasks Card -->
            <div class="w-full md:w-1/2 lg:w-1/4 bg-white border-l-4 border-blue-400 shadow-md p-4 rounded-lg">
                <div class="text-xs font-bold text-blue-400 uppercase mb-1">Tasks</div>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-800 mr-3">50%</span>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-400 h-2 rounded-full" style="width: 50%;"></div>
                    </div>
                </div>
                <i class="fas fa-clipboard-list text-gray-300 text-3xl mt-2"></i>
            </div>

            <!-- Pending Requests Card -->
            <div class="w-full md:w-1/2 lg:w-1/4 bg-white border-l-4 border-yellow-500 shadow-md p-4 rounded-lg flex items-center justify-between">
                <div>
                    <div class="text-xs font-bold text-yellow-500 uppercase mb-1">Pending Requests</div>
                    <div class="text-lg font-bold text-gray-800">18</div>
                </div>
                <i class="fas fa-comments text-gray-300 text-3xl"></i>
            </div>

        </div>
    </div>
</x-layout-admin>
