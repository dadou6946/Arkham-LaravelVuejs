<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle2 }}</h1>
        <hr>

        <div class="row">

            <div class="col-md-3">
                <div>Le joueur {{ first }} commencera la partie.</div>
                <hr>
                <div v-for="investigator in investigators" class="alert alert-success" role="alert">
                    Joueur {{investigator.player}} : {{investigator.name}}
                </div>
            </div>

            <div class="col-md-9 text-center">

                <div v-if="!enableSubmit">
                    Le joueur {{ current }} choisit son investivateur :
                </div>
                <div v-if="enableSubmit">
                    {{ recapMessage }}
                </div>

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


            </div>
        </div>

        <div class="row">
            <div id="image_content"
                 class="col-md-9 col-md-offset-3">
                <div v-if="hovered !=''" :style="preview">
                </div>


            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                pageTitle2: 'Choix des investigateurs',
                playerNumber: 2,
                first: 1,
                current: 1,
                enableSubmit: false,
                recapMessage : '',
                hovered: '',
                investigators: [],
                // waitSubmit: true,
                available: [
                    { disabled: '', name: 'Joe Diamond'},
                    { disabled: '', name: 'Peggy Green'},
                    { disabled: '', name: 'Jenny Barnes'},
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
                this.hovered = name;
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
            preview: function(){
             return { backgroundImage: "url('/image/sheet/character/" + this.hovered.replace(' ', '') + ".jpg')" }
             // "+ this.hovered.replace(' ', '') +"
            }
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
        background-color: teal;
    }

</style>
