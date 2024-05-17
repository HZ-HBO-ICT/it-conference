function draggable() {
    return {
        dragStart(event) {
            event.dataTransfer.setData('id', event.target.getAttribute('data-id'));
            event.dataTransfer.setData('room', event.target.getAttribute('data-room'));
            document.getElementById('grid-body').classList.add('moving');
        },
        drop(event) {
            event.preventDefault();
            const id = event.dataTransfer.getData('id');
            const newRoom = event.target.getAttribute('data-room');
            const newTimeslot = event.target.getAttribute('data-timeslot');
            this.$wire.movePresentation(id, newRoom, newTimeslot);
            document.getElementById('grid-body').classList.remove('moving');
        },
        allowDrop(event) {
            event.preventDefault();
        }
    }
}
