// window.onload=function(){
//     const form = document.getElementById('form');
//     const username = document.getElementById('name');
//     const email = document.getElementById('email');
//     const first_name = document.getElementById('first_name');
//     const last_name = document.getElementById('last_name');
//     const phone = document.getElementById('phone');
//     const password = document.getElementById('password');
//     const password_confirmation = document.getElementById('password_confirmation');

//     form.addEventListener('submit',function(e){
//         e.preventDefault();
        
//         checkInputs();
//     });

//     function checkInputs() {
//         if(username.value === '') {
//             showError(username, 'Please enter your username');
//         } else {
//             showSuccess(username);
//         }

//         if(email.value === '') {
//             showError(email, 'Please enter your email')
//         } else if(!validateEmail(email.value)) {
//             showError(email, 'Not a valid email');
//         }else {
//             showSuccess(email);
//         }

//         if(first_name.value === '') {
//             showError(first_name, 'Please enter your first name')
//         } else {
//             showSuccess(first_name);
//         }

//         if(last_name.value === '') {
//             showError(last_name, 'Please enter your last name')
//         } else {
//             showSuccess(last_name);
//         }

//         if(phone.value === '') {
//             showError(phone, 'Please enter your phone')
//         } else {
//             if(phone.value.length !== 10 ) {
//                 showError(phone, 'phone number must be 10 characters');
//             } else {       
//                 showSuccess(phone);
//             }
//         }

//         if(password.value === '') {
//             showError(password, 'Please enter your password');
//         } else {
//             if(password.value.length <=8 ) {
//                 showError(password, 'Password must be longer than 6 characters');
//             } else if(password.value.length >=20) {
//                 showError(password, 'Password must be less than 20 characters');
//             } else {
//                 showSuccess(password);
//             }
//         }

        
//         if(password_confirmation.value === '') {
//             showError(password_confirmation, 'Please confirm your password');
//         } else if(password.value !== password_confirmation.value) {
//             showError(password_confirmation, 'Passwords does not match');
//         } else{
//             showSuccess(password_confirmation);
//         }
//     }

//     function showError(input, message) {
//         const formControl = input.parentElement;
//         const small = formControl.querySelector('small');
//         formControl.className = 'form-control error';
//         small.innerText = message;                            
//     }

//     function showSuccess(input) {
//         const formControl = input.parentElement;
//         formControl.className = 'form-control success';
//     }

//     function validateEmail(email) {
//         const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//         return re.test(email);
//     }
    
//     function validateNumber(e) {
//         const pattern = /^[0-9]$/;

//         return pattern.test(e.number)
//     }

// }