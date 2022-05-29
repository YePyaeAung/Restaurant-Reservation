<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    @if (session()->has('danger'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            <span class="font-medium">{{session()->get('danger')}}!</span>
        </div>
    @endif
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
            <span class="font-medium">{{session('success')}}!</span>
        </div>
    @endif
    @if (session('warning'))
        <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
            <span class="font-medium">{{session('warning')}}!</span>
        </div>
    @endif
</div>