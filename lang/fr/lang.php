<?php

return [
    'plugin' => [
        'name' => 'Avis',
        'description' => 'Avis de vos clients et leurs témoignages',
    ],
    'permissions' => [
        'manage_reviews' => 'Gérer les avis et témoignages',
        'manage_categories' => 'Gérer les catégories',
    ],
    'models' => [
        'general' => [
            'id' => 'ID',
            'created_at' => 'Créé le',
            'updated_at' => 'Mis à jour le',
            'deleted_at' => 'Supprimé le',
            'date' => 'Date',
            'enabled' => 'Activé',
            'name' => 'Nom',
            'slug' => 'Slug',
            'title' => 'Titre',
        ],
        'review' => [
            'label' => 'Avis',
            'label_plural' => 'Avis',
            'approved' => 'Approuvé',
            'approved_comment' => 'seuls les avis approuvés sont visibles publiquement',
            'avatar' => 'Avatar',
            'content' => 'Contenu',
            'email' => 'Email',
            'featured' => 'En vedette',
            'rating' => 'Note',
        ],
        'category' => [
            'label' => 'Categorie',
            'label_plural' => 'Catégories',
            'description' => 'Description',
            'sort_order' => 'Ordre de tri',
        ],
    ],
    'controllers' => [
        'reorder_categories' => 'Réorganiser les catégories',
        'return_to_categories' => 'Retour aux catégories',
        'reorder_reviews' => 'Réorganiser les avis',
        'return_to_reviews' => 'Retour aux avis',
    ],
    'components' => [
        'general' => [
            'category_filter' => 'Filtre des catégories',
            'category_filter_description' => 'Entrez une adresse de catégorie ou un paramètre d’URL pour filter les avis. Laissez vide pour afficher tous les avis.',
            'featured_first' => 'En vedette en premier',
            'featured_first_description' => 'afficher en premier les avis en vedette',
            'group_display' => 'Affichage',
            'no_reviews' => 'Message en l’absence d’avis',
            'no_reviews_description' => 'Message à afficher dans la liste d’avis lorsqu’il n’y a aucun avis. Cette propriété est utilisée par le partial par défaut du composant.',
            'no_reviews_default' => 'Aucun avis trouvé',
            'order' => 'Ordre des avis',
            'order_description' => 'Attribut selon lequel les avis seront ordonnés',
            'rating' => '{1} :value étoile sur :stars|[2,*] :value étoiles sur :stars',
            'rating_display' => 'Affichage de la note',
            'star' => 'étoile',
            'rating_display_types' => [
                'none' => 'Aucun',
                'stars' => 'Étoiles seulement',
                'text' => 'Texte seulement',
                'both' => 'Étoiles et texte',
            ],
        ],
        'reviews' => [
            'name' => 'Avis',
            'description' => 'Afficher une liste paginée des avis',
            'pagination' => 'Numéro de page',
            'pagination_description' => 'Cette valeur est utilisée pour déterminer à quelle page l’utilisateur se trouve.',
            'per_page' => 'Avis par page',
            'per_page_validation' => 'Format du nombre d’avis par page incorrect',
        ],
        'reviews_slider' => [
            'name' => 'Carousel d’avis',
            'description' => 'Affiche les avis dans un carousel',
            'auto_play' => 'Lecture automatique (en s)',
            'auto_play_description' => 'Permet de passer à l’avis suivante après X secondes. Si la valeur est 0, la lecture automatique est désactivée.',
            'auto_play_validation' => 'Format non valide pour la valeur du délai de lecture automatique',
            'loadScripts' => 'Charger les scripts requis',
            'max_reviews' => 'Nombre max d’avis',
            'silder_type' => 'Type de slider',
            'show_control' => 'Afficher les boutons de contrôle',
            'show_counter' => 'Afficher le compteur d’avis',
            'show_dots' => 'Afficher les points du slider',
            'types' => [
                'tiny_slider' => 'Tiny Slider 2',
                'tailwind_alpine' => 'Alpine JS & Tailwind CSS',
            ],
        ],
    ],
    'tabs' => [
        'general' => 'Général',
        'categories' => 'Catégories',
    ],
    'sorting' => [
        'title_asc' => 'Titre (ascendant)',
        'title_desc' => 'Titre (descendant)',
        'date_asc' => 'Date (ascendant)',
        'date_desc' => 'Date (descendant)',
        'rating_asc' => 'Note (ascendant)',
        'rating_desc' => 'Note (descendant)',
        'sort_order_asc' => 'Tri (ascendant)',
        'sort_order_desc' => 'Tri (descendant)',
        'random' => 'Aléatoire',
        'created_asc' => 'Création le (ascendant)',
        'created_desc' => 'Création (descendant)',
        'updated_asc' => 'Mise à jour (ascendant)',
        'updated_desc' => 'Mise à jour (descendant)',
    ],
    'seeds' => [
        'general' => 'Générale',
    ],
];
