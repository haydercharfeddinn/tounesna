        // Star Rating Functionality
        function setRating(star) {
            // Set the value of the hidden input to the selected star rating
            document.getElementById("ratingValue").value = star;

            // Change the class of the stars to visually update the selection
            const stars = document.querySelectorAll(".star");
            stars.forEach((starElement, index) => {
                if (index < star) {
                    starElement.style.color = "gold";
                } else {
                    starElement.style.color = "gray";
                }
            });
        }

        // Form validation
        function test() {
            const nom = document.getElementById('nom').value.trim();
            const prenom = document.getElementById('prenom').value.trim();
            const email = document.getElementById('email').value.trim();
            const sujet = document.getElementById('sujet').value.trim();
            const recaptchaResponse = grecaptcha.getResponse();
            const rating = document.getElementById('ratingValue').value;
            

            if (nom === '') {
                alert("Veuillez entrer votre nom.");
                return false;
            }
            if (prenom === '') {
                alert("Veuillez entrer votre prénom.");
                return false;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Veuillez entrer une adresse e-mail valide.");
                return false;
            }
            if (sujet === '') {
                alert("Veuillez entrer votre sujet de réclamation.");
                return false;
            }
            if (rating == 0) {
                alert("Veuillez attribuer une note.");
                return false;
            }
            if (recaptchaResponse.length === 0) {
                alert("Veuillez confirmer que vous n'êtes pas un robot.");
                return false;
            }

            return true;
        }
