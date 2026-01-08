<div class="mt-4" wire:ignore>

    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <label class="block text-sm font-control text-gray-700 mb-2">Envoyer à :</label>
            <select wire:model="target" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                <option value=""></option>
                @forelse ($collection as $item)
                    <option value="{{$item->id}}">{{$item->nameCategory}}</option>
                @empty
                    
                @endforelse
            </select>
        </div>


        <input id="trix_editor" type="hidden" name="content" wire:model.defer="message_custom">
        <trix-editor input="trix_editor" class="bg-white border-gray-300 rounded-lg shadow-sm min-h-[200px]"></trix-editor>
        <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white mt-4">
            Envoyer les notifications
        </button>
    </form>
    
    
    <script>
        // Synchronisation de Trix vers Livewire
        var element = document.querySelector("trix-editor")
        element.addEventListener("trix-change", function() {
            @this.set('message_custom', element.value)
        })
    </script>
</div>
