<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle3 }}</h1>
        <hr>

        <div class="row">
            <div class="col-md-3 text-center">
                <div>
                  <label>{{ instruction }}</label>
                </div>

                <hr>
            </div>

            <div class="col-md-9 text-center">

                <button v-for="ancien in anciens" v-bind:class="{ 'btn-light': !ancien.selected, 'btn-success': ancien.selected }" class="btn" @click="chooseAcien(ancien)">
                    {{ ancien.name }}
                </button>
                <hr>
                <div class="form-group">
                  <input type="submit" class="form-control btn btn-success" :disabled="!preventConfirm" @click="continueAction" value="Confirmer">
                </div>
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
            }
        }
    }
</script>

<style>

</style>
