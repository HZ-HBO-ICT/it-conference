import { Html5Qrcode } from "html5-qrcode";

let isScanning = false;

const decodeResponse = async function (data){
    const parts = data.split(';');
    let result = {};

    for (let i = 0; i < parts.length; i++) {
        const keyValue = parts[i].split('=');
        result[keyValue[0]] = keyValue[1];
    }

    return result;
}

const startQrScanner = async function () {
    try {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices.filter(device => device.kind === 'videoinput');

        if (videoDevices.length === 0) {
            document.getElementById('errorMessage').innerHTML = 'No cameras found';
            return;
        }

        const scannerContainer = document.getElementById((window.innerWidth > 640) ? 'qr-reader' : 'qr-reader-modal');
        const html5QrCode = new Html5Qrcode(scannerContainer.id);

        const roomSelect = document.getElementById('room-select');
        let selectedRoom;

        roomSelect.addEventListener('change', function() {
            selectedRoom = this.value;
        })

        const qrCodeSuccessCallback = async (response) => {
            if (isScanning) {
                return;
            }

            isScanning = true;

            const decodedText = await decodeResponse(response);

            if (selectedRoom) {
                decodedText['room'] = selectedRoom;
            }

            Livewire.dispatch('openModal', {component: 'qr-code.info-modal', arguments: { data: decodedText }});

            html5QrCode.stop().then(() => {
                console.log('QR code scanner stopped...');
            }).catch(err => {
                console.error("Failed to stop the QR code scanner: ", err);
            });

            setTimeout(() => {
                isScanning = false;

                Livewire.dispatch('closeModal');
                html5QrCode.start(facingMode, config, qrCodeSuccessCallback);

                console.log('QR code scanner started...');
            }, 3000);
        };

        const config = { fps: 10, qrbox: (window.innerWidth > 640) ? 500 : 150 };
        let facingMode = { facingMode: 'environment' };

        if (videoDevices.length > 1) {
            // If there are multiple cameras, choose the back camera if available
            const environmentCameras = videoDevices.filter(device => device.label.toLowerCase().includes('back') || device.label.toLowerCase().includes('rear'));
            if (environmentCameras.length > 0) {
                facingMode = { facingMode: { exact: 'environment' } };
            } else {
                // Use front camera if no back camera is found
                facingMode = { facingMode: { exact: 'user' } };
            }
        }

        await html5QrCode.start(facingMode, config, qrCodeSuccessCallback);
    } catch (err) {
        console.error('Error starting QR code scanner:', err);
    }
}

document.addEventListener('livewire:navigated', () => {
    if (document.getElementById('qr-reader') && window.innerWidth > 640) {
        startQrScanner();
    }
});

Livewire.on('enableScanner', (event) => {
    startQrScanner();
});
