Utilisation de l'api [mirrorace](https://mirrorace.com) pour faire de l'upload multiple automatiquement en queue, les fichiers les uns aprés les autres sur autant de mirroir que l'ont souhaite.

Conditions: les url avec les noms des vidéos doivent être identique, seul le numéro d'épisode sera incrémenté automatiquement. de 1 à autant que vous voulez. de 1 à 100 içi.

Pour uploader un grand nombre d'épisodes d'un seul coup,(genre une centaine ou plus), sans l'arrêt du système php, il faut augmenter dans le php.ini le max_execution_time à 600 par example, ce qui fait 10 minutes. à vous de voir, sinon il faudra modififier $i = 1 à 10 puis 20 par example pour up les épisodes 10 par 10 mais manuellement.

Une fois l'op terminé tout vos liens seront dans votre compte mirorrace et une liste de json de retour s'afficherons pour vérif. vous pouvez suivre l'upload en temps réel sur votre compte mirrorace en raffraichissant la page ou se trouve la liste de vos vidéos. les json s'affichant seulement une fois l'op terminé.

Pour ajouter des mirroirs vous trouverez les id dans le tableau sur cette page: https://mirrorace.com/mirrors
