<x-filament-panels::page>
    <div
        style="background-color: white; border-radius: 0.75rem; border: 1px solid #e5e7eb; padding: 2.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); max-width: 48rem;">

        <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 2rem;">
            {{ $categoryData->name }}
        </h2>

        <div style="display: flex; flex-direction: column; gap: 1.25rem; margin-bottom: 2.5rem;">
            @foreach ($categoryData->searchKeywords as $keyword)
                <div
                    style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f3f4f6; padding-bottom: 0.75rem;">

                    <!-- Tanda titik dan text -->
                    <div
                        style="display: flex; align-items: center; flex-grow: 1; color: #4b5563; font-weight: 500; font-size: 0.875rem;">
                        <span
                            style="width: 6px; height: 6px; border-radius: 50%; background-color: #3b82f6; margin-right: 0.75rem; flex-shrink: 0;"></span>
                        {{ $keyword->keyword }}
                    </div>
                    
                    <!-- Area Tombol Action (Edit & Delete) -->
                    <div style="display: flex; gap: 0.5rem; align-items: center;">

                        <!-- Icon Action Edit (Pensil) -->
                        <button wire:click="mountAction('editKeyword', { id: '{{ $keyword->id }}' })"
                            style="color: #9ca3af; background: transparent; border: none; cursor: pointer; padding: 0.25rem; display: flex; align-items: center; justify-content: center;"
                            onmouseover="this.style.color='#f59e0b'" onmouseout="this.style.color='#9ca3af'">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </button>

                        <!-- Icon Action Delete (Tong Sampah) -->
                        <button wire:click="mountAction('deleteKeyword', { id: '{{ $keyword->id }}' })"
                            style="color: #9ca3af; background: transparent; border: none; cursor: pointer; padding: 0.25rem; display: flex; align-items: center; justify-content: center;"
                            onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#9ca3af'">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol Add Keyword -->
        <button wire:click="mountAction('addKeyword')"
            style="padding: 0.625rem 1.25rem; background-color: #f9fafb; color: #374151; font-size: 0.875rem; font-weight: 600; border-radius: 0.5rem; border: 1px solid #e5e7eb; cursor: pointer;"
            onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='#f9fafb'">
            Add Keyword
        </button>

    </div>
</x-filament-panels::page>
