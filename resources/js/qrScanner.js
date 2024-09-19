import { Html5Qrcode } from "html5-qrcode";

let isScanning = false;

const queryConvert = async function (data){
    const queryArray = data.split(';');
    let result = {};

    for (let i = 0; i < queryArray.length; i++) {
        const splitArray = queryArray[i].split('=');
        result[splitArray[0]] = splitArray[1];
    }

    return result;
}

const startQrScanner = async function () {
    try {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices.filter(device => device.kind === 'videoinput');

        if (videoDevices.length === 0) {
            document.getElementById('errorMessage').innerHTML = 'No cameras found';
            throw new Error('No cameras found.');
        }

        const html5QrCode = new Html5Qrcode((window.innerWidth > 640) ? 'qr-reader' : 'qr-reader-modal');

        const qrCodeSuccessCallback = async (decodedText) => {
            if (isScanning) {
                return;
            }

            isScanning = true;

            decodedText = await queryConvert(decodedText);
            Livewire.dispatch('openModal', {component: 'qr-code.info-modal', arguments: {data: decodedText}});

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
