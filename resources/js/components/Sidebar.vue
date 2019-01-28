<template>
    <div>
        <!-- Sidebars apparaisant au clique sur les boutons -->
        <!-- Investigateurs -->
        <transition name="fade">
            <nav id="sidebar-investigator" class="teal lighten-3 sidenav sidenav-fixed"
                style="transform: translateX(0px);z-index:980;width:370px;line-height:8pt;"
                v-if="navbar.investigator">

                    <div class="center-align">
                        <button class="waves-effect waves-teal btn-flat btn-small"
                        v-for="(investigator, index) of investigators"
                        style="margin:3px;border-radius:5px;font-size:10px;line-height: normal;"
                        @click="showInvestigator(investigator.name)">
                        <span v-html="investigator.name"></span></button>
                    </div>
                    <hr>

                    <transition name="fade" mode="out-in">
                        <div v-for="investigator of investigators"
                            v-if="investigatorPreview!='' && investigator.name == investigatorPreview"
                            :key="investigator.name">
                            <div class="row center-align lh-15">
                                <img class="col-md-6 grey lighten-3 z-depth-3" :src="'/image/sheet/character/head/'+investigatorPreview.replace(' ', '')+'.png'"
                                    :alt="investigatorPreview"
                                    style="padding:12px;height:165px; width:auto;">
                                <div class="col-md-6">
                                    <h5 id="name">{{investigator.name}}</h5>
                                    <span id="profession">La Diletante</span>
                                    <hr>
                                    <span id="sanity">Santé mentale: 6/6</span><br>
                                    <span id="stamina">Résistance: 4/4</span><br>
                                    <hr>
                                    <span id="statut">Statut: ok</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <!-- Objets, maison et concentration -->
                                <div class="col-md-6 lh-15" style="border-right: 1px solid #eee;">
                                    <span id="house">Maison: </span><span>Gare</span>
                                    <hr>
                                    <span>Possessions fixes :</span><br>
                                    <span>10$</span><br>
                                    <span>Possessions aléatoires :</span><br>
                                    <span>1 Compétence, 1 Sort, 1 Objet Unique, 2 Objets Communs</span>
                                    <hr>
                                    <span>Concentration: 1</span>
                                </div>
                                <!-- Compétences spéciales -->
                                <div class="col-md-6" style="text-align:justify;">
                                    <span class="lh-15">Héritage</span><br><br>
                                    <span class="" style="font-size:13px;line-height:11pt;">
                                        <!-- <b>Entretien:</b> Jenny gagne 1$. -->
                                        <b>Entretien:</b> Les monstres et les portails ne peuvent pas apparaitre a l'endroit ou se trouve Kate à cause de son stabilitisateur de flux. Les monstres et les portails ne disparaissent cependant pas quand elle rentre dans un lieu, et les monstres peuvent entre normalement dans un lieu ou elle se trouve.
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row lh-15">
                                <!-- textes d'aptitudes -->
                                <div class="col-xs-4">
                                    <div class="skills mt-5">
                                        <div>vitesse :</div>
                                        <div>discretion:</div>
                                    </div>
                                    <div class="skills mt-25">
                                        <div>vigueur:</div>
                                        <div>volonté:</div>
                                    </div>
                                    <div class="skills mt-25">
                                        <div>savoir:</div>
                                        <div>chance:</div>
                                    </div>
                                </div>
                                <!-- valeurs -->
                                <div class="col-xs-8">
                                    <div v-for="(skills,index) of investigator.availableSkills" class="row row-skills text-center">
                                        <div v-for="(value) of skills"
                                            class="col-xs-3 skill"
                                            v-html="value"
                                            v-bind:class="investigator.skills[index] == value?globule(index):''"
                                        >
                                        </div>
                                        <br>
                                        <div v-if="index =='discretion' || index =='volonte'" v-html="'<br>'"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row lh-15">
                                <span id="objets">Objets</span>
                                <div class="row">
                                    <div v-for="(object, index) of investigator.objects"
                                        style="height:65px;"
                                        class="card teal col-md-3"
                                        v-html="object">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </transition>
            </nav>
        </transition>

        <!-- gardien -->
        <transition name="fade">
            <nav id="sidebar-guardian" class="sidenav blue lighten-3"
                style="transform: translateX(0px);z-index:990;height:100%;width:280px;position:absolute;right:0;"
                v-if="navbar.guardian">
            </nav>
        </transition>

        <!-- Infos de partie -->
        <transition name="fade">
            <nav id="sidebar-game" class="cyan lighten-3"
                 style="z-index:1000;width:100%;height:300px;position:absolute;bottom:0;"
                 v-if="navbar.game">
                <div>
                    <span>Tour n° 2</span><br>
                    <span>Phase : mouvement</span><br>
                    <span>Premier joueur : joueur 1 - Francis Sailor</span>
                </div>
            </nav>
        </transition>

        <!-- Ancient -->
        <transition name="fade">
            <nav id="sidebar-ancient" class="red lighten-3"
                 style="z-index:980;height:100%;width:300px;position:absolute;right:0;"
                 v-if="navbar.ancient">
            </nav>
        </transition>

        <!-- Heraut -->
        <transition name="fade">
            <nav id="sidebar-herald" class="orange lighten-3"
                 style="z-index:990;height:100%;width:280px;position:absolute;right:0;"
                 v-if="navbar.herald">
            </nav>
        </transition>


        <!-- BOUTONS POUR AFFICHER LES SIDEBARS-->
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
    </div>
</template>


<script>
    export default {
        data: function(){
            return {

                navbar:
                    {
                        investigator: false,
                        ancient: false,
                        game: false,
                        guardian: false,
                        herald: false,
                    },
                investigators: [
                    { name: "Joe Diamond",
                      skills: { vitesse: 3, discretion:4, vigueur:2, volonte:3, savoir:0, chance:3},
                      availableSkills: { vitesse: [3,4,5,6], discretion:[4,3,2,1], vigueur:[2,3,4,5], volonte:[3,2,1,0], savoir:[0,1,2,3], chance:[3,2,1,0]},
                      objects : ['Automatique 45']
                    },
                    { name: "Francis Sailor",
                      skills: { vitesse: 1, discretion:5, vigueur:1, volonte:3, savoir:1, chance:5},
                      availableSkills: { vitesse: [1,2,3,4], discretion:[5,4,3,2], vigueur:[1,2,3,4], volonte:[3,2,1,0], savoir:[1,2,3,4], chance:[5,4,3,2]},
                      objects : ['Manteau sombre', 'Motocyclette']
                    },
                    { name: "Jenny Barnes",
                      skills: { vitesse: 0, discretion:3, vigueur:2, volonte:3, savoir:0, chance:4},
                      availableSkills: { vitesse: [0,1,2,3], discretion:[3,2,1,0], vigueur:[2,3,4,5], volonte:[3,2,1,0], savoir:[0,1,2,3], chance:[4,3,2,0]},
                      objects : ['Dynamite', 'Lance-flammes', 'Hache', 'Grigri']
                    },
                    { name: "Daisy Walker",
                      skills: { vitesse: 1, discretion:4, vigueur:1, volonte:3, savoir:2, chance:5},
                      availableSkills: { vitesse: [1,2,3,4], discretion:[4,3,2,1], vigueur:[1,2,3,4], volonte:[3,2,1,0], savoir:[2,3,4,5], chance:[5,4,3,2]},
                      objects : ['Croix', 'Lanterne']
                    },
                    { name: "Peggy Green",
                      skills: { vitesse: 1, discretion:4, vigueur:1, volonte:3, savoir:2, chance:5},
                      availableSkills: { vitesse: [1,2,3,4], discretion:[4,3,2,1], vigueur:[1,2,3,4], volonte:[3,2,1,0], savoir:[2,3,4,5], chance:[5,4,3,2]},
                      objects : ['Porte bonheur']
                    }
                ],
                investigatorPreview: "",

            }
        },
        methods: {

            log (message)
            {
                console.log(message);
            },
            switchNavbar(libelle)
            {
                this.navbar[libelle] = !this.navbar[libelle];
            },
            showInvestigator(name)
            {
                this.investigatorPreview = name;
            },
            continueAction () {
                // console.log('ici')
                // this.$router.push('choose-ancient')
            },
            globule(index)
            {
                switch(index)
                {
                    case "vitesse": case "vigueur": case "savoir":
                        return "glob-top";
                    case "discretion": case "volonte": case "chance":
                        return "glob-bot";
                }
            }
        }
    }

</script>

<style>
    /*TRANSITIONS*/
    .fade-enter-active, .fade-leave-active
    {
        transition: opacity .75s;
    }
    .fade-enter, .fade-leave-to
    {
        opacity: 0;
    }
    /*aptitudes*/
    .row-skills
    {
        margin-bottom: 0;
    }
    .lh-15
    {
        line-height:15pt;
    }
    .mt-25
    {
        margin-top: 25px;
    }
    .mt-5
    {
        margin-top: 5px;
    }
    .glob-top
    {
        border: 3px solid;
        border-color: red red transparent red;
        border-radius: 8px 8px 0 0;
    }
    .glob-bot
    {
        border: 3px solid;
        border-color: transparent blue blue blue;
        border-radius: 0 0 8px 8px;
    }
    hr
    {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
