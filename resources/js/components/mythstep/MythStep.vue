<template>
    <div>
        <transition name="fade">
            <nav id="sidebar-investigator" class="teal lighten-3 sidenav sidenav-fixed center-align"
                style="transform: translateX(0px);z-index:980;"
                v-if="navbar.investigator">

                    <div class="waves-effect waves-light valign-wrapper"
                        v-for="(investigator, index) of investigators"
                        style="margin:7px;border-radius:5px;margin-top:-15px;padding-top:-15px;font-size:15px;"
                        @click="showInvestigator(investigator.name)">
                        <span v-html="investigator.name"></span>
                    </div>

                    <div v-if="investigatorPreview!=''">
                        <div class="card teal lighten-4"
                            v-html="investigatorPreview"></div>

                    </div>

            </nav>
        </transition>

        <transition name="fade">
            <nav id="sidebar-ancient" class="sidenav blue lighten-3"
                style="transform: translateX(0px);z-index:990;height:100%;width:280px;position:absolute;right:0;"
                v-if="navbar.guardian">
            </nav>
        </transition>

        <transition name="fade">
            <nav id="sidebar-ancient" class="cyan lighten-3"
                 style="z-index:1000;width:100%;height:300px;position:absolute;bottom:0;"
                 v-if="navbar.game">
                <div>
                    <span>Tour n° 2</span><br>
                    <span>Phase : mouvement</span><br>
                    <span>Premier joueur : joueur 1 - Francis Sailor</span>
                </div>
            </nav>
        </transition>

        <transition name="fade">
            <nav id="sidebar-ancient" class="red lighten-3"
                 style="z-index:980;height:100%;width:300px;position:absolute;right:0;"
                 v-if="navbar.ancient">
            </nav>
        </transition>

        <transition name="fade">
            <nav id="sidebar-ancient" class="orange lighten-3"
                 style="z-index:990;height:100%;width:280px;position:absolute;right:0;"
                 v-if="navbar.herald">
            </nav>
        </transition>

        <body>

            <!-- BOUTONS -->
            <div id="button-container" class="center-align teal darken-3 card">

                <button class="waves-effect waves-light btn teal"
                    v-html="navbar.investigator==false?'joueurs +':'joueurs -'"
                    @click="switchNavbar('investigator')"></button>

                </button><button class="waves-effect waves-light btn  blue lighten-1"
                    v-html="navbar.guardian==false?'Gardien +':'Gardien -'"
                    @click="switchNavbar('guardian')"></button>

                <button class="waves-effect waves-light btn cyan lighten-2"
                    v-html="navbar.game==false?'Informations sur la partie +':'Informations sur la partie -'"
                    @click="switchNavbar('game')"></button>

                <button class="waves-effect waves-light btn red"
                    v-html="navbar.ancient==false?'Ancien +':'Ancien -'"
                    @click="switchNavbar('ancient')"></button>

                <button class="waves-effect waves-light btn orange lighten-1"
                    v-html="navbar.herald==false?'Héraut +':'Héraut -'"
                    @click="switchNavbar('herald')"></button>
            </div>

            <!-- MAP -->
            <div id="map-container" class="">

                <div id="ark-map" class="indigo lighten-5 right">

                    <!-- Lieux -->
                    <div class="card hoverable"
                        v-for="site of sites"
                        v-bind:class="[site.color, site.type]"
                        v-bind:id="'site'+site.id"
                        >

                        <span v-html="site.name"></span>

                        <!-- Jetons indices -->
                        <div v-if="site.clue!=0"
                            id="clue_token"
                            class=""
                            v-html="site.clue>1?'x'+site.clue:''">
                        </div>

                        <!-- Investigateurs -->
                        <transition-group name="fade">
                            <div class="investigator"
                                v-for="(char,index) of site.character"
                                v-bind:class="'investigator_'+(index+1)"
                                v-bind:id="char"
                                v-html="char"
                                v-bind:key="index">
                            </div>
                        </transition-group>

                        <!-- Monstres -->
                        <transition-group name="fade">
                            <div  class="monster truncate"
                                v-for="(mons,index) of site.monster"
                                v-bind:class="'monster_'+(index+1)"
                                v-bind:id="mons"
                                v-html="mons"
                                v-bind:key="index">
                            </div>
                        </transition-group>

                        <!-- Portails -->
                        <transition name="fade">
                            <div class="portal_token valign-wrapper"
                                v-for="mark of site.portal">
                                <span v-html="mark"></span>
                            </div>
                        </transition>

                        <!-- Marqueurs -->
                        <transition-group name="fade">
                            <div class="token center-align"
                                v-for="port of site.marker"
                                v-bind:class="port+'_token'"
                                v-bind:key="port">
                                <span v-html="port"></span>
                            </div>
                        </transition-group>

                        <!-- Evenements -->
                        <transition-group name="fade">
                            <div class="token center-align"
                                v-for="ev of site.event"
                                v-bind:class="'event_token'"
                                v-bind:key="ev">
                                <span v-html="ev"></span>
                            </div>
                        </transition-group>

                    </div>




                    <!-- Lieux spéciaux -->
                    <div class="special_site card hoverable"
                        v-for="special of specials"
                        v-bind:class="'special'+special.id">

                        <span v-html="special.name"></span>

                        <!-- Investigateurs -->
                        <transition-group name="fade">
                            <div class="investigator"
                                v-for="(char,index) of special.character"
                                v-bind:class="'investigator_'+(index+1)"
                                v-bind:id="char"
                                v-html="char"
                                v-bind:key="index">
                            </div>
                        </transition-group>

                        <!-- Monstres -->
                        <transition-group name="fade">
                            <div  class="monster truncate"
                                v-for="(mons,index) of special.monster"
                                v-bind:class="'monster_'+(index+1)"
                                v-bind:id="mons"
                                v-html="mons"
                                v-bind:key="index">
                            </div>
                        </transition-group>

                    </div>

                    <!-- liaisons entre les rues -->
                    <div
                        v-for="road of roads"
                        v-bind:id="'road'+road.id"
                        v-bind:class="road.way">
                    </div>

                    <!-- fleches de monstre -->
                    <span
                        v-for="arrow of arrows"
                        v-bind:id="'arrow'+arrow.id"
                        v-bind:class="arrow.color+'-arrow'"
                        v-html="arrow.color=='double'?'&#10146;':'&#10148;'">
                    </span>
                </div>

                <!-- L'au delà -->
                <div id="beyond-map" class="indigo lighten-4 right">

                    <!-- Lieux -->
                    <div class="world card center-align hoverable"
                        v-for="world of beyond">

                        <div v-for="step of world.steps"
                            v-bind:class="step.position==1?'first':'second'">

                            <!-- Investigateurs -->
                            <transition-group name="fade">
                                <div class="beyond_investigator"
                                    v-for="(char, index) of step.character"
                                    v-bind:id="char"
                                    v-bind:class="step.position==1? 'inv_first':'inv_second'"
                                    v-html="char"
                                    v-bind:key="index">
                                </div>
                            </transition-group>
                        </div>

                        <span class="other_world" v-html="world.name" ></span>

                    </div>
                </div>
            </div>

            <div id="modal1" class="modal" tabindex="0" style="z-index: 999; display: block; opacity: 1; top: 5%;width: 20%; margin-left: 25px;">
                <div class="modal-content" style="height:100%">
                    <div class="row">
                        <div class="col s12">
                            <h4>Phase de mythe</h4><br><br>
                            <!-- Image de la carte à trouver -->
                            <transition name="fade">
                                <img class="responsive-img"
                                    src="/image/card/myth/Astres_Propices.jpg"
                                    alt="Astres_Propices"
                                    v-if="!hide.mythImage"
                                    v-bind:style="{ width: '100%' }"/>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modal2" class="modal open modal-fixed-footer" tabindex="0" style="z-index: 999; display: block; opacity: 1; top: 5%;width: 20%; margin-right: 25px;height:100%;">
                <div class="modal-content" style="height:100%">
                    <div class="row">
                        <div class="col s12">
                            <div>On pioche une carte mythe</div><br><br>
                            <ul class="collection" v-if="mythStep>0">
                            <li class="collection-item" v-if="mythStep>=1">
                                <span v-if="mythResume.portal.action=='add'">Un portail vers <span v-html="mythResume.portal.portalName"></span> apparaît à/au <span v-html="mythResume.portal.siteName"></span>.</span>
                                <span v-if="mythResume.portal.action=='already'">Un portail devrait apparaître à/au <span v-html="mythResume.portal.siteName"></span> mais il y en a déjà un!</span>
                                <span v-if="mythResume.portal.action=='none'">Un portail devrait apparaître à/au <span v-html="mythResume.portal.siteName"></span> mais il y a un Signe des Anciens. Aucun portail n'apparaît.</span>
                            </li>
                            <li class="collection-item" v-if="mythStep>=2">
                                <span v-if="mythResume.monster.action=='add'">Un monstre apparaît au même lieu.<br>C'est un zombie.</span>
                                <span v-if="mythResume.monster.action=='wave'">Une vague de montres se produit.</span>
                                <span v-if="mythResume.monster.action=='none'">Aucun monstre n'apparaît.</span>
                            </li>
                            <li class="collection-item" v-if="mythStep>=3">
                                <span v-if="mythResume.clue.action=='add'">Un indice apparaît à la boutique de souvenir.</span>
                                <span v-if="mythResume.clue.action=='none'">Un indice devrait apparaître à la boutique de souvenir mais un portail y est ouvert. Il n'est pas ajouté.</span>
                            </li>
                            <li class="collection-item" v-if="mythStep>=4">
                                Les monstres se déplacent :
                                <ul>
                                <li>Slash, triangle, étoile => fleche blanche</li>
                                <li>hexagone => flèche noir</li>
                                </ul>
                            </li>
                            <li class="collection-item" v-if="mythStep>=5">
                                C'est une rumeur ! {{mythResume.event.name}}.<br>
                                Lieu d'activité: Rues du Centre-ville
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button v-bind:disabled="mythStep==5" @click="next" class="modal-close waves-effect waves-green btn-flat green accent-1">Ok</button>
                    <button v-bind:disabled="mythStep<5" @click="continueAction" class="modal-close waves-effect waves-green btn-flat green accent-1">Etape suivante</button>
                </div>
            </div>
        </body>
    </div>
</template>

<script>
    export default {
        data: function(){
            return {

                pageTitle: 'map', // nom de la page
                navbar: // permettent l'apparition des panneaux d'interface
                    {
                        investigator: false,
                        ancient: false,
                        game: false,
                        guardian: false,
                        herald: false,
                    },
                hide: // permet de cacher certains éléments
                    { mythImage: true },
                mythStep: 0, // phase en cours (1->apparition de portail, 2->monstre, 3->indice, 4->mouvement des monstres, 5->évènement)
                mythResume: // résumé de la carte mythe récupérée
                    {
                        // Types d'actions : add (ajout d'un portail), already (pas d'ajout: portail déja présent), none (pas d'ajout:signe anciens), terror (augmentation du niveau de terreur), destiny (augmentation de l'échelle de l'ancien)
                        // Penser que l'on peut avoir un portail qui s'ouvre même si le lieu est scellé : irruption de portail qui détruit le signe des anciens (dunwich)!
                        portal:{ action:"add", portalName: "Yuggoth", portalId: 5, siteName: "Square de l'indépendance", siteId:6 },
                        // Types d'actions : add (ajout d'un monstre), wave (vague de monstres), none (pas d'ajout:signe anciens)
                        monster:{ action:"add", monsterName: "Zombie", monsterId: 2, siteName: "Square de l'indépendance", siteId:6  },
                        // Types d'actions : add (ajout d'un indice), none (pas d'ajout:portail)
                        clue:{ action:"add", siteName: "Boutique de souvenirs", siteId:1 },
                        // Types d'action : simple (certains signes bougent), global(tous les signes bougent)
                        move:{ action:"simple", white: ["slash", "triangle", "star"], black:["hexagon"] },
                        // Types d'action : rumor, environment, headline (gros titre)
                        event:{ action:"rumor", eventId:1, name: "Les astres sont propices", siteId: 28}
                    },
                playerNumber: 2, // nombre de joueurs
                investigatorPreview: "",
                investigators: [
                    { name: "Joe Diamond"},
                    { name: "Francis Sailor"},
                    { name: "Jenny Barnes"},
                    { name: "Daisie Walker"},
                    { name: "Peggy Green"},
                ],
                monsters: [
                    { id:1, name:"Chthonien", siteId:11, symbol:"triangle", habilities: {}},
                    { id:2, name:"Migo",      siteId:1,  symbol:"cercle",   habilities: {}},
                    { id:3, name:"Cultiste",  siteId:3,  symbol:"lune",     habilities: {}}
                ],
                sites: [
                    { name: "Boutique<br>de<br>souvenir1"        , id: "1" , type: "site",   character: [],               monster: [], event: [], clue: 1, color: "orange", portal: [], marker: [], white:27, black:27},
                    { name: "Journal2"                           , id: "2" , type: "site",   character: [],               monster: [], event: [], clue: 0, color: "orange", portal: [], marker: [], white:27, black:27},
                    { name: "Gare3"                              , id: "3" , type: "site",   character: ["Jenny Barnes"], monster: [], event: [], clue: 0, color: "orange", portal: [], marker: [], white:27, black:27},
                    { name: "Banque<br>d'Arkham4"                , id: "4" , type: "site",   character: [],               monster: [], event: [], clue: 0, color: "white",  portal: [], marker: [], white:28, black:28},
                    { name: "Asile<br>d'Arkham5"                 , id: "5" , type: "site",   character: [],               monster: [], event: [], clue: 0, color: "white",  portal: [], marker: [], white:28, black:28},
                    { name: "Square de<br>l'indépen-<br>-dance6" , id: "6" , type: "site",   character: [],               monster: [], event: [], clue: 1, color: "white",  portal: [], marker: [], white:28, black:28},
                    { name: "Relais<br>routier<br>de Hibb7"      , id: "7" , type: "site",   character: [],               monster: [], event: [], clue: 1, color: "grey",   portal: [], marker: [], white:29, black:29},
                    { name: "Restaurant<br>de Velma8"            , id: "8" , type: "site",   character: [],               monster: [], event: [], clue: 1, color: "grey",   portal: [], marker: [], white:29, black:29},
                    { name: "Poste<br>de<br>-police9"            , id: "9" , type: "site",   character: ["Joe Diamond"],  monster: [], event: [], clue: 1, color: "grey",   portal: [], marker: [], white:29, black:29},
                    { name: "L'ile<br>inexplorée10"             , id: "10", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "green",  portal: [], marker: [], white:30, black:30},
                    { name: "Les<br>quais11"                     , id: "11", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "green",  portal: [], marker: [], white:30, black:30},
                    { name: "l'Inno-<br>-mable12"                , id: "12", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "green",  portal: [], marker: [], white:30, black:30},
                    { name: "Le<br>cimetière13"                  , id: "13", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "purple", portal: [], marker: [], white:31, black:31},
                    { name: "La Caverne<br>noire14"              , id: "14", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "purple", portal: [], marker: [], white:31, black:31},
                    { name: "Le<br>magasin15"                    , id: "15", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "purple", portal: [], marker: [], white:31, black:31},
                    { name: "Département<br>Scientifique16"      , id: "16", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "yellow", portal: [], marker: [], white:32, black:32},
                    { name: "Adminis-<br>-tration17"             , id: "17", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "yellow", portal: [], marker: [], white:32, black:32},
                    { name: "Biblio-<br>-thèque18"               , id: "18", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "yellow", portal: [], marker: [], white:32, black:32},
                    { name: "Maison<br>de la<br>sorcière19"      , id: "19", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "blue",   portal: [], marker: [], white:33, black:33},
                    { name: "Loge du<br>crépuscule<br>d'argent20", id: "20", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "blue",   portal: [], marker: [], white:33, black:33},
                    { name: "Hôpital<br>Sainte<br>Marie21"       , id: "21", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "red",    portal: [], marker: [], white:34, black:34},
                    { name: "Vieille<br>échoppe<br>de magie22"   , id: "22", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "red",    portal: [], marker: [], white:34, black:34},
                    { name: "Les<br>bois23"                      , id: "23", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "red",    portal: [], marker: [], white:34, black:34},
                    { name: "Pension<br>de Ma24"                 , id: "24", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "brown",  portal: [], marker: [], white:35, black:35},
                    { name: "Société<br>des<br>historiens25"     , id: "25", type: "site",   character: [],               monster: [], event: [], clue: 1, color: "brown",  portal: [], marker: [], white:35, black:35},
                    { name: "Eglise<br>méridionale26"            , id: "26", type: "site",   character: [],               monster: [], event: [], clue: 0, color: "brown",  portal: [], marker: [], white:35, black:35},
    /*'Migo'*/      { name: "Quartier<br>Nord27"                 , id: "27", type: "street", character: [],               monster: [], event: [], clue: 0, color: "orange", portal: [], marker: [], white:28, black:30},
    /*'Cultiste'*/  { name: "Centre<br>Ville28"                  , id: "28", type: "street", character: [],               monster: [], event: [], clue: 0, color: "white", portal: [], marker: [], white:29, black:27},
                    { name: "Quartier<br>Est29"                  , id: "29", type: "street", character: [],               monster: [], event: [], clue: 0, color: "grey", portal: [], marker: [], white:31, black:28},
                    { name: "Quartier<br>marchand30"             , id: "30", type: "street", character: [],               monster: [], event: [], clue: 0, color: "green", portal: [], marker: [], white:27, black:32},
                    { name: "Quartier<br>de la<br>rivière31"     , id: "31", type: "street", character: [],               monster: [], event: [], clue: 0, color: "purple", portal: [], marker: [], white:33, black:29},
                    { name: "Université<br>Miskatonik32"         , id: "32", type: "street", character: [],               monster: [], event: [], clue: 0, color: "yellow", portal: [], marker: [], white:30, black:34},
                    { name: "French<br>Hill33"                   , id: "33", type: "street", character: [],               monster: [], event: [], clue: 0, color: "blue", portal: [], marker: [], white:35, black:31},
                    { name: "Quartier<br>Résidentiel34"          , id: "34", type: "street", character: [],               monster: [], event: [], clue: 0, color: "red", portal: [], marker: [], white:32, black:35},
                    { name: "Quartier<br>sud35"                  , id: "35", type: "street", character: [],               monster: [], event: [], clue: 0, color: "brown", portal: [], marker: [], white:34, black:33},

                ],
                // Voir a intégrer les rues dans sites et à ajouter un type de lieu street/site
                streets: [
                ],

                // streets: [
                //     { name: "Quartier<br>Nord1",             id: "1", type: "street", character: [], monster: ['Migo'], event: [], clue: 0, color: "orange", portal: [], marker: []},
                //     { name: "Centre<br>Ville2",              id: "2", type: "street", character: [], monster: ['Cultiste'],         event: [], clue: 0, color: "white", portal: [], marker: []},
                //     { name: "Quartier<br>Est3",              id: "3", type: "street", character: [], monster: [],         event: [], clue: 0, color: "grey", portal: [], marker: []},
                //     { name: "Quartier<br>marchand4",         id: "4", type: "street", character: [], monster: [],         event: [], clue: 0, color: "green", portal: [], marker: []},
                //     { name: "Quartier<br>de la<br>rivière5", id: "5", type: "street", character: [], monster: [],         event: [], clue: 0, color: "purple", portal: [], marker: []},
                //     { name: "Université<br>Miskatonik6",     id: "6", type: "street", character: [], monster: [],         event: [], clue: 0, color: "yellow", portal: [], marker: []},
                //     { name: "French<br>Hill7",               id: "7", type: "street", character: [], monster: [],         event: [], clue: 0, color: "blue", portal: [], marker: []},
                //     { name: "Quartier<br>Résidentiel8",      id: "8", type: "street", character: [], monster: [],         event: [], clue: 0, color: "red", portal: [], marker: []},
                //     { name: "Quartier<br>sud9",              id: "9", type: "street", character: [], monster: [],         event: [], clue: 0, color: "brown", portal: [], marker: []},
                // ],
                beyond : [
                    { name: 'Une autre<br>dimension',   colors: [], steps: [
                                                                                { id: 1, position: 1, character: [], monster: []},
                                                                                { id: 2, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'Les Abysses',              colors: [], steps: [
                                                                                { id: 3, position: 1, character: [], monster: []},
                                                                                { id: 4, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'Cité de la<br>Grand Race', colors: [], steps: [
                                                                                { id: 5, position: 1, character: [], monster: []},
                                                                                { id: 6, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'Yuggoth',                  colors: [], steps: [
                                                                                { id: 7, position: 1, character: [], monster: []},
                                                                                { id: 8, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'Grand Hall<br>de Celeano', colors: [], steps: [
                                                                                { id: 9, position: 1, character: [], monster: []},
                                                                                { id: 10, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'Les contrées<br>du rêve',  colors: [], steps: [
                                                                                { id: 11, position: 1, character: [], monster: []},
                                                                                { id: 12, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'Plateau<br>de Leng',       colors: [], steps: [
                                                                                { id: 13, position: 1, character: [], monster: []},
                                                                                { id: 14, position: 2, character: [], monster: []}
                                                                            ]},
                    { name: 'R\'lyeh',                  colors: [], steps: [
                                                                                { id: 15, position: 1, character: [], monster: []},
                                                                                { id: 16, position: 2, character: [], monster: []}
                                                                            ]}
                ],
                specials: [
                    { name: 'Perdu dans<br>le temps<br>et l\'espace', id: 1, character: []},
                    { name: 'Ciel',                                   id: 2, monster: []},
                    { name: 'Périphérie',                             id: 3, monster: []}
                ],
                roads: [
                    { id: "1",  way: "bar-h"},
                    { id: "2",  way: "bar-h"},
                    { id: "3",  way: "bar-h"},
                    { id: "4",  way: "bar-h"},
                    { id: "5",  way: "bar-h"},
                    { id: "6",  way: "bar-v"},
                    { id: "7",  way: "bar-v"},
                    { id: "8",  way: "bar-v"},
                    { id: "9",  way: "bar-v"},
                    { id: "10", way: "bar-v"},
                    { id: "11", way: "bar-v"},
                    { id: "12", way: "bar-v"},
                    { id: "13", way: "bar-c"},
                    { id: "14", way: "bar-c"},
                    { id: "15", way: "bar-c"},
                    { id: "16", way: "bar-c"},
                    { id: "17", way: "bar-c"},
                    { id: "18", way: "bar-c"},
                    { id: "19", way: "bar-c"},
                    { id: "20", way: "bar-c"},
                    { id: "21", way: "bar-c"},
                    { id: "22", way: "bar-c"},
                    { id: "23", way: "bar-c"},
                    { id: "24", way: "bar-c"},
                    { id: "25", way: "bar-c"},
                    { id: "26", way: "bar-c"},
                    { id: "27", way: "bar-c"},
                    { id: "28", way: "bar-c"},
                    { id: "29", way: "bar-c"},
                    { id: "30", way: "bar-c"},
                    { id: "31", way: "bar-c"},
                    { id: "32", way: "bar-c"},
                    { id: "33", way: "bar-c"},

                    { id: "34", way: "bar-c"},
                    { id: "35", way: "bar-c"},
                    { id: "36", way: "bar-c"},
                    { id: "37", way: "bar-c"},
                    { id: "38", way: "bar-c"},
                ],
                arrows: [
                    { id: "1",  color:"white"},
                    { id: "2",  color:"white"},
                    { id: "3",  color:"white"},
                    { id: "4",  color:"white"},
                    { id: "5",  color:"white"},
                    { id: "6",  color:"white"},
                    { id: "7",  color:"white"},
                    { id: "8",  color:"white"},
                    { id: "9",  color:"white"},
                    { id: "10", color:"black"},
                    { id: "11", color:"black"},
                    { id: "12", color:"black"},
                    { id: "13", color:"black"},
                    { id: "14", color:"black"},
                    { id: "15", color:"black"},
                    { id: "16", color:"black"},
                    { id: "17", color:"black"},
                    { id: "18", color:"black"},
                    { id: "19", color:"double"},
                    { id: "20", color:"double"},
                    { id: "21", color:"double"},
                    { id: "22", color:"double"},
                    { id: "23", color:"double"},
                    { id: "24", color:"double"},
                    { id: "25", color:"double"},
                    { id: "26", color:"double"},
                    { id: "27", color:"double"},
                    { id: "28", color:"double"},
                    { id: "29", color:"double"},
                    { id: "30", color:"double"},
                    { id: "31", color:"double"},
                    { id: "32", color:"double"},
                    { id: "33", color:"double"},
                    { id: "34", color:"double"},
                    { id: "35", color:"double"},
                    { id: "36", color:"double"},
                    { id: "37", color:"double"},
                    { id: "38", color:"double"},
                    { id: "39", color:"double"},
                    { id: "40", color:"double"},
                    { id: "41", color:"double"},
                    { id: "42", color:"double"},
                    { id: "43", color:"double"},
                    { id: "44", color:"double"},
                ]

            }
        },
        methods: {

            next () {
                if(this.mythStep < 5) this.mythStep++

                switch(this.mythStep)
                {
                    case 1:
                        // nom de portail et id de site
                        var portalName = this.mythResume.portal.portalName;
                        var siteId = this.mythResume.portal.siteId;
                        // Pour chacun des sites
                        this.sites.forEach(function(site){
                            // Si le site est celui où le portail doit apparaître
                            if(site.id == siteId)
                            {
                                // On l'ajoute s'il n'y a pas déjà de portail
                                if(site.portal.length == 0) site.portal.push(portalName);
                                // Sinon rien, vague de monstres
                                else console.log('vague de monstre');
                            }
                        });
                    break;
                    case 2:
                        // Définition du nom de monstre et id de site
                        var siteId = this.mythResume.monster.siteId;
                        var monsterName = this.mythResume.monster.monsterName;
                        // Pour chaque site
                        this.sites.forEach(function(site){
                            // Si le site est celui où le monstre doit apparaître
                            if(site.id == siteId) site.monster.push(monsterName);
                        });
                    break;
                    case 3:
                        // Définition du nom de monstre et id de site d'apparition d'indice
                        var siteId = this.mythResume.clue.siteId;
                        // Pour chaque site
                        this.sites.forEach(function(site){
                            // Si c'est le site d'apparition d'indice, on en ajoute un
                            if(site.id == siteId) site.clue++;
                        });
                    break;
                    case 4:
                        // Pour chacun des monstres
                        this.monsters.forEach((monster) => {
                            // Si le symbole du monstre correspond au symbole de déplacements blanc
                            if(this.mythResume.move.white.indexOf(monster.symbol) !=-1)
                            {
                                // On recherche le site où se trouvait le monstre
                                var oldSite = this.sites.find(function(site) {
                                    return site.id == monster.siteId;
                                });
                                // Modification de la localisation du monstre
                                monster.siteId = oldSite.white;
                                var siteFrom = this.sites.find(function(site){
                                    return site.id == oldSite.id;
                                });
                                var index = siteFrom.monster.indexOf(monster.name);
                                siteFrom.monster.splice(index, 1);
                                // Modification de la map : ajout dans le nouveau site
                                var siteTo = this.sites.find(function(site){
                                    return site.id == oldSite.white;
                                });
                                siteTo.monster.push(monster.name);
                            }

                            if(this.mythResume.move.black.indexOf(monster.symbol) !=-1)
                            {
                                // On recherche le site où se trouvait le monstre
                                var oldSite = this.sites.find(function(site) {
                                    return site.id == monster.siteId;
                                });
                                // Modification de la localisation du monstre
                                monster.siteId = oldSite.black;
                                var siteFrom = this.sites.find(function(site){
                                    return site.id == oldSite.id;
                                });
                                var index = siteFrom.monster.indexOf(monster.name);
                                siteFrom.monster.splice(index, 1);
                                // Modification de la map : ajout dans le nouveau site
                                var siteTo = this.sites.find(function(site){
                                    return site.id == oldSite.black;
                                });
                                siteTo.monster.push(monster.name);
                            }
                        });
                        // Déplacement d'un monster d'un lieu vers une rue
                        // this.sites.forEach(function(site){
                        //     if(site.id == "6")
                        //     {
                        //         var index = site.monster.indexOf('Zombie');
                        //         site.monster.splice(index, 1);
                        //     }
                        // });
                        // this.sites.forEach(function(site){
                        //     if(site.id == "28") site.monster.push("Zombie");
                        // });

                        // var self = this;
                        // setTimeout(function(){

                        //     // déplacement entre rues
                        //     self.sites.forEach(function(site){
                        //         if(site.id == "28")
                        //         {
                        //             var index = site.monster.indexOf('Cultiste');
                        //             site.monster.splice(index, 1);
                        //         }
                        //     });
                        //     self.sites.forEach(function(site){
                        //         if(site.id == "27") site.monster.push("Cultiste");
                        //     });
                        // },1500);
                        // setTimeout(function(){
                        // // Deuxième déplacement entre rues
                        // self.sites.forEach(function(site){
                        //     if(site.id == "27")
                        //     {
                        //         var index = site.monster.indexOf('Migo');
                        //         site.monster.splice(index, 1);
                        //     }
                        // });
                        // self.sites.forEach(function(site){
                        //     if(site.id == "30") site.monster.push("Migo");
                        // });
                        // },3000);

                    break;
                    case 5:
                        // Définition de l'id du site d'activité de la rumeur et de son nom
                        var siteId = this.mythResume.event.siteId;
                        var name = this.mythResume.event.name;
                        // Ajout de la rumeur sur la map
                        this.sites.forEach(function(site){
                            if(site.id == siteId) site.event.push(name);
                        });
                    break;
                }
;           },

            switchNavbar (libelle)
            {
                this.navbar[libelle] = !this.navbar[libelle];
            },
            showInvestigator(name)
            {
                this.investigatorPreview = name;
            },
            log (message)
            {
                console.log(message);
            },

            continueAction () {
                console.log('ici')
                // this.$router.push('choose-ancient')
            }
        },
        updated(){},
        created(){},
        mounted(){
            //  monsters: [
            //     { id:1, name:"Chthonien", siteId:11, symbol:"triangle", habilities: {}},
            //     { id:2, name:"Migo",      siteId:1,  symbol:"cercle",   habilities: {}},
            //     { id:3, name:"Cultiste",  siteId:3,  symbol:"lune",     habilities: {}}
            // ],
            // Affichage de la carte mythe au bout d'une seconde
            var self = this;
            setTimeout(function(){
                self.hide.mythImage = false;
            },1000);

            // Ajout des monstres sur la map
            this.monsters.forEach((monster) => {
            // Pour chacun des monstres dans monsters
                this.sites.find(function(site) {
                    // On ajoute ce montre au site correspondant
                    if( site.id == monster.siteId ) site.monster.push(monster.name);
                });
            });
        }
    }

</script>

<style>

        /***** MAP*****/
        #map-container
        {
            height : 780px;
            width: 1090px;
        }
        #button-container
        {
            height : 40px;
            width: 100%;
            margin-bottom: 25px;
        }
        #map-container, #button-container
        {
            margin-left: auto;
            margin-right: auto;
        }
        #ark-map
        {
            position : relative;
            height : 710px;
            width: 975px;
            /*background-color: lightgrey;*/
            padding-top: -50px;
        }

        #beyond-map
        {
            position : relative;
            height : 710px;
            width: 115px;
            /*background-color: lightgrey;*/
            padding: 5px;

        }

        /***** LIEUX *****/
        div .site, div .street, div .world, div .special_site
        {
            position : absolute;
            height: 80px;
            text-align: center;
            color: white;
            display:flex;
            justify-content:center;
            align-items:center;
            z-index: 10;
            text-shadow: 1px 1px 2px black;
        }
        div .site
        {
            width : 80px;
            border-radius: 20%;
        }
        div .street, div .special_site
        {
            width: 80px;
        }
        div .card
        {
            margin: 0;
        }
        div.world
        {
            height:75px;
            width: 105px;
            background-color: white;
            position: relative;
            border-radius: 5px;
            z-index: 0;
            margin-top: 4px;
            margin-bottom: 4px;

        }
        div.first, div.second
        {
            width: 50%;
            height: 100%;
        }
        div.first
        {
            background-color: grey;
            width: 50%;
            border-radius: 5px 0 0 5px;
        }
        span.other_world {
            position: absolute;
            z-index: 500;
            /*left: 0%;
            right: 0%;*/
        }
        div .special1
        {
            bottom: 2px;
            left: 2px;
        }
        div .special2
        {
            bottom: 2px;
            right: 2px;
        }
        div .special3
        {
            bottom: 90px;
            right: 2px;
        }



        /***** LIEU individuel *****/
        div #site1
        {
            top: 5px;
            left: 55px;
        }
        div #site2
        {
            top: 5px;
            left: 155px;
        }
        div #site3
        {
            top: 5px;
            left: 255px;
        }
        div #site4
        {
            top: 5px;
            left: 355px;
        }
        div #site5
        {
            top: 5px;
            left: 455px;
        }
        div #site6
        {
            top: 5px;
            left: 555px;
        }

        div #site7
        {
            top: 5px;
            right: 235px;
        }
        div #site8
        {
            top: 5px;
            right: 135px;
        }
        div #site9
        {
            top: 5px;
            right: 35px;
        }

        div #site10
        {
            top: 145px;
            left: 50px;
        }
        div #site11
        {
            top: 245px;
            left: 50px;
        }
        div #site12
        {
            top: 345px;
            left: 50px;
        }

        div #site13
        {
            top: 135px;
            right: 10px;
        }
        div #site14
        {
            top: 235px;
            right: 10px;
        }
        div #site15
        {
            top: 335px;
            right: 10px;
        }

        div #site16
        {
            top: 365px;
            left: 180px;
        }
        div #site17
        {
            top: 465px;
            left: 180px;
        }
        div #site18
        {
            top: 465px;
            left: 385px;
        }

        div #site19
        {
            top: 395px;
            right: 140px;
        }
        div #site20
        {
            top: 495px;
            right: 140px;
        }

        div #site21
        {
            bottom: 5px;
            left: 185px;
        }
        div #site22
        {
            bottom: 5px;
            left: 285px;
        }
        div #site23
        {
            bottom: 5px;
            left: 385px;
        }

        div #site24
        {
            bottom: 5px;
            right: 405px;
        }
        div #site25
        {
            bottom: 5px;
            right: 305px;
        }
        div #site26
        {
            bottom: 5px;
            right: 205px;
        }



        div #site27
        {
            top: 105px;
            left: 155px;
        }
        div #site28
        {
            top: 105px;
            left: 455px;
        }
        div #site29
        {
            top: 105px;
            right: 135px;
        }
        div #site30
        {
            top: 245px;
            left: 155px;
        }
        div #site31
        {
            top: 235px;
            right: 115px;
        }
        div #site32
        {
            top: 365px;
            left: 285px;
        }
        div #site33
        {
            top: 395px;
            right: 245px;
        }
        div #site34
        {
            bottom: 105px;
            left: 285px;
        }
        div #site35
        {
            bottom: 105px;
            right: 305px;
        }

        /***** COULEURS *****/
        div .orange
        {
            background-color : orange;
        }
        div .white
        {
            background-color : #B5B4B3; color: black;
            text-shadow: 0px 0px 0px white;
        }
        div .grey
        {
            background-color: #656364;
        }
        div .green
        {
            background-color: #0b700b;
        }
        div .purple
        {
            background-color: #633E87;
        }
        div .yellow
        {
            background-color: #F9E46B;
        }
        div .blue
        {
            background-color: #41a3ef;
        }
        div .red
        {
            background-color: #CB191F;
        }
        div .brown
        {
            background-color: #631E15;
        }
        /***** liens entre les lieux *****/
        div .bar-h, div .bar-v, div .bar-c
        {
            background-color : white;
            box-shadow: 1px 2px 2px lightgrey;
            position: absolute;
            z-index: 0;
        }
        div .bar-h
        {
            height: 4px;
        }
        div .bar-v, div .bar-c
        {
            width: 4px;
        }

        div #road1
        {
            width: 270px;
            top: 135px;
            left : 205px;
        }
        div #road2
        {
            width: 270px;
            top: 135px;
            right : 205px;
        }
        div #road3
        {
            width: 370px;
            top: 415px;
            right : 255px;
        }
        div #road4
        {
            width: 280px;
            bottom: 145px;
            right : 355px;
        }
        div #road5
        {
            width: 560px;
            top: 280px;
            right : 185px;
        }
        div #road6
        {
            height: 80px;
            top: 175px;
            left : 195px;
        }
        div #road7
        {
            height: 120px;
            bottom: 170px;
            left : 325px;
        }
        div #road8
        {
            height: 180px;
            bottom: 290px;
            left : 275px;
            transform: rotate(-55deg);
        }
        div #road9
        {
            height: 200px;
            bottom: 260px;
            right : 215px;
            transform: rotate(55deg);
        }
        div #road10
        {
            height: 120px;
            bottom: 155px;
            right : 305px;
            transform: rotate(45deg);
        }
        div #road11
        {
            height: 350px;
            top: 50px;
            left : 315px;
            transform: rotate(65deg);
        }
        div #road12
        {
            height: 80px;
            top: 175px;
            right : 160px;
            transform: rotate(-25deg);
        }

        div #road13
        {
            height: 50px;
            top: 75px;
            right : 175px;
        }
        div #road14
        {
            height: 50px;
            top: 75px;
            right : 475px;
        }
        div #road15
        {
            height: 50px;
            top: 75px;
            left : 195px;
        }
        div #road16
        {
            height: 50px;
            bottom: 75px;
            left : 325px;
        }
        div #road17
        {
            height: 50px;
            bottom: 75px;
            right : 345px;
        }
        div #road18
        {
            height: 50px;
            bottom: 245px;
            right : 225px;
            transform:rotate(90deg);
        }
        div #road19
        {
            height: 50px;
            bottom: 275px;
            left : 275px;
            transform:rotate(90deg);
        }
        div #road20
        {
            height: 50px;
            bottom: 395px;
            left : 145px;
            transform:rotate(90deg);
        }
        div #road21
        {
            height: 50px;
            bottom: 405px;
            right : 95px;
            transform:rotate(90deg);
        }
        div #road22
        {
            height: 80px;
            top: 45px;
            left : 255px;
            transform:rotate(45deg);
        }
        div #road23
        {
            height: 80px;
            top: 40px;
            left : 125px;
            transform:rotate(-45deg);
        }
        div #road24
        {
            height: 80px;
            top: 40px;
            left : 425px;
            transform:rotate(-45deg);
        }
        div #road25
        {
            height: 80px;
            top: 40px;
            right : 240px;
            transform:rotate(-45deg);
        }
        div #road26
        {
            height: 80px;
            top: 40px;
            right : 110px;
            transform:rotate(45deg);
        }
        div #road27
        {
            height: 80px;
            top: 40px;
            right : 410px;
            transform:rotate(45deg);
        }
        div #road28
        {
            height: 80px;
            top: 175px;
            right : 90px;
            transform:rotate(45deg);
        }
        div #road29
        {
            height: 80px;
            top: 295px;
            right : 90px;
            transform:rotate(-45deg);
        }
        div #road30
        {
            height: 80px;
            top: 180px;
            left : 130px;
            transform:rotate(-45deg);
        }
        div #road31
        {
            height: 80px;
            top: 300px;
            left : 140px;
            transform:rotate(45deg);
        }
        div #road32
        {
            height: 80px;
            top: 420px;
            left : 270px;
            transform:rotate(45deg);
        }
        div #road33
        {
            height: 80px;
            top: 420px;
            left : 375px;
            transform:rotate(-45deg);
        }
        div #road34
        {
            height: 80px;
            bottom: 50px;
            left : 270px;
            transform:rotate(45deg);
        }
        div #road35
        {
            height: 80px;
            bottom: 50px;
            left : 375px;
            transform:rotate(-45deg);
        }
        div #road36
        {
            height: 80px;
            bottom: 50px;
            right : 400px;
            transform:rotate(45deg);
        }
        div #road37
        {
            height: 80px;
            bottom: 50px;
            right : 290px;
            transform:rotate(-45deg);
        }
        div #road38
        {
            height: 80px;
            bottom: 180px;
            right : 225px;
            transform:rotate(-45deg);
        }

        /****** FLECHES ******/
        .white-arrow, .black-arrow, .double-arrow
        {
            position: absolute;
            z-index: 0;
        }
        .white-arrow
        {
            font-size: 25px;
            color:white;
            text-shadow: 1px 1px 2px black;
        }
        .black-arrow
        {
            font-size: 25px;
            color:black;
        }
        .double-arrow
        {
            color:black;
            font-size: 35px;
        }
        #arrow1
        {
            left: 228px;
            top: 116px;
        }
        #arrow2
        {
            left: 529px;
            top: 116px;
        }
        #arrow3
        {
            right: 156px;
            top: 172px;
            transform:rotate(70deg);
        }
        #arrow4
        {
            right: 160px;
            top: 302px;
            transform:rotate(150deg);
        }
        #arrow5
        {
            right: 278px;
            top: 465px;
            transform:rotate(140deg);
        }
        #arrow6
        {
            right: 380px;
            bottom: 125px;
            transform:rotate(180deg);
        }
        #arrow7
        {
            left: 312px;
            bottom: 173px;
            transform:rotate(-90deg);
        }
        #arrow8
        {
            left: 306px;
            bottom: 330px;
            transform:rotate(-150deg);
        }
        #arrow9
        {
            left: 182px;
            top: 220px;
            transform:rotate(-90deg);
        }
        #arrow10
        {
            left: 436px;
            top: 120px;
            transform:rotate(-180deg);
        }
        #arrow11
        {
            right: 209px;
            top: 120px;
            transform:rotate(-180deg);
        }
        #arrow12
        {
            right: 144px;
            top: 212px;
            transform:rotate(250deg);
        }
        #arrow13
        {
            right: 262px;
            top: 371px;
            transform:rotate(320deg);
        }
        #arrow14
        {
            right: 322px;
            top: 501px;
            transform:rotate(320deg);
        }
        #arrow15
        {
            left: 359px;
            bottom: 129px;
        }
        #arrow16
        {
            left: 317px;
            bottom: 240px;
            transform:rotate(90deg);
        }
        #arrow17
        {
            left: 229px;
            bottom: 392px;
            transform:rotate(45deg);
        }
        #arrow18
        {
            left: 187px;
            top: 173px;
            transform:rotate(90deg);
        }

        #arrow19
        {
            left: 118px;
            top: 58px;
            transform:rotate(45deg);
        }
        #arrow20
        {
            left: 182px;
            top: 60px;
            transform:rotate(90deg);
        }
        #arrow21
        {
            left: 242px;
            top: 60px;
            transform:rotate(135deg);
        }

        #arrow22
        {
            left: 417px;
            top: 58px;
            transform:rotate(45deg);
        }
        #arrow23
        {
            left: 483px;
            top: 60px;
            transform:rotate(90deg);
        }
        #arrow24
        {
            left: 542px;
            top: 60px;
            transform:rotate(135deg);
        }
        #arrow25
        {
            right: 218px;
            top: 58px;
            transform:rotate(45deg);
        }
        #arrow26
        {
            right: 158px;
            top: 60px;
            transform:rotate(90deg);
        }
        #arrow27
        {
            right: 96px;
            top: 60px;
            transform:rotate(135deg);
        }
        #arrow28
        {
            right: 73px;
            top: 190px;
            transform:rotate(135deg);
        }
        #arrow29
        {
            right: 73px;
            top: 256px;
            transform:rotate(180deg);
        }
        #arrow30
        {
            right: 75px;
            top: 312px;
            transform:rotate(225deg);
        }
        #arrow31
        {
            left: 116px;
            top: 192px;
            transform:rotate(45deg);
        }
        #arrow32
        {
            left: 113px;
            top: 262px;
        }
        #arrow33
        {
            left: 113px;
            top: 323px;
            transform:rotate(-45deg);
        }
        #arrow34
        {
            left: 243px;
            top: 382px;
        }
        #arrow35
        {
            left: 243px;
            top: 443px;
            transform:rotate(-45deg);
        }
        #arrow36
        {
            left: 367px;
            top: 443px;
            transform:rotate(-135deg);
        }
        #arrow37
        {
            left: 247px;
            bottom: 59px;
            transform:rotate(-45deg);
        }
        #arrow38
        {
            left: 308px;
            bottom: 57px;
            transform:rotate(-90deg);
        }
        #arrow39
        {
            left: 367px;
            bottom: 55px;
            transform:rotate(-135deg);
        }
        #arrow40
        {
            right: 392px;
            bottom: 60px;
            transform:rotate(-45deg);
        }
        #arrow41
        {
            right: 332px;
            bottom: 57px;
            transform:rotate(-90deg);
        }
        #arrow42
        {
            right: 268px;
            bottom: 55px;
            transform:rotate(-135deg);
        }
        #arrow43
        {
            right: 205px;
            bottom: 185px;
            transform:rotate(-135deg);
        }
        #arrow44
        {
            right: 203px;
            top: 416px;
            transform:rotate(180deg);
        }

        /***** JETONS *****/
        #clue_token
        {
            color: white;
            top: -3px;
            right: -4px;
            height: 30px;
            width: 30px;
            background-color: lightgreen;
            background-image: url("/image/token/clue.png");
            background-size: contain;
            background-repeat: no-repeat;
            padding-top: 1rem;
            font-size: 12px;
            /*filter: opacity(70%);*/
            /*-webkit-filter: opacity(70%);*/
        }
        .token
        {
            height: 35px;
            width: 35px;
            background-color: lightgrey;
        }
        .token, #clue_token, .portal_token,
        div#Jenny_Barnes, div#Peggy_Green, div#Francis_Sailor, div#Joe_Diamond, div#Daisie_Walker, div#Anne_Hathaway
        {
            position: absolute;
            z-index: 999;
            background-size: contain;
            background-repeat: no-repeat;
            border-radius: 50%;
            -webkit-box-shadow: 2px 2px 0px 0px rgba(0,0,0,0.65);
            -moz-box-shadow: 2px 2px 0px 0px rgba(0,0,0,0.65);
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,0.65);
        }
        div.monster
        {
            position: absolute;
            z-index: 999;
            /*background-size: contain;*/
            /*background-repeat: no-repeat;*/
            border-radius: 5px;
            -webkit-box-shadow: -1px 1px 2px 0px rgba(0,0,0,0.65);
            -moz-box-shadow: -1px 1px 2px 0px rgba(0,0,0,0.65);
            box-shadow: -1px 1px 2px 0px rgba(0,0,0,0.65);
            /*font-size: 12px;*/
            background-color: lightgrey;
            height: 30px;
            width: 42px;
        }
        div.monster_1
        {
            top:-2px;
            left:-2px;
        }
        div.monster_2
        {
            top:-2px;
            left:18px;
        }
        div.monster_3
        {
            top:-2px;
            left:38px;
        }
        div.monster_4
        {
            top:-2px;
            left:58px;
        }

        div.investigator, div.beyond_investigator
        {
            background-color: grey;
            height: 35px;
            width: 35px;
        }

        div.investigator_1
        {
            bottom: 0;
            right: 5px;
        }
        div.investigator_2
        {
            bottom: 0;
            right: 20px;
        }
        div.investigator_3
        {
            bottom: 0;
            right: 35px;
        }
        div.investigator_4
        {
            bottom: 0;
            right: 50px;
        }
        div.investigator_5
        {
            bottom: 30px;
            right: 5px;
        }
        div.investigator_6
        {
            bottom: 30px;
            right: 20px;
        }
        .portal_token
        {
            top: -2px;
            right: 22px;
            height: 45px;
            width: 45px;
            background-color: black;
            color: white;
            /*background-image: url(img/portal/hallCelano.png);*/
        }
        div.event_token
        {
            background-color: red;
        }

        /*TRANSITIONS*/
        .fade-enter-active, .fade-leave-active {
            transition: opacity .75s;
        }
        .fade-enter, .fade-leave-to
        {
            opacity: 0;
        }

        /*BOUTTONS GROUPES*/
.btn-group {
  position: relative;
  display: -ms-inline-flexbox;
  display: inline-flex;
  vertical-align: middle;
}

.btn-group>.btn:first-child:not(:last-child) {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.btn-group>.btn:not(:first-child):not(:last-child) {
  border-radius: 0;
}

.btn-group>.btn:last-child:not(:first-child),
.btn-group>.dropdown-toggle:not(:first-child) {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.btn-group>.btn-inactive {
  background-color: #607d8b;
}

.btn-group>.btn {
  -webkit-box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0), 0 0px 0px 0px rgba(0, 0, 0, 0), 0 0px 0px 0 rgba(0, 0, 0, 0);
  box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0), 0 0px 0px 0px rgba(0, 0, 0, 0), 0 0px 0px 0 rgba(0, 0, 0, 0);
}

.btn-group>.btn-inactive:hover {
  background-color: #728F9D;
}

.btn-group>.btn:hover {
  -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
}

</style>
