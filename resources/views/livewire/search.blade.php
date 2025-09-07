<div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-es-lg rounded-ee-lg lg:rounded-ss-lg lg:rounded-ee-none">
   <h1 class="mb-1 font-medium">Domeinnaam</h1>
   <form wire:submit.prevent>
        <input type="text" placeholder="mintymedia.nl" wire:model.live="query" wire:model.debounce.500ms="query" class="w-full px-5 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-sm bg-white dark:bg-[#161615] text-[#1C1C1A] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent" />
        <div wire:loading>Bezig met zoeken...</div>
   </form>
   @if (!empty($this->results))
    <ul>
            @foreach ($this->results as $key => $value)
                <li class="py-2">
                    {{ $value['domain'] }}
                    <a class="inline-flex items-center space-x-1 font-medium underline-offset-4 text-[#f53003] dark:text-[#FF4433] ms-1 cursor-pointer">
                        <span wire:click="addToCart('{{ $key }}')">{{ $value['added_to_cart'] ? '✅' : '➕'}}</span>
                    </a>
                </li>
            @endforeach
    @endif
</div>
