document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reclamationForm");

    form.addEventListener("submit", (e) => {
        let isValid = true;
        let errors = [];

        // Récupérer les champs
        const nom = document.getElementsByName("nomrec")[0].value.trim();
        const email = document.getElementsByName("adressmail")[0].value.trim();
        const sujet = document.getElementsByName("sujetrec")[0].value.trim();
        const description = document.getElementsByName("descriptionrec")[0].value.trim();

        // Effacer les anciens messages d'erreur
        document.querySelectorAll(".error-message").forEach((el) => el.remove());

        // Validation du champ Nom
        if (!nom) {
            isValid = false;
            errors.push({ field: "nomrec", message: "Le champ 'Nom' est obligatoire." });
        }

        // Validation du champ Email
        if (!email) {
            isValid = false;
            errors.push({ field: "adressmail", message: "Le champ 'Email' est obligatoire." });
        } else if (!/\S+@\S+\.\S+/.test(email)) {
            isValid = false;
            errors.push({ field: "adressmail", message: "Veuillez entrer une adresse email valide." });
        }

        // Validation du champ Sujet
        if (!sujet) {
            isValid = false;
            errors.push({ field: "sujetrec", message: "Le champ 'Sujet' est obligatoire." });
        }

        // Validation du champ Description
        if (!description) {
            isValid = false;
            errors.push({ field: "descriptionrec", message: "Le champ 'Description' est obligatoire." });
        }

        // Affichage des erreurs
        errors.forEach(({ field, message }) => {
            const fieldElement = document.getElementsByName(field)[0];
            const errorElement = document.createElement("span");
            errorElement.className = "error-message";
            errorElement.style.color = "red";
            errorElement.style.fontSize = "14px";
            errorElement.textContent = message;
            fieldElement.parentNode.appendChild(errorElement);
        });

        // Empêcher l'envoi si le formulaire n'est pas valide
        if (!isValid) {
            e.preventDefault();
        }
    });
});
