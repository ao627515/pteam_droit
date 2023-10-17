<?php

namespace Database\Seeders;

use App\Models\Prestation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prestations = [
            'Défense pénale',
            'Représentation devant le tribunal',
            'Plaidoirie de culpabilité',
            'Appel de verdicts criminels',
            'Affaires de drogue et de stupéfiants',
            'Affaires de violence domestique',
            'Vol et cambriolage',
            'Infractions liées à la conduite automobile',
            'Droit pénal des mineurs',
            'Affaires d\'agression sexuelle',
            'Brevets d\'invention',
            'Marques de commerce et logos',
            'Droit d\'auteur et droits voisins',
            'Dépôt de demandes de brevet',
            'Surveillance de la propriété intellectuelle',
            'Rédaction de contrats de licence',
            'Litiges de propriété intellectuelle',
            'Protection des secrets commerciaux',
            'Contrefaçon et piratage',
            'Marquage de produits et de services',
            'Conformité aux réglementations environnementales',
            'Évaluation des impacts environnementaux',
            'Litiges environnementaux',
            'Permis et autorisations environnementaux',
            'Gestion des déchets dangereux',
            'Protection de la faune et de la flore',
            'Règlements sur l\'eau et l\'air',
            'Énergies renouvelables et développement durable',
            'Études d\'impact environnemental',
            'Responsabilité environnementale',
            'Conformité à la protection des données (RGPD, CCPA, etc.)',
            'Gestion des violations de données',
            'Politiques de confidentialité et avis juridiques',
            'Contrats de traitement des données',
            'Formation en sensibilisation à la sécurité',
            'Audit de sécurité informatique',
            'Contentieux de cybersécurité',
            'Contrôle des accès et authentification',
            'Gestion de la sécurité des réseaux',
            'Protection contre les cyberattaques',
            'Rédaction de contrats de soins de santé',
            'Réglementation des essais cliniques',
            'Litiges médicaux et de responsabilité',
            'Conformité aux normes HIPAA',
            'Droit de la bioéthique',
            'Licenciement de professionnels de la santé',
            'Gestion des dossiers médicaux électroniques',
            'Contentieux d\'assurance maladie',
            'Création de cabinets médicaux',
            'Gestion des fusions d\'hôpitaux et d\'établissements de santé',
            'Transactions immobilières',
            'Contrats de location et de bail',
            'Contentieux de propriété',
            'Zonage et permis de construction',
            'Litiges entre locataires et propriétaires',
            'Copropriété et syndicats de copropriétaires',
            'Évaluations de propriétés',
            'Droit de la construction',
            'Examen de titres de propriété',
            'Hypothèques et financements immobiliers',
            'Rédaction de contrats de travail',
            'Licenciement et négociation de départs',
            'Conflits employeur-employé',
            'Harcèlement au travail',
            'Accidents du travail',
            'Conventions collectives',
            'Rémunération et avantages sociaux',
            'Négociation de conventions collectives',
            'Contentieux liés à la discrimination',
            'Conformité aux normes du travail',
            'Création d\'entreprise',
            'Rédaction de statuts de société',
            'Gestion de la conformité légale',
            'Fusion et acquisition d\'entreprises',
            'Restructuration d\'entreprises',
            'Litiges entre actionnaires',
            'Responsabilité des dirigeants',
            'Secrétariat juridique d\'entreprise',
            'Augmentation de capital',
            'Dissolution d\'entreprise',
            'Rédaction de contrats commerciaux',
            'Analyse de contrats existants',
            'Négociation de conditions contractuelles',
            'Résolution de litiges contractuels',
            'Contrats de location',
            'Contrats de vente',
            'Contrats de travail',
            'Contrats de franchise',
            'Contrats de prestation de services',
            'Contrats de distribution',
            'Divorce à l\'amiable',
            'Garde d\'enfants et droit de visite',
            'Rédaction de contrats de mariage',
            'Médiation familiale',
            'Adoption légale',
            'Modification des pensions alimentaires',
            'Tutelle et curatelle',
            'Protection contre la violence domestique',
            'Reconnaissance de paternité',
            'Partage des biens en cas de décès d\'un conjoint',
        ];

        foreach ($prestations as $prestations) {
            Prestation::factory()->create([
                'nom' => $prestations
            ]);
        }
    }
}
