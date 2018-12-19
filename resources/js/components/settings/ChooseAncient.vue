<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle3 }}</h1>
        <hr>

        <div class="row">
            <div class="col-md-7 text-center">
                <div>
                  <label>{{ instruction }}</label>
                </div>
                <div>
                    <button v-for="ancien in anciens"
                        v-bind:class="{ 'teal': !ancien.selected, 'red': ancien.selected }"
                        class="waves-effect waves-light btn"
                        @click="chooseAcien(ancien)"
                        @mouseover="mouseOver(ancien.name)"
                        @mouseleave="hovered=''">
                    {{ ancien.name }}
                    </button>
                </div>
                <hr>
                <div class="form-group">
                  <input type="submit" class="form-control btn btn-success" :disabled="!preventConfirm" @click="continueAction" value="Confirmer">
                </div>

                <hr>
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

            <div class="col-md-4 text-center">
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data: function(){
            return {

                pageTitle3: 'Choix du Grand Ancien',
                instruction: 'Veuillez choisir le Grand Ancien pour cette partie',
                anciens: [
                    { name: 'Yig', difficulty: 'easy', selected: false},
                    { name: 'Cthulhu', difficulty: 'hard', selected: false},
                    { name: 'Daoloth', difficulty: 'medium', selected: false},
                    { name: 'Hastur', difficulty: 'easy', selected: false}
                ],
                ancienChoice: '',
                preventConfirm: false,
                imagePath: '',
                hovered: '',
            }
        },
        methods: {

            submit () {
                //Envoi des données au server
                //Diriger vers le nouveau composant
            },


            chooseAcien (ancien) {
                if(ancien.selected == true)
                {
                    ancien.selected = false
                    this.ancienChoice = ''
                    this.preventConfirm = false
                }
                else
                {
                    this.anciens.forEach((anc)=>{
                        anc.selected = false
                    })
                    this.ancienChoice = ancien.name
                    ancien.selected = true
                    this.preventConfirm = true
                }

            },
            continueAction () {
                // console.log('ici')
                this.$router.push('set-clues')
            },
            mouseOver(name){
                this.hovered = true;
                this.imagePath = '/image/sheet/ancient/' + name.replace(' ', '') + '.jpg';
            },
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
