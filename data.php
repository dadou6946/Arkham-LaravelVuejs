<?php

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
        volonté: 2,
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
        possessionsaleatoiresTexte: "2 objets communs, 1 objet unique, 1 sort, 1 capacité"
        possessionsaleatoires: ["id d'objets"]
        capacité:
            nom: ["Levée de fonds"]
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
            béni: 0
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


    listes des Alliés disponibles = [1,2,3,...] (11 à mélanger, fonction shuffle())
    allies en jeu :
        [ //Récup en bdd quand on en a besoin
            {
                id: 1,
                propriétaire: 2, (id de l investigateur)
                nom: 'Duke',
                modificateur: [
                    {competence:"vigueur", valeur: '+1'},
                    {competence:"discression", valeur: '+1'}
                ],
                capacité: "Vous ne perdez pas résistance à cause de la capacité inépuisable" (Comment impliquer ?)
            }
        ]


    liste des objets courants disponibles: [1,2,...],
    objets courant en jeu: [
        {
            id: 2
            nom : "hache"
            propriétaire: 1
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
    liste des compétences: [1,2,...],

Lieux
    Lieux[1] = {
        id: 1,
        nom: "Square de l'indépedance",
        nomAffiché: "Square<br>de<br>l\'indépendance",
        type: site (ou rue, autre monde, périphérie, ciel),
        investigateurs: [1,4, ..] (liste d'ids d'invest.),
        monstres: [1,4, ..] (liste d ids de monstres),
        évènements: [1,2,...] (liste d ids d evenements),
        indices: 2,
        couleur: 'blanc',
        portail: [1,2,...] (liste d ids de portails),
        marqueurs: ['Fermé'] (noms des marqueurs présents, ou id ?),
        blanc: 3 (id du lieu après déplacement blanc),
        noir: 1 (idem pour noir)
    }


Portails
    Portails[1] =
    {
        id : 1,
        lieu: 4 (id de lieu)
        zone : 'Yuggoth',
        symboles: 'cercle',
        difficulté: -1,
        statut: actif/trophée,
    }

Monstres
    {
        id: 2
        nom: "chthonien"
        lieu: 3
        symbole: "cercle"
        caractéristiques:...
        status : actif/trophée
    }

Ancien
    name : "yig"
    caractéristiques: ...

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

    Numéro de tour : 1
    Etape du tour : Entretien
    Phase de mythe : portail
    Carte mythe en cours : 2 (id) (utile ?)
    Cartes mythes passées : [2,3,4,7, ...]

    Niveau de terreur : 1
    Lieux fermés : magasin

    Echelle ancien : 2
    Echelle ancien maximum : 12

    monstres disponibles: [1,2,3,4,...]
    Nombre de monstres en jeu (arkham et ciel) : 3
    Monstres en jeu: [1,2,3,...], (utiliser la fonction range())
    Nombre de monstre dans la périphérie : 3
    Monstres dans la périphérie: [1,2,3,...],
    Nombre de monstre maximum : 4

    Nombre de portail actifs : 3
    Nombre de portail collectés : 1
    Nombre de portail maximum : 6

