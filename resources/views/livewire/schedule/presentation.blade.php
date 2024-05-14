<div
     x-data="draggable()"
     draggable="true"
     @dragstart="dragStart"
     @drop.prevent.stop
     @dragover.prevent.stop
     data-id="{{ $presentation->id }}"
     data-room="{{ $presentation->id }}"
     class="z-50 w-full absolute {{ $presentation->type == 'workshop' ? 'h-40 bg-sky-300' : 'h-14 bg-orange-300' }}">
    <h3>{{ $presentation->name }}</h3>
</div>
