<div class="mx-20 my-20 p-10 bg-white dark:bg-gray-800">
    <div class="px-4 sm:px-0">
      <h3 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Sponsorship details</h3>
      <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500 dark:text-gray-300">Details about the sponsorship.</p>
    </div>
    <div class="mt-6 border-t border-gray-100 dark:border-gray-400">
      <dl class="divide-y divide-gray-100 dark:divide-gray-400">
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Company</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{$companyName}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Sponsorship tier</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{$sponsorTier}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Company representative</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{$companyRepName}}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Company representative email</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 dark:text-gray-200 sm:col-span-2 sm:mt-0">{{$companyRepEmail}}</dd>
        </div>
      </dl>
      <div class="flex">
        <form method="POST" action="{{$formActionApprove}}" class="mr-2">
          @csrf
          <x-button
            class="dark:bg-green-500 bg-green-500 hover:bg-green-600 dark:hover:bg-green-600 active:bg-green-600 dark:active:bg-green-600">
            Approve
          </x-button>
        </form>
        <form method="POST" action="{{$formActionReject}}" class="mr-2">
          @csrf
          <x-button
            class="dark:bg-red-500 bg-red-500 hover:bg-red-600 dark:hover:bg-red-600 active:bg-red-600 dark:active:bg-red-600">
            Deny
          </x-button>
        </form>
      </div>
    </div>
  </div>