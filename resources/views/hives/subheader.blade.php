<dropdown align="left" margin="0" >
    <template v-slot:trigger>
        <button>
            <i class="fas fa-caret-down"></i>
        </button>
    </template>
    <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
        <a href="{{ route('types.index') }}" class="inline-block p-2">{{ trans_choice('hivetypes.type', 2) }}</a>
    </div>
    <div class="hover:bg-secondary-100 -mx-2 px-2">
        <a href="{{ route('queens.index') }}" class="inline-block p-2">{{ trans_choice('queens.queen', 2) }}</a>
    </div>
</dropdown>
