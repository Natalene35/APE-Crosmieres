<template>
    <section>
        <h1>Mentions légales</h1>

        <div>
            <h2>Mentions de droits réservés</h2>
            <p>Conformément à la Loi « Informatique et Libertés » n° 78-17 du 6 janvier 1978, les informations vous
                concernant sont destinées à APE de Crosmières, responsable du traitement. Vous disposez d'un droit
                d'accès,
                de rectification et de suppression des données qui vous concernent. Vous pouvez exercer ce droit en
                adressant un e-mail à l'adresse électronique suivante : apecrosmières@gmail.com</p>
            <p>Les informations fournies seront exploitées de manière anonyme et non nominatives à des fins d'analyse et
                de
                statistique.</p>
            <p>En vous connectant à ce site édité et mis en ligne par APE Crosmières, vous accédez à un contenu protégé
                par
                la loi, notamment par les dispositions du Code de la propriété intellectuelle.</p>
            <p>APE de Crosmières n'autorise qu'un usage strictement personnel des données, informations ou contenus
                auxquels
                vous accédez, limité à un enregistrement temporaire sur votre ordinateur aux fins d'affichage sur un
                seul
                écran ainsi que la reproduction, en un unique exemplaire, pour copie de sauvegarde ou impression sur
                papier.
            </p>
            <p>Toute autre utilisation est soumise à notre autorisation expresse préalable. En poursuivant votre visite
                de
                notre site vous acceptez de respecter les restrictions ci-dessus.</p>
            <p>APE de Crosmières se réserve le droit de modifier, à tout moment et sans préavis, le contenu de ce site.
                En
                outre, APE de Crosmières décline toute responsabilité en cas de retard, d'erreur ou d'omission quant au
                contenu des présentes pages de même qu'en cas d'interruption ou de non-disponibilité du service.</p>
            <p>La création de liens hypertextes vers le site de APE de Crosmières ainsi que les liens hypertextes
                établis en
                direction d'autres sites à partir du site de APE de Crosmières n'engagent pas la responsabilité de APE
                de
                Crosmières.</p>
        </div>

        <h2>Conditions Générales d'Utilisation</h2>

        <div>
            <h3>Ce site est édité par :</h3>
            <p>APE de Crosmières</p>
            <p>Siège : Crosmières</p>
            <p>Association sans but lucratif loi 1901</p>
            <p>Déclaration du 01/11/2014 n°W353013316</p>
            <a href="http//apecrosmieres.fr">http://apecrosmieres.fr</a>
            <p>Email : apecrosmieres@gmail.com</p>
            <p>Présidente de L’APE de Crosmièeres : Madame Charlotte </p>
        </div>

        <div>
            <h3>Ce site est hébergé par la société OVH.</h3>
            <p>Hébergeur : OVH</p>
            <p>Société : OVH</p>
            <p>Adresse web : www.ovh.com</p>
            <p>Adresse Postale : 2 rue kellermann</p>
            <p>BP 80157</p>
            <p>59053 ROUBAIX Cedex 1</p>
            <p>Téléphone : +33 (0)8 203 203 63</p>
            <p>Adresse électronique (E-Mail) : support@ovh.com</p>
            <p>formulaire de communication à suivre sur le site de "OVH"</p>
        </div>

        <div>
            <h3>Webmaster / Référenceur</h3>
            <p>Team APE</p>
        </div>

        <div>
            <h3>Propriété intellectuelle</h3>
            <p>La présentation, le contenu de ce site ainsi que les bases de données associées, constituent une oeuvre
                protégée par le code de la propriété intellectuelle et restent la propriété exclusive de L’APE de
                Crosmières.</p>
            <p>Toute reproduction, représentation totale ou partielle de ce site par quelque procédé que ce soit, sans
                l’autorisation expresse de l’exploitant du site Internet, est interdite et constituerait une contrefaçon
                sanctionnée par les articles L-335.2 et suivants du Code de la propriété intellectuelle.</p>
        </div>
    </section>
</template>

<script>
export default {
    name: "LegalsMentionsLayout",
}
</script>

<style lang="scss" scoped>
section {
    color: $grey;
    width: 90%;
    margin: auto;
    text-align: left;
    margin-bottom: 2rem;

    h1,
    h2,
    h3,
    h4 {
        margin: 1rem 0;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 2rem;
    }

    p {
        margin: 1rem 0;
    }

    h2 {
        font-size: 1.8rem;
    }

    h3 {
        font-size: 1.5rem;
    }
    a {
        color: $orange;
        text-shadow: 1px 1px 1px $black;
        transition: 1s;
    }

    a:hover {
        transform: scale(1.25);
        font-size: 1.1rem;
    }
    
}

// media query
@media (min-width: 480px) {
    section {
        width: 80%;
    }
}

@media (min-width: 1024px) {
    section {
        width: 70%;

        h1 {
            font-size: 3rem;
        }

        h2 {
            font-size: 2rem;
        }
    }
}
</style>