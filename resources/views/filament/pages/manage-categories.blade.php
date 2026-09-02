<x-filament-panels::page>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
        
        @foreach($this->categories as $category)
            <!-- Desain Card Utama -->
            <div style="background-color: white; border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.5rem; display: flex; flex-direction: column; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);">
                
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 0.5rem;">
                    {{ $category->name }}
                </h3>
                
                <p style="font-size: 0.875rem; color: #6b7280; font-weight: 500; margin-top: 0; margin-bottom: 1.5rem;">
                    Total keywords with this group: {{ $category->searchKeywords->count() }}
                </p>

                <!-- List Keyword -->
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem; flex-grow: 1; margin-bottom: 2rem;">
                    @foreach($category->searchKeywords->take(4) as $keyword)
                        <li style="display: flex; align-items: flex-start; font-size: 0.875rem; color: #4b5563; font-weight: 500;">
                            <!-- Titik Biru -->
                            <span style="width: 6px; height: 6px; border-radius: 50%; background-color: #3b82f6; margin-top: 6px; margin-right: 12px; flex-shrink: 0;"></span>
                            {{ $keyword->keyword }}
                        </li>
                    @endforeach
                    
                    @if($category->searchKeywords->count() > 4)
                        <li style="font-size: 0.75rem; color: #9ca3af; margin-left: 18px;">...</li>
                    @endif
                </ul>

                <!-- Tombol Action -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: auto;">
                    
                    <div style="display: flex; gap: 0.75rem;">
                        <!-- Tombol View (Pakai getUrl biar gak error route) -->
                        <a href="{{ \App\Filament\Pages\ViewCategory::getUrl(['slug' => $category->slug]) }}" 
                           style="padding: 0.375rem 1rem; background-color: #f9fafb; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; text-decoration: none; border: 1px solid #e5e7eb; cursor: pointer;">
                            View
                        </a>
                        
                        <!-- Tombol Edit Modal -->
                        <button wire:click="mountAction('editCategory', { id: '{{ $category->id }}' })" 
                                style="padding: 0.375rem 1rem; background-color: #f9fafb; color: #374151; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; border: 1px solid #e5e7eb; cursor: pointer;">
                            Edit
                        </button>
                    </div>
                    
                    <!-- Tombol Delete Modal -->
                    <div>
                        <button wire:click="mountAction('deleteCategory', { id: '{{ $category->id }}' })" 
                                style="padding: 0.375rem 1rem; background-color: #fef2f2; color: #dc2626; font-size: 0.875rem; font-weight: 500; border-radius: 0.5rem; border: 1px solid #fee2e2; cursor: pointer;">
                            Delete
                        </button>
                    </div>

                </div>

            </div>
        @endforeach

    </div>
</x-filament-panels::page>