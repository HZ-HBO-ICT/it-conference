function draggable() {
    return {
        dragStart(event) {
            event.dataTransfer.setData('id', event.target.getAttribute('data-id'));
            event.dataTransfer.setData('room', event.target.getAttribute('data-room'));
        },
        drop(event) {
            event.preventDefault();
            const id = event.dataTransfer.getData('id');
            const fromRoom = event.dataTransfer.getData('room');
            const newRoom = event.target.getAttribute('data-room');
            const newTimeslot = event.target.getAttribute('data-timeslot');
            this.$wire.movePresentation(id, fromRoom, newRoom, newTimeslot);
        },
        allowDrop(event) {
            event.preventDefault();
        }
    }
}
