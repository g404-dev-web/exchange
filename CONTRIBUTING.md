# Reporter un bug

Vous devez créer un [nouvel Issue](https://gitlab.com/simplon-roanne/exchange/issues/new?issue%5Bassignee_id%5D=&issue%5Bmilestone_id%5D=) et décrire le bug rencontré avec le plus de détails possibles.
Utilisez le format suivant pour être sûr de ne rien oublier : 
```md
## Description du bug
[Quelle suite d'action vous a mené à expérimenter le bug ? Décrivez tout ce qui s'est passé ici]

## Comment reproduire le bug
[Comment reproduire le bug ? Si la description du bug est différente du moyen de reproduction, ajoutez cette étape]

## Environnement
[Système d'exploitation (+ Version), Navigateur (+Version), et toute autre information utile]
```

# Contribuer au code source par un correctif ou une amélioration

Vous devez créer un Merge Request sur Gitlab pour proposer votre contribution.
Cette section nécessite plus de rédaction, n'hésitez pas à contribuer... Au tuto de contribution :p

## Installation du projet en local pour test ou contribution

- Créer un fork du projet Exchange sur gitlab
- `git clone https://gitlab.com/<votre-nom-d-utilisateur>/exchange`
- `cd exchange`
- `composer install`
-  Copier .env.example vers .env et remplir les informations d'une base de données disponible
- `php artisan migrate`
- `php artisan db:seed`

## Conventions de code à respecter

Vous devez respecter le standards [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) et les conventions Laravel.