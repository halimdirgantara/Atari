<div>
    <button wire:click="$emit('refreshPage')">Trigger Refresh</button>
</div>

<script>
    Livewire.on('refreshPage', () => {
        // Untuk refresh seluruh halaman
        window.location.reload();
    });
</script>
