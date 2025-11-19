@extends('layouts.app')

@section('title', 'Nutrition du Footballeur - Brain Focus Football')

@section('content')
<div class="min-h-screen bg-slate-950 text-white pb-20">
    <div class="max-w-4xl mx-auto px-4 pt-16">

        <!-- CATEGORY + TITLE -->
        <p class="text-emerald-400 uppercase text-xs mb-2">Alimentation</p>
        <h1 class="text-4xl font-bold mb-4 leading-tight">
            Nutrition du Footballeur : Le Guide Complet pour la Performance & la Récupération
        </h1>

        <p class="text-slate-400 text-sm mb-10">
            Comprendre comment manger pour tenir 90 minutes, accélérer la récupération et éviter les blessures.
        </p>

        <!-- ARTICLE BODY -->
        <div class="prose prose-invert prose-sm max-w-none leading-relaxed">

            <!-- SECTION -->
            <h2 class="text-2xl font-semibold text-emerald-300">1. Pourquoi la nutrition est un pilier du football moderne</h2>
            <p>
                Un footballeur parcourt 10 à 12 km par match et réalise 30 à 50 actions explosives. 
                Cela représente entre 1100 et 1500 kcal dépensées, et vide presque totalement les réserves de glycogène. 
                Une bonne nutrition permet de maintenir l'intensité, prévenir les blessures et optimiser la récupération.
            </p>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">2. Les macronutriments : carburant de la performance</h2>

            <h3 class="text-xl font-semibold text-emerald-200">A. Les glucides : énergie instantanée</h3>
            <p>
                Source principale d'énergie pour les efforts explosifs. Les réserves de glycogène déterminent 
                ton niveau en fin de match.
            </p>
            <ul>
                <li>3 à 8 g/kg/jour — jusqu’à 10 g/kg avant match</li>
                <li>Sources : pâtes complètes, riz, quinoa, pommes de terre, flocons d’avoine, fruits</li>
            </ul>

            <h3 class="text-xl font-semibold text-emerald-200">B. Les protéines : réparation musculaire</h3>
            <p>Indispensables pour reconstruire les fibres détruites pendant l’effort.</p>
            <ul>
                <li>1.4 à 1.7 g/kg/jour</li>
                <li>Sources : poulet, yaourt grec, poisson, œufs, légumineuses, whey</li>
            </ul>

            <h3 class="text-xl font-semibold text-emerald-200">C. Les lipides : énergie durable</h3>
            <ul>
                <li>20—35% de l’apport total</li>
                <li>Favoriser oméga-3 : saumon, noix, huile d’olive</li>
            </ul>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">3. Les micronutriments : la différence invisible</h2>
            <ul>
                <li><strong>Vitamine D :</strong> immunité + force musculaire</li>
                <li><strong>Fer :</strong> endurance, transport de l’oxygène</li>
                <li><strong>Calcium :</strong> solidité osseuse</li>
                <li><strong>Magnésium :</strong> anti-crampes</li>
                <li><strong>Antioxydants :</strong> récupération cellulaire</li>
            </ul>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">4. Hydratation : le facteur n°1</h2>
            <p>
                Une perte de 2% d’eau = -20% de performance. L’hydratation influence la lucidité, les crampes
                et la vitesse de récupération.
            </p>

            <h3 class="text-xl font-semibold text-emerald-200">Plan hydrique idéal</h3>
            <ul>
                <li><strong>Avant match :</strong> 500 ml (3h avant) + 300 ml (30 min avant)</li>
                <li><strong>Pendant :</strong> 150–300 ml toutes les 20 min</li>
                <li><strong>Mi-temps :</strong> 400–500 ml</li>
                <li><strong>Après match :</strong> 150% du poids perdu</li>
            </ul>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">5. Timing des repas</h2>

            <h3 class="text-xl font-semibold text-emerald-200">Avant le match</h3>
            <ul>
                <li>Riche en glucides</li>
                <li>Faible en graisses</li>
                <li>3–4h avant le coup d’envoi</li>
            </ul>

            <h3 class="text-xl font-semibold text-emerald-200">Pendant le match</h3>
            <p>Banane, orange, gels, boisson isotonique (30–60 g de glucides).</p>

            <h3 class="text-xl font-semibold text-emerald-200">Après le match</h3>
            <p>
                Reconstituer le glycogène + réparer les fibres : 20–25g de protéines + 30–50g de glucides dans les 30 minutes.
            </p>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">6. Compléments : utiles ou pas ?</h2>
            <ul>
                <li><strong>Whey :</strong> parfait après l’effort</li>
                <li><strong>Créatine :</strong> + puissance, + récupération</li>
                <li><strong>Caféine :</strong> + concentration, + sprints</li>
                <li><strong>Oméga-3 :</strong> anti-inflammatoire</li>
            </ul>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">7. Erreurs à éviter</h2>
            <ul>
                <li>Manger gras avant match</li>
                <li>Arriver déshydraté</li>
                <li>Oublier la collation post-match</li>
                <li>Trop d'ultra-transformés</li>
            </ul>

            <h2 class="text-2xl font-semibold text-emerald-300 mt-10">8. Exemple de journée de match</h2>
            <ul>
                <li><strong>8h :</strong> Avoine + fruits rouges + eau</li>
                <li><strong>11h :</strong> Riz blanc + dinde + légumes vapeur</li>
                <li><strong>14h :</strong> Boisson isotonique</li>
                <li><strong>Mi-temps :</strong> 400 ml isotonique</li>
                <li><strong>16h :</strong> Shaker de récupération</li>
                <li><strong>19h :</strong> Saumon + quinoa + légumes verts</li>
            </ul>

        </div>

    </div>
</div>
@endsection
