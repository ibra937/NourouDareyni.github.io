<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../media/logo-tete.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <title>Contactez-nous - Nourou Darayni Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #800000;
        }

        .contact-info, .contact-form {
            margin: 20px 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .contact-info p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .contact-info i {
            color: #800000;
            margin-right: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea, button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #800000;
            color: white;
            font-size: 18px;
            cursor: pointer;
            width: 60%;
            margin-left: 20%;
        }

        button:hover {
            background-color: #a00000;
        }

        .map {
            margin-top: 20px;
            text-align: center;
        }

        .map iframe {
            width: 100%;
            max-width: 90%;
            height: 300px;
            border: 0;
            border-radius: 15px;
        }
        @media (max-width: 768px) {
            .contact-info p {
                margin: 10px 0;
                line-height: 2.5;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h1>Contactez-nous</h1>
        <h2>Nous sommes à votre écoute</h2>

            <img src="../media/Information.png" alt="Image Actualité 3" style="width: 30%; height: 40vh; margin-right: 5%;"align="right">
        <div class="contact-info">
            <h3>Nos coordonnées</h3>
            <p><i class="fa fa-phone"></i> Téléphone : +221 78 694 3434</p>
            <p><i class="fa fa-envelope"></i> Email : nouroudarayniservices1@gmail.com</p>
            <p><i class="fa fa-map-marker"></i> Adresse : Nord-Foird, Dakar, Sénégal</p>
            <p><i class="fa fa-clock"></i> Heures d'ouverture : 7/7j, 9h - 21h</p>
        </div>

        <div class="contact-form">
            <h3>Laissez-nous un message</h3>
            <form action="#" method="POST">
                <label for="name">Nom complet :</label>
                <input type="text" id="name" name="name" placeholder="Entrez votre nom" required>

                <label for="email">Adresse email :</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" placeholder="Tapez votre message ici..." required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </div>

        <div class="contact-form">
            <h1>Nos agences</h1>
            <img src="../media/contactus.jpg" alt="Image Actualité 3" style="width: 100%;">
        </div>

        <div class="map">
            <h1>Nous trouver</h1>
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3858.2675284729503!2d-17.466241824890872!3d14.753951985750799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTTCsDQ1JzE0LjIiTiAxN8KwMjcnNDkuMiJX!5e0!3m2!1sfr!2ssn!4v1733868152972!5m2!1sfr!2ssn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<h2 align="center">Nord Foire<h2>
<h4 align="center">Tout droit en face brioche doré<h4>

            <iframe src="https://www.google.com/maps/embed?pb=!4v1733869301928!6m8!1m7!1sBL2b4X1IkShPWrQ9U-qQhw!2m2!1d14.75489591495606!2d-17.46264116648445!3f283.95288995896607!4f-8.494900012882098!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</body>
</html>
