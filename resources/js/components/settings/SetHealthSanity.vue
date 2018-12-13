<template>
    <div class="container">

        <h1 class="jumbotron text-center">{{ pageTitle }}</h1>
        <hr>

        <div class="row">

            <div class="col-md-12 text-center">

                <div v-for="(investigator,index) of investigators">
                    <span v-html="investigator.name"></span> (joueur <span v-html="index + 1"></span>) commence la partie avec : <span v-html="investigator.resistance"></span> <img src="https://png.icons8.com/material/40/c0392b/hearts.png"> et <span v-html="investigator.sanity"></span> <img src="https://png.icons8.com/material/40/2980b9/hearts.png" alt="" />.
                    <br><br>
                </div>

                <br>

                <button class="waves-effect waves-light btn teal"
                    @click="continueAction">Etape suivante</button>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data: function(){
            return {
                pageTitle: 'Attribution des résistances et de la santé mentale',
                playerNumber: 4,
                investigators: [
                    { name: 'Joe Diamond', resistance: 6, sanity: 4},
                    { name: 'Peggy Green', resistance: 4, sanity: 6},
                    { name: 'Jenny Barnes', resistance: 4, sanity: 6},
                    { name: 'Francis Sailor', resistance: 4, sanity: 6}
                ],
            }
        },
        methods: {

            log (message)
            {
                console.log(message);
            },

            continueAction () {
                // console.log('ici')
                this.$router.push('set-properties')
            }
        }
    }

</script>

<style>

</style>
