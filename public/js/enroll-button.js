const participationButtons = document.getElementsByClassName('participation-buttons');
const presentations = document.getElementsByClassName('presentations');
let lastEnrolledPresentationStartTime = [];
let lastEnrolledPresentationType = '';

//loop through all presentations
for (let i = 0; i < presentations.length; i ++) {
    //if user is already registered for a current presentation
    if (participationButtons[i].innerHTML === 'Disenroll') {

        //remember the start time of the enrolled presentation
        lastEnrolledPresentationStartTime = presentations[i].innerHTML.substring(0, 5).split(':');

        //remember the type of the enrolled presentation
        if (presentations[i].innerHTML.includes('Presentation')) lastEnrolledPresentationType = 'Presentation';
        else lastEnrolledPresentationType = 'Workshop';

        //loop through previous presentations
        for (let j = 0; j < i; j ++) {
            //remember the start time of the presentation on current iteration
            const currentTime = presentations[j].innerHTML.substring(0, 5).split(':');

            //check if the difference between start times of last enrolled presentation and presentation
            //on current iteration is less than 60 minutes (if current presentation is of type 'presentation') or less than 90 minutes (if current presentation is of type 'workshop')
            if (((+lastEnrolledPresentationStartTime[0]) * 60 + (+lastEnrolledPresentationStartTime[1]) - ((+currentTime[0]) * 60 + (+currentTime[1]))) < 60 && presentations[j].innerHTML.includes('Presentation')
                || ((+lastEnrolledPresentationStartTime[0]) * 60 + (+lastEnrolledPresentationStartTime[1]) - ((+currentTime[0]) * 60 + (+currentTime[1]))) < 90 && presentations[j].innerHTML.includes('Workshop')) {
                //if one of the checks is true, disable current button
                disableButton(j);
            }
        }
    }
    //if user is not registered for current presentation and the last enrolled presentation exists
    else if (participationButtons[i].innerHTML === 'Enroll' && lastEnrolledPresentationStartTime.length !== 0) {

        //remember the start time of current presentation
        const currentTime = presentations[i].innerHTML.substring(0, 5).split(':');

        //perform the same check, but the other way around
        if (((+currentTime[0]) * 60 + (+currentTime[1])) - ((+lastEnrolledPresentationStartTime[0]) * 60 + (+lastEnrolledPresentationStartTime[1])) < 60 && lastEnrolledPresentationType === 'Presentation'
        || ((+currentTime[0]) * 60 + (+currentTime[1])) - ((+lastEnrolledPresentationStartTime[0]) * 60 + (+lastEnrolledPresentationStartTime[1])) < 90 && lastEnrolledPresentationType === 'Workshop') {
            //if one of the checks is true, disable current button
            disableButton(i);
        }
    }
}

/**
 * disables button on specified id
 * @param id of a button
 */
function disableButton(id) {
    participationButtons[id].className = 'participation-buttons bg-gray-500 py-0.5 px-8 mr-2 mb-2 text-sm font-medium text-gray-300 rounded-full';
    participationButtons[id].style.pointerEvents = 'none';
}
