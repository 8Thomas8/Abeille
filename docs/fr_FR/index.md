# Présentation 

(Portage en cours de la documentation vers le format officiel jeedom, le texte que vous lisez est en cours d'écriture. La doc originale est toujours à [cet emplacement](https://github.com/KiwiHC16/Abeille)


## Abeille

![Abeille Icone](../images/Abeille_icon.png)

*Le plugin Abeille*  permet de mettre en place un réseau ZigBee avec des produits du marché et des réalisations personnelles (DIY) par l'intermédaire de la passerelle Zigate.

"ZiGate est une passerelle universelle compatible avec énormément de matériels radios ZigBee. Grâce à elle, vous offrez à votre domotique un large panel de possibilités. La ZiGate est modulable , performante et ouverte pour qu'elle puisse évoluer selon vos besoins.
"
Dixit son créateur.

Ce plugin est né de besoins personnels : capteur de température radio distant avec un réseau sécurisé, mesh,… 

Finalement, il intègre de plus en plus d’équipements :
[Compatibilité](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/040_Compatibilite.adoc)

Mon réseau personnel fonctionne depuis plusieurs mois et possède actuellement 45 équipements et continue de grossir.

Ce plugin inclus les fonctions de base pour la gestions de équipements comme On/Off/Toggle/Up/Down/Detection/… mais aussi des fonctions avancées pour faciliter la gestion d’un gros réseau :
* Retour d'état des équipements,    
* Santé (Dernière communication,…)
* Niveau des batteries 
* Graphe du réseau
* Liste de tous les équipements du réseau
* Informations radio sur les liaisons entre les équipements
* En mode USB ou en mode Wifi
* Fonctionne avec Homebridge
-    …





## Timer

![Timer Icone](../images/node_Timer.png)

J’ai aussi intégré un « sous-plugin » [TIMER](#tocAnchor-1-6) qui fonctionne à la seconde dans ce plugin. Il faudra peut être que je fasse un plugin dédié et indépendant.


## Enjoy

Pour ceux qui utiliseront ce plugin, je vous souhaite une bonne expérience. Pour ceux qui auraient des soucis, vous pouvez aller sur le forum ou ouvrir une « issue » dans github (Je ferai de mon mieux pour vous aider).


# Raccourcis

[Premiers pas](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/010_Introduction.adoc)

[Pour Tous](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/)

[Equipements supportés](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/040_Compatibilite.adoc)

[Pour les développeurs](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/012_Dev.adoc)

[Systèmes Testés](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/015_Systemes_Testes.adoc)

[Change Log](https://github.com/KiwiHC16/Abeille/blob/master/Documentation/075_version.adoc)

[links](900_Timers.md)


# Plus de détails

Ce plugin Jeedom permet de connecter un réseau ZigBee au travers de la passerelle ZiGate. 
Il est en permanente évolution.

## Il permet

- de connecter les ampoules IKEA
- de connecté toute la famille Xiaomi Zigbee (Sensor presence, prise, temperature, humidité, pression, interrupteur, porte).
- de faire les inclusions des equipments zigbee depuis jeedom
- d'avoir l'état de l ampoule IKEA, son niveau de brillance, ses caractéristiques (nom, fabriquant, SW level).
- de commander les ampoules une par une (On/Off, niveau, couleur,...)
- de commander les ampoules et autre par groupe (On/Off, niveau)
- d'avoir l'état de la prise Xiaomi avec la puissance et la consommation (Nom et Fabriquant)
- d'avoir les temperatures, humidité, pression Xiaomi, son nom, tension batterie
- d'avoir la remontée d'une presence (capteur infrarouge xiaomi)
- d'avoir la remontée d'ouverture de porte
- d'avoir les clics sur les interrupteurs (1, 2, 3 ou 4 clics)
- de définir des groupes comprenant des ampoules IKEA et prise xiaomi (Je peux donc avoir un mix dans le même groupe qui est commandé par une télécommande IKEA par exemple, ou faire un va et vient sur des ampoules IKEA avec 2 télécommandes IKEA (ce qui n'est pas possible avec la solution pure IKEA),...)

## Ce qu'on peut faire

Exemples:
- Si j’appuie sur l’interrupteur Xiaomi, avec un scenario Jeedom, j'allume l’ampoule IKEA.
- Avec une télecommande Ikea je commande ampoule Ikea, Hue, OSRAM,... prise ... tout en même temps
- Avec deux, trois, quatre,... télécommandes Ikea je fais un va et vient
- Je contrôle chaque équipement depuis Jeedom.

Et surtout, je profite du « mesh » ZigBee (des ampoules IKEA et prise Xiaomi) car je vous confirme que les prises Xiaomi et les ampoules IKEA font le routage des messages ZigBee.


# Installation

## ZiGate

- La ZiGate est avec le bon firmware et connectée au port USB ou sur son module wifi (le firmware actuellement testé est la version 30e: https://github.com/fairecasoimeme/ZiGate/tree/master/Module%20Radio/Firmware )

## Widget

> Je vous propose d' installer des widgets avant d'installer Abeille pour avoir une interface graphique plus sympa mais ce n'ai pas obligatoire.

- Installer quelques widgets (plugin officiel) qui seront utilisés lors de la création des objets. Ce n'est pas obligatoire mais le résultat est plus joli.
* baromètre pour le capteur Xiaomi Carré (dashboard.info.numeric.barometre )
* thermomètre pour les capteurs Xiaomi ronds et carrés (dashboard.info.numeric.tempIMG)
* humidité pour les capteurs Xiaomi ronds et carrés (dashboard.info.numeric.hydro3IMG)

![](../images/Capture_d_ecran_2018_01_21_a_11_30_2.png)

## Objet de référence

> Afin de trouver rapidement les nouveaux équipements, il est nécessaire de créer une pièce (un objet jeedom) auquel seront rattachés par défaut.

- Créez un objet sur lequel les nouveaux objets seront rattachés automatiquement. Menu Outils->Objet->"+ vert" (Objet Id=1, pour l'instant codé en dur).

![](../images/Capture_d_ecran_2018_01_21_a_10_53_59.png)

![](../images/Capture_d_ecran_2018_01_21_a_10_54_13.png)

Récupérez sont ID en sélectionnant "Vue d'ensemble"

![](../images/Capture_d_ecran_2018_01_21_a_17_27_54.png)

![](../images/Capture_d_ecran_2018_01_21_a_17_28_01.png)

##  Installation du plugin

### Depuis Github

- Créer un répertoire Abeille dans le repertoire des plugins et installer les fichiers.
* ssh sur votre jeedom
* cd /var/www/html/plugins/

- si vous prenez le zip file
```
* mkdir Abeille
* cd Abeille
* unzip le fichier téléchargé de GitHub dans le répertoire
* cd ..
````

- Si vous allez directement avec git
```
* git clone https://github.com/KiwiHC16/Abeille.git Abeille
```

Et pour le développeurs, voici une info très utile:

>Merci @lukebr 

Pour une mise à jour à partir de github :
```
cd ../../var/www/html/plugins/Abeille
sudo git pull https://github.com/KiwiHC16/Abeille
```

Et si il y a eu des bidouilles en local pour écraser avec dernière mise à jour :
```
cd /var/www/html/plugins/Abeille
sudo git reset --hard HEAD
sudo git pull https://github.com/KiwiHC16/Abeille
```

- Et pour finir
```
* chmod -R 777 /var/www/html/plugins/Abeille
* chown -R www-data:www-data /var/www/html/plugins/Abeille
```



Si vous voulez aller a un commit specifique:
```
git reset --hard dd7fa0a
```

### Depuis le market

* Rien de spécifique. Suivre la procédure classique. Pour l'instant il ne doit y avoir qu'une version en beta.

### Alternative : Installation du github depuis le market

- Aller sur configuration puis l'onglet mise à jour, selectionner en dessous l'onglet Github cocher activer . On enregistre.
- Aller sur l'onglet plugin clic et gestion des plugin. Une fenetre s'ouvre que vous connaissez mais sur la gauche il y a une petite fleche pointant vers la droite (clic dessus)
- Faire ajouter à partir d'une autre source et sélectionner GITHUB
- Rentrer la paramètres suivants dans l'ordre :
* ID logique du plugin: Abeille
* Utilisateur ou organisateur: KiwiHC16
* Nom du dépôt: Abeille
* Branche: master

## Activation

- Activation du plugin
* Allez sur l'interface http Jeedom
* Menu Plugin, Gestion des plugin
* sélectionner Abeille

![](../images/Capture_d_ecran_2018_01_21_a_10_53_37.png)

* Activer

![](../images/Capture_d_ecran_2018_01_21_a_11_05_58.png)

* Choisir le niveau de log et Sauvegarder
* Lancer l'installation des dépendances, bouton Relancer et patienter (vous pouvez suivre l'avancement dans le fichier log: Abeille_dep)

![](../images/Capture_d_ecran_2018_01_21_a_11_06_33.png)

* Quand le statut Dépendance passe à Ok en vert (Patientez 2 ou 3 minutes), définir l objet ID et le port serie puis Démarrer les Démons.

Puis:
> Si vous avez un zigate USB, choisissez le bon port /dev/ttyUSBx.
> Si vous avez une zigate Wifi, choisissez le port "WIFI" dans la liste et indiquer son adresse IP.


![](../images/Capture_d_ecran_2018_01_21_a_11_07_14.png)

* Si vous rafraîchissez la page vous devez voir les fichiers de logs.

![](../images/Capture_d_ecran_2018_01_21_a_11_07_38.png)

A noter: Toute sauvegarde de la configuration provoque une relance du cron du plugin et donc un rechargement de la configuration

- Creation des objets
* Allez dans la page de gestion des objets en sélectionnant le menu plugins, puis protocole domotique, puis Abeille
* Vous devriez voir un premier objet "Ruche" (et éventuellement les objets abeille).

![](../images/Capture_d_ecran_2018_01_21_a_11_55_44.png)

* Si vous allez sur le dashboard

![](../images/Capture_d_ecran_2018_01_21_a_11_07_55.png)

* Tous les autres objets seront créés automatiquement dès détection.

## Utilisation de Jeedom
* Allez sur la page principale et vous devriez voir tous les objets détectés. A cette étape probablement uniquement l'objet Ruche si vous démarrez votre réseau ZigBee de zéro.
* Le nom de l objet est "Abeille-" suivi de son adresse courte zigbee.

*A noter: rafraichir la page si vous voyez pas de changement après une action, par exemple après l'ajout d'un équipement.*


# Tuto

## Presence->Ampoule

Pilotage d une ampoule à partir d'un capteur de présence.

### Inclusion Capteur presence

Aller à la page de configuration du plugin Abeille et clic sur fleche verte pour l inclusion:

![](../images/Capture_d_ecran_2018_10_30_a_10_09_21.png)

Prendre le capteur de presence Xiaomi et faire un appui long (>6s) sur le bouton lateral. Le capteur doit se mettre à flasher et un message d'information doit apparaitre dans jeedom:

![](../images/Capture_d_ecran_2018_10_30_a_10_16_27.png)

Rafraichissez la page pour voir votre capteur:

![](../images/Capture_d_ecran_2018_10_30_a_10_18_23.png)

Vous pouvez changer son nom, je vais lui donner comme nom "Presence" pour la suite.

### Inclusion Ampoule Ikea

Mettre sous tension votre ampoule. Elle doit être allumée pour commencer la manipulation.

Aller à la page de configuration du plugin Abeille et clic sur fleche verte pour l inclusion:

![](../images/Capture_d_ecran_2018_10_30_a_10_09_21.png)

Prendre le capteur de presence Xiomi et faire un appui long (>6s) sur le bouton lateral. Le capteur doit se mettre à flasher et un message d'information doit apparaitre dans jeedom:

En partant de l'ampoule allumée, l'éteindre et la rallumer 6 fois de suite. A la fin de cette opération l'ampoule doit être allumée. Puis elle doit se mettre à clignoter et un message d'information doit apparaitre dans jeedom:

![](../images/Capture_d_ecran_2018_10_30_a_10_27_35.png)

Rafraichissez la page pour avoir votre ampoule:

![](../images/Capture_d_ecran_2018_10_30_a_10_29_10.png)

Vous pouvez changer son nom, je vais lui donner comme nom "Ampoule" pour la suite.

### Pilotage de l ampoule

Nous allons utiliser les scénarios:

![](../images/Capture_d_ecran_2018_10_30_a_10_33_20.png)

Créons un scénario "test" avec pour déclencheur "Presence".

image::images/Capture_d_ecran_2018_10_30_a_10_38_29.png)

Et les actions:

![](../images/Capture_d_ecran_2018_10_30_a_10_40_48.png)

Ici, quand une présence est détectée, on allume l ampoule et quand la présence n'est pas présente on eteint l ampoule.


## Presence->Ampoule<-Telecommande

Dans la configuration précedente, nous allons ajouter une télécommande pour controler l'ampoule.

### Inclusion télécommande

Aller à la page de configuration du plugin Abeille et clic sur fleche verte pour l inclusion:

![](../images/Capture_d_ecran_2018_10_30_a_10_09_21.png)

Prendre la telecommande Ikea et faire 4 appuis sur le bouton OO au dos de la télécommande. La télécommande doit se mettre à flasher rouge en face avant et un message d'information doit apparaitre dans jeedom:

![](../images/Capture_d_ecran_2018_10_30_a_10_58_53.png)

Rafraichissez la page pour voir votre capteur:

![](../images/Capture_d_ecran_2018_10_30_a_10_59_04.png)

Je vais lui donner le nom "Tele" par la suite. A cette étape cet objet Tele dans Jeedom ne peut ête utilisé. Il faut executer les étapes de du chapitre "Simuler la télécommande".

Continuons en configurant l ampoule depuis la Tele:

* Allumer l'ampoule.
* Approcher la télécommande à quelques centimetres de l ampoule
* Appuyer plus de 10s sur le bouton OO au dos de la télécommande: la led rouge sur la face avant de la télécommande doit clignoter et l ampoule doit se mettre à à clignoter.

Ca y est la télécommande pilote l'ampoule et l'ampoule remonte son état à Jeedom.

### Simuler la télécommande

Cette opération est un peu délicate mais doit permettre de récupérer l'adresse de groupe utilisée par la télécommande suite aux opérations ci dessus. Dans le futur j'espere rendre cela automatique.

Aller dans la page de configuration du plugin et clic sur "Network" icon pour faire apparaitre les parametres dans l'Ampoule:

![](../images/Capture_d_ecran_2018_10_30_a_11_30_24.png)

Sur l objet Ampoule vous devez vous le champ "Groups" apparaitre sans information:

![](../images/Capture_d_ecran_2018_10_30_a_11_36_43.png)

Recuperons l'adresse de l ampoule, en ouvrant la page de configuration de l ampoule:

![](../images/Capture_d_ecran_2018_10_30_a_11_42_09.png)

Le champ "Topic Abeille" coontient l adresse, ici "9252".

Interrogeons maintenant l'ampoule, avec un getGroupMemberShip depuis l objet Ruche:

![](../images/Capture_d_ecran_2018_10_30_a_11_45_23.png)

indiquez l'adresse de l ampoule.

Maintenant le champ "Groups" de l ampoule doit contenir l'adresse de groupe:

![](../images/Capture_d_ecran_2018_10_30_a_11_47_24.png)

ici le groupe utilisé par la télécommande est "f65d".

Maintenant nous pouvons mettre à jour la télécommande dans jeedom. Ouvrez les commandes de la Telecommande:

![](../images/Capture_d_ecran_2018_10_30_a_11_50_17.png)

Dans le champ "Topic" des commandes vous pouvez voir le texte \#addrGroup# qu'il faut remplacer par la valeur du groupe, ici "f65d" et sauvegarder.

Cela donne:

![](../images/Capture_d_ecran_2018_10_30_a_11_54_51.png)

Mainteant vous pouvez commander votre ampoule depuis la Télécommande physique et depuis la Télécommande Jeedom.

![](../images/Capture_d_ecran_2018_10_30_a_11_58_42.png)

PS: Les scénarios ne sont pas implémentés pour l'instant (30/10/2018):

* Sc1, Sc2, SC3 sur la télécommande dans Jeedom, 
* et les boutons "Fleche Gauche", "Fleche Droite" de la télécommande physique.




# Ikea

## Ampoule

#### Bouton Identify

Ce bouton est créé au moment de la création de l'objet. Celui ci permet de demander à l'ampoule de se manifester. Elle se met à changer d'intensité ce qui nous permet de la repérer dans une groupe d'ampoules par exemple.

#### Creation objet

- Si l'ampoule n'est pas associée à la zigate, avec Abeille en mode Automatique, une association doit provoquer la création de l'obet dans Abeille

- Si l'ampoule est déjà associée à la zigate, avec Abeille en mode Automatique, 
* l'allumage électrique doit provoquer l'envoie par l'ampoule de sa présence (annonce) et la création par Abeille de l'objet associé.
* l'extinction électrique pendant 15s puis allumage électrique doit provoquer l'envoie par l'ampoule de sa présence (son nom) et la création par Abeille de l'objet associé. 
* Vous pouvez aussi Utiliser la commande getName dans la ruche, mettre l’adresse courte dans le titre et rien dans le message. Puis rafraichir le dashboard et la l’ampoule doit être présente.

#### Retour d'état

Pour que l'ampoule puisse remonter automatiquement son état à Jeedom, il faut mettre en place un "bind" et un "set report".

Maintenant c'est automatique mais si cela ne fonctionnait pas il y a toujours la vieille methode.

Pour se faire, il faut utiliser les commandes bind et setReport sur l'objet Ampoule.

Le widget ampoule doit être plus ou moins comme cela:

![](../images/Capture_d_ecran_2018_10_12_a_16_51_39.png)

Il faut faire apparaite les commandes de configuration. Aller dans la page de configuration du plugin et selectionner "Network" dans le chapitre "Affichage Commandes". Maintenant le widget doit ressembler à:

![](../images/Capture_d_ecran_2018_10_12_a_16_58_44.png)

il suffit de faire un BindShortToZigateEtat, setReportEtat. Si votre ampoule supporte la variation d'intensité, faites un BindShortToZigateLevel, setReportLevel.

ur que cela fonctionne il est important que le champ IEEE soit rempli. Si tel n'est pas le cas faites un Liste Equipement sur la ruche et si cela ne suffit pas faire un "Recalcul du Cache" dans Network List de la page de conf du plug in.

> Y a encore du travail en cours pour simplifier cette partie.


#### Bind specifique:

Identifiez l'ampoule que vous voulez parametrer:

![](../images/Capture_d_ecran_2018-02_21_a_23_26_56.png)

Récuperer son adresse IEEE, son adress courte (ici 6766).

De même, dans l'objet Ruche récupérez l'adresse IEEE (Si l'info n'est pas dispo, un reset de la zigate depuis l objet ruche doit faire remonter l'information).

Mettre dans le champ:

- Titre, l'adresse IEEE de l'ampoule que vous voulez parametrer
- Message, le cluster qui doit être rapporté, et l adresse IEEE de la zigate.

![](../images/Capture_d_ecran_2018_02_21_a_23_26_49.png)

Attention a capture d'écran n'est pas à jour pour le deuxieme champs.

Dans message mettre:
```
targetExtendedAddress=XXXXXXXXXXXXXXXX&targetEndpoint=YY&ClusterId=ZZZZ&reportToAddress=AAAAAAAAAAAAAAAA
````

Exemple avec tous les parametres:
````
targetExtendedAddress=90fd9ffffe69131d&targetEndpoint=01&ClusterId=0006&reportToAddress=00158d00019a1b22
````


Après clic sur Bind, vous devriez voir passer dans le log AbeilleParse (en mode debug) un message comme: 

![](../images/Capture_d_ecran_2018_02_21_a_23_27_29.png)

qui confirme la prise en compte par l'ampoule. Status 00 si Ok.


#### Rapport Manuel:

Ensuite parametrer l'envoie de rapport:

- Titre, l adresse courte de l'ampoule
- Message, le cluster et le parametre dans le cluster

![](../images/Capture_d_ecran_2018_02_21_a_23_29_11.png)

Attention a capture d'écran n'est pas à jour pour le deuxieme champs.

````
targetEndpoint=01&ClusterId=0006&AttributeType=10&AttributeId=0000 pour retour d'état ampoule Ikea

targetEndpoint=01&ClusterId=0008&AttributeType=20&AttributeId=0000 pour retour de niveau ampoule Ikea
````


De même vous devriez voir passer dans le log AbeilleParse (en mode debug) un message comme: 

![](../images/Capture_d_ecran_2018_02_21_a_23_29_49.png)

qui confirme la prise en compte par l'ampoule. Status 00 si Ok.

Après sur un changement d'état l'ampoule doit remonter l'info vers Abeille, avec des messages comme:

![](../images/Capture_d_ecran_2018_02_21_a_23_31_11.png)

pour un retour Off de l'ampoule.

=== Gestion des groupes

Vous pouvez adresser un groupes d'ampoules (ou d'équipements) pour qu'ils agissent en même temps.

Pour se faire sur l'objet ruche vous avez 3 commandes:

![](../images/Capture_d_ecran_2018_03_07_a_11_32_21.png)

* Add Group: permet d'ajouter un groupe à l'ampoule. Celle ci peut avoir plusieurs groupes et réagira si elle recoit un message sur l'un de ces groupes.

![](../images/Capture_d_ecran_2018_03_07_a_11_38_19.png)

Le DestinatioEndPoint pour une ampoule Ikea est 01. Pour le groupe vous pouvez choisir. Il faut 4 caractères hexa (0-9 et a-f).

* Remove Group: permet d'enlever l'ampoule d'un groupe pour qu'elle ne réagisse plus à ces commandes.

![](../images/Capture_d_ecran_2018_03_07_a_11_44_50.png)

*getGroupMembership: permet d'avoir la liste des groupes pour lesquels l'ampoule réagira. Cette liste s'affiche au niveau de l'ampoule, exemple avec cette ampoule qui va repondre au groupe aaaa et au groupe bbbb.

![](../images/Capture_d_ecran_2018_03_07_a_11_43_14.png)
![](../images/Capture_d_ecran_2018_03_07_a_11_41_21.png)


#### Telecommnande Ronde 5 boutons

#### Télécommande réelle

(Pour l'instant c'est aux équipements qui recevoient les demandes de la telecommande reelle de renvoyer leur etat vers jeedom, sur un appui bouton telecommande, la ZiGate ne transmet rien au plugin Abeille).

Pour créer l'objet Abeille Automatiquement, 

[line-through]#- Premiere solution: faire une inclusion de la télécommande et un objet doit être créé.
Ensuite paramétrer l'adresse du groupe comme indiqué ci dessous (voir deuxieme solution).#


- Deuxieme solution, il faut connaitre l'adresse de la telecommande (voir mode semi automatique pour récupérer l'adresse). 

Puis dans la ruche demander son nom. Par exemple pour la telecommande à l'adress ec15

![](../images/Capture_d_ecran_2018_02_28_a_13_59_31.png)

et immédiatement apres appuyez sur un des boutons de la télécommande pour la réveiller (pas sur le bouton arriere).

Et apres un rafraichissement de l'écran vous devez avoir un objet

![](../images/Capture_d_ecran_2018_02_28_a_14_00_58.png)

Il faut ensuite editer les commandes en remplacant l'adresse de la télécommande par le groupe que l on veut controler

La configuration

![](../images/Capture_d_ecran_2018_02_28_a_14_03_26.png)

va devenir 

![](../images/Capture_d_ecran_2018_02_28_a_14_03_47.png)

pour le groupe 5FBD.

##### 4x sur bouton arriere provoque association

Association
Device annonce
Mais rien d'autre ne remonte, il faut interroger le nom pour créer l objet.

##### 4x sur bouton arriere provoque Leave

Si la telecommande est associée, 4x sur bouton OO provoque un leave.

##### Recuperer le group utilisé par une télécommande

Avoir une télécommande et une ampoule Ikea sur le même réseau ZigBee. Attention l'ampoule va perdre sa configuration. Approcher à 2 cm la télécommande de l'ampoule et appuyez pendant 10s sur le bouton à l'arriere de la telecommande avec le symbole 'OO'. L'ampoule doit clignoter, et relacher le bouton. Voilà la télécommande à affecté son groupe à l'ampoule Il suffit maintenant de faire un getGroupMemberShip depuis la ruche sur l'ampoule pour récupérer le groupe. Merci a @rkhadro pour sa trouvaille.


>Il existe un bouton « link » à côté de la pile bouton de la télécommande. 4 clicks pour appairer la télécommande à la ZiGate. Un appuie long près de l’ampoule pour le touchlink.


#### Télécommande Virtuelle

La télécommande virtuelle est un objet Jeedom qui envoies les commandes ZigBee comme si c'était une vrai télécommande IKEA.

Utiliser les commandes cachées dans la ruche:

* Ouvrir la page commande de la ruche et trouver la commande "TRADFRI remote control".

![](../images/Capture_d_ecran_2018_03_02_a_10_34_40.png)

Remplacez "/TRADFRI remote control/" l'adresse du groupe que vous voulez controler. Par exemple AAAA.

![](../images/Capture_d_ecran_2018_03_02_a_10_35_08.png)

Sauvegardez et faites "Tester".

Vous avez maintenant une télécommande pour controler le groupe AAAA.

![](../images/Capture_d_ecran_2018_03_02_a_10_35_28.png)


### Gradateur

#### Un clic sur OO

Un clic sur OO envoie un Beacon Request. Même si la zigate est en inclusion, il n'y a pas d'association (Probablement le cas si deja associé à una utre reseau).

#### 4 clics sur OO

Message Leave, puis Beacon Requets puis association si réseau en mode inclusion. Une fois associé, un getName avec un reveil du gradateur permet de recuperer le nom.

Voir la telecommande 5 boutons pour avoir plus de details sur le controle de groupe,...

# Philips Hue

###  Creation objet dans Abeille

#### Association

- Ampoule neuve Hue White, Abeille en mode Inclusion, branchement de l'ampoule. L'ampoule s'associe et envoie des messages "annonce" mais pas son nom. Si vous faites un getName avec son adresse courte dans le champ Titre et 0B (destinationEndPoint) dans le champ Message, alors elle doit répondre avec son nom, ce qui va créer l'objet dans le dashboard (rafraichir).


#### Si deja associé

- Si l’ampoule est déjà associée à la zigate, avec Abeille en mode Automatique,

* l’extinction électrique pendant 15s puis allumage électrique doit provoquer l’envoie par l’ampoule de sa présence et la création par Abeille de l’objet associé.

* Utiliser la commande getName dans la ruche, mettre l'adresse courte dans le titre et 03 (destinationndPoint) dans le message. Puis rafraichir le dashboard et la l'ampoule doit être présente.

### Philips Hue Go

#### Association

#### Si deja associé

* tres long appui sur le bouton arriere de l ampoule plus de 40s probablement avec la zigate qui n'est pas en mode inclusion. La lampe se met a flasher. Elle s'est deconnectée du réseau. Mettre la zigate en Inclusion et la lampe envoie des messages "annonce" et elle doit se créer dans Abeille.

#### Colour Control

Sur un objet ampoule vous pourrez trouver la commande Colour:

image::images/Capture_d_ecran_2018_02_13_a_23_07_50.png[]

Dans le premier champ indiquez la valeur X et dans le deuxième champ la valeur Y.

Par exemple:

* 0000-0000 -> Bleu
* FFFF-0000 -> Rouge
* 0000-FFFF -> Vert

#### Group Control

image::images/Capture-d_ecran_2018_02_14_a_11_15_18.png[]

Avec ca je commande la Philips Hue depuis télécommande Ikea ronde 5 boutons ...

### Telecommande / Philips Hue Dimmer Switch

#### Association

Appuie avec un trombone longtemps sur le bouton en face arriere "setup" avec la zigate en mode Inclusion. Un objet télécommande doit être créé dans Abeille.


#### Récupérer le groupe utilisé

Approcher la telecommande d'une ampoule de test qui est sur le reseau. Faire un appui long >10s sur le I de la télécommande. Attendre le clignotement de l'ampoule. Ca doit être bon. Si vous appuyé sur I ou O, elle doit s'allumer et s'éteindre. Et les bouton lumière plus et moins doivent changer l'intensité. Ensuite vous pouvez récupérer le groupe en interrogeant l'ampoule depuis la ruche avec un getGroupMembership. 

#### Reset d une ampoule

Si vous appuyez, sur I et O en même temps à moins de quelques centimetres, l'ampoule doit faire un reset et essayer de joindre un réseau. Si la zigate est en mode inclusion alors vous devez récurerer votre ampoule. Ca marche sur des ampoules Hue et Ikea, probablement pour d autres aussi.


# Profalux

## Inclusion d'un volet

Comme pour tous modules ZigBee et pour bien comprendre la procédure, il faut savoir que :

La ZiGate est un coordinateur ZigBee qui permet de contrôler / créer un réseau. De la même manière que le couple télécommande / ampoule ZigBee, il est important que les deux matériels appartiennent et soient authentifiés sur le même réseau.

N’ayant pas de boutons ou d’interfaces, un volet Profalux Zoé ne peux pas rentrer tout seul sur un réseau ZigBee. Il est indispensable d’avoir une télécommande maître qui jouera le rôle d’interface entre le volet et la ZiGate.

- Étape 1:

La première chose à faire est de remettre à zéro la télécommande maître. Pour cela, il faut:

* Retourner l’appareil
* A l’aide d’un trombone, appuyer 5 fois sur le bouton R

La télécommande va clignoter rouge puis vert

![](../images/profalux_inclusion_etape1.png)

- Étape 2 : Appairage du volet à la télécommande

Suite à l’étape 1, le volet va faire un va et vient (attendre un petit moment).

Dans la minute suivante, appuyer sur la touche STOP

Le volet va faire un va et vient (signe que la commande a bien été reçue). Pour tester le bon fonctionnement, vous devriez pouvoir piloter le volet avec la télécommande.

- Étape 3 : Mettre la ruche en mode inclusion

Pour cela appuyer sur le bouton inclusion de votre ruche depuis le dashboard.

![](../images/profalux_inclusion_etape3.png)

- Étape 4 : Appairer le volet à la ZiGate

Une fois le réseau de la ZiGate ouvert, il ne vous reste plus qu’à:

* Retourner votre télécommande
* Appuyer 1 fois sur R
* Appuyer ensuite sur la flèche du haut
* Le moteur devrait faire un va et vient … c’est gagné !

* Pour finir, appuyer sur la touche STOP de la télécommande.

![](../images/profalux_inclusion_etape4.png)

Faites un rafraichissement de votre dashboard et votre volet devrait apparaitre.



### Résolution de problèmes:

- Le volet ne répond plus à la télécommande.

Si par une mauvaise manipulation votre volet ne répond plus à la télécommande, il est nécessaire de faire un reset de la télécommande et du volet.

* Retourner l’appareil
* A l’aide d’un trombone, appuyer 5 fois sur le bouton R

image::images/profalux_inclusion_etape1.png[]

* Couper l'alimentation électrique
* Réunir les fils noir et marron puis les brancher sur la borne de phase

![](../images/profalux_inclusion_reset_volet2.png)

* Remettre l'alimentation électrique pendant 5 secondes. Le volet devrait faire un petit mouvement.
* Couper l'alimentation électrique
* Séparer les fils noir et marron. Brancher le fils marron sur la phase. Si votre fils noir était brancher avec le bleu aupparavant, rebrancher le avec le bleu sinon laisser le fils noir seul en pensant à l'isoler(capuchon noir)

![](../images/profalux_inclusion_reset_volet3.pn)

* Remmettre l'alimentation électrique et dans la minute appuyer sur le bouton stop

![](../images/profalux_inclusion_reset_volet4.png)

Le volet devrait faire des mouvement de va-et-vient puis s'arrêter
* La télécommande devrait à nouveau fonctionner
* Recommencer à nouveau la procédure d'inclusion

### Retour expérience

@MaxDak
```
Confronté au même problème à savoir: va et viens en guise de réponse à toutes les commandes (mes volets profalux sont récents moins d'un mois).
J'ai enfin réussi à les piloter !
J'ai suivi la procédure classique d'appairage à la seule différence que j'ai fermé totalement le volet avant de commencer la procédure.
Et la miracle toutes les commandes fonctionnent...
````



# Xiaomi

## Temperature Carré, Temperature Rond, Bouton Carré, Sensor Door, Presence IR

### Creation objet

Si l'équipement n'est pas associée à la zigate, avec Abeille en mode Automatique, une association doit provoquer la création de l'obet dans Abeille

### Si deja associé

Si l'équipement est déjà associée à la zigate, avec Abeille en mode Automatique, un appui court sur le bouton latéral doit provoquer l'envoie d'un message pour signaler sa présence et la création par Abeille de l'objet associé.

### Prise

#### Creation objet

Si l'équipement n'est pas associée à la zigate, avec Abeille en mode Automatique, une Inclusion doit provoquer la création de l'obet dans Abeille


#### Si deja associé

Si l'équipement est déjà associée à la zigate, avec Abeille en mode Automatique, un appui long (7s) sur le bouton latéral doit provoquer l'envoie d'un message Leave (la prise se deconnecte du reseau) puis la prise envoie des messages "annonce" pour signaler sa présence. Mettre en mode Inclusion la Zigate et la création par Abeille de l'objet associé doit se faire.

### Bouton Rond (lumi.sensor_switch)

### Appui court (<1s) sur bouton arriere avec trombone

Remonte un champ ff02 avec 6 elements (Pas recu par le parser, Remontée batterie sensor presence Xiaomi #141, devrait être dans ZiGate, Fixed in next version (3.0e) )
Puis son nom lumi.sensor_switch

#### Fonctionnement

Ce bouton envoie un message lors de l'appui mais aussi lors du relachement. L'état dans Abeille/Jeedom reflete l'état du bouton.

#### Scenario

Sur reception d'un changement l'état, un scénario peut être lancé et la valeur de l'état peut être testée lors du déroulement du scénario.

### Bouton Carre (lumi.sensor_switch.aq2)

#### Appui court (<1s) sur bouton lateral

Remonte son nom et attribut ff01 (longueur 26) qui est décodé par le parser.

#### Fonctionnement

##### Etat

Contrairement au bouton rond ci dessus, le bouton carré n'envoie pas d'information sur l'appui. Il envoie l'information que sur la relache.

Afin d'avoir le visuel sur le dashboard, l'état passe à 1 sur la reception du message et jeedom attend 1 minute avant de le remettre à 0.

##### Multi

Pour l'information multi, celle ci remonte quand on fait plus d'un appui sur le bouton. Multi prend alors la valeur remontée. Le bouton n'envoie pas d'autre information et donc la valeur reste indéfiniment. Par defaut l'objet créé demande à jeedom de faire un retour d'état à 0 apres une minute. Cela peut être enlevé dans les parametres de la commande.

#### Scenario

#### Etat

Du fait de ce fonctionnement, nous ne pouvons avoir une approche changement d'état. Il faut avoir une approche evenement. De ce fait la gestion des scenariis est un peu differente du bouton rond. 

Par défaut le bouton est configuré pour déclencher les scenariis à chaque appui (même si l'etat était déjà à 1). Mais Jeedom va aussi provoquer un evenement au bout d'une minute en passant la valeur à 0. 

Lors de l'execution du scenario, si vous testé l'état du bouton est qu'il est à un vous avez recu un evenement appui bouton, si l'état est 0, vous avez recu un evenement retour à zero apres une minute. 

Par exemple pour commander une ampoule Ikea:

![](../images/Capture_d_ecran_2018_09_04_a_13_05_49.png)

![](../images/Capture_d_ecran_2018_09_04_a_13_05_.36.png)

#### Multi

Le fonctionnement de base va provoquer 2 événements, un lors de l'appui multiple, puis un second après 1 minute (généré par Jeedom pour le retour d'état). Si vous enlevez de la commande le retour d'état alors vous n'aurez que l'événement appui multiple. 
Par defaut, en gros, le scenario se declenche et si vous testez la valeur multi > 1, c'est un evenement appui multiple et si valeur à 0 alors evenement jeedom de retour d etat.

### Capteur Inondation (lumi.sensor_wleak.aq1)

#### Appui court (<1s) sur le dessus

Remonte son nom et attribut ff01 (longueur 34)

### Capteur de Porte Ovale (lumi.sensor_magnet)

#### Appui court (<1s) avec un trombone

Remonte un champ ff02 avec 6 elements (Pas recu par le parser, Remontée batterie sensor presence Xiaomi #141, devrait être dans ZiGate, Fixed in next version (3.0e) )
Puis on son nom lumi.sensor_magnet

### Capteur Porte Rectangle (lumi.sensor_magnet.aq2)

#### Appui court (<1s) sur bouton lateral

Remonte son nom et ff01 (len 29)

#### Appui Long (7s) sur bouton lateral

Apparaige
Remonte son nom et Application Version
Remonte ff01 (len 29)


### Capteur Presence V1 (lumi.sensor_motion)

#### Appui court (<1s) avec trombone

#### Appui long (7s) avec trombone

Appairage
Remonte son nom
Remonet Appli Version
Remonte ff02 avec 6 elements (Pas recu par le parser, Remontée batterie sensor presence Xiaomi #141, devrait être dans ZiGate, Fixed in next version (3.0e) )

#### Double flash bleu sans action de notre part

Visiblement quand le sensor fait un rejoin apres avoir perdu le reseau par exemple, il fait un double flah bleu.

### Capteur de Presence V2

#### Appui court (<1s) sur bouton lateral

Remonte son nom et FF01 de temps en temps.

#### Appui long (7s) sur bouton lateral

Leave message
Appairage
Remonte son nom et SW version
Remonte FF01 (len 33)

#### Comportement

Il remonte une info a chaque detection de presence et remonte en même temps la luminosité. Sinon la luminosité ne remonte pas d'elle même. Ce n'est pas un capteur de luminosité qui remonte l info périodiquement.

### Capteur Temperature Rond (lumi.sensor_ht)

#### Appui court (<1s) sur bouton lateral

Remonte son nom

#### Appui long (7s) sur bouton lateral

Apparaige
Remonte son nom et appli version
Remonte ff01 (len 31)


### Capteur Temperature Carré (lumi.weather)

#### Appui court (<1s) sur bouton lateral

Si sur le réseau: Remonte son nom
Si hors réseau et Zigate pas en Inclusion: Un flash bleu puis un flash bleu unique
Si hors réseau et Zigate en Inclusion: Un flash bleu, pause 2s, 3 flash bleu

#### Appui long (7s) sur bouton lateral

Leave
Apparaige
Remonte son nom et appli version
Remonte ff01 (len 37)

#### Info

Rapport:

- petite variation de temperature ou humidité, rapport one fois par heure
- Si variation de plus de 0,5°C ou de plus de 6% d'humidité aors rapport immédiat

Précision (Source Appli IOS MI FAQ Xiaomi)

- Temperature +-0,3°C
- Humidité +-3%

### Xiaomi Cube Aqara

![](../images/Capture_d_ecran_2018_06_12_a_22_00_03.png)

### Wall Switch Double Battery (lumi.sensor_86sw2)

### Appui long (7s) sur bouton de gauche

Apparaige
Remonte son nom et appli version
Remonte ff01 (len 37)

#### getName

Il repond au getName sur EP 01 si on fait un appuie long sur l'interrupteur de droite (7s) et pendant cette periode on fait un getName depuis la ruche.

#### Appui Tres Long (>10s) sur bouton de gauche

Leave


### Wall Switch Double 220V Sans Neutre (lumi.ctrl_neutral2)

#### Appui long (7s) sur bouton de gauche

Apparaige
Remonte son nom et appli version
Remonte d autres trucs mais je ne sais plus ...

#### getName

Il repond au getName sur EP 01 s.

#### Appui Tres Long (>8s) sur bouton de gauche

Leave

### Capteur Vibration

#### Appui long (7s) sur bouton de gauche

Apparaige
Remonte son nom et appli version
Remonte d autres trucs mais je ne sais plus ...

#### Attribute 0055

Il semblerai qu'une valeur:

* 1 indique une detection de vibration
* 2 indique un rotation
* 3 indique une chute

#### Attribute 0503

Pourrait être la rotation apres l envoie de l'attribut 0055 à la valeur 2

#### Attribut 0508

Inconnu, est envoyé après attribut 0055.

### Capteur Smoke

#### 3 appuis sur le bouton de facade

Après avoir mis la zigate en mode inclusion, 3 appuis sur le bouton en facade permet de joindre le réseau.

La même action, 3 appuis, alors que la zigate n'est pas en mode inclusion permet de quitter le réseau.

#### Sensibilité du capteur

Il est possible de définir le seuil de détection du capteur: 3 niveaux (En dev).

#### Test du capteur

Avec le bouton tester, vous envoyez un message au capteur qui doit réagir avec un bip sonnore (3 messages envoyés par abeille, il doit y avoir entre 1 et 3 bips).

#### Réveil

Le capteur se réveille toutes les 15s pour savoir si la zigate à des infos pour lui.

### Capteur Gaz

#### Appairage

#### Routeur

Ce capteur est un router.

#### Parametres

Vous pouvez choisir le niveau de sensibilié: Low - Moyen - High

#### Tester la bonne connection au réseau

Avec le bouton tester, vous envoyez un message au capteur qui doit réagir avec un bip sonnore (3 messages envoyés par abeille, il doit y avoir 3 bips à 5s d'intervalles).

# OSRAM

## Plug (Smart+)

A) Prise neuve: Mettre en Inclusion la zigate et brancher la prise OSRAM. Elle devrait joindre le réseau immédiatement et un objet doit être créé dans Abeille.

B) Prise associée à un autre réseau: Si la prise était déjà associé à un réseau, un appui long (> 20s) sur le bouton lateral doit provoquer l'association (Zigate en mode inclusion) et la création de l objet dans Abeille/Jeedom.

C) Prise associée à la zigate mais pas dobjet dans Abeille: voir méthode B).

### Retour d etat

Afin de configurer le retour d'état il faut avoir:
- l'adresse IEEE sur l objet prise OSRAM
- et sur l'objet ruche

Si ce n'est pas le cas vous pouvez faire un "liste Equipements" sur la ruche. Si cela ne suffit pas il faut faire "menu->Plugins->Protocol domotique->Abeille->Network List->Table de noeuds->Recalcul du cache" (Soyez patient).

Ensuite utilisez de préférence "BindShortToZigateEtat" puis "setReportEtat". Maintenant un changement d'état doit remonter tout seul et mettre à jour l'icone.

![](../images/Capture_d_ecran_2018_06_27_a_11_24_09.png)


> Le retour d'état ne remonte que si l'état change. Donc si l'icone n'est pas synchro avec la prise vous pouvez avoir l'impression que cela ne fonctionne pas. Ex: la prise est Off et l'icone est on. Vous faites Off et rien ne se passe. Pour éviter cela un double Toggle doit réaligner tout le monde.


### Ampoule E27 CLA 60 RGBW OSRAM (Classic E27 Multicolor)

Ampoule Neuve:
Mettre en Inclusion la zigate et brancher l'ampoule OSRAM. Elle devrait joindre le réseau immédiatement et un objet doit être créé dans Abeille.

Ampoule déjà connectée à un réseau:
Physically reset your light by either the lamp switch (as long as not a three way switch) or by unplugging your power cord 5 times & plugging it back in as so the light turns on (waiting 3 sec in between cycles). After the 5th time your light will confirm reset by blinking & changing colors. Thanks to: https://community.smartthings.com/t/how-to-reset-a-osram-lightify-a19-bulb-without-deleting-from-your-st-hub/40691

Partir de l ampoule allumer, (Eteindre/Allumer) 5 fois toutes les 3 secondes et elle doit essayer de joindre le réseau et fair une flash.
https://www.youtube.com/watch?v=PaA0DV5BXH0

Ne semble pas fonctionner avec la Télécommande Hue (Hue Dimmer Switch).



# Timers

Depuis pas mal de temps je souhaitais avoir des objets Timers à la seconde dans Jeedom.
Après plusieurs versions avec des scripts, des variables, des retours d'état automatique,... je me suis rendu compte que je pouvais sans trop de difficulté créer ces timers au seins d'Abeille.

Maintenant vous pouvez même installar Abeille en n'utilisant que les Timers sans la partie ZigBee. Pour cela dans la configuration du plugin choisissez "Mode Timer seulement" à "Oui".

## Fonctionnement

![i1](../images/Capture_d_ecran_2018_03_21_a_13_16_53.png)

Le timer possede 4 phases:

T0->T1: RampUp de 0 a 100% => RampUp

T1->T2: Stable a 100% => durationSeconde

T2->T3: Ramp Down de 100% à 0% => RampDown

T3-> : n existe plus

Dans les phase de ramp la commande actionRamp/scenarioRamp est executée regulierement avec pour parametre la valeur en cours de RampUpDown.

Exemple d'application: allumage progressif d une ampoule, maintient allumé pendant x secondes puis extinction progressive.

## A prendre en compte


> Il est important de noter que chaque phase fait au minimum 1s.

> La rafraischissement du widget se fait toutes les 5s mais la mise a jour des valeurs se fait toutes les secondes.

### Trois commandes "Start", "Cancel" et "Stop".

* Start: permet d'executer une commande et de démarrer le Timer.
* Cancel: permet d'executer une commande et d'annuler le Timer.
* Stop: permet d'executer une commande, d'annuler le Timer et cette commande qui est executée lors de l'expiration du Timer.

### Retour d'information

* Time-Time: Date de la derniere action sur le Timer
* Time-TimeStamp: Heure systeme de la derniere action
* Duration: Temps restant avant expiration du Timer en secondes
* ExpiryTime: Heure d'expiration du Timer
* RampUpDown: Pourcentage entre 0 et 100 (Ramp Up 0->100, Ramp Down 100->0)

Elles ne sont pas forcement toutes visibles, a vous de choisir.

## Creation d un Timers

Pour créer un objet Timer, clic sur le bouton "Timer" dans la configuration du plugin.

Un message doit apparaitre pour annoncer la creation du Timer avec un Id Abeille-NombreAléatoire.

![i2](../images/Capture_d_ecran_2018_03_21_a_13_14_36.png)

Apres avoir rafraichi l'écran vous devriez avoir l objet:

![i3](../images/Capture_d_ecran_2018_03_21_a_13_16_53.png)

## Configuration du Timer

Comme pour tous les objets, dans l onglet Equipement, vous pouvez changer son nom, le rattacher à un objet Parent, etc...

### Ancienne méthode

Dans l'onglet Commandes, nous allons paramétrer les actions du Timer.

![i4](../images/Capture_d_ecran_2018_03_21_a_13_33_37.png)

#### Start 

actionStart=\#put_the_cmd_here#&durationSeconde=300

Pour la commande il y a deux parametres.

* durationSeconde: par exemple ici 300s soit 5min.

* actionStart doit être de la forme \#[Objet Parent][Objet][Cmd]# par exemple: \#[Ruche][Abeille-89ff-AmpouleBureau][On]#.

#### Cancel

actionCancel=\#put_the_cmd_here#

* actionCancel doit être de la forme \#[Objet Parent][Objet][Cmd]# par exemple: \#[Ruche][Abeille-89ff-AmpouleBureau][Off]#.

#### Stop

actionStop=\#put_the_cmd_here#

* actionStop doit être de la forme \#[Objet Parent][Objet][Cmd]# par exemple: \#[Ruche][Abeille-89ff-AmpouleBureau][Off]#.

Exemple plus spécifique: Envoie d'un SMS

actionStop=\#[operation][SMS_Home][Telephone]#&message=Mettre votre message sms ici

### Nouvelle méthode

Allez dans la page configuration, tab Param du Timer et remplissez les champs.

## Commande ou Scenario

Par defaut l'objet Timer est créé avec des commande Start, Stop, Cancel qui font reférence à l'execution d'une commande: actionStart=\#put_the_cmd_here#, actionCancel=\#put_the_cmd_here#, actionStop=\#put_the_cmd_here#. 

Mais vous avez la possibilité d'appeler un scenario à la place d'une commande.

Cela vous permet beaucoup plus de flexibilité comme le lancement d'une série de commandes.

La syntaxe: scenarioStart=Id,scenarioCancel=Id, scenarioStop=Id, en remplacant Id pour l'identifiant du scenario que vous trouvez dqns la definition du scenario.

![i5](../images/Capture_d_ecran_2018_03_27_a_12_52_53.png)

Un exemple avec les commandes et les scenarii.

![i6](../images/Capture_d_ecran_2018_03_27_a_12_55_27.png)

Et ici vous pouvez voir l'ID 3 du scenario utilisé.

Commande Start Complete

actionStart=\#put_the_cmd_here#&durationSeconde=300&RampUp=10&RampDown=10&actionRamp=\#put_the_cmd_here#





# Polling

## Ping toutes les 15 minutes

Par defaut le cron, toutes les 15 minutes, fait un ping des equipements qui n'ont pas de batterie definie. On suppose qu'ils sont sur secteur et que donc ils écoutent et qu'ils repondent à la réquete.

## Etat toutes les minutes

Récupère les infos que ne remonte pas par défaut toutes les minutes si défini dans l 'equipement.




# Systèmes / Plateforme testés

Jeedom fonctionne sur le systeme linux debian, de ce fait ce plugin est développé dans ce cadre. 

Le focus est fait sur les configurations suivantes:

- raspberry pi 3 (KiwiHC16 en prod)
- Machine virtuelle sous debian 9 en x86 (KiwiHC16 en dev)
- docker debian en x86 (edgd1er en dev)
- raspberry Pi2 (edgd1er en prod) 

Les autres envirronements

Les autres environnements ne sont pas testés par défaut mais nous vous aiderons dans la mesure du possible.

En retour d'experience sur le forum:

- Windows ne fonctionne pas, car pas Linux (fichier fifo)
- Ubuntu fonctionne mais demande de mettre les mains dans le cambouis, l'installation même de Jeedom n'est pas immédiate (https://github.com/KiwiHC16/Abeille/blob/master/Documentation/024_Installation_VM_Ubuntu.adoc @KiwiHC16)
- Odroid/HardKernel devrait fonctionner
-- U3 sous debian: install classique (@KiwiHC16)
-- XU4 sous ubuntu: https://github.com/KiwiHC16/Abeille/blob/master/Documentation/026_Installation_Odroid_XU4_Ubuntu.adoc (@KiwiHC16)

Equipements

La liste des équipements testés est consolidé dans le fichier excel: https://github.com/KiwiHC16/Abeille/blob/master/resources/AbeilleDeamon/documentsDeDev/AbeilleEquipmentFunctionSupported.xlsx?raw=true
(Le contenu du fichier est souvent en retard par rapport à la réalité)

# Developpement

Grandes lignes

* branche master : pour tous les développements en cours a condition que les pushs soient utilisables et "stabilisés" pour la phase de test.
* branche beta: pour figer un développement et le mettre en test avant de passer en stable
* branche stable: version stable
* Dev en cours: autre branche

# WIFI

== Adafruit

Comme je voulais avoir l'option Zigate Wifi dans Abeille et un petit soucis avec le module proposé par Akila, j'ai fait quelques investigations. 

Pour ceux qui connaissent Adafruit, il y a un module que j'avais en stock: https://www.adafruit.com/product/3046

![](../images/Capture_d_ecran_2018_06_20_a_23_54_30.png)

Ce montage possede un ESP8266, un étage de "puissance" avec batterie, un CP2104 USB-Serial, ... et est programmable facilement avec l'IDE Arduino.

J'ai aussi ma zigate version bidouille:

![](../images/IMG_6207.jpg)

Restait à les connecter.

Voici un petit schéma du cablage:

![](../images/Capture_d_ecran_2018_06_21_a_00_02_11.png)

Restait que le SW à faire et à téléchargé dans l'ESP8266. Le soft: https://github.com/KiwiHC16/Abeille/blob/master/WIfi_Module/WIfi_Module.ino

Pour télécharger, compiler avec l'IDE Arduino et télécharger avec le cable USB. Il est necessaire ne déconnecter le TX/RX de la Zigate.

Maintenant j'ai une Zigate autonome sur batterie en Wifi !!!

![](../images/IMG_6208.jpg)

Batterie est égale à:

* Je peux mettre la zigate ou je veux
* si le cable USB est branché sur un charger, je suis autonome en cas de coupure de courant

Vous trouverez le source et le bin à la page: https://github.com/KiwiHC16/Abeille/tree/master/WIfi_Module

# Enjoy
