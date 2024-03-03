<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4">
                <h1 class="font-bold text-5xl">Billing</h1>
                <div class="p-5 rounded-md shadow-md font-semibold flex justify-between gap-4 bg-gray-200">
                    <p>Expiration:
                        <span class="font-normal">{{ $expiration }}
                        </span>
                    </p>
                    <a
                        class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "href={{ route('billing.extend') }}>Extend
                        <div class="font-bold text-sm">30 Days</div>
                    </a>
                </div>
            </div>
            <div class="flex flex-col gap-4 pt-10">
                <h2 class="font-semibold">History</h2>
                <p>Date - Amount</p>
            </div>
        </div>
    </div>


</x-app-layout>
