Evaluation en cours de formation (STUDY)
-

Garage Parrot Novembre 2023
-

# Ce fichier readme a deux objectifs :

## 1 - explication de la démarche à suivre pour l’exécution en local
	
	Une fois les fichiers de l'application téléchargés, et le framework symfony installé
ouvrir un terminal dans le repertoire de l'application et entrer la commande suivante:
symfony server:start -d         (le -d est faccultatif et permet de continuer à utiliser le terminal)
	
	Le terminal va alors servir de serveur virtuel pour exécuter le code en local, il suffit
de cliquer sur le lien fourni dans le terminal
	

## 2 - Explication de la méthode de création d'un utilisateur ADMIN

	A la création de l'application un utilisateur a reçu le rôle ADMIN qui correspond
au plus haut niveau d'autorité. Au sein de l'application il n'est pas possible de créer
directement un autre ADMIN, pour ce faire il convient de modifier un utilisateur existant pour lui attribuer ce rôle. 

	Créer un utilisateur peu se faire via l'application ou via la base de donnée en entrant
le code SQL suivant : 

INSERT INTO user (email, roles, password, name) VALUES ('paul@example.com', '["ROLE_USER"]', 'hashed_password', 'Paul');

Avec cette deuxième méthode il est possible d'attribuer directement le rôle voulu :
["ROLE_ADMIN", "ROLE_USER"].

Cependant si l'utilisateur à été créé via l'application il faut alors entrer le code SQL suivant :
UPDATE user SET roles = '["ROLE_ADMIN", "ROLE_USER"]' WHERE name = 'paul';
