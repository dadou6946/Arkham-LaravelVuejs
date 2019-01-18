<template>
    <div>
        <!-- Sidebars apparaisant au clique sur les boutons -->
        <!-- Investigateurs -->
        <transition name="fade">
            <nav id="sidebar-investigator" class="teal lighten-3 sidenav sidenav-fixed center-align"
                style="transform: translateX(0px);z-index:980;"
                v-if="navbar.investigator">

                    <div class="waves-effect waves-light"
                        v-for="(investigator, index) of investigators"
                        style="margin:3px;border-radius:5px;font-size:14px;"
                        @click="showInvestigator(investigator.name)">
                        <span v-html="investigator.name"></span>
                    </div>

                    <div v-if="investigatorPreview!=''">
                        <div class="">

                            <!-- Début de la fiche personnage -->
                            <!-- ---------------------------- -->
                            <div id="investigator_container_1" class="investigator_container row panel-body">
                                <div class="text-center">
                                    <div id="photo_1" class="pull-left">
                                        <img class="photo" src="fw\assets\img\characters\portraits\JennyBarnes.png" alt="">
                                    </div>

                                    <div id="top_comp" class="pull-right text-center">
                                        <h3 id="name1">{{investigatorPreview}}</h3>
                                        <!-- <h3 id="name2">Barnes</h3> -->
                                        <h5>La Dilettante</h5><hr>
                                        <h5>Santé mentale: 6/6</h5>
                                        <h5>Résistance: 4/4</h5><hr>
                                    </div>

                                    <div id="equipment" class="text-left col-md-12 col-lg-12">
                                        <span id="house">Maison: </span><span>Gare</span>
                                        <h5>Possessions fixes</h5>
                                        <span>10$</span>
                                        <h5>Possessions aléatoires</h5>
                                        <span>1@Compétence, 1@Sort, 1@Objet Unique, 2@Objets Communs</span>
                                        <h5>Concentration: 1</h5><hr>
                                    </div>

                                    <div id="capacity" class="text-left col-md-12 col-lg-12"><h5>Héritage</h5>
                                                <span>
                            <b>Entretien:</b> Jenny gagne 1$.</span></div>

                                    <div id="compétence" class="text-left col-md-6 col-lg-6">
                                        <ul class="list-unstyled">
                                            <li>Discression</li>
                                            <li>Vitesse</li>
                                            <br>
                                            <li>Combat</li>
                                            <li>Volonté</li>
                                            <br>
                                            <li>Savoir</li>
                                            <li>Chance</li>
                                        </ul>
                                    </div>

                                    <div id="numbers" class="text-left col-md-6 col-lg-6">
                                        <ul class="list-unstyled">
                                            <li>
                                                <ul class="list-unstyled list-inline">
                                                    <li class="marker_top">1</li>
                                                    <li>2</li>
                                                    <li>3</li>
                                                    <li>4</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul class="list-unstyled list-inline">
                                                    <li class="marker_bot">3</li>
                                                    <li>2</li>
                                                    <li>1</li>
                                                    <li>0</li>
                                                </ul>
                                            </li>
                                            <br>
                                            <li>
                                                <ul class="list-unstyled list-inline">
                                                    <li>3</li>
                                                    <li>2</li>
                                                    <li class="marker_top">1</li>
                                                    <li>0</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul class="list-unstyled list-inline">
                                                    <li>2</li>
                                                    <li>3</li>
                                                    <li class="marker_bot">4</li>
                                                    <li>5</li>
                                                </ul>
                                            </li>
                                            <br>
                                            <li>
                                                <ul class="list-unstyled list-inline">
                                                    <li>2</li>
                                                    <li>3</li>
                                                    <li>4</li>
                                                    <li class="marker_top">5</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <ul class="list-unstyled list-inline">
                                                    <li>5</li>
                                                    <li>4</li>
                                                    <li>3</li>
                                                    <li class="marker_bot">2</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
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

        <!-- Herault -->
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
                    { name: "Joe Diamond"},
                    { name: "Francis Sailor"},
                    { name: "Jenny Barnes"},
                    { name: "Daisie Walker"},
                    { name: "Peggy Green"},
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
            }
        }
    }

</script>

<style>
        /*TRANSITIONS*/
        .fade-enter-active, .fade-leave-active {
            transition: opacity .75s;
        }
        .fade-enter, .fade-leave-to
        {
            opacity: 0;
        }
</style>
