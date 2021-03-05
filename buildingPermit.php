<?php
session_start();
$pagetitle = 'Plessis de Roye - Permis de construire';
include_once 'includes/header.php';
?>
<main>
    <h2 class="pageTitle text-center mt-4">Permis de construire</h2>
    <section class="row m-0 d-flex justify-content-center">
        <div class="col-md-6 col-sm-12">
            <article>
                <h3>Principe</h3>
                <p>Le permis de construire est un acte administratif qui donne les moyens à l'administration de vérifier qu'un projet de construction respecte bien les règles d'urbanisme en vigueur.
                    Il est généralement exigé pour tous les travaux assez importants.
                </p>
            </article>
            <article class="mt-5">
                <h3>Travaux concernés</h3>
                <p>Un permis de construire est notamment exigé dès lors que les travaux envisagés sur une construction existante :</p>
                <ul>
                    <li>ont pour effet de créer une surface de plancher ou une emprise au sol supérieure à 20 m²</li>
                    <li>ou ont pour effet de créer une surface de plancher ou une emprise au sol supérieure à 40 m² dans les zones urbaines couvertes par un plan local d'urbanisme (PLU) ou un document assimilé. Toutefois, à partir de 40 m² de surface de plancher ou d'emprise au sol, un permis de construire est exigé</li>
                    <li>ou ont pour effet de modifier les structures porteuses ou la façade du bâtiment, lorsque ces travaux s'accompagnent d'un changement de destination (par exemple, transformation d'un local commercial en local d'habitation)</li>
                    <li>ou portent sur un immeuble inscrit au titre des monuments historiques ou se situant dans un secteur sauvegardé</li>
                </ul>
                <p>S'agissant des constructions nouvelles, elles doivent être précédées de la délivrance d'un permis de construire, à l'exception des constructions qui sont dispensées de toute formalité et celles qui doivent faire l'objet d'une démarche préalable.</p>
                <p class="font-weight-bold">Pour plus de détails, cliquez <a href="https://www.service-public.fr/particuliers/vosdroits/F1986" target="_blank" title="Service Public">ici</a>.</p>
            </article>
            <article class="mt-5">
                <h3>Recours à un architecte</h3>
                <p>Les conditions légales d’intervention d’un architecte pour déposer une demande ADS sont :</p>
                <ul>
                    <table>
                        <tbody>
                            <tr>
                                <td><li>Construction neuve de plus de 150 m² de surface de plancher (SdP)</li></td>
                        <td>► Architecte obligatoire</td>
                        </tr>
                        <tr>
                            <td><li>Travaux sur bâti existant : si le projet porte la SdP au-delà de 150 m²</li></td>
                        <td>► Architecte obligatoire</td>
                        </tr>
                        <tr>
                            <td><li>Existant déjà à 150 m² et + de 20 m²</li></td>
                        <td>► Architecte obligatoire</td>
                        </tr>
                        <tr>
                            <td><li>Si le projet crée moins de 20 m² de SdP, même au-delà de 150 m² existants mais pas obligatoire (projet soumis à DP)</li></td>
                        <td>► Architecte recommandé</td>
                        </tr>
                        </tbody>
                    </table>
                </ul>
                <p class="font-weight-bold">Pour plus de détails, cliquez <a href="https://www.service-public.fr/particuliers/vosdroits/F20568" target="_blank" title="Service Public">ici</a>.</p>
            </article>
            <article class="mt-5">
                <h3>Cadastre, PLU</h3>
                <p>Le cadastre est visible sur les sites <a href="https://www.geoportail-urbanisme.gouv.fr/map/#tile=5&lon=2.832799&lat=49.57783100000003&zoom=13&mlon=2.832799&mlat=49.577831" title="Géoportail" target="_blank">Géoportail</a> ou <a href="https://www.cadastre.gouv.fr/scpc/accueil.do" target="_blank" title="Cadastre">Cadastre.gouv</a>.</p>
                <p>Quant au PLU (Plan Local d’Urbanisme), il est actuellement visible en mairie. Certaines informations seront progressivement mises en ligne sur <a href="www.plessisderoye.fr" target="_blank" title="Plan d'urbanisme">le site communal  de Plessis de Roye</a>.</p>
                <figure>
                    <img src="assets/images/planVillage.png" alt="Plan du village" class="img-fluid mx-auto d-block" />
                    <figcaption class="text-center font-italic">Délimitation du village de Plessis de Roye : pour l’étude du cadastre, voir les sites référencés ci-dessus.<br/>
                        (pointage sur la mairie : 500 rue de Sanvic 60310 Plessis de Roye, email: <a href="mailto:mairie.plessierderoye@wanadoo.fr">mairie.plessierderoye@wanadoo.fr</a>, Tél: 03 44 43 72 29) 
                    </figcaption>
                </figure>
            </article>
            <article class="mt-5">
                <h3>Démarches</h3>
                <h4>Constitution du dossier</h4>
                <p>La demande de permis de construire doit être effectuée au moyen de l'un des formulaires suivants :</p>
                <ul class="liDlFile">
                    <li><a href="https://www.formulaires.modernisation.gouv.fr/gf/cerfa_13406.do" title="Téléchargement du fichier cerfa n°13406*07">cerfa n°13406*07</a> lorsqu'il s'agit d'une maison individuelle et/ou ses annexes</li>
                    <li><a href="https://www.formulaires.modernisation.gouv.fr/gf/cerfa_13409.do" title="Téléchargement du fichier cerfa n°13409*07">cerfa n°13409*07</a> pour les autres constructions (logement collectif, exploitation agricole, établissement recevant du public...)</li>
                    <li><a href="https://www.formulaires.modernisation.gouv.fr/gf/cerfa_13412.do" title="Téléchargement du fichier cerfa n°13412*07">cerfa n°13412*07</a> pour les transferts de permis de construire</li>
                </ul>
                <p>Le formulaire doit être complété de pièces, dont la liste est limitativement énumérée sur la notice de demande de permis de construire.</p>
                <ul class="liDlFile">
                    <li><a href="https://www.formulaires.service-public.fr/gf/getNotice.do?cerfaNotice=51434&cerfaFormulaire=13406" title="Notice explicative" target="_blank">Notice explicative pour les demandes de permis de construire, d'aménager, de démolir et déclaration préalable</a></li>
                    <li><a href="https://www.formulaires.service-public.fr/gf/getNotice.do?cerfaNotice=13409-2&cerfaFormulaire=88065" title="Fiche d'aide" target="_blank">Fiche d'aide pour le calcul de la surface de plancher et de la surface taxable</a></li>
                </ul>
            </article>
            <article class="mt-5">
                <h3>Dépôt du dossier</h3>
                <p>Le dossier doit être envoyé (avec AR)  ou déposé à la Mairie.<br />
                    La mairie délivre un récépissé avec un numéro d'enregistrement qui mentionne la date à partir de laquelle les travaux pourront débuter en l'absence d'opposition du service instructeur.
                </p>
            </article>
            <article class="mt-5">
                <h3>Délais d'instruction</h3>
                <p>Le délai d'instruction pour les déclarations préalables de travaux est d’un mois, majoré d’un mois supplémentaire si le projet est situé en zone soumise à consultation de l’Architecte des Bâtiments de France.*</p>
                <p>Le délai d’instruction des permis de construire est de deux mois, majorés de deux mois supplémentaires si le projet est situé en zone soumise à consultation de l’Architecte des Bâtiments de France.*</p>
                <p>(* Hormis les cas où une demande de pièces complémentaires est émise par le service instructeur, qui stoppe alors le délai d’instruction jusqu’à réception des pièces exigées)</p>
                <p class="mt-5">Un extrait de la demande de permis de construire doit faire l'objet d'un affichage en mairie dans les 8 jours qui suivent son dépôt et reste affiché tout le temps de l'instruction du dossier, c'est-à-dire pendant au moins 2 ou 3 mois.</p>
            </article>
            <article class="mt-5">
                <h3>Décisions de la mairie</h3>
                <h4>En cas d'acceptation</h4>
                <p>La décision de la mairie prend la forme d'un arrêté municipal. Cette décision est adressée à l'intéressé par courrier ou par mail.</p>
                <h4>En cas de refus</h4>
                <p>Lorsqu'un permis de construire a été refusé, le demandeur a la possibilité de demander à la mairie de revoir sa position. Cette demande s'effectue dans les 2 mois suivant le refus par lettre recommandée avec avis de réception.<br />
                    Si cette tentative échoue, le demandeur a 2 mois à compter de la date de la notification de la décision de refus pour saisir le tribunal administratif par lettre recommandée avec avis de réception.<br />
                    Le demandeur doit exposer clairement les raisons qui lui permettent de justifier son droit à l'obtention d'un permis de construire.
                </p>
                <h4>En l'absence de réponse</h4>
                <p>La décision de la mairie peut également ne pas donner lieu à la délivrance d'une réponse écrite au terme du délai d'instruction. Cela indique, en principe, qu'elle ne s'oppose pas au projet tel qu'il est décrit dans la demande de permis de construire. L'intéressé a tout de même intérêt à demander à la mairie un certificat attestant de son absence d'opposition à la réalisation du projet.</p>
            </article>
        </div>
    </section>
</main>
<?php
include_once 'includes/footer.php';
