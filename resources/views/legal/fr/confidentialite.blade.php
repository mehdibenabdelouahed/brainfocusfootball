{{-- Intro --}}
<div class="bg-[#121b2d] border border-[#ffdc21]/20 rounded-xl p-6 mb-12">
    <div class="flex items-start gap-3">
        <svg class="w-5 h-5 text-[#ffdc21] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        <p class="text-sm text-[#b2c0d9] font-light" style="font-family: 'Poppins', sans-serif;">
            Chez Brain Focus Football, la protection de vos données personnelles est une priorité absolue. Cette politique explique quelles données nous collectons, pourquoi, et comment nous les protégeons, conformément au Règlement Général sur la Protection des Données (RGPD – UE 2016/679).
        </p>
    </div>
</div>

{{-- Section 1 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        1. Responsable du traitement
    </h2>
    <div class="bg-[#121b2d] border border-white/5 rounded-xl p-6 space-y-2">
        <p><strong class="text-white">Brain Focus Football</strong></p>
        <p>Siège social : Bruxelles, Belgique</p>
        <p>Email : <a href="mailto:contact@brainfocusfootball.com" class="text-[#ffdc21] hover:underline">contact@brainfocusfootball.com</a></p>
        <p>Responsable : Abdallah Bridi, Fondateur</p>
    </div>
</section>

{{-- Section 2 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        2. Données collectées
    </h2>
    <p class="mb-6">Nous collectons différentes catégories de données selon votre utilisation de la plateforme :</p>

    <div class="space-y-4">
        {{-- Joueurs --}}
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-6">
            <h3 class="text-sm font-bold text-[#ffdc21] uppercase tracking-wider mb-3">Joueurs</h3>
            <ul class="space-y-2">
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Identité :</strong> nom, prénom, date de naissance, nationalité, photo de profil</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Contact :</strong> adresse email, numéro de téléphone (optionnel)</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Sportives :</strong> poste, club actuel, historique, statistiques, vidéos, caractéristiques physiques</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Médicales :</strong> données de santé (chiffrées AES-256, accessibles uniquement par le joueur)</span>
                </li>
            </ul>
        </div>

        {{-- Recruteurs --}}
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-6">
            <h3 class="text-sm font-bold text-[#ffdc21] uppercase tracking-wider mb-3">Recruteurs</h3>
            <ul class="space-y-2">
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Identité :</strong> nom, prénom, organisation/club</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Contact :</strong> adresse email professionnelle</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Abonnement :</strong> type de plan et historique de facturation</span>
                </li>
            </ul>
        </div>

        {{-- Tuteurs --}}
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-6">
            <h3 class="text-sm font-bold text-[#ffdc21] uppercase tracking-wider mb-3">Tuteurs / Parents</h3>
            <ul class="space-y-2">
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Identité :</strong> nom, prénom, lien de parenté</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
                    <span><strong class="text-white">Contact :</strong> adresse email, consentement parental</span>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- Section 3 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        3. Finalités du traitement
    </h2>
    <div class="overflow-x-auto">
        <table class="w-full text-xs border-collapse">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left py-3 px-4 text-white font-bold uppercase tracking-wider">Finalité</th>
                    <th class="text-left py-3 px-4 text-white font-bold uppercase tracking-wider">Base légale</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                <tr>
                    <td class="py-3 px-4">Gestion des comptes utilisateurs</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Exécution du contrat</td>
                </tr>
                <tr>
                    <td class="py-3 px-4">Création et affichage des profils joueurs</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Consentement / Contrat</td>
                </tr>
                <tr>
                    <td class="py-3 px-4">Mise en relation joueurs-recruteurs</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Exécution du contrat</td>
                </tr>
                <tr>
                    <td class="py-3 px-4">Gestion des abonnements et paiements</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Exécution du contrat</td>
                </tr>
                <tr>
                    <td class="py-3 px-4">Envoi de la newsletter</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Consentement</td>
                </tr>
                <tr>
                    <td class="py-3 px-4">Stockage de données médicales chiffrées</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Consentement explicite</td>
                </tr>
                <tr>
                    <td class="py-3 px-4">Amélioration de la plateforme et statistiques</td>
                    <td class="py-3 px-4 text-[#ffdc21]">Intérêt légitime</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

{{-- Section 4 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        4. Protection des données sensibles
    </h2>
    <div class="bg-emerald-500/5 border border-emerald-500/20 rounded-xl p-6">
        <div class="flex items-start gap-3 mb-4">
            <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            <div>
                <h3 class="text-sm font-bold text-emerald-400 mb-2">Données médicales chiffrées</h3>
                <p>Les données médicales sont considérées comme des données sensibles au sens du RGPD (article 9). Elles sont chiffrées de bout en bout avec l'algorithme <strong class="text-white">AES-256</strong> et ne sont accessibles que par le joueur lui-même. Aucun membre de l'équipe Brain Focus Football, aucun recruteur ni aucun tiers ne peut y accéder.</p>
            </div>
        </div>
    </div>
</section>

{{-- Section 5 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        5. Protection des mineurs
    </h2>
    <p class="mb-4">
        Notre plateforme s'adresse aux joueurs de 12 à 23 ans. Nous appliquons des mesures renforcées pour les utilisateurs mineurs :
    </p>
    <ul class="space-y-3 ml-2">
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-[#ffdc21] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span><strong class="text-white">Moins de 16 ans :</strong> consentement parental obligatoire via notre système de tuteur intégré</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-[#ffdc21] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span><strong class="text-white">Vérification d'identité :</strong> le tuteur doit confirmer son lien avec le joueur mineur</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-[#ffdc21] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span><strong class="text-white">Droit de retrait :</strong> le tuteur peut retirer son consentement à tout moment</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-[#ffdc21] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span><strong class="text-white">Messagerie modérée :</strong> les communications sont encadrées et traçables</span>
        </li>
    </ul>
</section>

{{-- Section 6 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        6. Durée de conservation
    </h2>
    <div class="space-y-3">
        <div class="flex items-start gap-3 bg-[#121b2d] border border-white/5 rounded-xl p-4">
            <span class="text-[#ffdc21] font-bold text-xs shrink-0 mt-0.5 w-24">Compte actif</span>
            <span>Données conservées pendant toute la durée d'utilisation de la plateforme</span>
        </div>
        <div class="flex items-start gap-3 bg-[#121b2d] border border-white/5 rounded-xl p-4">
            <span class="text-[#ffdc21] font-bold text-xs shrink-0 mt-0.5 w-24">Suppression</span>
            <span>Données supprimées dans un délai de 30 jours après la demande de suppression du compte</span>
        </div>
        <div class="flex items-start gap-3 bg-[#121b2d] border border-white/5 rounded-xl p-4">
            <span class="text-[#ffdc21] font-bold text-xs shrink-0 mt-0.5 w-24">Facturation</span>
            <span>Données de facturation conservées 10 ans (obligation légale belge)</span>
        </div>
        <div class="flex items-start gap-3 bg-[#121b2d] border border-white/5 rounded-xl p-4">
            <span class="text-[#ffdc21] font-bold text-xs shrink-0 mt-0.5 w-24">Newsletter</span>
            <span>Jusqu'au désabonnement de l'utilisateur</span>
        </div>
    </div>
</section>

{{-- Section 7 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        7. Partage des données
    </h2>
    <p class="mb-4">
        Vos données personnelles ne sont <strong class="text-white">jamais vendues</strong> à des tiers. Elles peuvent être partagées uniquement dans les cas suivants :
    </p>
    <ul class="space-y-3 ml-2">
        <li class="flex items-start gap-3">
            <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
            <span><strong class="text-white">Profil public joueur :</strong> les informations que vous choisissez de rendre visibles aux recruteurs (nom, poste, stats, vidéos)</span>
        </li>
        <li class="flex items-start gap-3">
            <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
            <span><strong class="text-white">Messagerie interne :</strong> les messages échangés entre joueurs et recruteurs via la plateforme</span>
        </li>
        <li class="flex items-start gap-3">
            <span class="w-1.5 h-1.5 bg-[#ffdc21] rounded-full mt-1.5 shrink-0"></span>
            <span><strong class="text-white">Obligation légale :</strong> si requis par une autorité judiciaire ou administrative compétente</span>
        </li>
    </ul>
</section>

{{-- Section 8 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        8. Vos droits
    </h2>
    <p class="mb-6">
        Conformément au RGPD, vous disposez des droits suivants sur vos données personnelles :
    </p>
    <div class="grid sm:grid-cols-2 gap-4">
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-5">
            <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-2">Droit d'accès</h3>
            <p class="text-xs">Obtenir une copie de toutes les données que nous détenons sur vous.</p>
        </div>
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-5">
            <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-2">Droit de rectification</h3>
            <p class="text-xs">Modifier ou corriger vos données personnelles à tout moment.</p>
        </div>
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-5">
            <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-2">Droit à l'effacement</h3>
            <p class="text-xs">Demander la suppression de vos données et de votre compte.</p>
        </div>
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-5">
            <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-2">Droit à la portabilité</h3>
            <p class="text-xs">Recevoir vos données dans un format structuré et lisible.</p>
        </div>
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-5">
            <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-2">Droit d'opposition</h3>
            <p class="text-xs">Vous opposer au traitement de vos données à des fins spécifiques.</p>
        </div>
        <div class="bg-[#121b2d] border border-white/5 rounded-xl p-5">
            <h3 class="text-xs font-bold text-white uppercase tracking-wider mb-2">Droit de limitation</h3>
            <p class="text-xs">Restreindre temporairement le traitement de vos données.</p>
        </div>
    </div>
    <p class="mt-6">
        Pour exercer vos droits, envoyez un email à <a href="mailto:contact@brainfocusfootball.com" class="text-[#ffdc21] hover:underline font-semibold">contact@brainfocusfootball.com</a>. Nous répondrons dans un délai de 30 jours.
    </p>
    <p class="mt-3">
        En cas de litige, vous pouvez introduire une réclamation auprès de l'<strong class="text-white">Autorité de Protection des Données belge (APD)</strong> : <a href="https://www.autoriteprotectiondonnees.be" target="_blank" class="text-[#ffdc21] hover:underline">www.autoriteprotectiondonnees.be</a>.
    </p>
</section>

{{-- Section 9 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        9. Sécurité des données
    </h2>
    <p class="mb-4">
        Nous mettons en œuvre des mesures techniques et organisationnelles appropriées pour protéger vos données :
    </p>
    <ul class="space-y-3 ml-2">
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Chiffrement des connexions via HTTPS/TLS</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Hashage sécurisé des mots de passe (bcrypt)</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Chiffrement AES-256 des données médicales sensibles</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Protection CSRF sur tous les formulaires</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Limitation du débit (rate limiting) contre les attaques par force brute</span>
        </li>
        <li class="flex items-start gap-3">
            <svg class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Vérification email obligatoire pour tous les comptes</span>
        </li>
    </ul>
</section>

{{-- Section 10 --}}
<section>
    <h2 class="text-lg font-bold text-white uppercase tracking-wider mb-4 flex items-center gap-3">
        <span class="w-2 h-2 rounded-full bg-[#ffdc21]"></span>
        10. Modifications de cette politique
    </h2>
    <p>
        Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. En cas de modification substantielle, les utilisateurs seront notifiés par email ou par une notification sur la plateforme. La date de dernière mise à jour est indiquée en haut de cette page.
    </p>
</section>
