
        let password = document.getElementById('password');
        let passwordstrength = document.getElementById('password-strength');
        let loweruppercase = document.querySelector('.low-upper-case i');
        let number = document.querySelector('.one-number i');
        let specialchar = document.querySelector('.one-special-char i');
        let eightchar = document.querySelector('.eight-character i');

        function myFunction(show) {
            show.classList.toggle('fa-eye-slash');
            console.log(show.getAttribute('class'));
        }

        function toggle(e) {
            console.log(e.parentNode.parentNode.children[0].getAttribute('type'));
            let elmnt = e.parentNode.parentNode.children[0];
            if(elmnt.getAttribute('type') === 'text')                       {
                elmnt.setAttribute('type', 'password');                
            } 
            else if(elmnt.getAttribute('type') === 'password') {
                elmnt.setAttribute('type', 'text');                
            }
            
        }
        
        document.getElementById("password").onfocus = function() {document.getElementById('passins').style.display = "block";};
        document.getElementById("password").onblur = function() {document.getElementById('passins').style.display = "none";};

        password.addEventListener('keyup', function() {
            let pass = password.value;
            checkStrength(pass);
        });

        function checkStrength(password) {            
            //If password contains lower and upper case
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {                
                loweruppercase.classList.remove('fa-circle');
                loweruppercase.classList.add('fa-check');
                

            } else {
                loweruppercase.classList.add('fa-circle');
                loweruppercase.classList.remove('fa-check');
                
            }

            //If password has number
            if (password.match(/([0-9])/)) {
                number.classList.remove('fa-circle');
                number.classList.add('fa-check');
                
            } else {
                number.classList.add('fa-circle');
                number.classList.remove('fa-check');
                
            }


            //If password has one special character
            if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/)) {
                specialchar.classList.remove('fa-circle');
                specialchar.classList.add('fa-check');
                
            } 
            else {
                specialchar.classList.add('fa-circle');
                specialchar.classList.remove('fa-check');
                
            }

            //If password is more than 7
            if (password.length > 7) {

                eightchar.classList.remove('fa-circle');
                eightchar.classList.add('fa-check');
                
            } else {
                eightchar.classList.add('fa-circle');
                eightchar.classList.remove('fa-check');
                
            }                 
        }

        