<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle2 }}</h1>
        <hr>

        <div class="row">

            <div class="col-md-7">

                <div class="row">
                    <div class="col-md-6">
                        <div v-if="!enableSubmit">
                        Le joueur {{ current }} doit choisir son investivateur :</div>
                    </div>
                    <div class="col-md-6">
                        <span class="badge teal white-text">Le joueur {{ first }} commencera la partie</span>
                    </div>


                </div>
                <hr>

                <br>

                <button v-for="player in available"
                        v-bind:class="player.disabled"
                        @click="choose(player)"
                        @mouseover="mouseOver(player.name)"
                        @mouseleave="hovered=''"
                        class="btn">
                    {{ player.name }}
                </button>

                <br><br>

                <button class="btn btn-success" :disabled="!enableSubmit" @click="continueAction">Confirmer</button>
                <button class="btn btn-success" @click="reboot">Réattribuer les personnages</button>

                <hr>
                <div class="row">
                    <!-- Messages récapitulatifs des chois de personnages -->
                    <div v-for="investigator in investigators"
                         class="col-md-5 character-resume alert alert-success text-center"
                         role="alert"
                         @mouseover="mouseOver(investigator.name)"
                         @mouseleave="hovered=''">
                        Joueur {{investigator.player}} : {{investigator.name}}
                    </div>
                </div>
                <blockquote v-if="enableSubmit">
                    {{ recapMessage }}
                </blockquote>
            </div>

            <div class="col-md-5 text-center">
                <transition name="fade">
                    <div v-if="hovered !=''" id="image_content" class="center-align">
                        <img id="image-preview" :src="imagePath" alt="" class="">
                    </div>
                </transition>
            </div>
        </div>

        <div class="row">
        </div>

    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                pageTitle2: 'Choix des investigateurs',
                playerNumber: 6,
                first: 1,
                current: 1,
                enableSubmit: false,
                recapMessage : '',
                hovered: '',
                investigators: [],
                // waitSubmit: true,
                preview: '',
                imagePath: '',
                available: [
                    { disabled: '', name: 'Joe Diamond'},
                    { disabled: '', name: 'Jenny Barnes'},
                    { disabled: '', name: 'Mark Harrigan'},
                    { disabled: '', name: 'Michael McGlen'},
                    { disabled: '', name: 'Peggy Green'},
                    { disabled: '', name: 'Francis Sailor'}
            ],
            }
        },
        methods: {
            choose (player) {
                if(player.disabled == "")
                {
                    if(this.current <= this.playerNumber)
                    {
                        this.investigators.push({player: this.current, name: player.name})
                        player.disabled = "disabled"
                        if(this.current < this.playerNumber)
                            this.current++
                        else if(this.current == this.playerNumber)
                        {
                            this.enableSubmit = true;
                            this.available.forEach((character)=>{
                                character.disabled='disabled';
                            })
                        }
                    }
                }
            },
            // Remise à zero des props pour choisir à nouveau les personnages
            reboot () {
                this.current = 1
                this.enableSubmit = false
                this.investigators = []
                this.available.forEach((character)=>{
                    character.disabled=''
                })
            },
            mouseOver(name){
                this.hovered = true;
                this.imagePath = '/image/sheet/character/' + name.replace(' ', '') + '.jpg';
            },
            submit () {
                //Envoi des données au server
                //Diriger vers le nouveau composant
            },
            continueAction () {
                // console.log('ici')
                this.$router.push('mix-ally-package')
            }


        }
        ,
        updated(){

            this.recapMessage = this.playerNumber == 1 ? 'Le joueur 1 a été choisi. Vous pouvez le réattribuer ou passer à l\'étape suivante.':
                                                         'Les joueurs ont été choisis. Vous pouvez les réattribuer ou passer à l\'étape suivante.';
        },
        computed: {

        }
    }
</script>

<style>
    .btn {
        border-radius: 5px;
        margin: 2px;
        /*color: white;
        background-color: teal;*/
    }
    .selected {
        border: 3px solid lightgreen;
        -webkit-box-shadow: -3px -2px 5px 0px lightgreen;
        -moz-box-shadow: -3px -2px 5px 0px lightgreen;
        box-shadow: -3px -2px 5px 0px lightgreen;
    }
    #image_content
    {
        height: 550px;
        width: 100%;
        /*background-color: teal;*/
    }
    #image-preview {
        height: 100%;
        width: auto;
        margin: auto;
    }
    .character-resume
    {
        margin: 2px;
    }
    /*TRANSITIONS*/
    .fade-enter-active, .fade-leave-active {
        transition: opacity .75s;
    }
    .fade-enter, .fade-leave-to
    {
        opacity: 0;
    }


</style>
