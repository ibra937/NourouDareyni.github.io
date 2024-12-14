<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="../media/logo-tete.png">
    <title>À propos</title>
    <style>
        /* Styles généraux */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        header.site-header {
            text-align: center;
            background-color: #800000;
            color: white;
            padding: 20px 0;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        header p {
            font-size: 1.2em;
            margin-top: 10px;
        }

        /* Section principale */
        .about-section {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-section h2 {
            font-size: 2em;
            color: #800000;
            margin-bottom: 20px;
            text-align: center;
        }

        .about-section p {
            font-size: 1.2em;
            line-height: 1.8;
            text-align: justify;
        }

        .about-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 30px;
        }

        .about-images img {
            width: 300px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .about-images img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer.site-footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .about-images img {
                width: 90%; /* Réduction pour les écrans plus petits */
            }

            .about-section h2 {
                font-size: 1.8em;
            }

            .about-section p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <h1>À propos</h1>
        <p>Découvrez notre mission, nos valeurs et notre expertise.</p>
    </header>

    <section class="about-section">
        <h2>Qui sommes-nous ?</h2>
        <p>
            Bienvenue chez **Nourou Darayni Services**, une entreprise spécialisée dans le transport de colis et de marchandises entre l'Afrique et l'Europe. 
            Depuis notre création, nous nous engageons à fournir des services de transport fiables, rapides et sécurisés, adaptés aux besoins de notre clientèle.
        </p>
        <p>
            Grâce à notre expertise et à un réseau international bien établi, nous offrons des solutions sur mesure, que ce soit pour le transport maritime ou aérien. 
            Nous travaillons avec des partenaires de confiance pour garantir la satisfaction de nos clients à chaque étape du processus logistique.
        </p>

        <h2>Pourquoi nous choisir ?</h2>
        <p>
            Chez Nourou Darayni Services, nous mettons tout en œuvre pour offrir à nos clients une expérience de transport exceptionnelle. Voici ce qui nous distingue :<br>
<br>
<b>Fiabilité :</b> Nous assurons la sécurité de vos colis grâce à des protocoles rigoureux et des partenaires de confiance.<br>
<b>Rapidité :</b> Nos solutions logistiques optimisées garantissent des délais de livraison respectés, que ce soit par voie maritime ou aérienne.<br>
<b>Accessibilité :</b> Nous proposons des tarifs compétitifs adaptés aux besoins des particuliers et des entreprises.<br>
<b>Service personnalisé :</b> Notre équipe est dédiée à vous accompagner à chaque étape, du suivi en temps réel à la résolution de vos demandes spécifiques.<br>
<b>Présence internationale :</b> Grâce à un réseau étendu en Afrique, en Europe et aux États-Unis, nous offrons des solutions de transport globales.<br><br>
<b>Choisir Nourou Darayni Services, c'est opter pour la tranquillité d'esprit et la satisfaction garantie.</b>
        </p>

        <h2>Notre mission</h2>
        <p>
            Notre mission est de faciliter les échanges entre continents en proposant des services de transport de qualité supérieure. 
            Nous visons à devenir un leader dans notre domaine en mettant l'accent sur la satisfaction client, l'innovation et le respect des délais.
        </p>

        <div class="about-images">
            <img src="../media/conteneur.jpg" alt="Transport maritime">
            <img src="../media/transport-aerien.png" alt="Transport aérien">
            <img src="../media/equipe.jpg" alt="Equipe en action">
        </div>
    </section>

    <footer class="site-footer">
        <p>&copy; 2024 - Nourou Darayni Services | Tous droits réservés</p>
    </footer>
</body>
</html>
