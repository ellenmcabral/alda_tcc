
<div x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
         class="absolute top-0 left-0 w-full min-h-screen"
         style="display: none;"
         @click="open = false">
        <div class="fixed z-30 h-screen w-fit bg-neutral-white">
            {{ $content }}
        </div>
        <div class="fixed z-20 h-screen w-full bg-black bg-opacity-25">

        </div>
    </div>
</div>
