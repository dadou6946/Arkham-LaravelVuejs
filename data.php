<?php
sites adjacents
[
    1 => [27],
    2 => [27],
    3 => [27],
    4 => [28],
    5 => [28],
    6 => [28],
    7 => [29],
    8 => [29],
    9 => [29],
    10 => [30],
    11 => [30],
    12 => [30],
    13 => [31],
    14 => [31],
    15 => [31],
    16 => [32],
    17 => [32],
    18 => [32],
    19 => [33],
    20 => [33],
    21 => [34],
    22 => [34],
    23 => [34],
    24 => [35],
    25 => [35],
    26 => [35], //fin des lieux
    27 => [1,2,3,28,30],
    28 => [4,5,6,27,29],
    29 => [7,8,9,28,31],
    30 => [10,11,12,27,28,31,32],
    31 => [13,14,15,29,30,33],
    32 => [16,17,18,30,33,34],
    33 => [19,20,31,32,35],
    34 => [21,22,23,32,35],
    35 => [24,25,26,33,34]
]

Joueurs
    1
        nom : "sylvain"
        investigateurId: 1
    2
        nom : "david"
        investigateurId: 2
    3
        nom : "lena"
        investigateurId: 3


Investigateurs = []
    Investigateurs[1] = {
        id: 1,
        Nom : 'Peggy green',
        profession: "la dilettante",
        image: "JennyBarnes.jpg",
        vitesse: 1,
        discretion: 3,
        vigueur: 4,
        volonte: 2,
        savoir: 1,
        chance: 3,
        concentration: 1,
        vitesses: [0,1,2,3]
        discretions: [4,3,2,1],
        vigueurs: [1,2,3,4]
        volontes: [5,4,3,2]
        savoirs: [1,2,3,4]
        chances: [5,4,3,2]
        lieudepart: 1 (id),
        argentDepart: 10,
        indiceDepart: 0,
        portailDepart: 0,
        lieu: 4 (id),// ???
        argent: 10,
        indice: 0,
        possessionsfixesTexte: "10$"
        possessionsfixes: ["id d'objets"]
        possessionsaleatoiresTexte: "2 objets communs, 1 objet unique, 1 sort, 1 capacit�"
        possessionsaleatoires: ["id d'objets"]
        capacit�:
            nom: ["Lev�e de fonds"]
            texte: ["Entretien : Jenny gagne 1$."]

            type: "passif"
            detail:
                quand: "entretien"
                gainValeur : 1
                gainType: "argent"

            type: "action"
            detail:
                quand: "mouvement"
                activation: "decharger" // destroy
                quand: "mouvement"
                condition: { type: "test", }
                gainValeur : 2
                gainType: "mouvement"

        Objets : ["id d'object"]
        portail: ['id de portails']
        statut:
            maudit: 0
            b�ni: 0
            loge: 0
            sherrif:0
            arrete:0
            retarde:0
            perdu:0
            devore:0
        faiblessespsy: []
        faiblessesphy: []
    }



Cartes


    listes des Alli�s disponibles = [1,2,3,...] (11 � m�langer, fonction shuffle())
    allies en jeu :
        [ //R�cup en bdd quand on en a besoin
            {
                id: 1,
                propri�taire: 2, (id de l investigateur)
                nom: 'Duke',
                modificateur: [
                    {competence:"vigueur", valeur: '+1'},
                    {competence:"discression", valeur: '+1'}
                ],
                capacit�: "Vous ne perdez pas r�sistance � cause de la capacit� in�puisable" (Comment impliquer ?)
            }
        ]


    liste des objets courants disponibles: [1,2,...],
    objets courant en jeu: [
        {
            id: 2
            nom : "hache"
            propri�taire: 1
            paquet : "commun"
            status: true
            cost: 5
            image: "hache.jpg"
            type: arme (utilisable, arme, sort, tome, consommable)
            hand : 1
            texte : "Arme physique<br>+4 aux tests de Combat"
            modificateur :
                degat: "magique"
                aptitudeModificateur: "combat"
                valeurModificateur: +1
                valeurAlternativeModificateur: +4
                conditionAlternativeModificateur: "1 main libre"
            action:
                activation: "decharger" // destroy
                quand: "mouvement"
                gainValeur : 2
                gainType: "mouvement"
            passif:
                valeurPassif: +1
                aptitudePassif: "test d'horreur"
        }
    ]
    liste des objets rares: [1,2,...],
    liste des sorts: [1,2,...],
    liste des comp�tences: [1,2,...],

Lieux
    Lieux[1] = {
        id: 1,
        nom: "Square de l'ind�pedance",
        nomAffich�: "Square<br>de<br>l\'ind�pendance",
        type: site (ou rue, autre monde, p�riph�rie, ciel),
        investigateurs: [1,4, ..] (liste d'ids d'invest.),
        monstres: [1,4, ..] (liste d ids de monstres),
        �v�nements: [1,2,...] (liste d ids d evenements),
        indices: 2,
        couleur: 'blanc',
        portail: [1,2,...] (liste d ids de portails),
        marqueurs: ['Ferm�'] (noms des marqueurs pr�sents, ou id ?),
        blanc: 3 (id du lieu apr�s d�placement blanc),
        noir: 1 (idem pour noir)
    }


Portails
    Portails[1] =
    {
        id : 1,
        lieu: 4 (id de lieu)
        zone : 'Yuggoth',
        symboles: 'cercle',
        difficult�: -1,
        statut: actif/troph�e,
    }

Monstres
    {
        id: 2
        nom: "chthonien"
        lieu: 3
        symbole: "cercle"
        caract�ristiques:...
        status : actif/troph�e
    }

Ancien
    name : "yig"
    caract�ristiques: ...

Gardien
    idem

Heraut
    idem

Effets continus
    Environnement
    Rumeur
    Personnages
    objets
    Ancient

Settings

    Nombre de joueurs : 2
    Premier joueur : 1, 2, ...
    Joueur actif : 2

    Num�ro de tour : 1
    Etape du tour : Entretien
    Phase de mythe : portail
    Carte mythe en cours : 2 (id) (utile ?)
    Cartes mythes pass�es : [2,3,4,7, ...]

    Niveau de terreur : 1
    Lieux ferm�s : magasin

    Echelle ancien : 2
    Echelle ancien maximum : 12

    monstres disponibles: [1,2,3,4,...]
    Nombre de monstres en jeu (arkham et ciel) : 3
    Monstres en jeu: [1,2,3,...], (utiliser la fonction range())
    Nombre de monstre dans la p�riph�rie : 3
    Monstres dans la p�riph�rie: [1,2,3,...],
    Nombre de monstre maximum : 4

    Nombre de portail actifs : 3
    Nombre de portail collect�s : 1
    Nombre de portail maximum : 6

