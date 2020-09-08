// Function to check the form taken from bootstrap doc 

let surname = document.getElementById('surname');
let firstname = document.getElementById('firstname');
let email = document.getElementById('email');
let phone = document.getElementById('phone');
let title = document.getElementById('title');
let category = document.getElementById('category');
let details = document.getElementById('details');
let inputEvents = [surname, firstname, email, phone, title, category, details];

(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()




// function checkValidity(){
//     for(let inputEvent in inputEvents){
//         console.log(inputEvent[0]);
//         inputEvent.addEventListener("input", function(){
           
//             inputEvent.
//         })
//     }
// }
