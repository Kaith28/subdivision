<x-app-layout>
    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-200 border border-green-500 p-2 rounded-md" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div class="bg-red-200 border border-red-500 p-2 rounded-md" role="alert">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Add subscription expiry warning message here -->
    @if ($expiryWarningMessage)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div class="bg-yellow-200 border border-yellow-500 p-2 rounded-md" role="alert">
                {{ $expiryWarningMessage }}
            </div>
        </div>
    @endif

    <div class="pt-4 px-4"> <a href="/dashboard"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>
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
                <h2 class="font-semibold"> Transaction History</h2>
                <div class=" flex flex-col gap-2">

                    @foreach ($transactions as $transaction)
                        <div class="p-2 rounded-md shadow-md font-semibold flex justify-between gap-4 bg-gray-200">
                            <p> ${{ number_format($transaction->amount / 100, 2) }}</p>
                            <p> {{ $transaction->created_at }}</p>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
