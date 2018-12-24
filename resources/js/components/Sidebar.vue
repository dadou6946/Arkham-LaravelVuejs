<template>
    <div>
        <!-- Sidebars apparaisant au clique sur les boutons -->
        <!-- Investigateurs -->
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
