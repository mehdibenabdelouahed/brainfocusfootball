<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'        => 'L\'alimentation du footballeur : le guide complet',
                'slug'         => 'alimentation-footballeur-guide-complet',
                'category'     => 'Alimentation',
                'reading_time' => 8,
                'excerpt'      => 'Découvre comment optimiser ton alimentation pour maximiser tes performances sur le terrain et ta récupération.',
                'content'      => "<h2>Pourquoi l'alimentation est cruciale pour un footballeur ?</h2>
<p>Un match de football dure 90 minutes d'effort intense. Sans une alimentation adaptée, ton corps ne peut pas tenir la distance. Les meilleurs joueurs du monde traitent leur nutrition comme une arme secrète.</p>

<h2>Les macronutriments essentiels</h2>
<h3>Les glucides : ton carburant principal</h3>
<p>Le football est un sport à haute intensité qui consomme énormément de glycogène. Tu dois consommer des glucides complexes (pâtes, riz, pommes de terre) 3 à 4 heures avant un match. Objectif : 6 à 10g de glucides par kg de poids corporel par jour.</p>

<h3>Les protéines : pour la récupération musculaire</h3>
<p>Après l'effort, tes muscles sont endommagés et ont besoin de protéines pour se reconstruire plus forts. Vise 1,6 à 2,2g de protéines par kg de poids corporel par jour. Sources : poulet, poisson, œufs, légumineuses.</p>

<h3>Les lipides : l'énergie de longue durée</h3>
<p>Les graisses saines (avocat, noix, huile d'olive) sont essentielles pour l'absorption des vitamines et l'énergie en dehors des matchs. Ne les supprime jamais de ton alimentation.</p>

<h2>Timing des repas : la stratégie gagnante</h2>
<ul>
<li><strong>3-4h avant le match :</strong> repas riche en glucides, protéines maigres, peu de graisses</li>
<li><strong>1-2h avant :</strong> collation légère (banane, toast, yaourt)</li>
<li><strong>Pendant :</strong> eau + boisson isotonique si match > 60 min</li>
<li><strong>Dans les 30 min après :</strong> fenêtre anabolique — protéines + glucides rapides</li>
<li><strong>Le soir :</strong> repas complet pour la récupération</li>
</ul>

<h2>L'hydratation : l'erreur que tout le monde fait</h2>
<p>Une déshydratation de seulement 2% diminue tes performances cognitives et physiques de 20%. Bois régulièrement tout au long de la journée, pas seulement pendant l'effort. Objectif : 35ml par kg de poids corporel par jour.</p>

<h2>Les aliments à éviter</h2>
<p>Supprime ou réduis drastiquement : fast food, sodas, alcool, sucreries industrielles, plats ultra-transformés. Ces aliments créent de l'inflammation et ralentissent ta récupération.</p>",
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'Préparation mentale : développer le mental d\'un champion',
                'slug'         => 'preparation-mentale-mental-champion',
                'category'     => 'Préparation mentale',
                'reading_time' => 10,
                'excerpt'      => 'Le talent physique ne suffit pas. Découvre les techniques mentales utilisées par les meilleurs joueurs pour performer sous pression.',
                'content'      => "<h2>Le mental : la différence entre un bon joueur et un grand joueur</h2>
<p>On estime que 80% de la performance sportive est mentale. Pourtant, la grande majorité des joueurs ne travaillent jamais leur mental de manière structurée. C'est ta plus grande opportunité de te démarquer.</p>

<h2>La visualisation : entraîne ton cerveau avant le terrain</h2>
<p>Les neurosciences ont prouvé que ton cerveau ne fait pas la différence entre une action réellement vécue et une action visualisée de manière intense. Les grands joueurs comme Zlatan Ibrahimovic visualisent leurs performances avant chaque match.</p>
<p><strong>Exercice pratique :</strong> 10 minutes par jour, yeux fermés, visualise avec tous tes sens un match parfait. Ressens la pression du ballon, entends les sons du stade, vois tes gestes techniques réussis.</p>

<h2>La gestion du stress et de la pression</h2>
<p>Le stress n'est pas ton ennemi — c'est de l'énergie. Apprends à le canaliser plutôt qu'à le combattre.</p>
<ul>
<li><strong>Respiration 4-7-8 :</strong> inspire 4s, retiens 7s, expire 8s. Activite le système parasympathique en 30 secondes.</li>
<li><strong>Ancrage :</strong> crée un geste rituel (claquer les mains, toucher ton bracelet) associé à un état de flow</li>
<li><strong>Dialogue interne positif :</strong> remplace \"je ne dois pas rater\" par \"je vais réussir\"</li>
</ul>

<h2>La confiance en soi : une compétence qui se développe</h2>
<p>La confiance n'est pas un trait de personnalité, c'est un état qui se construit. Elle vient de la préparation, de la répétition et de la mémoire de tes succès passés.</p>

<h2>Récupération mentale : souvent négligée</h2>
<p>Ton cerveau se fatigue autant que tes muscles. Intègre des routines de récupération mentale : méditation, lecture, déconnexion des écrans, temps en nature. Un esprit reposé prend de meilleures décisions sur le terrain.</p>",
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title'        => 'Comment intégrer un centre de formation : la vérité',
                'slug'         => 'integrer-centre-formation-verite',
                'category'     => 'Formation',
                'reading_time' => 12,
                'excerpt'      => 'Les coulisses des centres de formation : critères de sélection, erreurs à éviter et stratégie pour maximiser tes chances.',
                'content'      => "<h2>La réalité des centres de formation</h2>
<p>En France, environ 3 000 joueurs intègrent un centre de formation chaque année. Moins de 1% deviendront professionnels. Ce n'est pas pour te décourager, mais pour te préparer à la réalité de ce que tu vas affronter.</p>

<h2>Ce que les recruteurs regardent vraiment</h2>
<p>Contrairement à ce que l'on croit, les recruteurs ne cherchent pas uniquement le talent brut. Voici leur grille d'évaluation :</p>
<ul>
<li><strong>Potentiel physique :</strong> taille, vitesse de progression, morphologie</li>
<li><strong>Qualités techniques :</strong> contrôle, frappe, dribble, jeu sans ballon</li>
<li><strong>Intelligence de jeu :</strong> lecture du jeu, prises de décision</li>
<li><strong>Personnalité :</strong> résilience face à l'échec, attitude à l'entraînement, comportement en groupe</li>
<li><strong>Profil scolaire :</strong> les clubs veulent des joueurs équilibrés, pas des décrocheurs</li>
</ul>

<h2>Stratégie pour maximiser tes chances</h2>
<h3>1. Commence tôt et reste patient</h3>
<p>Les fenêtres de recrutement se font généralement entre 12 et 16 ans pour les académies élites. Mais des joueurs ont intégré des formations à 18 ou 19 ans.</p>

<h3>2. Multiplie les essais, analyse tes retours</h3>
<p>Chaque essai est une opportunité d'apprentissage. Demande des retours précis aux entraîneurs, même en cas de refus.</p>

<h3>3. Construis ta visibilité numérique</h3>
<p>En 2025, avoir une page de profil professionnel avec tes vidéos est devenu un standard. C'est exactement ce que Brain Focus Football te permet de créer.</p>

<h3>4. Travaille ce que les autres négligent</h3>
<p>La plupart des joueurs travaillent la technique. Peu travaillent le mental, la nutrition, l'analyse vidéo. Ce sont tes avantages concurrentiels.</p>",
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title'        => 'Prévenir et gérer les blessures : le guide du joueur intelligent',
                'slug'         => 'prevenir-gerer-blessures-guide',
                'category'     => 'Blessures',
                'reading_time' => 7,
                'excerpt'      => 'Apprends à protéger ton corps, à gérer mentalement une blessure et à revenir plus fort qu\'avant.',
                'content'      => "<h2>La blessure : l'épreuve mentale autant que physique</h2>
<p>Se blesser fait partie de la carrière d'un joueur. La question n'est pas si tu vas te blesser, mais comment tu vas gérer cette période. Les joueurs qui reviennent plus forts ont tous un point commun : ils ont utilisé ce temps comme une opportunité.</p>

<h2>Les blessures les plus fréquentes en football</h2>
<ul>
<li>Entorse de la cheville (la plus commune)</li>
<li>Déchirure des ischio-jambiers</li>
<li>Lésion du ligament croisé antérieur (LCA)</li>
<li>Périostite tibiale</li>
<li>Pubalgies</li>
</ul>

<h2>La prévention : ton investissement le plus rentable</h2>
<h3>Échauffement correctement</h3>
<p>15 à 20 minutes d'échauffement progressif — mobilité articulaire, activation musculaire, courses progressives. Le programme FIFA 11+ a démontré une réduction des blessures de 30 à 50%.</p>

<h3>Récupération : l'entraînement caché</h3>
<p>Le sommeil est ton meilleur allié. Entre 7 et 9 heures par nuit pour un adolescent athlète. Le manque de sommeil est le facteur de risque de blessure le plus sous-estimé.</p>

<h2>Gestion mentale d'une blessure longue durée</h2>
<p>Une blessure longue (LCA, fracture) est une véritable épreuve psychologique. Voici comment la traverser :</p>
<ul>
<li>Accepte d'abord la réalité de ta situation</li>
<li>Fixe-toi des micro-objectifs hebdomadaires de rééducation</li>
<li>Utilise ce temps pour travailler ce qui ne nécessite pas ton corps : analyse vidéo, mental, nutrition</li>
<li>Reste connecté à ton équipe — l'isolement aggrave la dépression post-blessure</li>
</ul>",
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title'        => 'Comprendre ton coach : comment en tirer le meilleur',
                'slug'         => 'comprendre-coach-relation-entraineur',
                'category'     => 'Le coaching',
                'reading_time' => 6,
                'excerpt'      => 'La relation avec ton entraîneur peut faire ou défaire ta saison. Voici comment créer une relation professionnelle gagnante.',
                'content'      => "<h2>Le coach n'est pas ton ennemi</h2>
<p>Trop de jeunes joueurs voient leur entraîneur comme quelqu'un qui les bloque ou ne les comprend pas. En réalité, votre relation est votre bien commun le plus précieux. Un entraîneur qui te pousse dur est souvent celui qui croit le plus en ton potentiel.</p>

<h2>Ce que ton coach attend réellement de toi</h2>
<ul>
<li><strong>L'attitude :</strong> arriver tôt, partir tard, être le plus appliqué à l'entraînement</li>
<li><strong>La communication :</strong> lui parler de tes douleurs, tes doutes, tes objectifs</li>
<li><strong>Le respect des décisions tactiques :</strong> même quand tu n'es pas d'accord</li>
<li><strong>La régularité :</strong> être fiable match après match, pas seulement brillant par intermittence</li>
</ul>

<h2>Comment parler à ton coach des temps de jeu</h2>
<p>C'est le sujet le plus délicat. Voici la méthode qui fonctionne :</p>
<ol>
<li>Demande un rendez-vous en privé, jamais en public</li>
<li>Commences par demander ce que tu dois améliorer pour jouer plus</li>
<li>Écoute sans te défendre</li>
<li>Remercie-le pour son honnêteté</li>
<li>Montre ensuite à l'entraînement que tu as entendu le message</li>
</ol>

<h2>Quand ton coach a tort</h2>
<p>Ça arrive. Tous les entraîneurs font des erreurs de jugement. La question n'est pas d'avoir raison, c'est de rester professionnel. Ton attitude sous la déception est ce qui te différencie des autres et ce dont les recruteurs se souviennent.</p>",
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(['slug' => $article['slug']], $article);
        }
    }
}
