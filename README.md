# CMS
Design Pattern 

ALors nous avons mis en place 3 design pattern : le Singleton, le query bulder, et l'observer

- le singleton pour le syteme de log afin d'avoir une trace un fichier log est créeé dès l'authentification 
 voici un exemple ![image](https://user-images.githubusercontent.com/47954441/180566358-b76180fa-26dd-4c21-ac37-0c847275d102.png)
une classe Logger() dans le repertoire Core.

- Un builder à été mis en place pour facilité la création d'un user avec un role (admin, auteur, abonné) il suffit d'appelé la classe voulue.
 exemple : dans le répeertoire builder. utilisation dans le fichier authenticator.php ligne ligne 35,36,37

- Un observer pour la notification lors de la création d'un article mis en place dans le répertoire Observer.
