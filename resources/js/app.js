import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// const likeButtons = document.querySelectorAll(".puzzle-like");

// for (let index = 0; index < likeButtons.length; index++) {
//     const likeButton = likeButtons[index];

//     likeButton.addEventListener("click", (event) => {
//           event.stopPropagation();

//         console.log(this);
//         const targetButton = document.querySelector("#" + event.target.id);

//         targetButton.classList.toggle("liked");

//         const puzzleId = event.target.id.replace("puzzle-", "").replace("-like", "");

//         if (targetButton.classList.contains('liked')) {
//             fetch(`/puzzle/${puzzleId}/like`, {
//                 method: 'GET',
//             })
//             .then((data) => {
//                 if (data) {
//                     console.log(data);
//                 }
//             })
//         } else {
//             fetch(`/puzzle/${puzzleId}/dislike`, {
//                 method: 'GET',
//             })
//             .then((data) => {
//                 if (data) {
//                     console.log(data);
//                 }
//             })
//         }       
//     });
// }