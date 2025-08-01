<li class="dd-item" data-id="{{ $page->id }}">
    <div class="dd-handle">{{ $page->title }}</div>
    @php
        $children = $page->children ?? collect(); // adjust based on how you load relations
    @endphp
    @if($children->count())
        <ol class="dd-list">
            @foreach($children as $child)
                @include('dashboard.admin.pages_menu.menu-item', ['page' => $child])
            @endforeach
        </ol>
    @endif
</li>
