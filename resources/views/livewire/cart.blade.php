<div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-es-lg rounded-ee-lg lg:rounded-ss-lg lg:rounded-ee-none">
    <h1 class="mb-1 font-medium">Winkelwagentje</h1>

    @if (empty($this->items))
        <p class="mb-2 text-[#706f6c] dark:text-[#A1A09A]">Uw winkelwagentje is nog leeg</p>
    @else
        <ul class="flex flex-col mb-4 lg:mb-6">  
            @foreach ($this->items as $key => $value)
                <li class="flex items-center gap-4 py-2 relative before:border-l before:border-[#e3e3e0] dark:before:border-[#3E3E3A] before:top-1/2 before:left-[0.4rem] before:absolute {{ $loop->last ? '' : 'before:bottom-0' }}">
                    <span class="relative py-1 bg-white dark:bg-[#161615]">
                        <span class="flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border dark:border-[#3E3E3A] border-[#e3e3e0]">
                            <span class="rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] w-1.5 h-1.5"></span>
                        </span>
                    </span>
                    <span>
                        {{ $value['domain'] }}
                        <a class="inline-flex items-center space-x-1 font-medium underline-offset-4 text-[#f53003] dark:text-[#FF4433] ms-1 cursor-pointer">
                            <span wire:click="removeFromCart('{{ $key }}')">❌</span>
                        </a>
                    </span>
                </li>
            @endforeach
        </ul>
        <ul class="flex gap-3 text-sm leading-normal">
            <li>
                <a href="checkout" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal">
                    Afrekenen
                </a>
            </li>
        </ul>
        @endif
</div>